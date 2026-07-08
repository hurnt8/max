@php
$gender = $loan->client?->gender ?? 'N';

$greetings = [
    'fr' => [
        'M' => 'Monsieur '.$loan->name.',',
        'F' => 'Madame '.$loan->name.',',
        'N' => 'Madame, Monsieur '.$loan->name.',',
    ],
    'en' => [
        'M' => 'Dear Mr. '.$loan->name.',',
        'F' => 'Dear Ms. '.$loan->name.',',
        'N' => 'Dear '.$loan->name.',',
    ],
    'es' => [
        'M' => 'Estimado Sr. '.$loan->name.',',
        'F' => 'Estimada Sra. '.$loan->name.',',
        'N' => 'Estimado/a '.$loan->name.',',
    ],
    'pl' => [
        'M' => 'Szanowny Panie '.$loan->name.',',
        'F' => 'Szanowna Pani '.$loan->name.',',
        'N' => 'Szanowny/a Panie/Pani '.$loan->name.',',
    ],
    'bg' => [
        'M' => 'Уважаеми г-н '.$loan->name.',',
        'F' => 'Уважаема г-жо '.$loan->name.',',
        'N' => 'Уважаеми/а '.$loan->name.',',
    ],
    'hu' => [
        'M' => 'Tisztelt '.$loan->name.'!',
        'F' => 'Tisztelt '.$loan->name.'!',
        'N' => 'Kedves '.$loan->name.'!',
    ],
    'it' => [
        'M' => 'Egregio Sig. '.$loan->name.',',
        'F' => 'Gentile Sig.ra '.$loan->name.',',
        'N' => 'Gentile '.$loan->name.',',
    ],
    'de' => [
        'M' => 'Sehr geehrter Herr '.$loan->name.',',
        'F' => 'Sehr geehrte Frau '.$loan->name.',',
        'N' => 'Sehr geehrte Damen und Herren '.$loan->name.',',
    ],
    'lt' => [
        'M' => 'Gerbiamas Pone '.$loan->name.',',
        'F' => 'Gerbiama Ponia '.$loan->name.',',
        'N' => 'Gerbiamas (-a) '.$loan->name.',',
    ],
    'ro' => [
        'M' => 'Stimate Domnule '.$loan->name.',',
        'F' => 'Stimată Doamnă '.$loan->name.',',
        'N' => 'Stimate/Stimată '.$loan->name.',',
    ],
    'lv' => [
        'M' => 'Godātais Kungs '.$loan->name.',',
        'F' => 'Godātā Kundze '.$loan->name.',',
        'N' => 'Godātais/Godātā '.$loan->name.',',
    ],
];

