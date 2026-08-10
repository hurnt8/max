@php
$texts = [
    'fr' => ['title'=>'Nouveau message support','sub'=>'Support Solberg Grupo','intro'=>'vous a envoyé un message via le support Solberg Grupo.','lbl_date'=>'Reçu le','btn'=>'Répondre au client','closing'=>'Cordialement,','team'=>"L'équipe Solberg Grupo"],
    'en' => ['title'=>'New support message','sub'=>'Solberg Grupo Support','intro'=>'sent you a message via Solberg Grupo support.','lbl_date'=>'Received on','btn'=>'Reply to client','closing'=>'Best regards,','team'=>'The Solberg Grupo team'],
    'es' => ['title'=>'Nuevo mensaje de soporte','sub'=>'Soporte Solberg Grupo','intro'=>'le ha enviado un mensaje a través del soporte de Solberg Grupo.','lbl_date'=>'Recibido el','btn'=>'Responder al cliente','closing'=>'Atentamente,','team'=>'El equipo Solberg Grupo'],
    'pl' => ['title'=>'Nowa wiadomość wsparcia','sub'=>'Wsparcie Solberg Grupo','intro'=>'wysłał(a) Ci wiadomość przez wsparcie Solberg Grupo.','lbl_date'=>'Otrzymano','btn'=>'Odpowiedz klientowi','closing'=>'Z poważaniem,','team'=>'Zespół Solberg Grupo'],
    'bg' => ['title'=>'Ново съобщение за поддръжка','sub'=>'Поддръжка Solberg Grupo','intro'=>'ви изпрати съобщение чрез поддръжката на Solberg Grupo.','lbl_date'=>'Получено на','btn'=>'Отговори на клиента','closing'=>'С уважение,','team'=>'Екипът на Solberg Grupo'],
    'hu' => ['title'=>'Új ügyfélszolgálati üzenet','sub'=>'Solberg Grupo ügyfélszolgálat','intro'=>'üzenetet küldött Önnek a Solberg Grupo ügyfélszolgálaton keresztül.','lbl_date'=>'Beérkezett','btn'=>'Válasz az ügyfélnek','closing'=>'Tisztelettel,','team'=>'A Solberg Grupo csapata'],
    'it' => ['title'=>'Nuovo messaggio di assistenza','sub'=>'Assistenza Solberg Grupo','intro'=>'ti ha inviato un messaggio tramite l\'assistenza Solberg Grupo.','lbl_date'=>'Ricevuto il','btn'=>'Rispondi al cliente','closing'=>'Cordiali saluti,','team'=>'Il team Solberg Grupo'],
    'de' => ['title'=>'Neue Support-Nachricht','sub'=>'Solberg Grupo Support','intro'=>'hat Ihnen über den Solberg Grupo Support eine Nachricht gesendet.','lbl_date'=>'Empfangen am','btn'=>'Kunde antworten','closing'=>'Mit freundlichen Grüßen,','team'=>'Das Solberg-Grupo-Team'],
    'lt' => ['title'=>'Naujas pagalbos pranešimas','sub'=>'Solberg Grupo pagalba','intro'=>'jums atsiuntė žinutę per Solberg Grupo pagalbos tarnybą.','lbl_date'=>'Gauta','btn'=>'Atsakyti klientui','closing'=>'Pagarbiai,','team'=>'Solberg Grupo komanda'],
    'ro' => ['title'=>'Mesaj nou de suport','sub'=>'Suport Solberg Grupo','intro'=>'v-a trimis un mesaj prin suportul Solberg Grupo.','lbl_date'=>'Primit la','btn'=>'Răspunde clientului','closing'=>'Cu stimă,','team'=>'Echipa Solberg Grupo'],
    'lv' => ['title'=>'Jauns atbalsta ziņojums','sub'=>'Solberg Grupo atbalsts','intro'=>'jums nosūtīja ziņojumu, izmantojot Solberg Grupo atbalstu.','lbl_date'=>'Saņemts','btn'=>'Atbildēt klientam','closing'=>'Ar cieņu,','team'=>'Solberg Grupo komanda'],
    'nl' => ['title'=>'Nieuw supportbericht','sub'=>'Solberg Grupo Support','intro'=>'heeft u een bericht gestuurd via de Solberg Grupo-support.','lbl_date'=>'Ontvangen op','btn'=>'Klant beantwoorden','closing'=>'Met vriendelijke groet,','team'=>'Het team van Solberg Grupo'],
    'pt' => ['title'=>'Nova mensagem de suporte','sub'=>'Suporte Solberg Grupo','intro'=>'enviou-lhe uma mensagem através do suporte Solberg Grupo.','lbl_date'=>'Recebido em','btn'=>'Responder ao cliente','closing'=>'Atenciosamente,','team'=>'A equipa Solberg Grupo'],
    'hr' => ['title'=>'Nova poruka podrške','sub'=>'Podrška Solberg Grupo','intro'=>'poslao/la vam je poruku putem podrške Solberg Grupo.','lbl_date'=>'Primljeno dana','btn'=>'Odgovori klijentu','closing'=>'S poštovanjem,','team'=>'Tim Solberg Grupo'],
];
$t = $texts[$locale ?? 'fr'] ?? $texts['fr'];
@endphp
<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="teal"
>

  <p class="greeting">
    <strong>{{ $client->name }}</strong> {{ $t['intro'] }}
  </p>

  <div class="panel">
    <div class="panel-row" style="flex-direction:column;align-items:flex-start;gap:4px">
      <span class="panel-val" style="text-align:left;font-weight:400">{{ $message->body }}</span>
    </div>
  </div>

  <div class="btn-wrap">
    <a href="{{ url('/admin/support/' . $client->id) }}" class="btn">{{ $t['btn'] }}</a>
  </div>

  <p class="body-text">{{ $t['lbl_date'] }} {{ $message->created_at->format('d/m/Y H:i') }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
