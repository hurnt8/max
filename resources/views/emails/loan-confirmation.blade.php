@php
$texts = [
    'fr' => [
        'title'      => 'Demande d\'aide reçue',
        'sub'        => site_name(),
        'greeting'   => 'Bonjour '.$data['name'].',',
        'body'       => 'Nous avons bien reçu votre demande d\'aide d\'un montant de <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. Elle est actuellement en cours de traitement par notre équipe.',
        'cond_title' => 'Conditions d\'éligibilité',
        'cond_body'  => 'Pour bénéficier d\'une aide, il faut être majeur et pouvoir présenter sa situation. Chaque dossier est examiné avec attention et bienveillance.',
        'btn_intro'  => 'Pour finaliser votre dossier, veuillez cliquer sur le bouton ci-dessous afin de nous transmettre votre adresse complète et une copie de votre pièce d\'identité.',
        'btn_label'  => 'Compléter ma demande',
        'footer'     => 'Nous vous contacterons dans les plus brefs délais. Merci de nous avoir fait confiance.',
        'noreply'    => 'Cet email a été envoyé depuis une adresse no-reply. Veuillez ne pas répondre directement.',
        'closing'    => 'Cordialement,',
        'team'       => 'L\'équipe ' . site_name(),
    ],
    'en' => [
        'title'      => 'Aid request received',
        'sub'        => site_name(),
        'greeting'   => 'Hello '.$data['name'].',',
        'body'       => 'We have received your aid request for <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. It is currently being processed by our team.',
        'cond_title' => 'Eligibility conditions',
        'cond_body'  => 'To receive aid, you must be of legal age and able to present your situation. Each case is reviewed with care and compassion.',
        'btn_intro'  => 'To finalise your case, please click the button below to send us your full address and a copy of your ID.',
        'btn_label'  => 'Complete my request',
        'footer'     => 'We will contact you as soon as possible. Thank you for trusting us.',
        'noreply'    => 'This email was sent from a no-reply address. Please do not reply directly.',
        'closing'    => 'Best regards,',
        'team'       => 'The ' . site_name() . ' team',
    ],
    'es' => [
        'title'      => 'Solicitud de ayuda recibida',
        'sub'        => site_name(),
        'greeting'   => 'Hola '.$data['name'].',',
        'body'       => 'Hemos recibido su solicitud de ayuda por <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. Actualmente está siendo procesada por nuestro equipo.',
        'cond_title' => 'Condiciones de elegibilidad',
        'cond_body'  => 'Para recibir una ayuda, es necesario ser mayor de edad y poder presentar su situación. Cada expediente se examina con atención y consideración.',
        'btn_intro'  => 'Para finalizar su expediente, haga clic en el botón para enviarnos su dirección completa y una copia de su documento de identidad.',
        'btn_label'  => 'Completar mi solicitud',
        'footer'     => 'Nos pondremos en contacto con usted lo antes posible. Gracias por su confianza.',
        'noreply'    => 'Este email fue enviado desde una dirección de no respuesta. No responda directamente.',
        'closing'    => 'Atentamente,',
        'team'       => 'El equipo ' . site_name(),
    ],
    'pl' => [
        'title'      => 'Wniosek o pomoc otrzymany',
        'sub'        => site_name(),
        'greeting'   => 'Witaj '.$data['name'].',',
        'body'       => 'Otrzymaliśmy Twój wniosek o pomoc na kwotę <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. Jest on aktualnie rozpatrywany przez nasz zespół.',
        'cond_title' => 'Warunki kwalifikowalności',
        'cond_body'  => 'Aby otrzymać pomoc, należy być pełnoletnim i móc przedstawić swoją sytuację. Każda sprawa jest rozpatrywana z uwagą i życzliwością.',
        'btn_intro'  => 'Aby sfinalizować swoją sprawę, kliknij poniższy przycisk, aby przesłać nam swój pełny adres i kopię dokumentu tożsamości.',
        'btn_label'  => 'Uzupełnij mój wniosek',
        'footer'     => 'Skontaktujemy się z Tobą jak najszybciej. Dziękujemy za zaufanie.',
        'noreply'    => 'Ten email został wysłany z adresu no-reply. Prosimy nie odpowiadać bezpośrednio.',
        'closing'    => 'Z poważaniem,',
        'team'       => 'Zespół ' . site_name(),
    ],
    'bg' => [
        'title'      => 'Заявка за помощ получена',
        'sub'        => site_name(),
        'greeting'   => 'Здравейте '.$data['name'].',',
        'body'       => 'Получихме вашата заявка за помощ в размер на <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. В момента тя се обработва от нашия екип.',
        'cond_title' => 'Условия за допустимост',
        'cond_body'  => 'За да получите помощ, трябва да сте пълнолетни и да можете да представите вашата ситуация. Всяко досие се разглежда внимателно и с грижа.',
        'btn_intro'  => 'За да финализирате досието си, моля натиснете бутона по-долу, за да ни предоставите пълния си адрес и копие от документ за самоличност.',
        'btn_label'  => 'Завърши заявката ми',
        'footer'     => 'Ще се свържем с вас възможно най-скоро. Благодарим ви за доверието.',
        'noreply'    => 'Този имейл беше изпратен от адрес без отговор (no-reply). Моля, не отговаряйте директно.',
        'closing'    => 'С уважение,',
        'team'       => 'Екипът на ' . site_name(),
    ],
    'hu' => [
        'title'      => 'Támogatási kérelem beérkezett',
        'sub'        => site_name(),
        'greeting'   => 'Üdvözöljük '.$data['name'].',',
        'body'       => 'Megkaptuk <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> összegű támogatási kérelmét. Jelenleg csapatunk dolgozza fel.',
        'cond_title' => 'Jogosultsági feltételek',
        'cond_body'  => 'A támogatás igénybevételéhez nagykorúnak kell lennie, és képesnek kell lennie bemutatni helyzetét. Minden ügyet figyelemmel és jóindulattal vizsgálunk meg.',
        'btn_intro'  => 'Az ügye véglegesítéséhez kérjük, kattintson az alábbi gombra, hogy megadja teljes címét és személyazonosító okmányának másolatát.',
        'btn_label'  => 'Kérelmem befejezése',
        'footer'     => 'A lehető leghamarabb felvesszük Önnel a kapcsolatot. Köszönjük bizalmát.',
        'noreply'    => 'Ezt az e-mailt egy no-reply címről küldtük. Kérjük, ne válaszoljon közvetlenül.',
        'closing'    => 'Tisztelettel,',
        'team'       => 'A ' . site_name() . ' csapata',
    ],
    'it' => [
        'title'      => 'Richiesta di aiuto ricevuta',
        'sub'        => site_name(),
        'greeting'   => 'Ciao '.$data['name'].',',
        'body'       => 'Abbiamo ricevuto la tua richiesta di aiuto di <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. È attualmente in fase di elaborazione da parte del nostro team.',
        'cond_title' => 'Condizioni di ammissibilità',
        'cond_body'  => 'Per beneficiare di un aiuto, è necessario essere maggiorenni e poter presentare la propria situazione. Ogni pratica viene esaminata con attenzione e sensibilità.',
        'btn_intro'  => 'Per finalizzare la tua pratica, ti preghiamo di cliccare sul pulsante qui sotto per inviarci il tuo indirizzo completo e una copia del tuo documento d\'identità.',
        'btn_label'  => 'Completa la mia richiesta',
        'footer'     => 'Ti contatteremo il prima possibile. Grazie per la fiducia accordataci.',
        'noreply'    => 'Questa email è stata inviata da un indirizzo no-reply. Ti preghiamo di non rispondere direttamente.',
        'closing'    => 'Cordiali saluti,',
        'team'       => 'Il team ' . site_name(),
    ],
    'de' => [
        'title'      => 'Antrag auf Unterstützung eingegangen',
        'sub'        => site_name(),
        'greeting'   => 'Guten Tag '.$data['name'].',',
        'body'       => 'Wir haben Ihren Antrag auf Unterstützung über <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> erhalten. Er wird derzeit von unserem Team bearbeitet.',
        'cond_title' => 'Voraussetzungen',
        'cond_body'  => 'Um Unterstützung zu erhalten, müssen Sie volljährig sein und Ihre Situation darlegen können. Jeder Fall wird sorgfältig und mit Wohlwollen geprüft.',
        'btn_intro'  => 'Um Ihren Antrag abzuschließen, klicken Sie bitte auf die Schaltfläche unten, um uns Ihre vollständige Adresse und eine Kopie Ihres Ausweisdokuments zu übermitteln.',
        'btn_label'  => 'Meinen Antrag vervollständigen',
        'footer'     => 'Wir werden uns so schnell wie möglich bei Ihnen melden. Vielen Dank für Ihr Vertrauen.',
        'noreply'    => 'Diese E-Mail wurde von einer no-reply-Adresse gesendet. Bitte antworten Sie nicht direkt auf diese Nachricht.',
        'closing'    => 'Mit freundlichen Grüßen,',
        'team'       => 'Das ' . site_name() . '-Team',
    ],
    'lt' => [
        'title'      => 'Pagalbos prašymas gautas',
        'sub'        => site_name(),
        'greeting'   => 'Sveiki, '.$data['name'].',',
        'body'       => 'Gavome jūsų pagalbos prašymą <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> sumai. Šiuo metu jį nagrinėja mūsų komanda.',
        'cond_title' => 'Reikalavimai',
        'cond_body'  => 'Norint gauti pagalbą, būtina būti sulaukusiam pilnametystės ir galėti pristatyti savo situaciją. Kiekviena byla nagrinėjama atidžiai ir su rūpesčiu.',
        'btn_intro'  => 'Norėdami užbaigti savo bylą, spustelėkite žemiau esantį mygtuką ir pateikite mums pilną adresą bei asmens tapatybės dokumento kopiją.',
        'btn_label'  => 'Užbaigti prašymą',
        'footer'     => 'Susisieksime su jumis kuo greičiau. Dėkojame, kad pasitikite mumis.',
        'noreply'    => 'Šis el. laiškas išsiųstas iš no-reply adreso. Prašome tiesiogiai neatsakyti į šį pranešimą.',
        'closing'    => 'Pagarbiai,',
        'team'       => site_name() . ' komanda',
    ],
    'ro' => [
        'title'      => 'Cerere de ajutor primită',
        'sub'        => site_name(),
        'greeting'   => 'Bună ziua, '.$data['name'].',',
        'body'       => 'Am primit cererea dumneavoastră de ajutor în valoare de <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. Aceasta este în prezent în curs de procesare de către echipa noastră.',
        'cond_title' => 'Condiții de eligibilitate',
        'cond_body'  => 'Pentru a beneficia de ajutor, trebuie să fiți major și să puteți prezenta situația dumneavoastră. Fiecare dosar este examinat cu atenție și bunăvoință.',
        'btn_intro'  => 'Pentru a finaliza dosarul dumneavoastră, vă rugăm să faceți clic pe butonul de mai jos pentru a ne transmite adresa dumneavoastră completă și o copie a actului de identitate.',
        'btn_label'  => 'Completează cererea mea',
        'footer'     => 'Vă vom contacta în cel mai scurt timp. Vă mulțumim pentru încrederea acordată.',
        'noreply'    => 'Acest e-mail a fost trimis de la o adresă no-reply. Vă rugăm să nu răspundeți direct la acest mesaj.',
        'closing'    => 'Cu stimă,',
        'team'       => 'Echipa ' . site_name(),
    ],
    'lv' => [
        'title'      => 'Palīdzības pieprasījums saņemts',
        'sub'        => site_name(),
        'greeting'   => 'Sveiki, '.$data['name'].',',
        'body'       => 'Mēs esam saņēmuši jūsu palīdzības pieprasījumu par summu <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. To pašlaik izskata mūsu komanda.',
        'cond_title' => 'Atbilstības nosacījumi',
        'cond_body'  => 'Lai saņemtu palīdzību, jums jābūt pilngadīgam un jāspēj izklāstīt savu situāciju. Katrs gadījums tiek izskatīts rūpīgi un ar sapratni.',
        'btn_intro'  => 'Lai pabeigtu jūsu lietas noformēšanu, lūdzu, noklikšķiniet uz zemāk esošās pogas, lai nosūtītu mums savu pilno adresi un personu apliecinoša dokumenta kopiju.',
        'btn_label'  => 'Papildināt manu pieprasījumu',
        'footer'     => 'Mēs ar jums sazināsimies pēc iespējas ātrāk. Paldies par uzticēšanos.',
        'noreply'    => 'Šis e-pasts ir nosūtīts no adreses, uz kuru netiek pieņemtas atbildes. Lūdzu, neatbildiet tieši uz šo ziņojumu.',
        'closing'    => 'Ar cieņu,',
        'team'       => site_name() . ' komanda',
    ],
    'nl' => [
        'title'      => 'Hulpaanvraag ontvangen',
        'sub'        => site_name(),
        'greeting'   => 'Hallo '.$data['name'].',',
        'body'       => 'Wij hebben uw hulpaanvraag van <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong> in goede orde ontvangen. Deze wordt momenteel door ons team verwerkt.',
        'cond_title' => 'Toelatingsvoorwaarden',
        'cond_body'  => 'Om hulp te ontvangen, moet u meerderjarig zijn en uw situatie kunnen toelichten. Elk dossier wordt met aandacht en zorg behandeld.',
        'btn_intro'  => 'Om uw dossier af te ronden, klikt u op onderstaande knop om ons uw volledige adres en een kopie van uw identiteitsbewijs te bezorgen.',
        'btn_label'  => 'Mijn aanvraag voltooien',
        'footer'     => 'Wij nemen zo spoedig mogelijk contact met u op. Bedankt voor uw vertrouwen.',
        'noreply'    => 'Deze e-mail is verzonden vanaf een no-reply-adres. Gelieve niet rechtstreeks te antwoorden.',
        'closing'    => 'Met vriendelijke groet,',
        'team'       => 'Het ' . site_name() . ' Team',
    ],
    'pt' => [
        'title'      => 'Pedido de ajuda recebido',
        'sub'        => site_name(),
        'greeting'   => 'Olá '.$data['name'].',',
        'body'       => 'Recebemos o seu pedido de ajuda no montante de <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. Está atualmente a ser processado pela nossa equipa.',
        'cond_title' => 'Condições de elegibilidade',
        'cond_body'  => 'Para beneficiar de uma ajuda, é necessário ser maior de idade e poder apresentar a sua situação. Cada processo é analisado com atenção e cuidado.',
        'btn_intro'  => 'Para finalizar o seu processo, clique no botão abaixo para nos enviar a sua morada completa e uma cópia do seu documento de identificação.',
        'btn_label'  => 'Completar o meu pedido',
        'footer'     => 'Entraremos em contacto consigo o mais brevemente possível. Obrigado pela sua confiança.',
        'noreply'    => 'Este email foi enviado a partir de um endereço no-reply. Não responda diretamente.',
        'closing'    => 'Atenciosamente,',
        'team'       => 'A equipa ' . site_name(),
    ],
    'hr' => [
        'title'      => 'Zahtjev za pomoć primljen',
        'sub'        => site_name(),
        'greeting'   => 'Pozdrav '.$data['name'].',',
        'body'       => 'Zaprimili smo vaš zahtjev za pomoć u iznosu od <strong>'.number_format($data['amount'], 0, ',', ' ').' '.($data['currency'] ?? 'EUR').'</strong>. Trenutno ga obrađuje naš tim.',
        'cond_title' => 'Uvjeti prihvatljivosti',
        'cond_body'  => 'Za dobivanje pomoći potrebno je biti punoljetan i moći predstaviti svoju situaciju. Svaki predmet pažljivo i s razumijevanjem razmatramo.',
        'btn_intro'  => 'Za dovršetak vašeg zahtjeva kliknite na gumb ispod kako biste nam poslali svoju punu adresu i presliku osobne iskaznice.',
        'btn_label'  => 'Dovrši moj zahtjev',
        'footer'     => 'Kontaktirat ćemo vas u najkraćem mogućem roku. Hvala vam na povjerenju.',
        'noreply'    => 'Ova e-poruka poslana je s adrese na koju se ne odgovara (no-reply). Molimo ne odgovarajte izravno.',
        'closing'    => 'S poštovanjem,',
        'team'       => 'Tim ' . site_name(),
    ],
];
$t = $texts[$lang] ?? $texts['fr'];
@endphp

<x-email-layout
    :title="$t['title']"
    :subtitle="$t['sub']"
    accent="teal"
    :footerNote="$t['noreply']"
>

  <p class="greeting">{{ $t['greeting'] }}</p>

  <p class="body-text">{!! $t['body'] !!}</p>

  <div class="alert alert-info">
    <strong>{{ $t['cond_title'] }}</strong>
    <p>{{ $t['cond_body'] }}</p>
  </div>

  <p class="body-text">{{ $t['btn_intro'] }}</p>

  <div class="btn-wrap">
    <a href="{{ $data['complete_url'] }}" class="btn">{{ $t['btn_label'] }}</a>
  </div>

  <p class="body-text">{{ $t['footer'] }}</p>

  <p class="closing">
    {{ $t['closing'] }}<br>
    <strong>{{ $t['team'] }}</strong>
  </p>

</x-email-layout>
