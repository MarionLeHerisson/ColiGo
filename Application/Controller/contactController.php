<?php

class contactController {

    public function indexAction() {

        if(isset($_POST['action']) && !empty($_POST['action'])) {

            $action = $_POST['action'];
            $param = $_POST['param'];

            require_once('../Model/Ajax/AjaxContact.php');
            $ajaxApi = new AjaxContact();

            switch($action) {
                case 'sendMessage' :
                    $ajaxApi->sendMessage($param);
                    break;
            }
        }

        require_once('../View/header.php');
        require_once('../View/contact.php');
        require_once('../View/footer.php');
    }

}