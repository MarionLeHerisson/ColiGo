<?php

class inscriptionController {
	
	public function indexAction() {
		// TODO : Si l'user qui s'inscrit existe déjà (= a déjà passé une commande) lui proposer de lui envoyer un mdp provisoire

        require_once('../View/header.php');
        require_once('../View/inscription.php');
        require_once('../View/footer.php');
	}
}