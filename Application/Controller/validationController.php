<?php
include_once('../../library/coligo.php');

class validationController {

	public function indexAction() {
		if(isset($_POST['firstname'])) {
			// infos d'inscription
			$firstname = ColiGo::sanitizeString($_POST['firstname']);
			$lastname = ColiGo::sanitizeString($_POST['lastname']);
			$mail = ColiGo::sanitizeString($_POST['email']);
			$pwd = md5($_POST['pwd']);

			// managers
			require_once('../Model/userModel.php');
			$userManager = new UserModel;

			require_once('../Model/addressModel.php');
			$addressManager = new AddressModel;

			// Si il y a une adresse
			if(isset($_POST['streetnumber'])) {
				$address = trim($_POST['streetnumber']) . ' ' . trim($_POST['route']);
				$zipcode = trim($_POST['zipcode']);
				$city = trim($_POST['city']);

				// insertion de l'adresse
				$address_id = $addressManager->insertAddress($address, $zipcode, $city);
			}
			else {
				$address_id = null;
			}

			// insertion utilisateur
			$userManager->insertUser($firstname, $lastname, $mail, $pwd, 4, $address_id);
			// envoi de mail
			mail($mail, "Votre inscription chez ColiGo", "Félicitation, vous êtes bien inscrit chez Coligo !");
		}
		
		else echo 'pas de données';
	}
}