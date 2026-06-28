<?php

return [

    'auth' => [
        'invalid_credentials' => 'Ungültige Anmeldedaten.',
        'clients_only'        => 'Zugang nur für Kunden.',
        'account_blocked'     => 'Konto gesperrt. Bitte wenden Sie sich an den Support.',
        'otp_send_failed'     => 'OTP-Code konnte nicht gesendet werden.',
        'otp_sent'            => 'OTP-Code wurde an :email gesendet',
        'otp_invalid'         => 'Ungültiger oder abgelaufener OTP-Code.',
        'user_not_found'      => 'Benutzer nicht gefunden.',
        'logged_out'          => 'Abgemeldet.',
    ],

    'transfer' => [
        'negative_balance'     => 'Negatives Guthaben, Überweisung nicht möglich.',
        'insufficient_balance' => 'Unzureichendes Guthaben.',
        'success'              => 'Überweisung erfolgreich eingereicht.',
        'admin_title'          => 'Ausstehende Überweisung — :name',
        'admin_body'           => 'Überweisung von :amount :currency an :name',
    ],

    'notification' => [
        'all_read' => 'Alle Benachrichtigungen als gelesen markiert.',
    ],

    'support' => [
        'empty_message' => 'Leere Nachricht.',
    ],

    'profile' => [
        'updated'         => 'Profil aktualisiert.',
        'same_email'      => 'Dies ist bereits Ihre aktuelle E-Mail-Adresse.',
        'otp_send_failed' => 'Code konnte nicht gesendet werden.',
        'email_otp_sent'  => 'OTP-Code an Ihre aktuelle E-Mail gesendet.',
        'otp_invalid'     => 'Ungültiger oder abgelaufener OTP-Code.',
        'email_updated'   => 'E-Mail aktualisiert.',
        'wrong_password'  => 'Aktuelles Passwort ist falsch.',
        'password_updated'=> 'Passwort geändert.',
    ],

    'movement' => [
        'credit_received'   => 'Gutschrift erhalten',
        'debit_done'        => 'Belastung durchgeführt',
        'transfer_to'       => 'Überweisung an :name',
        'transfer_received' => 'Überweisung erhalten',
        'system'            => 'System',
    ],
];
