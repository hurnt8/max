@php
$ref = $financing->reference;
$amount = number_format($financing->amount, 2, ',', ' ') . ' ' . $financing->currency;
$credited = number_format($creditedAmount, 2, ',', ' ') . ' ' . $financing->currency;

$texts = [
    'fr' => ['title'=>'Financement débloqué','sub'=>'Votre dossier est finalisé','greeting'=>'Bonjour','intro'=>'Nous avons le plaisir de vous informer que votre dossier de financement a été <strong>finalisé</strong>.','lbl_ref'=>'Référence','lbl_amount'=>'Montant financé','lbl_credited'=>'Montant crédité','lbl_start'=>'Début des remboursements','body_credited'=>'Le montant a été crédité sur votre compte. Vous pouvez le consulter dans votre espace client.','body_not_credited'=>'Les fonds vous seront versés selon les modalités convenues avec votre conseiller.','closing'=>'Cordialement,','team'=>"L'équipe AURELIS CAPITAL GROUP"],
    'en' => ['title'=>'Funds released','sub'=>'Your file has been finalized','greeting'=>'Hello','intro'=>'We are pleased to inform you that your financing file has been <strong>finalized</strong>.','lbl_ref'=>'Reference','lbl_amount'=>'Financed amount','lbl_credited'=>'Credited amount','lbl_start'=>'Repayments start on','body_credited'=>'The amount has been credited to your account. You can view it in your client area.','body_not_credited'=>'The funds will be paid to you according to the terms agreed with your advisor.','closing'=>'Best regards,','team'=>'The AURELIS CAPITAL GROUP team'],
    'pl' => ['title'=>'Środki uwolnione','sub'=>'Twój wniosek został sfinalizowany','greeting'=>'Witaj','intro'=>'Z przyjemnością informujemy, że Twój wniosek o finansowanie został <strong>sfinalizowany</strong>.','lbl_ref'=>'Referencja','lbl_amount'=>'Kwota finansowania','lbl_credited'=>'Zaksięgowana kwota','lbl_start'=>'Początek spłat','body_credited'=>'Kwota została zaksięgowana na Twoim koncie. Możesz ją sprawdzić w swoim panelu klienta.','body_not_credited'=>'Środki zostaną Ci wypłacone zgodnie z warunkami uzgodnionymi z doradcą.','closing'=>'Z poważaniem,','team'=>'Zespół AURELIS CAPITAL GROUP'],
    'es' => ['title'=>'Fondos liberados','sub'=>'Su expediente ha sido finalizado','greeting'=>'Hola','intro'=>'Nos complace informarle que su expediente de financiación ha sido <strong>finalizado</strong>.','lbl_ref'=>'Referencia','lbl_amount'=>'Importe financiado','lbl_credited'=>'Importe abonado','lbl_start'=>'Inicio de los reembolsos','body_credited'=>'El importe ha sido abonado en su cuenta. Puede consultarlo en su área de cliente.','body_not_credited'=>'Los fondos se le abonarán según las condiciones acordadas con su asesor.','closing'=>'Atentamente,','team'=>'El equipo AURELIS CAPITAL GROUP'],
    'bg' => ['title'=>'Средствата са отпуснати','sub'=>'Вашето досие е финализирано','greeting'=>'Здравейте','intro'=>'С удоволствие ви уведомяваме, че вашето досие за финансиране беше <strong>финализирано</strong>.','lbl_ref'=>'Референция','lbl_amount'=>'Финансирана сума','lbl_credited'=>'Кредитирана сума','lbl_start'=>'Начало на погасяванията','body_credited'=>'Сумата беше кредитирана по вашата сметка. Можете да я видите в клиентското си пространство.','body_not_credited'=>'Средствата ще ви бъдат изплатени съгласно условията, договорени с вашия консултант.','closing'=>'С уважение,','team'=>'Екипът на AURELIS CAPITAL GROUP'],
    'hu' => ['title'=>'Finanszírozás folyósítva','sub'=>'Ügye lezárásra került','greeting'=>'Üdvözöljük','intro'=>'Örömmel értesítjük, hogy finanszírozási ügye <strong>lezárásra</strong> került.','lbl_ref'=>'Ügyszám','lbl_amount'=>'Finanszírozott összeg','lbl_credited'=>'Jóváírt összeg','lbl_start'=>'Törlesztés kezdete','body_credited'=>'Az összeget jóváírtuk számláján. Ezt ügyfélfiókjában tekintheti meg.','body_not_credited'=>'Az összeget tanácsadójával egyeztetett feltételek szerint folyósítjuk.','closing'=>'Tisztelettel,','team'=>'A AURELIS CAPITAL GROUP csapata'],
    'it' => ['title'=>'Fondi erogati','sub'=>'La tua pratica è stata finalizzata','greeting'=>'Ciao','intro'=>'Siamo lieti di informarti che la tua pratica di finanziamento è stata <strong>finalizzata</strong>.','lbl_ref'=>'Riferimento','lbl_amount'=>'Importo finanziato','lbl_credited'=>'Importo accreditato','lbl_start'=>'Inizio dei rimborsi','body_credited'=>"L'importo è stato accreditato sul tuo conto. Puoi consultarlo nella tua area cliente.",'body_not_credited'=>'I fondi ti saranno versati secondo le modalità concordate con il tuo consulente.','closing'=>'Cordiali saluti,','team'=>'Il team AURELIS CAPITAL GROUP'],
    'de' => ['title'=>'Mittel freigegeben','sub'=>'Ihre Akte wurde abgeschlossen','greeting'=>'Guten Tag','intro'=>'Wir freuen uns, Ihnen mitzuteilen, dass Ihre Finanzierungsakte <strong>abgeschlossen</strong> wurde.','lbl_ref'=>'Referenz','lbl_amount'=>'Finanzierter Betrag','lbl_credited'=>'Gutgeschriebener Betrag','lbl_start'=>'Beginn der Rückzahlungen','body_credited'=>'Der Betrag wurde Ihrem Konto gutgeschrieben. Sie können ihn in Ihrem Kundenbereich einsehen.','body_not_credited'=>'Die Mittel werden Ihnen gemäß den mit Ihrem Berater vereinbarten Bedingungen ausgezahlt.','closing'=>'Mit freundlichen Grüßen,','team'=>'Das AURELIS CAPITAL GROUP Team'],
    'lt' => ['title'=>'Lėšos išmokėtos','sub'=>'Jūsų byla užbaigta','greeting'=>'Sveiki','intro'=>'Su malonumu pranešame, kad jūsų finansavimo byla buvo <strong>užbaigta</strong>.','lbl_ref'=>'Numeris','lbl_amount'=>'Finansuota suma','lbl_credited'=>'Įskaityta suma','lbl_start'=>'Grąžinimo pradžia','body_credited'=>'Suma buvo įskaityta į jūsų sąskaitą. Galite ją peržiūrėti savo kliento srityje.','body_not_credited'=>'Lėšos jums bus išmokėtos pagal su konsultantu sutartas sąlygas.','closing'=>'Pagarbiai,','team'=>'AURELIS CAPITAL GROUP komanda'],
    'ro' => ['title'=>'Fonduri deblocate','sub'=>'Dosarul dumneavoastră a fost finalizat','greeting'=>'Bună ziua','intro'=>'Avem plăcerea de a vă informa că dosarul dumneavoastră de finanțare a fost <strong>finalizat</strong>.','lbl_ref'=>'Referință','lbl_amount'=>'Sumă finanțată','lbl_credited'=>'Sumă creditată','lbl_start'=>'Începutul rambursărilor','body_credited'=>'Suma a fost creditată în contul dumneavoastră. O puteți consulta în spațiul dumneavoastră de client.','body_not_credited'=>'Fondurile vă vor fi plătite conform condițiilor convenite cu consilierul dumneavoastră.','closing'=>'Cu stimă,','team'=>'Echipa AURELIS CAPITAL GROUP'],
    'lv' => ['title'=>'Līdzekļi izmaksāti','sub'=>'Jūsu lieta ir pabeigta','greeting'=>'Sveiki','intro'=>'Ar prieku informējam, ka jūsu finansējuma lieta ir <strong>pabeigta</strong>.','lbl_ref'=>'Atsauce','lbl_amount'=>'Finansētā summa','lbl_credited'=>'Ieskaitītā summa','lbl_start'=>'Atmaksas sākums','body_credited'=>'Summa ir ieskaitīta jūsu kontā. Varat to apskatīt savā klienta zonā.','body_not_credited'=>'Līdzekļi jums tiks izmaksāti saskaņā ar nosacījumiem, par kuriem panākta vienošanās ar jūsu konsultantu.','closing'=>'Ar cieņu,','team'=>'AURELIS CAPITAL GROUP komanda'],
    'nl' => ['title'=>'Financiering vrijgegeven','sub'=>'Uw dossier is afgerond','greeting'=>'Hallo','intro'=>'Wij zijn verheugd u te informeren dat uw financieringsdossier <strong>afgerond</strong> is.','lbl_ref'=>'Referentie','lbl_amount'=>'Gefinancierd bedrag','lbl_credited'=>'Bijgeschreven bedrag','lbl_start'=>'Start van de terugbetalingen','body_credited'=>'Het bedrag is bijgeschreven op uw rekening. U kunt dit raadplegen in uw klantomgeving.','body_not_credited'=>'De middelen worden aan u uitbetaald volgens de met uw adviseur overeengekomen voorwaarden.','closing'=>'Met vriendelijke groet,','team'=>'Het AURELIS CAPITAL GROUP Team'],
    'pt' => ['title'=>'Fundos liberados','sub'=>'O seu processo foi finalizado','greeting'=>'Olá','intro'=>'Temos o prazer de informar que o seu processo de financiamento foi <strong>finalizado</strong>.','lbl_ref'=>'Referência','lbl_amount'=>'Montante financiado','lbl_credited'=>'Montante creditado','lbl_start'=>'Início dos reembolsos','body_credited'=>'O montante foi creditado na sua conta. Pode consultá-lo na sua área de cliente.','body_not_credited'=>'Os fundos ser-lhe-ão pagos de acordo com as condições acordadas com o seu consultor.','closing'=>'Atenciosamente,','team'=>'A equipa AURELIS CAPITAL GROUP'],
    'sk' => ['title'=>'Prostriedky uvoľnené','sub'=>'Váš spis bol finalizovaný','greeting'=>'Dobrý deň','intro'=>'S potešením vám oznamujeme, že váš spis financovania bol <strong>finalizovaný</strong>.','lbl_ref'=>'Referencia','lbl_amount'=>'Financovaná suma','lbl_credited'=>'Pripísaná suma','lbl_start'=>'Začiatok splácania','body_credited'=>'Suma bola pripísaná na váš účet. Môžete si ju pozrieť vo svojom klientskom priestore.','body_not_credited'=>'Prostriedky vám budú vyplatené podľa podmienok dohodnutých s vaším poradcom.','closing'=>'S pozdravom,','team'=>'Tím AURELIS CAPITAL GROUP'],
    'el' => ['title'=>'Χρηματοδότηση καταβλήθηκε','sub'=>'Ο φάκελός σας οριστικοποιήθηκε','greeting'=>'Γεια σας','intro'=>'Έχουμε την ευχαρίστηση να σας ενημερώσουμε ότι ο φάκελος χρηματοδότησής σας <strong>οριστικοποιήθηκε</strong>.','lbl_ref'=>'Αναφορά','lbl_amount'=>'Χρηματοδοτούμενο ποσό','lbl_credited'=>'Πιστωμένο ποσό','lbl_start'=>'Έναρξη αποπληρωμών','body_credited'=>'Το ποσό πιστώθηκε στον λογαριασμό σας. Μπορείτε να το δείτε στον χώρο πελάτη σας.','body_not_credited'=>'Τα κεφάλαια θα σας καταβληθούν σύμφωνα με τους όρους που συμφωνήθηκαν με τον σύμβουλό σας.','closing'=>'Με εκτίμηση,','team'=>'Η ομάδα AURELIS CAPITAL GROUP'],
];

$t = $texts[$locale] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="green"
>

  <p class="greeting">
    {{ $t['greeting'] }} {{ $financing->name }},
  </p>

  <p class="body-text">{!! $t['intro'] !!}</p>

  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_ref'] }}</span>
      <span class="panel-val">{{ $ref }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_amount'] }}</span>
      <span class="panel-val accent">{{ $amount }}</span>
    </div>
    @if($wasCredited)
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_credited'] }}</span>
      <span class="panel-val accent">{{ $credited }}</span>
    </div>
    @endif
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_start'] }}</span>
      <span class="panel-val">{{ $repaymentStartDate }}</span>
    </div>
  </div>

  <p class="body-text">{{ $wasCredited ? $t['body_credited'] : $t['body_not_credited'] }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
