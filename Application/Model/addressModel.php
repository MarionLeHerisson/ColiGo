<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 06/04/16
 * Time: 18:08
 */


require_once('defaultModel.php');

class AddressModel extends DefaultModel {

    protected $_name = 'Address';

    // insert an user's address
    public function insertAddress($address, $zipcode, $city) {

        $bdd = $this->connectBdd();

        $query = $bdd ->prepare("INSERT INTO " . $this->_name . " (address, zip_code, city)
						         VALUES ('" . $address . "', " . $zipcode . ", '" . $city . "');
						         SELECT LAST_INSERT_ID()");
        $query->execute();

        return $query;
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
}
