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


            switch($action) {
                case 'searchRP' :
                    $this->searchRelayPoint($param);
                    break;
            }
        }

        require_once('../View/header.php');
        require_once('../View/localiser.php');
        require_once('../View/footer.php');
    }

    /**
     * @param array $param
     */
    protected function searchRelayPoint($param) {

        $zipCode = $param[0];

        // managers
        require_once('../Model/relayPointModel.php');
        $relayPointManager = new RelayPointModel();

        if(empty($param)) {
            $rps = $relayPointManager->getAllRelayPoints();
        } else {
            $rps = $relayPointManager->getClosestRelayPoints($param[0], $param[1], $param[2], $param[3]);
        }

        //if(empty ..)

        die(json_encode([
            'stat'	=> 'ok',
            'relayPoints' => $rps
        ]));
    }
}