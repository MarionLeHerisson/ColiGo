<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 01/06/16
 * Time: 20:04
 */

class AjaxLocaliser {

    /**
     * @param array $param
     */
    public function searchRelayPoint($param) {

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