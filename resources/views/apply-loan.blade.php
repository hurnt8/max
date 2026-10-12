@extends('layouts.app')
@section('title', __('menu.loan'))

@php
    $loanSetting = \App\Models\LoanSetting::current();
    $siteContact = \App\Models\SiteContact::current();
    $currenciesForForm = \App\Models\Currency::enabledList();
@endphp

@push('styles')
<style>
/* ── Séparateurs de section ── */
.form-section-title {
    font-size:.7rem; font-weight:800; text-transform:uppercase; letter-spacing:.07em;
    color:var(--navy); margin:1.4rem 0 .7rem; display:flex; align-items:center; gap:.5rem;
}
.form-section-title:first-of-type { margin-top:0; }
.form-section-title i { color:var(--gold); }
.form-section-title::after { content:''; flex:1; height:1px; background:#eaecf0; }

/* ── Sidebar raisons ── */
.reason-item { display:flex; gap:.75rem; padding:.8rem 0; }
.reason-item + .reason-item { border-top:1px solid #f0f0f0; }
.reason-icon { width:38px; height:38px; border-radius:9px; background:rgba(212,175,55,.1); color:var(--gold); display:flex; align-items:center; justify-content:center; font-size:.9rem; flex-shrink:0; }
.reason-title { font-size:.84rem; font-weight:700; color:var(--navy); margin-bottom:.15rem; }
.reason-desc  { font-size:.75rem; color:#6b7280; line-height:1.45; margin:0; }

</style>
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
            <div class="col-lg-8">
                <div class="form-card wow fadeInLeft" data-wow-duration="700ms"
                     style="border-top:4px solid var(--gold);">

                    @if (session('success'))
                    {{-- ══ PANNEAU DE CONFIRMATION ══ --}}
                    <div style="text-align:center;padding:1.5rem .5rem 2rem;" role="status">
                        <div style="width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,#d1fae5,#a7f3d0);margin:0 auto 1.2rem;display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-check" style="font-size:1.8rem;color:#059669;"></i>
                        </div>
                        <h3 style="color:var(--navy);font-size:1.2rem;font-weight:800;margin-bottom:.6rem;">
                            {{ session('success') }}
                        </h3>
                        @if (session('loan_reference'))
                        <p style="color:var(--navy);font-size:.95rem;margin:0 0 .6rem;">
                            @lang('loan.reference_label') : <strong>{{ session('loan_reference') }}</strong>
                        </p>
                        @endif
                        <p style="color:#6b7280;font-size:.85rem;max-width:460px;margin:0 auto 1.75rem;line-height:1.6;">
                            @lang('loan.not_an_approval')
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="{{ route('home', ['locale' => $locale]) }}" class="btn-outline">
                                <i class="fas fa-home"></i> @lang('menu.home')
                            </a>
                        </div>
                    </div>
                    @else

                    <div class="mb-4">
                        <h2 style="font-family:'Playfair Display',serif;color:var(--navy);font-size:1.25rem;font-weight:700;margin:0 0 .15rem;">
                            @lang('loan.form_title')
                        </h2>
                        <p style="font-size:.8rem;color:#6b7280;margin:0;">@lang('loan.form_hint')</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4" role="alert">
                            <strong>@lang('loan.errors_title')</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('loan.request') }}" novalidate
                          onsubmit="var b=this.querySelector('[type=submit]'); if(b.dataset.sent){return false;} b.dataset.sent='1'; b.disabled=true;">
                        @csrf
                        <input type="hidden" name="locale"   value="{{ $locale }}">
                        <input type="hidden" name="currency" value="EUR">
                        {{-- Piège à robots : doit rester vide --}}
                        <div style="position:absolute;left:-9999px;" aria-hidden="true">
                            <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                        </div>

                        <div class="form-section-title"><i class="fas fa-user"></i> @lang('loan.section_identity')</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">@lang('loan.label_last_name') <span style="color:var(--gold);">*</span></label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" maxlength="120"
                                           value="{{ old('last_name') }}" autocomplete="family-name" required>
                                    @error('last_name')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">@lang('loan.label_first_name') <span style="color:var(--gold);">*</span></label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" maxlength="120"
                                           value="{{ old('first_name') }}" autocomplete="given-name" required>
                                    @error('first_name')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">@lang('loan.label_your_phone') <span style="color:var(--gold);">*</span></label>
                                    <input type="tel" id="phone" name="phone" class="form-control" maxlength="30"
                                           value="{{ old('phone') }}" placeholder="@lang('loan.placeholder_phone_intl')"
                                           autocomplete="tel" inputmode="tel" required>
                                    @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">@lang('loan.label_email') <span style="color:var(--gold);">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control" maxlength="190"
                                           value="{{ old('email') }}" placeholder="nom@exemple.com"
                                           autocomplete="email" required>
                                    @error('email')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">@lang('loan.label_residence') <span style="color:var(--gold);">*</span></label>
                                    <input type="text" id="address" name="address" class="form-control" maxlength="500"
                                           value="{{ old('address') }}" autocomplete="street-address" required>
                                    @error('address')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profession">@lang('loan.label_profession') <span style="color:var(--gold);">*</span></label>
                                    <input type="text" id="profession" name="profession" class="form-control" maxlength="150"
                                           value="{{ old('profession') }}" autocomplete="organization-title" required>
                                    @error('profession')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monthly_income">@lang('loan.label_monthly_income') <span style="color:var(--gold);">*</span></label>
                                    <input type="number" id="monthly_income" name="monthly_income" class="form-control"
                                           min="0" max="1000000" step="1" inputmode="numeric"
                                           value="{{ old('monthly_income') }}" required>
                                    @error('monthly_income')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-section-title"><i class="fas fa-coins"></i> @lang('loan.section_request')</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="amount">@lang('loan.label_amount_eur') <span style="color:var(--gold);">*</span></label>
                                    <input type="number" id="amount" name="amount" class="form-control"
                                           min="{{ (float) $loanSetting->min_amount }}" max="{{ (float) $loanSetting->max_amount }}"
                                           step="1" inputmode="numeric" value="{{ old('amount') }}" required
                                           aria-describedby="amount-hint">
                                    <small id="amount-hint" style="color:#6b7280;">
                                        {{ __('loan.amount_range_hint', ['min' => number_format((float) $loanSetting->min_amount, 0, ',', ' '), 'max' => number_format((float) $loanSetting->max_amount, 0, ',', ' ')]) }}
                                    </small>
                                    @error('amount')<span class="form-error d-block">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="objet">@lang('loan.label_motive') <span style="color:var(--gold);">*</span></label>
                                    <textarea id="objet" name="objet" class="form-control" rows="4" maxlength="2000" required>{{ old('objet') }}</textarea>
                                    @error('objet')<span class="form-error">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consent" name="consent" value="1" required>
                                    <label class="form-check-label" for="consent" style="font-size:.82rem;">
                                        @lang('loan.consent_text')
                                        <a href="{{ route('privacy', ['locale' => $locale]) }}" target="_blank" rel="noopener">@lang('loan.consent_link')</a> <span style="color:var(--gold);">*</span>
                                    </label>
                                    @error('consent')<span class="form-error d-block">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-12 mt-1">
                                <button type="submit" class="btn-primary btn-primary--lg w-100 justify-content-center">
                                    <i class="fas fa-paper-plane"></i> @lang('loan.button')
                                </button>
                                <p style="font-size:.74rem;color:#6b7280;text-align:center;margin-top:.6rem;">
                                    @lang('loan.not_an_approval')
                                </p>
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
                        <h3 class="service-sidebar__title">@lang('loan.before_title')</h3>
                        @foreach ([
                            ['fa-user-check', 'loan.before_1'],
                            ['fa-clock',      'loan.before_2'],
                            ['fa-shield-alt', 'loan.before_3'],
                            ['fa-hashtag',    'loan.before_4'],
                        ] as $item)
                        <div class="reason-item">
                            <div class="reason-icon"><i class="fas {{ $item[0] }}"></i></div>
                            <div>
                                <p class="reason-desc" style="font-size:.82rem;color:var(--navy);">@lang($item[1])</p>
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
