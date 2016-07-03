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

    public static function getMonth() {
        return date('n');
    }

    public static function getYear() {
        return date('Y');
    }

    /**
     * @param $str
     * @param string $charset
     * @return mixed|string
     * @author http://www.weirdog.com/blog/php/supprimer-les-accents-des-caracteres-accentues.html
     */
    public static function unaccent($str, $charset = 'utf-8') {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);

        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

        return $str;
    }

    /**
     * Create a unique tracking number
     */
    public static function createUniqueId() {

        require_once(BASE_PATH . '/Application/Model/parcelModel.php');
        $parcelManager = new ParcelModel();

        do {
            $uniqueId = '';
            for($i = 0; $i < 10; $i++) {
                $uniqueId .= rand(0,9);
            }
        } while($parcelManager->getIdFromTrackingNumber($uniqueId) != 0);

        return $uniqueId;
    }
}