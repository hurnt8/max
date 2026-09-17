@extends('layouts.app')
@section('title', __('menu.about'))

@section('content')
@php $locale = app()->getLocale(); @endphp

@push('styles')
<style>
.about-engage-card {
    display:flex; gap:1rem; padding:1rem 1.25rem;
    background:var(--cream); border-radius:12px;
    border-left:3px solid var(--gold); margin-bottom:.75rem;
}
.about-engage-icon {
    width:42px; height:42px; flex-shrink:0; border-radius:10px;
    background:var(--gold-pale); display:flex; align-items:center;
    justify-content:center; color:var(--gold-dark); font-size:1rem;
}
.about-engage-title { font-size:.875rem; font-weight:800; color:var(--navy); margin-bottom:.2rem; }
.about-engage-desc  { font-size:.78rem; color:#6b7280; margin:0; line-height:1.55; }
</style>
@endpush

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

{{-- About intro --}}
<section class="py-24 bg-white">
    <div class="container">
        <div class="row g-4 gutter-y-60 align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-duration="900ms">
                <div class="about-image-wrap">
                    <img src="{{ asset('assets/images/about/about-1-1.jpg') }}"
                         alt="{{ site_name() }}" class="about-image-main">
                    <img src="{{ asset('assets/images/about/about-2-1.jpg') }}"
                         alt="" class="about-image-secondary"
                         style="width:38%;right:1rem;bottom:1rem;">
                    <div class="about-badge">
                        <span class="about-badge__number">15</span>
                        <span class="about-badge__label">{{ __('home.about.exptitle') }}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 wow fadeInRight" data-wow-duration="900ms" data-wow-delay="150ms">
                <div class="section-label">{{ __('home.about.sectagline') }}</div>
                <h2 class="section-title">{{ __('home.about.sectitle') }}</h2>

                <p style="color:var(--gray-500);font-size:.9375rem;line-height:1.8;margin-bottom:1rem;">
                    {{ __('home.about.text2') }}
                </p>
                <p style="color:var(--gray-500);font-size:.9375rem;line-height:1.8;margin-bottom:1.5rem;">
                    {{ __('home.about.mission_text2') }}
                </p>

                {{-- 3 engagements clés --}}
                <div class="about-engage-card">
                    <div class="about-engage-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <div class="about-engage-title">{{ __('home.about.engage1_title') }}</div>
                        <p class="about-engage-desc">{{ __('home.about.engage1_desc') }}</p>
                    </div>
                </div>
                <div class="about-engage-card">
                    <div class="about-engage-icon"><i class="fas fa-bolt"></i></div>
                    <div>
                        <div class="about-engage-title">{{ __('home.about.engage2_title') }}</div>
                        <p class="about-engage-desc">{{ __('home.about.engage2_desc') }}</p>
                    </div>
                </div>
                <div class="about-engage-card" style="margin-bottom:1.5rem;">
                    <div class="about-engage-icon"><i class="fas fa-globe"></i></div>
                    <div>
                        <div class="about-engage-title">{{ __('home.about.engage3_title') }}</div>
                        <p class="about-engage-desc">{{ __('home.about.engage3_desc') }}</p>
                    </div>
                </div>

                {{-- Types de prêts proposés --}}
                <div style="margin-bottom:.5rem;font-size:.68rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:var(--navy);">
                    <i class="fas fa-tags" style="color:var(--gold);margin-right:.35rem;"></i>@lang('home.discover_our_loan_services')
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:.4rem;margin-bottom:1.5rem;">
                    @foreach([
                        ['fas fa-hands-holding-circle', 'home.personal_loan'],
                        ['fas fa-city',                 'home.mortgage_loan'],
                        ['fas fa-seedling',             'home.auto_loan'],
                        ['fas fa-graduation-cap',        'home.student_loan'],
                        ['fas fa-briefcase',             'home.business_loan'],
                        ['fas fa-hand-holding-dollar',  'home.microcredit'],
                    ] as $t)
                    <span style="display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .75rem;border-radius:999px;background:var(--cream);border:1px solid #e2ddd0;font-size:.75rem;font-weight:700;color:var(--navy);">
                        <i class="{{ $t[0] }}" style="color:var(--gold-dark);font-size:.7rem;"></i> @lang($t[1])
                    </span>
                    @endforeach
                </div>

                <a href="{{ route('loan', ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                    <i class="fas fa-file-signature"></i> @lang('menu.loan')
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Nos appuis & Notre engagement --}}
<section class="py-24" style="background:var(--cream);">
    <div class="container">
        <div class="row g-4 gutter-y-40">

            <div class="col-lg-6 wow fadeInLeft" data-wow-duration="800ms">
                <div class="card-glass" style="padding:2rem;height:100%;">
                    <div class="section-label">{{ __('home.about.supports_title') }}</div>
                    <p style="color:var(--gray-500);font-size:.92rem;line-height:1.75;margin:.5rem 0 1.25rem;">
                        {{ __('home.about.supports_intro') }}
                    </p>
                    <ul style="list-style:none;margin:0 0 1.25rem;padding:0;">
                        @foreach (__('home.about.supports') as $support)
                        <li style="display:flex;align-items:flex-start;gap:.65rem;margin-bottom:.75rem;font-size:.9rem;color:var(--navy);line-height:1.55;">
                            <i class="fas fa-check" style="color:var(--gold);margin-top:.3rem;flex-shrink:0;"></i>
                            <span>{{ $support }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <p style="font-size:.82rem;color:#6b7280;line-height:1.65;margin:0;">
                        {{ __('home.about.supports_note') }}
                    </p>
                </div>
            </div>

            <div class="col-lg-6 wow fadeInRight" data-wow-duration="800ms" data-wow-delay="150ms">
                <div class="card-glass" style="padding:2rem;height:100%;">
                    <div class="section-label">{{ __('home.about.commitment_title') }}</div>
                    <p style="color:var(--gray-500);font-size:.92rem;line-height:1.75;margin:.5rem 0 1.25rem;">
                        {{ __('home.about.commitment_text') }}
                    </p>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.25rem;">
                        @foreach ([1,2,3,4] as $v)
                        <div>
                            <div style="font-size:.85rem;font-weight:800;color:var(--navy);margin-bottom:.2rem;">
                                <i class="fas fa-circle" style="font-size:.35rem;color:var(--gold);margin-right:.4rem;vertical-align:middle;"></i>{{ __('home.about.values.title' . $v) }}
                            </div>
                            <p style="font-size:.78rem;color:#6b7280;margin:0;line-height:1.5;">{{ __('home.about.values.desc' . $v) }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div style="display:flex;gap:.75rem;padding:1rem 1.15rem;background:var(--gold-pale);border-left:3px solid var(--gold-dark);border-radius:10px;">
                        <i class="fas fa-circle-info" style="color:var(--gold-dark);margin-top:.15rem;flex-shrink:0;"></i>
                        <p style="font-size:.8rem;color:var(--navy);line-height:1.6;margin:0;font-weight:600;">
                            {{ __('home.about.disclaimer') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Stats --}}
<section style="background:var(--navy);">
    <div class="container">
        <div class="row">
            @php
            $stats = [
                ['stop'=>'8500','suffix'=>'+','prefix'=>'', 'label'=> __('home.customer_satisfaction_rate')],
                ['stop'=>'500',  'suffix'=>'k','prefix'=>'€','label'=> __('home.total_loan_amount_granted')],
                ['stop'=>'24',  'suffix'=>'h','prefix'=>'', 'label'=> __('home.average_approval_time')],
                ['stop'=>'15',   'suffix'=>'+','prefix'=>'', 'label'=> __('home.years_experience')],
            ];
            @endphp
            @foreach ($stats as $i => $stat)
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-duration="800ms" data-wow-delay="{{ $i*80 }}ms">
                <div class="stat-item {{ $i < 3 ? 'stat-item--sep' : '' }}">
                    <div class="stat-item__number">
                        @if($stat['prefix'])<span style="font-size:.6em;margin-right:2px;">{{ $stat['prefix'] }}</span>@endif
                        <span class="count-text" data-stop="{{ $stat['stop'] }}" data-speed="1500">{{ $stat['stop'] }}</span>
                        @if($stat['suffix'])<span style="font-size:.6em;margin-left:2px;">{{ $stat['suffix'] }}</span>@endif
                    </div>
                    <div class="stat-item__label">{{ $stat['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Notre vision --}}
<section class="py-24 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center wow fadeInUp" data-wow-duration="800ms">
                <div class="section-label justify-content-center">{{ __('home.about.vision_tagline') }}</div>
                <h2 class="section-title">{{ __('home.about.vision_title') }}</h2>
                <p style="color:var(--gray-500);font-size:.95rem;line-height:1.85;margin-bottom:1.25rem;">
                    {{ __('home.about.vision_text1') }}
                </p>
                <p style="color:var(--gray-500);font-size:.95rem;line-height:1.85;margin-bottom:2rem;">
                    {{ __('home.about.vision_text2') }}
                </p>
                <p style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;color:var(--navy);border-top:2px solid var(--gold);padding-top:1.5rem;display:inline-block;margin:0;">
                    {{ __('home.about.vision_ambition') }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Why choose us --}}
<section class="py-24" style="background:var(--cream);">
    <div class="container">
        <div class="text-center mb-14">
            <div class="section-label justify-content-center">{{ __('home.loan_reasons.sectagline') }}</div>
            <h2 class="section-title">{{ __('home.loan_reasons.sectitle') }}</h2>
        </div>
        <div class="row g-4 gutter-y-30">
            @foreach ([1,2,3] as $r)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="800ms" data-wow-delay="{{ ($r-1)*80 }}ms">
                <div class="card-glass p-8" style="padding:2rem;">
                    <div style="width:52px;height:52px;background:var(--gold-pale);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);font-size:1.25rem;margin-bottom:1.25rem;">
                        <i class="fas fa-{{ $r===1 ? 'shield-alt' : ($r===2 ? 'bolt' : 'headset') }}"></i>
                    </div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:1.125rem;font-weight:700;color:var(--navy);margin-bottom:.625rem;">
                        {{ __('home.loan_reasons.reasons.title' . $r) }}
                    </h3>
                    <p style="font-size:.875rem;color:var(--gray-500);line-height:1.75;margin:0;">
                        {{ __('home.loan_reasons.reasons.desc' . $r) }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Agir avec nous --}}
<section class="cta-banner">
    <div class="container">
        <div class="row align-items-center gutter-y-30">
            <div class="col-lg-7 wow fadeInLeft" data-wow-duration="900ms">
                <div class="section-label" style="color:var(--gold);">{{ __('home.about.act_label') }}</div>
                <h2 class="section-title section-title--white mb-2">{{ __('home.about.act_title') }}</h2>
                <p class="section-sub section-sub--white">{{ __('home.about.act_text') }}</p>
                <p style="color:rgba(255,255,255,.5);font-size:.85rem;margin-top:1rem;font-style:italic;">{{ __('home.about.act_signature') }}</p>
            </div>
            <div class="col-lg-5 text-lg-end wow fadeInRight" data-wow-duration="900ms" data-wow-delay="150ms">
                <div class="d-flex flex-wrap justify-content-lg-end gap-3">
                    <a href="{{ route('loan', ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                        <i class="fas fa-file-signature"></i> @lang('menu.loan')
                    </a>
                    <a href="{{ route('services', ['locale' => $locale]) }}" class="btn-outline-white">
                        <i class="fas fa-hand-holding-heart"></i> @lang('menu.services')
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
