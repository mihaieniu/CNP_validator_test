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

        //begin initial nested if statement
        if ($separatedCnp[0] == "0" || $separatedCnp[0] == "1") { //sex check for the 20th century
            if ($separatedCnp[1] >= ($currentYear - 20) && $separatedCnp[1] <= "99") { //year checking and accounting for a max age of 120 years
                if ($separatedCnp[2] >= "01" && $separatedCnp[2] <= "12") { //month checking
                    $cnpFullFormatYear = "19" . $separatedCnp[1];
                    if ($separatedCnp[3] >= "01" && $separatedCnp[3] <= cal_days_in_month(CAL_GREGORIAN, $separatedCnp[2], $cnpFullFormatYear)) { //day variable validity cheking | including check for unequal months and leap years

                        echo "Person born on " . $separatedCnp[3] . "." . $separatedCnp[2] . ".19" . $separatedCnp[1] . PHP_EOL;
                        $validStatus = true;
                    }


                }
            }


            print_r($separatedCnp);
            print_r($validStatus);
        }
    }
    return $validStatus;

}

isCnpValid(1950228125791);
