@extends('layouts.dashboard')
@section('title', 'Modifier une devise — AURELIS CAPITAL GROUP')
@section('page_title', 'Modifier une devise')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Modifier — {{ $currency->code }}</h4>
    <p>La devise sera disponible dans les formulaires de prêt, factures et comptes clients</p>
  </div>
  <a href="{{ route('admin.currencies.index') }}" class="btn-ghost">
    <i class="fas fa-arrow-left"></i> Retour
  </a>
</div>

@if($errors->any())
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<form action="{{ route('admin.currencies.update', $currency) }}" method="POST">
@csrf
@method('PUT')
<div class="row g-4">

  <div class="col-xl-6">
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Devise</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label-pro">Code ISO 4217 *</label>
            <input type="text" name="code" class="form-control-pro" value="{{ old('code', $currency->code) }}" maxlength="3" style="text-transform:uppercase" required>
          </div>
          <div class="col-md-4">
            <label class="form-label-pro">Symbole *</label>
            <input type="text" name="symbol" class="form-control-pro" value="{{ old('symbol', $currency->symbol) }}" required>
          </div>
          <div class="col-md-4">
            <label class="form-label-pro">Drapeau (emoji)</label>
            <input type="text" name="flag_emoji" class="form-control-pro" value="{{ old('flag_emoji', $currency->flag_emoji) }}">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Nom affiché *</label>
            <input type="text" name="name" class="form-control-pro" value="{{ old('name', $currency->name) }}" required>
          </div>
          <div class="col-12">
            <label class="form-label-pro">Montants suggérés</label>
            <input type="text" name="preset_amounts" class="form-control-pro" value="{{ old('preset_amounts', $currency->preset_amounts ? implode(',', $currency->preset_amounts) : '') }}">
            <div class="form-help" style="font-size:.72rem;color:var(--c-muted);margin-top:.3rem">Liste de montants séparés par des virgules, proposés dans le simulateur de prêt.</div>
          </div>
          <div class="col-md-4">
            <label class="form-label-pro">Ordre d'affichage</label>
            <input type="number" name="sort_order" class="form-control-pro" value="{{ old('sort_order', $currency->sort_order) }}">
          </div>
          <div class="col-md-4" style="display:flex;align-items:flex-end">
            <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:var(--c-navy);font-weight:600;cursor:pointer;padding-bottom:.55rem">
              <input type="hidden" name="is_active" value="0">
              <input type="checkbox" name="is_active" value="1" {{ old('is_active', $currency->is_active ? '1' : '0') == '1' ? 'checked' : '' }}>
              Active
            </label>
          </div>
          <div class="col-md-4" style="display:flex;align-items:flex-end">
            <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:var(--c-navy);font-weight:600;cursor:pointer;padding-bottom:.55rem">
              <input type="hidden" name="is_default" value="0">
              <input type="checkbox" name="is_default" value="1" {{ old('is_default', $currency->is_default ? '1' : '0') == '1' ? 'checked' : '' }}>
              Devise par défaut
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <button type="submit" class="btn-navy">
      <i class="fas fa-save"></i> Enregistrer
    </button>
  </div>

</div>
</form>

@endsection
