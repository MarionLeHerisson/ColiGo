<?php

include_once('defaultModel.php');

class OrderParcelModel extends DefaultModel {

    protected $_name = 'OrderParcel';

    /**
     * @param int $parcelId
     * @param int $orderId
     */
    public function linkParcelToOrder($parcelId, $orderId) {

        $bdd = $this->connectBdd();
echo 'parcel=' . $parcelId . '-order=' . $orderId;
        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(order_id, parcel_id)
                                VALUES (" . intval($orderId) . ", " . intval($parcelId) . ");");
        $query->execute();

    }
}