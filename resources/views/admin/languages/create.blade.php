@extends('layouts.dashboard')
@section('title', 'Ajouter une langue — AURELIS CAPITAL GROUP')
@section('page_title', 'Ajouter une langue')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Ajouter une langue</h4>
    <p>Le dossier de traduction lang/{code} doit déjà exister pour pouvoir activer la langue</p>
  </div>
  <a href="{{ route('admin.languages.index') }}" class="btn-ghost">
    <i class="fas fa-arrow-left"></i> Retour
  </a>
</div>

@if($errors->any())
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<form action="{{ route('admin.languages.store') }}" method="POST">
@csrf
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
            <input type="text" name="code" class="form-control-pro" value="{{ old('code') }}" placeholder="pt" maxlength="2" required>
          </div>
          <div class="col-md-8">
            <label class="form-label-pro">Nom natif *</label>
            <input type="text" name="native_name" class="form-control-pro" value="{{ old('native_name') }}" placeholder="Português" required>
          </div>
          <div class="col-12">
            <label class="form-label-pro">Fichier drapeau</label>
            <input type="text" name="flag_asset" class="form-control-pro" value="{{ old('flag_asset') }}" placeholder="pt.png">
            <div class="form-help" style="font-size:.72rem;color:var(--c-muted);margin-top:.3rem">Nom de fichier dans public/images/, ex : pt.png</div>
          </div>
          <div class="col-md-6">
            <label class="form-label-pro">Ordre d'affichage</label>
            <input type="number" name="sort_order" class="form-control-pro" value="{{ old('sort_order', 0) }}">
          </div>
          <div class="col-md-6" style="display:flex;align-items:flex-end">
            <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:var(--c-navy);font-weight:600;cursor:pointer;padding-bottom:.55rem">
              <input type="hidden" name="is_active" value="0">
              <input type="checkbox" name="is_active" value="1" {{ old('is_active') == '1' ? 'checked' : '' }}>
              Active (nécessite lang/{code})
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
