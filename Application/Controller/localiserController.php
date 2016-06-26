<?php

class localiserController {

    public function indexAction() {

        // ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {

            $action = $_POST['action'];
            $param = null;

            if(isset($_POST['param'])) {
                $param = $_POST['param'];
            }

            require_once('../Model/Ajax/AjaxLocaliser.php');
            $ajaxApi = new AjaxLocaliser();


            switch($action) {
                case 'searchRP' :
                    $ajaxApi->searchRelayPoint($param);
                    break;
                case 'addFav' :
                    $ajaxApi->addFavorite($param);
                    break;
            }
        }

        require_once('../View/header.php');
        require_once('../View/localiser.php');
        require_once('../View/footer.php');
    }

}