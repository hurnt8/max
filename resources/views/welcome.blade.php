@extends('layouts.app')
@section('title', __('menu.home'))
@section('body_class', 'is-home')

@section('content')
@php $locale = app()->getLocale(); @endphp

{{-- ============================================================
     HERO + CAROUSEL
============================================================ --}}
<section class="hero-split">
    <div class="hero-split__text wow fadeInLeft" data-wow-duration="900ms">
        <div class="hero-badge">{{ __('home.hero_badge') }}</div>
        <h1 class="font-serif">
            {{ __('home.hero_title1') }}
            <span class="accent">{{ __('home.hero_title2') }}</span>
        </h1>
        <p class="hero-split__lead">{{ __('home.hero_subtitle') }}</p>
        <div class="hero-split__pills">
            @foreach ([['fas fa-user-check', 'home.hero_pill1'], ['fas fa-laptop', 'home.hero_pill2'], ['fas fa-file-contract', 'home.hero_pill3']] as $pill)
            <span><i class="{{ $pill[0] }}"></i> {{ __($pill[1]) }}</span>
            @endforeach
        </div>
        <div class="hero-split__actions">
            <a href="{{ route('loan', ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                <i class="fas fa-file-signature"></i> @lang('menu.loan')
            </a>
            <a href="{{ route('services', ['locale' => $locale]) }}" class="btn-outline-dark">
                @lang('menu.services')
            </a>
        </div>
        <div class="hero-split__steps">
            @foreach ([0, 1, 3] as $i => $k)
            <div class="hero-split__step">
                <b>0{{ $i + 1 }}</b>
                <span>{{ __('about.steps')[$k][0] }}</span>
            </div>
            @endforeach
        </div>
    </div>
    <div class="hero-split__media" role="img" aria-label=""
         style="background-image:url('{{ asset('assets/images/backgrounds/main-slider-bg-1-1.jpg') }}');"></div>
</section>
<style>@keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(6px)}}</style>

{{-- ============================================================
     SERVICE NAV STRIP
============================================================ --}}
@php
$serviceNav = [
    ['route' => 'services.personal', 'icon' => 'fas fa-user-tie', 'label' => 'menu.personal'],
    ['route' => 'services.home',     'icon' => 'fas fa-city',                 'label' => 'menu.home_loan'],
    ['route' => 'services.auto',     'icon' => 'fas fa-seedling',             'label' => 'menu.auto'],
    ['route' => 'services.business', 'icon' => 'fas fa-briefcase',            'label' => 'menu.business'],
    ['route' => 'services.study',    'icon' => 'fas fa-graduation-cap',       'label' => 'menu.study'],
];
@endphp
<div class="service-nav-strip" id="services-strip">
    <div class="service-nav-strip__inner">
        @foreach ($serviceNav as $nav)
        <a href="{{ route($nav['route'], ['locale' => $locale]) }}" class="service-nav-strip__item">
            <div class="service-nav-strip__icon"><i class="{{ $nav['icon'] }}"></i></div>
            <span class="service-nav-strip__label">@lang($nav['label'])</span>
        </a>
        @endforeach
    </div>
</div>

{{-- ============================================================
     ABOUT
============================================================ --}}
@push('styles')
<style>
/* ── About section ── */
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

.about-loan-grid {
    display:grid; grid-template-columns:1fr 1fr; gap:.4rem .75rem; margin-bottom:1.25rem;
}
.about-loan-item {
    display:flex; align-items:center; gap:.55rem;
    font-size:.82rem; font-weight:600; color:var(--navy); padding:.4rem 0;
    border-bottom:1px solid #f3f4f6;
}
.about-loan-item i { color:var(--gold); width:16px; text-align:center; font-size:.8rem; }

</style>
@endpush

