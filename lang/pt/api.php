<?php

return [

    'auth' => [
        'invalid_credentials' => 'Credenciais incorretas.',
        'clients_only'        => 'Acesso reservado aos clientes.',
        'account_blocked'     => 'Conta bloqueada. Entre em contato com o suporte.',
        'otp_send_failed'     => 'Não foi possível enviar o código OTP.',
        'otp_sent'            => 'Código OTP enviado para :email',
        'otp_invalid'         => 'Código OTP inválido ou expirado.',
        'user_not_found'      => 'Utilizador não encontrado.',
        'logged_out'          => 'Sessão encerrada.',
    ],

    'transfer' => [
        'negative_balance'     => 'Saldo negativo, transferência impossível.',
        'insufficient_balance' => 'Saldo insuficiente.',
        'success'              => 'Transferência enviada com sucesso.',
        'admin_title'          => 'Transferência pendente — :name',
        'admin_body'           => 'Transferência de :amount :currency para :name',
    ],

    'notification' => [
        'all_read' => 'Todas as notificações marcadas como lidas.',
    ],

    'support' => [
        'empty_message' => 'Mensagem vazia.',
    ],

    'profile' => [
        'updated'         => 'Perfil atualizado.',
        'same_email'      => 'Este já é o seu endereço de email atual.',
        'otp_send_failed' => 'Não foi possível enviar o código.',
        'email_otp_sent'  => 'Código OTP enviado para o seu email atual.',
        'otp_invalid'     => 'Código OTP inválido ou expirado.',
        'email_updated'   => 'Email atualizado.',
        'wrong_password'  => 'Senha atual incorreta.',
        'password_updated'=> 'Senha alterada.',
    ],

    'movement' => [
        'credit_received'   => 'Crédito recebido',
        'debit_done'        => 'Débito efetuado',
        'transfer_to'       => 'Transferência para :name',
        'transfer_received' => 'Transferência recebida',
        'system'            => 'Sistema',
    ],
];
