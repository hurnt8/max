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
            $name = SiteContact::current()->name ?: 'SOLIDARIS FOUNDATION';
        }

        return $name;
    }
}

if (! function_exists('site_email')) {
    /**
     * Email de contact configure par l'admin (SiteContact::email), avec repli si absent.
     */
    function site_email(): string
    {
        static $email = null;

        if ($email === null) {
            $email = SiteContact::current()->email ?: 'contact@solidarisfoundation.org';
        }

        return $email;
    }
}

if (! function_exists('site_phone')) {
    /**
     * Telephone de contact configure par l'admin (SiteContact::phone_1), avec repli si absent.
     */
    function site_phone(): string
    {
        static $phone = null;

        if ($phone === null) {
            $phone = SiteContact::current()->phone_1 ?: '+31 6 57341120';
        }

        return $phone;
    }
}

if (! function_exists('site_phone_href')) {
    /**
     * Numero de telephone nettoye pour un lien tel: (chiffres et + uniquement).
     */
    function site_phone_href(): string
    {
        return preg_replace('/[^\d+]/', '', site_phone());
    }
}
