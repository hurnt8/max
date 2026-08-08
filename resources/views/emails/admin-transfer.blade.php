@php
$amount = $transfer->currency . ' ' . number_format($transfer->amount, 2, ',', ' ');

$texts = [
    'fr' => ['title'=>'Nouveau virement en attente','sub'=>'Support Solberg Grupo','intro'=>'vient de soumettre un virement nécessitant votre validation.','lbl_ref'=>'Référence','lbl_amount'=>'Montant','lbl_bene'=>'Bénéficiaire','lbl_iban'=>'IBAN','lbl_note'=>'Note','lbl_date'=>'Soumis le','btn'=>'Valider le virement','closing'=>'Cordialement,','team'=>"L'équipe Solberg Grupo"],
    'en' => ['title'=>'New transfer pending','sub'=>'Solberg Grupo Support','intro'=>'has just submitted a transfer requiring your validation.','lbl_ref'=>'Reference','lbl_amount'=>'Amount','lbl_bene'=>'Beneficiary','lbl_iban'=>'IBAN','lbl_note'=>'Note','lbl_date'=>'Submitted on','btn'=>'Validate the transfer','closing'=>'Best regards,','team'=>'The Solberg Grupo team'],
    'es' => ['title'=>'Nueva transferencia pendiente','sub'=>'Soporte Solberg Grupo','intro'=>'acaba de enviar una transferencia que requiere su validación.','lbl_ref'=>'Referencia','lbl_amount'=>'Importe','lbl_bene'=>'Beneficiario','lbl_iban'=>'IBAN','lbl_note'=>'Nota','lbl_date'=>'Enviado el','btn'=>'Validar la transferencia','closing'=>'Atentamente,','team'=>'El equipo Solberg Grupo'],
    'pl' => ['title'=>'Nowy przelew oczekujący','sub'=>'Wsparcie Solberg Grupo','intro'=>'przesłał(a) przelew wymagający Twojej walidacji.','lbl_ref'=>'Referencja','lbl_amount'=>'Kwota','lbl_bene'=>'Beneficjent','lbl_iban'=>'IBAN','lbl_note'=>'Uwaga','lbl_date'=>'Przesłano','btn'=>'Zatwierdź przelew','closing'=>'Z poważaniem,','team'=>'Zespół Solberg Grupo'],
    'bg' => ['title'=>'Нов чакащ превод','sub'=>'Поддръжка Solberg Grupo','intro'=>'току-що подаде превод, изискващ вашето одобрение.','lbl_ref'=>'Референция','lbl_amount'=>'Сума','lbl_bene'=>'Получател','lbl_iban'=>'IBAN','lbl_note'=>'Бележка','lbl_date'=>'Подадено на','btn'=>'Одобри превода','closing'=>'С уважение,','team'=>'Екипът на Solberg Grupo'],
    'hu' => ['title'=>'Új függőben lévő átutalás','sub'=>'Solberg Grupo ügyfélszolgálat','intro'=>'most nyújtott be egy átutalást, amely jóváhagyást igényel.','lbl_ref'=>'Referenciaszám','lbl_amount'=>'Összeg','lbl_bene'=>'Kedvezményezett','lbl_iban'=>'IBAN','lbl_note'=>'Megjegyzés','lbl_date'=>'Beküldve','btn'=>'Átutalás jóváhagyása','closing'=>'Tisztelettel,','team'=>'A Solberg Grupo csapata'],
    'it' => ['title'=>'Nuovo bonifico in attesa','sub'=>'Assistenza Solberg Grupo','intro'=>'ha appena inviato un bonifico che richiede la tua convalida.','lbl_ref'=>'Riferimento','lbl_amount'=>'Importo','lbl_bene'=>'Beneficiario','lbl_iban'=>'IBAN','lbl_note'=>'Nota','lbl_date'=>'Inviato il','btn'=>'Convalida il bonifico','closing'=>'Cordiali saluti,','team'=>'Il team Solberg Grupo'],
    'de' => ['title'=>'Neue ausstehende Überweisung','sub'=>'Solberg Grupo Support','intro'=>'hat soeben eine Überweisung eingereicht, die Ihre Bestätigung erfordert.','lbl_ref'=>'Referenz','lbl_amount'=>'Betrag','lbl_bene'=>'Begünstigter','lbl_iban'=>'IBAN','lbl_note'=>'Hinweis','lbl_date'=>'Eingereicht am','btn'=>'Überweisung bestätigen','closing'=>'Mit freundlichen Grüßen,','team'=>'Das Solberg-Grupo-Team'],
    'lt' => ['title'=>'Naujas laukiantis pavedimas','sub'=>'Solberg Grupo pagalba','intro'=>'ką tik pateikė pavedimą, kuriam reikia jūsų patvirtinimo.','lbl_ref'=>'Numeris','lbl_amount'=>'Suma','lbl_bene'=>'Gavėjas','lbl_iban'=>'IBAN','lbl_note'=>'Pastaba','lbl_date'=>'Pateikta','btn'=>'Patvirtinti pavedimą','closing'=>'Pagarbiai,','team'=>'Solberg Grupo komanda'],
    'ro' => ['title'=>'Transfer nou în așteptare','sub'=>'Suport Solberg Grupo','intro'=>'tocmai a trimis un transfer care necesită validarea dumneavoastră.','lbl_ref'=>'Referință','lbl_amount'=>'Sumă','lbl_bene'=>'Beneficiar','lbl_iban'=>'IBAN','lbl_note'=>'Notă','lbl_date'=>'Trimis la','btn'=>'Validează transferul','closing'=>'Cu stimă,','team'=>'Echipa Solberg Grupo'],
    'lv' => ['title'=>'Jauns gaidošs pārvedums','sub'=>'Solberg Grupo atbalsts','intro'=>'tikko iesniedza pārvedumu, kuram nepieciešams jūsu apstiprinājums.','lbl_ref'=>'Atsauce','lbl_amount'=>'Summa','lbl_bene'=>'Saņēmējs','lbl_iban'=>'IBAN','lbl_note'=>'Piezīme','lbl_date'=>'Iesniegts','btn'=>'Apstiprināt pārvedumu','closing'=>'Ar cieņu,','team'=>'Solberg Grupo komanda'],
    'nl' => ['title'=>'Nieuwe openstaande overschrijving','sub'=>'Solberg Grupo Support','intro'=>'heeft zojuist een overschrijving ingediend die uw goedkeuring vereist.','lbl_ref'=>'Referentie','lbl_amount'=>'Bedrag','lbl_bene'=>'Begunstigde','lbl_iban'=>'IBAN','lbl_note'=>'Opmerking','lbl_date'=>'Ingediend op','btn'=>'Overschrijving goedkeuren','closing'=>'Met vriendelijke groet,','team'=>'Het team van Solberg Grupo'],
    'pt' => ['title'=>'Nova transferência pendente','sub'=>'Suporte Solberg Grupo','intro'=>'acabou de submeter uma transferência que requer a sua validação.','lbl_ref'=>'Referência','lbl_amount'=>'Montante','lbl_bene'=>'Beneficiário','lbl_iban'=>'IBAN','lbl_note'=>'Nota','lbl_date'=>'Submetido em','btn'=>'Validar a transferência','closing'=>'Atenciosamente,','team'=>'A equipa Solberg Grupo'],
];
$t = $texts[$locale ?? 'fr'] ?? $texts['fr'];
@endphp
<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="orange"
>

  <p class="greeting">
    <strong>{{ $client->name }}</strong> {{ $t['intro'] }}
  </p>

  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_ref'] }}</span>
      <span class="panel-val">{{ $transfer->reference }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_amount'] }}</span>
      <span class="panel-val accent">{{ $amount }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_bene'] }}</span>
      <span class="panel-val">{{ $transfer->beneficiary_name }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_iban'] }}</span>
      <span class="panel-val" style="font-family:monospace;font-size:.82rem">{{ $transfer->beneficiary_iban }}</span>
    </div>
    @if($transfer->note)
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_note'] }}</span>
      <span class="panel-val">{{ $transfer->note }}</span>
    </div>
    @endif
  </div>

  <div class="btn-wrap">
    <a href="{{ url('/admin/transfers') }}" class="btn">{{ $t['btn'] }}</a>
  </div>

  <p class="body-text">{{ $t['lbl_date'] }} {{ $transfer->created_at->format('d/m/Y H:i') }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
