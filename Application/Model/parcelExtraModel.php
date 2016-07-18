<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 09/04/16
 * Time: 16:38
 */

include_once('defaultModel.php');

class ParcelExtraModel extends DefaultModel {

    protected $_name = 'ParcelExtra';

    public function linkMultipleParcelExtra($values) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(parcel_id, extra_id)
                                VALUES " . $values . ";");
        $query->execute();
    }
}