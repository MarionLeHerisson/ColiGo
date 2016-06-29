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
        $isactive = '';
        $fav_streetnumber = '';
        $fav_city = '';
        $fav_zipcode = '';
        $fav_country = '';

        $info = 'Vos informations :';
        $extraPrices = $extraManager->getAllExtras();

        if(isset($_SESSION['type'])) {
            $blockedFirstname = $_SESSION['first_name'];
            $blockedLastname = $_SESSION['last_name'];
            $blockedMail = $_SESSION['mail'];
            $disabled = 'disabled';

            if(isset($_SESSION['favRP']) && is_array($_SESSION['favRP'])) {
                $isactive = ' active';
                $fav_label =  $_SESSION['favRP']['label'];
                $fav_streetnumber = $_SESSION['favRP']['address'];
                $fav_city = $_SESSION['favRP']['city'];
                $fav_zipcode = $_SESSION['favRP']['zip_code'];
                $fav_country = 'France';
            }
        }

        require_once('../View/header.php');
        require_once('../View/depot-client.php');
        require_once('../View/footer.php');
    }
}