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
            'bg' => 'Нулиране на администраторската ви парола — Solberg Grupo',
            'hu' => 'Adminisztrátori jelszó visszaállítása — Solberg Grupo',
            'it' => 'Reimposta la tua password amministratore — Solberg Grupo',
            'de' => 'Zurücksetzen Ihres Administrator-Passworts — Solberg Grupo',
            'lt' => 'Administratoriaus slaptažodžio atkūrimas — Solberg Grupo',
            'ro' => 'Resetarea parolei dumneavoastră de administrator — Solberg Grupo',
            'lv' => 'Administratora paroles atiestatīšana — Solberg Grupo',
            'nl' => 'Uw beheerderswachtwoord opnieuw instellen — Solberg Grupo',
            'pt' => 'Redefinição da sua palavra-passe de administrador — Solberg Grupo',
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
