<?php

class inscriptionController {
	
	public function indexAction() {

        // ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {

            $action = $_POST['action'];
            $param = $_POST['param'];

            require_once('../Model/Ajax/AjaxInscription.php');
            $ajaxApi = new AjaxInscription();

            switch($action) {
                case 'mailExists' :
                    $ajaxApi->existMail($param);
                    break;
            }
        }

		// TODO : Si l'user qui s'inscrit existe déjà (= a déjà passé une commande) lui proposer de lui envoyer un mdp provisoire

        require_once('../View/header.php');
        require_once('../View/inscription.php');
        require_once('../View/footer.php');
	}
}