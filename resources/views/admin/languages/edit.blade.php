@extends('layouts.dashboard')
@section('title', 'Modifier une langue — AURELIS CAPITAL GROUP')
@section('page_title', 'Modifier une langue')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Modifier — {{ strtoupper($language->code) }}</h4>
    <p>Le dossier de traduction lang/{code} doit déjà exister pour pouvoir activer la langue</p>
  </div>
  <a href="{{ route('admin.languages.index') }}" class="btn-ghost">
    <i class="fas fa-arrow-left"></i> Retour
  </a>
</div>

@if($errors->any())
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<div class="flash {{ $hasFiles ? ($completeness >= 100 ? 'flash-ok' : 'flash-warn') : 'flash-err' }} mb-4">
  <i class="fas {{ $hasFiles ? 'fa-info-circle' : 'fa-exclamation-triangle' }}"></i>
  @if(!$hasFiles)
  Aucun dossier lang/{{ $language->code }} trouvé sur le serveur — l'activation est impossible tant que les fichiers de traduction ne sont pas ajoutés.
  @else
  Traductions : {{ $completeness }}% des textes du français sont présents pour cette langue.
  @endif
</div>

<form action="{{ route('admin.languages.update', $language) }}" method="POST">
@csrf
@method('PUT')
<div class="row g-4">

  <div class="col-xl-6">
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Langue</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label-pro">Code ISO 639-1 *</label>
            <input type="text" name="code" class="form-control-pro" value="{{ old('code', $language->code) }}" maxlength="2" required>
          </div>
          <div class="col-md-8">
            <label class="form-label-pro">Nom natif *</label>
            <input type="text" name="native_name" class="form-control-pro" value="{{ old('native_name', $language->native_name) }}" required>
          </div>
          <div class="col-12">
            <label class="form-label-pro">Fichier drapeau</label>
            <input type="text" name="flag_asset" class="form-control-pro" value="{{ old('flag_asset', $language->flag_asset) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label-pro">Ordre d'affichage</label>
            <input type="number" name="sort_order" class="form-control-pro" value="{{ old('sort_order', $language->sort_order) }}">
          </div>
          <div class="col-md-6" style="display:flex;align-items:flex-end">
            <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:var(--c-navy);font-weight:600;cursor:pointer;padding-bottom:.55rem">
              <input type="hidden" name="is_active" value="0">
              <input type="checkbox" name="is_active" value="1" {{ old('is_active', $language->is_active ? '1' : '0') == '1' ? 'checked' : '' }} {{ $hasFiles ? '' : 'disabled' }}>
              Active
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
