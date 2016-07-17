<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 09/04/16
 * Time: 15:15
 */

include_once('defaultModel.php');

class ParcelModel extends DefaultModel {

    protected $_name = 'Parcel';

    /**
     * insert parcel
     *
     * @param float $weight
     * @param int $status
     * @param int $delivery
     * @param int $trackingNumber
     * @return int
     * @author Marion
     */
    public function insertParcel($weight, $status, $delivery, $trackingNumber) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(weight, status_id, delivery_type, tracking_number)
                                VALUES (?, ?, ?, ?);");
        $query->execute([$weight, $status, $delivery, $trackingNumber]);

        //$query2 = $bdd->prepare("SELECT LAST_INSERT_ID();");
        //$query2->execute();
        $res = $bdd->lastInsertId();
        //$res = $query2->fetchColumn();

        return $res;
    }

    /**
     * update parcel satus
     *
     * @param $parcelId
     * @param $newStatus
     * @return string
     *
     * @author Marion
     */
    public function updateStatus($parcelId, $newStatus) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . "
                                SET status_id = ?
                                WHERE id = ?;");
        $query->execute([$newStatus, $parcelId]);

        $result = $query->fetchColumn();
        return $result;
    }

    /**
     * return parcel status
     *
     * @param $parcelId
     * @return int
     *
     * @author Marion
     */
    public function getStaus($parcelId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT status_id FROM " . $this->_name . " WHERE id = ?;");
        $query->execute([$parcelId]);

        $status = $query->fetchColumn();

        return $status;
    }

    /**
     * add tracking number to a parcel
     *
     * @param $parcelId
     * @param $trackingNumber
     *
     * @author Marion
     */
    public function addTrackingNuber($parcelId, $trackingNumber) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . "
                                SET tracking_number = ?
                                WHERE id = ?;");

        $query->execute([$trackingNumber, $parcelId]);
    }

    /**
     * return parcel id
     *
     * @param int $trackingNumber
     * @return int
     *
     * @author Marion
     */
    public function getIdFromTrackingNumber($trackingNumber) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT id FROM " . $this->_name . " WHERE tracking_number = ?;");
        $query->execute([$trackingNumber]);

        $res = $query->fetchColumn();

        return $res;
    }

    public function getAllBillDatas($trackingNumber) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT Parcel.delivery_type, Parcel.weight, parcel.id
                                    ,OrderParcel.parcel_id, OrderParcel.order_id
                                    ,Orders.id, Orders.order_date AS date, Orders.departure_address, Orders.arrival_address,
                                    Orders.total_price AS totalPrice, Orders.order_date, Orders.ordered_by
                                    ,Orders.deliver_to
                                    -- ,ParcelExtra.parcel_id, ParcelExtra.extra_id
                                    ,wp.price AS weightPrice
                                    ,u1.id, u1.first_name AS send_firstname, u1.last_name AS send_lastname
                                    ,u2.id, u2.first_name AS rec_firstname, u2.last_name AS rec_lastname
                                    ,ad1.address AS send_addr, ad1.zip_code AS send_cp, ad1.city AS send_city
                                    ,ad2.address AS rec_addr, ad2.zip_code AS rec_cp, ad2.city AS rec_city
                                    ,dt.label
                                FROM Parcel
                                LEFT JOIN OrderParcel
                                    ON OrderParcel.parcel_id = Parcel.id

                                LEFT JOIN Orders
                                    ON Orders.id = OrderParcel.order_id

                                -- LEFT JOIN ParcelExtra
                                   -- ON ParcelExtra.parcel_id = Parcel.id

                                -- LEFT JOIN Extra
                                   -- ON ParcelExtra.extra_id = Extra.id

                                LEFT JOIN WeightPrice AS wp
                                    ON Parcel.weight BETWEEN wp.min_weight AND wp.max_weight

                                LEFT JOIN User AS u1
                                    ON Orders.ordered_by = u1.id

                                LEFT JOIN User AS u2
                                    ON Orders.deliver_to = u2.id

                                LEFT JOIN Address AS ad1
                                    ON Orders.departure_address = ad1.id

                                LEFT JOIN Address AS ad2
                                    ON Orders.arrival_address = ad2.id

                                LEFT JOIN DeliveryType AS dt
                                    ON dt.id = Parcel.delivery_type

                                WHERE Parcel.tracking_number = ?
                                AND Parcel.delivery_type = wp.delivery_type;");
        $query->execute([$trackingNumber]);

        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        return $res;

    }
}