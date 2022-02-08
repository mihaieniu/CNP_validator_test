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

        $currentYear = date("y");

        //begin 20th century nested if statement
        if ($separatedCnp[0] == "1" || $separatedCnp[0] == "2") { //sex check for the 20th century
            //identify sex for troubleshooting
            if($separatedCnp[0]%2 == 1){
                $sexCnp = "M";
            }else{
                $sexCnp = "F";
            }
            if ($separatedCnp[1] >= "00" && $separatedCnp[1] <= "99") { //year checking
                if ($separatedCnp[2] >= "01" && $separatedCnp[2] <= "12") { //month checking
                    $cnpFullFormatYear = "19" . $separatedCnp[1];
                    if ($separatedCnp[3] >= "01" && $separatedCnp[3] <= cal_days_in_month(CAL_GREGORIAN, $separatedCnp[2], $cnpFullFormatYear)) { //day variable validity cheking | including check for unequal months and leap years
                        if($separatedCnp[4] >= "01" && $separatedCnp[4] <= "52"){
                            //Create array to identify county
                            $countyArray = Array("Alba", "Arad", "Arges", "Bacau", "Bihor", "Bistrita-Nasaud", "Botosani", "Brasov", "Braila", "Buzau", "Caras-Severin", "Cluj", "Constanta", "Covasna", "Dimbovita", "Dolj", "Galati", "Gorj", "Harghita", "Hunedoara", "Ialomita", "Iasi", "Ilfov", "Maramures", "Mehedinti", "Mures", "Neamt", "Olt", "Prahova", "Satu Mare", "Salaj", "Sibiu", "Suceava", "Teleorman", "Timis", "Tulcea", "Vaslui", "Valcea", "Vrancea", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Calarasi", "Giurgiu");
                            //index adjustment
                            $countySelector = (int)$separatedCnp[4]-1;
                            if($separatedCnp[5] >= "001" && $separatedCnp[5] <= "999"){ //check for NNN
                                //logic for Control Number
                                $controlNumber = 279146358279;
                                $controlNumberSplit = str_split($controlNumber);
                                $cnpAsInt = (int)$value;
                                $cnpAsIntSplit = str_split($cnpAsInt);
                                $controlSum = 0;

                                for($x = 0; $x < 12; $x++){
                                    $digitMultiplication = $controlNumberSplit[$x] * $cnpAsIntSplit[$x];
                                    $controlSum+=$digitMultiplication;
                                }

                                $controlSumRemainder = $controlSum % 11;

                                if($controlSumRemainder == 10 || $controlSumRemainder == 0){
                                    $controlSumRemainder = 1;
                                }

                                if($separatedCnp[6] == $controlSumRemainder){ //check control number validity
                                    echo $sexCnp." born on " . $separatedCnp[3] . "." . $separatedCnp[2] . ".19" . $separatedCnp[1] . " in ".$countyArray[$countySelector]." county".PHP_EOL;
                                    $validStatus = true;
                                    echo "CNP is valid".PHP_EOL;
                                }else{
                                    echo "Control number is not correct. CNP is NOT valid".PHP_EOL;
                                }
                            }else{
                                echo "Unique number is out of range. CNP is NOT valid".PHP_EOL;
                            }
                        }else{
                            echo "Control number is not correct. CNP is NOT valid".PHP_EOL;
                        }
                    }
                }
            }
        }
        //begin 19th century nested if statement
        if ($separatedCnp[0] == "3" || $separatedCnp[0] == "4") { //sex check for the 20th century
            //identify sex for troubleshooting
            if($separatedCnp[0]%2 == 1){
                $sexCnp = "M";
            }else{
                $sexCnp = "F";
            }
            if ($separatedCnp[1] >= "00" && $separatedCnp[1] <= "99") { //year checking
                if ($separatedCnp[2] >= "01" && $separatedCnp[2] <= "12") { //month checking
                    $cnpFullFormatYear = "18" . $separatedCnp[1];
                    if ($separatedCnp[3] >= "01" && $separatedCnp[3] <= cal_days_in_month(CAL_GREGORIAN, $separatedCnp[2], $cnpFullFormatYear)) { //day variable validity cheking | including check for unequal months and leap years
                        if($separatedCnp[4] >= "01" && $separatedCnp[4] <= "52"){
                            //Create array to identify county
                            $countyArray = Array("Alba", "Arad", "Arges", "Bacau", "Bihor", "Bistrita-Nasaud", "Botosani", "Brasov", "Braila", "Buzau", "Caras-Severin", "Cluj", "Constanta", "Covasna", "Dimbovita", "Dolj", "Galati", "Gorj", "Harghita", "Hunedoara", "Ialomita", "Iasi", "Ilfov", "Maramures", "Mehedinti", "Mures", "Neamt", "Olt", "Prahova", "Satu Mare", "Salaj", "Sibiu", "Suceava", "Teleorman", "Timis", "Tulcea", "Vaslui", "Valcea", "Vrancea", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Bucuresti", "Calarasi", "Giurgiu");
                            //index adjustment
                            $countySelector = (int)$separatedCnp[4]-1;
                            if($separatedCnp[5] >= "001" && $separatedCnp[5] <= "999"){ //check for NNN
                                //logic for Control Number
                                $controlNumber = 279146358279;
                                $controlNumberSplit = str_split($controlNumber);
                                $cnpAsInt = (int)$value;
                                $cnpAsIntSplit = str_split($cnpAsInt);
                                $controlSum = 0;

                                for($x = 0; $x < 12; $x++){
                                    $digitMultiplication = $controlNumberSplit[$x] * $cnpAsIntSplit[$x];
                                    $controlSum+=$digitMultiplication;
                                }

                                $controlSumRemainder = $controlSum % 11;

                                if($controlSumRemainder == 10 || $controlSumRemainder == 0){
                                    $controlSumRemainder = 1;
                                }

                                if($separatedCnp[6] == $controlSumRemainder){ //check control number validity
                                    echo $sexCnp." born on " . $separatedCnp[3] . "." . $separatedCnp[2] . ".18" . $separatedCnp[1] . " in ".$countyArray[$countySelector]." county".PHP_EOL;
                                    $validStatus = true;
                                    echo "CNP is valid".PHP_EOL;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $validStatus;

}
//check for 20th Century
isCnpValid(1240229016991);
//check for 19th Century
isCnpValid(3991201019407);
