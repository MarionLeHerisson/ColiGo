<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 09/04/16
 * Time: 23:56
 */

include_once 'defaultModel.php';

class RelayPointModel extends DefaultModel {

    protected $_name = 'RelayPoint';


    public function insertRelayPoint($address, $ownerId, $label) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(address, owner_id, label, is_deleted)
                                VALUES (" . $address . ", " . $ownerId . ", '" . $label . "', 0)");
        $query->execute();

        $query = $bdd->prepare("SELECT LAST_INSERT_ID();");
        $res = $query->execute();

        return $res;
    }


    /**
     * return address id from relay point id
     *
     * @param int $rpId
     * @return int
     *
     * @author Marion
     */
    public function getRPAddress($rpId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT address FROM " . $this->_name . " WHERE id = " . $rpId . ";");
        $query->execute();

        $res = $query->fetchColumn();

        return $res;
    }

    /**
     * Return all relay points
     * @return array
     */
    public function getAllRelayPoints() {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT rp.id, rp.address, rp.label, CONCAT(a.address, ', ', a.zip_code, ', ', a.city) AS completeAddress, a.lat, a.lng
                                FROM " . $this->_name . " AS rp
                                LEFT JOIN Address AS a ON a.id = rp.address
                                WHERE rp.is_deleted = 0;");
        $query->execute();

        $res = $query->fetchAll();

        return $res;
    }

    /**
     * Returns the closest relay points from address, zip code, city, ...
     * @param float $minLat
     * @param float $maxLat
     * @param float $minLng
     * @param float $maxLng
     * @return array
     */
    public function getClosestRelayPoints($minLat, $maxLat, $minLng, $maxLng) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT rp.id, rp.address, rp.label, CONCAT(a.address, ', ', a.zip_code, ', ', a.city) AS completeAddress, a.lat, a.lng
                                FROM " . $this->_name . " AS rp
                                LEFT JOIN Address AS a ON a.id = rp.address
                                WHERE a.lat BETWEEN " . $minLat . " AND " . $maxLat . " AND a.lng BETWEEN " . $minLng . " AND " . $maxLng . ";");
        $query->execute();

        $res = $query->fetchAll();

        return $res;
    }
}