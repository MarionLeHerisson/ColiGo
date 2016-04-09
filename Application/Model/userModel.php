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

    // insert a new user
    public function insertUser($firstname, $lastname, $email, $pwd, $type, $address_id) {

        $bdd = $this->connectBdd();

        // insert user
        $query = $bdd->prepare("INSERT INTO " . $this->_name . " (first_name, last_name, mail, password, type_id, address_id, is_deleted)
                                VALUES ('" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $pwd ."', " . $type . ", " . $address_id .", 0);");
        $query->execute();

        $query = $bdd->prepare("SELECT LAST_INSERT_ID();");
        $res = $query->execute();

        return $res;
    }

    // get user from mail
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

        $query = $bdd->prepare("SELECT id, address_id, first_name, last_name, type_id, address_id FROM " . $this->_name . "
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

        $query = $bdd->prepare("SELECT id, first_name, last_name, type_id, address_id FROM " . $this->_name . "
                                WHERE mail='" . $mail ."' AND password='". $pwd ."' AND is_deleted = 0;");
        $query->execute();

        $tab = $query->fetchAll();

        $_SESSION['id'] = $tab[0]['id'];
        $_SESSION['first_name'] = $tab[0]['first_name'];
        $_SESSION['last_name'] = $tab[0]['last_name'];
        $_SESSION['type'] = $tab[0]['type_id'];
        $_SESSION['address'] = $tab[0]['address_id'];

        return $tab[0]['type_id'];
    }
}