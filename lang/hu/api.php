<?php

return [

    'auth' => [
        'invalid_credentials' => 'Helytelen bejelentkezési adatok.',
        'clients_only'        => 'Hozzáférés csak ügyfelek számára.',
        'account_blocked'     => 'A fiók blokkolva van. Lépjen kapcsolatba az ügyfélszolgálattal.',
        'otp_send_failed'     => 'Az OTP kód küldése nem sikerült.',
        'otp_sent'            => 'OTP kód elküldve ide: :email',
        'otp_invalid'         => 'Érvénytelen vagy lejárt OTP kód.',
        'user_not_found'      => 'Felhasználó nem található.',
        'logged_out'          => 'Kijelentkezve.',
    ],

    'transfer' => [
        'negative_balance'     => 'Negatív egyenleg, az átutalás nem lehetséges.',
        'insufficient_balance' => 'Elégtelen egyenleg.',
        'success'              => 'Az átutalás sikeresen elküldve.',
        'admin_title'          => 'Függőben lévő átutalás — :name',
        'admin_body'           => ':amount :currency átutalás :name részére',
    ],

    'notification' => [
        'all_read' => 'Minden értesítés olvasottnak jelölve.',
    ],

    'support' => [
        'empty_message' => 'Üres üzenet.',
    ],

    'profile' => [
        'updated'         => 'Profil frissítve.',
        'same_email'      => 'Ez már az Ön jelenlegi e-mail címe.',
        'otp_send_failed' => 'A kód küldése nem sikerült.',
        'email_otp_sent'  => 'OTP kód elküldve a jelenlegi e-mail címére.',
        'otp_invalid'     => 'Érvénytelen vagy lejárt OTP kód.',
        'email_updated'   => 'E-mail frissítve.',
        'wrong_password'  => 'A jelenlegi jelszó helytelen.',
        'password_updated'=> 'Jelszó módosítva.',
    ],

    'movement' => [
        'credit_received'   => 'Jóváírás érkezett',
        'debit_done'        => 'Terhelés végrehajtva',
        'transfer_to'       => 'Átutalás :name részére',
        'transfer_received' => 'Érkezett átutalás',
        'system'            => 'Rendszer',
    ],
];
