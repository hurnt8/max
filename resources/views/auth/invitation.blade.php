@php
$locale = $user->locale ?? 'fr';
$gender = $user->gender ?? 'N';

$texts = [
    'fr' => [
        'title'       => 'Activation de compte : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Cher Monsieur', 'F' => 'Chère Madame', 'N' => 'Bonjour'],
        'subtitle'    => 'Définissez votre mot de passe pour activer votre accès',
        'info_title'  => 'Votre compte AURELIS CAPITAL GROUP Invest',
        'info_body'   => 'a été créé par votre conseiller. Choisissez un mot de passe sécurisé pour accéder à votre espace personnel.',
        'email_label' => 'Adresse email',
        'pw_label'    => 'Nouveau mot de passe',
        'pw_ph'       => 'Minimum 8 caractères',
        'cpw_label'   => 'Confirmer le mot de passe',
        'cpw_ph'      => 'Répéter le mot de passe',
        'btn'         => 'Activer mon compte',
        'login_text'  => 'Vous avez déjà un compte ?',
        'login_link'  => 'Se connecter',
        'str_ph'      => 'Saisissez un mot de passe',
        'strengths'   => ['', 'Très faible', 'Faible', 'Moyen', 'Fort', 'Très fort'],
    ],
    'en' => [
        'title'       => 'Account Activation : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Dear Mr.', 'F' => 'Dear Ms.', 'N' => 'Hello'],
        'subtitle'    => 'Set your password to activate your account',
        'info_title'  => 'Your AURELIS CAPITAL GROUP Invest account',
        'info_body'   => 'was created by your advisor. Choose a secure password to access your personal space.',
        'email_label' => 'Email address',
        'pw_label'    => 'New password',
        'pw_ph'       => 'At least 8 characters',
        'cpw_label'   => 'Confirm password',
        'cpw_ph'      => 'Repeat password',
        'btn'         => 'Activate my account',
        'login_text'  => 'Already have an account?',
        'login_link'  => 'Sign in',
        'str_ph'      => 'Enter a password',
        'strengths'   => ['', 'Very weak', 'Weak', 'Fair', 'Strong', 'Very strong'],
    ],
    'es' => [
        'title'       => 'Activación de cuenta : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Estimado Sr.', 'F' => 'Estimada Sra.', 'N' => 'Hola'],
        'subtitle'    => 'Establezca su contraseña para activar su cuenta',
        'info_title'  => 'Su cuenta de AURELIS CAPITAL GROUP Invest',
        'info_body'   => 'fue creada por su asesor. Elija una contraseña segura para acceder a su espacio personal.',
        'email_label' => 'Correo electrónico',
        'pw_label'    => 'Nueva contraseña',
        'pw_ph'       => 'Mínimo 8 caracteres',
        'cpw_label'   => 'Confirmar contraseña',
        'cpw_ph'      => 'Repetir contraseña',
        'btn'         => 'Activar mi cuenta',
        'login_text'  => '¿Ya tiene una cuenta?',
        'login_link'  => 'Iniciar sesión',
        'str_ph'      => 'Introduzca una contraseña',
        'strengths'   => ['', 'Muy débil', 'Débil', 'Regular', 'Fuerte', 'Muy fuerte'],
    ],
    'pl' => [
        'title'       => 'Aktywacja konta : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Szanowny Panie', 'F' => 'Szanowna Pani', 'N' => 'Witaj'],
        'subtitle'    => 'Ustaw hasło, aby aktywować dostęp do konta',
        'info_title'  => 'Twoje konto AURELIS CAPITAL GROUP Invest',
        'info_body'   => 'zostało utworzone przez Twojego doradcę. Wybierz bezpieczne hasło, aby uzyskać dostęp do swojego osobistego obszaru.',
        'email_label' => 'Adres e-mail',
        'pw_label'    => 'Nowe hasło',
        'pw_ph'       => 'Minimum 8 znaków',
        'cpw_label'   => 'Potwierdź hasło',
        'cpw_ph'      => 'Powtórz hasło',
        'btn'         => 'Aktywuj moje konto',
        'login_text'  => 'Masz już konto?',
        'login_link'  => 'Zaloguj się',
        'str_ph'      => 'Wpisz hasło',
        'strengths'   => ['', 'Bardzo słabe', 'Słabe', 'Średnie', 'Silne', 'Bardzo silne'],
    ],
    'bg' => [
        'title'       => 'Активиране на профил : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Уважаеми Господине', 'F' => 'Уважаема Госпожо', 'N' => 'Здравейте'],
        'subtitle'    => 'Задайте паролата си, за да активирате достъпа си',
        'info_title'  => 'Вашият профил в AURELIS CAPITAL GROUP Invest',
        'info_body'   => 'е създаден от вашия консултант. Изберете сигурна парола, за да получите достъп до личното си пространство.',
        'email_label' => 'Имейл адрес',
        'pw_label'    => 'Нова парола',
        'pw_ph'       => 'Минимум 8 символа',
        'cpw_label'   => 'Потвърдете паролата',
        'cpw_ph'      => 'Повторете паролата',
        'btn'         => 'Активирай моя профил',
        'login_text'  => 'Вече имате профил?',
        'login_link'  => 'Вход',
        'str_ph'      => 'Въведете парола',
        'strengths'   => ['', 'Много слаба', 'Слаба', 'Средна', 'Силна', 'Много силна'],
    ],
    'hu' => [
        'title'       => 'Fiók aktiválása : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Tisztelt Uram', 'F' => 'Tisztelt Hölgyem', 'N' => 'Kedves'],
        'subtitle'    => 'Állítsa be jelszavát a fiók aktiválásához',
        'info_title'  => 'Az Ön AURELIS CAPITAL GROUP Invest fiókja',
        'info_body'   => 'fiókját tanácsadója hozta létre. Válasszon biztonságos jelszót a személyes fiókjához való hozzáféréshez.',
        'email_label' => 'E-mail cím',
        'pw_label'    => 'Új jelszó',
        'pw_ph'       => 'Legalább 8 karakter',
        'cpw_label'   => 'Jelszó megerősítése',
        'cpw_ph'      => 'Jelszó ismétlése',
        'btn'         => 'Fiókom aktiválása',
        'login_text'  => 'Már van fiókja?',
        'login_link'  => 'Bejelentkezés',
        'str_ph'      => 'Adjon meg egy jelszót',
        'strengths'   => ['', 'Nagyon gyenge', 'Gyenge', 'Közepes', 'Erős', 'Nagyon erős'],
    ],
    'it' => [
        'title'       => 'Attivazione account : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Egregio Signor', 'F' => 'Gentile Signora', 'N' => 'Ciao'],
        'subtitle'    => 'Imposta la password per attivare il tuo accesso',
        'info_title'  => 'Il tuo account AURELIS CAPITAL GROUP Invest',
        'info_body'   => 'è stato creato dal tuo consulente. Scegli una password sicura per accedere al tuo spazio personale.',
        'email_label' => 'Indirizzo email',
        'pw_label'    => 'Nuova password',
        'pw_ph'       => 'Minimo 8 caratteri',
        'cpw_label'   => 'Conferma password',
        'cpw_ph'      => 'Ripeti password',
        'btn'         => 'Attiva il mio account',
        'login_text'  => 'Hai già un account?',
        'login_link'  => 'Accedi',
        'str_ph'      => 'Inserisci una password',
        'strengths'   => ['', 'Molto debole', 'Debole', 'Media', 'Forte', 'Molto forte'],
    ],
    'de' => [
        'title'       => 'Kontoaktivierung : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Sehr geehrter Herr', 'F' => 'Sehr geehrte Frau', 'N' => 'Hallo'],
        'subtitle'    => 'Legen Sie Ihr Passwort fest, um Ihren Zugang zu aktivieren',
        'info_title'  => 'Ihr AURELIS CAPITAL GROUP Invest-Konto',
        'info_body'   => 'wurde von Ihrem Berater erstellt. Wählen Sie ein sicheres Passwort, um auf Ihren persönlichen Bereich zuzugreifen.',
        'email_label' => 'E-Mail-Adresse',
        'pw_label'    => 'Neues Passwort',
        'pw_ph'       => 'Mindestens 8 Zeichen',
        'cpw_label'   => 'Passwort bestätigen',
        'cpw_ph'      => 'Passwort wiederholen',
        'btn'         => 'Mein Konto aktivieren',
        'login_text'  => 'Sie haben bereits ein Konto?',
        'login_link'  => 'Anmelden',
        'str_ph'      => 'Passwort eingeben',
        'strengths'   => ['', 'Sehr schwach', 'Schwach', 'Mittel', 'Stark', 'Sehr stark'],
    ],
    'lt' => [
        'title'       => 'Paskyros aktyvinimas : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Gerbiamas Pone', 'F' => 'Gerbiama Ponia', 'N' => 'Sveiki'],
        'subtitle'    => 'Nustatykite slaptažodį, kad aktyvuotumėte prieigą',
        'info_title'  => 'Jūsų AURELIS CAPITAL GROUP Invest paskyra',
        'info_body'   => 'buvo sukurta jūsų konsultanto. Pasirinkite saugų slaptažodį, kad galėtumėte pasiekti savo asmeninę erdvę.',
        'email_label' => 'El. pašto adresas',
        'pw_label'    => 'Naujas slaptažodis',
        'pw_ph'       => 'Bent 8 simboliai',
        'cpw_label'   => 'Patvirtinkite slaptažodį',
        'cpw_ph'      => 'Pakartokite slaptažodį',
        'btn'         => 'Aktyvuoti paskyrą',
        'login_text'  => 'Jau turite paskyrą?',
        'login_link'  => 'Prisijungti',
        'str_ph'      => 'Įveskite slaptažodį',
        'strengths'   => ['', 'Labai silpnas', 'Silpnas', 'Vidutinis', 'Stiprus', 'Labai stiprus'],
    ],
    'ro' => [
        'title'       => 'Activarea contului : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Stimate Domnule', 'F' => 'Stimată Doamnă', 'N' => 'Bună ziua'],
        'subtitle'    => 'Setați parola pentru a vă activa accesul',
        'info_title'  => 'Contul dumneavoastră AURELIS CAPITAL GROUP Invest',
        'info_body'   => 'a fost creat de consilierul dumneavoastră. Alegeți o parolă sigură pentru a accesa spațiul dumneavoastră personal.',
        'email_label' => 'Adresă de email',
        'pw_label'    => 'Parolă nouă',
        'pw_ph'       => 'Minimum 8 caractere',
        'cpw_label'   => 'Confirmați parola',
        'cpw_ph'      => 'Repetați parola',
        'btn'         => 'Activează-mi contul',
        'login_text'  => 'Aveți deja un cont?',
        'login_link'  => 'Autentificare',
        'str_ph'      => 'Introduceți o parolă',
        'strengths'   => ['', 'Foarte slabă', 'Slabă', 'Medie', 'Puternică', 'Foarte puternică'],
    ],
    'lv' => [
        'title'       => 'Konta aktivizācija : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Godātais Kungs', 'F' => 'Godātā Kundze', 'N' => 'Sveiki'],
        'subtitle'    => 'Iestatiet paroli, lai aktivizētu piekļuvi',
        'info_title'  => 'Jūsu AURELIS CAPITAL GROUP Invest konts',
        'info_body'   => 'ir izveidojis jūsu konsultants. Izvēlieties drošu paroli, lai piekļūtu savai personīgajai zonai.',
        'email_label' => 'E-pasta adrese',
        'pw_label'    => 'Jauna parole',
        'pw_ph'       => 'Vismaz 8 rakstzīmes',
        'cpw_label'   => 'Apstipriniet paroli',
        'cpw_ph'      => 'Atkārtojiet paroli',
        'btn'         => 'Aktivizēt manu kontu',
        'login_text'  => 'Jums jau ir konts?',
        'login_link'  => 'Pieslēgties',
        'str_ph'      => 'Ievadiet paroli',
        'strengths'   => ['', 'Ļoti vāja', 'Vāja', 'Vidēja', 'Stipra', 'Ļoti stipra'],
    ],
    'nl' => [
        'title'       => 'Accountactivering : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Geachte heer', 'F' => 'Geachte mevrouw', 'N' => 'Beste'],
        'subtitle'    => 'Stel uw wachtwoord in om uw toegang te activeren',
        'info_title'  => 'Uw AURELIS CAPITAL GROUP Invest-account',
        'info_body'   => 'is aangemaakt door uw adviseur. Kies een veilig wachtwoord om toegang te krijgen tot uw persoonlijke omgeving.',
        'email_label' => 'E-mailadres',
        'pw_label'    => 'Nieuw wachtwoord',
        'pw_ph'       => 'Minimaal 8 tekens',
        'cpw_label'   => 'Bevestig wachtwoord',
        'cpw_ph'      => 'Herhaal wachtwoord',
        'btn'         => 'Mijn account activeren',
        'login_text'  => 'Heeft u al een account?',
        'login_link'  => 'Inloggen',
        'str_ph'      => 'Voer een wachtwoord in',
        'strengths'   => ['', 'Zeer zwak', 'Zwak', 'Gemiddeld', 'Sterk', 'Zeer sterk'],
    ],
    'pt' => [
        'title'       => 'Ativação de conta : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Caro Senhor', 'F' => 'Cara Senhora', 'N' => 'Olá'],
        'subtitle'    => 'Defina sua senha para ativar seu acesso',
        'info_title'  => 'Sua conta AURELIS CAPITAL GROUP Invest',
        'info_body'   => 'foi criada pelo seu consultor. Escolha uma senha segura para acessar seu espaço pessoal.',
        'email_label' => 'Endereço de email',
        'pw_label'    => 'Nova senha',
        'pw_ph'       => 'Mínimo 8 caracteres',
        'cpw_label'   => 'Confirmar senha',
        'cpw_ph'      => 'Repetir senha',
        'btn'         => 'Ativar minha conta',
        'login_text'  => 'Já tem uma conta?',
        'login_link'  => 'Entrar',
        'str_ph'      => 'Digite uma senha',
        'strengths'   => ['', 'Muito fraca', 'Fraca', 'Média', 'Forte', 'Muito forte'],
    ],
    'sk' => [
        'title'       => 'Aktivácia účtu : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Vážený pán', 'F' => 'Vážená pani', 'N' => 'Dobrý deň'],
        'subtitle'    => 'Nastavte si heslo na aktiváciu prístupu',
        'info_title'  => 'Váš účet AURELIS CAPITAL GROUP Invest',
        'info_body'   => 'bol vytvorený vaším poradcom. Zvoľte si bezpečné heslo na prístup do svojho osobného priestoru.',
        'email_label' => 'Emailová adresa',
        'pw_label'    => 'Nové heslo',
        'pw_ph'       => 'Minimálne 8 znakov',
        'cpw_label'   => 'Potvrdiť heslo',
        'cpw_ph'      => 'Zopakovať heslo',
        'btn'         => 'Aktivovať môj účet',
        'login_text'  => 'Už máte účet?',
        'login_link'  => 'Prihlásiť sa',
        'str_ph'      => 'Zadajte heslo',
        'strengths'   => ['', 'Veľmi slabé', 'Slabé', 'Priemerné', 'Silné', 'Veľmi silné'],
    ],
    'el' => [
        'title'       => 'Ενεργοποίηση λογαριασμού : AURELIS CAPITAL GROUP Invest',
        'greeting'    => ['M' => 'Αγαπητέ κύριε', 'F' => 'Αγαπητή κυρία', 'N' => 'Γεια σας'],
        'subtitle'    => 'Ορίστε τον κωδικό πρόσβασής σας για να ενεργοποιήσετε την πρόσβασή σας',
        'info_title'  => 'Ο λογαριασμός σας AURELIS CAPITAL GROUP Invest',
        'info_body'   => 'δημιουργήθηκε από τον σύμβουλό σας. Επιλέξτε έναν ασφαλή κωδικό πρόσβασης για να αποκτήσετε πρόσβαση στον προσωπικό σας χώρο.',
        'email_label' => 'Διεύθυνση email',
        'pw_label'    => 'Νέος κωδικός πρόσβασης',
        'pw_ph'       => 'Τουλάχιστον 8 χαρακτήρες',
        'cpw_label'   => 'Επιβεβαίωση κωδικού πρόσβασης',
        'cpw_ph'      => 'Επαναλάβετε τον κωδικό πρόσβασης',
        'btn'         => 'Ενεργοποίηση του λογαριασμού μου',
        'login_text'  => 'Έχετε ήδη λογαριασμό;',
        'login_link'  => 'Σύνδεση',
        'str_ph'      => 'Εισαγάγετε έναν κωδικό πρόσβασης',
        'strengths'   => ['', 'Πολύ αδύναμος', 'Αδύναμος', 'Μέτριος', 'Ισχυρός', 'Πολύ ισχυρός'],
    ],
];

