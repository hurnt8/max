<?php

return [

    'auth' => [
        'invalid_credentials' => 'Невалидни данни за вход.',
        'clients_only'        => 'Достъпът е само за клиенти.',
        'account_blocked'     => 'Акаунтът е блокиран. Свържете се с поддръжката.',
        'otp_send_failed'     => 'Не може да се изпрати OTP кодът.',
        'otp_sent'            => 'OTP кодът е изпратен на :email',
        'otp_invalid'         => 'Невалиден или изтекъл OTP код.',
        'user_not_found'      => 'Потребителят не е намерен.',
        'logged_out'          => 'Излязохте от системата.',
    ],

    'transfer' => [
        'negative_balance'     => 'Отрицателен баланс, преводът е невъзможен.',
        'insufficient_balance' => 'Недостатъчен баланс.',
        'success'              => 'Преводът е изпратен успешно.',
        'admin_title'          => 'Чакащ превод — :name',
        'admin_body'           => 'Превод от :amount :currency към :name',
    ],

    'notification' => [
        'all_read' => 'Всички известия са маркирани като прочетени.',
    ],

    'support' => [
        'empty_message' => 'Празно съобщение.',
    ],

    'profile' => [
        'updated'         => 'Профилът е актуализиран.',
        'same_email'      => 'Това вече е вашият текущ имейл адрес.',
        'otp_send_failed' => 'Не може да се изпрати кодът.',
        'email_otp_sent'  => 'OTP кодът е изпратен на вашия текущ имейл.',
        'otp_invalid'     => 'Невалиден или изтекъл OTP код.',
        'email_updated'   => 'Имейлът е актуализиран.',
        'wrong_password'  => 'Текущата парола е неправилна.',
        'password_updated'=> 'Паролата е сменена.',
    ],

    'movement' => [
        'credit_received'   => 'Получен кредит',
        'debit_done'        => 'Извършено дебитиране',
        'transfer_to'       => 'Превод към :name',
        'transfer_received' => 'Получен превод',
        'system'            => 'Система',
    ],
];
