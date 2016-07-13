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

    /**
     * get favorite ralay point
     * @return bool
     * @author Marion
     */
    public function getFavorite() {
        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT fav.user_id, fav.relay_point_id
                                , rp.address AS add_id, rp.label
                                , a.address, a.zip_code, a.city
                                FROM " . $this->_name . " AS fav
                                LEFT JOIN relaypoint AS rp ON rp.id = fav.relay_point_id
                                LEFT JOIN address AS a ON a.id = rp.address
                                WHERE fav.user_id = ?
                                AND fav.is_deleted = 0;");
        $query->execute([$_SESSION['id']]);

        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        return $res[0];
    }
}