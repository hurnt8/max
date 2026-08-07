<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancingContractTemplate;
use App\Models\User;
use App\Services\ContractService;
use App\Services\FinancingDocxService;
use App\Services\FinancingDocxTemplateManager;
use App\Services\FinancingVariableResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FinancingContractTemplateController extends Controller
{
    public function __construct(
        private FinancingDocxTemplateManager $docxManager,
        private FinancingDocxService         $docxService,
        private FinancingVariableResolver    $variableResolver,
        private ContractService              $contractService,
    ) {}

    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('super-admin')) {
            $templates = FinancingContractTemplate::with('creator', 'assignedAdmins')->latest()->get();
        } else {
            $templates = $user->assignedFinancingTemplates()->with('creator')->latest()->get();
        }

        return view('admin.financing-contract-templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.financing-contract-templates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'is_default' => 'boolean',
            'locale'     => 'nullable|in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt',
        ]);

        $isDefault = $data['is_default'] ?? false;
        if ($isDefault && !Auth::user()->hasRole('super-admin')) {
            $isDefault = false;
        }

        if ($isDefault) {
            FinancingContractTemplate::where('is_default', true)->update(['is_default' => false]);
        }

        FinancingContractTemplate::create([
            'name'          => $data['name'],
            'content'       => '',
            'is_default'    => $isDefault,
            'template_type' => 'docx',
            'locale'        => $data['locale'] ?? null,
            'created_by'    => Auth::id(),
        ]);

        return redirect()->route('admin.financing-contract-templates.index')
                         ->with('success', 'Modèle créé. Uploadez maintenant votre fichier .docx.');
    }

    public function edit(FinancingContractTemplate $financingContractTemplate)
    {
        $this->authorizeTemplate($financingContractTemplate);

        $admins = Auth::user()->hasRole('super-admin')
            ? User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->orderBy('name')->get()
            : collect();
        $assignedIds = $financingContractTemplate->assignedAdmins()->pluck('users.id')->toArray();

        return view('admin.financing-contract-templates.edit', [
            'template'    => $financingContractTemplate,
            'variables'   => $this->financingVariableDescriptions(),
            'admins'      => $admins,
            'assignedIds' => $assignedIds,
        ]);
    }

    public function update(Request $request, FinancingContractTemplate $financingContractTemplate)
    {
        $this->authorizeTemplate($financingContractTemplate);

        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'is_default' => 'boolean',
            'locale'     => 'nullable|in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt',
        ]);

        $isSuperAdmin = Auth::user()->hasRole('super-admin');
        $isDefault    = $isSuperAdmin ? ($data['is_default'] ?? false) : $financingContractTemplate->is_default;

        if ($isSuperAdmin && $isDefault) {
            FinancingContractTemplate::where('id', '!=', $financingContractTemplate->id)
                             ->update(['is_default' => false]);
        }

        $financingContractTemplate->update([
            'name'       => $data['name'],
            'is_default' => $isDefault,
            'locale'     => $data['locale'] ?? $financingContractTemplate->locale,
        ]);

        if ($isSuperAdmin) {
            $adminIds = array_filter(array_map('intval', (array) $request->input('assigned_admins', [])));
            $financingContractTemplate->assignedAdmins()->sync($adminIds);
        }

        return redirect()->route('admin.financing-contract-templates.index')
                         ->with('success', 'Modèle mis à jour.');
    }

    public function destroy(FinancingContractTemplate $financingContractTemplate)
    {
        $this->authorizeTemplate($financingContractTemplate);

        abort_if($financingContractTemplate->is_default, 403, 'Impossible de supprimer le modèle par défaut.');
        $financingContractTemplate->delete();
        return back()->with('success', 'Modèle supprimé.');
    }

    /**
     * Retourne les balises du template qui ne correspondent à aucune variable standard.
     */
    public function missingVars(FinancingContractTemplate $financingContractTemplate)
    {
        $this->authorizeTemplate($financingContractTemplate);

        $knownKeys = array_keys($this->financingVariableDescriptions());

        preg_match_all('/\{([a-zA-Z][a-zA-Z0-9_]*)\}/', $financingContractTemplate->content ?? '', $m);
        $contentTags = array_values(array_unique($m[0] ?? []));

        $unknownTags = array_values(array_filter($contentTags, fn($tag) => !in_array($tag, $knownKeys)));
        $fields = array_map(fn($t) => trim($t, '{}'), $unknownTags);

        return response()->json(['fields' => $fields]);
    }

    // ── DOCX ─────────────────────────────────────────────────────────────────────

    public function uploadDocx(Request $request, FinancingContractTemplate $financingContractTemplate)
    {
        $this->authorizeTemplate($financingContractTemplate);

        $request->validate([
            'docx_file' => 'required|file|mimes:docx,zip|max:20480',
        ]);

        try {
            $vars = $this->docxManager->upload($request->file('docx_file'), $financingContractTemplate);
        } catch (\InvalidArgumentException $e) {
            return back()->withErrors(['docx_file' => $e->getMessage()]);
        } catch (\Throwable $e) {
            return back()->withErrors(['docx_file' => 'Erreur lors de l\'upload : ' . $e->getMessage()]);
        }

        $count = count($vars);
        return back()->with('success', "Template DOCX uploadé — {$count} variable(s) détectée(s) : " . implode(', ', $vars));
    }

    public function downloadDocx(FinancingContractTemplate $financingContractTemplate)
    {
        $this->authorizeTemplate($financingContractTemplate);

        if (!$financingContractTemplate->docx_template_path) {
            abort(404, 'Aucun template DOCX disponible pour ce modèle.');
        }

        $absPath = storage_path('app/' . $financingContractTemplate->docx_template_path);
        if (!file_exists($absPath)) {
            abort(404, 'Fichier DOCX introuvable.');
        }

        return response()->download(
            $absPath,
            Str::slug($financingContractTemplate->name) . '_v' . $financingContractTemplate->docx_version . '.docx'
        );
    }

    /**
     * Génère et télécharge un DOCX de prévisualisation avec données de démonstration.
     */
    public function previewDocx(FinancingContractTemplate $financingContractTemplate)
    {
        $this->authorizeTemplate($financingContractTemplate);

        if (!$financingContractTemplate->hasDocxTemplate()) {
            abort(404, 'Aucun template DOCX uploadé.');
        }

        try {
            $path = $this->docxService->generateContractPreview($financingContractTemplate);
        } catch (\Throwable $e) {
            abort(500, 'Génération aperçu DOCX impossible : ' . $e->getMessage());
        }

        return response()->download(
            $path,
            Str::slug($financingContractTemplate->name) . '-preview.docx'
        )->deleteFileAfterSend(true);
    }

    /**
     * Vérifie qu'un admin classique a bien accès à ce modèle : modèle par défaut
     * ou explicitement assigné à lui. Bypass pour le super-admin.
     */
    private function authorizeTemplate(FinancingContractTemplate $financingContractTemplate): void
    {
        $user = Auth::user();
        if ($user->hasRole('super-admin')) return;

        $hasAccess = $financingContractTemplate->is_default
            || $financingContractTemplate->assignedAdmins()->where('users.id', $user->id)->exists();
        abort_unless($hasAccess, 403, 'Accès non autorisé à ce modèle.');
    }

    /**
     * Variables disponibles pour un dossier de financement — le référentiel partagé
     * avec les modèles "Prêt" inclut des balises de remboursement (durée, taux,
     * mensualité) sans objet ici puisqu'un financement n'est pas remboursable.
     */
    private function financingVariableDescriptions(): array
    {
        return array_diff_key(
            $this->contractService->variableDescriptions(),
            array_flip(['{duree}', '{taux}', '{mensualite}', '{montant_mensualite}', '{montant_totalavecinteret}'])
        );
    }
}
