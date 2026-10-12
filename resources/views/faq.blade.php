@extends('layouts.app')
@section('title', __('menu.faq'))

@section('content')
@php $locale = app()->getLocale(); @endphp

{{-- Page hero --}}
<div class="page-hero">
    <div class="container">
        <div class="page-hero__content">
            <h1 class="page-hero__title">@lang('menu.faq')</h1>
            <ul class="page-hero__breadcrumb">
                <li><a href="{{ route('home', ['locale' => $locale]) }}">@lang('menu.home')</a></li>
                <li class="sep"><i class="fas fa-chevron-right"></i></li>
                <li>@lang('menu.faq')</li>
            </ul>
        </div>
    </div>
</div>

{{-- FAQ --}}
<section class="py-24 bg-white">
    <div class="container">
        <div class="row gutter-y-50 align-items-start">

            {{-- Sticky sidebar --}}
            <div class="col-lg-4 d-none d-lg-block wow fadeInLeft" data-wow-duration="900ms">
                <div style="position:sticky;top:110px;">
                    <img src="{{ asset('assets/images/resources/why-choose-1-1.jpg') }}"
                         alt=""
                         style="width:100%;border-radius:var(--radius-xl);height:360px;object-fit:cover;box-shadow:var(--shadow-hover);">
                    <div class="contact-widget mt-4">
                        <div class="contact-widget__icon"><i class="fas fa-headset"></i></div>
                        <h4>{{ __('faq.help_title') }}</h4>
                        <p>{{ __('faq.help_text') }}</p>
                        <a href="tel:{{ site_phone_href() }}" class="contact-widget__phone">{{ site_phone() }}</a>
                        <a href="{{ route('contact', ['locale' => $locale]) }}"
                           class="btn-primary w-100 justify-content-center">
                            <i class="fas fa-envelope"></i> @lang('menu.contact')
                        </a>
                    </div>
                </div>
            </div>

            {{-- FAQ accordions (Alpine.js) --}}
            <div class="col-lg-8 wow fadeInRight" data-wow-duration="900ms" data-wow-delay="100ms">
                <div class="section-label mb-2">@lang('menu.faq')</div>
                <h2 class="section-title mb-8">{{ __('faq.title') }}</h2>

                <div x-data="{ open: 1 }" class="mb-6">
                    @foreach (__('faq.items') as $i => $item)
                    @php $qn = $i + 1; @endphp
                    <div class="accordion-item mb-1" style="border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow-card);">
                        <button type="button"
                                class="faq-btn"
                                :class="open === {{ $qn }} ? 'is-open' : ''"
                                @click="open = (open === {{ $qn }}) ? null : {{ $qn }}"
                                :aria-expanded="open === {{ $qn }} ? 'true' : 'false'">
                            <span>{{ $item[0] }}</span>
                            <span class="faq-btn__icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-body" x-show="open === {{ $qn }}" style="{{ $qn !== 1 ? 'display:none' : '' }}">
                            {{ $item[1] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-banner">
    <div class="container">
        <div class="row align-items-center gutter-y-30">
            <div class="col-lg-8 wow fadeInLeft" data-wow-duration="900ms">
                <div class="section-label" style="color:var(--gold);">{{ __('home.faq_cta.label') }}</div>
                <h2 class="section-title section-title--white mb-2">
                    {{ __('home.faq_cta.title') }}
                </h2>
                <p class="section-sub section-sub--white">
                    {{ __('home.faq_cta.text') }}
                </p>
            </div>
            <div class="col-lg-4 text-lg-end wow fadeInRight" data-wow-duration="900ms" data-wow-delay="100ms">
                <a href="{{ route('contact', ['locale' => $locale]) }}" class="btn-primary btn-primary--lg">
                    <i class="fas fa-envelope"></i> @lang('menu.contact')
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
