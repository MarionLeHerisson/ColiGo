<?php
/**
 * Additionnal Price Model
 * Created by Marion.
 * Date: 07/07/2016
 * Time: 16:32
 */

require_once('defaultModel.php');
class AdditionnalPriceModel extends DefaultModel {

    protected $_name = 'AdditionnalPrice';

    /**
     * Links an additionnal price to an order
     * @param int $orderId
     * @param float $price
     * @return string
     * @author Marion
     */
    public function linkOrderAddPrice($orderId, $price) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(order_id, price)
                                VALUES (" . $orderId . ", " . $price . ");");
        $query->execute();
        $res = $query->fetchColumn();

        return $res;
    }

}