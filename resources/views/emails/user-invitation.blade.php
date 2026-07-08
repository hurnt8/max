@php
$titles = [
    'fr' => 'Activez votre compte',
    'en' => 'Activate your account',
    'es' => 'Active su cuenta',
    'pl' => 'Aktywuj swoje konto',
    'bg' => 'Активирайте профила си',
    'hu' => 'Aktiválja fiókját',
    'it' => 'Attiva il tuo account',
    'de' => 'Aktivieren Sie Ihr Konto',
    'lt' => 'Aktyvuokite savo paskyrą',
    'ro' => 'Activați-vă contul',
    'lv' => 'Aktivizējiet savu kontu',
];
$subs = [
    'fr' => 'Solberg Grupo — Espace client',
    'en' => 'Solberg Grupo — Client space',
    'es' => 'Solberg Grupo — Área de clientes',
    'pl' => 'Solberg Grupo — Obszar klienta',
    'bg' => 'Solberg Grupo — Клиентска зона',
    'hu' => 'Solberg Grupo — Ügyfélfiók',
    'it' => 'Solberg Grupo — Area cliente',
    'de' => 'Solberg Grupo — Kundenbereich',
    'lt' => 'Solberg Grupo — Kliento sritis',
    'ro' => 'Solberg Grupo — Spațiul de client',
    'lv' => 'Solberg Grupo — Klienta zona',
];
$notices = [
    'fr' => 'Si vous n\'êtes pas à l\'origine de cette création de compte, vous pouvez ignorer cet email.',
    'en' => 'If you did not request this account creation, you can ignore this email.',
    'es' => 'Si usted no solicitó la creación de esta cuenta, puede ignorar este email.',
    'pl' => 'Jeśli nie prosiłeś/aś o utworzenie tego konta, możesz zignorować ten email.',
    'bg' => 'Ако не сте инициирали създаването на този профил, можете да игнорирате този имейл.',
    'hu' => 'Ha nem Ön kezdeményezte ennek a fióknak a létrehozását, figyelmen kívül hagyhatja ezt az e-mailt.',
    'it' => 'Se non sei tu all\'origine della creazione di questo account, puoi ignorare questa email.',
    'de' => 'Wenn Sie diese Kontoerstellung nicht veranlasst haben, können Sie diese E-Mail ignorieren.',
    'lt' => 'Jei ne jūs inicijavote šios paskyros sukūrimą, galite ignoruoti šį el. laišką.',
    'ro' => 'Dacă nu dumneavoastră ați inițiat crearea acestui cont, puteți ignora acest e-mail.',
    'lv' => 'Ja šī konta izveide nav notikusi pēc jūsu pieprasījuma, varat ignorēt šo e-pastu.',
];
$title  = $titles[$locale]  ?? $titles['fr'];
$sub    = $subs[$locale]    ?? $subs['fr'];
$notice = $notices[$locale] ?? $notices['fr'];
@endphp

<x-email-layout
    :title="$title"
    :subtitle="$sub"
    accent="teal"
    :footerNote="$notice"
>

  <p class="greeting">{{ $greeting }}</p>

  <p class="body-text">{{ $resolved['{INTRO_CORPS}'] }}</p>

  <p class="body-text">{{ $resolved['{CORPS_ACTION}'] }}</p>

  <div class="btn-wrap">
    <a href="{{ $activationUrl }}" class="btn">{{ $btnLabel }}</a>
  </div>

  <p class="url-fallback">
    @php
    $fallbacks = ['fr'=>'Si le bouton ne fonctionne pas, copiez ce lien :','en'=>'If the button does not work, copy this link:','es'=>'Si el botón no funciona, copie este enlace:','pl'=>'Jeśli przycisk nie działa, skopiuj ten link:','bg'=>'Ако бутонът не работи, копирайте тази връзка:','hu'=>'Ha a gomb nem működik, másolja be ezt a linket:','it'=>'Se il pulsante non funziona, copia questo link:','de'=>'Wenn die Schaltfläche nicht funktioniert, kopieren Sie diesen Link:','lt'=>'Jei mygtukas neveikia, nukopijuokite šią nuorodą:','ro'=>'Dacă butonul nu funcționează, copiați acest link:','lv'=>'Ja poga nedarbojas, nokopējiet šo saiti:'];
    @endphp
    {{ $fallbacks[$locale] ?? $fallbacks['fr'] }}<br>
    <a href="{{ $activationUrl }}">{{ $activationUrl }}</a>
  </p>

  <div class="alert alert-warn">
    <p>{{ $resolved['{NOTICE_PERSONNEL}'] }}</p>
  </div>

  <p class="closing">
    {{ $resolved['{FORMULE_POLITESSE}'] }},<br>
    <strong>{{ $resolved['{EQUIPE}'] }}</strong>
  </p>

</x-email-layout>
