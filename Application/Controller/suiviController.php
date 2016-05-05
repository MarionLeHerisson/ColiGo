<?php

class suiviController {

    public function indexAction() {

        // Managers
        include_once('../Model/trackingModel.php');
        $trackingManager = new TrackingModel();

        $trackingNumber = intval($_SERVER['REDIRECT_QUERY_STRING']);
        $trackingStates = $trackingManager->getParcelTracking($trackingNumber);

        require_once('../View/header.php');
        require_once('../View/suivi.php');
        require_once('../View/footer.php');
    }
}