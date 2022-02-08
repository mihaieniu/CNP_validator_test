<?php

function generateMultipleCnp (int $numberOfRepeats) : Array {
    $cnpArray = [];

    for($x=1; $x<=$numberOfRepeats; $x++){
        $sValue = rand(1,9);

        $currentYear = date("y");
        $currentMonth = date("m");
        $currentDay = date("d");

        if($sValue == 1 || $sValue == 2){
            $yValue = rand(0,99);
            if($yValue<10){
                $yValue = "0".$yValue;
            }
            $yFullValue = "19".$yValue;
            $mValue = rand(1,12);
            if($mValue<10){
                $mValue = "0".$mValue;
            }
            $dValue = rand(0,cal_days_in_month(CAL_GREGORIAN, $mValue, $yFullValue));
            if($dValue < 10){
                $dValue = "0".$dValue;
            }


        }

    }


    return $cnpArray;
}