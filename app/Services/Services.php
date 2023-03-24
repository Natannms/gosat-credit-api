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

   static public function loweInterest($list)
    {
         // reorder where jursMes is less
        usort($list, function ($a, $b) {
            return $a['offer']['jurosMes'] <=> $b['offer']['jurosMes'];
        });

        return $list;
    }

    static public function highestRedeemedValue($list){
        // reorder where jursMes is less
        usort($list, function ($a, $b) {
            return $b['offer']['valorMax'] <=> $a['offer']['valorMax'];
        });

        return $list;
    }

    static public function lowestRedeemedValue($lis){
        // reorder where jursMes is less
        usort($list, function ($a, $b) {
            return $a['offer']['valorMax'] <=> $b['offer']['valorMax'];
        });

        return $list;
    }

    static public function greaterNumberOfInstallments($list)
    {
        // reorder where jursMes is less
        usort($list, function ($a, $b) {
            return $b['offer']['QntParcelaMax'] <=> $a['offer']['QntParcelaMax'];
        });

        return $list;
    }

    static public function smallerAmountOfInstallments($list)
    {
        // reorder where jursMes is less
        usort($list, function ($a, $b) {
            return $a['offer']['QntParcelaMin'] <=> $b['offer']['QntParcelaMin'];
        });

        return $list;
    }

}
