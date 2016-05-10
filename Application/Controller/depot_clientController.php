<?php

class depot_clientController {

    public function indexAction() {
        // manager
        include_once('../Model/extraModel.php');
        $extraManager = new ExtraModel();

        // view
        $blockedFirstname = '';
        $blockedLastname = '';
        $blockedMail = '';
        $disabled = '';

        $info = 'Vos informations :';
        $extraPrices = $extraManager->getAllExtras();

        if(isset($_SESSION['type'])) {
            $blockedFirstname = $_SESSION['first_name'];
            $blockedLastname = $_SESSION['last_name'];
            $blockedMail = $_SESSION['mail'];
            $disabled = 'disabled';
        }

        require_once('../View/header.php');
        require_once('../View/depot-client.php');
        require_once('../View/footer.php');
    }
}