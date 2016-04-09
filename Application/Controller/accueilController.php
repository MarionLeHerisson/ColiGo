<?php

require_once('../../library/coligo.php');

class accueilController {

	public function indexAction() {
		
		//echo '<pre>';print_r($_SESSION);
		// Connexion
		if(isset($_POST['comail']) && $_POST['comail'] != '' && isset($_POST['copwd']) && $_POST['copwd'] != '') {
			
			$mail = ColiGo::sanitizeString($_POST['comail']);
			$pwd = md5($_POST['copwd']);
			
			require_once('../Model/userModel.php');
			$userManager = new UserModel;
			$type = $userManager->connexion($mail, $pwd);

			if($type != 4) {
				
				// TODO : Rediriger de manière plus "propre"
				
				echo '<script type="text/javascript">
						document.location.href="accueil_extranet";
					</script>';
				
			} else if ($type == 0) {
				// TODO : gérer avec une exception ? 
			}
		}
	}
}