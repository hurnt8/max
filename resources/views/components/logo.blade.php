@props([
    'variant' => 'full',   // 'full' (icone+mot-symbole) | 'icon' (monogramme seul)
    'theme'   => 'light',  // 'dark' = fond navy (badge or, texte creme) | 'light' = fond clair (badge navy, texte navy)
    'size'    => 'md',     // 'sm' | 'md' | 'lg'
    'href'    => null,     // optionnel : enrobe dans <a href="...">
    'light'   => null,     // override admin : SiteContact::current()->logo_light_path (URL resolue)
    'dark'    => null,     // override admin : SiteContact::current()->logo_dark_path (URL resolue)
    'name'    => null,     // nom du site : si omis, recupere SiteContact::current()->name
    'alt'     => null,
])

@php
    $siteName = $name ?: site_name();
    $alt      = $alt ?: $siteName;

    $words = preg_split('/\s+/', trim($siteName)) ?: [];
    if (count($words) >= 2) {
        $initials = mb_strtoupper(mb_substr($words[0], 0, 1) . mb_substr($words[1], 0, 1));
        $firstWord = $words[0];
        $restWords = implode(' ', array_slice($words, 1));
    } else {
        $initials = mb_strtoupper(mb_substr($siteName, 0, 2));
        $firstWord = $siteName;
        $restWords = null;
    }

    $overrideSrc = $theme === 'dark' ? $dark : $light;
    $box   = ['sm' => 32, 'md' => 44, 'lg' => 64][$size] ?? 44;
    $isDark = $theme === 'dark';
    $badgeBg   = $isDark ? '#1F7AC7' : '#0B1A2E';
    $badgeFg   = $isDark ? '#0B1A2E' : '#1F7AC7';
    $wordColor = $isDark ? '#F7F3EC' : '#0B1A2E';
    $gap   = round($box * 0.28);
    $wsize = round($box * 0.42);
    $tag   = $href ? 'a' : 'span';
@endphp

@if($overrideSrc)
    <{{ $tag }} @if($href) href="{{ $href }}" @endif
        {{ $attributes->merge(['class' => 'sg-logo sg-logo--img']) }}
        style="display:inline-flex;align-items:center;text-decoration:none">
        <img src="{{ $overrideSrc }}" alt="{{ $alt }}" style="height:{{ $box }}px;width:auto;display:block;object-fit:contain">
    </{{ $tag }}>
@else
    <{{ $tag }} @if($href) href="{{ $href }}" @endif
        {{ $attributes->merge(['class' => 'sg-logo']) }}
        style="display:inline-flex;align-items:center;gap:{{ $gap }}px;line-height:1;text-decoration:none">
        <svg width="{{ $box }}" height="{{ $box }}" viewBox="0 0 44 44" role="img" aria-label="{{ $alt }}" style="flex-shrink:0;display:block">
            <rect width="44" height="44" rx="10" fill="{{ $badgeBg }}"/>
            <text x="22" y="29" text-anchor="middle" font-family="'Playfair Display',Georgia,serif" font-weight="700" font-size="19" fill="{{ $badgeFg }}">{{ $initials }}</text>
        </svg>
        @if($variant === 'full')
        <span style="font-family:'Playfair Display',Georgia,serif;font-weight:700;font-size:{{ $wsize }}px;color:{{ $wordColor }};white-space:nowrap">
            {{ $firstWord }}@if($restWords) <span style="color:#1F7AC7">{{ $restWords }}</span>@endif
        </span>
        @endif
    </{{ $tag }}>
@endif
