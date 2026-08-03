@extends('layouts.dashboard')
@section('title', 'Devises — AURELIS CAPITAL GROUP')
@section('page_title', 'Devises')

@section('content')

<div class="d-flex align-items-start justify-content-between flex-wrap gap-3 page-hdr">
  <div>
    <h4>Devises</h4>
    <p>Devises disponibles pour les demandes de prêt, factures et comptes clients</p>
  </div>
  <a href="{{ route('admin.currencies.create') }}" class="btn-navy">
    <i class="fas fa-plus"></i> Ajouter
  </a>
</div>

@if(session('error'))
<div class="flash flash-err mb-4"><i class="fas fa-exclamation-triangle"></i> {{ session('error') }}</div>
@endif

@if($currencies->isEmpty())
<div class="card-pro" style="text-align:center;padding:4rem 2rem">
  <i class="fas fa-coins" style="font-size:3rem;color:var(--c-gold);opacity:.35;display:block;margin-bottom:1rem"></i>
  <p style="font-weight:600;color:var(--c-navy);font-size:1rem;margin-bottom:.35rem">Aucune devise configurée</p>
  <a href="{{ route('admin.currencies.create') }}" class="btn-navy">
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
          <th>Devise</th>
          <th>Symbole</th>
          <th>Ordre</th>
          <th>Par défaut</th>
          <th>Statut</th>
          <th style="text-align:right;width:96px">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($currencies as $currency)
        <tr>
          <td data-label="" style="font-size:1.35rem">{{ $currency->flag_emoji }}</td>

          <td data-label="Devise">
            <div class="cell-name">{{ $currency->code }}</div>
            <div class="cell-sub">{{ $currency->name }}</div>
          </td>

          <td data-label="Symbole">
            <span style="font-size:.85rem;color:var(--c-text)">{{ $currency->symbol }}</span>
          </td>

          <td data-label="Ordre" style="color:var(--c-muted);font-size:.78rem">
            {{ $currency->sort_order }}
          </td>

          <td data-label="Par défaut">
            @if($currency->is_default)
            <span class="badge-status bs-green"><i class="fas fa-star" style="font-size:.55rem"></i> Défaut</span>
            @else
            <span style="color:var(--c-muted);font-size:.78rem">—</span>
            @endif
          </td>

          <td data-label="Statut">
            @if($currency->is_active)
            <span class="badge-status bs-green"><i class="fas fa-check" style="font-size:.55rem"></i> Active</span>
            @else
            <span class="badge-status bs-gray"><i class="fas fa-ban" style="font-size:.55rem"></i> Désactivée</span>
            @endif
          </td>

          <td data-label="Actions" style="text-align:right">
            <div style="display:flex;gap:.375rem;justify-content:flex-end">
              <a href="{{ route('admin.currencies.edit', $currency) }}"
                 class="btn-icon btn-icon-primary" title="Modifier">
                <i class="fas fa-pen"></i>
              </a>
              <form action="{{ route('admin.currencies.destroy', $currency) }}" method="POST"
                    onsubmit="return confirm('Supprimer cette devise ?')">
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
