<?php

return [

    // Auth
    'auth' => [
        'invalid_credentials' => 'Identifiants incorrects.',
        'clients_only'        => 'Accès réservé aux clients.',
        'account_blocked'     => 'Compte bloqué. Contactez le support.',
        'otp_send_failed'     => 'Impossible d\'envoyer le code OTP.',
        'otp_sent'            => 'Code OTP envoyé à :email',
        'otp_invalid'         => 'Code OTP invalide ou expiré.',
        'user_not_found'      => 'Utilisateur introuvable.',
        'logged_out'          => 'Déconnecté.',
    ],

    // Transferts
    'transfer' => [
        'negative_balance'     => 'Solde négatif, virement impossible.',
        'insufficient_balance' => 'Solde insuffisant.',
        'success'              => 'Virement soumis avec succès.',
        'admin_title'          => 'Virement en attente — :name',
        'admin_body'           => 'Virement de :amount :currency vers :name',
    ],

    // Notifications
    'notification' => [
        'all_read' => 'Toutes les notifications marquées comme lues.',
    ],

    // Support
    'support' => [
        'empty_message' => 'Message vide.',
    ],

    // Profil
    'profile' => [
        'updated'         => 'Profil mis à jour.',
        'same_email'      => 'C\'est déjà votre email actuel.',
        'otp_send_failed' => 'Impossible d\'envoyer le code.',
        'email_otp_sent'  => 'Code OTP envoyé à votre email actuel.',
        'otp_invalid'     => 'Code OTP invalide ou expiré.',
        'email_updated'   => 'Email mis à jour.',
        'wrong_password'  => 'Mot de passe actuel incorrect.',
        'password_updated'=> 'Mot de passe modifié.',
    ],

    // Mouvements / activité
    'movement' => [
        'credit_received'   => 'Crédit reçu',
        'debit_done'        => 'Débit effectué',
        'transfer_to'       => 'Virement vers :name',
        'transfer_received' => 'Virement reçu',
        'system'            => 'Système',
    ],
];
