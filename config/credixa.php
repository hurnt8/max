<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Devise par défaut
    |--------------------------------------------------------------------------
    | Peut être surchargée via DEFAULT_CURRENCY dans .env
    */
    'default_currency' => env('DEFAULT_CURRENCY', 'EUR'),

    /*
    |--------------------------------------------------------------------------
    | Devises supportées (liste unique pour tout le projet)
    |--------------------------------------------------------------------------
    */
    'currencies' => ['EUR', 'GBP', 'CHF', 'NOK', 'SEK', 'DKK', 'PLN', 'CZK', 'HUF', 'RON', 'BRL', 'PEN'],

    /*
    |--------------------------------------------------------------------------
    | Symboles par devise
    |--------------------------------------------------------------------------
    */
    'currency_symbols' => [
        'EUR' => '€',
        'GBP' => '£',
        'CHF' => 'CHF',
        'NOK' => 'kr',
        'SEK' => 'kr',
        'DKK' => 'kr',
        'PLN' => 'zł',
        'CZK' => 'Kč',
        'HUF' => 'Ft',
        'RON' => 'lei',
        'BRL' => 'R$',
        'PEN' => 'S/',
    ],

];
