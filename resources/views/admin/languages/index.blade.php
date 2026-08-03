@extends('layouts.dashboard')
@section('title', 'Langues — AURELIS CAPITAL GROUP')
@section('page_title', 'Langues')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Langues</h4>
    <p>Langues disponibles sur le site public et l'application client</p>
  </div>
  <a href="{{ route('admin.languages.create') }}" class="btn-navy">
    <i class="fas fa-plus"></i> Ajouter
  </a>
</div>

@if($languages->isEmpty())
<div class="card-pro" style="text-align:center;padding:4rem 2rem">
  <i class="fas fa-globe" style="font-size:3rem;color:var(--c-gold);opacity:.35;display:block;margin-bottom:1rem"></i>
  <p style="font-weight:600;color:var(--c-navy);font-size:1rem;margin-bottom:.35rem">Aucune langue configurée</p>
  <a href="{{ route('admin.languages.create') }}" class="btn-navy">
    <i class="fas fa-plus"></i> Ajouter
  </a>
</div>
@else
<div class="card-pro">
  <div class="table-responsive-pro">
    <table class="pro-table">
      <thead>
        <tr>
          <th style="width:52px"></th>
          <th>Langue</th>
          <th>Traductions</th>
          <th>Ordre</th>
          <th>Statut</th>
          <th style="text-align:right;width:96px">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($languages as $lang)
        <tr>
          <td data-label="">
            @if($lang->flag_asset)
            <img src="{{ asset('images/' . $lang->flag_asset) }}" alt="{{ $lang->code }}" style="width:26px;height:auto;border-radius:3px">
            @endif
          </td>

          <td data-label="Langue">
            <div class="cell-name">{{ strtoupper($lang->code) }}</div>
            <div class="cell-sub">{{ $lang->native_name }}</div>
          </td>

          <td data-label="Traductions">
            @if(!$lang->has_files)
            <span class="badge-status bs-gray"><i class="fas fa-folder-open" style="font-size:.55rem"></i> Dossier absent</span>
            @elseif($lang->completeness >= 100)
            <span class="badge-status bs-green"><i class="fas fa-check" style="font-size:.55rem"></i> Complet</span>
            @elseif($lang->completeness >= 70)
            <span class="badge-status bs-blue"><i class="fas fa-exclamation-circle" style="font-size:.55rem"></i> {{ $lang->completeness }}% traduit</span>
            @else
            <span class="badge-status bs-red"><i class="fas fa-exclamation-triangle" style="font-size:.55rem"></i> {{ $lang->completeness }}% traduit</span>
            @endif
          </td>

          <td data-label="Ordre" style="color:var(--c-muted);font-size:.78rem">
            {{ $lang->sort_order }}
          </td>

          <td data-label="Statut">
            @if($lang->is_active)
            <span class="badge-status bs-green"><i class="fas fa-check" style="font-size:.55rem"></i> Active</span>
            @else
            <span class="badge-status bs-gray"><i class="fas fa-ban" style="font-size:.55rem"></i> Désactivée</span>
            @endif
          </td>

          <td data-label="Actions" style="text-align:right">
            <div style="display:flex;gap:.375rem;justify-content:flex-end">
              <a href="{{ route('admin.languages.edit', $lang) }}"
                 class="btn-icon btn-icon-primary" title="Modifier">
                <i class="fas fa-pen"></i>
              </a>
              <form action="{{ route('admin.languages.destroy', $lang) }}" method="POST"
                    onsubmit="return confirm('Supprimer cette langue ?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-icon btn-icon-danger" title="Supprimer">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif

@endsection
