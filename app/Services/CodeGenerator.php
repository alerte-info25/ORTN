<?php
namespace App\Services;


use DateTime;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CodeGenerator

{

    public static function generateSlugCode()
    {
        $lenght= 50;
        $keys = substr(str_shuffle(
            str_repeat($x = '1234567890', ceil($lenght / strlen($x)))
        ), 3, $lenght);

        return $keys;
    }

    public static function generateCodeAuthorization()
    {
        $lenght= 10;
        $keys = substr(str_shuffle(
            str_repeat($x = '1234567890', ceil($lenght / strlen($x)))
        ), 3, $lenght);
        return $keys;
    }


    public static function generatePassword()
    {
        $lenght= 6;
        $keys = substr(str_shuffle(
            str_repeat($x = 'AUTHORIZATION1234567890', ceil($lenght / strlen($x)))
        ), 3, $lenght);
        return $keys . date('Hi', strtotime(now()));
    }

    public static function generateSubscribersAccountCodeUnique()
    {
        $lenght= 10;
        $keys = substr(str_shuffle(
            str_repeat($x = '1234567890', ceil($lenght / strlen($x)))
        ), 3, $lenght);

        return "SBSA"."-". $keys .date('mYHs', strtotime(now())) ;
    }
    public static function generateSubscriptionCodeUnique()
    {
        $lenght= 10;
        $keys = substr(str_shuffle(
            str_repeat($x = '1234567890', ceil($lenght / strlen($x)))
        ), 0, $lenght);

        return "SBSC"."-".$keys.date('mYHs', strtotime(now()));
    }
    // generate journal_code_unique
    public static function generateJournalCodeUnique()
    {
        $lenght= 14;
        $keys = substr(str_shuffle(
            str_repeat($x = '1234567890', ceil($lenght / strlen($x)))
        ), 3, $lenght);
        return "JRN"."-".$keys;
    }
    // generate coupons_code_unique
    public static function generateCouponsCodeUnique()
    {
        return "CPN"."-".date('dmYHis', strtotime(now()));
    }

    // generate coupons article _code _unique
    public static function generateCouponsArticleCodeUnique()
    {
        return "CPNA".date('dmYHis', strtotime(now()));
    }

    //generate article code unique
    public static function generateArticleCodeUnique()
    {
        return "ART".date('dmYHis', strtotime(now()));
    }

    //generate journal reader code
    public static function generateJournalReaderCodeUnique()
    {
        return "JRNR".date('dmYHis', strtotime(now()));
    }





    public static function format_my_date($date)
    {
        $date = str_replace('/', '-', $date);
        return date('Y-m-d', strtotime($date));
    }


    public static function get_nombre_heure($date1, $date2)
    {
        $start_time = new DateTime($date1);

        $end_time = new DateTime($date2);

        $interval = $start_time->diff($end_time);
        $working_hours = $interval->format('%h:%I');

        return $working_hours;
    }


    public static function somme_heure($heure_array)
    {

        $heures = array($heure_array['h1'], $heure_array['h2'], $heure_array['h3'], $heure_array['h4']);

        $totalSecondes = 0;


        foreach ($heures as $heure) {
            $secondes = strtotime($heure);
            $totalSecondes += $secondes;
        }
        $heuresTotales = date("H:i", $totalSecondes);

        return $heuresTotales;
    }


    public static function total_heure($heures)
    {

        $totalSecondes = 0;

        foreach ($heures as $heure) {
            $secondes = strtotime($heure);
            $totalSecondes += $secondes;
        }

        $heuresTotales = date("H:i", $totalSecondes);

        return $heuresTotales;
    }
}
