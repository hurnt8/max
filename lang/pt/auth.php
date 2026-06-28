<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Estas credenciais não correspondem a nenhuma conta.',
    'password' => 'A senha fornecida está incorreta.',
    'throttle' => 'Demasiadas tentativas. Tente novamente em :seconds segundos.',

    'client_login_title'  => 'Área do Cliente',
    'client_login_sub'    => 'Inicie sessão para aceder aos seus dossiês',
    'client_brand_title'  => 'O seu espaço<br>cliente Credixa',
    'client_brand_sub'    => 'Acompanhe os seus pedidos, gira o seu perfil e aceda a todos os seus documentos em total segurança.',

    'staff_login_title'   => 'Portal de Administração',
    'staff_login_sub'     => 'Reservado exclusivamente ao pessoal autorizado',
    'staff_brand_title'   => 'Administração<br>Credixa',
    'staff_brand_sub'     => 'Acesso seguro às ferramentas de gestão, acompanhamento de dossiês e administração de utilizadores.',

    'email'               => 'Endereço de email',
    'email_staff'         => 'Email profissional',
    'email_ph'            => 'voce@exemplo.com',
    'email_ph_staff'      => 'agent@credixa.eu',
    'password_label'      => 'Palavra-passe',
    'remember'            => 'Lembrar-me',
    'remember_staff'      => 'Permanecer ligado',
    'submit'              => 'Entrar',
    'submit_staff'        => 'Aceder ao painel de controlo',
    'back_site'           => 'Voltar ao site',
    'staff_portal_link'   => 'Portal de agente / administrador',
    'client_portal_link'  => 'Área do cliente',
    'staff_restricted'    => 'Acesso restrito — Pessoal autorizado',
    'staff_notice'        => 'Este portal é reservado aos agentes Credixa. Todas as ligações são registadas.',
    'or_staff'            => 'É agente ou administrador?',
    'or_client'           => 'É cliente?',

    'stat_clients'        => 'Clientes satisfeitos',
    'stat_amount'         => 'Empréstimo máx. / dossiê',
    'stat_time'           => 'Resposta garantida',
    'stat_years'          => 'Anos de experiência',

    'feature_secure'      => 'Dados encriptados',
    'feature_currencies'  => '6 moedas aceites',
    'feature_certified'   => 'Licença europeia',
    'feature_fast'        => 'Resposta em 24h',

    'role_superadmin'     => 'Super Administrador',
    'role_superadmin_sub' => 'Gestão global & funções',
    'role_admin'          => 'Administrador',
    'role_admin_sub'      => 'Gestão de dossiês',

    // Identifier (email or phone)
    'identifier'          => 'Email ou telefone',
    'identifier_ph'       => 'o_seu@email.com ou +351...',
    'forgot_password'     => 'Esqueceu a palavra-passe?',
    'portal_clients_only' => 'Este portal é reservado apenas a clientes.',

    // OTP page
    'otp_title'           => 'Verificação',
    'otp_heading'         => 'Código de segurança',
    'otp_subtitle'        => 'Enviámos um código de 6 dígitos para',
    'otp_enter'           => 'Introduza o código recebido por email',
    'otp_verify_btn'      => 'Verificar',
    'otp_resend'          => 'Reenviar o código',
    'otp_resend_in'       => 'Reenviar em',
    'otp_back'            => 'Mudar de conta',
    'otp_verifying'       => 'Verificação em curso…',
    'otp_invalid'         => 'Código incorreto. Restam-lhe :remaining tentativa(s).',
    'otp_expired'         => 'Este código expirou. Solicite um novo.',
    'otp_too_many'        => 'Demasiadas tentativas. Tente novamente em :seconds segundos.',
    'otp_resend_limit'    => 'Demasiados reenvios. Tente novamente em alguns minutos.',
    'otp_send_failed'     => 'Impossível enviar o código. Tente novamente.',
    'otp_session_expired' => 'Sessão expirada. Inicie sessão novamente.',
    'otp_resend_success'  => 'Novo código enviado!',

    // Conta memorizada
    'change_account' => 'Mudar de conta',

    // Conta bloqueada
    'account_blocked'                     => 'A sua conta está bloqueada após demasiadas tentativas incorretas. Verifique o seu email para receber o link de desbloqueio.',
    'account_blocked_notified'            => 'Demasiadas tentativas incorretas. A sua conta foi bloqueada. Um link de desbloqueio foi enviado para o seu email.',
    'account_unblocked'                   => 'A sua conta foi desbloqueada com sucesso. Pode agora iniciar sessão.',
    'unblock_invalid'                     => 'Este link de desbloqueio é inválido ou expirou. Contacte o suporte.',

    'account_blocked_email_subject'       => 'A sua conta Credixa foi bloqueada',
    'account_blocked_email_title'         => 'Conta temporariamente bloqueada',
    'account_blocked_email_intro'         => 'A sua conta foi temporariamente bloqueada após várias tentativas de ligação incorretas.',
    'account_blocked_email_reason_title'  => 'Porquê este bloqueio?',
    'account_blocked_email_reason_body'   => '4 códigos OTP incorretos foram introduzidos consecutivamente durante uma tentativa de acesso à sua conta. Por medida de segurança, o acesso foi suspenso.',
    'account_blocked_email_btn'           => 'Desbloquear a minha conta',
    'account_blocked_email_fallback'      => 'Se o botão não funcionar, copie este link para o seu browser:',
    'account_blocked_email_notice'        => 'Se não foi você a fazer estas tentativas, não clique neste link e contacte imediatamente o suporte Credixa.',
    'account_blocked_email_footer'        => 'Link válido por 48 horas.',

    // OTP email
    'otp_email_subject'      => 'O seu código de acesso — Credixa',
    'otp_email_title'        => 'Código de verificação',
    'otp_email_intro'        => 'Aqui está o seu código de acesso de utilização única. Não o comunique a ninguém.',
    'otp_email_code_label'   => 'O seu código',
    'otp_email_expiry'       => 'Este código expira em 10 minutos.',
    'otp_email_notice_title' => 'Segurança importante',
    'otp_email_notice_body'  => 'A Credixa nunca lhe pedirá este código por telefone ou mensagem. Se não solicitou este código, ignore este email.',
    'otp_email_footer'       => 'Se não solicitou este código, ignore este email.',

];
