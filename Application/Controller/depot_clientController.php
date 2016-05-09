<?php

class depot_clientController {

    public function indexAction() {
        // manager
        include_once('../Model/extraModel.php');
        $extraManager = new ExtraModel();

        // view
        $info = 'Vos informations :';
        $extraPrices = $extraManager->getAllExtras();
        //echo'<pre>';print_r($extraPrices);die;

        require_once('../View/header.php');
        require_once('../View/depot-client.php');
        require_once('../View/footer.php');
    }
}