<?php

class envoyerController {

    public function indexAction() {

        // Manager
        include_once('../Model/weightPriceModel.php');
        $weightPriceManager = new WeightPriceModel();

        include_once('../Model/extraModel.php');
        $extraManager = new ExtraModel();

        $prices = $weightPriceManager->getAllPrices();

        $prices = $this->sortPrices($prices);
        $extras = $extraManager->getAllExtras();

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