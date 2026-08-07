<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StaffResetPasswordNotification extends Notification
{
    public function __construct(public string $token) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $notifiable->locale ?? 'fr';
        $url    = route('staff.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);
        $expire = (int) config('auth.passwords.users.expire', 60);

        $subjects = [
            'fr' => 'Réinitialisation de votre mot de passe administrateur — Solberg Grupo',
            'en' => 'Reset your administrator password — Solberg Grupo',
            'es' => 'Restablecimiento de su contraseña de administrador — Solberg Grupo',
            'pl' => 'Resetowanie hasła administratora — Solberg Grupo',
        ];

        return (new MailMessage)
            ->subject($subjects[$locale] ?? $subjects['fr'])
            ->view('emails.password-reset', [
                'url'           => $url,
                'user'          => $notifiable,
                'locale'        => $locale,
                'expireMinutes' => $expire,
                'portal'        => 'staff',
            ]);
    }
}
