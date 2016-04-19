<?php

include_once ('../../library/coligo.php');

class accueil_extranetController {
	
	public function indexAction() {

		//echo '<pre>';die(print_r($_POST));
		// ajax
		if(isset($_POST['action']) && !empty($_POST['action'])) {

			$action = $_POST['action'];
			$param = $_POST['param'];

			switch($action) {
				case 'updateParcelStatus' :
					$this->updateStatus($param);
					break;
			}
		}

		// TODO : mettre dans une fonction ajax et pas en plein milieu du Controller
		if (isset($_POST['name']) && $_POST['name'] != '') {
			require_once('header.php');

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

			include_once('../Model/ordersModel.php');
			$ordersManager = new OrdersModel();

			include_once('../Model/relayPointModel.php');
			$relayPointManager = new RelayPointModel();

			// if user does not exists, subscribe & get its id
			$user = $userManager->getUserByMail($userMail);

			if(empty($user)) {
				$userId = $userManager->insertUser($userFirstname, $userLastname, $userMail, null, 4, null);
			} else {
				$userId = $user[0]['id'];
			}

			// insert Parcel (weight, status = déposé, delivery_type) -> get id
			$parcelId = $parcelManager->insertParcel($parcelWeight, 1, $deliveryType);

			// put extras in an array
			$extras = [];

			if(isset($_POST['emballage']) && $_POST['emballage'] != 'none' && intval($_POST['emballage'] != 0)) {
				$extras[] = intval($_POST['emballage']);
			}
			if(isset($_POST['prioritaire'])) {
				$extras[] = 7;
			}
			if(isset($_POST['imprevu'])) {
				$extras[] = 8;
			}
			if(isset($_POST['indemnisation'])) {
				$extras[] = 9;
			}
			if(isset($_POST['ramassage'])) {
				$extras[] = 5;
			}
			if(isset($_POST['samedi'])) {
				$extras[] = 6;
			}

			$values = $this->sortValues($extras, $parcelId);

			// link extras and parcel
			$parcelExtraManager->linkMultipleParcelExtra($values);

			// calculate price
			$totalPrice = $this->calculatePrice($extras, $parcelWeight, $deliveryType);

			// if receiver exists -> get id & address_id
			$receiver = $userManager->getUserByName($receiverFirstname, $receiverLastname);

			if(empty($user)) {
				$reciverId = $userManager->insertUser($receiverFirstname, $receiverLastname, null, null, 4, null);
			} else {
				$reciverId = $receiver[0]['id'];
			}

			// Insert receiver address
			$arrivalAddress = $addressManager->insertAddress($receiverAddress, $receiverZipCode, $receiverCity);

			// Get relay point id
			$rpId = $_SESSION['address'];

			// Get relay point address id TODO : or other departure address
			$depAddressId = $relayPointManager->getRPAddress($rpId);

			// insert Order
			$ordersManager->insertOrder($depAddressId, $arrivalAddress, $totalPrice, $userId, $reciverId, $rpId);

			// at validation, msg OK + open new tab with A4 picture in two parts (or 2 x A4) : bar code + detailed bill
		}

		require_once('../View/header.php');
		require_once('../View/accueil_extranet.php');
		require_once('../View/footer.php');
	}

	/**
	 * add comas to have a correct INSERT INTO table VALUES (a,b),(a,b),(a,b) ...
	 *
	 * @param array $values
	 * @param int $parcelId
	 * @return string
	 *
	 * @author Marion
	 */
	public function sortValues($values, $parcelId) {

		$string = '';

		foreach($values as $val) {
			if($string != '') {
				$string .= ',';
			}
			$string .= '(' . $parcelId . ',' . $val . ')';
		}

		return $string;
	}

	/**
	 * calculate total price
	 *
	 * @param array $extras
	 * @param float $parcelWeight
	 * @param int $deliveryType
	 * @return float
	 *
	 * @author Marion
	 */
	public function calculatePrice($extras, $parcelWeight, $deliveryType) {

		// Managers
		include_once('../Model/extraModel.php');
		$extraManager = new ExtraModel();

		include_once('../Model/weightPriceModel.php');
		$weightPriceManager = new WeightPriceModel();
		$price = 0;

		foreach($extras as $extra) {
			$price += $extraManager->getExtraPrice($extra);
		}

		$weightPrice = $weightPriceManager->getPrice($parcelWeight, $deliveryType);

		return $weightPrice + $price;
	}


	public function updateStatus($param) {

		// manager
		include_once('../Model/parcelModel.php');
		$parcelManager = new ParcelModel();

		$parcelId = $param[0];
		$actualStatus = $parcelManager->getStaus($parcelId);
		$newStatus = $param[1];

		// if parcel doesn't jump a step or is lost
		if($actualStatus + 1 == $newStatus || $newStatus == 5) {
			$res = $parcelManager->updateStatus($parcelId, $newStatus);

			if($res != 1) {
				die(json_encode([
					'stat'	=> 'ko',
					'msg'		=> 'Le colis n\'existe plus'
				]));
			}
			else {
				die(json_encode([
					'stat'	=> 'Ok',
					'msg'		=> 'Le status du colis a bien été mis à jour'
				]));
			}
		}
		else {
			die(json_encode([
				'stat'	=> 'ko',
				'msg'		=> 'Le colis ne se trouve pas à l\'étape requise'
			]));
		}


	}
}