$intros = [
    'fr' => [
        'M' => 'Nous avons le plaisir de vous informer que votre demande de financement a été <strong>validée</strong> par SOLBERG GRUPO.',
        'F' => 'Nous avons le plaisir de vous informer que votre demande de financement a été <strong>validée</strong> par SOLBERG GRUPO.',
        'N' => 'Nous avons le plaisir de vous informer que votre demande de financement a été <strong>validée</strong> par SOLBERG GRUPO.',
    ],
    'en' => [
        'M' => 'We are pleased to inform you that your financing application has been <strong>approved</strong> by SOLBERG GRUPO.',
        'F' => 'We are pleased to inform you that your financing application has been <strong>approved</strong> by SOLBERG GRUPO.',
        'N' => 'We are pleased to inform you that your financing application has been <strong>approved</strong> by SOLBERG GRUPO.',
    ],
    'es' => [
        'M' => 'Nos complace informarle que su solicitud de financiación ha sido <strong>validada</strong> por SOLBERG GRUPO.',
        'F' => 'Nos complace informarla que su solicitud de financiación ha sido <strong>validada</strong> por SOLBERG GRUPO.',
        'N' => 'Nos complace informarle/la que su solicitud de financiación ha sido <strong>validada</strong> por SOLBERG GRUPO.',
    ],
    'pl' => [
        'M' => 'Z przyjemnością informujemy, że Pana wniosek o finansowanie został <strong>zatwierdzony</strong> przez SOLBERG GRUPO.',
        'F' => 'Z przyjemnością informujemy, że Pani wniosek o finansowanie został <strong>zatwierdzony</strong> przez SOLBERG GRUPO.',
        'N' => 'Z przyjemnością informujemy, że Państwa wniosek o finansowanie został <strong>zatwierdzony</strong> przez SOLBERG GRUPO.',
    ],
    'bg' => [
        'M' => 'С удоволствие ви информираме, че вашата заявка за финансиране беше <strong>одобрена</strong> от SOLBERG GRUPO.',
        'F' => 'С удоволствие ви информираме, че вашата заявка за финансиране беше <strong>одобрена</strong> от SOLBERG GRUPO.',
        'N' => 'С удоволствие ви информираме, че вашата заявка за финансиране беше <strong>одобрена</strong> от SOLBERG GRUPO.',
    ],
    'hu' => [
        'M' => 'Örömmel tájékoztatjuk, hogy finanszírozási kérelmét a SOLBERG GRUPO <strong>jóváhagyta</strong>.',
        'F' => 'Örömmel tájékoztatjuk, hogy finanszírozási kérelmét a SOLBERG GRUPO <strong>jóváhagyta</strong>.',
        'N' => 'Örömmel tájékoztatjuk, hogy finanszírozási kérelmét a SOLBERG GRUPO <strong>jóváhagyta</strong>.',
    ],
    'it' => [
        'M' => 'Siamo lieti di informarti che la tua richiesta di finanziamento è stata <strong>convalidata</strong> da SOLBERG GRUPO.',
        'F' => 'Siamo lieti di informarti che la tua richiesta di finanziamento è stata <strong>convalidata</strong> da SOLBERG GRUPO.',
        'N' => 'Siamo lieti di informarti che la tua richiesta di finanziamento è stata <strong>convalidata</strong> da SOLBERG GRUPO.',
    ],
    'de' => [
        'M' => 'Wir freuen uns, Ihnen mitteilen zu können, dass Ihr Finanzierungsantrag von SOLBERG GRUPO <strong>genehmigt</strong> wurde.',
        'F' => 'Wir freuen uns, Ihnen mitteilen zu können, dass Ihr Finanzierungsantrag von SOLBERG GRUPO <strong>genehmigt</strong> wurde.',
        'N' => 'Wir freuen uns, Ihnen mitteilen zu können, dass Ihr Finanzierungsantrag von SOLBERG GRUPO <strong>genehmigt</strong> wurde.',
    ],
    'lt' => [
        'M' => 'Su malonumu pranešame, kad jūsų finansavimo paraišką SOLBERG GRUPO <strong>patvirtino</strong>.',
        'F' => 'Su malonumu pranešame, kad jūsų finansavimo paraišką SOLBERG GRUPO <strong>patvirtino</strong>.',
        'N' => 'Su malonumu pranešame, kad jūsų finansavimo paraišką SOLBERG GRUPO <strong>patvirtino</strong>.',
    ],
    'ro' => [
        'M' => 'Avem plăcerea să vă informăm că cererea dumneavoastră de finanțare a fost <strong>validată</strong> de SOLBERG GRUPO.',
        'F' => 'Avem plăcerea să vă informăm că cererea dumneavoastră de finanțare a fost <strong>validată</strong> de SOLBERG GRUPO.',
        'N' => 'Avem plăcerea să vă informăm că cererea dumneavoastră de finanțare a fost <strong>validată</strong> de SOLBERG GRUPO.',
    ],
    'lv' => [
        'M' => 'Mums ir prieks jums paziņot, ka jūsu finansējuma pieteikumu SOLBERG GRUPO ir <strong>apstiprinājusi</strong>.',
        'F' => 'Mums ir prieks jums paziņot, ka jūsu finansējuma pieteikumu SOLBERG GRUPO ir <strong>apstiprinājusi</strong>.',
        'N' => 'Mums ir prieks jums paziņot, ka jūsu finansējuma pieteikumu SOLBERG GRUPO ir <strong>apstiprinājusi</strong>.',
    ],
];

