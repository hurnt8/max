@php
$ref = $loan->reference;
$amount = number_format((float) $loan->amount, 2, ',', ' ') . ' ' . $loan->currency;

$texts = [
    'fr' => ['title'=>'Demande non retenue','sub'=>'Information concernant votre dossier','greeting'=>'Bonjour','intro'=>"Nous sommes au regret de vous informer que votre demande d'aide n'a pas pu être <strong>retenue</strong> pour ce programme.",'lbl_ref'=>'Référence','lbl_amount'=>'Montant demandé','lbl_reason'=>'Motif','body'=>'Pour toute question ou pour soumettre une nouvelle demande, contactez votre conseiller.','btn_details'=>'Voir les prochaines étapes','closing'=>'Cordialement,','team'=>"L'équipe " . site_name()],
    'en' => ['title'=>'Request not selected','sub'=>'Information about your file','greeting'=>'Hello','intro'=>"We regret to inform you that your aid request could not be <strong>selected</strong> for this program.",'lbl_ref'=>'Reference','lbl_amount'=>'Requested amount','lbl_reason'=>'Reason','body'=>'For any questions or to submit a new request, please contact your advisor.','btn_details'=>'View next steps','closing'=>'Best regards,','team'=>'The ' . site_name() . ' team'],
    'pl' => ['title'=>'Wniosek nieprzyjęty','sub'=>'Informacja dotycząca Twojego wniosku','greeting'=>'Witaj','intro'=>'Z przykrością informujemy, że Twój wniosek o pomoc nie mógł zostać <strong>przyjęty</strong> w ramach tego programu.','lbl_ref'=>'Referencja','lbl_amount'=>'Wnioskowana kwota','lbl_reason'=>'Powód','body'=>'W razie pytań lub aby złożyć nowy wniosek, skontaktuj się ze swoim doradcą.','btn_details'=>'Zobacz kolejne kroki','closing'=>'Z poważaniem,','team'=>'Zespół ' . site_name()],
    'es' => ['title'=>'Solicitud no seleccionada','sub'=>'Información sobre su expediente','greeting'=>'Hola','intro'=>'Lamentamos informarle que su solicitud de ayuda no pudo ser <strong>seleccionada</strong> para este programa.','lbl_ref'=>'Referencia','lbl_amount'=>'Importe solicitado','lbl_reason'=>'Motivo','body'=>'Para cualquier consulta o para presentar una nueva solicitud, contacte a su asesor.','btn_details'=>'Ver los próximos pasos','closing'=>'Atentamente,','team'=>'El equipo ' . site_name()],
    'bg' => ['title'=>'Заявката не е одобрена','sub'=>'Информация относно вашето досие','greeting'=>'Здравейте','intro'=>'Съжаляваме да ви уведомим, че вашата заявка за помощ не можа да бъде <strong>одобрена</strong> за тази програма.','lbl_ref'=>'Референция','lbl_amount'=>'Заявена сума','lbl_reason'=>'Причина','body'=>'При въпроси или за да подадете нова заявка, свържете се с вашия консултант.','btn_details'=>'Вижте следващите стъпки','closing'=>'С уважение,','team'=>'Екипът на ' . site_name()],
    'hu' => ['title'=>'A kérelem nem került elfogadásra','sub'=>'Tájékoztatás ügyéről','greeting'=>'Üdvözöljük','intro'=>'Sajnálattal tájékoztatjuk, hogy támogatási kérelmét nem tudtuk <strong>elfogadni</strong> ehhez a programhoz.','lbl_ref'=>'Ügyszám','lbl_amount'=>'Igényelt összeg','lbl_reason'=>'Indoklás','body'=>'Bármilyen kérdés esetén, vagy új kérelem benyújtásához forduljon tanácsadójához.','btn_details'=>'Következő lépések megtekintése','closing'=>'Tisztelettel,','team'=>'A ' . site_name() . ' csapata'],
    'it' => ['title'=>'Richiesta non accolta','sub'=>'Informazioni sulla tua pratica','greeting'=>'Ciao','intro'=>'Siamo spiacenti di informarti che la tua richiesta di aiuto non ha potuto essere <strong>accolta</strong> per questo programma.','lbl_ref'=>'Riferimento','lbl_amount'=>'Importo richiesto','lbl_reason'=>'Motivo','body'=>'Per qualsiasi domanda o per presentare una nuova richiesta, contatta il tuo consulente.','btn_details'=>'Vedi i prossimi passi','closing'=>'Cordiali saluti,','team'=>'Il team ' . site_name()],
    'de' => ['title'=>'Antrag nicht berücksichtigt','sub'=>'Information zu Ihrer Akte','greeting'=>'Guten Tag','intro'=>'Wir müssen Ihnen leider mitteilen, dass Ihr Antrag auf Unterstützung für dieses Programm nicht <strong>berücksichtigt</strong> werden konnte.','lbl_ref'=>'Referenz','lbl_amount'=>'Beantragter Betrag','lbl_reason'=>'Grund','body'=>'Bei Fragen oder zur Einreichung eines neuen Antrags wenden Sie sich bitte an Ihren Berater.','btn_details'=>'Nächste Schritte ansehen','closing'=>'Mit freundlichen Grüßen,','team'=>'Das ' . site_name() . ' Team'],
    'lt' => ['title'=>'Prašymas nepatvirtintas','sub'=>'Informacija apie jūsų bylą','greeting'=>'Sveiki','intro'=>'Su apgailestavimu pranešame, kad jūsų pagalbos prašymas negalėjo būti <strong>patvirtintas</strong> šiai programai.','lbl_ref'=>'Numeris','lbl_amount'=>'Prašoma suma','lbl_reason'=>'Priežastis','body'=>'Iškilus klausimams arba norėdami pateikti naują prašymą, susisiekite su savo konsultantu.','btn_details'=>'Peržiūrėti tolimesnius žingsnius','closing'=>'Pagarbiai,','team'=>site_name() . ' komanda'],
    'ro' => ['title'=>'Cerere neselectată','sub'=>'Informații despre dosarul dumneavoastră','greeting'=>'Bună ziua','intro'=>'Regretăm să vă informăm că cererea dumneavoastră de ajutor nu a putut fi <strong>selectată</strong> pentru acest program.','lbl_ref'=>'Referință','lbl_amount'=>'Sumă solicitată','lbl_reason'=>'Motiv','body'=>'Pentru orice întrebare sau pentru a depune o nouă cerere, contactați consilierul dumneavoastră.','btn_details'=>'Vezi următorii pași','closing'=>'Cu stimă,','team'=>'Echipa ' . site_name()],
    'lv' => ['title'=>'Pieteikums nav apstiprināts','sub'=>'Informācija par jūsu lietu','greeting'=>'Sveiki','intro'=>'Mums ir žēl jums paziņot, ka jūsu palīdzības pieteikums nevarēja tikt <strong>apstiprināts</strong> šai programmai.','lbl_ref'=>'Atsauce','lbl_amount'=>'Pieprasītā summa','lbl_reason'=>'Iemesls','body'=>'Ja jums ir kādi jautājumi vai vēlaties iesniegt jaunu pieteikumu, sazinieties ar savu konsultantu.','btn_details'=>'Skatīt nākamos soļus','closing'=>'Ar cieņu,','team'=>site_name() . ' komanda'],
    'nl' => ['title'=>'Aanvraag niet weerhouden','sub'=>'Informatie over uw dossier','greeting'=>'Hallo','intro'=>'Wij moeten u helaas meedelen dat uw hulpaanvraag niet kon worden <strong>weerhouden</strong> voor dit programma.','lbl_ref'=>'Referentie','lbl_amount'=>'Aangevraagd bedrag','lbl_reason'=>'Reden','body'=>'Voor vragen of om een nieuwe aanvraag in te dienen, neemt u contact op met uw adviseur.','btn_details'=>'Bekijk volgende stappen','closing'=>'Met vriendelijke groet,','team'=>'Het ' . site_name() . ' Team'],
    'pt' => ['title'=>'Pedido não selecionado','sub'=>'Informação sobre o seu processo','greeting'=>'Olá','intro'=>'Lamentamos informar que o seu pedido de ajuda não pôde ser <strong>selecionado</strong> para este programa.','lbl_ref'=>'Referência','lbl_amount'=>'Montante solicitado','lbl_reason'=>'Motivo','body'=>'Para qualquer questão ou para submeter um novo pedido, contacte o seu consultor.','btn_details'=>'Ver próximos passos','closing'=>'Atenciosamente,','team'=>'A equipa ' . site_name()],
];

$t = $texts[$locale] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="red"
    :locale="$locale"
>

  <p class="greeting">
    {{ $t['greeting'] }} {{ $loan->name }},
  </p>

  <p class="body-text">{!! $t['intro'] !!}</p>

  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_ref'] }}</span>
      <span class="panel-val">{{ $ref }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_amount'] }}</span>
      <span class="panel-val">{{ $amount }}</span>
    </div>
  </div>

  <div class="alert alert-danger">
    <strong>{{ $t['lbl_reason'] }}</strong>
    <p>{{ $reason }}</p>
  </div>

  <p class="body-text">{{ $t['body'] }}</p>

  <div class="btn-wrap">
    <a href="{{ $outcomeUrl }}" class="btn">{{ $t['btn_details'] }}</a>
  </div>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
