<?php

namespace App\Services;

class Services
{

    static public function extractErrorMessage($error)
    {
        preg_match('/response:.*?"(.+?)"/s', $error, $matches);
        return $matches[1];
    }
 // 5 / 8 / 5
   static public function is_between($hire_value_max, $offer_value_max, $coffer_value_min)
    {
        if($hire_value_max > $offer_value_max){
            return 'Solicitação excede o valor de oferta.';
        }

        if($hire_value_max < $coffer_value_min){
            return 'Solicitação é menor que o valor de oferta.';
        }

        return 'isValid';
    }

}
