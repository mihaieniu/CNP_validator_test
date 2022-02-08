<?php

function generateMultipleCnp (int $numberOfRepeats) : Array {
    $cnpArray = [];

    for($x=1; $x<=$numberOfRepeats; $x++){
        $sValue = rand(1,9);

        $currentYear = date("y");
        $currentMonth = date("m");
        $currentDay = date("d");

        $yValue = rand(0,99);


        if($yValue<10){
            $yValue = (string)$yValue;
            $yValue = "0".$yValue;
        }
        $yValue = (string)$yValue;
        $yFullValue = "19".$yValue;

        $mValue = rand(1,12);
        if($mValue<10){
            $mValue = (string)$mValue;
            $mValue = "0".$mValue;
        }
        $mValue = (string)$mValue;

        $dValue = rand(1,cal_days_in_month(CAL_GREGORIAN, $mValue, $yFullValue));
        if($dValue < 10){
            $dValue = (string)$dValue;
            $dValue = "0".$dValue;
        }
        $dValue = (string)$dValue;

        $cValue = rand(1, 52);
        if($cValue<10){
            $cValue = (string)$cValue;
            $cValue = "0".$cValue;
        }
        $cValue = (string)$cValue;

        $nValue = rand(1, 999);
        if($nValue<10){
            $nValue = (string)$nValue;
            $nValue = "00".$nValue;
        }elseif($nValue >= 10 && $nValue < 100){
            $nValue = (string)$nValue;
            $nValue = "0".$nValue;
        }
        $nValue = (string)$nValue;



    }


    return $cnpArray;
}