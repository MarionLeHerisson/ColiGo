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
                                NOW(), " . $rpId . ", " . $userId . ", " . $reciverId . "); SELECT LAST_INSERT_ID();");
        $query->execute();

        $res = $query->fetchColumn();

        return $res;
    }
}