$texts = [
    'fr' => [
        'title'         => 'Demande N°'.$loan->reference.' validée',
        'sub'           => 'Financement accordé',
        'greeting'      => $greetings['fr'][$gender],
        'intro'         => $intros['fr'][$gender],
        'summary'       => 'RÉSUMÉ DU FINANCEMENT',
        'lbl_ref'       => 'Référence dossier',
        'lbl_amount'    => 'Montant accordé',
        'lbl_duration'  => 'Durée',
        'lbl_months'    => 'mois',
        'lbl_monthly'   => 'Mensualité',
        'lbl_rate'      => 'Taux d\'intérêt',
        'lbl_fees'      => 'Frais administratifs',
        'action_title'  => 'ACTION REQUISE',
        'attachments'   => 'Vous trouverez en pièces jointes de ce message :',
        'attach_contract' => 'Votre contrat de financement (PDF)',
        'attach_table'    => 'Le tableau d\'amortissement (PDF)',
        'action_body'   => 'Veuillez <strong>signer le contrat</strong> et le retourner par email à :',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'en précisant en objet : <strong>Contrat signé — N°'.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'Les coordonnées du compte de règlement et les modalités de versement vous seront communiquées par notre équipe suite à la réception de votre contrat signé.',
        'closing'       => 'Cordialement,',
        'team'          => 'L\'équipe Solberg Grupo',
    ],
    'en' => [
        'title'         => 'Application N°'.$loan->reference.' approved',
        'sub'           => 'Financing granted',
        'greeting'      => $greetings['en'][$gender],
        'intro'         => $intros['en'][$gender],
        'summary'       => 'FINANCING SUMMARY',
        'lbl_ref'       => 'File reference',
        'lbl_amount'    => 'Amount granted',
        'lbl_duration'  => 'Duration',
        'lbl_months'    => 'months',
        'lbl_monthly'   => 'Monthly payment',
        'lbl_rate'      => 'Interest rate',
        'lbl_fees'      => 'Administrative fees',
        'action_title'  => 'ACTION REQUIRED',
        'attachments'   => 'Please find enclosed in this email:',
        'attach_contract' => 'Your financing contract (PDF)',
        'attach_table'    => 'The amortization schedule (PDF)',
        'action_body'   => 'Please <strong>sign the contract</strong> and return it by email to:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'using the following subject: <strong>Signed contract — N°'.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'Payment account details and disbursement terms will be communicated by our team upon receipt of your signed contract.',
        'closing'       => 'Yours sincerely,',
        'team'          => 'The Solberg Grupo team',
    ],
    'es' => [
        'title'         => 'Solicitud N°'.$loan->reference.' validada',
        'sub'           => 'Financiación concedida',
        'greeting'      => $greetings['es'][$gender],
        'intro'         => $intros['es'][$gender],
        'summary'       => 'RESUMEN DEL FINANCIAMIENTO',
        'lbl_ref'       => 'Referencia del expediente',
        'lbl_amount'    => 'Importe concedido',
        'lbl_duration'  => 'Duración',
        'lbl_months'    => 'meses',
        'lbl_monthly'   => 'Cuota mensual',
        'lbl_rate'      => 'Tipo de interés',
        'lbl_fees'      => 'Gastos administrativos',
        'action_title'  => 'ACCIÓN REQUERIDA',
        'attachments'   => 'Encontrará adjuntos en este mensaje:',
        'attach_contract' => 'Su contrato de financiación (PDF)',
        'attach_table'    => 'El cuadro de amortización (PDF)',
        'action_body'   => 'Por favor, <strong>firme el contrato</strong> y devuélvalo por correo electrónico a:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'indicando en el asunto: <strong>Contrato firmado — N°'.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'Los datos de la cuenta de pago y las modalidades de desembolso le serán comunicados por nuestro equipo tras la recepción de su contrato firmado.',
        'closing'       => 'Atentamente,',
        'team'          => 'El equipo Solberg Grupo',
    ],
    'pl' => [
        'title'         => 'Wniosek nr '.$loan->reference.' zatwierdzony',
        'sub'           => 'Finansowanie przyznane',
        'greeting'      => $greetings['pl'][$gender],
        'intro'         => $intros['pl'][$gender],
        'summary'       => 'PODSUMOWANIE FINANSOWANIA',
        'lbl_ref'       => 'Numer referencyjny',
        'lbl_amount'    => 'Przyznana kwota',
        'lbl_duration'  => 'Okres',
        'lbl_months'    => 'miesięcy',
        'lbl_monthly'   => 'Miesięczna rata',
        'lbl_rate'      => 'Stopa procentowa',
        'lbl_fees'      => 'Opłaty administracyjne',
        'action_title'  => 'WYMAGANE DZIALANIE',
        'attachments'   => 'W załaczeniu do tej wiadomosci znajda Panstwo:',
        'attach_contract' => 'Umowe finansowania (PDF)',
        'attach_table'    => 'Harmonogram splat (PDF)',
        'action_body'   => 'Prosimy o <strong>podpisanie umowy</strong> i odesl anie jej na adres e-mail:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'podajac w temacie: <strong>Podpisana umowa — nr '.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'Dane rachunku bankowego oraz warunki wyplaty zostana przekazane przez nasz zespol po otrzymaniu podpisanej umowy.',
        'closing'       => 'Z powazaniem,',
        'team'          => 'Zespol Solberg Grupo',
    ],
    'bg' => [
        'title'         => 'Заявка №'.$loan->reference.' одобрена',
        'sub'           => 'Отпуснато финансиране',
        'greeting'      => $greetings['bg'][$gender],
        'intro'         => $intros['bg'][$gender],
        'summary'       => 'ОБОБЩЕНИЕ НА ФИНАНСИРАНЕТО',
        'lbl_ref'       => 'Референция на досието',
        'lbl_amount'    => 'Отпусната сума',
        'lbl_duration'  => 'Срок',
        'lbl_months'    => 'месеца',
        'lbl_monthly'   => 'Месечна вноска',
        'lbl_rate'      => 'Лихвен процент',
        'lbl_fees'      => 'Административни такси',
        'action_title'  => 'НЕОБХОДИМО ДЕЙСТВИЕ',
        'attachments'   => 'Ще намерите приложени към това съобщение:',
        'attach_contract' => 'Вашия договор за финансиране (PDF)',
        'attach_table'    => 'Погасителния план (PDF)',
        'action_body'   => 'Моля, <strong>подпишете договора</strong> и го изпратете обратно по имейл на:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'като посочите в темата: <strong>Подписан договор — №'.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'Данните на разплащателната сметка и условията за превода ще ви бъдат съобщени от нашия екип след получаване на подписания договор.',
        'closing'       => 'С уважение,',
        'team'          => 'Екипът на Solberg Grupo',
    ],
    'hu' => [
        'title'         => 'A(z) '.$loan->reference.' sz. kérelem jóváhagyva',
        'sub'           => 'Finanszírozás jóváhagyva',
        'greeting'      => $greetings['hu'][$gender],
        'intro'         => $intros['hu'][$gender],
        'summary'       => 'FINANSZÍROZÁS ÖSSZEFOGLALÓJA',
        'lbl_ref'       => 'Ügy referenciaszáma',
        'lbl_amount'    => 'Jóváhagyott összeg',
        'lbl_duration'  => 'Futamidő',
        'lbl_months'    => 'hónap',
        'lbl_monthly'   => 'Havi törlesztőrészlet',
        'lbl_rate'      => 'Kamatláb',
        'lbl_fees'      => 'Adminisztrációs díjak',
        'action_title'  => 'SZÜKSÉGES TEENDŐ',
        'attachments'   => 'Ehhez az üzenethez csatolva megtalálja:',
        'attach_contract' => 'Finanszírozási szerződését (PDF)',
        'attach_table'    => 'A törlesztési ütemtervet (PDF)',
        'action_body'   => 'Kérjük, <strong>írja alá a szerződést</strong>, és küldje vissza e-mailben az alábbi címre:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'a következő tárggyal: <strong>Aláírt szerződés — sz. '.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'A fizetési számla adatait és a folyósítás feltételeit csapatunk közli Önnel az aláírt szerződés beérkezése után.',
        'closing'       => 'Tisztelettel,',
        'team'          => 'A Solberg Grupo csapata',
    ],
    'it' => [
        'title'         => 'Richiesta N°'.$loan->reference.' convalidata',
        'sub'           => 'Finanziamento concesso',
        'greeting'      => $greetings['it'][$gender],
        'intro'         => $intros['it'][$gender],
        'summary'       => 'RIEPILOGO DEL FINANZIAMENTO',
        'lbl_ref'       => 'Riferimento pratica',
        'lbl_amount'    => 'Importo concesso',
        'lbl_duration'  => 'Durata',
        'lbl_months'    => 'mesi',
        'lbl_monthly'   => 'Rata mensile',
        'lbl_rate'      => 'Tasso d\'interesse',
        'lbl_fees'      => 'Spese amministrative',
        'action_title'  => 'AZIONE RICHIESTA',
        'attachments'   => 'Troverai allegati a questo messaggio:',
        'attach_contract' => 'Il tuo contratto di finanziamento (PDF)',
        'attach_table'    => 'Il piano di ammortamento (PDF)',
        'action_body'   => 'Ti preghiamo di <strong>firmare il contratto</strong> e restituirlo via email a:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'indicando come oggetto: <strong>Contratto firmato — N°'.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'I dati del conto di regolamento e le modalità di erogazione ti saranno comunicati dal nostro team dopo la ricezione del tuo contratto firmato.',
        'closing'       => 'Cordiali saluti,',
        'team'          => 'Il team Solberg Grupo',
    ],
    'de' => [
        'title'         => 'Antrag Nr. '.$loan->reference.' genehmigt',
        'sub'           => 'Finanzierung gewährt',
        'greeting'      => $greetings['de'][$gender],
        'intro'         => $intros['de'][$gender],
        'summary'       => 'ZUSAMMENFASSUNG DER FINANZIERUNG',
        'lbl_ref'       => 'Aktenreferenz',
        'lbl_amount'    => 'Genehmigter Betrag',
        'lbl_duration'  => 'Laufzeit',
        'lbl_months'    => 'Monate',
        'lbl_monthly'   => 'Monatliche Rate',
        'lbl_rate'      => 'Zinssatz',
        'lbl_fees'      => 'Verwaltungsgebühren',
        'action_title'  => 'ERFORDERLICHE MASSNAHME',
        'attachments'   => 'Diesem Schreiben liegen bei:',
        'attach_contract' => 'Ihr Finanzierungsvertrag (PDF)',
        'attach_table'    => 'Der Tilgungsplan (PDF)',
        'action_body'   => 'Bitte <strong>unterschreiben Sie den Vertrag</strong> und senden Sie ihn per E-Mail zurück an:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'mit dem Betreff: <strong>Unterschriebener Vertrag — Nr. '.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'Die Angaben zum Auszahlungskonto und die Modalitäten der Auszahlung werden Ihnen von unserem Team nach Eingang Ihres unterschriebenen Vertrags mitgeteilt.',
        'closing'       => 'Mit freundlichen Grüßen,',
        'team'          => 'Das Solberg-Grupo-Team',
    ],
    'lt' => [
        'title'         => 'Paraiška Nr. '.$loan->reference.' patvirtinta',
        'sub'           => 'Finansavimas suteiktas',
        'greeting'      => $greetings['lt'][$gender],
        'intro'         => $intros['lt'][$gender],
        'summary'       => 'FINANSAVIMO SANTRAUKA',
        'lbl_ref'       => 'Bylos numeris',
        'lbl_amount'    => 'Patvirtinta suma',
        'lbl_duration'  => 'Trukmė',
        'lbl_months'    => 'mėn.',
        'lbl_monthly'   => 'Mėnesinė įmoka',
        'lbl_rate'      => 'Palūkanų norma',
        'lbl_fees'      => 'Administraciniai mokesčiai',
        'action_title'  => 'REIKALINGAS VEIKSMAS',
        'attachments'   => 'Prie šio laiško rasite pridėtus:',
        'attach_contract' => 'Jūsų finansavimo sutartį (PDF)',
        'attach_table'    => 'Mokėjimų grafiką (PDF)',
        'action_body'   => 'Prašome <strong>pasirašyti sutartį</strong> ir grąžinti ją el. paštu adresu:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'nurodydami temą: <strong>Pasirašyta sutartis — Nr. '.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'Atsiskaitomosios sąskaitos duomenis ir lėšų išmokėjimo tvarką jums praneš mūsų komanda, gavusi jūsų pasirašytą sutartį.',
        'closing'       => 'Pagarbiai,',
        'team'          => 'Solberg Grupo komanda',
    ],
    'ro' => [
        'title'         => 'Cererea nr. '.$loan->reference.' aprobată',
        'sub'           => 'Finanțare acordată',
        'greeting'      => $greetings['ro'][$gender],
        'intro'         => $intros['ro'][$gender],
        'summary'       => 'REZUMATUL FINANȚĂRII',
        'lbl_ref'       => 'Referință dosar',
        'lbl_amount'    => 'Sumă acordată',
        'lbl_duration'  => 'Durată',
        'lbl_months'    => 'luni',
        'lbl_monthly'   => 'Rată lunară',
        'lbl_rate'      => 'Rată a dobânzii',
        'lbl_fees'      => 'Taxe administrative',
        'action_title'  => 'ACȚIUNE NECESARĂ',
        'attachments'   => 'Veți găsi atașate acestui mesaj:',
        'attach_contract' => 'Contractul dumneavoastră de finanțare (PDF)',
        'attach_table'    => 'Graficul de rambursare (PDF)',
        'action_body'   => 'Vă rugăm să <strong>semnați contractul</strong> și să îl trimiteți înapoi prin e-mail la:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'precizând la subiect: <strong>Contract semnat — nr. '.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'Datele contului de plată și modalitățile de virare vă vor fi comunicate de echipa noastră după primirea contractului dumneavoastră semnat.',
        'closing'       => 'Cu stimă,',
        'team'          => 'Echipa Solberg Grupo',
    ],
    'lv' => [
        'title'         => 'Pieteikums Nr. '.$loan->reference.' apstiprināts',
        'sub'           => 'Finansējums piešķirts',
        'greeting'      => $greetings['lv'][$gender],
        'intro'         => $intros['lv'][$gender],
        'summary'       => 'FINANSĒJUMA KOPSAVILKUMS',
        'lbl_ref'       => 'Lietas atsauce',
        'lbl_amount'    => 'Piešķirtā summa',
        'lbl_duration'  => 'Termiņš',
        'lbl_months'    => 'mēneši',
        'lbl_monthly'   => 'Ikmēneša maksājums',
        'lbl_rate'      => 'Procentu likme',
        'lbl_fees'      => 'Administratīvās izmaksas',
        'action_title'  => 'NEPIECIEŠAMA RĪCĪBA',
        'attachments'   => 'Šim ziņojumam ir pievienoti:',
        'attach_contract' => 'Jūsu finansējuma līgums (PDF)',
        'attach_table'    => 'Atmaksas grafiks (PDF)',
        'action_body'   => 'Lūdzu, <strong>parakstiet līgumu</strong> un nosūtiet to atpakaļ pa e-pastu uz:',
        'action_email'  => 'serviceloan@credixa.eu',
        'action_subject'=> 'norādot tēmā: <strong>Parakstīts līgums — Nr. '.$loan->reference.' — '.$loan->name.'</strong>',
        'note'          => 'Norēķinu konta datus un izmaksas kārtību jums paziņos mūsu komanda pēc jūsu parakstītā līguma saņemšanas.',
        'closing'       => 'Ar cieņu,',
        'team'          => 'Solberg Grupo komanda',
    ],
];
$t = $texts[$locale] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="green"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{!! $t['intro'] !!}</p>

  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_ref'] }}</span>
      <span class="panel-val">{{ $loan->reference }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_amount'] }}</span>
      <span class="panel-val accent">{{ number_format($loan->amount, 2, ',', ' ') }} {{ $loan->currency }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_duration'] }}</span>
      <span class="panel-val">{{ $loan->darly }} {{ $t['lbl_months'] }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_monthly'] }}</span>
      <span class="panel-val">{{ number_format($loan->monthly_payment, 2, ',', ' ') }} {{ $loan->currency }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_rate'] }}</span>
      <span class="panel-val">{{ $loan->interest_rate }} %</span>
    </div>
    @if($loan->admin_fees)
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_fees'] }}</span>
      <span class="panel-val">{{ number_format($loan->admin_fees, 2, ',', ' ') }} {{ $loan->currency }}</span>
    </div>
    @endif
  </div>

  <div class="alert alert-info">
    <strong>{{ $t['action_title'] }}</strong>
    <p style="margin-top:.5rem">{!! $t['attachments'] !!}</p>
    <ul style="margin:.375rem 0 .75rem 1.25rem;padding:0">
      <li>{!! $t['attach_contract'] !!}</li>
      <li>{!! $t['attach_table'] !!}</li>
    </ul>
    <p>{!! $t['action_body'] !!}</p>
    <p style="margin:.25rem 0;font-size:1rem"><strong>{{ $t['action_email'] }}</strong></p>
    <p style="margin-top:.375rem;font-size:.875rem">{!! $t['action_subject'] !!}</p>
  </div>

  <p class="body-text">{{ $t['note'] }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
