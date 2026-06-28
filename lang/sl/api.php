<?php

return [

    'auth' => [
        'invalid_credentials' => 'Napačni prijavni podatki.',
        'clients_only'        => 'Dostop samo za stranke.',
        'account_blocked'     => 'Račun je blokiran. Kontaktirajte podporo.',
        'otp_send_failed'     => 'Ni mogoče poslati kode OTP.',
        'otp_sent'            => 'Koda OTP je bila poslana na :email',
        'otp_invalid'         => 'Neveljavna ali potekla koda OTP.',
        'user_not_found'      => 'Uporabnik ni bil najden.',
        'logged_out'          => 'Odjavljeni ste.',
    ],

    'transfer' => [
        'negative_balance'     => 'Negativno stanje, nakazilo ni mogoče.',
        'insufficient_balance' => 'Nezadostno stanje.',
        'success'              => 'Nakazilo je bilo uspešno oddano.',
        'admin_title'          => 'Čakajoče nakazilo — :name',
        'admin_body'           => 'Nakazilo :amount :currency za :name',
    ],

    'notification' => [
        'all_read' => 'Vsa obvestila so označena kot prebrana.',
    ],

    'support' => [
        'empty_message' => 'Prazno sporočilo.',
    ],

    'profile' => [
        'updated'         => 'Profil posodobljen.',
        'same_email'      => 'To je že vaš trenutni e-poštni naslov.',
        'otp_send_failed' => 'Ni mogoče poslati kode.',
        'email_otp_sent'  => 'Koda OTP je bila poslana na vaš trenutni e-poštni naslov.',
        'otp_invalid'     => 'Neveljavna ali potekla koda OTP.',
        'email_updated'   => 'E-pošta posodobljena.',
        'wrong_password'  => 'Trenutno geslo je napačno.',
        'password_updated'=> 'Geslo je bilo spremenjeno.',
    ],

    'movement' => [
        'credit_received'   => 'Prejet kredit',
        'debit_done'        => 'Bremenjenje izvedeno',
        'transfer_to'       => 'Nakazilo za :name',
        'transfer_received' => 'Prejeto nakazilo',
        'system'            => 'Sistem',
    ],
];
