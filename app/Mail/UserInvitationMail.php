<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    // ── Sujets de l'email selon [locale][genre] ──────────────────────────────
    private const SUBJECTS = [
        'fr' => ['M' => 'Activation de votre compte — Solberg Grupo',
                 'F' => 'Activation de votre compte — Solberg Grupo',
                 'N' => 'Activez votre compte — Solberg Grupo'],
        'en' => ['M' => 'Activate your account — Solberg Grupo',
                 'F' => 'Activate your account — Solberg Grupo',
                 'N' => 'Activate your account — Solberg Grupo'],
        'es' => ['M' => 'Activación de su cuenta — Solberg Grupo',
                 'F' => 'Activación de su cuenta — Solberg Grupo',
                 'N' => 'Active su cuenta — Solberg Grupo'],
        'pl' => ['M' => 'Aktywacja Twojego konta — Solberg Grupo',
                 'F' => 'Aktywacja Twojego konta — Solberg Grupo',
                 'N' => 'Aktywuj swoje konto — Solberg Grupo'],
        'bg' => ['M' => 'Активиране на вашия профил — Solberg Grupo',
                 'F' => 'Активиране на вашия профил — Solberg Grupo',
                 'N' => 'Активирайте профила си — Solberg Grupo'],
        'hu' => ['M' => 'Fiókja aktiválása — Solberg Grupo',
                 'F' => 'Fiókja aktiválása — Solberg Grupo',
                 'N' => 'Aktiválja fiókját — Solberg Grupo'],
        'it' => ['M' => 'Attivazione del tuo account — Solberg Grupo',
                 'F' => 'Attivazione del tuo account — Solberg Grupo',
                 'N' => 'Attiva il tuo account — Solberg Grupo'],
        'de' => ['M' => 'Aktivierung Ihres Kontos — Solberg Grupo',
                 'F' => 'Aktivierung Ihres Kontos — Solberg Grupo',
                 'N' => 'Aktivieren Sie Ihr Konto — Solberg Grupo'],
        'lt' => ['M' => 'Jūsų paskyros aktyvinimas — Solberg Grupo',
                 'F' => 'Jūsų paskyros aktyvinimas — Solberg Grupo',
                 'N' => 'Aktyvuokite savo paskyrą — Solberg Grupo'],
        'ro' => ['M' => 'Activarea contului dumneavoastră — Solberg Grupo',
                 'F' => 'Activarea contului dumneavoastră — Solberg Grupo',
                 'N' => 'Activați-vă contul — Solberg Grupo'],
        'lv' => ['M' => 'Jūsu konta aktivizēšana — Solberg Grupo',
                 'F' => 'Jūsu konta aktivizēšana — Solberg Grupo',
                 'N' => 'Aktivizējiet savu kontu — Solberg Grupo'],
        'nl' => ['M' => 'Activering van uw account — Solberg Grupo',
                 'F' => 'Activering van uw account — Solberg Grupo',
                 'N' => 'Activeer uw account — Solberg Grupo'],
    ];

    // ── Labels du bouton selon la locale ────────────────────────────────────
    private const BTN_LABELS = [
        'fr' => 'Activer mon compte',
        'en' => 'Activate my account',
        'es' => 'Activar mi cuenta',
        'pl' => 'Aktywuj moje konto',
        'bg' => 'Активирай моя профил',
        'hu' => 'Fiókom aktiválása',
        'it' => 'Attiva il mio account',
        'de' => 'Mein Konto aktivieren',
        'lt' => 'Aktyvuoti paskyrą',
        'ro' => 'Activează-mi contul',
        'lv' => 'Aktivizēt manu kontu',
        'nl' => 'Mijn account activeren',
    ];

    // ── Corps principal selon la locale ─────────────────────────────────────
    private const BODY = [
        'fr' => [
            'intro'  => 'Un conseiller **{NOM_ENTREPRISE}** vient de créer votre espace client personnel.',
            'action' => 'Pour accéder à votre espace et suivre vos dossiers de financement, **activez votre compte** en cliquant sur le bouton ci-dessous.',
        ],
        'en' => [
            'intro'  => 'A **{NOM_ENTREPRISE}** advisor has just created your personal client space.',
            'action' => 'To access your space and track your financing files, **activate your account** by clicking the button below.',
        ],
        'es' => [
            'intro'  => 'Un asesor de **{NOM_ENTREPRISE}** acaba de crear su espacio de cliente personal.',
            'action' => 'Para acceder a su espacio y hacer seguimiento de sus expedientes, **active su cuenta** haciendo clic en el botón a continuación.',
        ],
        'pl' => [
            'intro'  => 'Doradca **{NOM_ENTREPRISE}** właśnie utworzył Twój osobisty obszar klienta.',
            'action' => 'Aby uzyskać dostęp do swojego obszaru i śledzić swoje wnioski, **aktywuj konto** klikając poniższy przycisk.',
        ],
        'bg' => [
            'intro'  => 'Консултант от **{NOM_ENTREPRISE}** току-що създаде вашето лично клиентско пространство.',
            'action' => 'За да получите достъп до пространството си и да следите досиетата си за финансиране, **активирайте профила си**, като натиснете бутона по-долу.',
        ],
        'hu' => [
            'intro'  => 'A **{NOM_ENTREPRISE}** egyik tanácsadója most hozta létre az Ön személyes ügyfélfiókját.',
            'action' => 'A fiókjának eléréséhez és finanszírozási ügyeinek nyomon követéséhez kérjük, **aktiválja fiókját** az alábbi gombra kattintva.',
        ],
        'it' => [
            'intro'  => 'Un consulente **{NOM_ENTREPRISE}** ha appena creato il tuo spazio cliente personale.',
            'action' => 'Per accedere al tuo spazio e monitorare le tue pratiche di finanziamento, **attiva il tuo account** cliccando sul pulsante qui sotto.',
        ],
        'de' => [
            'intro'  => 'Ein Berater von **{NOM_ENTREPRISE}** hat soeben Ihren persönlichen Kundenbereich erstellt.',
            'action' => 'Um auf Ihren Bereich zuzugreifen und Ihre Finanzierungsvorgänge zu verfolgen, **aktivieren Sie Ihr Konto**, indem Sie auf die Schaltfläche unten klicken.',
        ],
        'lt' => [
            'intro'  => '**{NOM_ENTREPRISE}** konsultantas ką tik sukūrė jūsų asmeninę kliento paskyrą.',
            'action' => 'Norėdami pasiekti savo paskyrą ir stebėti savo finansavimo bylas, **aktyvuokite paskyrą**, spustelėję mygtuką žemiau.',
        ],
        'ro' => [
            'intro'  => 'Un consilier **{NOM_ENTREPRISE}** tocmai a creat spațiul dumneavoastră personal de client.',
            'action' => 'Pentru a accesa spațiul dumneavoastră și a urmări dosarele de finanțare, **activați-vă contul** apăsând pe butonul de mai jos.',
        ],
        'lv' => [
            'intro'  => '**{NOM_ENTREPRISE}** konsultants tikko izveidoja jūsu personīgo klienta profilu.',
            'action' => 'Lai piekļūtu savam profilam un sekotu līdzi savām finansējuma lietām, **aktivizējiet savu kontu**, noklikšķinot uz zemāk esošās pogas.',
        ],
        'nl' => [
            'intro'  => 'Een adviseur van **{NOM_ENTREPRISE}** heeft zojuist uw persoonlijke klantomgeving aangemaakt.',
            'action' => 'Om toegang te krijgen tot uw omgeving en uw financieringsdossiers te volgen, **activeert u uw account** door op onderstaande knop te klikken.',
        ],
    ];

    // ── Valeurs des balises selon [locale][genre] ────────────────────────────
    private const TAGS = [
        '{CHER_E}' => [
            'fr' => ['M' => 'Cher',       'F' => 'Chère',     'N' => 'Bonjour'],
            'en' => ['M' => 'Dear',       'F' => 'Dear',      'N' => 'Hello'],
            'es' => ['M' => 'Estimado',   'F' => 'Estimada',  'N' => 'Hola'],
            'pl' => ['M' => 'Szanowny',   'F' => 'Szanowna',  'N' => 'Witaj'],
            'bg' => ['M' => 'Уважаеми',   'F' => 'Уважаема',  'N' => 'Здравейте'],
            'hu' => ['M' => 'Tisztelt',   'F' => 'Tisztelt',  'N' => 'Kedves'],
            'it' => ['M' => 'Egregio',    'F' => 'Gentile',   'N' => 'Ciao'],
            'de' => ['M' => 'Sehr geehrter', 'F' => 'Sehr geehrte', 'N' => 'Hallo'],
            'lt' => ['M' => 'Gerbiamas',  'F' => 'Gerbiama',  'N' => 'Sveiki'],
            'ro' => ['M' => 'Stimate',    'F' => 'Stimată',   'N' => 'Bună ziua'],
            'lv' => ['M' => 'Godātais',   'F' => 'Godātā',    'N' => 'Sveiki'],
            'nl' => ['M' => 'Geachte',    'F' => 'Geachte',   'N' => 'Beste'],
        ],
        '{SALUTATION}' => [
            'fr' => ['M' => 'Monsieur',   'F' => 'Madame',    'N' => ''],
            'en' => ['M' => 'Mr.',        'F' => 'Ms.',       'N' => ''],
            'es' => ['M' => 'Sr.',        'F' => 'Sra.',      'N' => ''],
            'pl' => ['M' => 'Panie',      'F' => 'Pani',      'N' => ''],
            'bg' => ['M' => 'Господин',   'F' => 'Госпожо',   'N' => ''],
            'hu' => ['M' => '',           'F' => '',          'N' => ''],
            'it' => ['M' => 'Signor',     'F' => 'Signora',   'N' => ''],
            'de' => ['M' => 'Herr',       'F' => 'Frau',      'N' => ''],
            'lt' => ['M' => 'Pone',       'F' => 'Ponia',     'N' => ''],
            'ro' => ['M' => 'Domnule',    'F' => 'Doamnă',    'N' => ''],
            'lv' => ['M' => 'Kungs',      'F' => 'Kundze',    'N' => ''],
            'nl' => ['M' => 'heer',       'F' => 'mevrouw',   'N' => ''],
        ],
        '{FORMULE_POLITESSE}' => [
            'fr' => ['M' => 'Cordialement',    'F' => 'Cordialement',    'N' => 'Cordialement'],
            'en' => ['M' => 'Best regards',    'F' => 'Best regards',    'N' => 'Kind regards'],
            'es' => ['M' => 'Atentamente',     'F' => 'Atentamente',     'N' => 'Saludos'],
            'pl' => ['M' => 'Z poważaniem',    'F' => 'Z poważaniem',    'N' => 'Z pozdrowieniami'],
            'bg' => ['M' => 'С уважение',      'F' => 'С уважение',      'N' => 'Поздрави'],
            'hu' => ['M' => 'Tisztelettel',    'F' => 'Tisztelettel',    'N' => 'Üdvözlettel'],
            'it' => ['M' => 'Cordiali saluti', 'F' => 'Cordiali saluti', 'N' => 'Un saluto'],
            'de' => ['M' => 'Mit freundlichen Grüßen', 'F' => 'Mit freundlichen Grüßen', 'N' => 'Freundliche Grüße'],
            'lt' => ['M' => 'Pagarbiai',       'F' => 'Pagarbiai',       'N' => 'Pagarbiai'],
            'ro' => ['M' => 'Cu stimă',        'F' => 'Cu stimă',        'N' => 'Cu respect'],
            'lv' => ['M' => 'Ar cieņu',        'F' => 'Ar cieņu',        'N' => 'Ar cieņu'],
            'nl' => ['M' => 'Met vriendelijke groet', 'F' => 'Met vriendelijke groet', 'N' => 'Vriendelijke groeten'],
        ],
        '{EQUIPE}' => [
            'fr' => ['M' => "L'équipe Solberg Grupo",     'F' => "L'équipe Solberg Grupo",     'N' => "L'équipe Solberg Grupo"],
            'en' => ['M' => 'The Solberg Grupo Team',     'F' => 'The Solberg Grupo Team',     'N' => 'The Solberg Grupo Team'],
            'es' => ['M' => 'El equipo de Solberg Grupo', 'F' => 'El equipo de Solberg Grupo', 'N' => 'El equipo de Solberg Grupo'],
            'pl' => ['M' => 'Zespół Solberg Grupo',       'F' => 'Zespół Solberg Grupo',       'N' => 'Zespół Solberg Grupo'],
            'bg' => ['M' => 'Екипът на Solberg Grupo',    'F' => 'Екипът на Solberg Grupo',    'N' => 'Екипът на Solberg Grupo'],
            'hu' => ['M' => 'A Solberg Grupo csapata',    'F' => 'A Solberg Grupo csapata',    'N' => 'A Solberg Grupo csapata'],
            'it' => ['M' => 'Il team Solberg Grupo',      'F' => 'Il team Solberg Grupo',      'N' => 'Il team Solberg Grupo'],
            'de' => ['M' => 'Das Solberg-Grupo-Team',     'F' => 'Das Solberg-Grupo-Team',     'N' => 'Das Solberg-Grupo-Team'],
            'lt' => ['M' => 'Solberg Grupo komanda',      'F' => 'Solberg Grupo komanda',      'N' => 'Solberg Grupo komanda'],
            'ro' => ['M' => 'Echipa Solberg Grupo',       'F' => 'Echipa Solberg Grupo',       'N' => 'Echipa Solberg Grupo'],
            'lv' => ['M' => 'Solberg Grupo komanda',      'F' => 'Solberg Grupo komanda',      'N' => 'Solberg Grupo komanda'],
            'nl' => ['M' => 'Het Solberg Grupo Team',     'F' => 'Het Solberg Grupo Team',     'N' => 'Het Solberg Grupo Team'],
        ],
        '{NOTICE_PERSONNEL}' => [
            'fr' => ['M' => "Ce lien d'activation est **personnel et unique**. Il expire dès que vous avez défini votre mot de passe.",
                     'F' => "Ce lien d'activation est **personnel et unique**. Il expire dès que vous avez défini votre mot de passe.",
                     'N' => "Ce lien d'activation est **personnel et unique**. Il expire dès que vous avez défini votre mot de passe."],
            'en' => ['M' => 'This activation link is **personal and unique**. It expires as soon as you have set your password.',
                     'F' => 'This activation link is **personal and unique**. It expires as soon as you have set your password.',
                     'N' => 'This activation link is **personal and unique**. It expires as soon as you have set your password.'],
            'es' => ['M' => 'Este enlace de activación es **personal y único**. Expira en cuanto haya establecido su contraseña.',
                     'F' => 'Este enlace de activación es **personal y único**. Expira en cuanto haya establecido su contraseña.',
                     'N' => 'Este enlace de activación es **personal y único**. Expira en cuanto haya establecido su contraseña.'],
            'pl' => ['M' => 'Ten link aktywacyjny jest **osobisty i unikalny**. Wygasa natychmiast po ustawieniu hasła.',
                     'F' => 'Ten link aktywacyjny jest **osobisty i unikalny**. Wygasa natychmiast po ustawieniu hasła.',
                     'N' => 'Ten link aktywacyjny jest **osobisty i unikalny**. Wygasa natychmiast po ustawieniu hasła.'],
            'bg' => ['M' => 'Този линк за активиране е **личен и уникален**. Той изтича веднага щом зададете паролата си.',
                     'F' => 'Този линк за активиране е **личен и уникален**. Той изтича веднага щом зададете паролата си.',
                     'N' => 'Този линк за активиране е **личен и уникален**. Той изтича веднага щом зададете паролата си.'],
            'hu' => ['M' => 'Ez az aktivációs link **személyes és egyedi**. A jelszó beállítása után azonnal lejár.',
                     'F' => 'Ez az aktivációs link **személyes és egyedi**. A jelszó beállítása után azonnal lejár.',
                     'N' => 'Ez az aktivációs link **személyes és egyedi**. A jelszó beállítása után azonnal lejár.'],
            'it' => ['M' => 'Questo link di attivazione è **personale e unico**. Scade non appena avrai impostato la tua password.',
                     'F' => 'Questo link di attivazione è **personale e unico**. Scade non appena avrai impostato la tua password.',
                     'N' => 'Questo link di attivazione è **personale e unico**. Scade non appena avrai impostato la tua password.'],
            'de' => ['M' => 'Dieser Aktivierungslink ist **persönlich und einmalig**. Er läuft ab, sobald Sie Ihr Passwort festgelegt haben.',
                     'F' => 'Dieser Aktivierungslink ist **persönlich und einmalig**. Er läuft ab, sobald Sie Ihr Passwort festgelegt haben.',
                     'N' => 'Dieser Aktivierungslink ist **persönlich und einmalig**. Er läuft ab, sobald Sie Ihr Passwort festgelegt haben.'],
            'lt' => ['M' => 'Ši aktyvinimo nuoroda yra **asmeninė ir unikali**. Ji nustoja galioti, kai tik nustatote savo slaptažodį.',
                     'F' => 'Ši aktyvinimo nuoroda yra **asmeninė ir unikali**. Ji nustoja galioti, kai tik nustatote savo slaptažodį.',
                     'N' => 'Ši aktyvinimo nuoroda yra **asmeninė ir unikali**. Ji nustoja galioti, kai tik nustatote savo slaptažodį.'],
            'ro' => ['M' => 'Acest link de activare este **personal și unic**. Expiră imediat ce ați stabilit parola.',
                     'F' => 'Acest link de activare este **personal și unic**. Expiră imediat ce ați stabilit parola.',
                     'N' => 'Acest link de activare este **personal și unic**. Expiră imediat ce ați stabilit parola.'],
            'lv' => ['M' => 'Šī aktivizācijas saite ir **personiska un unikāla**. Tā zaudē derīgumu uzreiz pēc paroles iestatīšanas.',
                     'F' => 'Šī aktivizācijas saite ir **personiska un unikāla**. Tā zaudē derīgumu uzreiz pēc paroles iestatīšanas.',
                     'N' => 'Šī aktivizācijas saite ir **personiska un unikāla**. Tā zaudē derīgumu uzreiz pēc paroles iestatīšanas.'],
            'nl' => ['M' => 'Deze activeringslink is **persoonlijk en uniek**. Hij vervalt zodra u uw wachtwoord heeft ingesteld.',
                     'F' => 'Deze activeringslink is **persoonlijk en uniek**. Hij vervalt zodra u uw wachtwoord heeft ingesteld.',
                     'N' => 'Deze activeringslink is **persoonlijk en uniek**. Hij vervalt zodra u uw wachtwoord heeft ingesteld.'],
        ],
        '{NOTICE_IGNORE}' => [
            'fr' => ['M' => "Si vous n'êtes pas à l'origine de cette création de compte, vous pouvez ignorer cet email.",
                     'F' => "Si vous n'êtes pas à l'origine de cette création de compte, vous pouvez ignorer cet email.",
                     'N' => "Si vous n'êtes pas à l'origine de cette création de compte, vous pouvez ignorer cet email."],
            'en' => ['M' => "If you did not request this account creation, you can ignore this email.",
                     'F' => "If you did not request this account creation, you can ignore this email.",
                     'N' => "If you did not request this account creation, you can ignore this email."],
            'es' => ['M' => "Si usted no solicitó la creación de esta cuenta, puede ignorar este email.",
                     'F' => "Si usted no solicitó la creación de esta cuenta, puede ignorar este email.",
                     'N' => "Si usted no solicitó la creación de esta cuenta, puede ignorar este email."],
            'pl' => ['M' => "Jeśli nie prosiłeś o utworzenie tego konta, możesz zignorować ten email.",
                     'F' => "Jeśli nie prosiłaś o utworzenie tego konta, możesz zignorować ten email.",
                     'N' => "Jeśli nie prosiłeś/aś o utworzenie tego konta, możesz zignorować ten email."],
            'bg' => ['M' => "Ако не сте инициирали създаването на този профил, можете да игнорирате този имейл.",
                     'F' => "Ако не сте инициирали създаването на този профил, можете да игнорирате този имейл.",
                     'N' => "Ако не сте инициирали създаването на този профил, можете да игнорирате този имейл."],
            'hu' => ['M' => "Ha nem Ön kezdeményezte ennek a fióknak a létrehozását, figyelmen kívül hagyhatja ezt az e-mailt.",
                     'F' => "Ha nem Ön kezdeményezte ennek a fióknak a létrehozását, figyelmen kívül hagyhatja ezt az e-mailt.",
                     'N' => "Ha nem Ön kezdeményezte ennek a fióknak a létrehozását, figyelmen kívül hagyhatja ezt az e-mailt."],
            'it' => ['M' => "Se non sei tu all'origine della creazione di questo account, puoi ignorare questa email.",
                     'F' => "Se non sei tu all'origine della creazione di questo account, puoi ignorare questa email.",
                     'N' => "Se non sei tu all'origine della creazione di questo account, puoi ignorare questa email."],
            'de' => ['M' => "Wenn Sie diese Kontoerstellung nicht veranlasst haben, können Sie diese E-Mail ignorieren.",
                     'F' => "Wenn Sie diese Kontoerstellung nicht veranlasst haben, können Sie diese E-Mail ignorieren.",
                     'N' => "Wenn Sie diese Kontoerstellung nicht veranlasst haben, können Sie diese E-Mail ignorieren."],
            'lt' => ['M' => "Jei ne jūs inicijavote šios paskyros sukūrimą, galite ignoruoti šį el. laišką.",
                     'F' => "Jei ne jūs inicijavote šios paskyros sukūrimą, galite ignoruoti šį el. laišką.",
                     'N' => "Jei ne jūs inicijavote šios paskyros sukūrimą, galite ignoruoti šį el. laišką."],
            'ro' => ['M' => "Dacă nu dumneavoastră ați inițiat crearea acestui cont, puteți ignora acest e-mail.",
                     'F' => "Dacă nu dumneavoastră ați inițiat crearea acestui cont, puteți ignora acest e-mail.",
                     'N' => "Dacă nu dumneavoastră ați inițiat crearea acestui cont, puteți ignora acest e-mail."],
            'lv' => ['M' => "Ja šī konta izveide nav notikusi pēc jūsu pieprasījuma, varat ignorēt šo e-pastu.",
                     'F' => "Ja šī konta izveide nav notikusi pēc jūsu pieprasījuma, varat ignorēt šo e-pastu.",
                     'N' => "Ja šī konta izveide nav notikusi pēc jūsu pieprasījuma, varat ignorēt šo e-pastu."],
            'nl' => ['M' => "Als u niet zelf om het aanmaken van dit account heeft gevraagd, kunt u deze e-mail negeren.",
                     'F' => "Als u niet zelf om het aanmaken van dit account heeft gevraagd, kunt u deze e-mail negeren.",
                     'N' => "Als u niet zelf om het aanmaken van dit account heeft gevraagd, kunt u deze e-mail negeren."],
        ],
    ];

    public function __construct(
        public User   $user,
        public string $activationUrl,
    ) {}

    public function envelope(): Envelope
    {
        $locale  = $this->user->locale  ?? 'fr';
        $gender  = $this->user->gender  ?? 'N';
        $subject = self::SUBJECTS[$locale][$gender]
                ?? self::SUBJECTS['fr']['N'];

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        $locale    = $this->user->locale ?? 'fr';
        $gender    = $this->user->gender ?? 'N';
        $firstName = explode(' ', $this->user->name)[0];

        $resolved = [];
        foreach (self::TAGS as $balise => $locales) {
            $resolved[$balise] = $locales[$locale][$gender]
                              ?? $locales['fr']['N'];
        }

        $resolved['{PRENOM}']          = $firstName;
        $resolved['{NOM_COMPLET}']     = $this->user->name;
        $resolved['{EMAIL}']           = $this->user->email;
        $resolved['{LIEN_ACTIVATION}'] = $this->activationUrl;
        $resolved['{NOM_ENTREPRISE}']  = 'Solberg Grupo';

        $body = self::BODY[$locale] ?? self::BODY['fr'];
        $resolved['{INTRO_CORPS}']  = $this->applyReplacements($body['intro'],  $resolved);
        $resolved['{CORPS_ACTION}'] = $this->applyReplacements($body['action'], $resolved);

        $greeting = trim($resolved['{CHER_E}'] . ' ' . $resolved['{SALUTATION}'] . ' ' . $this->user->name);

        return new Content(
            view: 'emails.user-invitation',
            with: [
                'user'          => $this->user,
                'activationUrl' => $this->activationUrl,
                'btnLabel'      => self::BTN_LABELS[$locale] ?? self::BTN_LABELS['fr'],
                'greeting'      => $greeting,
                'resolved'      => $resolved,
                'locale'        => $locale,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }

    private function applyReplacements(string $text, array $resolved): string
    {
        return str_replace(array_keys($resolved), array_values($resolved), $text);
    }
}
