<?php

return [

    'auth' => [
        'invalid_credentials' => 'Neteisingi prisijungimo duomenys.',
        'clients_only'        => 'Prieiga tik klientams.',
        'account_blocked'     => 'Paskyra užblokuota. Susisiekite su palaikymo tarnyba.',
        'otp_send_failed'     => 'Nepavyko išsiųsti OTP kodo.',
        'otp_sent'            => 'OTP kodas išsiųstas į :email',
        'otp_invalid'         => 'Neteisingas arba pasibaigęs OTP kodas.',
        'user_not_found'      => 'Vartotojas nerastas.',
        'logged_out'          => 'Atsijungta.',
    ],

    'transfer' => [
        'negative_balance'     => 'Neigiamas likutis, pervedimas neįmanomas.',
        'insufficient_balance' => 'Nepakankamas likutis.',
        'success'              => 'Pervedimas sėkmingai pateiktas.',
        'admin_title'          => 'Laukiantis pervedimas — :name',
        'admin_body'           => ':amount :currency pervedimas į :name',
    ],

    'notification' => [
        'all_read' => 'Visi pranešimai pažymėti kaip perskaityti.',
    ],

    'support' => [
        'empty_message' => 'Tuščia žinutė.',
    ],

    'profile' => [
        'updated'         => 'Profilis atnaujintas.',
        'same_email'      => 'Tai jau yra jūsų dabartinis el. pašto adresas.',
        'otp_send_failed' => 'Nepavyko išsiųsti kodo.',
        'email_otp_sent'  => 'OTP kodas išsiųstas į jūsų dabartinį el. paštą.',
        'otp_invalid'     => 'Neteisingas arba pasibaigęs OTP kodas.',
        'email_updated'   => 'El. paštas atnaujintas.',
        'wrong_password'  => 'Dabartinis slaptažodis neteisingas.',
        'password_updated'=> 'Slaptažodis pakeistas.',
    ],

    'movement' => [
        'credit_received'   => 'Gautas kreditas',
        'debit_done'        => 'Debetas atliktas',
        'transfer_to'       => 'Pervedimas į :name',
        'transfer_received' => 'Gautas pervedimas',
        'system'            => 'Sistema',
    ],
];
