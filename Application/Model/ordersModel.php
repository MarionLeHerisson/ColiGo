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

    public function setArrivalDate($parcelId) {

        $bdd = $this->connectBdd();
// TODO : à tester
        $query = $bdd->prepare("UPDATE " . $this->_name . "
                                SET delivery_date = NOW()
                                WHERE id =
                                (SELECT o.id FROM Orders AS o
                                LEFT JOIN OrderParcel AS op
                                ON op.order_id = o.id
                                WHERE op.parcel_id = " . $parcelId . ");");
        $query->execute();

        $res = $query->fetchColumn();

        return $res;
    }
}