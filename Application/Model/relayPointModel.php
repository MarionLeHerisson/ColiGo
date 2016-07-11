<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 09/04/16
 * Time: 23:56
 */

include_once 'defaultModel.php';

class RelayPointModel extends DefaultModel {

    protected $_name = 'RelayPoint';


    public function insertRelayPoint($address, $ownerId, $label) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("INSERT INTO " . $this->_name . "(address, owner_id, label, is_deleted)
                                VALUES (" . $address . ", " . $ownerId . ", '" . $label . "', 0)");
        $query->execute();

        $query = $bdd->prepare("SELECT LAST_INSERT_ID();");
        $res = $query->execute();

        return $res;
    }


    /**
     * return address id from relay point id
     *
     * @param int $rpId
     * @return int
     *
     * @author Marion
     */
    public function getRPAddress($rpId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT address FROM " . $this->_name . " WHERE id = " . $rpId . ";");
        $query->execute();

        $res = $query->fetchColumn();

        return $res;
    }

    /**
     * @param String $mail
     * @return int
     */
    public function getRpIdFromMail($mail) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT " . $this->_name . ".id FROM " . $this->_name . "
                                LEFT JOIN user
                                ON user.id = owner_id
                                WHERE user.mail = '" . $mail . "';");
        $query->execute();

        $res = $query->fetchColumn();

        return $res;
    }

    /**
     * Return all relay points
     * @return array
     */
    public function getAllRelayPoints() {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT rp.id, rp.address, rp.label, CONCAT(a.address, ', ', a.zip_code, ', ', a.city) AS completeAddress,
                                a.lat, a.lng, a.address, a.zip_code, a.city
                                FROM " . $this->_name . " AS rp
                                LEFT JOIN Address AS a ON a.id = rp.address
                                WHERE rp.is_deleted = 0;");
        $query->execute();

        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    /**
     * Returns the closest relay points from address, zip code, city, ...
     * @param float $minLat
     * @param float $maxLat
     * @param float $minLng
     * @param float $maxLng
     * @return array
     */
    public function getClosestRelayPoints($minLat, $maxLat, $minLng, $maxLng) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT rp.id, rp.address, rp.label, CONCAT(a.address, ', ', a.zip_code, ', ', a.city) AS completeAddress,
                                a.lat, a.lng, a.address, a.zip_code, a.city
                                FROM " . $this->_name . " AS rp
                                LEFT JOIN Address AS a ON a.id = rp.address
                                WHERE a.lat BETWEEN " . $minLat . " AND " . $maxLat . "
                                AND a.lng BETWEEN " . $minLng . " AND " . $maxLng . "
                                AND rp.is_deleted = 0;");
        $query->execute();

        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    /**
     * @param $ownerId
     * @param $date
     * @return array
     */
    public function getDayParcels($ownerId, $date) {
        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT rp.id, rp.owner_id, rp.address
                                 , odep.departure_address, odep.id, odep.order_date
                                 , oarr.arrival_address, oarr.id, oarr.delivery_date
                                 , op.order_id, op.parcel_id
                                 , p.weight, p.id, p.delivery_type
                                 , wp.min_weight, wp.max_weight, wp.price, wp.id, wp.delivery_type

                                 FROM " . $this->_name . " AS rp

                                 LEFT JOIN Orders AS odep
                                 ON odep.departure_address = rp.address

                                 LEFT JOIN Orders AS oarr
                                 ON oarr.arrival_address = rp.address

                                 LEFT JOIN OrderParcel AS op
                                 ON op.order_id = odep.id OR op.order_id = oarr.id

                                 LEFT JOIN Parcel AS p
                                 ON p.id = op.parcel_id

                                 LEFT JOIN WeightPrice AS wp
                                 ON  wp.delivery_type =p.delivery_type
                                 AND p.weight BETWEEN wp.min_weight AND wp.max_weight

                                 WHERE rp.owner_id = ?
                                 AND odep.order_date = ?
                                 OR oarr.delivery_date = ?;");
        $query->execute([$ownerId, $date, $date]);

        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    /**
     * @param int $ownerId
     * @param int $month (january = 1, not 01)
     * @return array
     */
    public function getMonthParcels($ownerId, $month) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT rp.id, rp.owner_id, rp.address
                                 , odep.departure_address, odep.id, odep.order_date
                                 , oarr.arrival_address, oarr.id, oarr.delivery_date
                                 , op.order_id, op.parcel_id
                                 , p.weight, p.id, p.delivery_type
                                 , wp.min_weight, wp.max_weight, wp.price, wp.id, wp.delivery_type

                                FROM " . $this->_name . " AS rp

                                 LEFT JOIN Orders AS odep
                                 ON odep.departure_address = rp.address

                                 LEFT JOIN Orders AS oarr
                                 ON oarr.arrival_address = rp.address

                                 LEFT JOIN OrderParcel AS op
                                 ON op.order_id = odep.id OR op.order_id = oarr.id

                                 LEFT JOIN Parcel AS p
                                 ON p.id = op.parcel_id

                                 LEFT JOIN WeightPrice AS wp
                                 ON  wp.delivery_type =p.delivery_type
                                 AND p.weight BETWEEN wp.min_weight AND wp.max_weight

                                WHERE rp.owner_id = ?
                                 AND MONTH(odep.order_date) = ?
                                 OR MONTH(oarr.delivery_date) = ?;");
        $query->execute([$ownerId, $month, $month]);

        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        return $res;

    }
}