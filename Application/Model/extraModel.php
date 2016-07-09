<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 09/04/16
 * Time: 20:59
 */

include_once 'defaultModel.php';

class ExtraModel extends DefaultModel {

    protected $_name = 'Extra';

    public function getAllBillExtras($parcelId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT Extra.id, Extra.label, Extra.price, ParcelExtra.parcel_id, ParcelExtra.extra_id
                                FROM " . $this->_name . "
                                LEFT JOIN ParcelExtra
                                ON ParcelExtra.extra_id = Extra.id
                                WHERE ParcelExtra.parcel_id = ?;");
        $query->execute([$parcelId]);

        $result = $query->fetchAll();

        return $result;
    }
    /**
     * Get price of an extra from its id
     *
     * @param int $extraId
     * @return array
     *
     * @author Marion
     */
    public function getExtraPrice($extraId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT price FROM " . $this->_name . "
                                WHERE id = ?;");
        $query->execute([$extraId]);

        $result = $query->fetchColumn();

        return $result;
    }

    public function getAllExtras() {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT id, label, price, explaination FROM " . $this->_name . ";");
        $query->execute();

        $result = $query->fetchAll();

        return $result;
    }
}