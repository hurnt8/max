<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContact extends Model
{
    protected $fillable = [
        'address_1',
        'address_2',
        'address_3',
        'phone_1',
        'phone_2',
        'email',
    ];

    /**
     * Enregistrement singleton des coordonnées du site.
     */
    public static function current(): self
    {
        return static::first() ?? static::create([]);
    }
}
