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
        'fr' => ['M' => 'Activation de votre compte : AURELIS CAPITAL GROUP',
                 'F' => 'Activation de votre compte : AURELIS CAPITAL GROUP',
                 'N' => 'Activez votre compte : AURELIS CAPITAL GROUP'],
        'en' => ['M' => 'Activate your account : AURELIS CAPITAL GROUP',
                 'F' => 'Activate your account : AURELIS CAPITAL GROUP',
                 'N' => 'Activate your account : AURELIS CAPITAL GROUP'],
        'es' => ['M' => 'Activación de su cuenta : AURELIS CAPITAL GROUP',
                 'F' => 'Activación de su cuenta : AURELIS CAPITAL GROUP',
                 'N' => 'Active su cuenta : AURELIS CAPITAL GROUP'],
        'pl' => ['M' => 'Aktywacja Twojego konta : AURELIS CAPITAL GROUP',
                 'F' => 'Aktywacja Twojego konta : AURELIS CAPITAL GROUP',
                 'N' => 'Aktywuj swoje konto : AURELIS CAPITAL GROUP'],
        'bg' => ['M' => 'Активиране на вашия профил : AURELIS CAPITAL GROUP',
                 'F' => 'Активиране на вашия профил : AURELIS CAPITAL GROUP',
                 'N' => 'Активирайте профила си : AURELIS CAPITAL GROUP'],
        'hu' => ['M' => 'Fiókja aktiválása : AURELIS CAPITAL GROUP',
                 'F' => 'Fiókja aktiválása : AURELIS CAPITAL GROUP',
                 'N' => 'Aktiválja fiókját : AURELIS CAPITAL GROUP'],
        'it' => ['M' => 'Attivazione del tuo account : AURELIS CAPITAL GROUP',
                 'F' => 'Attivazione del tuo account : AURELIS CAPITAL GROUP',
                 'N' => 'Attiva il tuo account : AURELIS CAPITAL GROUP'],
        'de' => ['M' => 'Aktivierung Ihres Kontos : AURELIS CAPITAL GROUP',
                 'F' => 'Aktivierung Ihres Kontos : AURELIS CAPITAL GROUP',
                 'N' => 'Aktivieren Sie Ihr Konto : AURELIS CAPITAL GROUP'],
        'lt' => ['M' => 'Jūsų paskyros aktyvinimas : AURELIS CAPITAL GROUP',
                 'F' => 'Jūsų paskyros aktyvinimas : AURELIS CAPITAL GROUP',
                 'N' => 'Aktyvuokite savo paskyrą : AURELIS CAPITAL GROUP'],
        'ro' => ['M' => 'Activarea contului dumneavoastră : AURELIS CAPITAL GROUP',
                 'F' => 'Activarea contului dumneavoastră : AURELIS CAPITAL GROUP',
                 'N' => 'Activați-vă contul : AURELIS CAPITAL GROUP'],
        'lv' => ['M' => 'Jūsu konta aktivizēšana : AURELIS CAPITAL GROUP',
                 'F' => 'Jūsu konta aktivizēšana : AURELIS CAPITAL GROUP',
                 'N' => 'Aktivizējiet savu kontu : AURELIS CAPITAL GROUP'],
        'nl' => ['M' => 'Activering van uw account : AURELIS CAPITAL GROUP',
                 'F' => 'Activering van uw account : AURELIS CAPITAL GROUP',
                 'N' => 'Activeer uw account : AURELIS CAPITAL GROUP'],
        'pt' => ['M' => 'Ativação da sua conta : AURELIS CAPITAL GROUP',
                 'F' => 'Ativação da sua conta : AURELIS CAPITAL GROUP',
                 'N' => 'Ative a sua conta : AURELIS CAPITAL GROUP'],
        'sk' => ['M' => 'Aktivácia vášho účtu : AURELIS CAPITAL GROUP',
                 'F' => 'Aktivácia vášho účtu : AURELIS CAPITAL GROUP',
                 'N' => 'Aktivujte si účet : AURELIS CAPITAL GROUP'],
        'el' => ['M' => 'Ενεργοποίηση του λογαριασμού σας : AURELIS CAPITAL GROUP',
                 'F' => 'Ενεργοποίηση του λογαριασμού σας : AURELIS CAPITAL GROUP',
                 'N' => 'Ενεργοποιήστε τον λογαριασμό σας : AURELIS CAPITAL GROUP'],
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
        'pt' => 'Ativar minha conta',
        'sk' => 'Aktivovať môj účet',
        'el' => 'Ενεργοποίηση του λογαριασμού μου',
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
        'pt' => [
            'intro'  => 'Um consultor da **{NOM_ENTREPRISE}** acabou de criar o seu espaço de cliente pessoal.',
            'action' => 'Para aceder ao seu espaço e acompanhar os seus processos de financiamento, **ative a sua conta** clicando no botão abaixo.',
        ],
        'sk' => [
            'intro'  => 'Poradca spoločnosti **{NOM_ENTREPRISE}** práve vytvoril váš osobný klientsky priestor.',
            'action' => 'Ak chcete získať prístup k svojmu priestoru a sledovať svoje spisy financovania, **aktivujte si účet** kliknutím na tlačidlo nižšie.',
        ],
        'el' => [
            'intro'  => 'Ένας σύμβουλος της **{NOM_ENTREPRISE}** μόλις δημιούργησε τον προσωπικό σας χώρο πελάτη.',
            'action' => 'Για να αποκτήσετε πρόσβαση στον χώρο σας και να παρακολουθείτε τους φακέλους χρηματοδότησής σας, **ενεργοποιήστε τον λογαριασμό σας** κάνοντας κλικ στο παρακάτω κουμπί.',
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
            'pt' => ['M' => 'Caro',       'F' => 'Cara',      'N' => 'Olá'],
            'sk' => ['M' => 'Vážený',     'F' => 'Vážená',    'N' => 'Dobrý deň'],
            'el' => ['M' => 'Αγαπητέ',    'F' => 'Αγαπητή',   'N' => 'Γεια σας'],
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
            'pt' => ['M' => 'Senhor',     'F' => 'Senhora',   'N' => ''],
            'sk' => ['M' => 'pán',        'F' => 'pani',      'N' => ''],
            'el' => ['M' => 'Κύριε',      'F' => 'Κυρία',     'N' => ''],
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
            'pt' => ['M' => 'Atenciosamente',  'F' => 'Atenciosamente',  'N' => 'Atenciosamente'],
            'sk' => ['M' => 'S pozdravom',     'F' => 'S pozdravom',     'N' => 'S pozdravom'],
            'el' => ['M' => 'Με εκτίμηση',     'F' => 'Με εκτίμηση',     'N' => 'Με εκτίμηση'],
        ],
        '{EQUIPE}' => [
            'fr' => ['M' => "L'équipe AURELIS CAPITAL GROUP",     'F' => "L'équipe AURELIS CAPITAL GROUP",     'N' => "L'équipe AURELIS CAPITAL GROUP"],
            'en' => ['M' => 'The AURELIS CAPITAL GROUP Team',     'F' => 'The AURELIS CAPITAL GROUP Team',     'N' => 'The AURELIS CAPITAL GROUP Team'],
            'es' => ['M' => 'El equipo de AURELIS CAPITAL GROUP', 'F' => 'El equipo de AURELIS CAPITAL GROUP', 'N' => 'El equipo de AURELIS CAPITAL GROUP'],
            'pl' => ['M' => 'Zespół AURELIS CAPITAL GROUP',       'F' => 'Zespół AURELIS CAPITAL GROUP',       'N' => 'Zespół AURELIS CAPITAL GROUP'],
            'bg' => ['M' => 'Екипът на AURELIS CAPITAL GROUP',    'F' => 'Екипът на AURELIS CAPITAL GROUP',    'N' => 'Екипът на AURELIS CAPITAL GROUP'],
            'hu' => ['M' => 'A AURELIS CAPITAL GROUP csapata',    'F' => 'A AURELIS CAPITAL GROUP csapata',    'N' => 'A AURELIS CAPITAL GROUP csapata'],
            'it' => ['M' => 'Il team AURELIS CAPITAL GROUP',      'F' => 'Il team AURELIS CAPITAL GROUP',      'N' => 'Il team AURELIS CAPITAL GROUP'],
            'de' => ['M' => 'Das AURELIS CAPITAL GROUP Team',     'F' => 'Das AURELIS CAPITAL GROUP Team',     'N' => 'Das AURELIS CAPITAL GROUP Team'],
            'lt' => ['M' => 'AURELIS CAPITAL GROUP komanda',      'F' => 'AURELIS CAPITAL GROUP komanda',      'N' => 'AURELIS CAPITAL GROUP komanda'],
            'ro' => ['M' => 'Echipa AURELIS CAPITAL GROUP',       'F' => 'Echipa AURELIS CAPITAL GROUP',       'N' => 'Echipa AURELIS CAPITAL GROUP'],
            'lv' => ['M' => 'AURELIS CAPITAL GROUP komanda',      'F' => 'AURELIS CAPITAL GROUP komanda',      'N' => 'AURELIS CAPITAL GROUP komanda'],
            'nl' => ['M' => 'Het AURELIS CAPITAL GROUP Team',     'F' => 'Het AURELIS CAPITAL GROUP Team',     'N' => 'Het AURELIS CAPITAL GROUP Team'],
            'pt' => ['M' => 'A equipa AURELIS CAPITAL GROUP',     'F' => 'A equipa AURELIS CAPITAL GROUP',     'N' => 'A equipa AURELIS CAPITAL GROUP'],
            'sk' => ['M' => 'Tím AURELIS CAPITAL GROUP',          'F' => 'Tím AURELIS CAPITAL GROUP',          'N' => 'Tím AURELIS CAPITAL GROUP'],
            'el' => ['M' => 'Η ομάδα AURELIS CAPITAL GROUP',      'F' => 'Η ομάδα AURELIS CAPITAL GROUP',      'N' => 'Η ομάδα AURELIS CAPITAL GROUP'],
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
            'pt' => ['M' => 'Este link de ativação é **pessoal e único**. Expira assim que definir a sua palavra-passe.',
                     'F' => 'Este link de ativação é **pessoal e único**. Expira assim que definir a sua palavra-passe.',
                     'N' => 'Este link de ativação é **pessoal e único**. Expira assim que definir a sua palavra-passe.'],
            'sk' => ['M' => 'Tento aktivačný odkaz je **osobný a jedinečný**. Jeho platnosť vyprší hneď po nastavení hesla.',
                     'F' => 'Tento aktivačný odkaz je **osobný a jedinečný**. Jeho platnosť vyprší hneď po nastavení hesla.',
                     'N' => 'Tento aktivačný odkaz je **osobný a jedinečný**. Jeho platnosť vyprší hneď po nastavení hesla.'],
            'el' => ['M' => 'Αυτός ο σύνδεσμος ενεργοποίησης είναι **προσωπικός και μοναδικός**. Λήγει μόλις ορίσετε τον κωδικό πρόσβασής σας.',
                     'F' => 'Αυτός ο σύνδεσμος ενεργοποίησης είναι **προσωπικός και μοναδικός**. Λήγει μόλις ορίσετε τον κωδικό πρόσβασής σας.',
                     'N' => 'Αυτός ο σύνδεσμος ενεργοποίησης είναι **προσωπικός και μοναδικός**. Λήγει μόλις ορίσετε τον κωδικό πρόσβασής σας.'],
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
            'pt' => ['M' => "Se não foi você que solicitou a criação desta conta, pode ignorar este email.",
                     'F' => "Se não foi você que solicitou a criação desta conta, pode ignorar este email.",
                     'N' => "Se não foi você que solicitou a criação desta conta, pode ignorar este email."],
            'sk' => ['M' => "Ak ste nežiadali o vytvorenie tohto účtu, môžete tento email ignorovať.",
                     'F' => "Ak ste nežiadali o vytvorenie tohto účtu, môžete tento email ignorovať.",
                     'N' => "Ak ste nežiadali o vytvorenie tohto účtu, môžete tento email ignorovať."],
            'el' => ['M' => "Εάν δεν ζητήσατε εσείς τη δημιουργία αυτού του λογαριασμού, μπορείτε να αγνοήσετε αυτό το email.",
                     'F' => "Εάν δεν ζητήσατε εσείς τη δημιουργία αυτού του λογαριασμού, μπορείτε να αγνοήσετε αυτό το email.",
                     'N' => "Εάν δεν ζητήσατε εσείς τη δημιουργία αυτού του λογαριασμού, μπορείτε να αγνοήσετε αυτό το email."],
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
        $resolved['{NOM_ENTREPRISE}']  = 'AURELIS CAPITAL GROUP';

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
