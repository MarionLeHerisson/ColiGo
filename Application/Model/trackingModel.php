<?php

include_once 'defaultModel.php';

class TrackingModel extends DefaultModel
{

    protected $_name = 'Tracking';

    /**
     * @param int $parcelId
     * @param int $statusId
     *
     * @author Marion
     */
    public function updateParcelTracking($parcelId, $statusId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(parcel_id, status_id, new_status_date)
                                VALUES (?, ?, NOW());");
        $query->execute([$parcelId, $statusId]);
    }

    /**
     * @param int $trackingNumber
     * @return array
     *
     * @author Marion
     */
    public function getParcelTracking($trackingNumber) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT Tracking.parcel_id, Tracking.status_id, Tracking.new_status_date,
                                Parcel.tracking_number, Parcel.id,
                                ParcelStatus.id, ParcelStatus.label, ParcelStatus.description
                                FROM Parcel
                                LEFT JOIN Tracking ON Tracking.parcel_id = Parcel.id
                                LEFT JOIN ParcelStatus ON ParcelStatus.id = Tracking.status_id
                                WHERE Parcel.tracking_number = ?;");

        $query->execute([$trackingNumber]);

        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
}