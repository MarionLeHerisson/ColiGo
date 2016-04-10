<?php
include_once('../../library/coligo.php');

class validationController {

	public function indexAction() {
		if(isset($_POST['firstname'])) {
			// inscription informations
			$firstname = ColiGo::sanitizeString($_POST['firstname']);
			$lastname = ColiGo::sanitizeString($_POST['lastname']);
			$mail = ColiGo::sanitizeString($_POST['email']);
			$pwd = md5($_POST['pwd']);

			// managers
			require_once('../Model/userModel.php');
			$userManager = new UserModel;

			// If there is an adresse
			if(isset($_POST['streetnumber'])) {

				require_once('../Model/addressModel.php');
				$addressManager = new AddressModel;

				$address = trim($_POST['streetnumber']) . ' ' . trim($_POST['route']);
				$zipcode = trim($_POST['zipcode']);
				$city = trim($_POST['city']);

				// insertion de l'adresse
				$address_id = $addressManager->insertAddress($address, $zipcode, $city);
			}
			else {
				$address_id = null;
			}

			// default : new user is client
			$userType = 4;
			// if admin subscribe new user
			if(isset($_SESSION['type']) && $_SESSION['type'] == 1 && isset($_POST['usertype'])) {
				$userType = intval($_POST['usertype']);
			}

			// insert new user
			$userId = $userManager->insertUser($firstname, $lastname, $mail, $pwd, $userType, $address_id);
			// envoi de mail
			mail($mail, "Votre inscription chez ColiGo", "Félicitation, vous êtes bien inscrit chez Coligo !");

			// if a relay point is created
			if($userType == 2) {

				require_once('../Model/relayPointModel.php');
				$relayPointManager = new RelayPointModel();

				$relayPointManager->insertRelayPoint($address_id, $userId);
			}
		}
		
		else echo 'pas de données';
	}
}