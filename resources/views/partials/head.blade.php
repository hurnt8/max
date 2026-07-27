<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('menu.home')) |Solberg Grupo</title>
    <meta name="description" content="Credixa — solutions de financement rapides, flexibles et personnalisées à travers l'Europe.">
    <link rel="canonical" href="{{ url()->current() }}">
    @foreach (['fr', 'en', 'pl', 'es', 'bg', 'hu', 'it', 'de', 'lt', 'ro', 'lv', 'nl', 'pt'] as $l)
    <link rel="alternate" hreflang="{{ $l }}" href="{{ url($l) }}">
    @endforeach
    <link rel="icon" href="{{ asset('assets/images/favicons/favicon.png') }}">

    <!-- Fonts: Montserrat (Solberg Grupo) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    navy:      { DEFAULT:'#04203D', mid:'#0A3559', light:'#4A5D73', deep:'#02131F' },
                    gold:      { DEFAULT:'#B8883E', light:'#D2B789', pale:'#F3E8D6', dark:'#96702F' },
                    cream:     { DEFAULT:'#FFFFFF', light:'#FFFFFF' },
                },
                fontFamily: {
                    sans:  ['Montserrat','ui-sans-serif','system-ui','sans-serif'],
                    serif: ['Montserrat','ui-sans-serif','system-ui','sans-serif'],
                },
                boxShadow: {
                    'card':  '0 1px 3px rgba(4,32,61,.06), 0 4px 16px rgba(4,32,61,.08)',
                    'card-hover': '0 4px 8px rgba(4,32,61,.08), 0 16px 40px rgba(4,32,61,.12)',
                    'gold':  '0 4px 24px rgba(184,136,62,.30)',
                    'nav':   '0 1px 0 rgba(4,32,61,.08)',
                },
                animation: {
                    'fade-in-up': 'fadeInUp .6s ease forwards',
                    'fade-in':    'fadeIn .5s ease forwards',
                    'pulse-slow': 'pulse 3s cubic-bezier(.4,0,.6,1) infinite',
                },
                keyframes: {
                    fadeInUp: { '0%':{ opacity:'0', transform:'translateY(24px)' }, '100%':{ opacity:'1', transform:'translateY(0)' } },
                    fadeIn:   { '0%':{ opacity:'0' }, '100%':{ opacity:'1' } },
                }
            }
        }
    }
    </script>

    <!-- Vendor: Bootstrap (grid + dropdown) -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <!-- Vendor: Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/easilon-icons/style.css') }}">
    <!-- Vendor: noUiSlider (loan calculator) -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/nouislider/nouislider.min.css') }}">

    <!-- Design system -->
    <link rel="stylesheet" href="{{ asset('assets/css/royal.css') }}">

    @stack('styles')
</head>
<body class="font-sans antialiased bg-white text-gray-900 @yield('body_class')" x-data="{ mobileOpen: false }">
