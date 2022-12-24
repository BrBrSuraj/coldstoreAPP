<?php 

function formatedNumber($value){
    $formatedNumber = number_format($value, 2);
    return $formatedNumber . " " . "rs.";
}