<?php

/**
 * CNP Validator
 * TestScript for Wise Systems International SRL
 * @author Mihai Eniu <mihai@htg-software.com>
 */

function isCnpValid(string $value): bool
{

    //start from asumption that CNP is false
    $validStatus = false;

    //remove all white spaces in case of error
    $value = trim($value);

    //check if string only contains numeric values
    if (ctype_digit($value)) {

        //separate string into chunks by position and length of chunk
        $separatedCnp[0] = substr($value, 0, 1);
        $separatedCnp[1] = substr($value, 1, 2);
        $separatedCnp[2] = substr($value, 3, 2);
        $separatedCnp[3] = substr($value, 5, 2);
        $separatedCnp[4] = substr($value, 7, 2);
        $separatedCnp[5] = substr($value, 9, 3);
        $separatedCnp[6] = substr($value, 12, 1);


        //begin condensed nested if statement
        if ($separatedCnp[0] >= "1" && $separatedCnp[0] <= 9) { //sex check

            //initial variable setting for date checking
            $currentYear = date("y");
            $currentMonth = date("m");
            $currentDay = date("d");

            $cnpFullFormatYear = "19" . $separatedCnp[1];

            //identify sex for troubleshooting
            if ($separatedCnp[0] % 2 == 1) {
                $sexCnp = "M";
            } else {
                $sexCnp = "F";
            }
            //add foreign citizen tag
            if($separatedCnp[0] == 7 || $separatedCnp[0] == 8){
                $sexCnp = "Foreign citizen ".$sexCnp;
            }elseif($separatedCnp[0] == 9){
                $sexCnp = "Foreign citizen";
            }

            //adjustment for different centuries
            if($separatedCnp[0] == 5 || $separatedCnp[0] == 6){
                $cnpFullFormatYear = "20" . $separatedCnp[1];
                if($separatedCnp[1] >= $currentYear){
                    if($separatedCnp[2] >= $currentMonth){
                        if($separatedCnp[3] > $currentDay){
                            echo "Date is in the future. CNP is NOT valid" . PHP_EOL; //don't permit a date later than current
                            return false;
                        }
                    }
                }
            }elseif($separatedCnp[0] == 3 || $separatedCnp[0] == 4){
                $cnpFullFormatYear = "18" . $separatedCnp[1];
            }

                if ($separatedCnp[1] >= "00" && $separatedCnp[1] <= "99") { //year checking //redundant check since there aren't other options
                if ($separatedCnp[2] >= "01" && $separatedCnp[2] <= "12") { //month checking
                    if ($separatedCnp[3] >= "01" && $separatedCnp[3] <= cal_days_in_month(CAL_GREGORIAN, $separatedCnp[2], $cnpFullFormatYear)) { //day variable validity cheking | including check for unequal months and leap years
                        if ($separatedCnp[4] >= "01" && $separatedCnp[4] <= "52") {
                            //Create array to identify county
                            $countyArray = array("Alba", "Arad", "Arges", "Bacau", "Bihor", "Bistrita-Nasaud", "Botosani", "Brasov", "Braila", "Buzau", "Caras-Severin", "Cluj", "Constanta", "Covasna", "Dimbovita", "Dolj", "Galati", "Gorj", "Harghita", "Hunedoara", "Ialomita", "Iasi", "Ilfov", "Maramures", "Mehedinti", "Mures", "Neamt", "Olt", "Prahova", "Satu Mare", "Salaj", "Sibiu", "Suceava", "Teleorman", "Timis", "Tulcea", "Vaslui", "Valcea", "Vrancea", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Calarasi", "Giurgiu");
                            //index adjustment
                            $countySelector = (int)$separatedCnp[4] - 1;
                            if ($separatedCnp[5] >= "001" && $separatedCnp[5] <= "999") { //check for NNN
                                //logic for Control Number
                                $controlNumber = 279146358279;
                                $controlNumberSplit = str_split($controlNumber);
                                $cnpAsInt = (int)$value;
                                $cnpAsIntSplit = str_split($cnpAsInt);
                                $controlSum = 0;

                                for ($x = 0; $x < 12; $x++) {
                                    $digitMultiplication = $controlNumberSplit[$x] * $cnpAsIntSplit[$x];
                                    $controlSum += $digitMultiplication;
                                }

                                $controlSumRemainder = $controlSum % 11;

                                if ($controlSumRemainder == 10) {
                                    $controlSumRemainder = 1;
                                }

                                if ($separatedCnp[6] == $controlSumRemainder) { //check control number validity
                                    echo $sexCnp . " born on " . $separatedCnp[3] . "." . $separatedCnp[2] .".". $cnpFullFormatYear . " in " . $countyArray[$countySelector] . " county" . PHP_EOL;
                                    $validStatus = true;
                                    echo "CNP is valid" . PHP_EOL;
                                } else {
                                    echo "Control number is not correct. CNP is NOT valid" . PHP_EOL;
                                }
                            } else {
                                echo "Unique number is out of range. CNP is NOT valid" . PHP_EOL;
                            }
                        } else {
                            echo "County number is out of range. CNP is NOT valid" . PHP_EOL;
                        }
                    } else {
                        echo "Day number is out of range. CNP is NOT valid" . PHP_EOL;
                    }
                } else {
                    echo "Month number is out of range. CNP is NOT valid" . PHP_EOL;
                }
            } else {
                echo "Year number is out of range. CNP is NOT valid" . PHP_EOL;
            }
        }
    }
        return $validStatus;
}
//check for 20th Century
isCnpValid(1950112125791);
//check for 19th Century
isCnpValid(9390921516872);
//check for 21st Century
isCnpValid(5801213198306);
