<?php

function generateMultipleCnp (int $numberOfRepeats) : Array {
    $cnpArray = [];

    for($x=0; $x<$numberOfRepeats; $x++){
        $sValue = rand(1,9);

        $currentYear = date("y");
        $currentMonth = date("m");
        $currentDay = date("d");
        $yValuePrefix = "19";

        //identify sex for troubleshooting
        if ($sValue % 2 == 1) {
            $sexCnp = "M";
        } else {
            $sexCnp = "F";
        }
        //add foreign citizen tag
        if($sValue == 7 || $sValue == 8){
            $sexCnp = "Foreign citizen ".$sexCnp;
        }elseif($sValue == 9){
            $sexCnp = "Foreign citizen";
        }
        $yValue = rand(0,99);

        if($yValue<10){
            $yValue = (string)$yValue;
            $yValue = "0".$yValue;
        }
        $yValue = (string)$yValue;
        if($sValue == 5 || $sValue == 6){
            $yValuePrefix = "20";
        }elseif($sValue == 3 || $sValue == 4){
            $yValuePrefix = "18";
        }
        $yValueFull = $yValuePrefix.$yValue;

        $mValue = rand(1,12);
        if($mValue<10){
            $mValue = (string)$mValue;
            $mValue = "0".$mValue;
        }
        $mValue = (string)$mValue;

        $dValue = rand(1,cal_days_in_month(CAL_GREGORIAN, $mValue, $yValueFull));
        if($dValue < 10){
            $dValue = (string)$dValue;
            $dValue = "0".$dValue;
        }
        $dValue = (string)$dValue;

        $cValue = rand(1, 51);
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

        $partialCnp = $sValue.$yValue.$mValue.$dValue.$cValue.$nValue;

        $controlNumber = "279146358279";
        $controlNumberSplit = str_split($controlNumber);
        $partialCnpSplit = str_split($partialCnp);
        $controlSum = 0;

        for ($x = 0; $x < 12; $x++) {
            $digitMultiplication = (int)$controlNumberSplit[$x] * (int)$partialCnpSplit[$x];
            $controlSum += $digitMultiplication;
        }

        $controlSumRemainder = $controlSum % 11;

        if ($controlSumRemainder == 10) {
            $controlSumRemainder = 1;
        }

        $fullCnp = $partialCnp.$controlSumRemainder;

        $cnpArray[$x] = $fullCnp;
    }


    return $cnpArray;
}

generateMultipleCnp(5);