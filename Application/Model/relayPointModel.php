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


    public function insertRelayPoint($address, $ownerId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(address_id, owner_id, is_deleted)
                                VALUES (" . $address . ", " . $ownerId . ", 0)");
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
}