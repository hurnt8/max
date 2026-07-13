@extends('layouts.dashboard')
@section('title', 'Coordonnées du site — Solberg Grupo')
@section('page_title', 'Coordonnées du site')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Coordonnées du site</h4>
    <p>Adresses, téléphones et email affichés dans le pied de page et la page contact du site public</p>
  </div>
</div>

@if($errors->any())
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}</div>
@endif

<form action="{{ route('admin.site-contacts.update') }}" method="POST">
@csrf
<div class="row g-4">

  <div class="col-xl-6">
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Adresses</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label-pro">Adresse 1 *</label>
            <input type="text" name="address_1" class="form-control-pro" value="{{ old('address_1', $contact->address_1) }}">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Adresse 2</label>
            <input type="text" name="address_2" class="form-control-pro" value="{{ old('address_2', $contact->address_2) }}">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Adresse 3</label>
            <input type="text" name="address_3" class="form-control-pro" value="{{ old('address_3', $contact->address_3) }}">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6">
    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Téléphones</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label-pro">Téléphone 1</label>
            <input type="text" name="phone_1" class="form-control-pro" value="{{ old('phone_1', $contact->phone_1) }}">
          </div>
          <div class="col-12">
            <label class="form-label-pro">Téléphone 2</label>
            <input type="text" name="phone_2" class="form-control-pro" value="{{ old('phone_2', $contact->phone_2) }}">
          </div>
        </div>
      </div>
    </div>

    <div class="card-pro mb-4">
      <div class="card-pro-hdr">
        <div class="card-pro-title"><span class="icon-dot"></span>Email</div>
      </div>
      <div class="card-pro-body">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label-pro">Adresse e-mail</label>
            <input type="email" name="email" class="form-control-pro" value="{{ old('email', $contact->email) }}" placeholder="contact@solberggrupo.eu">
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
