<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 05/04/16
 * Time: 18:44
 */


class ColiGo {

    public static function sanitizeString($string) {
        $string = str_replace('\'', '', trim(stripslashes($string)));
        $string = str_replace('\"', '', $string);

        return $string;
    }

    public static function objectToArray ($object) {

        $myArray = [];

        while($donnees=$object->fetch()){
            $myArray[] = $donnees;
        }

        return $myArray;
    }
}