@extends('layouts.app')
@section('title', __('menu.about'))

@section('content')
@php
    $locale = app()->getLocale();
    $siteContact = \App\Models\SiteContact::current();
    $serviceLinks = [
        ['services.personal', 'menu.personal',  'fas fa-user'],
        ['services.home',     'menu.home_loan', 'fas fa-home'],
        ['services.auto',     'menu.auto',      'fas fa-car'],
        ['services.study',    'menu.study',     'fas fa-graduation-cap'],
        ['services.business', 'menu.business',  'fas fa-briefcase'],
    ];
@endphp

{{-- Page hero --}}
<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title">@lang('menu.about')</h1>
            <ul class="page-hero__breadcrumb">
                <li><a href="{{ route('home', ['locale' => $locale]) }}">@lang('menu.home')</a></li>
                <li class="sep"><i class="fas fa-chevron-right"></i></li>
                <li>@lang('menu.about')</li>
            </ul>
        </div>
    </div>
</div>

{{-- Qui sommes-nous --}}
<section class="py-24 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-label">@lang('about.who_label')</div>
                <h2 class="section-title">@lang('about.who_title')</h2>
                <p style="color:var(--gray-500);font-size:.95rem;line-height:1.85;margin-bottom:1rem;">
                    {{ __('about.who_text1', ['name' => site_name()]) }}
                </p>
                <p style="color:var(--gray-500);font-size:.95rem;line-height:1.85;margin:0;">
                    @lang('about.who_text2')
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Nos services --}}
<section class="py-24" style="background:var(--cream);">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label justify-content-center">@lang('about.services_label')</div>
            <h2 class="section-title">@lang('about.services_title')</h2>
            <p style="color:var(--gray-500);font-size:.95rem;max-width:640px;margin:0 auto;">@lang('about.services_text')</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($serviceLinks as $svc)
            <div class="col-lg-4 col-md-6">
                <a href="{{ route($svc[0], ['locale' => $locale]) }}" class="card-glass d-flex align-items-center gap-3"
                   style="padding:1.25rem 1.5rem;text-decoration:none;">
                    <span style="width:44px;height:44px;flex-shrink:0;background:var(--gold-pale);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);">
                        <i class="{{ $svc[2] }}"></i>
                    </span>
                    <span style="font-weight:700;color:var(--navy);">@lang($svc[1])</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Déroulement --}}
<section class="py-24 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label justify-content-center">@lang('about.steps_label')</div>
            <h2 class="section-title">@lang('about.steps_title')</h2>
        </div>
        <ol style="list-style:none;margin:0 auto;padding:0;max-width:760px;">
            @foreach (__('about.steps') as $i => $step)
            <li style="display:flex;gap:1rem;align-items:flex-start;margin-bottom:1.25rem;">
                <span style="width:38px;height:38px;flex-shrink:0;border-radius:50%;background:var(--navy);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;">{{ $i + 1 }}</span>
                <div>
                    <div style="font-weight:800;color:var(--navy);margin-bottom:.2rem;">{{ $step[0] }}</div>
                    <p style="margin:0;color:var(--gray-500);font-size:.92rem;line-height:1.7;">{{ $step[1] }}</p>
                </div>
            </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- Engagements + éligibilité --}}
<section class="py-24" style="background:var(--cream);">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card-glass" style="padding:2rem;height:100%;">
                    <div class="section-label">@lang('about.commit_label')</div>
                    <h2 class="section-title" style="font-size:1.4rem;">@lang('about.commit_title')</h2>
                    <ul style="list-style:none;margin:1rem 0 0;padding:0;">
                        @foreach (__('about.commits') as $c)
                        <li style="display:flex;gap:.65rem;margin-bottom:1rem;">
                            <i class="fas fa-check" style="color:var(--gold);margin-top:.3rem;flex-shrink:0;"></i>
                            <div>
                                <div style="font-weight:800;color:var(--navy);font-size:.92rem;">{{ $c[0] }}</div>
                                <p style="margin:0;color:var(--gray-500);font-size:.88rem;line-height:1.6;">{{ $c[1] }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card-glass" style="padding:2rem;height:100%;">
                    <h2 class="section-title" style="font-size:1.25rem;">@lang('about.eligibility_title')</h2>
                    <p style="color:var(--gray-500);font-size:.92rem;line-height:1.75;">@lang('about.eligibility_text')</p>
                    <hr style="margin:1.5rem 0;">
                    <h2 class="section-title" style="font-size:1.25rem;">@lang('about.contact_title')</h2>
                    <p style="color:var(--gray-500);font-size:.92rem;line-height:1.75;">@lang('about.contact_text')</p>
                    @if ($siteContact->email)
                        <p class="mb-1"><i class="fas fa-envelope" style="color:var(--gold);"></i>
                            <a href="mailto:{{ $siteContact->email }}">{{ $siteContact->email }}</a></p>
                    @endif
                    @if ($siteContact->phone_1)
                        <p class="mb-1"><i class="fas fa-phone-alt" style="color:var(--gold);"></i>
                            <a href="tel:{{ preg_replace('/[^\d+]/', '', $siteContact->phone_1) }}">{{ $siteContact->phone_1 }}</a></p>
                    @endif
                    @if ($siteContact->address_1)
                        <p class="mb-0"><i class="fas fa-map-marker-alt" style="color:var(--gold);"></i> {{ $siteContact->address_1 }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Appel à l'action --}}
<section class="cta-banner">
    <div class="container">
        <div class="row align-items-center gutter-y-30">
            <div class="col-lg-7">
                <h2 class="section-title section-title--white mb-2">@lang('about.cta_title')</h2>
                <p class="section-sub section-sub--white">@lang('about.cta_text')</p>
            </div>
            <div class="col-lg-5 text-lg-end">
                <div class="d-flex flex-wrap justify-content-lg-end gap-3">
                    <a href="{{ route('loan', ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                        <i class="fas fa-file-signature"></i> @lang('menu.loan')
                    </a>
                    <a href="{{ route('contact', ['locale' => $locale]) }}" class="btn-outline-white">
                        <i class="fas fa-envelope"></i> @lang('menu.contact')
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
