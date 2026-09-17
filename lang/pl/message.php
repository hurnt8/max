<?php

return [
    'success_contact' => 'Wiadomość została wysłana pomyślnie',
    'success_sbscribe' => 'Subskrypcja zakończona pomyślnie',
    'error' => 'Wystąpił błąd podczas wysyłania. Spróbuj ponownie później.',
    'success_loan' => 'Twój wniosek o pomoc został wysłany pomyślnie. Odpowiemy tak szybko, jak to możliwe.',
    'error_loan' => 'Wystąpił błąd podczas wysyłania wniosku o pomoc. Spróbuj ponownie później.',

    // Emaile dotyczące wniosku o pomoc
    'months'               => 'miesięcy',
    'month_abbr'           => 'mies.',
    'optional'             => 'opcjonalne',
    'loan_admin_subject'   => 'Nowy wniosek o pomoc',
    'loan_admin_intro'     => 'Osoba właśnie przesłała wniosek o pomoc za pośrednictwem strony ' . site_name() . '.',

    'loan_confirm_subject'   => 'Twój wniosek o pomoc jest przetwarzany',
    'loan_confirm_greeting'  => 'Witaj :name,',
    'loan_confirm_body'      => 'Otrzymaliśmy Twój wniosek o pomoc na kwotę :amount :currency na okres :duration miesięcy. Jest on obecnie przetwarzany przez nasz zespół.',
    'loan_confirm_footer'    => 'Skontaktujemy się z Tobą tak szybko, jak to możliwe. Dziękujemy za zaufanie.',
    'loan_confirm_signature' => 'Zespół ' . site_name(),
    'loan_confirm_noreply'   => 'Ta wiadomość została wysłana z adresu no-reply. Prosimy nie odpowiadać bezpośrednio na tę wiadomość.',
    'no_reply_notice' => 'To jest automatycznie wygenerowana wiadomość e-mail. Prosimy na nią nie odpowiadać.',

    'loan_conditions_title'  => 'Warunki kwalifikowalności',
    'loan_conditions_text'   => 'Aby otrzymać pomoc, należy być pełnoletnim i móc przedstawić swoją sytuację. Każdy wniosek jest rozpatrywany z uwagą i życzliwością.',
    'loan_complete_btn'      => 'Uzupełnij wniosek',
    'loan_complete_intro'    => 'Aby sfinalizować wniosek, kliknij poniższy przycisk i prześlij swój pełny adres oraz kopię dokumentu tożsamości.',

    'docs_subject'   => 'Dokumenty — Wniosek o pomoc',
    'docs_intro'     => 'Osoba przesłała dokumenty w celu uzupełnienia wniosku o pomoc.',
    'docs_name'      => 'Imię i nazwisko',
    'docs_email'     => 'Email',
    'docs_address'   => 'Adres',
    'docs_tax_number' => 'Numer podatkowy',
    'docs_activity'  => 'Wykonywany zawód',
    'docs_id_photo'  => 'Dokument tożsamości',
    'docs_doc_type'  => 'Rodzaj dokumentu',
    'docs_recto'     => 'Strona przednia',
    'docs_verso'     => 'Strona tylna',
    'docs_success'   => 'Twoje dokumenty zostały wysłane. Nasz zespół przejrzy je jak najszybciej.',
    'docs_already_sent' => 'Twoje dokumenty zostały już wysłane lub formularz wygasł. Jeśli chcesz przesłać dokumenty ponownie, odśwież tę stronę.',

    'doc_type_id_card'   => 'Dowód osobisty',
    'doc_type_passport'  => 'Paszport',
    'doc_type_license'   => 'Prawo jazdy',
    'doc_type_residence' => 'Karta pobytu',
    'doc_type_other'     => 'Inny dokument',

    'docs_confirm_subject'   => 'Twoje dokumenty zostały otrzymane',
    'docs_confirm_greeting'  => 'Witaj :name,',
    'docs_confirm_body'      => 'Otrzymaliśmy Twoje dokumenty (adres i dokument tożsamości). Nasz zespół przejrzy je i skontaktuje się z Tobą w ciągu 24 godzin.',
    'docs_confirm_footer'    => 'Dziękujemy za zaufanie i pozostajemy do Twojej dyspozycji w razie pytań.',
    'docs_confirm_signature' => 'Zespół ' . site_name(),

    'docs_upload_hint'  => 'Przeciągnij i upuść lub kliknij, aby wybrać plik',
    'docs_single_photo' => 'W przypadku tego rodzaju dokumentu wystarczy jedno zdjęcie.',
];
