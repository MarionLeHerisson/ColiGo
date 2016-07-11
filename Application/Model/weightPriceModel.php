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
                       WHERE delivery_type = ?
                       AND ? BETWEEN min_weight AND max_weight;");
        $query->execute([$type, $weight]);

        $result = $query->fetchColumn();

        return $result;

    }

    /**
     * Return all prices (used in 'envoyer')
     *
     * @return array
     */
    public function getAllPrices() {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT delivery_type, max_weight, price FROM " . $this->_name . "
                                ORDER BY max_weight;");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }
}