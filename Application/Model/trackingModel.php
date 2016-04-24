<?php

include_once 'defaultModel.php';

class TrackingModel extends DefaultModel
{

    // TODO : update tracking when update parcel status
    protected $_name = 'tracking';

    /**
     * @param int $parcelId
     * @param int $statusId
     *
     * @author Marion
     */
    public function updateParcelTracking($parcelId, $statusId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(parcel_id, status_id, new_status_date)
                                VALUES (" . $parcelId . ", " . $statusId . ", NOW());");
        $query->execute();
    }
}