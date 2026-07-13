@php
$texts = [
    'fr' => [
        'title'    => 'Réinitialisation du mot de passe',
        'sub'      => 'Espace Client Sécurisé',
        'greeting' => 'Bonjour ' . ($user->name ?? '') . ',',
        'intro'    => 'Vous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le bouton ci-dessous pour en choisir un nouveau.',
        'button'   => 'Réinitialiser le mot de passe',
        'expiry'   => 'Ce lien expire dans ' . $expireMinutes . ' minutes.',
        'ignore'   => 'Si vous n\'êtes pas à l\'origine de cette demande, aucune action n\'est requise — votre mot de passe reste inchangé.',
        'fallback' => 'Si le bouton ne fonctionne pas, copiez ce lien dans votre navigateur :',
        'closing'  => 'Cordialement,',
        'team'     => 'L\'équipe Solberg Grupo',
    ],
    'en' => [
        'title'    => 'Password reset',
        'sub'      => 'Secure Client Area',
        'greeting' => 'Hello ' . ($user->name ?? '') . ',',
        'intro'    => 'You requested a password reset. Click the button below to choose a new one.',
        'button'   => 'Reset password',
        'expiry'   => 'This link expires in ' . $expireMinutes . ' minutes.',
        'ignore'   => 'If you did not request this, no further action is required — your password remains unchanged.',
        'fallback' => 'If the button does not work, copy this link into your browser:',
        'closing'  => 'Kind regards,',
        'team'     => 'The Solberg Grupo team',
    ],
    'es' => [
        'title'    => 'Restablecimiento de contraseña',
        'sub'      => 'Área de Cliente Segura',
        'greeting' => 'Hola ' . ($user->name ?? '') . ',',
        'intro'    => 'Ha solicitado restablecer su contraseña. Haga clic en el botón de abajo para elegir una nueva.',
        'button'   => 'Restablecer contraseña',
        'expiry'   => 'Este enlace caduca en ' . $expireMinutes . ' minutos.',
        'ignore'   => 'Si no ha sido usted quien lo solicitó, no es necesaria ninguna acción — su contraseña no cambiará.',
        'fallback' => 'Si el botón no funciona, copie este enlace en su navegador:',
        'closing'  => 'Atentamente,',
        'team'     => 'El equipo Solberg Grupo',
    ],
    'pl' => [
        'title'    => 'Resetowanie hasła',
        'sub'      => 'Bezpieczna Strefa Klienta',
        'greeting' => 'Witaj ' . ($user->name ?? '') . ',',
        'intro'    => 'Poprosiłeś/aś o zresetowanie hasła. Kliknij poniższy przycisk, aby ustawić nowe.',
        'button'   => 'Zresetuj hasło',
        'expiry'   => 'Ten link wygasa za ' . $expireMinutes . ' minut.',
        'ignore'   => 'Jeśli to nie Ty złożyłeś/aś tę prośbę, nie musisz nic robić — Twoje hasło pozostanie bez zmian.',
        'fallback' => 'Jeśli przycisk nie działa, skopiuj ten link do przeglądarki:',
        'closing'  => 'Z poważaniem,',
        'team'     => 'Zespół Solberg Grupo',
    ],
];
$t = $texts[$locale] ?? $texts['fr'];
@endphp
<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="teal"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{{ $t['intro'] }}</p>

  <div class="btn-wrap">
    <a href="{{ $url }}" class="btn">{{ $t['button'] }}</a>
  </div>

  <p class="url-fallback">
    {{ $t['fallback'] }}<br>
    <a href="{{ $url }}">{{ $url }}</a>
  </p>

  <div class="alert alert-info">
    <p>{{ $t['expiry'] }}</p>
  </div>

  <p class="body-text">{{ $t['ignore'] }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
