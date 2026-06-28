<?php

return [

    // Auth
    'auth' => [
        'invalid_credentials' => 'Invalid credentials.',
        'clients_only'        => 'Access restricted to clients.',
        'account_blocked'     => 'Account blocked. Please contact support.',
        'otp_send_failed'     => 'Unable to send the OTP code.',
        'otp_sent'            => 'OTP code sent to :email',
        'otp_invalid'         => 'Invalid or expired OTP code.',
        'user_not_found'      => 'User not found.',
        'logged_out'          => 'Logged out.',
    ],

    // Transfers
    'transfer' => [
        'negative_balance'     => 'Negative balance, transfer not possible.',
        'insufficient_balance' => 'Insufficient balance.',
        'success'              => 'Transfer submitted successfully.',
        'admin_title'          => 'Pending transfer — :name',
        'admin_body'           => 'Transfer of :amount :currency to :name',
    ],

    // Notifications
    'notification' => [
        'all_read' => 'All notifications marked as read.',
    ],

    // Support
    'support' => [
        'empty_message' => 'Empty message.',
    ],

    // Profile
    'profile' => [
        'updated'         => 'Profile updated.',
        'same_email'      => 'This is already your current email address.',
        'otp_send_failed' => 'Unable to send the code.',
        'email_otp_sent'  => 'OTP code sent to your current email.',
        'otp_invalid'     => 'Invalid or expired OTP code.',
        'email_updated'   => 'Email updated.',
        'wrong_password'  => 'Current password is incorrect.',
        'password_updated'=> 'Password changed.',
    ],

    // Movements / activity
    'movement' => [
        'credit_received'   => 'Credit received',
        'debit_done'        => 'Debit processed',
        'transfer_to'       => 'Transfer to :name',
        'transfer_received' => 'Transfer received',
        'system'            => 'System',
    ],
];
