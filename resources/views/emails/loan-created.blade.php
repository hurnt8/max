@component('mail::message')

@php
$texts = [
    'fr' => [
        'greeting'     => 'Madame / Monsieur ' . $loan->name . ',',
        'intro'        => 'Nous avons bien enregistré votre dossier auprès de **SOLIDARIS FOUNDATION**. Vous trouverez ci-joint votre accord de soutien ainsi que le tableau détaillant vos versements.',
        'summary'      => 'RÉSUMÉ DE VOTRE AIDE',
        'ref'          => 'Référence dossier',
        'amount'       => 'Montant accordé',
        'duration'     => 'Durée',
        'months'       => 'mois',
        'monthly'      => 'Versement mensuel',
        'rate'         => 'Taux de gestion',
        'fees'         => 'Frais administratifs',
        'start'        => 'Première échéance',
        'docs_title'   => 'DOCUMENTS JOINTS',
        'doc_contract' => '📄 **Accord_{{ ref }}.pdf** — Votre accord de soutien à lire attentivement',
        'doc_amort'    => '📊 **Tableau_Versements_{{ ref }}.pdf** — Échéancier mensuel complet',
        'next_title'   => 'PROCHAINES ÉTAPES',
        'next_1'       => '1. Lisez attentivement l\'accord joint.',
        'next_2'       => '2. Signez-le et renvoyez-le à notre équipe par email.',
        'next_3'       => '3. Une fois reçu, les coordonnées bancaires vous seront communiquées pour le versement des fonds.',
        'closing'      => 'Nous restons à votre disposition pour toute question.',
        'team'         => 'L\'équipe ' . site_name(),
    ],
    'pl' => [
        'greeting'     => 'Szanowny/a ' . $loan->name . ',',
        'intro'        => 'Zarejestrowaliśmy Państwa wniosek w **SOLIDARIS FOUNDATION**. W załączeniu przesyłamy umowę wsparcia oraz harmonogram Państwa wpłat.',
        'summary'      => 'PODSUMOWANIE PAŃSTWA POMOCY',
        'ref'          => 'Numer referencyjny',
        'amount'       => 'Przyznana kwota',
        'duration'     => 'Okres',
        'months'       => 'miesięcy',
        'monthly'      => 'Miesięczna wpłata',
        'rate'         => 'Stawka za obsługę',
        'fees'         => 'Opłaty administracyjne',
        'start'        => 'Pierwsza rata',
        'docs_title'   => 'ZAŁĄCZONE DOKUMENTY',
        'doc_contract' => '📄 **Umowa_{{ ref }}.pdf** — Umowa wsparcia do dokładnego przeczytania',
        'doc_amort'    => '📊 **Harmonogram_{{ ref }}.pdf** — Pełny miesięczny harmonogram wpłat',
        'next_title'   => 'KOLEJNE KROKI',
        'next_1'       => '1. Prosimy o dokładne zapoznanie się z załączoną umową.',
        'next_2'       => '2. Proszę ją podpisać i odesłać do naszego zespołu.',
        'next_3'       => '3. Po otrzymaniu podpisanej umowy przekażemy dane bankowe do wypłaty środków.',
        'closing'      => 'Pozostajemy do Państwa dyspozycji w razie jakichkolwiek pytań.',
        'team'         => 'Zespół ' . site_name(),
    ],
    'en' => [
        'greeting'     => 'Dear ' . $loan->name . ',',
        'intro'        => 'Your file has been registered with **SOLIDARIS FOUNDATION**. Please find attached your support agreement and the schedule detailing your payments.',
        'summary'      => 'SUMMARY OF YOUR AID',
        'ref'          => 'File reference',
        'amount'       => 'Amount granted',
        'duration'     => 'Duration',
        'months'       => 'months',
        'monthly'      => 'Monthly payment',
        'rate'         => 'Management fee rate',
        'fees'         => 'Administrative fees',
        'start'        => 'First payment date',
        'docs_title'   => 'ATTACHED DOCUMENTS',
        'doc_contract' => '📄 **Agreement_{{ ref }}.pdf** — Your support agreement, please read carefully',
        'doc_amort'    => '📊 **PaymentSchedule_{{ ref }}.pdf** — Complete monthly payment schedule',
        'next_title'   => 'NEXT STEPS',
        'next_1'       => '1. Read the attached agreement carefully.',
        'next_2'       => '2. Sign it and return it to our team by email.',
        'next_3'       => '3. Once received, our team will send you the bank details for the fund transfer.',
        'closing'      => 'We remain at your disposal for any questions.',
        'team'         => 'The ' . site_name() . ' team',
    ],
    'es' => [
        'greeting'     => 'Estimado/a ' . $loan->name . ',',
        'intro'        => 'Hemos registrado su expediente en **SOLIDARIS FOUNDATION**. Adjuntamos su acuerdo de apoyo y el cuadro con el detalle de sus pagos.',
        'summary'      => 'RESUMEN DE SU AYUDA',
        'ref'          => 'Referencia del expediente',
        'amount'       => 'Importe concedido',
        'duration'     => 'Duración',
        'months'       => 'meses',
        'monthly'      => 'Cuota mensual',
        'rate'         => 'Tasa de gestión',
        'fees'         => 'Gastos administrativos',
        'start'        => 'Primera cuota',
        'docs_title'   => 'DOCUMENTOS ADJUNTOS',
        'doc_contract' => '📄 **Acuerdo_{{ ref }}.pdf** — Su acuerdo de apoyo, léalo detenidamente',
        'doc_amort'    => '📊 **CuadroPagos_{{ ref }}.pdf** — Calendario mensual completo de pagos',
        'next_title'   => 'PRÓXIMOS PASOS',
        'next_1'       => '1. Lea detenidamente el acuerdo adjunto.',
        'next_2'       => '2. Fírmelo y envíelo a nuestro equipo por correo electrónico.',
        'next_3'       => '3. Una vez recibido, le comunicaremos los datos bancarios para la transferencia de fondos.',
        'closing'      => 'Quedamos a su disposición para cualquier consulta.',
        'team'         => 'El equipo ' . site_name(),
    ],
    'bg' => [
        'greeting'     => 'Уважаеми/а ' . $loan->name . ',',
        'intro'        => 'Успешно регистрирахме вашето досие в **SOLIDARIS FOUNDATION**. Ще намерите приложени вашето споразумение за подкрепа, както и графика, детайлизиращ вашите вноски.',
        'summary'      => 'ОБОБЩЕНИЕ НА ВАШАТА ПОМОЩ',
        'ref'          => 'Референция на досието',
        'amount'       => 'Отпусната сума',
        'duration'     => 'Срок',
        'months'       => 'месеца',
        'monthly'      => 'Месечна вноска',
        'rate'         => 'Такса за управление',
        'fees'         => 'Административни такси',
        'start'        => 'Първа вноска',
        'docs_title'   => 'ПРИЛОЖЕНИ ДОКУМЕНТИ',
        'doc_contract' => '📄 **Споразумение_{{ ref }}.pdf** — Вашето споразумение за подкрепа за внимателно прочитане',
        'doc_amort'    => '📊 **График_на_вноските_{{ ref }}.pdf** — Пълен месечен график на вноските',
        'next_title'   => 'СЛЕДВАЩИ СТЪПКИ',
        'next_1'       => '1. Прочетете внимателно приложеното споразумение.',
        'next_2'       => '2. Подпишете го и го изпратете обратно на нашия екип по имейл.',
        'next_3'       => '3. След получаването му ще ви изпратим банковите данни за превода на средствата.',
        'closing'      => 'Оставаме на разположение за всякакви въпроси.',
        'team'         => 'Екипът на ' . site_name(),
    ],
    'hu' => [
        'greeting'     => 'Tisztelt ' . $loan->name . '!',
        'intro'        => 'Ügyét sikeresen rögzítettük a **SOLIDARIS FOUNDATION**-nál. Mellékelten megtalálja támogatási megállapodását, valamint a havi befizetéseit részletező táblázatot.',
        'summary'      => 'TÁMOGATÁSÁNAK ÖSSZEFOGLALÓJA',
        'ref'          => 'Ügy referenciaszáma',
        'amount'       => 'Jóváhagyott összeg',
        'duration'     => 'Futamidő',
        'months'       => 'hónap',
        'monthly'      => 'Havi részlet',
        'rate'         => 'Kezelési díj',
        'fees'         => 'Adminisztrációs díjak',
        'start'        => 'Első befizetés dátuma',
        'docs_title'   => 'CSATOLT DOKUMENTUMOK',
        'doc_contract' => '📄 **Megallapodas_{{ ref }}.pdf** — Támogatási megállapodása, kérjük, figyelmesen olvassa el',
        'doc_amort'    => '📊 **Fizetesi_utemterv_{{ ref }}.pdf** — Teljes havi fizetési ütemterv',
        'next_title'   => 'KÖVETKEZŐ LÉPÉSEK',
        'next_1'       => '1. Olvassa el figyelmesen a mellékelt megállapodást.',
        'next_2'       => '2. Írja alá, és küldje vissza csapatunknak e-mailben.',
        'next_3'       => '3. A kézhezvétel után csapatunk elküldi Önnek a banki adatokat az összeg átutalásához.',
        'closing'      => 'Bármilyen kérdés esetén állunk rendelkezésére.',
        'team'         => 'A ' . site_name() . ' csapata',
    ],
    'it' => [
        'greeting'     => 'Gentile ' . $loan->name . ',',
        'intro'        => 'Abbiamo registrato con successo la tua pratica presso **SOLIDARIS FOUNDATION**. In allegato trovi il tuo accordo di sostegno e il piano con il dettaglio dei tuoi versamenti.',
        'summary'      => 'RIEPILOGO DEL TUO AIUTO',
        'ref'          => 'Riferimento pratica',
        'amount'       => 'Importo concesso',
        'duration'     => 'Durata',
        'months'       => 'mesi',
        'monthly'      => 'Versamento mensile',
        'rate'         => 'Tasso di gestione',
        'fees'         => 'Spese amministrative',
        'start'        => 'Data della prima scadenza',
        'docs_title'   => 'DOCUMENTI ALLEGATI',
        'doc_contract' => '📄 **Accordo_{{ ref }}.pdf** — Il tuo accordo di sostegno, da leggere attentamente',
        'doc_amort'    => '📊 **PianoVersamenti_{{ ref }}.pdf** — Piano mensile completo dei versamenti',
        'next_title'   => 'PROSSIMI PASSI',
        'next_1'       => '1. Leggi attentamente l\'accordo allegato.',
        'next_2'       => '2. Firmalo e restituiscilo al nostro team via email.',
        'next_3'       => '3. Una volta ricevuto, il nostro team ti invierà i dati bancari per il bonifico dei fondi.',
        'closing'      => 'Restiamo a tua disposizione per qualsiasi domanda.',
        'team'         => 'Il team ' . site_name(),
    ],
    'de' => [
        'greeting'     => 'Sehr geehrte Damen und Herren ' . $loan->name . ',',
        'intro'        => 'Wir haben Ihre Akte bei **SOLIDARIS FOUNDATION** erfasst. Anbei finden Sie Ihre Unterstützungsvereinbarung sowie den Zahlungsplan mit den Einzelheiten zu Ihren Zahlungen.',
        'summary'      => 'ZUSAMMENFASSUNG IHRER UNTERSTÜTZUNG',
        'ref'          => 'Aktenreferenz',
        'amount'       => 'Genehmigter Betrag',
        'duration'     => 'Laufzeit',
        'months'       => 'Monate',
        'monthly'      => 'Monatliche Zahlung',
        'rate'         => 'Bearbeitungsgebühr',
        'fees'         => 'Verwaltungsgebühren',
        'start'        => 'Erste Fälligkeit',
        'docs_title'   => 'ANHÄNGE',
        'doc_contract' => '📄 **Vereinbarung_{{ ref }}.pdf** — Ihre Unterstützungsvereinbarung, bitte aufmerksam lesen',
        'doc_amort'    => '📊 **Zahlungsplan_{{ ref }}.pdf** — Vollständiger monatlicher Zahlungsplan',
        'next_title'   => 'NÄCHSTE SCHRITTE',
        'next_1'       => '1. Lesen Sie die beigefügte Vereinbarung aufmerksam durch.',
        'next_2'       => '2. Unterschreiben Sie sie und senden Sie sie per E-Mail an unser Team zurück.',
        'next_3'       => '3. Nach Erhalt teilen wir Ihnen die Bankverbindung für die Auszahlung mit.',
        'closing'      => 'Wir stehen Ihnen für Fragen jederzeit zur Verfügung.',
        'team'         => 'Das ' . site_name() . '-Team',
    ],
    'lt' => [
        'greeting'     => 'Gerbiamas (-a) ' . $loan->name . ',',
        'intro'        => 'Jūsų byla sėkmingai užregistruota **SOLIDARIS FOUNDATION**. Pridedame jūsų paramos sutartį bei mokėjimų grafiką, kuriame nurodyti jūsų mėnesiniai mokėjimai.',
        'summary'      => 'JŪSŲ PARAMOS SANTRAUKA',
        'ref'          => 'Bylos numeris',
        'amount'       => 'Patvirtinta suma',
        'duration'     => 'Trukmė',
        'months'       => 'mėn.',
        'monthly'      => 'Mėnesinė įmoka',
        'rate'         => 'Aptarnavimo mokestis',
        'fees'         => 'Administraciniai mokesčiai',
        'start'        => 'Pirmoji įmoka',
        'docs_title'   => 'PRIDEDAMI DOKUMENTAI',
        'doc_contract' => '📄 **Sutartis_{{ ref }}.pdf** — Jūsų paramos sutartis, prašome atidžiai perskaityti',
        'doc_amort'    => '📊 **Mokejimu_grafikas_{{ ref }}.pdf** — Pilnas mėnesinis mokėjimų grafikas',
        'next_title'   => 'KITI ŽINGSNIAI',
        'next_1'       => '1. Atidžiai perskaitykite pridedamą sutartį.',
        'next_2'       => '2. Pasirašykite ją ir grąžinkite mūsų komandai el. paštu.',
        'next_3'       => '3. Gavus sutartį, jums bus atsiųsti banko duomenys lėšų pervedimui.',
        'closing'      => 'Esame pasirengę atsakyti į bet kokius jūsų klausimus.',
        'team'         => site_name() . ' komanda',
    ],
    'ro' => [
        'greeting'     => 'Stimate/Stimată ' . $loan->name . ',',
        'intro'        => 'Am înregistrat cu succes dosarul dumneavoastră la **SOLIDARIS FOUNDATION**. Veți găsi atașat acordul dumneavoastră de sprijin, precum și graficul de plăți cu detalierea sumelor dumneavoastră.',
        'summary'      => 'REZUMATUL AJUTORULUI DUMNEAVOASTRĂ',
        'ref'          => 'Referință dosar',
        'amount'       => 'Sumă acordată',
        'duration'     => 'Durată',
        'months'       => 'luni',
        'monthly'      => 'Rată lunară',
        'rate'         => 'Comision de gestiune',
        'fees'         => 'Taxe administrative',
        'start'        => 'Prima scadență',
        'docs_title'   => 'DOCUMENTE ATAȘATE',
        'doc_contract' => '📄 **Acord_{{ ref }}.pdf** — Acordul dumneavoastră de sprijin, vă rugăm să îl citiți cu atenție',
        'doc_amort'    => '📊 **Grafic_Plati_{{ ref }}.pdf** — Grafic lunar complet de plăți',
        'next_title'   => 'PAȘII URMĂTORI',
        'next_1'       => '1. Citiți cu atenție acordul atașat.',
        'next_2'       => '2. Semnați-l și trimiteți-l înapoi echipei noastre prin e-mail.',
        'next_3'       => '3. După primire, vă vom comunica datele bancare pentru virarea fondurilor.',
        'closing'      => 'Rămânem la dispoziția dumneavoastră pentru orice întrebare.',
        'team'         => 'Echipa ' . site_name(),
    ],
    'lv' => [
        'greeting'     => 'Godātais/Godātā ' . $loan->name . ',',
        'intro'        => 'Mēs esam veiksmīgi reģistrējuši jūsu lietu **SOLIDARIS FOUNDATION**. Pielikumā atradīsiet savu atbalsta līgumu, kā arī maksājumu grafiku ar jūsu ikmēneša maksājumu detaļām.',
        'summary'      => 'JŪSU ATBALSTA KOPSAVILKUMS',
        'ref'          => 'Lietas atsauce',
        'amount'       => 'Piešķirtā summa',
        'duration'     => 'Termiņš',
        'months'       => 'mēneši',
        'monthly'      => 'Ikmēneša maksājums',
        'rate'         => 'Apkalpošanas maksa',
        'fees'         => 'Administratīvās izmaksas',
        'start'        => 'Pirmais maksājuma termiņš',
        'docs_title'   => 'PIEVIENOTIE DOKUMENTI',
        'doc_contract' => '📄 **Ligums_{{ ref }}.pdf** — Jūsu atbalsta līgums, lūdzu, izlasiet to uzmanīgi',
        'doc_amort'    => '📊 **Maksajumu_grafiks_{{ ref }}.pdf** — Pilns ikmēneša maksājumu grafiks',
        'next_title'   => 'NĀKAMIE SOĻI',
        'next_1'       => '1. Uzmanīgi izlasiet pievienoto līgumu.',
        'next_2'       => '2. Parakstiet to un nosūtiet atpakaļ mūsu komandai pa e-pastu.',
        'next_3'       => '3. Pēc saņemšanas mēs jums nosūtīsim bankas rekvizītus līdzekļu pārskaitīšanai.',
        'closing'      => 'Esam jūsu rīcībā, ja rodas kādi jautājumi.',
        'team'         => site_name() . ' komanda',
    ],
    'nl' => [
        'greeting'     => 'Geachte heer/mevrouw ' . $loan->name . ',',
        'intro'        => 'Wij hebben uw dossier bij **SOLIDARIS FOUNDATION** succesvol geregistreerd. Bijgevoegd vindt u uw steunovereenkomst en het overzicht met de details van uw maandelijkse betalingen.',
        'summary'      => 'SAMENVATTING VAN UW STEUN',
        'ref'          => 'Dossierreferentie',
        'amount'       => 'Toegekend bedrag',
        'duration'     => 'Looptijd',
        'months'       => 'maanden',
        'monthly'      => 'Maandelijkse betaling',
        'rate'         => 'Beheervergoeding',
        'fees'         => 'Administratiekosten',
        'start'        => 'Eerste vervaldatum',
        'docs_title'   => 'BIJGEVOEGDE DOCUMENTEN',
        'doc_contract' => '📄 **Overeenkomst_{{ ref }}.pdf** — Uw steunovereenkomst, aandachtig te lezen',
        'doc_amort'    => '📊 **Betalingsschema_{{ ref }}.pdf** — Volledig maandelijks betalingsschema',
        'next_title'   => 'VOLGENDE STAPPEN',
        'next_1'       => '1. Lees de bijgevoegde overeenkomst aandachtig door.',
        'next_2'       => '2. Onderteken deze en stuur ze per e-mail terug naar ons team.',
        'next_3'       => '3. Zodra wij deze ontvangen hebben, ontvangt u de bankgegevens voor de uitbetaling van de middelen.',
        'closing'      => 'Wij staan u graag ter beschikking voor al uw vragen.',
        'team'         => 'Het ' . site_name() . ' Team',
    ],
];
$t   = $texts[$locale] ?? $texts['fr'];
$ref = $loan->reference;
@endphp

