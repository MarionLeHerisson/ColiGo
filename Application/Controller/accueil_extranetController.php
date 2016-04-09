<?php

include_once ('../../library/coligo.php');

class accueil_extranetController {
	
	public function indexAction() {
		
		//require_once('../View/header.php');

		if (isset($_POST['name']) && $_POST['name'] != '') {

			// sort variables
			$userFirstname = ColiGo::sanitizeString($_POST['firstname']);
			$userLastname = ColiGo::sanitizeString($_POST['name']);
			$userMail = ColiGo::sanitizeString($_POST['mail']);
			$deliveryType = ColiGo::sanitizeString($_POST['type']);
			$parcelWeight = ColiGo::sanitizeString($_POST['weight']);

			$receiverLastname = ColiGo::sanitizeString($_POST['destname']);
			$receiverFirstname = ColiGo::sanitizeString($_POST['destfirstname']);
			$receiverAddress = ColiGo::sanitizeString($_POST['streetnumber']) . ColiGo::sanitizeString($_POST['route']);
			$receiverZipCode = ColiGo::sanitizeString($_POST['zipcode']);
			$receiverCity = ColiGo::sanitizeString($_POST['Paris']);

			// managers
			include_once('../Model/userModel.php');
			$userManager = new UserModel();

			include_once('../Model/addressModel.php');
			$addressManager = new AddressModel();

			include_once('../Model/parcelModel.php');
			$parcelManager = new ParcelModel();

			include_once('../Model/parcelExtraModel.php');
			$parcelExtraManager = new ParcelExtraModel();

			$user = $userManager->getUserByMail($userMail);

			// TODO : make it work
			// if user does not exists, subscribe & get its id
			if(empty($user)) {
				$userId = $userManager->insertUser($userFirstname, $userLastname, $userMail, null, 4, null);
			} else {
				$userId = $user[0]['id'];
			}

			// insert Parcel (weight, status = déposé, delivery_type) -> get id
			$parcelId = $parcelManager->insertParcel($parcelWeight, 1, $deliveryType);

			// put extras in an array
			$extras = [];

			if($_POST['emballage'] != 'none') {
				$extras[] = '(' . $parcelId . ',' . ColiGo::sanitizeString($_POST['emballage']) . ')';
			}
			if(isset($_POST['prioritaire'])) {
				$extras[] = '(' . $parcelId . ',' . ColiGo::sanitizeString($_POST['prioritaire']) . ')';
			}
			if(isset($_POST['imprevu'])) {
				$extras[] = '(' . $parcelId . ',' . ColiGo::sanitizeString($_POST['imprevu']) . ')';
			}
			if(isset($_POST['indemnisation'])) {
				$extras[] = '(' . $parcelId . ',' . ColiGo::sanitizeString($_POST['indemnisation']) . ')';
			}
			if(isset($_POST['ramassage'])) {
				$extras[] = '(' . $parcelId . ',' . ColiGo::sanitizeString($_POST['ramassage']) . ')';
			}
			if(isset($_POST['samedi'])) {
				$extras[] = '(' . $parcelId . ',' . ColiGo::sanitizeString($_POST['samedi']) . ')';
			}

			$values = $this->sortValues($extras);

			// link extras and parcel
			$parcelExtraManager->linkMultipleParcelExtra($values);

			// calculate price
			$totalPrice = $this->calculatePrice($extras, $parcelWeight, $deliveryType);

			// if receiver exists -> get id & address_id
			// else subscribe & get id & address_id

			// insert Orders(departure_address, arrival_address, total_price, NOW(), is_deleted = 0, id user order, id user dest, rp_id)

			// at validation, msg OK + open new tab with A4 picture in two parts (or 2 x A4) : bar code + detailed bill
		}


		//echo '<pre>';
		//print_r($_POST);


		require_once('../View/accueil_extranet.php');
		require_once('../View/footer.php');
	}

	/**
	 * add comas to have a correct INSERT INTO table VALUES (a,b),(a,b),(a,b) ...
	 *
	 * @param array $values
	 * @return string
	 *
	 * @author Marion
	 */
	public function sortValues($values) {

		$string = '';

		foreach($values as $val) {
			if($string != '') {
				$string .= ',';
			}
			$string .= $val;
		}

		return $string;
	}

	/**
	 * @param array $extras
	 * @param float $parcelWeight
	 * @param int $deliveryType
	 */
	public function calculatePrice($extras, $parcelWeight, $deliveryType) {
		
	}
}