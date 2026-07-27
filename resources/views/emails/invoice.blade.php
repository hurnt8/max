@php
$texts = [
    'fr' => ['title'=>'Nouvelle facture','sub'=>'Espace facturation','greeting'=>'Bonjour','intro'=>'Vous avez reçu une nouvelle facture de la part de <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Référence','lbl_issue'=>'Date d\'émission','lbl_due'=>'Date d\'échéance','lbl_total'=>'Montant total','lbl_desc'=>'Description','lbl_qty'=>'Qté','lbl_unit'=>'Prix unit.','lbl_line_total'=>'Total','lbl_sub'=>'Sous-total','lbl_vat'=>'TVA','lbl_ttc'=>'Total TTC','lbl_note'=>'Note','body'=>'Pour toute question concernant cette facture, veuillez contacter votre conseiller AURELIS CAPITAL GROUP.','closing'=>'Cordialement,','team'=>"L'équipe AURELIS CAPITAL GROUP"],
    'en' => ['title'=>'New invoice','sub'=>'Billing area','greeting'=>'Hello','intro'=>'You have received a new invoice from <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Reference','lbl_issue'=>'Issue date','lbl_due'=>'Due date','lbl_total'=>'Total amount','lbl_desc'=>'Description','lbl_qty'=>'Qty','lbl_unit'=>'Unit price','lbl_line_total'=>'Total','lbl_sub'=>'Subtotal','lbl_vat'=>'VAT','lbl_ttc'=>'Total incl. VAT','lbl_note'=>'Note','body'=>'For any questions about this invoice, please contact your AURELIS CAPITAL GROUP advisor.','closing'=>'Best regards,','team'=>'The AURELIS CAPITAL GROUP team'],
    'es' => ['title'=>'Nueva factura','sub'=>'Área de facturación','greeting'=>'Hola','intro'=>'Ha recibido una nueva factura de <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Referencia','lbl_issue'=>'Fecha de emisión','lbl_due'=>'Fecha de vencimiento','lbl_total'=>'Importe total','lbl_desc'=>'Descripción','lbl_qty'=>'Cant.','lbl_unit'=>'Precio unit.','lbl_line_total'=>'Total','lbl_sub'=>'Subtotal','lbl_vat'=>'IVA','lbl_ttc'=>'Total con IVA','lbl_note'=>'Nota','body'=>'Para cualquier consulta sobre esta factura, contacte a su asesor de AURELIS CAPITAL GROUP.','closing'=>'Atentamente,','team'=>'El equipo AURELIS CAPITAL GROUP'],
    'pl' => ['title'=>'Nowa faktura','sub'=>'Obszar rozliczeniowy','greeting'=>'Witaj','intro'=>'Otrzymałeś/aś nową fakturę od <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Referencja','lbl_issue'=>'Data wystawienia','lbl_due'=>'Termin płatności','lbl_total'=>'Kwota całkowita','lbl_desc'=>'Opis','lbl_qty'=>'Ilość','lbl_unit'=>'Cena jedn.','lbl_line_total'=>'Razem','lbl_sub'=>'Suma częściowa','lbl_vat'=>'VAT','lbl_ttc'=>'Razem z VAT','lbl_note'=>'Uwaga','body'=>'W razie pytań dotyczących faktury, skontaktuj się ze swoim doradcą AURELIS CAPITAL GROUP.','closing'=>'Z poważaniem,','team'=>'Zespół AURELIS CAPITAL GROUP'],
    'bg' => ['title'=>'Нова фактура','sub'=>'Раздел фактуриране','greeting'=>'Здравейте','intro'=>'Получихте нова фактура от <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Референция','lbl_issue'=>'Дата на издаване','lbl_due'=>'Срок на плащане','lbl_total'=>'Обща сума','lbl_desc'=>'Описание','lbl_qty'=>'Кол.','lbl_unit'=>'Ед. цена','lbl_line_total'=>'Общо','lbl_sub'=>'Междинна сума','lbl_vat'=>'ДДС','lbl_ttc'=>'Общо с ДДС','lbl_note'=>'Бележка','body'=>'При въпроси относно тази фактура, моля свържете се с вашия консултант от AURELIS CAPITAL GROUP.','closing'=>'С уважение,','team'=>'Екипът на AURELIS CAPITAL GROUP'],
    'hu' => ['title'=>'Új számla','sub'=>'Számlázási terület','greeting'=>'Üdvözöljük','intro'=>'Új számlát kapott a <strong>AURELIS CAPITAL GROUP</strong>-tól.','lbl_ref'=>'Referenciaszám','lbl_issue'=>'Kiállítás dátuma','lbl_due'=>'Fizetési határidő','lbl_total'=>'Teljes összeg','lbl_desc'=>'Leírás','lbl_qty'=>'Menny.','lbl_unit'=>'Egységár','lbl_line_total'=>'Összesen','lbl_sub'=>'Részösszeg','lbl_vat'=>'ÁFA','lbl_ttc'=>'Összesen ÁFA-val','lbl_note'=>'Megjegyzés','body'=>'A számlával kapcsolatos bármilyen kérdés esetén forduljon AURELIS CAPITAL GROUP tanácsadójához.','closing'=>'Tisztelettel,','team'=>'A AURELIS CAPITAL GROUP csapata'],
    'it' => ['title'=>'Nuova fattura','sub'=>'Area fatturazione','greeting'=>'Ciao','intro'=>'Hai ricevuto una nuova fattura da <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Riferimento','lbl_issue'=>'Data di emissione','lbl_due'=>'Data di scadenza','lbl_total'=>'Importo totale','lbl_desc'=>'Descrizione','lbl_qty'=>'Qtà','lbl_unit'=>'Prezzo unit.','lbl_line_total'=>'Totale','lbl_sub'=>'Subtotale','lbl_vat'=>'IVA','lbl_ttc'=>'Totale IVA inclusa','lbl_note'=>'Nota','body'=>'Per qualsiasi domanda relativa a questa fattura, contatta il tuo consulente AURELIS CAPITAL GROUP.','closing'=>'Cordiali saluti,','team'=>'Il team AURELIS CAPITAL GROUP'],
    'de' => ['title'=>'Neue Rechnung','sub'=>'Rechnungsbereich','greeting'=>'Guten Tag','intro'=>'Sie haben eine neue Rechnung von <strong>AURELIS CAPITAL GROUP</strong> erhalten.','lbl_ref'=>'Referenz','lbl_issue'=>'Ausstellungsdatum','lbl_due'=>'Fälligkeitsdatum','lbl_total'=>'Gesamtbetrag','lbl_desc'=>'Beschreibung','lbl_qty'=>'Menge','lbl_unit'=>'Einzelpreis','lbl_line_total'=>'Summe','lbl_sub'=>'Zwischensumme','lbl_vat'=>'MwSt.','lbl_ttc'=>'Gesamtbetrag inkl. MwSt.','lbl_note'=>'Hinweis','body'=>'Bei Fragen zu dieser Rechnung wenden Sie sich bitte an Ihren Solberg-Grupo-Berater.','closing'=>'Mit freundlichen Grüßen,','team'=>'Das Solberg-Grupo-Team'],
    'lt' => ['title'=>'Nauja sąskaita faktūra','sub'=>'Atsiskaitymų sritis','greeting'=>'Sveiki','intro'=>'Gavote naują sąskaitą faktūrą iš <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Numeris','lbl_issue'=>'Išrašymo data','lbl_due'=>'Apmokėjimo terminas','lbl_total'=>'Bendra suma','lbl_desc'=>'Aprašymas','lbl_qty'=>'Kiekis','lbl_unit'=>'Vnt. kaina','lbl_line_total'=>'Iš viso','lbl_sub'=>'Tarpinė suma','lbl_vat'=>'PVM','lbl_ttc'=>'Iš viso su PVM','lbl_note'=>'Pastaba','body'=>'Iškilus bet kokių klausimų dėl šios sąskaitos faktūros, susisiekite su savo AURELIS CAPITAL GROUP konsultantu.','closing'=>'Pagarbiai,','team'=>'AURELIS CAPITAL GROUP komanda'],
    'ro' => ['title'=>'Factură nouă','sub'=>'Secțiune facturare','greeting'=>'Bună ziua','intro'=>'Ați primit o factură nouă din partea <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Referință','lbl_issue'=>'Data emiterii','lbl_due'=>'Data scadenței','lbl_total'=>'Sumă totală','lbl_desc'=>'Descriere','lbl_qty'=>'Cant.','lbl_unit'=>'Preț unitar','lbl_line_total'=>'Total','lbl_sub'=>'Subtotal','lbl_vat'=>'TVA','lbl_ttc'=>'Total cu TVA','lbl_note'=>'Notă','body'=>'Pentru orice întrebare privind această factură, contactați consilierul dumneavoastră AURELIS CAPITAL GROUP.','closing'=>'Cu stimă,','team'=>'Echipa AURELIS CAPITAL GROUP'],
    'lv' => ['title'=>'Jauns rēķins','sub'=>'Rēķinu sadaļa','greeting'=>'Sveiki','intro'=>'Jūs esat saņēmis jaunu rēķinu no <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Atsauce','lbl_issue'=>'Izrakstīšanas datums','lbl_due'=>'Apmaksas termiņš','lbl_total'=>'Kopējā summa','lbl_desc'=>'Apraksts','lbl_qty'=>'Daudz.','lbl_unit'=>'Vienības cena','lbl_line_total'=>'Kopā','lbl_sub'=>'Starpsumma','lbl_vat'=>'PVN','lbl_ttc'=>'Kopā ar PVN','lbl_note'=>'Piezīme','body'=>'Ja jums ir kādi jautājumi par šo rēķinu, sazinieties ar savu AURELIS CAPITAL GROUP konsultantu.','closing'=>'Ar cieņu,','team'=>'AURELIS CAPITAL GROUP komanda'],
    'nl' => ['title'=>'Nieuwe factuur','sub'=>'Facturatie','greeting'=>'Hallo','intro'=>'U heeft een nieuwe factuur ontvangen van <strong>AURELIS CAPITAL GROUP</strong>.','lbl_ref'=>'Referentie','lbl_issue'=>'Factuurdatum','lbl_due'=>'Vervaldatum','lbl_total'=>'Totaalbedrag','lbl_desc'=>'Omschrijving','lbl_qty'=>'Aant.','lbl_unit'=>'Eenheidsprijs','lbl_line_total'=>'Totaal','lbl_sub'=>'Subtotaal','lbl_vat'=>'btw','lbl_ttc'=>'Totaal incl. btw','lbl_note'=>'Opmerking','body'=>'Voor vragen over deze factuur kunt u contact opnemen met uw adviseur van AURELIS CAPITAL GROUP.','closing'=>'Met vriendelijke groet,','team'=>'Het AURELIS CAPITAL GROUP Team'],
];
$t = $texts[$locale] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title'] . ' ' . $invoice->reference"
    :subtitle="$t['sub']"
    accent="orange"
