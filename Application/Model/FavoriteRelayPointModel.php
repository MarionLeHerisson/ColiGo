<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 26/06/16
 * Time: 16:08
 */

require_once('defaultModel.php');

class FavoriteRelayPointModel extends DefaultModel {

    protected $_name = 'FavoriteRelayPoint';

    /**
     * @param int $rpId
     * @param int $userId
     * @return bool
     */
    public function addFavorite($rpId, $userId) {
        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(user_id, relay_point_id)
                                VALUES (?, ?);");
        $res = $query->execute([$userId, $rpId]);

        return $res;
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function deleteFavorite($userId) {
        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . "
                                SET is_deleted = 1
                                WHERE user_id = ?
                                AND is_deleted = 0;");
        $res = $query->execute([$userId]);

        return $res;
    }
}