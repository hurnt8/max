<?php

return [

    'auth' => [
        'invalid_credentials' => 'Dettalji tal-login mhux korretti.',
        'clients_only'        => 'Aċċess riżervat għall-klijenti.',
        'account_blocked'     => 'Il-kont huwa mblukkat. Ikkuntattja s-support.',
        'otp_send_failed'     => 'Ma setax jintbagħat il-kodiċi OTP.',
        'otp_sent'            => 'Il-kodiċi OTP ntbagħat lil :email',
        'otp_invalid'         => 'Kodiċi OTP invalidu jew skadut.',
        'user_not_found'      => 'L-utent ma nstabx.',
        'logged_out'          => 'Ħriġt mis-sistema.',
    ],

    'transfer' => [
        'negative_balance'     => 'Bilanċ negattiv, it-trasferiment mhuwiex possibbli.',
        'insufficient_balance' => 'Bilanċ insuffiċjenti.',
        'success'              => 'It-trasferiment intbagħat b\'suċċess.',
        'admin_title'          => 'Trasferiment pendenti — :name',
        'admin_body'           => 'Trasferiment ta\' :amount :currency lejn :name',
    ],

    'notification' => [
        'all_read' => 'In-notifiki kollha ġew immarkati bħala maqruba.',
    ],

    'support' => [
        'empty_message' => 'Messaġġ vojt.',
    ],

    'profile' => [
        'updated'         => 'Il-profil ġie aġġornat.',
        'same_email'      => 'Dan huwa diġà l-indirizz tal-email attwali tiegħek.',
        'otp_send_failed' => 'Ma setax jintbagħat il-kodiċi.',
        'email_otp_sent'  => 'Il-kodiċi OTP ntbagħat lill-email attwali tiegħek.',
        'otp_invalid'     => 'Kodiċi OTP invalidu jew skadut.',
        'email_updated'   => 'L-email ġiet aġġornata.',
        'wrong_password'  => 'Il-password attwali hija ħażina.',
        'password_updated'=> 'Il-password inbidlet.',
    ],

    'movement' => [
        'credit_received'   => 'Kreditu riċevut',
        'debit_done'        => 'Debitu esegwit',
        'transfer_to'       => 'Trasferiment lejn :name',
        'transfer_received' => 'Trasferiment riċevut',
        'system'            => 'Sistema',
    ],
];
