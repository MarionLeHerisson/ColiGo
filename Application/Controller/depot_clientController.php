<?php

class depot_clientController {

    public function indexAction() {

        $exploded = explode('/', $_SERVER['REDIRECT_URL']);
        $len = sizeof($exploded) - 1;
        $thisPage = $exploded[$len];

        if($thisPage == 'depot_client') {
            $info = 'Vos informations :';
        }
        else {
            $info = 'Informations client';
        }

        require_once('../View/header.php');
        require_once('../View/depot-client.php');
        require_once('../View/footer.php');
    }
}