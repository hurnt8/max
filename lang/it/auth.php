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

    'failed'   => 'Queste credenziali non corrispondono a nessun account.',
    'password' => 'La password fornita non è corretta.',
    'throttle' => 'Troppi tentativi. Riprova tra :seconds secondi.',

    'client_login_title'  => 'Area Cliente',
    'client_login_sub'    => 'Accedi per gestire i tuoi dossier',
    'client_brand_title'  => 'Il tuo spazio<br>cliente Credixa',
    'client_brand_sub'    => 'Segui le tue richieste, gestisci il tuo profilo e accedi a tutti i tuoi documenti in tutta sicurezza.',

    'staff_login_title'   => 'Portale Amministrativo',
    'staff_login_sub'     => 'Riservato esclusivamente al personale autorizzato',
    'staff_brand_title'   => 'Amministrazione<br>Credixa',
    'staff_brand_sub'     => 'Accesso sicuro agli strumenti di gestione, monitoraggio dei dossier e amministrazione degli utenti.',

    'email'               => 'Indirizzo email',
    'email_staff'         => 'Email professionale',
    'email_ph'            => 'tu@esempio.com',
    'email_ph_staff'      => 'agent@credixa.eu',
    'password_label'      => 'Password',
    'remember'            => 'Ricordami',
    'remember_staff'      => 'Rimani connesso',
    'submit'              => 'Accedi',
    'submit_staff'        => 'Accedi al pannello di controllo',
    'back_site'           => 'Torna al sito',
    'staff_portal_link'   => 'Portale agente / amministratore',
    'client_portal_link'  => 'Area cliente',
    'staff_restricted'    => 'Accesso limitato — Personale autorizzato',
    'staff_notice'        => 'Questo portale è riservato agli agenti Credixa. Tutti gli accessi vengono registrati.',
    'or_staff'            => 'Sei un agente o un amministratore?',
    'or_client'           => 'Sei un cliente?',

    'stat_clients'        => 'Clienti soddisfatti',
    'stat_amount'         => 'Prestito max / dossier',
    'stat_time'           => 'Risposta garantita',
    'stat_years'          => 'Anni di esperienza',

    'feature_secure'      => 'Dati crittografati',
    'feature_currencies'  => '6 valute accettate',
    'feature_certified'   => 'Licenza europea',
    'feature_fast'        => 'Risposta in 24h',

    'role_superadmin'     => 'Super Amministratore',
    'role_superadmin_sub' => 'Gestione globale & ruoli',
    'role_admin'          => 'Amministratore',
    'role_admin_sub'      => 'Gestione dei dossier',

    // Identifier (email or phone)
    'identifier'          => 'Email o telefono',
    'identifier_ph'       => 'tua@email.com o +39...',
    'forgot_password'     => 'Password dimenticata?',
    'portal_clients_only' => 'Questo portale è riservato ai clienti.',

    // OTP page
    'otp_title'           => 'Verifica',
    'otp_heading'         => 'Codice di sicurezza',
    'otp_subtitle'        => 'Abbiamo inviato un codice a 6 cifre a',
    'otp_enter'           => 'Inserisci il codice ricevuto via email',
    'otp_verify_btn'      => 'Verifica',
    'otp_resend'          => 'Invia nuovamente il codice',
    'otp_resend_in'       => 'Invia nuovamente tra',
    'otp_back'            => 'Cambia account',
    'otp_verifying'       => 'Verifica in corso…',
    'otp_invalid'         => 'Codice errato. Hai ancora :remaining tentativo/i.',
    'otp_expired'         => 'Questo codice è scaduto. Richiedine uno nuovo.',
    'otp_too_many'        => 'Troppi tentativi. Riprova tra :seconds secondi.',
    'otp_resend_limit'    => 'Troppi invii. Riprova tra qualche minuto.',
    'otp_send_failed'     => 'Impossibile inviare il codice. Riprova.',
    'otp_session_expired' => 'Sessione scaduta. Accedi di nuovo.',
    'otp_resend_success'  => 'Nuovo codice inviato!',

    // Account memorizzato
    'change_account' => 'Cambia account',

    // Account bloccato
    'account_blocked'                     => 'Il tuo account è bloccato a causa di troppi tentativi errati. Controlla la tua email per ricevere il link di sblocco.',
    'account_blocked_notified'            => 'Troppi tentativi errati. Il tuo account è stato bloccato. Un link di sblocco ti è stato inviato via email.',
    'account_unblocked'                   => 'Il tuo account è stato sbloccato con successo. Ora puoi accedere.',
    'unblock_invalid'                     => 'Questo link di sblocco non è valido o è scaduto. Contatta il supporto.',

    'account_blocked_email_subject'       => 'Il tuo account Credixa è stato bloccato',
    'account_blocked_email_title'         => 'Account temporaneamente bloccato',
    'account_blocked_email_intro'         => 'Il tuo account è stato temporaneamente bloccato a causa di diversi tentativi di accesso errati.',
    'account_blocked_email_reason_title'  => 'Perché questo blocco?',
    'account_blocked_email_reason_body'   => '4 codici OTP errati sono stati inseriti consecutivamente durante un tentativo di accesso al tuo account. Per misura di sicurezza, l\'accesso è stato sospeso.',
    'account_blocked_email_btn'           => 'Sblocca il mio account',
    'account_blocked_email_fallback'      => 'Se il pulsante non funziona, copia questo link nel tuo browser:',
    'account_blocked_email_notice'        => 'Se non sei stato tu a effettuare questi tentativi, non cliccare su questo link e contatta immediatamente il supporto Credixa.',
    'account_blocked_email_footer'        => 'Link valido per 48 ore.',

    // OTP email
    'otp_email_subject'      => 'Il tuo codice di accesso — Credixa',
    'otp_email_title'        => 'Codice di verifica',
    'otp_email_intro'        => 'Ecco il tuo codice di accesso monouso. Non comunicarlo a nessuno.',
    'otp_email_code_label'   => 'Il tuo codice',
    'otp_email_expiry'       => 'Questo codice scade tra 10 minuti.',
    'otp_email_notice_title' => 'Sicurezza importante',
    'otp_email_notice_body'  => 'Credixa non ti chiederà mai questo codice per telefono o messaggio. Se non hai richiesto questo codice, ignora questa email.',
    'otp_email_footer'       => 'Se non hai richiesto questo codice, ignora questa email.',

];
