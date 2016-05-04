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

        $query = $bdd->prepare("SELECT price FROM " . $this->_name . " WHERE id = " . $extraId . ";");
        $query->execute();

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