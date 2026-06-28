<?php

return [

    // Uwierzytelnianie
    'auth' => [
        'invalid_credentials' => 'Nieprawidłowe dane logowania.',
        'clients_only'        => 'Dostęp tylko dla klientów.',
        'account_blocked'     => 'Konto zablokowane. Skontaktuj się z pomocą techniczną.',
        'otp_send_failed'     => 'Nie można wysłać kodu OTP.',
        'otp_sent'            => 'Kod OTP wysłany na :email',
        'otp_invalid'         => 'Nieprawidłowy lub wygasły kod OTP.',
        'user_not_found'      => 'Użytkownik nie znaleziony.',
        'logged_out'          => 'Wylogowano.',
    ],

    // Przelewy
    'transfer' => [
        'negative_balance'     => 'Ujemne saldo, przelew niemożliwy.',
        'insufficient_balance' => 'Niewystarczające saldo.',
        'success'              => 'Przelew złożony pomyślnie.',
        'admin_title'          => 'Oczekujący przelew — :name',
        'admin_body'           => 'Przelew :amount :currency do :name',
    ],

    // Powiadomienia
    'notification' => [
        'all_read' => 'Wszystkie powiadomienia oznaczone jako przeczytane.',
    ],

    // Wsparcie
    'support' => [
        'empty_message' => 'Pusta wiadomość.',
    ],

    // Profil
    'profile' => [
        'updated'         => 'Profil zaktualizowany.',
        'same_email'      => 'To już jest Twój aktualny adres e-mail.',
        'otp_send_failed' => 'Nie można wysłać kodu.',
        'email_otp_sent'  => 'Kod OTP wysłany na Twój aktualny adres e-mail.',
        'otp_invalid'     => 'Nieprawidłowy lub wygasły kod OTP.',
        'email_updated'   => 'Adres e-mail zaktualizowany.',
        'wrong_password'  => 'Nieprawidłowe aktualne hasło.',
        'password_updated'=> 'Hasło zostało zmienione.',
    ],

    // Ruchy / aktywność
    'movement' => [
        'credit_received'   => 'Otrzymany kredyt',
        'debit_done'        => 'Wykonane obciążenie',
        'transfer_to'       => 'Przelew do :name',
        'transfer_received' => 'Otrzymany przelew',
        'system'            => 'System',
    ],
];
