<?php

return [

    // Autenticación
    'auth' => [
        'invalid_credentials' => 'Credenciales incorrectas.',
        'clients_only'        => 'Acceso reservado a clientes.',
        'account_blocked'     => 'Cuenta bloqueada. Contacte con soporte.',
        'otp_send_failed'     => 'No se pudo enviar el código OTP.',
        'otp_sent'            => 'Código OTP enviado a :email',
        'otp_invalid'         => 'Código OTP inválido o expirado.',
        'user_not_found'      => 'Usuario no encontrado.',
        'logged_out'          => 'Sesión cerrada.',
    ],

    // Transferencias
    'transfer' => [
        'negative_balance'     => 'Saldo negativo, transferencia imposible.',
        'insufficient_balance' => 'Saldo insuficiente.',
        'success'              => 'Transferencia enviada con éxito.',
        'admin_title'          => 'Transferencia pendiente — :name',
        'admin_body'           => 'Transferencia de :amount :currency a :name',
    ],

    // Notificaciones
    'notification' => [
        'all_read' => 'Todas las notificaciones marcadas como leídas.',
    ],

    // Soporte
    'support' => [
        'empty_message' => 'Mensaje vacío.',
    ],

    // Perfil
    'profile' => [
        'updated'         => 'Perfil actualizado.',
        'same_email'      => 'Este ya es tu correo electrónico actual.',
        'otp_send_failed' => 'No se pudo enviar el código.',
        'email_otp_sent'  => 'Código OTP enviado a tu correo actual.',
        'otp_invalid'     => 'Código OTP inválido o expirado.',
        'email_updated'   => 'Correo electrónico actualizado.',
        'wrong_password'  => 'Contraseña actual incorrecta.',
        'password_updated'=> 'Contraseña modificada.',
    ],

    // Movimientos / actividad
    'movement' => [
        'credit_received'   => 'Crédito recibido',
        'debit_done'        => 'Débito realizado',
        'transfer_to'       => 'Transferencia a :name',
        'transfer_received' => 'Transferencia recibida',
        'system'            => 'Sistema',
    ],
];
