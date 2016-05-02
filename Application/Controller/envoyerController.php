<?php

require_once('../../library/coligo.php');

class envoyerController {

    public function indexAction() {

        // Manager
        include_once('../Model/weightPriceModel.php');
        $weightPriceManager = new WeightPriceModel();

        $prices = $weightPriceManager->getAllPrices();

        $prices = $this->sortPrices($prices);
 //       echo '<pre>';
   //     die(print_r($prices));
        require_once('../View/header.php');
        require_once('../View/envoyer.php');
        require_once('../View/footer.php');
    }

    /**
     * @param array $prices
     * @return array
     */
    public function sortPrices($prices) {
        $sortedPrices = [];

        foreach($prices as $price) {

            $sortedPrices[$price['max_weight'] . ' Kg'][$price['delivery_type']] = $price['price'] . ' €';

        }

        return $sortedPrices;
    }
}