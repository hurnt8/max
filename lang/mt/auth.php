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

    'failed'   => 'Dawn il-kredenzjali ma jaqblux ma\' ebda kont.',
    'password' => 'Il-password provduta mhijiex korretta.',
    'throttle' => 'Tentattivi wisq. Erġa\' pprova wara :seconds sekondi.',

    'client_login_title'  => 'Żona tal-Klijent',
    'client_login_sub'    => 'Idħol biex taċċessa l-fajls tiegħek',
    'client_brand_title'  => 'L-ispazju tiegħek<br>tal-klijent Credixa',
    'client_brand_sub'    => 'Segwi t-talbiet tiegħek, immaniġġa l-profil tiegħek u aċċessa d-dokumenti kollha tiegħek b\'sikurezza sħiħa.',

    'staff_login_title'   => 'Portal Amministrattiv',
    'staff_login_sub'     => 'Riżervat esklużivament għall-persunal awtorizzat',
    'staff_brand_title'   => 'Amministrazzjoni<br>Credixa',
    'staff_brand_sub'     => 'Aċċess sigur għall-għodod tal-ġestjoni, it-traċċar tal-fajls u l-amministrazzjoni tal-utenti.',

    'email'               => 'Indirizz tal-email',
    'email_staff'         => 'Email professjonali',
    'email_ph'            => 'int@eżempju.com',
    'email_ph_staff'      => 'agent@credixa.eu',
    'password_label'      => 'Password',
    'remember'            => 'Ftakarni',
    'remember_staff'      => 'Ibqa\' konnessa',
    'submit'              => 'Idħol',
    'submit_staff'        => 'Aċċessa d-dashboard',
    'back_site'           => 'Lura għas-sit',
    'staff_portal_link'   => 'Portal tal-aġent / amministratur',
    'client_portal_link'  => 'Żona tal-klijent',
    'staff_restricted'    => 'Aċċess ristrett — Persunal awtorizzat',
    'staff_notice'        => 'Dan il-portal huwa riżervat għall-aġenti ta\' Credixa. Il-konnessjonijiet kollha huma rreġistrati.',
    'or_staff'            => 'Int aġent jew amministratur?',
    'or_client'           => 'Int klijent?',

    'stat_clients'        => 'Klijenti sodisfatti',
    'stat_amount'         => 'Self massimu / fajl',
    'stat_time'           => 'Risposta garantita',
    'stat_years'          => 'Snin ta\' esperjenza',

    'feature_secure'      => 'Dejta kkodifikata',
    'feature_currencies'  => '6 muniti aċċettati',
    'feature_certified'   => 'Liċenzja Ewropea',
    'feature_fast'        => 'Risposta fi 24 siegħa',

    'role_superadmin'     => 'Super Amministratur',
    'role_superadmin_sub' => 'Ġestjoni globali & rwoli',
    'role_admin'          => 'Amministratur',
    'role_admin_sub'      => 'Ġestjoni tal-fajls',

    // Identifier (email or phone)
    'identifier'          => 'Email jew telefon',
    'identifier_ph'       => 'tiegħek@email.com jew +356...',
    'forgot_password'     => 'Password minsija?',
    'portal_clients_only' => 'Dan il-portal huwa riżervat biss għall-klijenti.',

    // OTP page
    'otp_title'           => 'Verifika',
    'otp_heading'         => 'Kodiċi tas-sigurtà',
    'otp_subtitle'        => 'Bgħattna kodiċi ta\' 6 ċifri lil',
    'otp_enter'           => 'Daħħal il-kodiċi li rċevejt bl-email',
    'otp_verify_btn'      => 'Ivverifika',
    'otp_resend'          => 'Ibgħat il-kodiċi mill-ġdid',
    'otp_resend_in'       => 'Ibgħat mill-ġdid wara',
    'otp_back'            => 'Ibdel il-kont',
    'otp_verifying'       => 'Verifika għaddejja…',
    'otp_invalid'         => 'Kodiċi mhux korrett. Għad fadlillek :remaining tentattiv/i.',
    'otp_expired'         => 'Dan il-kodiċi skada. Itlob wieħed ġdid.',
    'otp_too_many'        => 'Tentattivi wisq. Erġa\' pprova wara :seconds sekondi.',
    'otp_resend_limit'    => 'Inviji wisq. Erġa\' pprova wara ftit minuti.',
    'otp_send_failed'     => 'Impossibbli tibgħat il-kodiċi. Erġa\' pprova.',
    'otp_session_expired' => 'Is-sessjoni skadiet. Idħol mill-ġdid.',
    'otp_resend_success'  => 'Kodiċi ġdid mibgħut!',

    // Kont immemorizzat
    'change_account' => 'Ibdel il-kont',

    // Kont imblukkat
    'account_blocked'                     => 'Il-kont tiegħek huwa mblukkat wara tentattivi żbaljati wisq. Iċċekkja l-email tiegħek biex tirċievi l-link tad-dblukkjar.',
    'account_blocked_notified'            => 'Tentattivi żbaljati wisq. Il-kont tiegħek ġie mblukkat. Link tad-dblukkjar intbagħat bl-email tiegħek.',
    'account_unblocked'                   => 'Il-kont tiegħek ġie dblukkjat b\'suċċess. Issa tista\' tidħol.',
    'unblock_invalid'                     => 'Dan il-link tad-dblukkjar mhuwiex validu jew skada. Ikkuntattja l-appoġġ.',

    'account_blocked_email_subject'       => 'Il-kont tiegħek Credixa ġie mblukkat',
    'account_blocked_email_title'         => 'Kont temporanjament imblukkat',
    'account_blocked_email_intro'         => 'Il-kont tiegħek ġie temporanjament imblukkat wara diversi tentattivi ta\' dħul żbaljati.',
    'account_blocked_email_reason_title'  => 'Għaliex dan l-imblukkar?',
    'account_blocked_email_reason_body'   => '4 kodiċi OTP żbaljati daħħlu konsekuttivament waqt tentattiv ta\' dħul fil-kont tiegħek. Bħala miżura ta\' sigurtà, l-aċċess ġie sospiż.',
    'account_blocked_email_btn'           => 'Dblukkja l-kont tiegħi',
    'account_blocked_email_fallback'      => 'Jekk il-buttuna ma taħdimx, ikkopja dan il-link fil-browser tiegħek:',
    'account_blocked_email_notice'        => 'Jekk ma kontx int li għamilt dawn it-tentattivi, tikklikjax fuq dan il-link u ikkuntattja immedjatament l-appoġġ ta\' Credixa.',
    'account_blocked_email_footer'        => 'Link validu għal 48 siegħa.',

    // OTP email
    'otp_email_subject'      => 'Il-kodiċi tad-dħul tiegħek — Credixa',
    'otp_email_title'        => 'Kodiċi ta\' verifika',
    'otp_email_intro'        => 'Hawn il-kodiċi tad-dħul monoużu tiegħek. Tikkomunikahx ma\' ħadd.',
    'otp_email_code_label'   => 'Il-kodiċi tiegħek',
    'otp_email_expiry'       => 'Dan il-kodiċi jiskadi f\'10 minuti.',
    'otp_email_notice_title' => 'Sigurtà importanti',
    'otp_email_notice_body'  => 'Credixa qatt ma se titlobk dan il-kodiċi bit-telefon jew bil-messaġġ. Jekk ma tlabtx dan il-kodiċi, injoraw din l-email.',
    'otp_email_footer'       => 'Jekk ma tlabtx dan il-kodiċi, injoraw din l-email.',

];