>

  <p class="greeting">
    {{ $t['greeting'] }} {{ $invoice->client->name }},
  </p>

  <p class="body-text">{!! $t['intro'] !!}</p>

  {{-- Récapitulatif --}}
  <div class="panel">
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_ref'] }}</span>
      <span class="panel-val">{{ $invoice->reference }}</span>
    </div>
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_issue'] }}</span>
      <span class="panel-val">{{ $invoice->issue_date->format('d/m/Y') }}</span>
    </div>
    @if($invoice->due_date)
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_due'] }}</span>
      <span class="panel-val">{{ $invoice->due_date->format('d/m/Y') }}</span>
    </div>
    @endif
    <div class="panel-row">
      <span class="panel-lbl">{{ $t['lbl_total'] }}</span>
      <span class="panel-val accent">{{ number_format($invoice->total, 2, ',', ' ') }} {{ $invoice->currency }}</span>
    </div>
  </div>

  {{-- Détail des lignes --}}
  @if(count($invoice->items ?? []))
  <div class="panel" style="margin-bottom:1.5rem">
    <div class="panel-row" style="background:rgba(255,255,255,.04)">
      <span class="panel-lbl" style="flex:2;color:rgba(240,245,255,.55);font-weight:600">{{ $t['lbl_desc'] }}</span>
      <span class="panel-lbl" style="text-align:center">{{ $t['lbl_qty'] }}</span>
      <span class="panel-lbl" style="text-align:right">{{ $t['lbl_unit'] }}</span>
      <span class="panel-lbl" style="text-align:right;min-width:80px">{{ $t['lbl_line_total'] }}</span>
    </div>
    @foreach($invoice->items as $item)
    <div class="panel-row">
      <span class="panel-val" style="flex:2;text-align:left">{{ $item['description'] ?? '—' }}</span>
      <span class="panel-val" style="text-align:center;min-width:40px">{{ $item['quantity'] ?? 1 }}</span>
      <span class="panel-val" style="text-align:right;min-width:80px">{{ number_format((float)($item['unit_price'] ?? 0), 2, ',', ' ') }}</span>
      <span class="panel-val accent" style="text-align:right;min-width:80px">{{ number_format((float)($item['total'] ?? 0), 2, ',', ' ') }} {{ $invoice->currency }}</span>
    </div>
    @endforeach
    @if($invoice->tax_rate > 0)
    <div class="panel-row"><span class="panel-lbl">{{ $t['lbl_sub'] }}</span><span class="panel-val">{{ number_format($invoice->subtotal, 2, ',', ' ') }} {{ $invoice->currency }}</span></div>
    <div class="panel-row"><span class="panel-lbl">{{ $t['lbl_vat'] }} ({{ $invoice->tax_rate }}%)</span><span class="panel-val">{{ number_format($invoice->tax_amount, 2, ',', ' ') }} {{ $invoice->currency }}</span></div>
    <div class="panel-row"><span class="panel-lbl" style="font-weight:700;color:#F0F5FF">{{ $t['lbl_ttc'] }}</span><span class="panel-val accent" style="font-size:.95rem">{{ number_format($invoice->total, 2, ',', ' ') }} {{ $invoice->currency }}</span></div>
    @endif
  </div>
  @endif

  @if($invoice->description)
  <p class="body-text">{{ $invoice->description }}</p>
  @endif

  @if($invoice->note)
  <div class="alert alert-info">
    <strong>{{ $t['lbl_note'] }}</strong>
    <p>{{ $invoice->note }}</p>
  </div>
  @endif

  <p class="body-text">{{ $t['body'] }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
