<?php

namespace App\Services\CinetPay;

use Illuminate\Support\Facades\DB;

class Commande
{

    public  static function getCurrentUrl()
    {
        return  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";

    }

    public function create()
    {
        // Enregister la ligne pour la première fois

    }

    public function update($demande_id)
    {
    }

    public function getCommandeByTransId()
    {
        // Recuperation d'une commande par son $_transId
    }

    public function getUserByPayment()
    {
        // Recuperation d'un utilisation par son $_payment_token
    }

}
