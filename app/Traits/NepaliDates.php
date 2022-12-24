<?php

namespace App\Traits;

use Carbon\Carbon;
use Nilambar\NepaliDate\NepaliDate;

trait NepaliDates
{

    public function nepaliDate()
    {
        $yr = today()->format('Y');
        $mnth = today()->format('m');
        $day = today()->format('d');
        $obj = new NepaliDate();
        // Convert AD to BS.
        $date = $obj->convertAdToBs($yr, $mnth, $day);
        return $date['year'] . "/" . $date['month'] . "/" . $date['day'];
    }

    public function getFy()
    {
        $today = $this->nepaliDate();
        $todayInNepali = Carbon::createFromFormat('Y/m/d', $today);
        $month =  $todayInNepali->month;

        if ($month >= 4 & $month <= 12) {
            $today = $this->nepaliDate();
            $precision = substr($todayInNepali, 0, 2);
            $p1 = substr($todayInNepali, 2, 2);
            $p2 = (int)$p1 + 1;
            
            $fy = $precision . $p1 . "/" . $p2;
             return $fy;
           
        }

        if ($month >= 1 && $month <= 3) {
            $PreviousYear = $todayInNepali->subYear(1)->format('Y');
            $precision = substr($PreviousYear, 0, 2);
            $p1 = substr($PreviousYear, 2, 3);
            $p2 = (int)$p1 + 1;
            $fy = $precision . $p1."/" . $p2;
            return $fy;
            
        }
    }
}
