@extends('layouts.app')
@section('title', __('menu.loan'))

@php
    $loanSetting = \App\Models\LoanSetting::current();
    $siteContact = \App\Models\SiteContact::current();
    $currenciesForForm = \App\Models\Currency::enabledList();
@endphp

@push('styles')
<style>
/* ── Chips ── */
.chip-group { display:flex; flex-wrap:wrap; gap:.4rem; }
.chip {
    padding:.38rem .8rem; border-radius:999px; border:2px solid #d1d5db;
    background:#fff; color:#374151; font-size:.82rem; font-weight:600;
    cursor:pointer; transition:all .18s; white-space:nowrap;
}
.chip:hover { border-color:var(--gold); color:var(--gold); }
.chip.active { background:var(--navy); color:#fff; border-color:var(--navy); }

/* ── Champ libre montant/durée ── */
.free-input-row {
    display:flex; align-items:center; gap:.6rem;
    margin-top:.65rem; padding:.55rem .85rem;
    background:#f5f7fb; border:1.5px dashed #c8d3e8; border-radius:10px;
}
.free-input-row label { font-size:.76rem; font-weight:600; color:#6b7280; white-space:nowrap; margin:0; }
.free-input-row input {
    flex:1; border:none; background:transparent; font-size:.92rem; font-weight:700;
    color:var(--navy); outline:none; min-width:0;
}
.free-input-row input::placeholder { font-weight:400; color:#b0bec5; }
.free-input-row .sym { font-size:.88rem; font-weight:800; color:var(--navy); opacity:.7; }

/* ── Résumé devis ── */
.quote-result {
    background:linear-gradient(135deg,var(--navy) 0%,var(--navy-light) 100%);
    border-radius:14px; padding:1.1rem 1.3rem; color:#fff;
}
.quote-result__row { display:flex; flex-wrap:wrap; gap:.8rem; justify-content:space-between; margin-bottom:.75rem; }
.quote-result__item { text-align:center; flex:1; min-width:80px; }
.quote-result__label { font-size:.62rem; text-transform:uppercase; letter-spacing:.08em; color:rgba(255,255,255,.5); display:block; margin-bottom:.2rem; }
.quote-result__value { font-size:1rem; font-weight:800; color:#fff; }
.quote-result__value.gold { color:var(--gold); font-size:1.25rem; }
.quote-result__sep { width:1px; height:32px; background:rgba(255,255,255,.15); }

/* ── Séparateurs de section ── */
.form-section { margin-bottom:1.5rem; }
.form-section-title {
    font-size:.7rem; font-weight:800; text-transform:uppercase; letter-spacing:.07em;
    color:var(--navy); margin-bottom:.55rem; display:flex; align-items:center; gap:.5rem;
}
.form-section-title i { color:var(--gold); }
.form-section-title::after { content:''; flex:1; height:1px; background:#eaecf0; }

/* ── Sidebar raisons ── */
.reason-item { display:flex; gap:.75rem; padding:.8rem 0; }
.reason-item + .reason-item { border-top:1px solid #f0f0f0; }
.reason-icon { width:38px; height:38px; border-radius:9px; background:rgba(212,175,55,.1); color:var(--gold); display:flex; align-items:center; justify-content:center; font-size:.9rem; flex-shrink:0; }
.reason-title { font-size:.84rem; font-weight:700; color:var(--navy); margin-bottom:.15rem; }
.reason-desc  { font-size:.75rem; color:#6b7280; line-height:1.45; margin:0; }

[x-cloak] { display:none !important; }

/* ── Étapes ── */
.step-progress { display:flex; align-items:center; gap:.4rem; flex-shrink:0; }
.step-dot { width:8px; height:8px; border-radius:50%; background:#e5e7eb; transition:all .2s; }
.step-dot.active { background:var(--gold); width:22px; border-radius:4px; }
.step-summary {
    display:flex; align-items:center; justify-content:space-between;
    background:var(--cream); border-radius:10px; padding:.75rem 1.1rem;
    margin-bottom:1.4rem;
}
.step-summary__label { font-size:.78rem; color:#6b7280; }
.step-summary__value { font-family:'Playfair Display',serif; font-weight:700; color:var(--navy); font-size:1.05rem; }
.step-summary__edit { font-size:.75rem; color:var(--gold-dark); font-weight:700; cursor:pointer; white-space:nowrap; }
.step-summary__edit:hover { text-decoration:underline; }

.currency-select {
    width:100%; padding:.7rem .9rem; border-radius:10px; border:2px solid #e5e7eb;
    background:#fff; font-size:.9rem; font-weight:600; color:var(--navy);
    cursor:pointer; transition:border-color .18s;
}
.currency-select:focus { outline:none; border-color:var(--gold); }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('loanForm', () => ({
        step: 1,
        selCurrency: '{{ \App\Models\Currency::default() }}',
        selAmount:   null,
        customAmt:   '',
        minAmount: {{ (float) $loanSetting->min_amount }},
        maxAmount: {{ (float) $loanSetting->max_amount }},

        locale:      "{{ str_replace('_','-',app()->getLocale()) }}",

        currencies: (() => {
            // Drapeau derive du code ISO 4217 : ses 2 premieres lettres correspondent
            // presque toujours au code pays ISO 3166-1 (USD->US, BRL->BR, EUR->EU...).
            // Ainsi toute devise ajoutee depuis l'admin obtient automatiquement son
            // drapeau, sans table a maintenir manuellement.
            const flagFromCode = (code) => code.slice(0, 2).toUpperCase()
                .replace(/./g, ch => String.fromCodePoint(127397 + ch.charCodeAt(0)));
            return @json($currenciesForForm->map(fn ($c) => ['code' => $c->code, 'symbol' => $c->symbol, 'name' => $c->name])->values())
                .map(c => ({ ...c, flag: flagFromCode(c.code) }));
        })(),

        amountsByCurrency: {
            EUR:[1000,3000,5000,10000,20000,50000,75000,95000],
            GBP:[1000,2500,5000,10000,20000,40000,65000,80000],
            CHF:[1000,3000,5000,10000,20000,50000,75000,95000],
            NOK:[10000,30000,50000,100000,200000,500000,750000,950000],
            SEK:[10000,30000,50000,100000,200000,500000,750000,950000],
            DKK:[7000,20000,35000,75000,150000,375000,550000,700000],
            PLN:[5000,10000,20000,50000,100000,200000,350000,500000],
            CZK:[25000,75000,125000,250000,500000,1000000,1500000,2000000],
            HUF:[500000,1000000,2000000,4000000,8000000,20000000,30000000,40000000],
            RON:[5000,15000,25000,50000,100000,250000,375000,475000],
        },

        get amounts()  { return this.amountsByCurrency[this.selCurrency] || this.amountsByCurrency['EUR']; },
        get currency() { return this.currencies.find(c => c.code === this.selCurrency) || this.currencies[0]; },

        get amount() {
            const c = parseFloat(this.customAmt);
            if (!isNaN(c) && c > 0) {
                return (c >= this.minAmount && c <= this.maxAmount) ? c : null;
            }
            return this.selAmount;
        },
        get amountOutOfRange() {
            const c = parseFloat(this.customAmt);
            return !isNaN(c) && c > 0 && (c < this.minAmount || c > this.maxAmount);
        },
        get canProceed() {
            return this.amount !== null && this.amount > 0 && !this.amountOutOfRange;
        },
        nextStep() {
            if (!this.canProceed) return;
            this.step = 2;
            this.$nextTick(() => this.$refs.formCard?.scrollIntoView({ behavior: 'smooth', block: 'start' }));
        },
        prevStep() {
            this.step = 1;
            this.$nextTick(() => this.$refs.formCard?.scrollIntoView({ behavior: 'smooth', block: 'start' }));
        },

        fmtAmt(v) {
            if (!v) return '—';
            try {
                return new Intl.NumberFormat(this.locale, {
                    style:'currency', currency:this.selCurrency,
                    minimumFractionDigits:0, maximumFractionDigits:0,
                }).format(v);
            } catch(e) { return v + ' ' + this.selCurrency; }
        },

        setCurrency(code) {
            if (this.selCurrency === code) return;
            this.selCurrency = code;
            this.selAmount = null; this.customAmt = '';
        },
        pickAmount(v)   { this.selAmount = v; this.customAmt = ''; },
    }));
});
</script>
@endpush

@section('content')
@php $locale = app()->getLocale(); @endphp

<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title">@lang('menu.loan')</h1>
            <ul class="page-hero__breadcrumb">
                <li><a href="{{ route('home', ['locale' => $locale]) }}">@lang('menu.home')</a></li>
                <li class="sep"><i class="fas fa-chevron-right"></i></li>
                <li>@lang('menu.loan')</li>
            </ul>
        </div>
    </div>
</div>

<section class="py-24 bg-white">
    <div class="container">
        <div class="row g-4 align-items-start">

            {{-- ══════════ FORMULAIRE PRINCIPAL ══════════ --}}
            <div class="col-lg-8" x-data="loanForm">
                <div class="form-card wow fadeInLeft" data-wow-duration="700ms" x-ref="formCard"
                     style="border-top:4px solid var(--gold);">

                    {{-- En-tête dynamique selon l'étape --}}
                    @if (!session('success'))
                    <div class="d-flex align-items-start justify-content-between flex-wrap gap-2 mb-4">
                        <div>
                            <div class="section-label mb-1" x-text="step === 1 ? @js(__('loan.quote_step_label')) : @js(__('loan.step2_label'))"></div>
                            <h3 style="font-family:'Playfair Display',serif;color:var(--navy);font-size:1.25rem;font-weight:700;margin:0 0 .15rem;"
                                x-text="step === 1 ? @js(__('loan.quote_step_title')) : @js(__('loan.form_title'))"></h3>
                            <p style="font-size:.78rem;color:#6b7280;margin:0;"
                               x-text="step === 1 ? @js(__('loan.quote_step_desc')) : @js(__('loan.form_hint'))"></p>
                        </div>
                        <div class="step-progress" aria-hidden="true">
                            <span class="step-dot" :class="step >= 1 ? 'active' : ''"></span>
                            <span class="step-dot" :class="step >= 2 ? 'active' : ''"></span>
                        </div>
                    </div>
                    @endif

                    @if (session('success'))
                    {{-- ══ PANNEAU DE CONFIRMATION ══ --}}
                    <div style="text-align:center;padding:1.5rem .5rem 2rem;">
                        <div style="width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,#d1fae5,#a7f3d0);margin:0 auto 1.2rem;display:flex;align-items:center;justify-content:center;box-shadow:0 6px 20px rgba(5,150,105,.2);">
                            <i class="fas fa-check" style="font-size:1.8rem;color:#059669;"></i>
                        </div>
                        <h3 style="color:var(--navy);font-size:1.2rem;font-weight:800;margin-bottom:.6rem;">
                            {{ session('success') }}
                        </h3>
                        <p style="color:#6b7280;font-size:.88rem;max-width:420px;margin:0 auto 1.75rem;line-height:1.6;">
                            @lang('message.loan_complete_intro')
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="{{ route('home', ['locale' => $locale]) }}" class="btn-outline">
                                <i class="fas fa-home"></i> @lang('menu.home')
                            </a>
                            <a href="{{ route('loan', ['locale' => $locale]) }}" class="btn-primary">
                                <i class="fas fa-plus"></i> @lang('menu.loan')
                            </a>
                        </div>
                    </div>
                    @else

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            @foreach ($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('loan.request') }}"
                          @submit="if (step === 1) { $event.preventDefault(); nextStep(); }">
                        @csrf
                        <input type="hidden" name="locale"   value="{{ app()->getLocale() }}">
                        <input type="hidden" name="amount"   :value="amount">
                        {{-- Durée fixe non affichée : un don n'a pas d'échéancier de remboursement.
                             La valeur sert uniquement de référence interne au dossier. --}}
                        <input type="hidden" name="darly"    value="24">
                        <input type="hidden" name="currency" :value="selCurrency">

                        {{-- ═══════════ ÉTAPE 1 : MONTANT ═══════════ --}}
                        <div x-show="step === 1" x-cloak>

                            {{-- ── Devise ── --}}
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-globe"></i> @lang('loan.label_currency')
                                </div>
                                <select class="currency-select" :value="selCurrency" @change="setCurrency($event.target.value)">
                                    <template x-for="c in currencies" :key="c.code">
                                        <option :value="c.code" x-text="c.flag + '  ' + c.name + '  ·  ' + c.code + ' ' + c.symbol"></option>
                                    </template>
                                </select>
                            </div>

                            {{-- ── Montant ── --}}
                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-coins"></i> @lang('loan.label_amount')
                                </div>
                                <p style="font-size:.8rem;color:#6b7280;margin-bottom:.6rem;">
                                    @lang('loan.preset_hint')
                                </p>
                                <div class="chip-group">
                                    <template x-for="v in amounts" :key="v">
                                        <button type="button" class="chip"
                                                :class="selAmount === v && customAmt === '' ? 'active' : ''"
                                                @click="pickAmount(v)"
                                                x-text="fmtAmt(v)"></button>
                                    </template>
                                </div>
                                {{-- Champ libre toujours visible --}}
                                <div class="free-input-row mt-2">
                                    <label>
                                        <i class="fas fa-keyboard" style="margin-right:.3rem;color:var(--gold);"></i>
                                        @lang('loan.label_other') :
                                    </label>
                                    <input type="number" x-model="customAmt" @input="selAmount = null"
                                           :min="minAmount" :max="maxAmount" step="100"
                                           placeholder="{{ __('loan.placeholder_amount') }}">
                                    <span class="sym" x-text="currency.symbol"></span>
                                </div>
                                <p x-show="amountOutOfRange" x-cloak style="font-size:.75rem;color:#dc2626;margin:.4rem 0 0;">
                                    <i class="fas fa-exclamation-circle" style="margin-right:.25rem;"></i>
                                    {{ __('loan.amount_range_hint', ['min' => number_format((float) $loanSetting->min_amount, 0, ',', ' '), 'max' => number_format((float) $loanSetting->max_amount, 0, ',', ' ')]) }}
                                </p>
                            </div>

                            <button type="button" class="btn-primary btn-primary--lg w-100 justify-content-center"
                                    :disabled="!canProceed" :style="!canProceed ? 'opacity:.5;cursor:not-allowed;' : ''"
                                    @click="nextStep()">
                                @lang('loan.next_button') <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>

                        {{-- ═══════════ ÉTAPE 2 : COORDONNÉES ═══════════ --}}
                        <div x-show="step === 2" x-cloak>

                            {{-- Rappel du montant choisi --}}
                            <div class="step-summary">
                                <div>
                                    <div class="step-summary__label">@lang('loan.summary_amount_label')</div>
                                    <div class="step-summary__value" x-text="fmtAmt(amount)"></div>
                                </div>
                                <span class="step-summary__edit" @click="prevStep()">
                                    <i class="fas fa-pen" style="margin-right:.3rem;"></i>@lang('loan.back_to_quote')
                                </span>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>@lang('loan.label_name') <span style="color:var(--gold);">*</span></label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ old('name') }}"
                                               placeholder="@lang('loan.placeholder_name')" required>
                                        @error('name')<span class="form-error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('loan.label_email') <span style="color:var(--gold);">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ old('email') }}"
                                               placeholder="@lang('loan.placeholder_email')" required>
                                        @error('email')<span class="form-error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('loan.label_phone') <span style="color:var(--gold);">*</span></label>
                                        <input type="text" name="phone" class="form-control"
                                               value="{{ old('phone') }}"
                                               placeholder="@lang('loan.placeholder_phone')" required>
                                        @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>@lang('loan.label_program') <span style="color:var(--gold);">*</span></label>
                                        <select name="subject" class="form-control" required>
                                            <option value="">— @lang('contact.subject') —</option>
                                            <option value="Solidarité & Santé"        {{ old('subject')=='Solidarité & Santé'        ?'selected':'' }}>@lang('menu.personal')</option>
                                            <option value="Développement local"       {{ old('subject')=='Développement local'       ?'selected':'' }}>@lang('menu.home_loan')</option>
                                            <option value="Agriculture"               {{ old('subject')=='Agriculture'               ?'selected':'' }}>@lang('menu.auto')</option>
                                            <option value="Entrepreneuriat"           {{ old('subject')=='Entrepreneuriat'           ?'selected':'' }}>@lang('menu.business')</option>
                                            <option value="Éducation"                 {{ old('subject')=='Éducation'                 ?'selected':'' }}>@lang('menu.study')</option>
                                            <option value="Insertion professionnelle" {{ old('subject')=='Insertion professionnelle' ?'selected':'' }}>@lang('menu.bike')</option>
                                        </select>
                                        @error('subject')<span class="form-error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>@lang('loan.label_objet')
                                            <span style="font-size:.72rem;color:#9ca3af;font-weight:400;">({{ __('message.optional') }})</span>
                                        </label>
                                        <textarea name="objet" class="form-control" rows="3"
                                                  placeholder="@lang('loan.placeholder_objet')">{{ old('objet') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn-outline" @click="prevStep()">
                                            <i class="fas fa-arrow-left"></i> @lang('loan.back_to_quote')
                                        </button>
                                        <button type="submit" class="btn-primary btn-primary--lg flex-grow-1 justify-content-center">
                                            <i class="fas fa-paper-plane"></i>
                                            @lang('loan.button')
                                        </button>
                                    </div>
                                    <p style="font-size:.71rem;color:#9ca3af;text-align:center;margin-top:.55rem;">
                                        <i class="fas fa-lock" style="margin-right:.3rem;"></i>
                                        @lang('loan.form_security')
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>

                    @endif {{-- /session('success') --}}

                </div>
            </div>{{-- /col-lg-8 --}}

            {{-- ══════════ SIDEBAR ══════════ --}}
            <div class="col-lg-4 wow fadeInRight" data-wow-duration="900ms" data-wow-delay="150ms">
                <div style="position:sticky;top:110px;" class="service-sidebar">

                    <div class="contact-widget">
                        <div class="contact-widget__icon"><i class="fas fa-phone-alt"></i></div>
                        <h4>@lang('contact.phone_title')</h4>
                        <p>@lang('loan.sidebar_hours')</p>
                        @if($siteContact->phone_1)
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $siteContact->phone_1) }}" class="contact-widget__phone">{{ $siteContact->phone_1 }}</a>
                        @endif
                        <a href="{{ route('contact', ['locale' => $locale]) }}"
                           class="btn-outline w-100 justify-content-center mt-2">
                            <i class="fas fa-envelope"></i> @lang('menu.contact')
                        </a>
                    </div>

                    <div class="service-sidebar__widget mt-3">
                        <h3 class="service-sidebar__title">@lang('home.loan_reasons.sectitle')</h3>
                        @php
                            $reasonIcons = [
                                1 => 'fa-seedling',
                                2 => 'fa-city',
                                3 => 'fa-hands-helping',
                                4 => 'fa-graduation-cap',
                                5 => 'fa-handshake',
                                6 => 'fa-people-carry',
                                7 => 'fa-stethoscope',
                                8 => 'fa-briefcase',
                            ];
                        @endphp
                        @foreach ($reasonIcons as $r => $icon)
                        <div class="reason-item">
                            <div class="reason-icon"><i class="fas {{ $icon }}"></i></div>
                            <div>
                                <div class="reason-title">@lang('home.loan_reasons.reasons.title' . $r)</div>
                                <p class="reason-desc">@lang('home.loan_reasons.reasons.desc' . $r)</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
