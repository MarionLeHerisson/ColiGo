<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 09/04/16
 * Time: 23:42
 */

include_once('defaultModel.php');

class OrdersModel extends DefaultModel {

    protected $_name = 'Orders';

    /**
     * @param int $departureAddress
     * @param int $arrivalAddress
     * @param float $totalPrice
     * @param int $userId
     * @param int $reciverId
     * @param int $rpId
     * @return int
     */
    public function insertOrder($departureAddress, $arrivalAddress, $totalPrice, $userId, $reciverId, $rpId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(departure_address, arrival_address, total_price,
                                order_date, ordered_from, ordered_by, deliver_to)
                                VALUES(" . $departureAddress . ", " . $arrivalAddress . ", " . $totalPrice . ",
                                NOW(), " . $rpId . ", " . $userId . ", " . $reciverId . ");");
        $query->execute();

        $query2 = $bdd->prepare("SELECT LAST_INSERT_ID();");
        $query2->execute();

        $res = $query2->fetchColumn();

        return $res;
    }

    /**
     * @param int $parcelId
     * @return string
     * @author Marion
     */
    public function setArrivalDate($parcelId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . "
                                SET delivery_date = NOW()
                                WHERE id =
                                (SELECT OrderParcel.order_id
                                FROM OrderParcel
                                WHERE OrderParcel.parcel_id = " . $parcelId . ");");
        $query->execute();

        $res = $query->fetchColumn();

        return $res;
    }

    /**
     * @param int $userId
     * @return array
     * @author Marion
     */
    public function getOrdersHistory($userId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT orders.id, orders.departure_address, orders.arrival_address, orders.total_price, orders.order_date, orders.ordered_by
                                ,op.order_id, op.parcel_id
                                ,a1.id, a1.address AS dep_address, a1.zip_code AS dep_zipcode, a1.city AS dep_city
                                ,rp1.id, rp1.label AS dep_label, rp1.address
                                ,a2.id, a2.address AS arr_address, a2.zip_code AS arr_zipcode, a2.city AS arr_city
                                ,rp2.id, rp2.label AS arr_label, rp2.address
                                ,p.id, p.tracking_number, p.status_id
                                ,tracking.parcel_id, tracking.status_id, tracking.new_status_date AS status_date
                                ,ps.id, ps.label AS status
                                ,u.first_name, u.last_name

                                FROM " . $this->_name . "
                                LEFT JOIN orderparcel AS op ON op.order_id = orders.id
                                LEFT JOIN address AS a1 ON a1.id = orders.departure_address
                                LEFT JOIN RelayPoint AS rp1 ON rp1.address = a1.id
                                LEFT JOIN address AS a2 ON a2.id = orders.arrival_address
                                LEFT JOIN RelayPoint AS rp2 ON rp2.address = a2.id
                                LEFT JOIN parcel AS p ON p.id = op.parcel_id
                                LEFT JOIN tracking ON tracking.parcel_id = p.id
                                LEFT JOIN ParcelStatus AS ps ON ps.id = Tracking.status_id
                                LEFT JOIN user AS u ON u.id = orders.deliver_to

                                WHERE ordered_by = " . $userId . "
                                AND tracking.status_id = p.status_id

                                ORDER BY orders.order_date DESC;");

        $query->execute();

        //$res = $query->fetch(PDO::FETCH_ASSOC);
        $res = $query->fetchAll();

        return $res;
    }
}