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
        // managers
        require_once('../Model/FavoriteRelayPointModel.php');
        $favoriteRPManager = new FavoriteRelayPointModel();

        $userId = $_SESSION['id'];
        $favoriteRPManager->deleteFavorite($userId);
    // TODO : delete & insert only if needed
        $favoriteRPManager->addFavorite(intval($param[0]), $userId);

        die(json_encode([
            'stat'	=> 'ok',
            'msg' => 'Ce point relais a bien été ajouté à vos favoris !'
        ]));
    }

}