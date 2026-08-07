@extends('layouts.dashboard')
@section('title', $financing->reference)
@section('page_title', 'Dossier de financement')

@push('styles')
<style>
.fs-header{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.5rem}
.fs-ref{font-family:monospace;font-weight:800;font-size:1.15rem;color:var(--c-navy)}
.fs-archive{font-size:.72rem;color:var(--c-muted);font-family:monospace;margin-top:.15rem}
.fs-actions{display:flex;gap:.5rem;flex-wrap:wrap}

.fs-info-row{display:flex;justify-content:space-between;align-items:center;padding:.55rem 0;border-bottom:1px solid #f3f4f6;font-size:.83rem}
.fs-info-row:last-child{border-bottom:none}
.fs-info-label{color:var(--c-muted)}
.fs-info-val{font-weight:600;color:var(--c-navy);text-align:right}

.fs-timeline{padding:.5rem 1.25rem 1.25rem}
.fs-tl-item{display:flex;align-items:flex-start;gap:.75rem;padding:.7rem 0;border-bottom:1px solid #f3f4f6}
.fs-tl-item:last-child{border-bottom:none}
.fs-tl-dot{width:32px;height:32px;border-radius:9px;background:#f3f4f6;color:var(--c-muted);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.8rem}
.fs-tl-action{font-weight:700;color:var(--c-navy);font-size:.82rem}
.fs-tl-meta{font-size:.72rem;color:var(--c-muted);margin-top:.1rem}
.fs-tl-time{font-size:.68rem;color:var(--c-muted);white-space:nowrap;flex-shrink:0}
</style>
@endpush

@section('content')

@php $panelPrefix = request()->routeIs('super-admin.*') ? 'super-admin' : 'admin'; @endphp

@if(session('success'))
<div class="flash flash-ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
<div class="flash flash-err"><i class="fas fa-exclamation-triangle"></i> {{ session('error') }}</div>
@endif

<div class="fs-header">
  <div>
    <div class="fs-ref"><i class="fas fa-sack-dollar" style="color:var(--c-gold);margin-right:.4rem"></i>{{ $financing->reference }}</div>
    @if($financing->archive_ref)<div class="fs-archive">{{ $financing->archive_ref }}</div>@endif
    <span class="badge-status" style="margin-top:.5rem;display:inline-block">{{ $financing->statusLabel() }}</span>
  </div>
  <div class="fs-actions">
    <a href="{{ route($panelPrefix.'.financings.index') }}" class="btn-ghost btn-sm-pro">
      <i class="fas fa-arrow-left"></i> Retour
    </a>
    @if($financing->isEditable())
    <a href="{{ route($panelPrefix.'.financings.edit',$financing) }}" class="btn-navy btn-sm-pro">
      <i class="fas fa-pen"></i> Modifier
    </a>
    @endif

    @if($financing->canBeValidated())
    <form action="{{ route($panelPrefix.'.financings.validate',$financing) }}" method="POST" style="display:inline">
      @csrf
      <button type="submit" class="btn-navy btn-sm-pro"><i class="fas fa-check-circle"></i> Valider</button>
    </form>
    @endif

    @if($financing->canSendContract())
    <form action="{{ route($panelPrefix.'.financings.send-contract',$financing) }}" method="POST" style="display:inline">
      @csrf
      <button type="submit" class="btn-navy btn-sm-pro"><i class="fas fa-paper-plane"></i> Envoyer le contrat</button>
    </form>
    @endif

    @if($financing->status === 'contract_sent')
    <form action="{{ route($panelPrefix.'.financings.signed',$financing) }}" method="POST" style="display:inline"
          onsubmit="return confirm('Confirmer la réception du contrat signé ?');">
      @csrf
      <button type="submit" class="btn-navy btn-sm-pro"><i class="fas fa-file-signature"></i> Marquer signé reçu</button>
    </form>
    @endif

    @if($financing->canBeFinalized())
    <button type="button" class="btn-navy btn-sm-pro" data-bs-toggle="modal" data-bs-target="#finalizeModal">
      <i class="fas fa-flag-checkered"></i> Finaliser
    </button>
    @endif

    @if(!in_array($financing->status, ['finalized','rejected']))
    <button type="button" class="btn-ghost btn-sm-pro" style="color:#dc2626;border-color:#fecdd3" data-bs-toggle="modal" data-bs-target="#rejectModal">
      <i class="fas fa-ban"></i> Rejeter
    </button>
    @endif
  </div>
</div>

@if($financing->status === 'rejected' && $financing->rejection_reason)
<div class="flash flash-err mb-3"><i class="fas fa-ban"></i> Dossier rejeté — {{ $financing->rejection_reason }}</div>
@endif

<div class="row g-4">
  <div class="col-xl-7">

    {{-- Client --}}
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Client</div>
      </div>
      <div class="card-pro-body">
        <div class="fs-info-row"><span class="fs-info-label">Nom</span><span class="fs-info-val">{{ $financing->client?->name ?? $financing->name }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Email</span><span class="fs-info-val">{{ $financing->client?->email ?? $financing->email }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Téléphone</span><span class="fs-info-val">{{ $financing->phone ?: '—' }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Adresse</span><span class="fs-info-val">{{ $financing->address ?: '—' }}</span></div>
        @if($isSuperAdmin)
        <div class="fs-info-row"><span class="fs-info-label">Admin en charge</span><span class="fs-info-val">{{ $financing->admin?->name ?? '—' }}</span></div>
        @endif
      </div>
    </div>

    {{-- Paramètres du financement --}}
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Paramètres du financement</div>
      </div>
      <div class="card-pro-body">
        <div class="fs-info-row"><span class="fs-info-label">Montant accordé</span><span class="fs-info-val">{{ number_format((float)$financing->amount,2,',',' ') }} {{ $financing->currency }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Remboursement</span><span class="fs-info-val" style="color:#166534">Non remboursable</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Date de versement</span><span class="fs-info-val">{{ $financing->start_date?->format('d/m/Y') ?? '—' }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Type de financement</span><span class="fs-info-val">{{ $financing->financingTypeLabel() }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Objet</span><span class="fs-info-val">{{ $financing->objet ?: '—' }}</span></div>
        @if($financing->special_conditions)
        <div class="fs-info-row" style="flex-direction:column;align-items:flex-start;gap:.3rem">
          <span class="fs-info-label">Conditions particulières</span>
          <span class="fs-info-val" style="text-align:left;font-weight:400">{{ $financing->special_conditions }}</span>
        </div>
        @endif
      </div>
    </div>

    {{-- Documents --}}
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Documents</div>
      </div>
      <div class="card-pro-body">

        {{-- Notification --}}
        <div style="margin-bottom:1.25rem;padding-bottom:1.25rem;border-bottom:1px solid var(--c-border)">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem;flex-wrap:wrap;gap:.5rem">
            <div style="font-weight:700;font-size:.82rem;color:var(--c-navy)">
              <i class="fas fa-bell" style="margin-right:.4rem;color:var(--c-gold)"></i>Document de notification
            </div>
            <div style="display:flex;gap:.4rem">
              <a href="{{ route($panelPrefix.'.financings.notification.docx',$financing) }}" class="btn-ghost btn-sm-pro" title="Générer le DOCX rempli">
                <i class="fas fa-file-word"></i>
              </a>
              @if($financing->notification_pdf_path)
              <a href="{{ route($panelPrefix.'.financings.notification.pdf',$financing) }}" target="_blank" class="btn-ghost btn-sm-pro" title="Voir le PDF">
                <i class="fas fa-eye"></i>
              </a>
              @endif
            </div>
          </div>
          @if($financing->notification_pdf_path)
          <div style="font-size:.75rem;color:#166534"><i class="fas fa-check-circle me-1"></i>PDF uploadé — débloque la validation.</div>
          @else
          <form action="{{ route($panelPrefix.'.financings.notification.pdf.upload',$financing) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
            @csrf
            <input type="file" name="notification_pdf" accept=".pdf" class="form-control-pro" style="font-size:.78rem" required>
            <button type="submit" class="btn-navy btn-sm-pro" style="flex-shrink:0"><i class="fas fa-upload"></i></button>
          </form>
          <p class="form-help">1. Générez le DOCX rempli <i class="fas fa-file-word"></i>, 2. convertissez-le en PDF, 3. uploadez-le ici.</p>
          @endif
        </div>

        {{-- Contrat --}}
        <div>
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem;flex-wrap:wrap;gap:.5rem">
            <div style="font-weight:700;font-size:.82rem;color:var(--c-navy)">
              <i class="fas fa-file-contract" style="margin-right:.4rem;color:var(--c-gold)"></i>Contrat
            </div>
            <div style="display:flex;gap:.4rem">
              <a href="{{ route($panelPrefix.'.financings.contract.docx',$financing) }}" class="btn-ghost btn-sm-pro" title="Générer le DOCX rempli">
                <i class="fas fa-file-word"></i>
              </a>
              @if($financing->contract_pdf_path)
              <a href="{{ route($panelPrefix.'.financings.contract.viewer',$financing) }}" target="_blank" class="btn-ghost btn-sm-pro" title="Voir le PDF">
                <i class="fas fa-eye"></i>
              </a>
              @endif
            </div>
          </div>
          @if($financing->contract_pdf_path)
          <div style="font-size:.75rem;color:#166534"><i class="fas fa-check-circle me-1"></i>PDF uploadé — sera joint à l'email d'envoi du contrat.</div>
          @else
          <form action="{{ route($panelPrefix.'.financings.contract.pdf.upload',$financing) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
            @csrf
            <input type="file" name="contract_pdf" accept=".pdf" class="form-control-pro" style="font-size:.78rem" required>
            <button type="submit" class="btn-navy btn-sm-pro" style="flex-shrink:0"><i class="fas fa-upload"></i></button>
          </form>
          <p class="form-help">1. Générez le DOCX rempli <i class="fas fa-file-word"></i>, 2. convertissez-le en PDF, 3. uploadez-le ici.</p>
          @endif
        </div>

      </div>
    </div>

  </div>

  <div class="col-xl-5">

    {{-- Conditions administratives --}}
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Suivi & conditions</div>
      </div>
      <div class="card-pro-body">
        <div class="fs-info-row"><span class="fs-info-label">Frais administratifs</span><span class="fs-info-val">{{ $financing->admin_fees ? number_format((float)$financing->admin_fees,2,',',' ').' '.$financing->currency : '—' }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Compte de règlement</span><span class="fs-info-val">{{ $financing->bank_account ?: '—' }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Agent de suivi</span><span class="fs-info-val">{{ $financing->agent_suivi ?: '—' }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Directeur</span><span class="fs-info-val">{{ $financing->directeur ?: '—' }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Notaire</span><span class="fs-info-val">{{ $financing->notaire ?: '—' }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Modèle de contrat</span><span class="fs-info-val">{{ $financing->contractTemplate?->name ?? '— Défaut —' }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Langue du contrat</span><span class="fs-info-val">{{ strtoupper($financing->contract_language ?? 'fr') }}</span></div>
      </div>
    </div>

    @if($financing->frais_assurance || $financing->date_fin_assurance)
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot" style="background:#16a34a"></span>Assurance</div>
      </div>
      <div class="card-pro-body">
        <div class="fs-info-row"><span class="fs-info-label">Frais d'assurance</span><span class="fs-info-val">{{ $financing->frais_assurance ? number_format((float)$financing->frais_assurance,2,',',' ').' '.$financing->currency : '—' }}</span></div>
        <div class="fs-info-row"><span class="fs-info-label">Date de fin</span><span class="fs-info-val">{{ $financing->date_fin_assurance?->format('d/m/Y') ?? '—' }}</span></div>
      </div>
    </div>
    @endif

    @if($isSuperAdmin)
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Réaffecter le dossier</div>
      </div>
      <div class="card-pro-body">
        <form action="{{ route('admin.financings.assign-admin',$financing) }}" method="POST" class="d-flex gap-2">
          @csrf @method('PATCH')
          <select name="admin_id" class="form-control-pro" required>
            <option value="">— Choisir un admin —</option>
            @foreach($admins as $a)
            <option value="{{ $a->id }}" {{ $financing->admin_id==$a->id?'selected':'' }}>{{ $a->name }}</option>
            @endforeach
          </select>
          <button type="submit" class="btn-navy btn-sm-pro" style="flex-shrink:0">Réaffecter</button>
        </form>
      </div>
    </div>
    @endif

    {{-- Historique --}}
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Journal d'activité</div>
        <span style="font-size:.72rem;color:var(--c-muted)">{{ $financing->history->count() }} événements</span>
      </div>
      <div class="fs-timeline">
        @forelse($financing->history->sortByDesc('created_at') as $h)
        <div class="fs-tl-item">
          <div class="fs-tl-dot"><i class="fas fa-history"></i></div>
          <div style="flex:1;min-width:0">
            <div class="fs-tl-action">{{ ucfirst(str_replace('_',' ',$h->action)) }}</div>
            <div class="fs-tl-meta">
              <span style="font-weight:600">{{ $h->admin?->name ?? 'Système' }}</span>
              · {{ $h->created_at->format('d/m/Y à H:i') }}
            </div>
          </div>
          <div class="fs-tl-time">{{ $h->created_at->diffForHumans() }}</div>
        </div>
        @empty
        <div style="padding:1.5rem 0;text-align:center;color:var(--c-muted);font-size:.85rem">
          <i class="fas fa-history" style="font-size:1.5rem;display:block;margin-bottom:.5rem;opacity:.3"></i>
          Aucun événement enregistré
        </div>
        @endforelse
      </div>
    </div>

    @if($financing->isEditable())
    <form action="{{ route($panelPrefix.'.financings.destroy',$financing) }}" method="POST"
          onsubmit="return confirm('Supprimer définitivement ce dossier ?');">
      @csrf @method('DELETE')
      <button type="submit" class="btn-ghost btn-sm-pro" style="width:100%;color:#dc2626;border-color:#fecdd3">
        <i class="fas fa-trash"></i> Supprimer le dossier
      </button>
    </form>
    @endif

  </div>
</div>

{{-- Modal : Finaliser --}}
<div class="modal fade" id="finalizeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:12px;border:none">
      <form action="{{ route($panelPrefix.'.financings.finalize',$financing) }}" method="POST">
        @csrf
        <div class="modal-header" style="background:var(--c-navy);border-radius:12px 12px 0 0;border:none">
          <h5 class="modal-title text-white" style="font-weight:700;font-size:.9375rem">
            <i class="fas fa-flag-checkered me-2" style="color:var(--c-gold)"></i>Finaliser le dossier
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" style="padding:1.5rem">
          <div class="mb-3">
            <label class="form-label-pro">Date de versement des fonds *</label>
            <input type="date" name="disbursement_date" class="form-control-pro"
                   value="{{ now()->format('Y-m-d') }}" required>
          </div>
          <div class="mb-3">
            <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-size:.85rem">
              <input type="checkbox" name="credit_account" value="1" id="creditAccountCheck"
                     style="width:16px;height:16px;accent-color:var(--c-navy)" checked>
              <span>Créditer le compte client</span>
            </label>
          </div>
          <div class="mb-1" id="creditAmountWrap">
            <label class="form-label-pro">Montant à créditer</label>
            <input type="number" name="credit_amount" class="form-control-pro" step="0.01" min="0"
                   value="{{ $financing->amount }}">
            <p class="form-help">Par défaut : montant du financement ({{ number_format((float)$financing->amount,2,',',' ') }} {{ $financing->currency }})</p>
          </div>
        </div>
        <div class="modal-footer" style="border:none;padding:1rem 1.5rem 1.5rem">
          <button type="button" class="btn-ghost" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn-navy"><i class="fas fa-check me-1"></i>Finaliser</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal : Rejeter --}}
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:12px;border:none">
      <form action="{{ route($panelPrefix.'.financings.reject',$financing) }}" method="POST">
        @csrf
        <div class="modal-header" style="background:#dc2626;border-radius:12px 12px 0 0;border:none">
          <h5 class="modal-title text-white" style="font-weight:700;font-size:.9375rem">
            <i class="fas fa-ban me-2"></i>Rejeter le dossier
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" style="padding:1.5rem">
          <label class="form-label-pro">Motif du refus *</label>
          <textarea name="rejection_reason" class="form-control-pro" rows="4" required
                    placeholder="Ce motif sera communiqué au client par email."></textarea>
        </div>
        <div class="modal-footer" style="border:none;padding:1rem 1.5rem 1.5rem">
          <button type="button" class="btn-ghost" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn-navy" style="background:#dc2626"><i class="fas fa-ban me-1"></i>Rejeter</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
(function () {
  var check = document.getElementById('creditAccountCheck');
  var wrap  = document.getElementById('creditAmountWrap');
  if (!check || !wrap) return;
  function sync() { wrap.style.display = check.checked ? '' : 'none'; }
  check.addEventListener('change', sync);
  sync();
})();
</script>
@endpush
