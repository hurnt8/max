<?php

return [

    'auth' => [
        'invalid_credentials' => 'Netočni podaci za prijavu.',
        'clients_only'        => 'Pristup samo za klijente.',
        'account_blocked'     => 'Račun je blokiran. Kontaktirajte podršku.',
        'otp_send_failed'     => 'Nije moguće poslati OTP kod.',
        'otp_sent'            => 'OTP kod poslan na :email',
        'otp_invalid'         => 'Nevažeći ili istekli OTP kod.',
        'user_not_found'      => 'Korisnik nije pronađen.',
        'logged_out'          => 'Odjavljeni ste.',
    ],

    'transfer' => [
        'negative_balance'     => 'Negativan saldo, prijenos nije moguć.',
        'insufficient_balance' => 'Nedovoljan saldo.',
        'success'              => 'Prijenos uspješno poslan.',
        'admin_title'          => 'Prijenos na čekanju — :name',
        'admin_body'           => 'Prijenos od :amount :currency prema :name',
    ],

    'notification' => [
        'all_read' => 'Sve obavijesti označene kao pročitane.',
    ],

    'support' => [
        'empty_message' => 'Prazna poruka.',
    ],

    'profile' => [
        'updated'         => 'Profil ažuriran.',
        'same_email'      => 'Ovo je već vaša trenutna adresa e-pošte.',
        'otp_send_failed' => 'Nije moguće poslati kod.',
        'email_otp_sent'  => 'OTP kod poslan na vašu trenutnu e-poštu.',
        'otp_invalid'     => 'Nevažeći ili istekli OTP kod.',
        'email_updated'   => 'E-pošta ažurirana.',
        'wrong_password'  => 'Trenutna lozinka je netočna.',
        'password_updated'=> 'Lozinka promijenjena.',
    ],

    'movement' => [
        'credit_received'   => 'Kredit primljen',
        'debit_done'        => 'Zaduženje izvršeno',
        'transfer_to'       => 'Prijenos prema :name',
        'transfer_received' => 'Primljeni prijenos',
        'system'            => 'Sustav',
    ],
];
