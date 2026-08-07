@extends('layouts.dashboard')
@section('title','Financements')
@section('page_title','Financements')

@push('styles')
<style>
/* ─────────────────────────────────────────
   FINANCINGS INDEX — préfixe fi-
   ───────────────────────────────────────── */

.fi-kpi-row{display:grid;grid-template-columns:repeat(4,1fr);gap:.875rem;margin-bottom:1.5rem}
@media(max-width:900px){.fi-kpi-row{grid-template-columns:repeat(2,1fr)}}
@media(max-width:500px){.fi-kpi-row{grid-template-columns:1fr}}

.fi-kpi{background:#fff;border:1px solid var(--c-border);border-radius:12px;padding:.875rem 1.125rem;display:flex;align-items:center;gap:.875rem;position:relative;overflow:hidden}
.fi-kpi::before{content:'';position:absolute;top:0;left:0;width:3px;height:100%;border-radius:12px 0 0 12px}
.fi-kpi--navy::before{background:var(--c-navy)}
.fi-kpi--amber::before{background:#d97706}
.fi-kpi--blue::before{background:#0891b2}
.fi-kpi--green::before{background:#059669}

.fi-kpi-icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0}
.fi-kpi--navy .fi-kpi-icon{background:#f0f3ff;color:var(--c-navy)}
.fi-kpi--amber .fi-kpi-icon{background:#fffbeb;color:#d97706}
.fi-kpi--blue  .fi-kpi-icon{background:#ecfeff;color:#0891b2}
.fi-kpi--green .fi-kpi-icon{background:#f0fdf4;color:#059669}

.fi-kpi-val{font-size:1.5rem;font-weight:900;color:var(--c-navy);line-height:1}
.fi-kpi-lbl{font-size:.7rem;font-weight:600;color:var(--c-muted);margin-top:.15rem;text-transform:uppercase;letter-spacing:.04em}

.fi-header{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.25rem}
.fi-header-title{font-size:1.2rem;font-weight:800;color:var(--c-navy);margin:0 0 .2rem}
.fi-header-sub{font-size:.78rem;color:var(--c-muted);margin:0}

.fi-filters-strip{display:flex;gap:.4rem;flex-wrap:wrap;margin-bottom:1.125rem}
.fi-chip{display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .75rem;border-radius:999px;font-size:.72rem;font-weight:600;border:1.5px solid var(--c-border);background:#fff;color:var(--c-muted);cursor:pointer;text-decoration:none;transition:.15s;white-space:nowrap}
.fi-chip:hover{border-color:var(--c-navy);color:var(--c-navy);text-decoration:none}
.fi-chip.active{background:var(--c-navy);border-color:var(--c-navy);color:#fff}
.fi-chip-count{font-size:.6rem;padding:.1rem .3rem;border-radius:8px;background:rgba(0,0,0,.08);font-weight:800;min-width:16px;text-align:center}
.fi-chip.active .fi-chip-count{background:rgba(255,255,255,.2)}

.fi-search-bar{background:#fff;border:1px solid var(--c-border);border-radius:12px;padding:.625rem 1rem;display:flex;gap:.5rem;align-items:center;margin-bottom:1.125rem;flex-wrap:wrap}
.fi-search-input{flex:1;min-width:180px;padding:.45rem .75rem;border:1.5px solid var(--c-border);border-radius:8px;font-size:.82rem;color:var(--c-navy);background:#f8f9fa;outline:none;transition:.15s;font-family:inherit}
.fi-search-input:focus{border-color:var(--c-gold);background:#fff;box-shadow:0 0 0 3px rgba(200,169,81,.1)}
.fi-search-input::placeholder{color:#c4cadc}

.fi-card{background:#fff;border:1px solid var(--c-border);border-radius:14px;overflow:hidden}
.fi-table-meta{display:flex;align-items:center;justify-content:space-between;padding:.625rem 1.125rem;border-bottom:1px solid var(--c-border);background:#fafbfc;flex-wrap:wrap;gap:.5rem}
.fi-table-meta-count{font-size:.75rem;color:var(--c-muted)}
.fi-table-meta-count strong{color:var(--c-navy);font-weight:700}

table.fi-tbl{width:100%;border-collapse:collapse}
table.fi-tbl thead th{padding:.65rem 1rem;font-size:.65rem;font-weight:700;color:var(--c-muted);text-transform:uppercase;letter-spacing:.07em;background:#fafbfc;border-bottom:1px solid var(--c-border);white-space:nowrap;text-align:left}
table.fi-tbl tbody td{padding:.8rem 1rem;font-size:.81rem;color:var(--c-text);border-bottom:1px solid #f3f4f6;vertical-align:middle}
table.fi-tbl tbody tr:last-child td{border-bottom:0}
table.fi-tbl tbody tr:hover td{background:#f8faff}
table.fi-tbl tbody td:first-child{border-left:3px solid transparent;transition:border-color .15s}
table.fi-tbl tbody tr:hover td:first-child{border-left-color:var(--c-gold)}

.fi-ref-link{font-family:monospace;font-weight:800;font-size:.8rem;color:var(--c-navy);letter-spacing:.02em;text-decoration:none;transition:.15s}
.fi-ref-link:hover{color:var(--c-gold)}
.fi-archive{font-size:.62rem;color:var(--c-muted);font-family:monospace;margin-top:.15rem}
.fi-fin-pill{display:inline-flex;align-items:center;gap:.2rem;font-size:.62rem;font-weight:700;padding:.1rem .4rem;border-radius:4px;background:#F5F3FF;color:#6d28d9;border:1px solid #DDD6FE;margin-top:.3rem}

.fi-avatar{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:.7rem;flex-shrink:0}
.fi-avatar--client{background:linear-gradient(135deg,var(--c-navy),#1a3a6c);color:var(--c-gold)}
.fi-avatar--admin{background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff}

.fi-name{font-weight:600;color:var(--c-navy);font-size:.82rem}
.fi-sub{font-size:.68rem;color:var(--c-muted);margin-top:.05rem}

.fi-amount{font-weight:800;color:var(--c-navy);font-size:.875rem}
.fi-duration{display:inline-flex;align-items:center;gap:.2rem;font-size:.62rem;font-weight:700;padding:.1rem .35rem;border-radius:4px;background:#EFF6FF;color:#1d4ed8;margin-top:.2rem}
.fi-rate{font-size:.65rem;color:var(--c-muted);margin-left:.3rem}

.fi-monthly{font-weight:700;color:var(--c-navy);font-size:.82rem}
.fi-monthly-cur{font-size:.68rem;color:var(--c-muted)}

.fi-date-main{font-size:.75rem;color:var(--c-muted)}
.fi-date-rel{font-size:.64rem;color:var(--c-muted)}

.fi-status{display:inline-flex;align-items:center;gap:.3rem;font-size:.7rem;font-weight:700;padding:.25rem .6rem;border-radius:999px;white-space:nowrap}
.fi-status--draft{background:#f3f4f6;color:#6b7280;border:1px solid #e5e7eb}
.fi-status--pending{background:#fffbeb;color:#b45309;border:1px solid #fde68a}
.fi-status--validated{background:#EFF6FF;color:#1d4ed8;border:1px solid #bfdbfe}
.fi-status--contract_sent{background:#ecfeff;color:#0e7490;border:1px solid #a5f3fc}
.fi-status--contract_signed{background:#f5f3ff;color:#6d28d9;border:1px solid #ddd6fe}
.fi-status--finalized{background:#f0fdf4;color:#065f46;border:1px solid #a7f3d0}
.fi-status--rejected{background:#FFF1F2;color:#be123c;border:1px solid #fecdd3}

.fi-act{display:flex;gap:.25rem;justify-content:flex-end;align-items:center}

.fi-empty{padding:3.5rem 1rem;text-align:center}
.fi-empty-icon{font-size:2.25rem;color:var(--c-muted);opacity:.2;display:block;margin-bottom:.75rem}
.fi-empty-title{font-size:.9rem;font-weight:700;color:var(--c-navy);margin-bottom:.3rem}
.fi-empty-sub{font-size:.78rem;color:var(--c-muted);margin-bottom:1.125rem}

.fi-pagi{padding:.75rem 1.125rem;border-top:1px solid var(--c-border)}

@media(max-width:900px){
  .fi-header{flex-direction:column;align-items:flex-start}
  .fi-header .btn-navy{align-self:flex-end}
  .fi-search-bar{flex-wrap:wrap}
}
@media(max-width:640px){
  .fi-header .btn-navy{width:100%;justify-content:center;align-self:stretch}
  .fi-filters-strip{flex-wrap:nowrap;overflow-x:auto;padding-bottom:.375rem;-webkit-overflow-scrolling:touch;scrollbar-width:none}
  .fi-filters-strip::-webkit-scrollbar{display:none}
  .fi-chip{flex-shrink:0}
  .fi-table-meta{flex-direction:column;align-items:flex-start;gap:.2rem}
  .fi-tbl-wrap{overflow-x:visible}
  table.fi-tbl thead{display:none}
  table.fi-tbl tbody tr{display:block;background:#fff;border:1px solid var(--c-border);border-radius:10px;margin-bottom:.75rem;overflow:hidden}
  table.fi-tbl tbody tr:hover td{background:transparent}
  table.fi-tbl tbody td{display:flex;justify-content:space-between;align-items:center;padding:.4rem 1rem;border-bottom:1px solid #f3f4f6;font-size:.8rem;min-height:36px;border-left:none !important}
  table.fi-tbl tbody td:last-child{border-bottom:none}
  table.fi-tbl tbody td[data-label]:not([data-label=""])::before{content:attr(data-label);font-size:.65rem;font-weight:700;color:var(--c-muted);text-transform:uppercase;letter-spacing:.05em;flex-shrink:0;margin-right:.75rem;white-space:nowrap}
  table.fi-tbl tbody td:first-child{padding:.75rem 1rem;background:#fafbfc;border-bottom:1px solid var(--c-border);min-height:44px}
  table.fi-tbl tbody td:first-child::before{display:none}
  table.fi-tbl tbody td:last-child{justify-content:center;gap:.625rem;flex-wrap:wrap;padding:.625rem 1rem;background:#fafbfc;border-top:1px solid var(--c-border)}
  table.fi-tbl tbody td:last-child::before{display:none}
  table.fi-tbl tbody td:last-child .btn-icon{width:44px;height:44px;font-size:.95rem}
  .fi-search-bar{flex-direction:column;align-items:stretch}
  .fi-search-input{min-width:0;width:100%}
}
</style>
@endpush

@section('content')

@php
$statusChips = [
    ''               => ['Tous',           $stats['total'],          'fa-layer-group'],
    'draft'          => ['Brouillons',     $stats['draft'],          'fa-pen'],
    'pending'        => ['En attente',     $stats['pending'],        'fa-hourglass-half'],
    'validated'      => ['Validées',       $stats['validated'],      'fa-check-circle'],
    'contract_sent'  => ['Envoyé',         $stats['contract_sent'],  'fa-paper-plane'],
    'contract_signed'=> ['Signé',          $stats['contract_signed'],'fa-file-signature'],
    'finalized'      => ['Finalisées',     $stats['finalized'],      'fa-flag-checkered'],
    'rejected'       => ['Rejetées',       $stats['rejected'],       'fa-ban'],
];
$currentStatus = request('status','');
@endphp

@if(session('success'))
<div class="flash flash-ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
<div class="flash flash-err"><i class="fas fa-exclamation-triangle"></i> {{ session('error') }}</div>
@endif

{{-- ── HEADER ── --}}
<div class="fi-header">
  <div>
    <div class="fi-header-title">
      <i class="fas fa-sack-dollar" style="color:var(--c-gold);margin-right:.4rem;font-size:1rem"></i>
      Financements
    </div>
    <p class="fi-header-sub">
      {{ $stats['total'] }} dossier(s) au total
      @if($stats['pending']) &nbsp;·&nbsp; <span style="color:#d97706;font-weight:600">{{ $stats['pending'] }} en attente</span>@endif
      @if($stats['contract_sent']) &nbsp;·&nbsp; <span style="color:#0891b2;font-weight:600">{{ $stats['contract_sent'] }} contrat(s) envoyé(s)</span>@endif
    </p>
  </div>
  <a href="{{ route('admin.financings.create') }}" class="btn-navy">
    <i class="fas fa-plus"></i> Nouveau financement
  </a>
</div>

{{-- ── KPI STRIP ── --}}
<div class="fi-kpi-row">
  <div class="fi-kpi fi-kpi--navy">
    <div class="fi-kpi-icon"><i class="fas fa-layer-group"></i></div>
    <div>
      <div class="fi-kpi-val">{{ $stats['total'] }}</div>
      <div class="fi-kpi-lbl">Total</div>
    </div>
  </div>
  <div class="fi-kpi fi-kpi--amber">
    <div class="fi-kpi-icon"><i class="fas fa-hourglass-half"></i></div>
    <div>
      <div class="fi-kpi-val">{{ $stats['pending'] }}</div>
      <div class="fi-kpi-lbl">En attente</div>
    </div>
  </div>
  <div class="fi-kpi fi-kpi--blue">
    <div class="fi-kpi-icon"><i class="fas fa-paper-plane"></i></div>
    <div>
      <div class="fi-kpi-val">{{ $stats['contract_sent'] + $stats['contract_signed'] }}</div>
      <div class="fi-kpi-lbl">Contrats en cours</div>
    </div>
  </div>
  <div class="fi-kpi fi-kpi--green">
    <div class="fi-kpi-icon"><i class="fas fa-flag-checkered"></i></div>
    <div>
      <div class="fi-kpi-val">{{ $stats['finalized'] }}</div>
      <div class="fi-kpi-lbl">Finalisées</div>
    </div>
  </div>
</div>

{{-- ── CHIPS DE STATUT ── --}}
<div class="fi-filters-strip">
  @foreach($statusChips as $val => [$lbl, $count, $ico])
  @if($count > 0 || $val === '')
  <a href="{{ route('admin.financings.index', array_merge(request()->except('status','page'), $val ? ['status'=>$val] : [])) }}"
     class="fi-chip {{ $currentStatus === $val ? 'active' : '' }}">
    <i class="fas {{ $ico }}" style="font-size:.62rem"></i>
    {{ $lbl }}
    <span class="fi-chip-count">{{ $count }}</span>
  </a>
  @endif
  @endforeach
</div>

{{-- ── BARRE DE RECHERCHE ── --}}
<form method="GET" action="{{ route('admin.financings.index') }}" class="fi-search-bar">
  @if($currentStatus)
  <input type="hidden" name="status" value="{{ $currentStatus }}">
  @endif
  <i class="fas fa-search" style="color:var(--c-muted);font-size:.8rem;flex-shrink:0"></i>
  <input type="text" name="search" class="fi-search-input"
         placeholder="Référence, nom, email…"
         value="{{ request('search') }}"
         autocomplete="off">
  @if($isSuperAdmin && $admins->isNotEmpty())
  <select name="admin_id" class="fi-search-input" style="flex:0;min-width:155px;cursor:pointer">
    <option value="">— Tous les admins —</option>
    @foreach($admins as $a)
    <option value="{{ $a->id }}" {{ request('admin_id') == $a->id ? 'selected' : '' }}>
      {{ $a->name }}
    </option>
    @endforeach
  </select>
  @endif
  <select name="financing_type" class="fi-search-input" style="flex:0;min-width:170px;cursor:pointer">
    <option value="">— Tous les types —</option>
    @foreach(\App\Models\FinancingRequest::FINANCING_TYPES as $code => $label)
    <option value="{{ $code }}" {{ request('financing_type') == $code ? 'selected' : '' }}>
      {{ $label }}
    </option>
    @endforeach
  </select>
  <button type="submit" class="btn-navy btn-sm-pro">
    <i class="fas fa-search"></i> Chercher
  </button>
  @if(request()->anyFilled(['search','status','admin_id','financing_type']))
  <a href="{{ route('admin.financings.index') }}" class="btn-ghost btn-sm-pro">
    <i class="fas fa-times"></i> Effacer
  </a>
  @endif
</form>

{{-- ── TABLE ── --}}
<div class="fi-card">

  <div class="fi-table-meta">
    <div class="fi-table-meta-count">
      @if(request()->anyFilled(['search','status','admin_id','financing_type']))
        <strong>{{ $financings->total() }}</strong> résultat(s)
        @if(request('search')) pour <em>«&nbsp;{{ request('search') }}&nbsp;»</em>@endif
        @if(request('status')) — <em>{{ $statusChips[request('status')][0] ?? '' }}</em>@endif
        @if(request('admin_id') && $isSuperAdmin)
          — Admin : <em>{{ $admins->firstWhere('id', request('admin_id'))?->name }}</em>
        @endif
        @if(request('financing_type'))
          — <em>{{ \App\Models\FinancingRequest::FINANCING_TYPES[request('financing_type')] ?? '' }}</em>
        @endif
      @else
        <strong>{{ $financings->total() }}</strong> dossier(s) au total
      @endif
    </div>
    <div style="font-size:.68rem;color:var(--c-muted)">
      Page {{ $financings->currentPage() }} / {{ max($financings->lastPage(),1) }}
    </div>
  </div>

  <div class="fi-tbl-wrap" style="overflow-x:auto">
    <table class="fi-tbl">
      <thead>
        <tr>
          <th>Référence</th>
          <th>Client</th>
          @if($isSuperAdmin)<th>Admin</th>@endif
          <th>Montant</th>
          <th>Mensualité</th>
          <th>Statut</th>
          <th>Date</th>
          <th style="text-align:right;padding-right:1.25rem">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($financings as $financing)
        <tr>

          <td data-label="Référence">
            <a href="{{ route('admin.financings.show',$financing) }}" class="fi-ref-link">
              {{ $financing->reference }}
            </a>
            @if($financing->archive_ref)
            <div class="fi-archive">{{ $financing->archive_ref }}</div>
            @endif
            @if($financing->financing_type)
            <div><span class="fi-fin-pill"><i class="fas fa-tag" style="font-size:.55rem"></i> {{ $financing->financingTypeLabel() }}</span></div>
            @endif
          </td>

          <td data-label="Client">
            <div style="display:flex;align-items:center;gap:.55rem">
              <div class="fi-avatar fi-avatar--client">
                {{ strtoupper(substr($financing->client?->name ?? $financing->name,0,1)) }}
              </div>
              <div>
                <div class="fi-name">{{ $financing->client?->name ?? $financing->name }}</div>
                <div class="fi-sub">{{ $financing->client?->email ?? $financing->email }}</div>
              </div>
            </div>
          </td>

          @if($isSuperAdmin)
          <td data-label="Admin">
            @if($financing->admin)
            <div style="display:flex;align-items:center;gap:.45rem">
              <div class="fi-avatar fi-avatar--admin" style="width:26px;height:26px;border-radius:6px;font-size:.65rem">
                {{ strtoupper(substr($financing->admin->name,0,1)) }}
              </div>
              <div class="fi-sub" style="font-size:.75rem;color:var(--c-navy);font-weight:600">
                {{ $financing->admin->name }}
              </div>
            </div>
            @else
              <span class="fi-sub">—</span>
            @endif
          </td>
          @endif

          <td data-label="Montant">
            <div class="fi-amount">
              {{ number_format((float)$financing->amount,0,',',' ') }}
              <span style="font-size:.68rem;font-weight:500;color:var(--c-muted)">{{ $financing->currency }}</span>
            </div>
            <div>
              <span class="fi-duration"><i class="fas fa-calendar-alt" style="font-size:.55rem"></i> {{ $financing->duration_months }} mois</span>
              <span class="fi-rate">{{ $financing->interest_rate }}%</span>
            </div>
          </td>

          <td data-label="Mensualité">
            <div class="fi-monthly">{{ number_format((float)$financing->monthly_payment,2,',',' ') }}</div>
            <div class="fi-monthly-cur">{{ $financing->currency }}/mois</div>
          </td>

          <td data-label="Statut">
            <span class="fi-status fi-status--{{ $financing->status }}">
              @php
                $sIcons = [
                  'draft'           => 'fa-pen',
                  'pending'         => 'fa-hourglass-half',
                  'validated'       => 'fa-check-circle',
                  'contract_sent'   => 'fa-paper-plane',
                  'contract_signed' => 'fa-file-signature',
                  'finalized'       => 'fa-flag-checkered',
                  'rejected'        => 'fa-ban',
                ];
              @endphp
              <i class="fas {{ $sIcons[$financing->status] ?? 'fa-circle' }}" style="font-size:.62rem"></i>
              {{ $financing->statusLabel() }}
            </span>
          </td>

          <td data-label="Date">
            <div class="fi-date-main">{{ $financing->created_at->format('d/m/Y') }}</div>
            <div class="fi-date-rel">{{ $financing->created_at->diffForHumans() }}</div>
          </td>

          <td data-label="">
            <div class="fi-act">
              <a href="{{ route('admin.financings.show',$financing) }}"
                 class="btn-icon btn-icon-primary" title="Voir le dossier">
                <i class="fas fa-eye"></i>
              </a>
              @if($financing->isEditable())
              <a href="{{ route('admin.financings.edit',$financing) }}"
                 class="btn-icon" title="Modifier">
                <i class="fas fa-pen"></i>
              </a>
              @endif
            </div>
          </td>

        </tr>
        @empty
        <tr>
          <td colspan="{{ $isSuperAdmin ? 8 : 7 }}">
            <div class="fi-empty">
              <i class="fas fa-sack-dollar fi-empty-icon"></i>
              <div class="fi-empty-title">Aucun dossier trouvé</div>
              <div class="fi-empty-sub">
                @if(request()->anyFilled(['search','status','admin_id','financing_type']))
                  Aucun résultat pour ces critères.
                  <a href="{{ route('admin.financings.index') }}" style="color:var(--c-navy);font-weight:600">Effacer les filtres</a>
                @else
                  Aucun dossier de financement pour le moment.
                @endif
              </div>
              <a href="{{ route('admin.financings.create') }}" class="btn-navy btn-sm-pro">
                <i class="fas fa-plus"></i> Nouveau financement
              </a>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($financings->hasPages())
  <div class="fi-pagi">
    {{ $financings->appends(request()->query())->links('partials.pagination') }}
  </div>
  @endif

</div>

@endsection
