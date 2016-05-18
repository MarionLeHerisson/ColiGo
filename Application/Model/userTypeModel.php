<?php

require_once("defaultModel.php");

class UserTypeModel extends defaultModel {

    protected $_name = 'UserType';

    /**
     * return all user types
     * @return array
     */
    public function getAllTypes() {

        $bdd = $this->connectBdd();

        // insert user
        $query = $bdd->prepare("SELECT id, label
                                FROM " . $this->_name . ";");
        $query->execute();

        $res = $query->fetchAll();

        return $res;
    }
}