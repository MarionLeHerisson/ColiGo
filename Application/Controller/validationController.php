<?php

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

				$address = trim($_POST['streetnumber']) . ', ' . trim($_POST['route']);
				$zipcode = trim($_POST['zipcode']);
				$city = trim($_POST['city']);

				// If address exists, use existing id for this address
				$address_id = $addressManager->existAddress($address, $zipcode, $city);

				if($address_id == null) {
					$address_id = $addressManager->insertAddress($address, $zipcode, $city);
				}

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


			// if inscription not from extranet
			if(!isset($_SESSION['type'])) {
				$user = $userManager->connexion($mail, $pwd);

				$_SESSION['id'] = $user['id'];
				$_SESSION['first_name'] = $user['first_name'];
				$_SESSION['last_name'] = $user['last_name'];
				$_SESSION['mail'] = $user['mail'];
				$_SESSION['type'] = $user['type_id'];
				$_SESSION['address'] = $user['address_id'];

				require_once("../View/header.php");
				require_once('../View/validInscription.php');
				require_once('../View/footer.php');
			}
			else {
				echo '<script type="text/javascript">
						document.location.href="accueil_extranet";
					</script>';
			}
		}
		else {
			echo '<script type="text/javascript">
						document.location.href="accueil";
					</script>';
		}



	}
}