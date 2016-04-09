<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 09/04/16
 * Time: 21:05
 */

include_once 'defaultModel.php';

class WeightPriceModel extends DefaultModel {

    protected $_name = 'WeightPrice';

    /**
     * Return price for a weight
     *
     * @param float $weight
     * @param int $type
     * @return float
     *
     * @author Marion
     */
    public function getPrice($weight, $type) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT price FROM " . $this->_name . "
                       WHERE delivery_type = " . $type . "
                       AND " . $weight . " BETWEEN min_weight AND max_weight;");
        $query->execute();

        $result = $query->fetchColumn();

        return $result;

    }
}