<section class="py-24 bg-white" id="about">
    <div class="container">
        <div class="row gutter-y-60 align-items-center">

            {{-- ── Image ── --}}
            <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1000ms">
                <div class="about-image-wrap">
                    <img src="{{ asset('assets/images/about/about-3-1.jpg') }}"
                         alt="{{ site_name() }}" class="about-image-main">
                    <img src="{{ asset('assets/images/about/about-3-3.jpg') }}"
                         alt="" class="about-image-secondary"
                         style="width:38%;right:1rem;bottom:1rem;">
                    
                </div>
            </div>

            {{-- ── Contenu ── --}}
            <div class="col-lg-6 wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="150ms">

                <div class="section-label">{{ __('about.who_label') }}</div>
                <h2 class="section-title">{{ __('about.who_title') }}</h2>

                <p style="color:var(--gray-500);font-size:.9375rem;line-height:1.8;margin-bottom:1.5rem;">
                    {{ __('about.who_text1', ['name' => site_name()]) }}
                </p>

                {{-- 3 engagements clés --}}
                <div class="about-engage-card">
                    <div class="about-engage-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <div class="about-engage-title">{{ __('about.commits')[0][0] }}</div>
                        <p class="about-engage-desc">{{ __('about.commits')[0][1] }}</p>
                    </div>
                </div>
                <div class="about-engage-card">
                    <div class="about-engage-icon"><i class="fas fa-bolt"></i></div>
                    <div>
                        <div class="about-engage-title">{{ __('about.commits')[1][0] }}</div>
                        <p class="about-engage-desc">{{ __('about.commits')[1][1] }}</p>
                    </div>
                </div>
                <div class="about-engage-card" style="margin-bottom:1.5rem;">
                    <div class="about-engage-icon"><i class="fas fa-globe"></i></div>
                    <div>
                        <div class="about-engage-title">{{ __('about.commits')[2][0] }}</div>
                        <p class="about-engage-desc">{{ __('about.commits')[2][1] }}</p>
                    </div>
                </div>

                {{-- Types de prêts --}}
                <div style="font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:var(--navy);margin-bottom:.6rem;">
                    <i class="fas fa-tags" style="color:var(--gold);margin-right:.35rem;"></i>@lang('home.discover_our_loan_services')
                </div>
                <div class="about-loan-grid">
                    <div class="about-loan-item"><i class="fas fa-user-tie"></i> @lang('home.personal_loan')</div>
                    <div class="about-loan-item"><i class="fas fa-city"></i> @lang('home.mortgage_loan')</div>
                    <div class="about-loan-item"><i class="fas fa-seedling"></i> @lang('home.auto_loan')</div>
                    <div class="about-loan-item"><i class="fas fa-graduation-cap"></i> @lang('home.student_loan')</div>
                    <div class="about-loan-item"><i class="fas fa-briefcase"></i> @lang('home.business_loan')</div>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('loan', ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                        <i class="fas fa-file-signature"></i> @lang('menu.loan')
                    </a>
                    <a href="{{ route('about', ['locale' => $locale]) }}" class="btn-outline">
                        @lang('menu.about') <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     SERVICES GRID
============================================================ --}}
<section class="py-24" style="background:var(--cream);" id="services">
    <div class="container">
        <div class="row align-items-end mb-12">
            <div class="col-lg-8">
                <div class="section-label">{{ __('home.services.sectagline') }}</div>
                <h2 class="section-title mb-0">{{ __('home.services.sectitle') }}</h2>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <a href="{{ route('services', ['locale' => $locale]) }}" class="btn-outline">
                    @lang('menu.services') <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="row g-4 gutter-y-30 justify-content-center">
            @php
            $services = [
                ['route' => 'services.personal', 'img' => 'service-3-1.jpg', 'label' => 'menu.personal',  'type' => 'personal_loan', 'icon' => 'fas fa-user-tie'],
                ['route' => 'services.study',    'img' => 'service-3-2.jpg', 'label' => 'menu.study',     'type' => 'study_loan', 'icon' => 'fas fa-graduation-cap'],
                ['route' => 'services.home',     'img' => 'service-3-3.jpg', 'label' => 'menu.home_loan', 'type' => 'home_loan', 'icon' => 'fas fa-home'],
                ['route' => 'services.business', 'img' => 'service-3-4.jpg', 'label' => 'menu.business',  'type' => 'business_loan', 'icon' => 'fas fa-briefcase'],
                ['route' => 'services.auto',     'img' => 'service-3-5.jpg', 'label' => 'menu.auto',      'type' => 'auto_loan', 'icon' => 'fas fa-car'],
            ];
            @endphp
            @foreach ($services as $i => $svc)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="800ms" data-wow-delay="{{ $i * 80 }}ms">
                <div class="service-card">
                    <div class="service-card__image">
                        <img src="{{ asset('assets/images/services/' . $svc['img']) }}" alt="@lang($svc['label'])">
                        <div class="service-card__image__overlay"></div>
                    </div>
                    <div class="service-card__body">
                        <div class="service-card__icon"><i class="{{ $svc['icon'] }}"></i></div>
                        <h3 class="service-card__title">
                            <a href="{{ route($svc['route'], ['locale' => $locale]) }}">@lang($svc['label'])</a>
                        </h3>
                        <p class="service-card__desc">{{ Str::before(Str::before(__('loan.' . $svc['type'] . '.description'), ' Chaque'), ' Each') }}</p>
                        <a href="{{ route($svc['route'], ['locale' => $locale]) }}" class="service-card__link">
                            @lang('menu.read_more') <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     HOW IT WORKS