# {{ $t['greeting'] }}

{{ $t['intro'] }}

---

**{{ $t['summary'] }}**

| | |
|---|---|
| **{{ $t['ref'] }}** | {{ $loan->reference }} |
| **{{ $t['amount'] }}** | {{ number_format($loan->amount, 2, ',', ' ') }} {{ $loan->currency }} |
| **{{ $t['duration'] }}** | {{ $loan->darly }} {{ $t['months'] }} |
| **{{ $t['monthly'] }}** | {{ number_format($loan->monthly_payment, 2, ',', ' ') }} {{ $loan->currency }} |
| **{{ $t['rate'] }}** | {{ $loan->interest_rate }} % |
@if($loan->admin_fees)
| **{{ $t['fees'] }}** | {{ number_format($loan->admin_fees, 2, ',', ' ') }} {{ $loan->currency }} |
@endif
@if($loan->start_date)
| **{{ $t['start'] }}** | {{ $loan->start_date->format('d/m/Y') }} |
@endif

---

**{{ $t['docs_title'] }}**

{!! str_replace('{{ ref }}', $ref, $t['doc_contract']) !!}

{!! str_replace('{{ ref }}', $ref, $t['doc_amort']) !!}

---

> **{{ $t['next_title'] }}**
>
> {{ $t['next_1'] }}
>
> {{ $t['next_2'] }}
>
> {{ $t['next_3'] }}

{{ $t['closing'] }}

**{{ $t['team'] }}**

@endcomponent
