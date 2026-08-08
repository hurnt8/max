@extends('layouts.dashboard')
@section('title','Modifier '.$financing->reference)
@section('page_title','Modifier le dossier')

@section('content')

@php $panelPrefix = request()->routeIs('super-admin.*') ? 'super-admin' : 'admin'; @endphp

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Modifier — <span style="font-family:monospace;color:var(--c-gold)">{{ $financing->reference }}</span></h4>
    <p>Financement non remboursable</p>
  </div>
  <a href="{{ route($panelPrefix.'.financings.show',$financing) }}" class="btn-ghost btn-sm-pro">
    <i class="fas fa-arrow-left"></i> Retour
  </a>
</div>

@if($errors->any())
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<form action="{{ route($panelPrefix.'.financings.update',$financing) }}" method="POST"
      x-data="{ currency: '{{ old('currency',$financing->currency??'EUR') }}' }">
@csrf @method('PUT')
<div class="row g-4">

  {{-- ══ COLONNE GAUCHE ══ --}}
  <div class="col-xl-5">

    {{-- Client (lecture seule) --}}
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Client</div>
        <span class="badge-status bs-gray">Non modifiable</span>
      </div>
      <div class="card-pro-body">
        <div style="display:flex;align-items:center;gap:.875rem;margin-bottom:1rem">
          <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--c-navy),var(--c-navy-3));display:flex;align-items:center;justify-content:center;color:var(--c-gold);font-weight:800;font-size:1rem;flex-shrink:0">
            {{ strtoupper(substr($financing->name,0,1)) }}
          </div>
          <div>
            <div style="font-weight:700;color:var(--c-navy)">{{ $financing->name }}</div>
            <div style="font-size:.78rem;color:var(--c-muted)">{{ $financing->email }}</div>
          </div>
        </div>
        <div class="d-flex gap-2 align-items-center" style="padding:.625rem .875rem;background:var(--c-bg);border-radius:var(--radius-sm);font-size:.78rem;color:var(--c-muted)">
          <i class="fas fa-info-circle" style="color:var(--c-blue)"></i>
          Pour changer le client, supprimez ce dossier et créez-en un nouveau.
        </div>
      </div>
    </div>

    {{-- Conditions --}}
    <div class="card-pro">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Conditions contractuelles</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label-pro">Frais administratifs</label>
            <div class="d-flex gap-2">
              <input type="number" name="admin_fees" class="form-control-pro"
                     value="{{ old('admin_fees',$financing->admin_fees) }}" step="0.01" min="0" style="flex:1">
              <div style="padding:.6rem .875rem;background:var(--c-bg);border:1.5px solid var(--c-border);border-radius:var(--radius-sm);font-weight:700;font-size:.8125rem;color:var(--c-navy);flex-shrink:0" x-text="currency">{{ $financing->currency }}</div>
            </div>
          </div>
          <div class="col-12">
            <label class="form-label-pro">Compte de règlement</label>
            <input type="text" name="bank_account" class="form-control-pro"
                   value="{{ old('bank_account',$financing->bank_account) }}">
            <p class="form-help">Communiqué au client après signature</p>
          </div>
          <div class="col-12">
            <label class="form-label-pro">Agent de suivi</label>
            <input type="text" name="agent_suivi" class="form-control-pro"
                   value="{{ old('agent_suivi', $financing->agent_suivi ?? Auth::user()->name) }}"
                   placeholder="Nom de l'agent responsable du dossier">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Directeur</label>
            <input type="text" name="directeur" class="form-control-pro"
                   value="{{ old('directeur', $financing->directeur) }}"
                   placeholder="Nom du directeur signataire">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Notaire</label>
            <input type="text" name="notaire" class="form-control-pro"
                   value="{{ old('notaire', $financing->notaire) }}"
                   placeholder="Nom du notaire">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Conditions particulières</label>
            <textarea name="special_conditions" class="form-control-pro" rows="3">{{ old('special_conditions',$financing->special_conditions) }}</textarea>
          </div>
          <div class="col-sm-6">
            <label class="form-label-pro">Modèle de contrat</label>
            <select name="contract_template_id" class="form-control-pro">
              <option value="">— Modèle par défaut —</option>
              @foreach($templates as $tpl)
              <option value="{{ $tpl->id }}" {{ old('contract_template_id',$financing->contract_template_id)==$tpl->id?'selected':'' }}>
                {{ $tpl->name }} {{ $tpl->is_default?'✓':'' }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label-pro">Langue du contrat</label>
            <select name="contract_language" class="form-control-pro">
              @foreach(['fr'=>'Français','en'=>'English','pl'=>'Polski','es'=>'Español','bg'=>'Български','hu'=>'Magyar','it'=>'Italiano','de'=>'Deutsch','lt'=>'Lietuvių','ro'=>'Română','lv'=>'Latviešu','nl'=>'Nederlands','pt'=>'Português','sk'=>'Slovenčina','el'=>'Ελληνικά'] as $lc => $llabel)
              <option value="{{ $lc }}" {{ old('contract_language', $financing->contract_language ?? 'fr') === $lc ? 'selected' : '' }}>
                {{ $llabel }}
              </option>
              @endforeach
            </select>
            <p class="form-help">Langue utilisée pour le PDF envoyé au client</p>
          </div>
        </div>
      </div>
    </div>

    {{-- ── ASSURANCE ── --}}
    <div class="card-pro mt-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title">
          <span class="icon-dot" style="background:#16a34a"></span>Assurance
        </div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label-pro">Frais d'assurance</label>
            <div class="d-flex gap-2">
              <input type="number" name="frais_assurance" class="form-control-pro"
                     value="{{ old('frais_assurance', $financing->frais_assurance) }}"
                     step="0.01" min="0" placeholder="0,00" style="flex:1">
              <div style="padding:.6rem .875rem;background:var(--c-bg);border:1.5px solid var(--c-border);border-radius:var(--radius-sm);font-weight:700;font-size:.8125rem;color:var(--c-navy);flex-shrink:0" x-text="currency">{{ $financing->currency }}</div>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label-pro">Date de fin d'assurance</label>
            <input type="date" name="date_fin_assurance" class="form-control-pro"
                   value="{{ old('date_fin_assurance', $financing->date_fin_assurance?->format('Y-m-d')) }}">
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- ══ COLONNE DROITE ══ --}}
  <div class="col-xl-7">

    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Paramètres du financement</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label-pro">Montant accordé *</label>
            <div class="d-flex gap-2">
              <input type="number" name="amount" class="form-control-pro"
                     value="{{ old('amount',$financing->amount) }}" step="100" min="100" style="flex:1">
              <select name="currency" class="form-control-pro" style="width:90px;flex-shrink:0" x-model="currency">
                @foreach($currencies as $cur)
                <option value="{{ $cur }}" {{ old('currency',$financing->currency)===$cur?'selected':'' }}>{{ $cur }}</option>
                @endforeach
              </select>
            </div>
            <p class="form-help">Financement non remboursable — montant accordé en une fois, sans échéancier</p>
          </div>
          <div class="col-sm-6">
            <label class="form-label-pro">Date de versement prévue</label>
            <input type="date" name="start_date" class="form-control-pro"
                   value="{{ old('start_date',$financing->start_date?->format('Y-m-d')) }}">
          </div>
          <div class="col-sm-6">
            <label class="form-label-pro">Type de financement</label>
            <select name="financing_type" class="form-control-pro">
              <option value="">— Non renseigné —</option>
              @foreach($financingTypes as $code => $label)
              <option value="{{ $code }}" {{ old('financing_type',$financing->financing_type)===$code?'selected':'' }}>{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label-pro">Objet du financement</label>
            <input type="text" name="objet" class="form-control-pro" value="{{ old('objet',$financing->objet) }}">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Remarques internes</label>
            <textarea name="subject" class="form-control-pro" rows="2">{{ old('subject',$financing->subject) }}</textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-end gap-3">
      <a href="{{ route($panelPrefix.'.financings.show',$financing) }}" class="btn-ghost">Annuler</a>
      <button type="submit" class="btn-navy">
        <i class="fas fa-save"></i> Enregistrer
      </button>
    </div>
  </div>
</div>
</form>
@endsection