$t              = $texts[$locale]         ?? $texts['fr'];
$greeting       = $t['greeting'][$gender] ?? $t['greeting']['N'];
$salutationName = ($gender === 'N') ? explode(' ', $user->name)[0] : $user->name;
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="theme-color" content="#040F1F">
<link rel="icon" href="{{ asset('assets/images/favicons/favicon.png') }}">
<title>{{ $t['title'] }}</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root{
  --bg:   #040F1F;
  --inp:  #0C2038;
  --cyan: #C9A227;
  --cyan2:#A3841D;
  --text: #FFFFFF;
  --sub:  rgba(255,255,255,.52);
  --muted:rgba(255,255,255,.28);
  --bdr:  rgba(255,255,255,.09);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html,body{
  min-height:100vh;background:var(--bg);color:var(--text);
  font-family:'Inter',system-ui,sans-serif;font-size:15px;
  -webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;
}
body{
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  padding:1.5rem 1.25rem;
  padding-top:calc(1.5rem + env(safe-area-inset-top,0px));
  padding-bottom:calc(1.5rem + env(safe-area-inset-bottom,0px));
  overflow-x:hidden;
}
a{text-decoration:none;color:inherit}

/* Background orbs */
.bg-orbs{position:fixed;inset:0;pointer-events:none;z-index:0;overflow:hidden}
.orb{position:absolute;border-radius:50%;filter:blur(90px)}
.orb-1{
  width:520px;height:520px;top:-15%;right:-10%;
  background:radial-gradient(circle,rgba(201,162,39,.11) 0%,transparent 65%);
  animation:orbf 10s ease-in-out infinite alternate;
}
.orb-2{
  width:380px;height:380px;bottom:-15%;left:-8%;
  background:radial-gradient(circle,rgba(201,162,39,.06) 0%,transparent 65%);
  animation:orbf 14s ease-in-out infinite alternate-reverse;
}
@keyframes orbf{from{transform:scale(1)}to{transform:scale(1.1) translate(2%,3%)}}

/* Card */
.card{
  position:relative;z-index:1;
  width:100%;max-width:420px;
  animation:fadeUp .45s ease .05s both;
}

/* Logo box */
.logo-box{
  width:92px;height:92px;border-radius:26px;
  background:linear-gradient(135deg,var(--cyan),var(--cyan2));
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 1.375rem;
  box-shadow:0 0 36px rgba(201,162,39,.3);
}
.logo-box img{height:56px;object-fit:contain}
.logo-box span{font-family:'Playfair Display',serif;font-size:2.4rem;font-weight:800;color:#040F1F;line-height:1}

/* Avatar */
.avatar{
  width:60px;height:60px;border-radius:50%;
  background:linear-gradient(135deg,var(--cyan),var(--cyan2));
  display:flex;align-items:center;justify-content:center;
  font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:800;
  color:#040F1F;margin:0 auto 1rem;
  box-shadow:0 0 24px rgba(201,162,39,.3);
}

/* Heading */
.card-head{text-align:center;margin-bottom:1.75rem}
.card-title{
  font-family:'Playfair Display',serif;
  font-size:1.5rem;font-weight:800;color:var(--text);margin-bottom:.35rem;
}
.card-sub{font-size:.8rem;color:var(--sub);line-height:1.6}

/* Info box */
.info-box{
  display:flex;gap:.75rem;align-items:flex-start;
  background:rgba(201,162,39,.07);
  border:1px solid rgba(201,162,39,.18);
  border-radius:12px;padding:.875rem 1rem;margin-bottom:1.5rem;
}
.info-box i{color:var(--cyan);font-size:.88rem;flex-shrink:0;margin-top:.15rem}
.info-box p{font-size:.77rem;color:rgba(255,255,255,.65);line-height:1.6}
.info-box strong{color:var(--cyan);font-weight:600}

/* Error */
.ferr{
  display:flex;align-items:flex-start;gap:.55rem;
  background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);
  border-left:3px solid #ef4444;border-radius:10px;
  padding:.7rem .9rem;font-size:.79rem;color:#FCA5A5;margin-bottom:1.125rem;
}
.ferr i{margin-top:.1rem;flex-shrink:0}

/* Field */
.fgrp{margin-bottom:.875rem}
.flabel{display:block;font-size:.75rem;font-weight:600;color:rgba(255,255,255,.5);margin-bottom:.4rem}
.frel{position:relative}
.ficon{
  position:absolute;left:.95rem;top:50%;transform:translateY(-50%);
  color:rgba(255,255,255,.3);font-size:.75rem;pointer-events:none;transition:color .18s;
}
.finput{
  width:100%;padding:.85rem 2.6rem .85rem 2.6rem;
  background:var(--inp);border:1.5px solid rgba(255,255,255,.08);border-radius:12px;
  font-size:.875rem;font-family:'Inter',sans-serif;color:var(--text);
  outline:none;transition:border-color .2s,box-shadow .2s,background .2s;
}
.finput::placeholder{color:rgba(255,255,255,.2)}
.finput:focus{border-color:var(--cyan);background:#161E30;box-shadow:0 0 0 3.5px rgba(201,162,39,.15)}
.finput:focus ~ .ficon,.frel:focus-within .ficon{color:var(--cyan)}
.finput.err{border-color:#ef4444}
.finput[readonly]{
  color:rgba(255,255,255,.4);cursor:not-allowed;
  background:rgba(255,255,255,.03);border-color:rgba(255,255,255,.05);
}
.feye{
  position:absolute;right:.9rem;top:50%;transform:translateY(-50%);
  background:none;border:none;color:rgba(255,255,255,.28);cursor:pointer;
  font-size:.78rem;padding:.3rem;display:flex;align-items:center;transition:color .18s;
}
.feye:hover{color:rgba(255,255,255,.7)}

/* Password strength */
.strength-bar{height:3px;border-radius:2px;background:rgba(255,255,255,.08);margin-top:.5rem;overflow:hidden}
.strength-fill{height:100%;border-radius:2px;transition:width .3s,background .3s;width:0}
.strength-txt{font-size:.68rem;color:var(--muted);margin-top:.3rem;min-height:1em;transition:color .2s}

/* Cyan pill button */
.fbtn{
  width:100%;padding:.92rem 1.5rem;border:none;border-radius:999px;
  font-size:.97rem;font-weight:700;font-family:'Inter',sans-serif;
  cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.625rem;
  background:linear-gradient(90deg,var(--cyan) 0%,var(--cyan2) 100%);
  color:#040F1F;letter-spacing:.01em;
  box-shadow:0 6px 28px rgba(201,162,39,.35),0 2px 8px rgba(0,0,0,.3);
  transition:filter .2s,box-shadow .2s,transform .1s;margin-top:1.25rem;
}
.fbtn:hover{filter:brightness(1.08);box-shadow:0 8px 36px rgba(201,162,39,.5)}
.fbtn:active{transform:scale(.975)}
.fbtn:disabled{opacity:.6;cursor:not-allowed;filter:none}

/* Footer link */
.foot{text-align:center;font-size:.76rem;color:var(--muted);margin-top:1.25rem}
.foot a{color:var(--cyan);font-weight:600;transition:opacity .18s}
.foot a:hover{opacity:.75}

/* Copyright */
.copy{
  position:relative;z-index:1;text-align:center;
  font-size:.65rem;color:rgba(255,255,255,.2);margin-top:1.5rem;
}

@keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
@keyframes spin{to{transform:rotate(360deg)}}
</style>
</head>
<body>

<div class="bg-orbs" aria-hidden="true">
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
</div>

<div class="card">

  {{-- Logo --}}
  <div class="logo-box">
    <img src="{{ asset('assets/images/logo-white-icon.png') }}"
         onerror="this.style.display='none';this.nextElementSibling.style.display='block'"
         alt="AURELIS CAPITAL GROUP">
    <span style="display:none">SG</span>
  </div>

  {{-- Avatar + Heading --}}
  <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>

  <div class="card-head">
    <h1 class="card-title">{{ $greeting }}, {{ $salutationName }} !</h1>
    <p class="card-sub">{{ $t['subtitle'] }}</p>
  </div>

  {{-- Info box --}}
  <div class="info-box">
    <i class="fas fa-envelope-open-text"></i>
    <p><strong>{{ $t['info_title'] }}</strong> {{ $t['info_body'] }}</p>
  </div>

  {{-- Errors --}}
  @if($errors->any())
  <div class="ferr">
    <i class="fas fa-circle-exclamation"></i>
    <span>{{ $errors->first() }}</span>
  </div>
  @endif

  {{-- Form --}}
  <form method="POST" action="{{ route('invitation.activate', $token) }}"
        onsubmit="this.querySelector('button[type=submit]').disabled=true">
    @csrf

    {{-- Email (readonly) --}}
    <div class="fgrp">
      <label class="flabel">{{ $t['email_label'] }}</label>
      <div class="frel">
        <i class="fas fa-envelope ficon"></i>
        <input type="email" class="finput" value="{{ $user->email }}" readonly>
        <span class="feye" style="cursor:default"><i class="fas fa-lock"></i></span>
      </div>
    </div>

    {{-- Password --}}
    <div class="fgrp">
      <label class="flabel" for="password">{{ $t['pw_label'] }}</label>
      <div class="frel">
        <i class="fas fa-lock ficon"></i>
        <input type="password" id="password" name="password" required
               class="finput {{ $errors->has('password') ? 'err' : '' }}"
               placeholder="{{ $t['pw_ph'] }}"
               autocomplete="new-password"
               oninput="checkStrength(this.value)">
        <button type="button" class="feye" onclick="tglPwd('password',this)">
          <i class="fas fa-eye"></i>
        </button>
      </div>
      <div class="strength-bar"><div class="strength-fill" id="sFill"></div></div>
      <div class="strength-txt" id="sTxt">{{ $t['str_ph'] }}</div>
    </div>

    {{-- Confirm password --}}
    <div class="fgrp">
      <label class="flabel" for="password_confirmation">{{ $t['cpw_label'] }}</label>
      <div class="frel">
        <i class="fas fa-lock ficon"></i>
        <input type="password" id="password_confirmation" name="password_confirmation"
               required class="finput"
               placeholder="{{ $t['cpw_ph'] }}"
               autocomplete="new-password">
        <button type="button" class="feye" onclick="tglPwd('password_confirmation',this)">
          <i class="fas fa-eye"></i>
        </button>
      </div>
    </div>

    <button type="submit" class="fbtn">
      <i class="fas fa-unlock-alt"></i>
      {{ $t['btn'] }}
    </button>
  </form>

  <div class="foot">
    {{ $t['login_text'] }}
    <a href="{{ $user->type === 'staff' ? route('staff.login') : route('login') }}">
      {{ $t['login_link'] }}
    </a>
  </div>

</div>

<div class="copy">&copy; {{ date('Y') }}AURELIS CAPITAL GROUP Invest</div>

<script>
const strengths = @json($t['strengths']);
const strPh     = @json($t['str_ph']);
const colors    = ['','#ef4444','#f97316','#eab308','#22c55e','#C9A227'];
const widths    = ['0%','25%','50%','75%','90%','100%'];

function tglPwd(id, btn) {
  var el   = document.getElementById(id);
  var icon = btn.querySelector('i');
  if (el.type === 'password') { el.type='text';     icon.className='fas fa-eye-slash'; }
  else                        { el.type='password'; icon.className='fas fa-eye'; }
}

function checkStrength(pw) {
  var fill = document.getElementById('sFill');
  var txt  = document.getElementById('sTxt');
  if (!pw) { fill.style.width='0%'; txt.textContent=strPh; txt.style.color='rgba(255,255,255,.28)'; return; }
  var s = 0;
  if (pw.length >= 8)          s++;
  if (pw.length >= 12)         s++;
  if (/[A-Z]/.test(pw))        s++;
  if (/[0-9]/.test(pw))        s++;
  if (/[^A-Za-z0-9]/.test(pw)) s++;
  s = Math.min(s, 5);
  fill.style.width      = widths[s];
  fill.style.background = colors[s] || 'transparent';
  txt.textContent       = strengths[s] || strPh;
  txt.style.color       = s > 0 ? colors[s] : 'rgba(255,255,255,.28)';
}
</script>
</body>
</html>
