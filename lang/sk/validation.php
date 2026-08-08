<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Pole :attribute musí byť akceptované.',
    'accepted_if' => 'Pole :attribute musí byť akceptované, ak :other je :value.',
    'active_url' => 'Pole :attribute musí byť platná URL adresa.',
    'after' => 'Pole :attribute musí byť dátum po :date.',
    'after_or_equal' => 'Pole :attribute musí byť dátum po alebo rovný :date.',
    'alpha' => 'Pole :attribute môže obsahovať iba písmená.',
    'alpha_dash' => 'Pole :attribute môže obsahovať iba písmená, čísla, pomlčky a podčiarkovníky.',
    'alpha_num' => 'Pole :attribute môže obsahovať iba písmená a čísla.',
    'array' => 'Pole :attribute musí byť pole (array).',
    'ascii' => 'Pole :attribute môže obsahovať iba jednobajtové alfanumerické znaky a symboly.',
    'before' => 'Pole :attribute musí byť dátum pred :date.',
    'before_or_equal' => 'Pole :attribute musí byť dátum pred alebo rovný :date.',
    'between' => [
        'array' => 'Pole :attribute musí obsahovať od :min do :max položiek.',
        'file' => 'Pole :attribute musí mať veľkosť od :min do :max kilobajtov.',
        'numeric' => 'Pole :attribute musí byť medzi :min a :max.',
        'string' => 'Pole :attribute musí mať od :min do :max znakov.',
    ],
    'boolean' => 'Pole :attribute musí byť true alebo false.',
    'can' => 'Pole :attribute obsahuje neautorizovanú hodnotu.',
    'confirmed' => 'Potvrdenie poľa :attribute sa nezhoduje.',
    'current_password' => 'Heslo je nesprávne.',
    'date' => 'Pole :attribute musí byť platný dátum.',
    'date_equals' => 'Pole :attribute musí byť dátum rovný :date.',
    'date_format' => 'Pole :attribute musí zodpovedať formátu :format.',
    'decimal' => 'Pole :attribute musí mať :decimal desatinných miest.',
    'declined' => 'Pole :attribute musí byť zamietnuté.',
    'declined_if' => 'Pole :attribute musí byť zamietnuté, ak :other je :value.',
    'different' => 'Polia :attribute a :other sa musia líšiť.',
    'digits' => 'Pole :attribute musí mať :digits číslic.',
    'digits_between' => 'Pole :attribute musí mať od :min do :max číslic.',
    'dimensions' => 'Pole :attribute má neplatné rozmery obrázka.',
    'distinct' => 'Pole :attribute obsahuje duplicitnú hodnotu.',
    'doesnt_end_with' => 'Pole :attribute nesmie končiť jednou z nasledujúcich hodnôt: :values.',
    'doesnt_start_with' => 'Pole :attribute nesmie začínať jednou z nasledujúcich hodnôt: :values.',
    'email' => 'Pole :attribute musí byť platná emailová adresa.',
    'ends_with' => 'Pole :attribute musí končiť jednou z nasledujúcich hodnôt: :values.',
    'enum' => 'Vybraná hodnota poľa :attribute je neplatná.',
    'exists' => 'Vybraná hodnota poľa :attribute je neplatná.',
    'extensions' => 'Pole :attribute musí mať jednu z nasledujúcich prípon: :values.',
    'file' => 'Pole :attribute musí byť súbor.',
    'filled' => 'Pole :attribute musí mať hodnotu.',
    'gt' => [
        'array' => 'Pole :attribute musí obsahovať viac ako :value položiek.',
        'file' => 'Pole :attribute musí byť väčšie ako :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť väčšie ako :value.',
        'string' => 'Pole :attribute musí mať viac ako :value znakov.',
    ],
    'gte' => [
        'array' => 'Pole :attribute musí obsahovať :value alebo viac položiek.',
        'file' => 'Pole :attribute musí byť väčšie alebo rovné :value kilobajtom.',
        'numeric' => 'Pole :attribute musí byť väčšie alebo rovné :value.',
        'string' => 'Pole :attribute musí mať :value alebo viac znakov.',
    ],
    'hex_color' => 'Pole :attribute musí byť platná hexadecimálna farba.',
    'image' => 'Pole :attribute musí byť obrázok.',
    'in' => 'Vybraná hodnota poľa :attribute je neplatná.',
    'in_array' => 'Pole :attribute sa musí nachádzať v :other.',
    'integer' => 'Pole :attribute musí byť celé číslo.',
    'ip' => 'Pole :attribute musí byť platná IP adresa.',
    'ipv4' => 'Pole :attribute musí byť platná IPv4 adresa.',
    'ipv6' => 'Pole :attribute musí byť platná IPv6 adresa.',
    'json' => 'Pole :attribute musí byť platný reťazec JSON.',
    'lowercase' => 'Pole :attribute musí byť malými písmenami.',
    'lt' => [
        'array' => 'Pole :attribute musí obsahovať menej ako :value položiek.',
        'file' => 'Pole :attribute musí byť menšie ako :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť menšie ako :value.',
        'string' => 'Pole :attribute musí mať menej ako :value znakov.',
    ],
    'lte' => [
        'array' => 'Pole :attribute nesmie obsahovať viac ako :value položiek.',
        'file' => 'Pole :attribute musí byť menšie alebo rovné :value kilobajtom.',
        'numeric' => 'Pole :attribute musí byť menšie alebo rovné :value.',
        'string' => 'Pole :attribute musí mať :value alebo menej znakov.',
    ],
    'mac_address' => 'Pole :attribute musí byť platná MAC adresa.',
    'max' => [
        'array' => 'Pole :attribute nesmie obsahovať viac ako :max položiek.',
        'file' => 'Pole :attribute nesmie byť väčšie ako :max kilobajtov.',
        'numeric' => 'Pole :attribute nesmie byť väčšie ako :max.',
        'string' => 'Pole :attribute nesmie mať viac ako :max znakov.',
    ],
    'max_digits' => 'Pole :attribute nesmie mať viac ako :max číslic.',
    'mimes' => 'Pole :attribute musí byť súbor typu: :values.',
    'mimetypes' => 'Pole :attribute musí byť súbor typu: :values.',
    'min' => [
        'array' => 'Pole :attribute musí obsahovať aspoň :min položiek.',
        'file' => 'Pole :attribute musí mať aspoň :min kilobajtov.',
        'numeric' => 'Pole :attribute musí byť aspoň :min.',
        'string' => 'Pole :attribute musí mať aspoň :min znakov.',
    ],
    'min_digits' => 'Pole :attribute musí mať aspoň :min číslic.',
    'missing' => 'Pole :attribute nesmie byť prítomné.',
    'missing_if' => 'Pole :attribute nesmie byť prítomné, ak :other je :value.',
    'missing_unless' => 'Pole :attribute nesmie byť prítomné, pokiaľ :other nie je :value.',
    'missing_with' => 'Pole :attribute nesmie byť prítomné, ak je prítomné :values.',
    'missing_with_all' => 'Pole :attribute nesmie byť prítomné, ak sú prítomné :values.',
    'multiple_of' => 'Pole :attribute musí byť násobkom :value.',
    'not_in' => 'Vybraná hodnota poľa :attribute je neplatná.',
    'not_regex' => 'Formát poľa :attribute je neplatný.',
    'numeric' => 'Pole :attribute musí byť číslo.',
    'password' => [
        'letters' => 'Pole :attribute musí obsahovať aspoň jedno písmeno.',
        'mixed' => 'Pole :attribute musí obsahovať aspoň jedno veľké a jedno malé písmeno.',
        'numbers' => 'Pole :attribute musí obsahovať aspoň jedno číslo.',
        'symbols' => 'Pole :attribute musí obsahovať aspoň jeden symbol.',
        'uncompromised' => 'Zadané pole :attribute sa objavilo pri úniku údajov. Zvoľte prosím iné pole :attribute.',
    ],
    'present' => 'Pole :attribute musí byť prítomné.',
    'present_if' => 'Pole :attribute musí byť prítomné, ak :other je :value.',
    'present_unless' => 'Pole :attribute musí byť prítomné, pokiaľ :other nie je :value.',
    'present_with' => 'Pole :attribute musí byť prítomné, ak je prítomné :values.',
    'present_with_all' => 'Pole :attribute musí byť prítomné, ak sú prítomné :values.',
    'prohibited' => 'Pole :attribute je zakázané.',
    'prohibited_if' => 'Pole :attribute je zakázané, ak :other je :value.',
    'prohibited_unless' => 'Pole :attribute je zakázané, pokiaľ :other nie je v :values.',
    'prohibits' => 'Pole :attribute zakazuje prítomnosť poľa :other.',
    'regex' => 'Formát poľa :attribute je neplatný.',
    'required' => 'Pole :attribute je povinné.',
    'required_array_keys' => 'Pole :attribute musí obsahovať položky pre: :values.',
    'required_if' => 'Pole :attribute je povinné, ak :other je :value.',
    'required_if_accepted' => 'Pole :attribute je povinné, ak je :other akceptované.',
    'required_unless' => 'Pole :attribute je povinné, pokiaľ :other nie je v :values.',
    'required_with' => 'Pole :attribute je povinné, ak je prítomné :values.',
    'required_with_all' => 'Pole :attribute je povinné, ak sú prítomné :values.',
    'required_without' => 'Pole :attribute je povinné, ak :values nie je prítomné.',
    'required_without_all' => 'Pole :attribute je povinné, ak nie je prítomné žiadne z :values.',
    'same' => 'Pole :attribute sa musí zhodovať s :other.',
    'size' => [
        'array' => 'Pole :attribute musí obsahovať :size položiek.',
        'file' => 'Pole :attribute musí mať :size kilobajtov.',
        'numeric' => 'Pole :attribute musí byť :size.',
        'string' => 'Pole :attribute musí mať :size znakov.',
    ],
    'starts_with' => 'Pole :attribute musí začínať jednou z nasledujúcich hodnôt: :values.',
    'string' => 'Pole :attribute musí byť reťazec.',
    'timezone' => 'Pole :attribute musí byť platné časové pásmo.',
    'unique' => 'Hodnota poľa :attribute už bola použitá.',
    'uploaded' => 'Nahranie poľa :attribute zlyhalo.',
    'uppercase' => 'Pole :attribute musí byť veľkými písmenami.',
    'url' => 'Pole :attribute musí byť platná URL adresa.',
    'ulid' => 'Pole :attribute musí byť platné ULID.',
    'uuid' => 'Pole :attribute musí byť platné UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
