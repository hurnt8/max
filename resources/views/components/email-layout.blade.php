@props([
    'title'      => 'Solberg Grupo',
    'subtitle'   => 'Espace Client Sécurisé',
    'accent'     => 'teal',   // teal | green | orange | red
    'footerNote' => null,
])

@php
$palettes = [
    'teal'   => ['btn'=>'#0B1A2E', 'code'=>'#0B1A2E'],
    'green'  => ['btn'=>'#15803D', 'code'=>'#15803D'],
    'orange' => ['btn'=>'#B45309', 'code'=>'#B45309'],
    'red'    => ['btn'=>'#B91C1C', 'code'=>'#B91C1C'],
];
$p = $palettes[$accent] ?? $palettes['teal'];
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $title }}</title>
<style>
body{margin:0;padding:0;background:#F1F3F6;font-family:'Segoe UI',Helvetica,Arial,sans-serif;-webkit-font-smoothing:antialiased}
img{border:0;outline:0}
table{border-collapse:collapse}
.wrap{max-width:580px;margin:32px auto;background:#FFFFFF;border-radius:14px;overflow:hidden;border:1px solid #E5E7EB}
/* ── Header ── */
.hdr{background:#0B1A2E;padding:28px 44px;text-align:center}
.logo-outer{width:60px;height:60px;border-radius:14px;margin:0 auto 14px;overflow:hidden;background:#C8A951;display:inline-flex;align-items:center;justify-content:center}
.logo-outer img{width:60px;height:60px;object-fit:cover;display:block}
.logo-letter{font-family:Georgia,'Times New Roman',serif;font-size:2rem;font-weight:900;color:#0B1A2E;line-height:1;display:none}
.hdr-title{font-size:1.2rem;font-weight:700;color:#FFFFFF;margin:0 0 4px;letter-spacing:-.01em}
.hdr-sub{font-size:.74rem;color:rgba(255,255,255,.55);margin:0;letter-spacing:.03em;text-transform:uppercase}
/* ── Body ── */
.body{padding:32px 44px}
p.greeting{font-size:.95rem;color:#1F2937;margin:0 0 1.25rem;line-height:1.7}
p.body-text{font-size:.88rem;color:#4B5563;line-height:1.75;margin:0 0 1.25rem}
/* ── Info panel ── */
.panel{background:#F8F9FB;border:1px solid #E5E7EB;border-radius:10px;overflow:hidden;margin-bottom:1.5rem}
.panel-row{display:flex;justify-content:space-between;align-items:baseline;padding:9px 16px;border-bottom:1px solid #ECEEF1;font-size:.84rem}
.panel-row:last-child{border-bottom:none}
.panel-lbl{color:#6B7280;font-size:.79rem;padding-right:10px;white-space:nowrap}
.panel-val{color:#111827;font-weight:600;text-align:right}
.panel-val.accent{color:{{ $p['btn'] }};font-weight:700}
/* ── Alert boxes (teintes pastel, sobres) ── */
.alert{border-radius:9px;padding:14px 18px;font-size:.83rem;line-height:1.7;margin-bottom:1.4rem}
.alert p{margin:0}
.alert strong{display:block;margin-bottom:3px;font-size:.85rem}
.alert-info   {background:#FBF7EE;border:1px solid #EEE1C3;border-left:3px solid #C8A951;color:#5A4A25}
.alert-warn   {background:#FEF9E7;border:1px solid #FBE9B0;border-left:3px solid #D97706;color:#7A4E06}
.alert-danger {background:#FDECEC;border:1px solid #F5C6C6;border-left:3px solid #B91C1C;color:#7A1F1F}
.alert-success{background:#EEF7EF;border:1px solid #C6E5CA;border-left:3px solid #15803D;color:#1E4A29}
/* ── Button ── */
.btn-wrap{text-align:center;margin:1.6rem 0 1.2rem}
.btn{display:inline-block;padding:12px 34px;border-radius:8px;font-size:.92rem;font-weight:700;text-decoration:none;letter-spacing:.01em;color:#ffffff;background:{{ $p['btn'] }}}
/* ── Code box ── */
.code-box{background:#F8F9FB;border:1px solid #E5E7EB;border-radius:12px;padding:24px 20px;text-align:center;margin-bottom:1.5rem}
.code-digits{font-family:'Courier New',Courier,monospace;font-size:2.4rem;font-weight:900;letter-spacing:.3em;color:{{ $p['code'] }}}
.code-expiry{font-size:.77rem;color:#6B7280;margin-top:9px}
/* ── URL fallback ── */
.url-fallback{font-size:.74rem;color:#9CA3AF;text-align:center;line-height:1.75;margin-bottom:1.25rem;word-break:break-all}
.url-fallback a{color:#C8A951;text-decoration:none}
/* ── Closing ── */
p.closing{font-size:.88rem;color:#4B5563;margin:1.5rem 0 0;line-height:1.65}
p.closing strong{color:#111827;font-size:.92rem}
/* ── Divider ── */
.divider{height:1px;background:#E5E7EB}
/* ── Footer ── */
.footer{padding:18px 44px;text-align:center}
.footer p{font-size:.72rem;color:#9CA3AF;line-height:1.7;margin:0}
.footer a{color:#C8A951;text-decoration:none}
/* ── Responsive ── */
@media only screen and (max-width:600px){
  .wrap{margin:0;border-radius:0;border-left:none;border-right:none}
  .body,.hdr,.footer{padding:24px 22px!important}
  .code-digits{font-size:1.9rem;letter-spacing:.2em}
  .btn{padding:11px 24px;font-size:.86rem}
  .panel-row{flex-direction:column;gap:2px}
  .panel-val{text-align:left}
}
</style>
</head>
<body>
<div class="wrap">

  {{-- ── Header ── --}}
  <div class="hdr">
    <div class="logo-outer">
      <img src="{{ url('images/icon-192.png') }}" alt="Solberg Grupo" width="60" height="60">
    </div>
    <h1 class="hdr-title">{{ $title }}</h1>
    @if($subtitle)
    <p class="hdr-sub">{{ $subtitle }}</p>
    @endif
  </div>

  {{-- ── Content ── --}}
  <div class="body">
    {{ $slot }}
  </div>

  <div class="divider"></div>

  {{-- ── Footer ── --}}
  <div class="footer">
    <p>
      &copy; {{ date('Y') }} Solberg Grupo Invest
      @if($footerNote)
      &nbsp;·&nbsp; {{ $footerNote }}
      @endif
    </p>
  </div>

</div>
</body>
</html>
