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

    'failed'   => 'Te poverilnice se ne ujemajo z nobenim računom.',
    'password' => 'Navedeno geslo ni pravilno.',
    'throttle' => 'Preveč poskusov. Poskusite znova čez :seconds sekund.',

    'client_login_title'  => 'Območje stranke',
    'client_login_sub'    => 'Prijavite se za dostop do svojih dosjejev',
    'client_brand_title'  => 'Vaš prostor<br>stranke Credixa',
    'client_brand_sub'    => 'Sledite svojim zahtevkom, upravljajte svoj profil in dostopajte do vseh svojih dokumentov v celotni varnosti.',

    'staff_login_title'   => 'Administrativni portal',
    'staff_login_sub'     => 'Rezervirano izključno za pooblaščeno osebje',
    'staff_brand_title'   => 'Administracija<br>Credixa',
    'staff_brand_sub'     => 'Varen dostop do orodij za upravljanje, sledenje dosjejem in administriranje uporabnikov.',

    'email'               => 'E-poštni naslov',
    'email_staff'         => 'Poklicni e-mail',
    'email_ph'            => 'vi@primer.com',
    'email_ph_staff'      => 'agent@credixa.eu',
    'password_label'      => 'Geslo',
    'remember'            => 'Zapomni si me',
    'remember_staff'      => 'Ostani prijavljen',
    'submit'              => 'Prijava',
    'submit_staff'        => 'Dostop do nadzorne plošče',
    'back_site'           => 'Nazaj na spletno stran',
    'staff_portal_link'   => 'Portal agenta / administratorja',
    'client_portal_link'  => 'Območje stranke',
    'staff_restricted'    => 'Omejen dostop — Pooblaščeno osebje',
    'staff_notice'        => 'Ta portal je rezerviran za agente Credixa. Vse prijave so zabeležene.',
    'or_staff'            => 'Ste agent ali administrator?',
    'or_client'           => 'Ste stranka?',

    'stat_clients'        => 'Zadovoljne stranke',
    'stat_amount'         => 'Maks. posojilo / dosje',
    'stat_time'           => 'Zagotovljen odgovor',
    'stat_years'          => 'Let izkušenj',

    'feature_secure'      => 'Šifrirani podatki',
    'feature_currencies'  => '6 sprejetih valut',
    'feature_certified'   => 'Evropska licenca',
    'feature_fast'        => 'Odgovor v 24h',

    'role_superadmin'     => 'Super Administrator',
    'role_superadmin_sub' => 'Globalno upravljanje & vloge',
    'role_admin'          => 'Administrator',
    'role_admin_sub'      => 'Upravljanje dosjejev',

    // Identifier (email or phone)
    'identifier'          => 'E-mail ali telefon',
    'identifier_ph'       => 'vasa@email.com ali +386...',
    'forgot_password'     => 'Pozabljeno geslo?',
    'portal_clients_only' => 'Ta portal je rezerviran samo za stranke.',

    // OTP page
    'otp_title'           => 'Preverjanje',
    'otp_heading'         => 'Varnostna koda',
    'otp_subtitle'        => 'Poslali smo 6-mestno kodo na',
    'otp_enter'           => 'Vnesite kodo, prejeto po e-pošti',
    'otp_verify_btn'      => 'Preveri',
    'otp_resend'          => 'Ponovno pošlji kodo',
    'otp_resend_in'       => 'Ponovno pošlji čez',
    'otp_back'            => 'Zamenjaj račun',
    'otp_verifying'       => 'Preverjanje poteka…',
    'otp_invalid'         => 'Napačna koda. Ostaja vam še :remaining poskus(ov).',
    'otp_expired'         => 'Ta koda je potekla. Zahtevajte novo.',
    'otp_too_many'        => 'Preveč poskusov. Poskusite znova čez :seconds sekund.',
    'otp_resend_limit'    => 'Preveč ponovnih pošiljanj. Poskusite znova čez nekaj minut.',
    'otp_send_failed'     => 'Pošiljanje kode ni mogoče. Poskusite znova.',
    'otp_session_expired' => 'Seja je potekla. Prijavite se znova.',
    'otp_resend_success'  => 'Nova koda poslana!',

    // Zapomnjeni račun
    'change_account' => 'Zamenjaj račun',

    // Blokiran račun
    'account_blocked'                     => 'Vaš račun je blokiran po preveč napačnih poskusih. Preverite svojo e-pošto za prejemanje povezave za odblokiranje.',
    'account_blocked_notified'            => 'Preveč napačnih poskusov. Vaš račun je bil blokiran. Povezava za odblokiranje vam je bila poslana po e-pošti.',
    'account_unblocked'                   => 'Vaš račun je bil uspešno odblokirán. Zdaj se lahko prijavite.',
    'unblock_invalid'                     => 'Ta povezava za odblokiranje je neveljavna ali je potekla. Stopite v stik s podporo.',

    'account_blocked_email_subject'       => 'Vaš račun Credixa je bil blokiran',
    'account_blocked_email_title'         => 'Račun začasno blokiran',
    'account_blocked_email_intro'         => 'Vaš račun je bil začasno blokiran po več napačnih poskusih prijave.',
    'account_blocked_email_reason_title'  => 'Zakaj ta blokada?',
    'account_blocked_email_reason_body'   => '4 napačne OTP kode so bile zaporedoma vnesene med poskusom prijave v vaš račun. Kot varnostni ukrep je bil dostop prekinjen.',
    'account_blocked_email_btn'           => 'Odblokiraj moj račun',
    'account_blocked_email_fallback'      => 'Če gumb ne deluje, kopirajte to povezavo v brskalnik:',
    'account_blocked_email_notice'        => 'Če niste vi izvedli teh poskusov, ne kliknite na to povezavo in takoj stopite v stik s podporo Credixa.',
    'account_blocked_email_footer'        => 'Povezava veljavna 48 ur.',

    // OTP email
    'otp_email_subject'      => 'Vaša koda za prijavo — Credixa',
    'otp_email_title'        => 'Koda za preverjanje',
    'otp_email_intro'        => 'Tu je vaša enkratna koda za prijavo. Ne delite je z nikomer.',
    'otp_email_code_label'   => 'Vaša koda',
    'otp_email_expiry'       => 'Ta koda poteče v 10 minutah.',
    'otp_email_notice_title' => 'Pomembna varnost',
    'otp_email_notice_body'  => 'Credixa vam nikoli ne bo zahteval te kode po telefonu ali sporočilu. Če niste zahtevali te kode, prezrite to e-pošto.',
    'otp_email_footer'       => 'Če niste zahtevali te kode, prezrite to e-pošto.',

];
