<?php

require_once('../../library/coligo.php');

class accueilController {

	public function indexAction() {

	}

	public function connectAction() {

		if(isset($_POST['comail']) && $_POST['comail'] != '' && isset($_POST['copwd']) && $_POST['copwd'] != '') {

			$mail = ColiGo::sanitizeString($_POST['comail']);
			$pwd = md5($_POST['copwd']);

			// manager
			require_once('../Model/userModel.php');
			$userManager = new UserModel;

			// connect user
			$type = $userManager->connexion($mail, $pwd);

			// if the user works for ColiGo -> redirect him to extranet
			if($type != 4) {

				// TODO : "clean" redirection ?

				echo '<script type="text/javascript">
						document.location.href="accueil_extranet";
					</script>';

			}
		}
	}
}