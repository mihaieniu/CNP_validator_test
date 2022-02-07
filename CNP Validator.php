<?php

/**
 * CNP Validator
 * TestScript for Wise Systems International SRL
 * @author Mihai Eniu <mihai@htg-software.com>
 */

function isCnpValid(string $value): bool {

    //start from asumption that CNP is false
    $validStatus = false;

    //remove all white spaces in case of error
    $value = trim($value);

    //check if string only contains numeric values
    if (ctype_digit($value)) {

        //separate string into chunks by position and length of chunk
        $separatedCnp[0] = substr($value, 0, 1);
        $separatedCnp[1] = substr($value, 1, 2 );
        $separatedCnp[2] = substr($value, 3, 2 );
        $separatedCnp[3] = substr($value, 5, 2 );
        $separatedCnp[4] = substr($value, 7, 2 );
        $separatedCnp[5] = substr($value, 9, 3 );
        $separatedCnp[6] = substr($value, 12, 1 );


        print_r($separatedCnp);
    }
        return $validStatus;
}

isCnpValid(1950112125791);
