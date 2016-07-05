<?php

//require_once('../../const.php');

class DefaultModel {

    protected $coBdd = null;
	
	// connect to bdd
	public function connectBdd() {

        if(isset($this->coBdd)) {
            return $this->coBdd;
        }
        else {
            try {
                $bdd = new PDO("mysql:host=" . HOSTNAME . ";dbname=" . DBNAME, DBLOGIN, DBPWD, array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
                // Permet de passer le contenu de la BBD en UTF-8
            }

            catch(Exception $e) {
                die("erreur :".$e->getMessage());
            }

            $this->coBdd = $bdd;

            return $this->coBdd;
        }
	}
}