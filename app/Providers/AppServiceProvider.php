<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\Stream\SocketStream;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->configureResetPasswordMail();

        Mail::extend('smtp-no-verify', function (array $config) {
            // $tls = null : laisse Symfony choisir TLS implicite (port 465) ou
            // STARTTLS (587) selon le port — seule la vérification du certificat
            // est désactivée ci-dessous, pas le chiffrement lui-même.
            $transport = new EsmtpTransport(
                $config['host'] ?? 'localhost',
                (int) ($config['port'] ?? 587),
                null
            );
            $transport->setUsername($config['username'] ?? '');
            $transport->setPassword($config['password'] ?? '');

            $stream = $transport->getStream();
            if ($stream instanceof SocketStream) {
                $stream->setStreamOptions([
                    'ssl' => [
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true,
                    ],
                ]);
            }

            return $transport;
        });
    }

    private function configureResetPasswordMail(): void
    {
        ResetPassword::toMailUsing(function ($notifiable, string $token) {
            $locale  = $notifiable->locale ?? 'fr';
            $url     = route('password.reset', ['token' => $token, 'email' => $notifiable->email]);
            $expire  = (int) config('auth.passwords.users.expire', 60);

            $subjects = [
                'fr' => 'Réinitialisation de votre mot de passe — AURELIS CAPITAL GROUP',
                'en' => 'Reset your password — AURELIS CAPITAL GROUP',
                'es' => 'Restablecimiento de su contraseña — AURELIS CAPITAL GROUP',
                'pl' => 'Resetowanie hasła — AURELIS CAPITAL GROUP',
            ];

            return (new MailMessage)
                ->subject($subjects[$locale] ?? $subjects['fr'])
                ->view('emails.password-reset', [
                    'url'            => $url,
                    'user'           => $notifiable,
                    'locale'         => $locale,
                    'expireMinutes'  => $expire,
                ]);
        });
    }
}
