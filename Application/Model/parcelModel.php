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

    /**
     * update parcel satus
     *
     * @param $parcelId
     * @param $newStatus
     * @return string
     *
     * @author Marion
     */
    public function updateStatus($parcelId, $newStatus) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . " SET status_id = " . $newStatus .
                                " WHERE id = " . $parcelId . ";");
        $query->execute();

        $result = $query->fetchColumn();
        return $result;
    }

    /**
     * return parcel status
     *
     * @param $parcelId
     * @return int
     *
     * @author Marion
     */
    public function getStaus($parcelId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT status_id FROM " . $this->_name . " WHERE id = " . $parcelId);
        $query->execute();

        $status = $query->fetchColumn();

        return $status;
    }
}