<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 05/04/16
 * Time: 18:44
 */


class ColiGo {

    /**
     * remove quotes and useless spaces in string
     *
     * @param string $string
     * @return string
     *
     * @author Marion
     */
    public static function sanitizeString($string) {
        $string = str_replace('\'', '', trim(stripslashes($string)));
        $string = str_replace('\"', '', $string);

        return $string;
    }

    public static function getDate() {
        return date('j-n-Y');
    }
}