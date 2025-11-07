<?php

namespace App\Services\CinetPay;

class Marchand
{
    /**
     * Récupère la clé API depuis la configuration
     * 
     * @return string La clé API
     */
    public static function getApiKey()
    {
        return config('services.cinetpay.api_key');
    }

    /**
     * Récupère l'ID du site depuis la configuration
     * 
     * @return string L'ID du site
     */
    public static function getSiteId()
    {
        return config('services.cinetpay.site_id');
    }

    /**
     * Récupère la clé secrète depuis la configuration
     * 
     * @return string La clé secrète
     */
    public static function getSecretKey()
    {
        return config('services.cinetpay.secret_key');
    }

    /**
     * Vérifie si on est en mode production
     * 
     * @return bool True si en production, False si en sandbox
     */
    public static function isProduction()
    {
        return config('services.cinetpay.mode') === 'production';
    }

    /**
     * Récupère l'URL de base de l'API
     * 
     * @return string L'URL de base
     */
    public static function getBaseUrl()
    {
        return config('services.cinetpay.base_url');
    }
}