============================================================ --}}
<section class="py-24 bg-white">
    <div class="container">
        <div class="text-center mb-14">
            <div class="section-label justify-content-center">{{ __('about.steps_label') }}</div>
            <h2 class="section-title section-title">{{ __('about.steps_title') }}</h2>
        </div>
        <ol class="process-list">
            @foreach ([1,2,3,4] as $s)
            <li class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="{{ ($s-1)*80 }}ms">
                <span class="process-list__num">0{{ $s }}</span>
                <h3 class="process-list__title">{{ __('about.steps')[$s - 1][0] }}</h3>
                <p class="process-list__desc">{{ __('about.steps')[$s - 1][1] }}</p>
            </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- ============================================================
     DEMANDE D'AIDE — sans simulation, juste le montant
============================================================ --}}
<section class="calc-section py-24" id="simulate">
    <div class="container">
        <div class="row gutter-y-50 align-items-center">
            <div class="col-lg-5 wow fadeInLeft" data-wow-duration="900ms">
                <div class="section-label" style="color:var(--gold);">{{ __('about.commit_label') }}</div>
                <h2 class="section-title section-title--white">{{ __('about.commit_title') }}</h2>
                <p class="section-sub section-sub--white mb-8">{{ __('about.who_text2') }}</p>

                @foreach ([1,2,3] as $r)
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div style="width:36px;height:36px;background:rgba(184,150,79,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--gold);flex-shrink:0;">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <h4 style="font-family:'Playfair Display',serif;font-size:1rem;font-weight:700;color:#fff;margin:0 0 .25rem;">
                            {{ __('about.commits')[$r - 1][0] }}
                        </h4>
                        <p style="font-size:.875rem;color:rgba(255,255,255,.55);margin:0;line-height:1.65;">
                            {{ __('about.commits')[$r - 1][1] }}
                        </p>
                    </div>
                </div>
                @endforeach

                <div class="mt-6">
                    <a href="{{ route('loan', ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                        <i class="fas fa-file-signature"></i> @lang('menu.loan')
                    </a>
                </div>
            </div>

            <div class="col-lg-6 offset-lg-1 wow fadeInRight" data-wow-duration="900ms" data-wow-delay="150ms">
                <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:2.5rem 2.25rem;text-align:center;">
                    <div style="width:56px;height:56px;border-radius:50%;background:rgba(184,150,79,.15);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                        <i class="fas fa-hand-holding-heart" style="font-size:1.4rem;color:var(--gold);"></i>
                    </div>
                    <h3 style="font-family:'Playfair Display',serif;color:#fff;font-size:1.4rem;font-weight:700;margin-bottom:.75rem;">
                        {{ __('home.cta_title') }}
                    </h3>
                    <p style="color:rgba(255,255,255,.6);font-size:.92rem;line-height:1.7;margin-bottom:1.75rem;">
                        {{ __('home.cta_text') }}
                    </p>
                    <a href="{{ route('loan', ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                        <i class="fas fa-paper-plane"></i> {{ __('home.cta_button') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     CTA BANNER
============================================================ --}}
<section class="cta-banner">
    <div class="container">
        <div class="row align-items-center gutter-y-30">
            <div class="col-lg-7 wow fadeInLeft" data-wow-duration="900ms">
                <h2 class="section-title section-title--white mb-2">@lang('about.cta_title')</h2>
                <p class="section-sub section-sub--white mb-0">@lang('about.cta_text')</p>
            </div>
            <div class="col-lg-5 text-lg-end wow fadeInRight" data-wow-duration="900ms" data-wow-delay="150ms">
                <div class="d-flex flex-wrap justify-content-lg-end gap-3">
                    <a href="{{ route('loan',    ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                        <i class="fas fa-file-signature"></i> @lang('menu.loan')
                    </a>
                    <a href="{{ route('contact', ['locale' => $locale]) }}" class="btn-outline-white">
                        <i class="fas fa-envelope"></i> @lang('menu.contact')
                    </a>
                </div>
            </div>
        </div>

        <hr style="border-color:rgba(255,255,255,.08);margin:3rem 0;">

        <div class="row align-items-center gutter-y-20">
            <div class="col-lg-4 wow fadeInLeft" data-wow-duration="900ms">
                <p style="color:rgba(255,255,255,.6);font-size:.9375rem;margin:0;">@lang('menu.newsletter_title')</p>
            </div>
            <div class="col-lg-8 text-lg-end wow fadeInRight" data-wow-duration="900ms" data-wow-delay="100ms">
                <form action="{{ route('subscribe.send') }}" method="POST" class="newsletter-form d-inline-flex">
                    @csrf
                    <input type="email" name="email" placeholder="@lang('menu.email_placeholder')" required>
                    <button type="submit" class="btn-primary">@lang('menu.subscribe')</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
