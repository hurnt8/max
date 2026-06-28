<?php

return [

    'auth' => [
        'invalid_credentials' => 'Credenziali non valide.',
        'clients_only'        => 'Accesso riservato ai clienti.',
        'account_blocked'     => 'Account bloccato. Contatta il supporto.',
        'otp_send_failed'     => 'Impossibile inviare il codice OTP.',
        'otp_sent'            => 'Codice OTP inviato a :email',
        'otp_invalid'         => 'Codice OTP non valido o scaduto.',
        'user_not_found'      => 'Utente non trovato.',
        'logged_out'          => 'Disconnesso.',
    ],

    'transfer' => [
        'negative_balance'     => 'Saldo negativo, bonifico impossibile.',
        'insufficient_balance' => 'Saldo insufficiente.',
        'success'              => 'Bonifico inviato con successo.',
        'admin_title'          => 'Bonifico in sospeso — :name',
        'admin_body'           => 'Bonifico di :amount :currency verso :name',
    ],

    'notification' => [
        'all_read' => 'Tutte le notifiche contrassegnate come lette.',
    ],

    'support' => [
        'empty_message' => 'Messaggio vuoto.',
    ],

    'profile' => [
        'updated'         => 'Profilo aggiornato.',
        'same_email'      => 'Questo è già il tuo indirizzo email attuale.',
        'otp_send_failed' => 'Impossibile inviare il codice.',
        'email_otp_sent'  => 'Codice OTP inviato alla tua email attuale.',
        'otp_invalid'     => 'Codice OTP non valido o scaduto.',
        'email_updated'   => 'Email aggiornata.',
        'wrong_password'  => 'La password attuale è errata.',
        'password_updated'=> 'Password modificata.',
    ],

    'movement' => [
        'credit_received'   => 'Credito ricevuto',
        'debit_done'        => 'Addebito effettuato',
        'transfer_to'       => 'Bonifico verso :name',
        'transfer_received' => 'Bonifico ricevuto',
        'system'            => 'Sistema',
    ],
];
