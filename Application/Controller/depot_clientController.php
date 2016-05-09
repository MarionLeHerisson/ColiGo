<?php

class depot_clientController {

    public function indexAction() {

        $info = 'Vos informations :';

        require_once('../View/header.php');
        require_once('../View/depot-client.php');
        require_once('../View/footer.php');
    }
}