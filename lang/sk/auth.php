<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Tieto prihlasovacie údaje nezodpovedajú žiadnemu účtu.',
    'password' => 'Zadané heslo je nesprávne.',
    'throttle' => 'Príliš veľa pokusov. Skúste to znova o :seconds sekúnd.',

    'client_login_title'  => 'Klientska zóna',
    'client_login_sub'    => 'Prihláste sa a získajte prístup k svojim spisom',
    'client_brand_title'  => 'Vaša klientska<br>zóna AURELIS CAPITAL GROUP',
    'client_brand_sub'    => 'Sledujte svoje žiadosti, spravujte svoj profil a bezpečne pristupujte ku všetkým svojim dokumentom.',

    'staff_login_title'   => 'Administratívny portál',
    'staff_login_sub'     => 'Vyhradené výlučne pre oprávnený personál',
    'staff_brand_title'   => 'Administrácia<br>AURELIS CAPITAL GROUP',
    'staff_brand_sub'     => 'Bezpečný prístup k nástrojom správy, sledovania spisov a administrácie používateľov.',

    'email'               => 'Emailová adresa',
    'email_staff'         => 'Pracovný email',
    'email_ph'            => 'vy@priklad.com',
    'email_ph_staff'      => 'agent@aureliscapital.online',
    'password_label'      => 'Heslo',
    'remember'            => 'Zapamätať si ma',
    'remember_staff'      => 'Zostať prihlásený',
    'submit'              => 'Prihlásiť sa',
    'submit_staff'        => 'Prejsť na nástenku',
    'back_site'           => 'Späť na stránku',
    'staff_portal_link'   => 'Portál agenta / administrátora',
    'client_portal_link'  => 'Klientska zóna',
    'staff_restricted'    => 'Obmedzený prístup — Oprávnený personál',
    'staff_notice'        => 'Tento portál je vyhradený agentom AURELIS CAPITAL GROUP. Všetky prihlásenia sú zaznamenávané.',
    'or_staff'            => 'Ste agent alebo administrátor?',
    'or_client'           => 'Ste klient?',

    'stat_clients'        => 'Spokojných klientov',
    'stat_amount'         => 'Max. úver / spis',
    'stat_time'           => 'Garantovaná odpoveď',
    'stat_years'          => 'Rokov skúseností',

    'feature_secure'      => 'Šifrované údaje',
    'feature_currencies'  => '6 akceptovaných mien',
    'feature_certified'   => 'Európske povolenie',
    'feature_fast'        => 'Odpoveď do 48 hodín',

    'role_superadmin'     => 'Super administrátor',
    'role_superadmin_sub' => 'Globálna správa a role',
    'role_admin'          => 'Administrátor',
    'role_admin_sub'      => 'Správa spisov',

    // Identifier (email or phone)
    'identifier'          => 'Email alebo telefón',
    'identifier_ph'       => 'vas@email.com alebo +33...',
    'forgot_password'     => 'Zabudnuté heslo?',
    'portal_clients_only' => 'Tento portál je vyhradený klientom.',

    // OTP page
    'otp_title'           => 'Overenie',
    'otp_heading'         => 'Bezpečnostný kód',
    'otp_subtitle'        => 'Zaslali sme 6-miestny kód na',
    'otp_enter'           => 'Zadajte kód prijatý emailom',
    'otp_verify_btn'      => 'Overiť',
    'otp_resend'          => 'Odoslať kód znova',
    'otp_resend_in'       => 'Odoslať znova o',
    'otp_back'            => 'Zmeniť účet',
    'otp_verifying'       => 'Prebieha overovanie…',
    'otp_invalid'         => 'Nesprávny kód. Zostáva vám :remaining pokus(ov).',
    'otp_expired'         => 'Platnosť tohto kódu vypršala. Vyžiadajte si nový.',
    'otp_too_many'        => 'Príliš veľa pokusov. Skúste to znova o :seconds sekúnd.',
    'otp_resend_limit'    => 'Príliš veľa opätovných odoslaní. Skúste to znova o niekoľko minút.',
    'otp_send_failed'     => 'Kód sa nepodarilo odoslať. Skúste to znova.',
    'otp_session_expired' => 'Relácia vypršala. Prihláste sa znova.',
    'otp_resend_success'  => 'Nový kód bol odoslaný!',

    // Compte mémorisé
    'change_account' => 'Zmeniť účet',

    // Compte bloqué
    'account_blocked'                     => 'Váš účet je zablokovaný z dôvodu príliš veľkého počtu nesprávnych pokusov. Skontrolujte si email a získajte odkaz na odblokovanie.',
    'account_blocked_notified'            => 'Príliš veľa nesprávnych pokusov. Váš účet bol zablokovaný. Odkaz na odblokovanie vám bol zaslaný emailom.',
    'account_unblocked'                   => 'Váš účet bol úspešne odblokovaný. Teraz sa môžete prihlásiť.',
    'unblock_invalid'                     => 'Tento odkaz na odblokovanie je neplatný alebo jeho platnosť vypršala. Kontaktujte podporu.',

    'account_blocked_email_subject'       => 'Váš účet AURELIS CAPITAL GROUP bol zablokovaný',
    'account_blocked_email_title'         => 'Účet dočasne zablokovaný',
    'account_blocked_email_intro'         => 'Váš účet bol dočasne zablokovaný z dôvodu viacerých nesprávnych pokusov o prihlásenie.',
    'account_blocked_email_reason_title'  => 'Prečo bol účet zablokovaný?',
    'account_blocked_email_reason_body'   => 'Pri pokuse o prihlásenie do vášho účtu bolo za sebou zadaných 4 nesprávnych OTP kódov. Z bezpečnostných dôvodov bol prístup pozastavený.',
    'account_blocked_email_btn'           => 'Odblokovať môj účet',
    'account_blocked_email_fallback'      => 'Ak tlačidlo nefunguje, skopírujte tento odkaz do prehliadača:',
    'account_blocked_email_notice'        => 'Ak ste tieto pokusy nevykonali vy, neklikajte na tento odkaz a okamžite kontaktujte podporu AURELIS CAPITAL GROUP.',
    'account_blocked_email_footer'        => 'Odkaz je platný 48 hodín.',

    // OTP email
    'otp_email_subject'      => 'Váš prihlasovací kód — AURELIS CAPITAL GROUP',
    'otp_email_title'        => 'Overovací kód',
    'otp_email_intro'        => 'Toto je váš jednorazový prihlasovací kód. Nezdieľajte ho s nikým.',
    'otp_email_code_label'   => 'Váš kód',
    'otp_email_expiry'       => 'Platnosť tohto kódu vyprší o 10 minút.',
    'otp_email_notice_title' => 'Dôležité upozornenie',
    'otp_email_notice_body'  => 'AURELIS CAPITAL GROUP vás nikdy nepožiada o tento kód telefonicky ani prostredníctvom správy. Ak ste o tento kód nežiadali, tento email ignorujte.',
    'otp_email_footer'       => 'Ak ste o tento kód nežiadali, tento email ignorujte.',

    // Bannière d'installation PWA (pages de connexion)
    'pwa_install_title' => 'Nainštalovať aplikáciu',
    'pwa_install_hint'  => 'Rýchly prístup · Upozornenia · Offline režim',
    'pwa_install_btn'   => 'Inštalovať',
    'pwa_ios_title'     => 'Nainštalujte si aplikáciu AURELIS CAPITAL GROUP na svoj iPhone',
    'pwa_ios_step1'     => 'Ťuknite na <strong>Zdieľať</strong> v Safari',
    'pwa_ios_step2'     => 'Vyberte <strong>Pridať na plochu</strong>',
    'pwa_ios_step3'     => 'Ťuknite na <strong>Pridať</strong> — hotovo!',
    'pwa_close'         => 'Zavrieť',

];
