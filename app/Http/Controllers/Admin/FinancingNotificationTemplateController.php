<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancingNotificationTemplate;
use App\Services\ContractService;
use App\Services\FinancingDocxTemplateManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FinancingNotificationTemplateController extends Controller
{
    public function __construct(
        private ContractService              $contractService,
        private FinancingDocxTemplateManager  $docxManager,
    ) {}

    public function index(Request $request)
    {
        $type           = $request->get('type', FinancingNotificationTemplate::TYPE_VALIDATION);
        $templates      = FinancingNotificationTemplate::with('creator')->where('type', $type)->orderBy('locale')->get();
        $localeLabels   = $this->localeLabels();
        $configured     = $templates->pluck('locale')->all();
        $missingLocales = array_diff(array_keys($localeLabels), $configured);

        return view('admin.financing-notification-templates.index', compact('templates', 'missingLocales', 'localeLabels', 'type'));
    }

    public function create()
    {
        return view('admin.financing-notification-templates.create', [
            'localeLabels' => $this->localeLabels(),
            'types'        => FinancingNotificationTemplate::TYPES,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'type'    => 'required|in:' . implode(',', array_keys(FinancingNotificationTemplate::TYPES)),
            'locale'  => ['required', 'in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,sk,el',
                Rule::unique('financing_notification_templates')->where(fn($q) => $q->where('type', $request->type)),
            ],
            'subject' => 'nullable|required_unless:type,' . FinancingNotificationTemplate::TYPE_CONDITIONS . '|string|max:255',
        ]);

        $template = FinancingNotificationTemplate::create([
            'name'       => $data['name'],
            'type'       => $data['type'],
            'locale'     => $data['locale'],
            'subject'    => $data['subject'] ?? null,
            'content'    => '',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.financing-notification-templates.edit', $template)
                         ->with('success', 'Modèle créé. Rédigez maintenant son contenu.');
    }

    public function edit(FinancingNotificationTemplate $financingNotificationTemplate)
    {
        return view('admin.financing-notification-templates.edit', [
            'template'  => $financingNotificationTemplate,
            'variables' => $this->financingVariableDescriptions(),
            'types'     => FinancingNotificationTemplate::TYPES,
        ]);
    }

    public function update(Request $request, FinancingNotificationTemplate $financingNotificationTemplate)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'type'    => 'required|in:' . implode(',', array_keys(FinancingNotificationTemplate::TYPES)),
            'locale'  => ['required', 'in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,sk,el',
                Rule::unique('financing_notification_templates')
                    ->where(fn($q) => $q->where('type', $request->type))
                    ->ignore($financingNotificationTemplate->id),
            ],
            'subject' => 'nullable|required_unless:type,' . FinancingNotificationTemplate::TYPE_CONDITIONS . '|string|max:255',
            'content' => 'nullable|string',
        ]);

        $data['subject'] = $data['subject'] ?? null;

        $financingNotificationTemplate->update($data);

        return redirect()->route('admin.financing-notification-templates.edit', $financingNotificationTemplate)
                         ->with('success', 'Modèle mis à jour.');
    }

    public function destroy(FinancingNotificationTemplate $financingNotificationTemplate)
    {
        $financingNotificationTemplate->delete();
        return back()->with('success', 'Modèle supprimé.');
    }

    public function uploadDocx(Request $request, FinancingNotificationTemplate $financingNotificationTemplate)
    {
        $request->validate([
            'docx_file' => 'required|file|mimes:docx,zip|max:20480',
        ]);

        try {
            $vars = $this->docxManager->upload($request->file('docx_file'), $financingNotificationTemplate);
        } catch (\InvalidArgumentException $e) {
            return back()->withErrors(['docx_file' => $e->getMessage()]);
        } catch (\Throwable $e) {
            return back()->withErrors(['docx_file' => 'Erreur lors de l\'upload : ' . $e->getMessage()]);
        }

        $count = count($vars);
        return back()->with('success', "Template DOCX uploadé — {$count} variable(s) détectée(s) : " . implode(', ', $vars));
    }

    public function downloadDocx(FinancingNotificationTemplate $financingNotificationTemplate)
    {
        if (!$financingNotificationTemplate->docx_template_path) {
            abort(404, 'Aucun template DOCX disponible pour ce modèle.');
        }

        $absPath = storage_path('app/' . $financingNotificationTemplate->docx_template_path);
        if (!file_exists($absPath)) {
            abort(404, 'Fichier DOCX introuvable.');
        }

        return response()->download(
            $absPath,
            Str::slug($financingNotificationTemplate->name) . '_v' . $financingNotificationTemplate->docx_version . '.docx'
        );
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

    private function localeLabels(): array
    {
        return [
            'fr' => 'Français', 'en' => 'Anglais', 'pl' => 'Polonais', 'es' => 'Espagnol',
            'bg' => 'Bulgare', 'hu' => 'Hongrois', 'it' => 'Italien', 'de' => 'Allemand',
            'lt' => 'Lituanien', 'ro' => 'Roumain', 'lv' => 'Letton', 'nl' => 'Néerlandais',
            'pt' => 'Portugais', 'sk' => 'Slovaque', 'el' => 'Grec',
        ];
    }
}
