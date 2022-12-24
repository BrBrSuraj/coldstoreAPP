<?php

namespace App\Traits;

trait Currency
{

    public function currency($value)
    {
        $formatedNumber= number_format($value,2);  
        return $formatedNumber." "."rs.";
    }

   
}
