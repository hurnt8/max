<?php

use App\Models\SiteContact;

if (! function_exists('site_name')) {
    /**
     * Nom du site configure par l'admin (SiteContact::name), avec repli si absent.
     * Memoise pour la duree de la requete afin d'eviter des requetes SQL repetees.
     */
    function site_name(): string
    {
        static $name = null;

        if ($name === null) {
            $name = SiteContact::current()->name ?: site_name();
        }

        return $name;
    }
}
