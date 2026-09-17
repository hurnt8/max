<?php

return [
    'success_contact' => 'üzenet sikeresen elküldve',
    'success_sbscribe' => 'Az előfizetés sikeresen befejeződött',
    'error' => 'Hiba történt a küldés során. Kérjük, próbálja újra később.',
    'success_loan' => 'Segélykérelmét sikeresen elküldtük. A lehető leghamarabb választ adunk.',
    'error_loan' => 'Hiba történt segélykérelme elküldése közben. Kérjük, próbálja újra később.',

    // Segélykérelem e-mailek
    'months'               => 'hónap',
    'month_abbr'           => 'hó',
    'optional'             => 'opcionális',
    'loan_admin_subject'   => 'Új segélykérelem',
    'loan_admin_intro'     => 'Valaki most nyújtott be segélykérelmet a ' . site_name() . ' weboldalán keresztül.',

    'loan_confirm_subject'   => 'Segélykérelme feldolgozás alatt áll',
    'loan_confirm_greeting'  => 'Üdvözöljük, :name,',
    'loan_confirm_body'      => 'Megkaptuk :amount :currency összegű, :duration hónapra vonatkozó segélykérelmét. Jelenleg csapatunk dolgozza fel.',
    'loan_confirm_footer'    => 'A lehető leghamarabb felvesszük Önnel a kapcsolatot. Köszönjük, hogy megbízott bennünk.',
    'loan_confirm_signature' => 'A ' . site_name() . ' csapata',
    'loan_confirm_noreply'   => 'Ezt az e-mailt egy no-reply címről küldtük. Kérjük, ne válaszoljon közvetlenül erre az üzenetre.',
    'no_reply_notice' => 'Ez egy automatikusan generált e-mail. Kérjük, ne válaszoljon rá.',

    'loan_conditions_title'  => 'Jogosultsági feltételek',
    'loan_conditions_text'   => 'Segélyben való részesüléshez elegendő nagykorúnak lenni, és képesnek kell lennie bemutatni a helyzetét. Minden ügyet körültekintően és jóindulattal vizsgálunk meg.',
    'loan_complete_btn'      => 'Kérelmem befejezése',
    'loan_complete_intro'    => 'Az ügye véglegesítéséhez kérjük, kattintson az alábbi gombra, hogy megadja teljes címét és személyazonosító okmányának másolatát.',

    'docs_subject'   => 'Dokumentumok — Segélykérelem',
    'docs_intro'     => 'A kérelmező elküldte dokumentumait segélykérelme kiegészítéséhez.',
    'docs_name'      => 'Név',
    'docs_email'     => 'E-mail',
    'docs_address'   => 'Cím',
    'docs_tax_number' => 'Adószám',
    'docs_activity'  => 'Foglalkozás',
    'docs_id_photo'  => 'Személyazonosító okmány / dokumentum',
    'docs_doc_type'  => 'Dokumentum típusa',
    'docs_recto'     => 'Előlap',
    'docs_verso'     => 'Hátlap',
    'docs_success'       => 'Dokumentumait elküldtük. Csapatunk a lehető leghamarabb megvizsgálja azokat.',
    'docs_already_sent'  => 'Dokumentumait már elküldte, vagy az űrlap lejárt. Ha újra el szeretné küldeni dokumentumait, kérjük, töltse újra ezt az oldalt.',

    'doc_type_id_card'   => 'Személyi igazolvány',
    'doc_type_passport'  => 'Útlevél',
    'doc_type_license'   => 'Vezetői engedély',
    'doc_type_residence' => 'Tartózkodási engedély',
    'doc_type_other'     => 'Egyéb dokumentum',

    'docs_confirm_subject'   => 'Dokumentumait sikeresen megkaptuk',
    'docs_confirm_greeting'  => 'Üdvözöljük, :name,',
    'docs_confirm_body'      => 'Megkaptuk dokumentumait (cím és személyazonosító okmány). Csapatunk megvizsgálja azokat, és 24 órán belül visszajelzést ad.',
    'docs_confirm_footer'    => 'Köszönjük bizalmát, és bármilyen kérdés esetén állunk rendelkezésére.',
    'docs_confirm_signature' => 'A ' . site_name() . ' csapata',

    'docs_upload_hint'  => 'Húzza ide, vagy kattintson a fájl kiválasztásához',
    'docs_single_photo' => 'Ehhez a dokumentumtípushoz egyetlen fénykép is elegendő.',
];
