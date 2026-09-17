@php
$texts = [
    'fr' => [
        'title'    => 'Demande N°'.$loan->reference.' approuvée',
        'sub'      => 'Bonne nouvelle !',
        'greeting' => 'Madame / Monsieur '.$loan->name.',',
        'intro'    => 'Nous avons le plaisir de vous informer que votre demande d\'aide a été <strong>approuvée</strong> par notre équipe.',
        'next'     => 'Prochaine étape',
        'next_body'=> 'Notre équipe prépare votre accord de soutien. Vous le recevrez très prochainement par email avec les instructions pour la signature.',
        'summary'  => 'RÉCAPITULATIF',
        'lbl_ref'  => 'Référence dossier',
        'lbl_amt'  => 'Montant accordé',
        'lbl_dur'  => 'Durée',
        'lbl_mo'   => 'mois',
        'lbl_pay'  => 'Versement mensuel estimé',
        'lbl_rate' => 'Taux de gestion annuel',
        'closing'  => 'Cordialement,',
        'team'     => 'L\'équipe ' . site_name(),
    ],
    'en' => [
        'title'    => 'Request No. '.$loan->reference.' approved',
        'sub'      => 'Great news!',
        'greeting' => 'Dear '.$loan->name.',',
        'intro'    => 'We are pleased to inform you that your request for assistance has been <strong>approved</strong> by our team.',
        'next'     => 'Next step',
        'next_body'=> 'Our team is preparing your support agreement. You will receive it shortly by email with instructions for signing.',
        'summary'  => 'SUMMARY',
        'lbl_ref'  => 'File reference',
        'lbl_amt'  => 'Amount granted',
        'lbl_dur'  => 'Duration',
        'lbl_mo'   => 'months',
        'lbl_pay'  => 'Estimated monthly payment',
        'lbl_rate' => 'Annual management fee rate',
        'closing'  => 'Yours sincerely,',
        'team'     => 'The ' . site_name() . ' team',
    ],
    'es' => [
        'title'    => 'Solicitud N°'.$loan->reference.' aprobada',
        'sub'      => '¡Buenas noticias!',
        'greeting' => 'Estimado/a '.$loan->name.',',
        'intro'    => 'Nos complace informarle que su solicitud de ayuda ha sido <strong>aprobada</strong> por nuestro equipo.',
        'next'     => 'Próximo paso',
        'next_body'=> 'Nuestro equipo está preparando su acuerdo de apoyo. Lo recibirá en breve por correo electrónico con las instrucciones para la firma.',
        'summary'  => 'RESUMEN',
        'lbl_ref'  => 'Referencia',
        'lbl_amt'  => 'Importe concedido',
        'lbl_dur'  => 'Duración',
        'lbl_mo'   => 'meses',
        'lbl_pay'  => 'Cuota mensual estimada',
        'lbl_rate' => 'Tasa de gestión anual',
        'closing'  => 'Atentamente,',
        'team'     => 'El equipo ' . site_name(),
    ],
    'pl' => [
        'title'    => 'Wniosek nr '.$loan->reference.' zatwierdzony',
        'sub'      => 'Świetne wieści!',
        'greeting' => 'Szanowny/a '.$loan->name.',',
        'intro'    => 'Z przyjemnością informujemy, że Państwa wniosek o pomoc został <strong>zatwierdzony</strong> przez nasz zespół.',
        'next'     => 'Następny krok',
        'next_body'=> 'Nasz zespół przygotowuje Państwa umowę wsparcia. Wkrótce otrzymają ją Państwo pocztą elektroniczną wraz z instrukcją podpisania.',
        'summary'  => 'PODSUMOWANIE',
        'lbl_ref'  => 'Numer referencyjny',
        'lbl_amt'  => 'Zatwierdzona kwota',
        'lbl_dur'  => 'Okres',
        'lbl_mo'   => 'miesięcy',
        'lbl_pay'  => 'Szacowana miesięczna rata',
        'lbl_rate' => 'Roczna stawka za obsługę',
        'closing'  => 'Z poważaniem,',
        'team'     => 'Zespół ' . site_name(),
    ],
    'bg' => [
        'title'    => 'Заявка №'.$loan->reference.' одобрена',
        'sub'      => 'Добра новина!',
        'greeting' => 'Уважаеми/а '.$loan->name.',',
        'intro'    => 'С удоволствие ви информираме, че вашата заявка за помощ беше <strong>одобрена</strong> от нашия екип.',
        'next'     => 'Следваща стъпка',
        'next_body'=> 'Нашият екип подготвя вашето споразумение за подкрепа. Ще го получите съвсем скоро по имейл заедно с инструкции за подписване.',
        'summary'  => 'ОБОБЩЕНИЕ',
        'lbl_ref'  => 'Референция на досието',
        'lbl_amt'  => 'Отпусната сума',
        'lbl_dur'  => 'Срок',
        'lbl_mo'   => 'месеца',
        'lbl_pay'  => 'Прогнозна месечна вноска',
        'lbl_rate' => 'Годишна такса за управление',
        'closing'  => 'С уважение,',
        'team'     => 'Екипът на ' . site_name(),
    ],
    'hu' => [
        'title'    => 'A(z) '.$loan->reference.' sz. kérelem jóváhagyva',
        'sub'      => 'Jó hír!',
        'greeting' => 'Tisztelt '.$loan->name.'!',
        'intro'    => 'Örömmel tájékoztatjuk, hogy támogatási kérelmét csapatunk <strong>jóváhagyta</strong>.',
        'next'     => 'Következő lépés',
        'next_body'=> 'Csapatunk elkészíti támogatási megállapodását. Hamarosan megkapja e-mailben az aláírási útmutatóval együtt.',
        'summary'  => 'ÖSSZEFOGLALÓ',
        'lbl_ref'  => 'Ügy referenciaszáma',
        'lbl_amt'  => 'Jóváhagyott összeg',
        'lbl_dur'  => 'Futamidő',
        'lbl_mo'   => 'hónap',
        'lbl_pay'  => 'Becsült havi részlet',
        'lbl_rate' => 'Éves kezelési díj',
        'closing'  => 'Tisztelettel,',
        'team'     => 'A ' . site_name() . ' csapata',
    ],
    'it' => [
        'title'    => 'Richiesta N°'.$loan->reference.' approvata',
        'sub'      => 'Ottima notizia!',
        'greeting' => 'Gentile '.$loan->name.',',
        'intro'    => 'Siamo lieti di informarti che la tua richiesta di aiuto è stata <strong>approvata</strong> dal nostro team.',
        'next'     => 'Prossimo passo',
        'next_body'=> 'Il nostro team sta preparando il tuo accordo di sostegno. Lo riceverai a breve via email con le istruzioni per la firma.',
        'summary'  => 'RIEPILOGO',
        'lbl_ref'  => 'Riferimento pratica',
        'lbl_amt'  => 'Importo concesso',
        'lbl_dur'  => 'Durata',
        'lbl_mo'   => 'mesi',
        'lbl_pay'  => 'Rata mensile stimata',
        'lbl_rate' => 'Tasso di gestione annuo',
        'closing'  => 'Cordiali saluti,',
        'team'     => 'Il team ' . site_name(),
    ],
    'de' => [
        'title'    => 'Antrag Nr. '.$loan->reference.' genehmigt',
        'sub'      => 'Gute Nachrichten!',
        'greeting' => 'Sehr geehrte Damen und Herren '.$loan->name.',',
        'intro'    => 'Wir freuen uns, Ihnen mitteilen zu können, dass Ihr Hilfsantrag von unserem Team <strong>genehmigt</strong> wurde.',
        'next'     => 'Nächster Schritt',
        'next_body'=> 'Unser Team bereitet Ihre Unterstützungsvereinbarung vor. Sie erhalten sie in Kürze per E-Mail mit den Unterschriftsanweisungen.',
        'summary'  => 'ZUSAMMENFASSUNG',
        'lbl_ref'  => 'Aktenreferenz',
        'lbl_amt'  => 'Genehmigter Betrag',
        'lbl_dur'  => 'Laufzeit',
        'lbl_mo'   => 'Monate',
        'lbl_pay'  => 'Geschätzte monatliche Zahlung',
        'lbl_rate' => 'Jährliche Bearbeitungsgebühr',
        'closing'  => 'Mit freundlichen Grüßen,',
        'team'     => 'Das ' . site_name() . '-Team',
    ],
    'lt' => [
        'title'    => 'Paraiška Nr. '.$loan->reference.' patvirtinta',
        'sub'      => 'Puiki naujiena!',
        'greeting' => 'Gerbiamas (-a) '.$loan->name.',',
        'intro'    => 'Su malonumu pranešame, kad jūsų paramos paraišką mūsų komanda <strong>patvirtino</strong>.',
        'next'     => 'Kitas žingsnis',
        'next_body'=> 'Mūsų komanda ruošia jūsų paramos sutartį. Netrukus gausite ją el. paštu kartu su pasirašymo instrukcijomis.',
        'summary'  => 'SANTRAUKA',
        'lbl_ref'  => 'Bylos numeris',
        'lbl_amt'  => 'Patvirtinta suma',
        'lbl_dur'  => 'Trukmė',
        'lbl_mo'   => 'mėn.',
        'lbl_pay'  => 'Numatoma mėnesinė įmoka',
        'lbl_rate' => 'Metinis aptarnavimo mokestis',
        'closing'  => 'Pagarbiai,',
        'team'     => site_name() . ' komanda',
    ],
    'ro' => [
        'title'    => 'Cererea nr. '.$loan->reference.' aprobată',
        'sub'      => 'Vești bune!',
        'greeting' => 'Stimate/Stimată '.$loan->name.',',
        'intro'    => 'Avem plăcerea să vă informăm că cererea dumneavoastră de ajutor a fost <strong>aprobată</strong> de echipa noastră.',
        'next'     => 'Următorul pas',
        'next_body'=> 'Echipa noastră pregătește acordul dumneavoastră de sprijin. Îl veți primi în curând prin e-mail, împreună cu instrucțiunile de semnare.',
        'summary'  => 'REZUMAT',
        'lbl_ref'  => 'Referință dosar',
        'lbl_amt'  => 'Sumă aprobată',
        'lbl_dur'  => 'Durată',
        'lbl_mo'   => 'luni',
        'lbl_pay'  => 'Rată lunară estimată',
        'lbl_rate' => 'Comision anual de gestiune',
        'closing'  => 'Cu stimă,',
        'team'     => 'Echipa ' . site_name(),
    ],
    'lv' => [
        'title'    => 'Pieteikums Nr. '.$loan->reference.' apstiprināts',
        'sub'      => 'Labas ziņas!',
        'greeting' => 'Godātais/Godātā '.$loan->name.',',
        'intro'    => 'Mums ir prieks jums paziņot, ka jūsu atbalsta pieteikumu mūsu komanda ir <strong>apstiprinājusi</strong>.',
        'next'     => 'Nākamais solis',
        'next_body'=> 'Mūsu komanda gatavo jūsu atbalsta līgumu. Drīzumā to saņemsiet pa e-pastu kopā ar parakstīšanas instrukcijām.',
        'summary'  => 'KOPSAVILKUMS',
        'lbl_ref'  => 'Lietas atsauce',
        'lbl_amt'  => 'Apstiprinātā summa',
        'lbl_dur'  => 'Termiņš',
        'lbl_mo'   => 'mēneši',
        'lbl_pay'  => 'Aptuvenais ikmēneša maksājums',
        'lbl_rate' => 'Gada apkalpošanas maksa',
        'closing'  => 'Ar cieņu,',
        'team'     => site_name() . ' komanda',
    ],
    'nl' => [
        'title'    => 'Aanvraag nr. '.$loan->reference.' goedgekeurd',
        'sub'      => 'Goed nieuws!',
        'greeting' => 'Geachte heer/mevrouw '.$loan->name.',',
        'intro'    => 'Wij zijn verheugd u te kunnen meedelen dat uw hulpaanvraag door ons team is <strong>goedgekeurd</strong>.',
        'next'     => 'Volgende stap',
        'next_body'=> 'Ons team bereidt uw steunovereenkomst voor. U ontvangt deze binnenkort per e-mail, samen met de instructies voor ondertekening.',
        'summary'  => 'SAMENVATTING',
        'lbl_ref'  => 'Dossierreferentie',
        'lbl_amt'  => 'Toegekend bedrag',
        'lbl_dur'  => 'Looptijd',
        'lbl_mo'   => 'maanden',
        'lbl_pay'  => 'Geschatte maandelijkse betaling',
        'lbl_rate' => 'Jaarlijkse beheervergoeding',
        'closing'  => 'Met vriendelijke groet,',
        'team'     => 'Het ' . site_name() . ' Team',
    ],
];
$t = $texts[$locale] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="green"
    :locale="$locale"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{!! $t['intro'] !!}</p>

  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_ref'] }}</span>
      <span class="panel-val">{{ $loan->reference }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_amt'] }}</span>
      <span class="panel-val accent">{{ number_format($loan->amount, 2, ',', ' ') }} {{ $loan->currency }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_dur'] }}</span>
      <span class="panel-val">{{ $loan->darly }} {{ $t['lbl_mo'] }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_pay'] }}</span>
      <span class="panel-val">{{ number_format($loan->monthly_payment, 2, ',', ' ') }} {{ $loan->currency }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_rate'] }}</span>
      <span class="panel-val">{{ $loan->interest_rate }} %</span>
    </div>
  </div>

  <div class="alert alert-info">
    <strong>{{ $t['next'] }}</strong>
    <p>{{ $t['next_body'] }}</p>
  </div>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
