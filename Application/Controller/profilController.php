<?php

class profilController {

    public function indexAction() {

        $profil = [];
        include_once('../View/header.php');
        include_once('../View/profil.php');
        include_once('../View/footer.php');
    }
}