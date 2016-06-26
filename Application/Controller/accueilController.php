<?php

class accueilController {

	public function indexAction() {
		require_once('../View/header.php');
		require_once('../View/accueil_site.php');
		require_once('../View/footer.php');
	}
}