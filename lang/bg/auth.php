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

    'failed'   => 'Тези идентификационни данни не съответстват на нито един акаунт.',
    'password' => 'Предоставената парола е неправилна.',
    'throttle' => 'Твърде много опити. Опитайте отново след :seconds секунди.',

    'client_login_title'  => 'Клиентска зона',
    'client_login_sub'    => 'Влезте, за да получите достъп до вашите досиета',
    'client_brand_title'  => 'Вашето клиентско<br>пространство Credixa',
    'client_brand_sub'    => 'Следете вашите заявки, управлявайте профила си и получавайте достъп до всички ваши документи в пълна сигурност.',

    'staff_login_title'   => 'Административен портал',
    'staff_login_sub'     => 'Запазен изключително за оторизиран персонал',
    'staff_brand_title'   => 'Администрация<br>Credixa',
    'staff_brand_sub'     => 'Защитен достъп до инструменти за управление, проследяване на досиета и администриране на потребители.',

    'email'               => 'Имейл адрес',
    'email_staff'         => 'Служебен имейл',
    'email_ph'            => 'вие@пример.com',
    'email_ph_staff'      => 'agent@credixa.eu',
    'password_label'      => 'Парола',
    'remember'            => 'Запомни ме',
    'remember_staff'      => 'Остани свързан',
    'submit'              => 'Влез',
    'submit_staff'        => 'Достъп до таблото',
    'back_site'           => 'Назад към сайта',
    'staff_portal_link'   => 'Портал на агент / администратор',
    'client_portal_link'  => 'Клиентска зона',
    'staff_restricted'    => 'Ограничен достъп — Оторизиран персонал',
    'staff_notice'        => 'Този портал е предназначен за агентите на Credixa. Всички влизания се записват.',
    'or_staff'            => 'Агент или администратор ли сте?',
    'or_client'           => 'Клиент ли сте?',

    'stat_clients'        => 'Доволни клиенти',
    'stat_amount'         => 'Максимален заем / досие',
    'stat_time'           => 'Гарантиран отговор',
    'stat_years'          => 'Години опит',

    'feature_secure'      => 'Шифровани данни',
    'feature_currencies'  => '6 приети валути',
    'feature_certified'   => 'Европейски лиценз',
    'feature_fast'        => 'Отговор за 24ч.',

    'role_superadmin'     => 'Супер Администратор',
    'role_superadmin_sub' => 'Глобално управление & роли',
    'role_admin'          => 'Администратор',
    'role_admin_sub'      => 'Управление на досиетата',

    // Identifier (email or phone)
    'identifier'          => 'Имейл или телефон',
    'identifier_ph'       => 'вашият@имейл.com или +359...',
    'forgot_password'     => 'Забравена парола?',
    'portal_clients_only' => 'Този портал е предназначен само за клиенти.',

    // OTP page
    'otp_title'           => 'Верификация',
    'otp_heading'         => 'Код за сигурност',
    'otp_subtitle'        => 'Изпратихме 6-цифрен код на',
    'otp_enter'           => 'Въведете кода, получен по имейл',
    'otp_verify_btn'      => 'Потвърди',
    'otp_resend'          => 'Изпрати кода отново',
    'otp_resend_in'       => 'Изпрати отново след',
    'otp_back'            => 'Смени акаунт',
    'otp_verifying'       => 'Верификация в процес…',
    'otp_invalid'         => 'Грешен код. Остават ви :remaining опит(и).',
    'otp_expired'         => 'Този код е изтекъл. Поискайте нов.',
    'otp_too_many'        => 'Твърде много опити. Опитайте отново след :seconds секунди.',
    'otp_resend_limit'    => 'Твърде много изпращания. Опитайте отново след няколко минути.',
    'otp_send_failed'     => 'Невъзможно изпращане на кода. Опитайте отново.',
    'otp_session_expired' => 'Сесията е изтекла. Влезте отново.',
    'otp_resend_success'  => 'Нов код изпратен!',

    // Запомнен акаунт
    'change_account' => 'Смени акаунт',

    // Блокиран акаунт
    'account_blocked'                     => 'Вашият акаунт е блокиран след твърде много неправилни опити. Проверете имейла си за получаване на линка за деблокиране.',
    'account_blocked_notified'            => 'Твърде много неправилни опити. Вашият акаунт е блокиран. Линк за деблокиране е изпратен на имейла ви.',
    'account_unblocked'                   => 'Вашият акаунт беше успешно деблокиран. Вече можете да влезете.',
    'unblock_invalid'                     => 'Този линк за деблокиране е невалиден или е изтекъл. Свържете се с поддръжката.',

    'account_blocked_email_subject'       => 'Вашият акаунт в Credixa беше блокиран',
    'account_blocked_email_title'         => 'Акаунтът е временно блокиран',
    'account_blocked_email_intro'         => 'Вашият акаунт беше временно блокиран след няколко неуспешни опита за влизане.',
    'account_blocked_email_reason_title'  => 'Защо е това блокиране?',
    'account_blocked_email_reason_body'   => '4 неправилни OTP кода бяха въведени последователно при опит за влизане в акаунта ви. По мерки за сигурност достъпът е суспендиран.',
    'account_blocked_email_btn'           => 'Деблокирай акаунта ми',
    'account_blocked_email_fallback'      => 'Ако бутонът не работи, копирайте този линк в браузъра си:',
    'account_blocked_email_notice'        => 'Ако не сте инициирали тези опити, не кликайте върху линка и незабавно се свържете с поддръжката на Credixa.',
    'account_blocked_email_footer'        => 'Линкът е валиден 48 часа.',

    // OTP имейл
    'otp_email_subject'      => 'Вашият код за влизане — Credixa',
    'otp_email_title'        => 'Код за верификация',
    'otp_email_intro'        => 'Ето вашия еднократен код за влизане. Не го споделяйте с никого.',
    'otp_email_code_label'   => 'Вашият код',
    'otp_email_expiry'       => 'Този код изтича след 10 минути.',
    'otp_email_notice_title' => 'Важна сигурност',
    'otp_email_notice_body'  => 'Credixa никога няма да ви поиска този код по телефон или съобщение. Ако не сте поискали този код, игнорирайте този имейл.',
    'otp_email_footer'       => 'Ако не сте поискали този код, игнорирайте този имейл.',

];
