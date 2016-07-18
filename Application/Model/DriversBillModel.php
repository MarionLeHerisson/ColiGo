<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 18/07/16
 * Time: 22:54
 */

require_once('defaultModel.php');

class DriversBill extends DefaultModel {

    protected $_name = 'DriversBill';

    /**
     * @param int $driverId
     * @param string $label
     * @param float $price
     * @return string
     */
    public function addCosts($driverId, $label, $price) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(driver_id, label, price)
                                VALUES (?, ?, ?);");
        $query->execute([$driverId, $label, $price]);

        $res = $bdd->lastInsertId();

        return $res;
    }
}