@extends('layouts.dashboard')
@section('title','Nouveau financement')
@section('page_title','Nouveau dossier de financement')

@section('content')

@php $panelPrefix = request()->routeIs('super-admin.*') ? 'super-admin' : 'admin'; @endphp

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Nouveau dossier de financement</h4>
    <p>Financement non remboursable — renseignez les informations client et le montant accordé</p>
  </div>
  <a href="{{ route($panelPrefix.'.financings.index') }}" class="btn-ghost btn-sm-pro">
    <i class="fas fa-arrow-left"></i> Retour
  </a>
</div>

@if($errors->any())
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<form action="{{ route($panelPrefix.'.financings.store') }}" method="POST"
      x-data="{ clientMode: '{{ old('client_mode','existing') }}', currency: '{{ old('currency','EUR') }}' }">
@csrf
<div class="row g-4">

  {{-- ══ COLONNE GAUCHE ══ --}}
  <div class="col-xl-5">

    {{-- Section : Client --}}
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Client</div>
        <div style="display:flex;gap:.5rem">
          <button type="button"
            @click="clientMode='existing'"
            :class="clientMode==='existing'?'btn-navy btn-sm-pro':'btn-ghost btn-sm-pro'">
            Existant
          </button>
          <button type="button"
            @click="clientMode='new'"
            :class="clientMode==='new'?'btn-navy btn-sm-pro':'btn-ghost btn-sm-pro'">
            Nouveau
          </button>
        </div>
      </div>
      <div class="card-pro-body">
        <input type="hidden" name="client_mode" :value="clientMode">

        {{-- Client existant --}}
        <div x-show="clientMode==='existing'" x-cloak>
          <label class="form-label-pro">Sélectionner un client *</label>
          <select name="client_id" class="form-control-pro" x-on:change="const o=$event.target.selectedOptions[0]; if(o&&o.dataset.currency) currency=o.dataset.currency;">
            <option value="">— Choisir —</option>
            @foreach($myClients as $c)
            <option value="{{ $c->id }}"
              data-currency="{{ $c->currency }}"
              data-locale="{{ $c->locale }}"
              {{ old('client_id')==$c->id?'selected':'' }}>
              {{ $c->name }} — {{ $c->email }}
            </option>
            @endforeach
          </select>
        </div>

        {{-- Nouveau client --}}
        <div x-show="clientMode==='new'" x-cloak>
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label-pro">Nom complet *</label>
              <input type="text" name="client_name" class="form-control-pro" value="{{ old('client_name') }}" placeholder="Jean Dupont">
            </div>
            <div class="col-12">
              <label class="form-label-pro">Email *</label>
              <input type="email" name="client_email" class="form-control-pro" value="{{ old('client_email') }}" placeholder="jean@exemple.com">
            </div>
            <div class="col-6">
              <label class="form-label-pro">Téléphone</label>
              <input type="text" name="client_phone" class="form-control-pro" value="{{ old('client_phone') }}">
            </div>
            <div class="col-6">
              <label class="form-label-pro">Devise</label>
              <select name="client_currency" class="form-control-pro" x-model="currency">
                @foreach($currencies as $cur)
                <option value="{{ $cur }}" {{ old('client_currency','EUR')===$cur?'selected':'' }}>{{ $cur }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12">
              <label class="form-label-pro">Adresse</label>
              <input type="text" name="client_address" class="form-control-pro" value="{{ old('client_address') }}" placeholder="Rue, ville, pays">
            </div>
            <div class="col-12">
              <label class="form-label-pro">Langue du contrat</label>
              <select name="client_locale" class="form-control-pro">
                @foreach(['fr'=>'🇫🇷 Français','en'=>'🇬🇧 English','es'=>'🇪🇸 Español','pl'=>'🇵🇱 Polski','bg'=>'🇧🇬 Български','hu'=>'🇭🇺 Magyar','it'=>'🇮🇹 Italiano','de'=>'🇩🇪 Deutsch','lt'=>'🇱🇹 Lietuvių','ro'=>'🇷🇴 Română','lv'=>'🇱🇻 Latviešu','nl'=>'🇳🇱 Nederlands','pt'=>'🇵🇹 Português','sk'=>'🇸🇰 Slovenčina','el'=>'🇬🇷 Ελληνικά'] as $lc => $llabel)
                <option value="{{ $lc }}" {{ old('client_locale','fr')===$lc?'selected':'' }}>{{ $llabel }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Section : Conditions --}}
    <div class="card-pro">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Conditions contractuelles</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label-pro">Frais administratifs</label>
            <div class="d-flex gap-2">
              <input type="number" name="admin_fees" class="form-control-pro" value="{{ old('admin_fees') }}" step="0.01" min="0" placeholder="0.00" style="flex:1">
              <div style="padding:.6rem .875rem;background:var(--c-bg);border:1.5px solid var(--c-border);border-radius:var(--radius-sm);font-weight:700;font-size:.8125rem;color:var(--c-navy);flex-shrink:0" x-text="currency">EUR</div>
            </div>
          </div>
          <div class="col-12">
            <label class="form-label-pro">Compte de règlement</label>
            <input type="text" name="bank_account" class="form-control-pro" value="{{ old('bank_account') }}" placeholder="IBAN ou référence">
            <p class="form-help">Communiqué au client après signature du contrat</p>
          </div>
          <div class="col-12">
            <label class="form-label-pro">Agent de suivi</label>
            <input type="text" name="agent_suivi" class="form-control-pro" value="{{ old('agent_suivi', Auth::user()->name) }}" placeholder="Nom de l'agent responsable du dossier">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Directeur</label>
            <input type="text" name="directeur" class="form-control-pro" value="{{ old('directeur') }}" placeholder="Nom du directeur signataire">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Notaire</label>
            <input type="text" name="notaire" class="form-control-pro" value="{{ old('notaire') }}" placeholder="Nom du notaire">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Conditions particulières</label>
            <textarea name="special_conditions" class="form-control-pro" rows="3" placeholder="Clauses spécifiques à ce dossier…">{{ old('special_conditions') }}</textarea>
          </div>
          <div class="col-12">
            <label class="form-label-pro">Modèle de contrat</label>
            <select name="contract_template_id" class="form-control-pro">
              <option value="">— Modèle par défaut —</option>
              @foreach($templates as $tpl)
              <option value="{{ $tpl->id }}" {{ old('contract_template_id')==$tpl->id?'selected':'' }}>
                {{ $tpl->name }} {{ $tpl->is_default?'✓':'' }}
              </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- ══ COLONNE DROITE ══ --}}
  <div class="col-xl-7">

    {{-- Paramètres --}}
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Paramètres du financement</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label-pro">Montant accordé *</label>
            <div class="d-flex gap-2">
              <input type="number" name="amount" class="form-control-pro" value="{{ old('amount') }}"
                     step="100" min="100" placeholder="5 000" style="flex:1">
              <select name="currency" class="form-control-pro" style="width:90px;flex-shrink:0" x-model="currency">
                @foreach($currencies as $cur)
                <option value="{{ $cur }}" {{ old('currency','EUR')===$cur?'selected':'' }}>{{ $cur }}</option>
                @endforeach
              </select>
            </div>
            <p class="form-help">Financement non remboursable — montant accordé en une fois, sans échéancier</p>
          </div>
          <div class="col-sm-6">
            <label class="form-label-pro">Date de versement prévue</label>
            <input type="date" name="start_date" class="form-control-pro"
                   value="{{ old('start_date',now()->format('Y-m-d')) }}">
          </div>
          <div class="col-sm-6">
            <label class="form-label-pro">Type de financement</label>
            <select name="financing_type" class="form-control-pro">
              <option value="">— Non renseigné —</option>
              @foreach($financingTypes as $code => $label)
              <option value="{{ $code }}" {{ old('financing_type')===$code?'selected':'' }}>{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label-pro">Objet du financement</label>
            <input type="text" name="objet" class="form-control-pro" value="{{ old('objet') }}"
                   placeholder="Ex : acquisition d'équipement…">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Remarques internes</label>
            <textarea name="subject" class="form-control-pro" rows="2"
                      placeholder="Notes visibles uniquement par les administrateurs">{{ old('subject') }}</textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-end gap-3">
      <a href="{{ route($panelPrefix.'.financings.index') }}" class="btn-ghost">Annuler</a>
      <button type="submit" class="btn-navy">
        <i class="fas fa-save"></i> Créer le dossier
      </button>
    </div>

  </div>
</div>

</form>
@endsection
