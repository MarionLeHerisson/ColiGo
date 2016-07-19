<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 19/07/16
 * Time: 11:13
 */

class itineraireController {

    public function indexAction() {

        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $this->Ajax($_POST);
        }

        require_once('../View/header.php');
        require_once('../View/itineraire.php');
        require_once('../View/footer.php');

    }

    private function Ajax($post) {

        $action = $post['action'];
        $param = null;

        if(isset($post['param'])) {
            $param = $post['param'];
        }

        require_once('../Model/Ajax/AjaxItineraire.php');
        $ajaxApi = new AjaxItineraire();


        switch($action) {
            case 'getDriverAddress' :
                $ajaxApi->getDriverAddress($param);
                break;
            case 'getClosestRP' :
                $ajaxApi->getClosestRP($param);
                break;
            case 'getParcelsRP' :
                $ajaxApi->getParcelsRP($param);
                break;
        }
    }
}