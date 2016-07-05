<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 05/04/16
 * Time: 22:17
 */


require_once("defaultModel.php");

class UserModel extends defaultModel {

    protected $_name = 'User';

    /**
     * insert a new user
     *
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $pwd
     * @param int $type
     * @param int|string $address_id
     * @return string
     *
     * @author Marion
     */
    public function insertUser($firstname, $lastname, $email, $pwd, $type, $address_id = 'NULL') {

        $bdd = $this->connectBdd();

        // insert user
        $query = $bdd->prepare("INSERT INTO " . $this->_name . " (first_name, last_name, mail, password, type_id, address_id)
                                VALUES ('" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $pwd ."', " . $type . ",
                                " . $address_id ."); SELECT LAST_INSERT_ID();");
        $query->execute();

        $res = $query->fetchColumn();

        return $res;
    }

    /**
     * get user from mail
     *
     * @param string $userMail
     * @return array
     *
     * @author Marion
     */
    public function getUserByMail($userMail) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT id, address_id, first_name, last_name, type_id, address_id FROM " . $this->_name . "
                                WHERE mail = '" . $userMail . "'
                                AND is_deleted = 0;");
        $query->execute();

        $result = $query->fetchAll();

        return $result;

    }

    /**
     * @param string $firstname
     * @param string $lastname
     * @return array
     *
     * @author Marion
     */
    public function getUserByName($firstname, $lastname) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT id, address_id, first_name, last_name, type_id FROM " . $this->_name . "
                                WHERE first_name = '" . $firstname . "'
                                AND last_name = '" . $lastname . "'
                                AND is_deleted = 0;");
        $query->execute();

        $result = $query->fetchAll();

        return $result;

    }


    /**
     * Connect user and return its role
     *
     * @param string $mail
     * @param string $pwd
     * @return int
     *
     * @author Marion
     */
    public function connexion($mail, $pwd){

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT id, first_name, last_name, mail, type_id, address_id FROM " . $this->_name . "
                                WHERE mail='" . $mail ."' AND password='". $pwd ."' AND is_deleted = 0;");
        $query->execute();

        $tab = $query->fetchAll();

        $_SESSION['id'] = $tab[0]['id'];
        $_SESSION['first_name'] = $tab[0]['first_name'];
        $_SESSION['last_name'] = $tab[0]['last_name'];
        $_SESSION['mail'] = $tab[0]['mail'];
        $_SESSION['type'] = $tab[0]['type_id'];
        $_SESSION['address'] = $tab[0]['address_id'];

        return $tab[0]['type_id'];
    }


    /**
     * Return type_id of an user from its user_id
     *
     * @param int $id
     * @return int
     *
     * @author Marion
     */
    public function getUserType($id) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT type_id FROM " . $this->_name . "
                                WHERE id=" . intval($id) .";");
        $query->execute();

        $res = $query->fetchColumn();
        return $res;
    }

    /**
     * Update user rights
     *
     * @param int $userId
     * @param int $type
     *
     * @author Marion
     */
    public function updateRights($userId, $type) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . " SET type_id = " . intval($type) . " WHERE id = " . intval($userId) . " AND is_deleted = 0;");
        $query->execute();
    }

    /**
     * Update user rights from mail
     *
     * @param string $userMail
     * @param int $newRole
     * @return int
     *
     * @author Marion
     */
    public function updateRightsFromMail($userMail, $newRole) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . " SET type_id = " . intval($newRole) . " WHERE mail LIKE '" . $userMail . "' AND is_deleted = 0;");
        $query->execute();

        $res = $query->fetchColumn();
        return $res;
    }

    /**
     * Get RP id from user id
     *
     * @param int $userId
     * @return array
     *
     * @author Marion
     */
    public function getFavoriteRP($userId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT user.id
                                ,favoriterelaypoint.user_id,favoriterelaypoint.relay_point_id,favoriterelaypoint.is_deleted
                                ,relaypoint.id,relaypoint.address,relaypoint.label
                                ,address.id, address.address, address.zip_code,address.city
                                FROM " . $this->_name ."
                                LEFT JOIN favoriterelaypoint ON favoriterelaypoint.user_id = user.id
                                LEFT JOIN relaypoint ON relaypoint.id = favoriterelaypoint.relay_point_id
                                LEFT JOIN address ON address.id = relaypoint.address
                                WHERE favoriterelaypoint.is_deleted = 0
                                AND user.id =" . $userId . ";");
        $query->execute();

        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    /**
     * @param int $key
     * @return array
     *
     * @author Marion
     */
    public function getUserByKey($key) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT id, first_name, last_name, mail, password, type_id, address_id
                                FROM " . $this->_name . "
                                WHERE lost_pwd_key = " . $key . "
                                AND is_deleted = 0;");
        $query->execute();

        $res = $query->fetchColumn();
        return $res;
    }

    /**
     * If user is deleted, reactivte account
     *
     * @param int $userId
     * @return string
     *
     * @author Marion
     */
    public function reactivateAccount($userId) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . "
                                SET is_deleted = 0
                                WHERE id = " . $userId . "
                                AND is_deleted = 1;");
        $query->execute();

        $res = $query->fetchColumn();
        return $res;
    }

    /**
     * @param int $userId
     * @param int $key
     * @return string
     *
     * @author Marion
     */
    public function setNewKey($userId, $key) {

        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . "
                                SET lost_pwd_key = " . $key . "
                                WHERE id = " . $userId . "
                                AND is_deleted = 0;");
        $query->execute();

        $res = $query->fetchColumn();
        return $res;
    }

    /**
     * update a mail
     * @param string $newMail
     * @param int $userId
     * @return string
     * @author Marion
     */
    public function setNewMail($newMail, $userId) {
        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . "
                                SET mail = '" . $newMail . "'
                                WHERE id = " . $userId . "
                                AND is_deleted = 0;");
        $query->execute();

        $res = $query->fetchColumn();
        return $res;
    }

    /**
     * update a password
     * @param String $newPwd
     * @param int $userId
     * @return string
     * @author Marion
     */
    public function setNewPwd($newPwd, $userId) {
        $bdd = $this->connectBdd();

        $query = $bdd->prepare("UPDATE " . $this->_name . "
                                SET password = '" . $newPwd . "'
                                WHERE id = " . $userId . "
                                AND is_deleted = 0;");
        $query->execute();

        $res = $query->fetchColumn();
        return $res;
    }

    /**
     * return the md5 password of an user
     * @param int $userId
     * @return string
     * @author Marion
     */
    public function getPwd($userId) {
        $bdd = $this->connectBdd();

        $query = $bdd->prepare("SELECT password
                                FROM " . $this->_name . "
                                WHERE id = " . $userId . "
                                AND is_deleted = 0;");
        $query->execute();

        $res = $query->fetchColumn();
        return $res;
    }
}