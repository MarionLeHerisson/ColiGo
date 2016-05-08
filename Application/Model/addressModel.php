<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 06/04/16
 * Time: 18:08
 */

// TODO : ajout address_type (particulier, centre, point relais)
require_once('defaultModel.php');

class AddressModel extends DefaultModel {

    protected $_name = 'Address';

    // insert an user's address
    public function insertAddress($address, $zipcode, $city) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(address, zip_code, city)
                                VALUES ('" . $address . "'," . intval($zipcode) . " ,'" . $city . "');");
        $query->execute();

        $query2 = $bdd->prepare("SELECT LAST_INSERT_ID();");
        $query2->execute();

        $res = $query2->fetchColumn();

        return $res;
    }

    // get address from user id
    public function getAddress($userId) {
        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT id, address, zip_code, city FROM " . $this->_name . "
                                INNER JOIN User ON User.address_id = Address.id
                                WHERE User.id = " . $userId . ";");

        $query->execute();

        return $query;
    }

    /**
     * Return id if address exists
     *
     * @param string $address
     * @param int $zipcode
     * @param string $city
     * @return int
     */
    public function existAddress($address, $zipcode, $city) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT id FROM " . $this->_name . "
                                WHERE address = '" . $address . "'
                                AND zip_code = " . intval($zipcode) . "
                                AND city = '" . $city . "';");
        $query->execute();
        $res = $query->fetchColumn();

        return $res;
    }
}
