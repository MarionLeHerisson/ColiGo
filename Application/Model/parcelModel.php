<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 09/04/16
 * Time: 15:15
 */

include_once('defaultModel.php');

class ParcelModel extends DefaultModel {

    protected $_name = 'Parcel';

    /**
     * insert parcel
     *
     * @param float $weight
     * @param int $status
     * @param int $delivery
     * @return int
     *
     * @author Marion
     */
    public function insertParcel($weight, $status, $delivery) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(weight, status_id, is_deleted, delivery_type)
                                VALUES (" . $weight . ", " . $status . ", 0, " . $delivery . ");");
        $query->execute();

        $query = $bdd->prepare("SELECT LAST_INSERT_ID();");
        $res = $query->execute();

        return $res;
    }
}