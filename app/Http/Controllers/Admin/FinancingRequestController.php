<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\FinancingFinalizedMail;
use App\Mail\FinancingRejectedMail;
use App\Mail\FinancingSignedAcknowledgementMail;
use App\Mail\FinancingValidatedMail;
use App\Mail\FinancingValidationNotificationMail;
use App\Models\FinancingContractTemplate;
use App\Models\FinancingNotificationTemplate;
use App\Models\FinancingRequest;
use App\Models\FinancingRequestHistory;
use App\Models\User;
use App\Services\FinancingDocxService;
use App\Services\FinancingVariableResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FinancingRequestController extends Controller
{
    public function __construct(
        private FinancingDocxService     $docxService,
        private FinancingVariableResolver $variableResolver,
    ) {}

    public function index(Request $request)
    {
        $admin        = Auth::user();
        $isSuperAdmin = $admin->hasRole('super-admin');

        // Super-admin voit tous les dossiers; admin régulier voit les siens
        $query = FinancingRequest::with(['client', 'admin']);
        if (! $isSuperAdmin) {
            $query->where('admin_id', $admin->id);
        }

        // Filtre par admin (super-admin uniquement)
        if ($isSuperAdmin && $request->filled('admin_id')) {
            $query->where('admin_id', $request->admin_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('financing_type')) {
            $query->where('financing_type', $request->financing_type);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('reference', 'like', "%$search%");
            });
        }

        $financings = $query->latest()->paginate(15)->appends($request->query());

        $base = $isSuperAdmin ? FinancingRequest::query() : FinancingRequest::where('admin_id', $admin->id);
        $stats = [
            'total'           => (clone $base)->count(),
            'draft'           => (clone $base)->where('status', 'draft')->count(),
            'pending'         => (clone $base)->where('status', 'pending')->count(),
            'validated'       => (clone $base)->where('status', 'validated')->count(),
            'contract_sent'   => (clone $base)->where('status', 'contract_sent')->count(),
            'contract_signed' => (clone $base)->where('status', 'contract_signed')->count(),
            'finalized'       => (clone $base)->where('status', 'finalized')->count(),
            'rejected'        => (clone $base)->where('status', 'rejected')->count(),
        ];

        $admins = $isSuperAdmin
            ? User::where('type', 'staff')
                  ->whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'super-admin']))
                  ->orderBy('name')->get()
            : collect();

        return view('admin.financings.index', compact('financings', 'stats', 'isSuperAdmin', 'admins'));
    }

    public function create()
    {
        $admin      = Auth::user();
        $myClients  = $this->clientsForAdmin($admin);
        $templates  = $this->templatesForAdmin($admin);
        $currencies = config('credixa.currencies');
        $financingTypes = FinancingRequest::FINANCING_TYPES;

        return view('admin.financings.create', compact('myClients', 'templates', 'currencies', 'financingTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // Client
            'client_mode'       => 'required|in:existing,new',
            'client_id'         => 'required_if:client_mode,existing|nullable|exists:users,id',
            'client_name'       => 'required_if:client_mode,new|nullable|string|max:255',
            'client_email'      => 'required_if:client_mode,new|nullable|email|unique:users,email',
            'client_phone'      => 'nullable|string|max:50',
            'client_address'    => 'nullable|string|max:500',
            'client_locale'     => 'nullable|in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,sk,el',
            'client_currency'   => 'nullable|string|max:10',
            // Financement (non remboursable : pas de durée ni de taux)
            'amount'            => 'required|numeric|min:100',
            'objet'             => 'nullable|string|max:255',
            'financing_type'    => 'nullable|in:' . implode(',', array_keys(FinancingRequest::FINANCING_TYPES)),
            'subject'           => 'nullable|string|max:2000',
            'start_date'        => 'nullable|date',
            'currency'          => 'required|string|max:10',
            'admin_fees'        => 'nullable|numeric|min:0',
            'bank_account'      => 'nullable|string|max:255',
            'agent_suivi'       => 'nullable|string|max:255',
            'directeur'         => 'nullable|string|max:255',
            'notaire'           => 'nullable|string|max:255',
            'special_conditions'=> 'nullable|string',
            'contract_template_id' => 'nullable|exists:financing_contract_templates,id',
            'extra_fields'      => 'nullable|array',
            'extra_fields.*'    => 'nullable|string|max:500',
            'files'             => 'nullable|array|max:10',
            'files.*'           => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:20480',
        ], [
            'client_email.unique' => 'Cet email est déjà utilisé dans le système. Passez en mode "Client existant" pour sélectionner ce client.',
            'client_name.required_if'  => 'Le nom du client est obligatoire pour un nouveau client.',
            'client_email.required_if' => 'L\'email du client est obligatoire pour un nouveau client.',
            'client_id.required_if'    => 'Veuillez sélectionner un client existant.',
            'amount.required'          => 'Le montant est obligatoire.',
        ]);

        $admin = Auth::user();

        if ($data['client_mode'] === 'existing') {
            $client = User::findOrFail($data['client_id']);
            if (!$admin->hasRole('super-admin')) {
                abort_unless($client->created_by === $admin->id, 403, 'Client non autorisé.');
            }
        }

        $financing = DB::transaction(
            function () use ($data, $admin) {
                if ($data['client_mode'] === 'new') {
                    $token  = Str::random(64);
                    $client = User::create([
                        'name'             => $data['client_name'],
                        'email'            => $data['client_email'],
                        'password'         => Hash::make(Str::random(32)),
                        'type'             => 'client',
                        'created_by'       => $admin->id,
                        'invitation_token' => $token,
                        'phone'            => $data['client_phone'] ?? null,
                        'address'          => $data['client_address'] ?? null,
                        'locale'           => $data['client_locale'] ?? 'fr',
                        'currency'         => $data['client_currency'] ?? $data['currency'],
                    ]);
                    $client->assignRole('client');
                } else {
                    $client = User::findOrFail($data['client_id']);
                }

                $locale = $client->locale ?? 'fr';

                $financing = FinancingRequest::create([
                    'reference'            => FinancingRequest::generateReference(),
                    'archive_ref'          => 'FIN-ARCH-' . strtoupper(Str::random(8)),
                    'admin_id'             => $admin->id,
                    'client_id'            => $client->id,
                    'contract_template_id' => $data['contract_template_id'] ?? null,
                    'name'                 => $client->name,
                    'email'                => $client->email,
                    'phone'                => $client->phone ?? $data['client_phone'] ?? null,
                    'address'              => $client->address ?? $data['client_address'] ?? null,
                    'amount'               => $data['amount'],
                    'currency'             => $client->currency ?? $data['currency'],
                    'start_date'           => $data['start_date'] ?? now()->toDateString(),
                    'objet'                => $data['objet'] ?? null,
                    'financing_type'       => $data['financing_type'] ?? null,
                    'subject'              => $data['subject'] ?? null,
                    'special_conditions'   => $data['special_conditions'] ?? null,
                    'admin_fees'           => $data['admin_fees'] ?? null,
                    'bank_account'         => $data['bank_account'] ?? null,
                    'agent_suivi'          => $data['agent_suivi'] ?? null,
                    'directeur'            => $data['directeur'] ?? null,
                    'notaire'              => $data['notaire'] ?? null,
                    'contract_language'    => $locale,
                    'status'               => FinancingRequest::STATUS_DRAFT,
                    'extra_fields'         => !empty($data['extra_fields']) ? $data['extra_fields'] : null,
                ]);

                $this->logHistory($financing, 'created', null, ['status' => $financing->status]);

                return $financing;
            }
        );

        return redirect()->route($this->panelPrefix().'.financings.show', $financing)
                         ->with('success', 'Dossier N°' . $financing->reference . ' créé (statut : Brouillon).');
    }

    public function show(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);
        $financing->load(['client', 'admin', 'history.admin', 'contractTemplate']);
        $isSuperAdmin = Auth::user()->hasRole('super-admin');
        $admins       = $isSuperAdmin
            ? User::where('type', 'staff')
                ->whereHas('roles', fn($q) => $q->whereIn('name', ['admin', 'super-admin']))
                ->orderBy('name')->get()
            : collect();

        return view('admin.financings.show', compact('financing', 'isSuperAdmin', 'admins'));
    }

    public function edit(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);
        abort_unless($financing->isEditable(), 403, 'Ce dossier ne peut plus être modifié.');

        $admin      = Auth::user();
        $myClients  = $this->clientsForAdmin($admin);
        $currencies = config('credixa.currencies');
        $templates  = $this->templatesForAdmin($admin);
        $financingTypes = FinancingRequest::FINANCING_TYPES;

        return view('admin.financings.edit', compact('financing', 'myClients', 'currencies', 'templates', 'financingTypes'));
    }

    public function update(Request $request, FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);
        abort_unless($financing->isEditable(), 403);

        $data = $request->validate([
            'amount'               => 'required|numeric|min:100',
            'objet'                => 'nullable|string|max:255',
            'financing_type'       => 'nullable|in:' . implode(',', array_keys(FinancingRequest::FINANCING_TYPES)),
            'subject'              => 'nullable|string|max:2000',
            'start_date'           => 'nullable|date',
            'currency'             => 'required|string|max:10',
            'admin_fees'           => 'nullable|numeric|min:0',
            'frais_assurance'      => 'nullable|numeric|min:0',
            'date_fin_assurance'   => 'nullable|date',
            'bank_account'         => 'nullable|string|max:255',
            'agent_suivi'          => 'nullable|string|max:255',
            'directeur'            => 'nullable|string|max:255',
            'notaire'              => 'nullable|string|max:255',
            'special_conditions'   => 'nullable|string',
            'contract_template_id' => 'nullable|exists:financing_contract_templates,id',
            'contract_language'    => 'nullable|in:fr,en,pl,es,bg,hu,it,de,lt,ro,lv,nl,pt,sk,el',
            'extra_fields'         => 'nullable|array',
            'extra_fields.*'       => 'nullable|string|max:500',
        ]);

        $old = $financing->only(['amount', 'status', 'contract_template_id']);

        $financing->update(array_merge($data, [
            'contract_language'    => $data['contract_language'] ?? $financing->contract_language ?? 'fr',
            'extra_fields'         => !empty($data['extra_fields']) ? $data['extra_fields'] : null,
        ]));

        $this->logHistory($financing, 'updated', $old, $financing->only(['amount', 'status', 'contract_template_id']));

        return redirect()->route($this->panelPrefix().'.financings.show', $financing)
                         ->with('success', 'Dossier mis à jour.');
    }

    public function destroy(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);
        $financing->delete();
        return back()->with('success', 'Dossier supprimé.');
    }

    // ── Documents : contrat ──────────────────────────────────────────────────────

    public function contractViewer(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);
        if (!$financing->contract_pdf_path) {
            return back()->with('error', 'Aucun PDF de contrat disponible pour ce dossier.');
        }
        return view('admin.financings.contract-viewer', compact('financing'));
    }

    public function previewPdf(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);

        if (!$financing->contract_pdf_path) {
            return back()->with('error', 'Aucun PDF uploadé pour ce dossier.');
        }

        $absPath = storage_path('app/private/' . $financing->contract_pdf_path);
        if (!file_exists($absPath)) {
            return back()->with('error', 'Fichier PDF introuvable sur le serveur.');
        }

        return response()->file($absPath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Contrat_' . $financing->reference . '.pdf"',
        ]);
    }

    public function uploadContractPdf(Request $request, FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);

        $request->validate([
            'contract_pdf' => 'required|file|mimes:pdf|max:20480',
        ], [
            'contract_pdf.required' => 'Veuillez sélectionner un fichier PDF.',
            'contract_pdf.mimes'    => 'Seuls les fichiers PDF sont acceptés.',
            'contract_pdf.max'      => 'Le fichier PDF ne doit pas dépasser 20 Mo.',
        ]);

        if ($financing->contract_pdf_path) {
            $old = storage_path('app/private/' . $financing->contract_pdf_path);
            if (file_exists($old)) {
                @unlink($old);
            }
        }

        $file    = $request->file('contract_pdf');
        $relPath = 'financing-contract-pdfs/' . $financing->id . '/' . $financing->reference . '.pdf';
        $absDir  = storage_path('app/private/financing-contract-pdfs/' . $financing->id);

        if (!is_dir($absDir)) {
            mkdir($absDir, 0755, true);
        }

        $file->move($absDir, $financing->reference . '.pdf');

        $financing->update(['contract_pdf_path' => $relPath]);

        $this->logHistory($financing, 'pdf_uploaded', [], ['pdf' => $relPath]);

        return back()->with('success', 'PDF du contrat uploadé avec succès. Il sera joint à l\'email envoyé au client.');
    }

    /**
     * Génère à la volée le DOCX du contrat rempli pour ce dossier, à partir du
     * modèle assigné (ou par défaut). L'admin le convertit lui-même en PDF puis
     * l'uploade via uploadContractPdf().
     */
    public function downloadDocx(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);

        $template = $financing->contractTemplate
            ?? FinancingContractTemplate::where('is_default', true)->first();

        if (!$template || !$template->hasDocxTemplate()) {
            return back()->with('error', 'Aucun template DOCX disponible pour ce dossier. Uploadez un template DOCX depuis "Modèles de contrat — Financement".');
        }

        $locale = $financing->contract_language ?? 'fr';

        try {
            $path = $this->docxService->generateContract($financing, $template, $locale);
        } catch (\Throwable $e) {
            return back()->with('error', 'Génération DOCX impossible : ' . $e->getMessage());
        }

        return response()->download($path, 'Contrat_' . $financing->reference . '.docx')->deleteFileAfterSend(true);
    }

    // ── Documents : notification ─────────────────────────────────────────────────

    public function downloadNotificationDocx(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);

        $template = FinancingNotificationTemplate::resolveForFinancing($financing);

        if (!$template || !$template->hasDocxTemplate()) {
            return back()->with('error', 'Aucun template DOCX de notification disponible pour la langue de ce dossier. Uploadez-en un depuis "Modèles de notification — Financement".');
        }

        $locale = $financing->contract_language ?? 'fr';

        try {
            $path = $this->docxService->generateNotification($financing, $template, $locale);
        } catch (\Throwable $e) {
            return back()->with('error', 'Génération DOCX de notification impossible : ' . $e->getMessage());
        }

        return response()->download($path, 'Notification_' . $financing->reference . '.docx')->deleteFileAfterSend(true);
    }

    public function uploadNotificationPdf(Request $request, FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);

        $request->validate([
            'notification_pdf' => 'required|file|mimes:pdf|max:20480',
        ], [
            'notification_pdf.required' => 'Veuillez sélectionner un fichier PDF.',
            'notification_pdf.mimes'    => 'Seuls les fichiers PDF sont acceptés.',
            'notification_pdf.max'      => 'Le fichier PDF ne doit pas dépasser 20 Mo.',
        ]);

        if ($financing->notification_pdf_path) {
            $old = storage_path('app/private/' . $financing->notification_pdf_path);
            if (file_exists($old)) {
                @unlink($old);
            }
        }

        $file    = $request->file('notification_pdf');
        $relPath = 'financing-notification-pdfs/' . $financing->id . '/' . $financing->reference . '_notification.pdf';
        $absDir  = storage_path('app/private/financing-notification-pdfs/' . $financing->id);

        if (!is_dir($absDir)) {
            mkdir($absDir, 0755, true);
        }

        $file->move($absDir, $financing->reference . '_notification.pdf');

        $financing->update(['notification_pdf_path' => $relPath]);

        $this->logHistory($financing, 'notification_pdf_uploaded', [], ['pdf' => $relPath]);

        return back()->with('success', 'Document de notification uploadé avec succès. Il débloque le bouton "Valider".');
    }

    public function previewNotificationPdf(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);

        if (!$financing->notification_pdf_path) {
            return back()->with('error', 'Aucun document de notification uploadé pour ce dossier.');
        }

        $absPath = storage_path('app/private/' . $financing->notification_pdf_path);
        if (!file_exists($absPath)) {
            return back()->with('error', 'Fichier PDF introuvable sur le serveur.');
        }

        return response()->file($absPath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Notification_' . $financing->reference . '.pdf"',
        ]);
    }

    // ── Cycle de statut ───────────────────────────────────────────────────────────

    public function validateFinancing(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);
        abort_unless($financing->canBeValidated(), 403, 'Ce dossier ne peut pas être validé.');

        if ($error = $this->sendValidationNotification($financing)) {
            return back()->with('error', $error);
        }

        return redirect()->route($this->panelPrefix().'.financings.show', $financing)
            ->with('success', 'Dossier validé — notification envoyée à ' . $this->recipientEmail($financing) . '.');
    }

    public function sendContract(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);
        abort_unless($financing->canSendContract(), 403, 'Le contrat ne peut être envoyé que pour un dossier validé.');

        if ($error = $this->sendContractStep($financing)) {
            return back()->with('error', $error);
        }

        return redirect()->route($this->panelPrefix().'.financings.show', $financing)
            ->with('success', 'Contrat envoyé à ' . $this->recipientEmail($financing) . '.');
    }

    public function markSigned(FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);

        $old = ['status' => $financing->status];
        $financing->update([
            'status'             => FinancingRequest::STATUS_CONTRACT_SIGNED,
            'signed_received_at' => now(),
        ]);

        $locale    = $financing->contract_language ?? 'fr';
        $recipient = $this->recipientEmail($financing);
        $mailSent  = true;
        try {
            Mail::to($recipient)->send(new FinancingSignedAcknowledgementMail($financing, $locale));
        } catch (\Throwable $e) {
            Log::error('FinancingSignedAcknowledgementMail failed for ' . $financing->reference . ': ' . $e->getMessage());
            $mailSent = false;
        }

        $this->logHistory($financing, 'signed_received', $old, ['status' => $financing->status]);

        $msg = 'Contrat signé marqué comme reçu.';
        $msg .= $mailSent ? ' Email envoyé au client.' : ' (Email non envoyé — vérifiez la configuration mail.)';

        return back()->with('success', $msg);
    }

    public function updateStatus(Request $request, FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);
        $data = $request->validate([
            'status' => 'required|in:' . implode(',', FinancingRequest::STATUSES),
        ]);

        if (in_array($data['status'], [FinancingRequest::STATUS_FINALIZED, FinancingRequest::STATUS_REJECTED], true)) {
            return back()->with('error', 'Utilisez le bouton dédié ("Finaliser" ou "Rejeter le dossier") pour ce changement de statut.');
        }

        $old = ['status' => $financing->status];

        if ($data['status'] === FinancingRequest::STATUS_VALIDATED && $old['status'] !== FinancingRequest::STATUS_VALIDATED) {
            if ($error = $this->sendValidationNotification($financing)) {
                return back()->with('error', $error);
            }

            return redirect()->route($this->panelPrefix().'.financings.show', $financing)
                ->with('success', 'Dossier validé — notification envoyée à ' . $this->recipientEmail($financing) . '.');
        }

        if ($data['status'] === FinancingRequest::STATUS_CONTRACT_SENT && $old['status'] !== FinancingRequest::STATUS_CONTRACT_SENT) {
            if ($error = $this->sendContractStep($financing)) {
                return back()->with('error', $error);
            }

            return redirect()->route($this->panelPrefix().'.financings.show', $financing)
                ->with('success', 'Contrat envoyé à ' . $this->recipientEmail($financing) . '.');
        }

        $financing->update(['status' => $data['status']]);
        $this->logHistory($financing, 'status_changed', $old, ['status' => $data['status']]);

        return back()->with('success', 'Statut mis à jour.');
    }

    /**
     * Finalise le dossier : exige "Contrat signé" comme statut de départ, permet de
     * choisir la date de versement et de créditer (ou non) le compte client d'un
     * montant modifiable — financement non remboursable, aucun échéancier associé.
     * Envoie un email au client dans la langue du dossier.
     */
    public function finalize(Request $request, FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);

        if (!$financing->canBeFinalized()) {
            return back()->with('error', 'Impossible de finaliser : le contrat doit d\'abord être signé (statut "Contrat signé").');
        }

        $data = $request->validate([
            'disbursement_date' => 'required|date',
            'credit_account'    => 'nullable|boolean',
            'credit_amount'     => 'nullable|numeric|min:0',
        ]);

        $creditAccount = $request->boolean('credit_account');
        $creditAmount  = $creditAccount
            ? (float) ($data['credit_amount'] ?? $financing->amount)
            : 0.0;

        $old = ['status' => $financing->status];
        $alreadyFinalized = false;

        DB::transaction(function () use ($financing, $data, $old, $creditAccount, $creditAmount, &$alreadyFinalized) {
            $fresh = FinancingRequest::lockForUpdate()->find($financing->id);
            if ($fresh->status === FinancingRequest::STATUS_FINALIZED) {
                $alreadyFinalized = true;
                return;
            }

            $fresh->update([
                'status'       => FinancingRequest::STATUS_FINALIZED,
                'finalized_at' => now(),
                'start_date'   => $data['disbursement_date'],
            ]);

            if ($creditAccount && $fresh->client_id) {
                $fresh->client?->increment('balance', $creditAmount);
            }

            $this->logHistory($fresh, 'finalized', $old, [
                'status'          => $fresh->status,
                'credited'        => $creditAccount,
                'credited_amount' => $creditAmount,
            ]);
        });

        $financing->refresh();

        if ($alreadyFinalized) {
            return redirect()->route($this->panelPrefix().'.financings.show', $financing)
                ->with('success', 'Dossier déjà finalisé.');
        }

        if ($financing->client_id) {
            try {
                Mail::to($this->recipientEmail($financing))->send(new FinancingFinalizedMail(
                    $financing,
                    \Illuminate\Support\Carbon::parse($data['disbursement_date'])->format('d/m/Y'),
                    $creditAccount,
                    $creditAmount
                ));
            } catch (\Throwable $e) {
                Log::error('FinancingFinalizedMail failed for ' . $financing->reference . ': ' . $e->getMessage());
                return redirect()->route($this->panelPrefix().'.financings.show', $financing)
                    ->with('success', 'Dossier finalisé. (Email non envoyé — vérifiez la configuration mail.)');
            }
        }

        return redirect()->route($this->panelPrefix().'.financings.show', $financing)
            ->with('success', 'Dossier finalisé' . ($creditAccount ? ' et compte crédité' : '') . '.');
    }

    /**
     * Rejette le dossier avec un motif obligatoire, et envoie un email au client
     * dans la langue du dossier incluant ce motif.
     */
    public function reject(Request $request, FinancingRequest $financing)
    {
        $this->authorizeAccess($financing);

        $data = $request->validate([
            'rejection_reason' => 'required|string|max:2000',
        ]);

        $old = ['status' => $financing->status];

        $financing->update([
            'status'           => FinancingRequest::STATUS_REJECTED,
            'rejected_at'      => now(),
            'rejection_reason' => $data['rejection_reason'],
        ]);

        $this->logHistory($financing, 'rejected', $old, ['status' => $financing->status, 'reason' => $data['rejection_reason']]);

        $mailSent = true;
        if ($financing->client_id) {
            try {
                Mail::to($this->recipientEmail($financing))->send(new FinancingRejectedMail($financing, $data['rejection_reason']));
            } catch (\Throwable $e) {
                Log::error('FinancingRejectedMail failed for ' . $financing->reference . ': ' . $e->getMessage());
                $mailSent = false;
            }
        }

        $msg = 'Dossier rejeté.';
        $msg .= $mailSent ? ' Email envoyé au client.' : ' (Email non envoyé — vérifiez la configuration mail.)';

        return redirect()->route($this->panelPrefix().'.financings.show', $financing)->with('success', $msg);
    }

    public function assignAdmin(Request $request, FinancingRequest $financing)
    {
        abort_unless(Auth::user()->hasRole('super-admin'), 403);

        $data = $request->validate([
            'admin_id' => 'required|exists:users,id',
        ]);

        $admin = User::findOrFail($data['admin_id']);
        abort_unless(
            $admin->hasRole('admin') || $admin->hasRole('super-admin'),
            422,
            'L\'utilisateur sélectionné n\'est pas un administrateur.'
        );

        $old = ['admin_id' => $financing->admin_id, 'admin_name' => $financing->admin?->name];
        $financing->update(['admin_id' => $admin->id]);
        $this->logHistory($financing, 'admin_assigned', $old, ['admin_id' => $admin->id, 'admin_name' => $admin->name]);

        return back()->with('success', "Dossier réaffecté à {$admin->name}.");
    }

    private function clientsForAdmin(User $admin): \Illuminate\Support\Collection
    {
        if ($admin->hasRole('super-admin')) {
            return User::where('type', 'client')->orderBy('name')->get();
        }
        return User::where('type', 'client')
                   ->where('created_by', $admin->id)
                   ->orderBy('name')->get();
    }

    private function templatesForAdmin(User $admin): \Illuminate\Support\Collection
    {
        if ($admin->hasRole('super-admin')) {
            return FinancingContractTemplate::orderBy('name')->get();
        }
        $assigned = $admin->assignedFinancingTemplates()->orderBy('name')->get();
        if ($assigned->isEmpty()) {
            return FinancingContractTemplate::where('is_default', true)->get();
        }
        return $assigned;
    }

    private function authorizeAccess(FinancingRequest $financing): void
    {
        $user = Auth::user();
        if ($user->hasRole('super-admin')) return;
        abort_unless($financing->admin_id === $user->id, 403, 'Accès non autorisé.');
    }

    /**
     * Préfixe de route ('admin' ou 'super-admin') selon le panneau depuis lequel
     * la requête courante a été faite — pour rediriger vers le bon contexte.
     */
    private function panelPrefix(): string
    {
        return request()->routeIs('super-admin.*') ? 'super-admin' : 'admin';
    }

    private function logHistory(FinancingRequest $financing, string $action, ?array $old, ?array $new): void
    {
        FinancingRequestHistory::create([
            'financing_request_id' => $financing->id,
            'admin_id'             => Auth::id(),
            'action'               => $action,
            'old_value'            => $old,
            'new_value'            => $new,
        ]);
    }

    /**
     * Retourne l'email actuel du client lié au dossier.
     * Priorité : email du compte User (toujours à jour) → email copié sur le dossier.
     */
    private function recipientEmail(FinancingRequest $financing): string
    {
        return $financing->client?->email ?? $financing->email;
    }

    /**
     * Envoie le mail de notification (modèle sélectionné selon la langue du client)
     * et passe le dossier au statut "validated". Retourne un message d'erreur si
     * l'envoi n'a pas pu avoir lieu, ou null en cas de succès.
     */
    private function sendValidationNotification(FinancingRequest $financing): ?string
    {
        $notificationPdfAbs = $financing->notification_pdf_path
            ? storage_path('app/private/' . $financing->notification_pdf_path)
            : null;

        if (!$notificationPdfAbs || !file_exists($notificationPdfAbs)) {
            return 'Impossible de valider : aucun document de notification n\'a été uploadé pour ce dossier. '
                . 'Générez le DOCX, convertissez-le en PDF et uploadez-le (section "Documents").';
        }

        $locale   = $financing->contract_language ?? 'fr';
        $template = FinancingNotificationTemplate::resolveForFinancing($financing);

        if (!$template) {
            return 'Impossible de valider : aucun modèle de notification n\'est configuré (langue '
                . strtoupper($locale) . ' ni FR). Créez-en un depuis "Modèles de notification — Financement".';
        }

        $vars      = $this->variableResolver->resolveRaw($financing, $locale);
        $subject   = str_replace(array_keys($vars), array_values($vars), $template->subject);
        $body      = str_replace(array_keys($vars), array_values($vars), $template->content ?? '');
        $recipient = $this->recipientEmail($financing);

        try {
            Mail::to($recipient)->send(
                new FinancingValidationNotificationMail($financing, $subject, $body, $notificationPdfAbs)
            );
        } catch (\Throwable $e) {
            Log::error('FinancingValidationNotificationMail failed for ' . $financing->reference . ': ' . $e->getMessage());
            return 'Erreur lors de l\'envoi de la notification : ' . $e->getMessage();
        }

        $old = ['status' => $financing->status];
        $financing->update([
            'status'       => FinancingRequest::STATUS_VALIDATED,
            'validated_at' => now(),
        ]);

        $this->logHistory($financing, 'validated', $old, ['status' => $financing->status, 'locale' => $locale, 'recipient' => $recipient]);

        return null;
    }

    /**
     * Envoie le contrat (FinancingValidatedMail) et passe le dossier au statut
     * "contract_sent". Retourne un message d'erreur ou null en cas de succès.
     */
    private function sendContractStep(FinancingRequest $financing): ?string
    {
        $contractPdfAbs = $financing->contract_pdf_path
            ? storage_path('app/private/' . $financing->contract_pdf_path)
            : null;

        if (!$contractPdfAbs || !file_exists($contractPdfAbs)) {
            return 'Impossible d\'envoyer le contrat : aucun contrat PDF n\'a été uploadé pour ce dossier.';
        }

        $content = $this->resolveContractSentContent($financing);
        if (!$content) {
            $locale = strtoupper($financing->contract_language ?? 'fr');
            return "Impossible d'envoyer le contrat : aucun modèle d'email \"Contrat envoyé\" n'est configuré (langue $locale ni FR). Créez-en un depuis \"Modèles de notification — Financement\".";
        }

        $old       = ['status' => $financing->status];
        $locale    = $financing->contract_language ?? 'fr';
        $recipient = $this->recipientEmail($financing);

        try {
            Mail::to($recipient)->send(
                new FinancingValidatedMail($financing, $content['subject'], $content['body'], $contractPdfAbs)
            );
        } catch (\Throwable $e) {
            Log::error('FinancingValidatedMail failed for ' . $financing->reference . ': ' . $e->getMessage());
        }

        $financing->update([
            'status'  => FinancingRequest::STATUS_CONTRACT_SENT,
            'sent_at' => now(),
        ]);

        $this->logHistory($financing, 'validated_and_sent', $old, ['status' => $financing->status, 'locale' => $locale, 'recipient' => $recipient]);

        return null;
    }

    /**
     * Résout le sujet et le corps HTML de l'email "contrat envoyé" à partir du
     * modèle configuré pour la langue du dossier. Retourne null si aucun modèle
     * n'est configuré (ni pour la langue du dossier, ni en repli FR).
     */
    private function resolveContractSentContent(FinancingRequest $financing): ?array
    {
        $template = FinancingNotificationTemplate::resolveForFinancing($financing, FinancingNotificationTemplate::TYPE_CONTRACT_SENT);
        if (!$template) {
            return null;
        }

        $vars = $this->variableResolver->resolveRaw($financing, $financing->contract_language ?? 'fr');

        return [
            'subject' => str_replace(array_keys($vars), array_values($vars), $template->subject),
            'body'    => str_replace(array_keys($vars), array_values($vars), $template->content ?? ''),
        ];
    }
}
