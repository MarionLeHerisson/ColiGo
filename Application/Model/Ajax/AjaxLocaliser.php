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

    /**
     * @param array $param
     */
    public function addFavorite($param) {
        $rpId = intval($param[0]);

        // managers
        require_once('../Model/FavoriteRelayPointModel.php');
        $favoriteRPManager = new FavoriteRelayPointModel();

        require_once('../Model/relayPointModel.php');
        $rpManager = new RelayPointModel();

        $userId = $_SESSION['id'];
        $favoriteRPManager->deleteFavorite($userId);
    // TODO : delete & insert only if needed
        $favoriteRPManager->addFavorite($rpId, $userId);

        $address = $rpManager->getRP($rpId);
        $_SESSION['favRP']['relay_point_id'] = $address[0]['id'];
        $_SESSION['favRP']['address'] = $address[0]['address'];
        $_SESSION['favRP']['label'] = $address[0]['label'];
        $_SESSION['favRP']['zip_code'] = $address[0]['zip_code'];
        $_SESSION['favRP']['city'] = $address[0]['city'];

        die(json_encode([
            'stat'	=> 'ok',
            'msg' => 'Ce point relais a bien été ajouté à vos favoris !'
        ]));
    }

}