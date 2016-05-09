<?php

include_once ('../../library/coligo.php');

class accueil_extranetController {
	
	public function indexAction() {

        // ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {

            $action = $_POST['action'];
            $param = $_POST['param'];

            switch($action) {
                case 'updateParcelStatus' :
                    $this->updateStatus($param);
                    break;
                case 'addRelayPoint' :
                    $this->addRelayPoint($param);
                    break;
                case 'parcelPosting' :
                    $this->postParcel($param);
                    break;
            }
        }

		$sessionType = '';

		switch($_SESSION['type']) {
			case 1: $sessionType = 'Administrateur';
				break;
			case 2: $sessionType = 'Point Relais';
				break;
			case 3: $sessionType = 'Livreur';
				break;
			default : echo '<script type="text/javascript">document.location.href="accueil";</script>';
		}

        $info = 'Informations client';

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

	/**
	 * update parcel status
	 *
	 * @param array $param
	 */
	public function updateStatus($param) {

		// manager
		include_once('../Model/parcelModel.php');
		$parcelManager = new ParcelModel();

		include_once('../Model/trackingModel.php');
		$trackingManager = new TrackingModel();


		$trackingNumber = $param[0];
		$newStatus = $param[1];

		$parcelId = $parcelManager->getIdFromTrackingNumber($trackingNumber);
		$actualStatus = $parcelManager->getStaus($parcelId);

		// if parcel doesn't jump a step or is lost
		if($actualStatus + 1 == $newStatus || $newStatus == 5 && $actualStatus != 4) {
			$res = $parcelManager->updateStatus($parcelId, $newStatus);
			if($res != '') {
				die(json_encode([
					'stat'	=> 'ko',
					'msg'	=> 'Le colis n\'existe plus'
				]));
			}
			else {
				$trackingManager->updateParcelTracking($parcelId, $newStatus);
				die(json_encode([
					'stat'	=> 'ok',
					'msg'	=> 'Le status du colis a bien été mis à jour'
				]));
			}
		}
		else {
			die(json_encode([
				'stat'	=> 'ko',
				'msg'	=> 'Le colis ne se trouve pas à l\'étape requise'
			]));
		}


	}

	/**
	 * Add a nex Relay Point
	 *
	 * @param array $param
	 * @return array
	 *
	 * @author Marion
	 * TODO : Verif si user a déjà un mot de passe
	 */
	public function addRelayPoint($param) {
		// Managers
		include_once('../Model/addressModel.php');
		$addressManager = new AddressModel();

		include_once('../Model/userModel.php');
		$userManager = new UserModel();

		include_once('../Model/relayPointModel.php');
		$relayPointManager = new RelayPointModel();

		$mail = ColiGo::sanitizeString($param[0]);
		$address = ColiGo::sanitizeString($param[1]);
		$city = ColiGo::sanitizeString($param[3]);
		$zipCode = intval($param[2]);

		// If address exists, use existing id for this address
		$addressId = $addressManager->existAddress($address, $zipCode, $city);

		if($addressId == null) {
			$addressId = $addressManager->insertAddress($address, $zipCode, $city);
		}


		if(is_null($addressId)) {
			die(json_encode([
				'stat'	=> 'ko',
				'msg'	=> 'Une erreur s\'est produite concernant l\'adresse.'
			]));
		}

		$user = $userManager->getUserByMail($mail);
		$userId = $user[0]['id'];

		if(is_null($userId)) {
			die(json_encode([
				'stat'	=> 'ko',
				'msg'	=> 'Cet utilisateur n\'existe pas. Veuillez d\'abord procéder à son inscription.'
			]));
		}

		$userType = $userManager->getUserType($userId);

		if($userType != 2) {
			$userManager->updateRights($userId, 2);
		}

		$rpId = $relayPointManager->insertRelayPoint($addressId, $userId);

		if(is_null($rpId)) {
			die(json_encode([
				'stat'	=> 'ko',
				'msg'	=> 'Une erreur s\'est produite, veuillez réessayer. Si l\'erraur persiste, veuillez contacter l\'équipe technique de ColiGo.'
			]));
		}

		die(json_encode([
			'stat'	=> 'ok',
			'msg'	=> 'Le nouveau point relais a correctement été ajouté.'
		]));
	}


	/**
	 * @param array $param
	 */
	public function postParcel($param) {

		$userFirstname = ColiGo::sanitizeString($param['firstname']);
		$userLastname = ColiGo::sanitizeString($param['lastname']);
		$userMail = ColiGo::sanitizeString($param['mail']);
		$deliveryType = ColiGo::sanitizeString($param['type']);
		$parcelWeight = ColiGo::sanitizeString($param['weight']);

		$receiverLastname = ColiGo::sanitizeString($param['destname']);
		$receiverFirstname = ColiGo::sanitizeString($param['destfirstname']);
		$receiverAddress = ColiGo::sanitizeString($param['streetnumber']) . ', ' . ColiGo::sanitizeString($param['route']);
		$receiverZipCode = ColiGo::sanitizeString($param['zipcode']);
		$receiverCity = ColiGo::sanitizeString($param['city']);

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

		include_once('../Model/trackingModel.php');
		$trackingManager = new TrackingModel();

		include_once('../Model/orderParcelModel.php');
		$orderParcelManager = new OrderParcelModel();


		// if user does not exists, subscribe & get its id
		$user = $userManager->getUserByMail($userMail);

		if(empty($user)) {
			$userId = $userManager->insertUser($userFirstname, $userLastname, $userMail, null, 4, 0);
		} else {
			$userId = $user[0]['id'];
		}

		// insert Parcel (weight, status = déposé, delivery_type) -> get id
		$parcelId = $parcelManager->insertParcel($parcelWeight, 1, $deliveryType);

		$md5 = md5($parcelId);
		$trackingNumber = intval(substr($md5, 0, 8)) . intval(substr($md5, 8, 16)) . intval(substr($md5, 16, 24)) . intval(substr($md5, 24, 32));

		// insert tracking number
		$parcelManager->addTrackingNuber($parcelId, $trackingNumber);

		// Track the parcel with its status and date, keeps an history
		$trackingManager->updateParcelTracking($parcelId, 1);

		// put extras in an array
		$extras = [];

		if(isset($param['emballage']) && $param['emballage'] != 'none' && intval($param['emballage'] != 0)) {
			$extras[] = intval($param['emballage']);
		}
		if(isset($param['prioritaire'])) {
			$extras[] = 7;
		}
		if(isset($param['imprevu'])) {
			$extras[] = 8;
		}
		if(isset($param['indemnisation'])) {
			$extras[] = 9;
		}
		if(isset($param['taking'])) {
			$extras[] = 5;
			$senderAddress = ColiGo::sanitizeString($param['ramstreetnumber']) . ', ' . ColiGo::sanitizeString($param['ramroute']);
			$senderZipCode = ColiGo::sanitizeString($param['ramzipcode']);
			$senderCity = ColiGo::sanitizeString($param['ramcity']);
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

		if(empty($receiver)) {
			$reciverId = $userManager->insertUser($receiverFirstname, $receiverLastname, null, null, 4, 0);
		} else {
			$reciverId = $receiver[0]['id'];
		}

		// If address exists, use existing id for this address
		$arrivalAddress = $addressManager->existAddress($receiverAddress, $receiverZipCode, $receiverCity);
		
		if($arrivalAddress == null) {
			$arrivalAddress = $addressManager->insertAddress($receiverAddress, $receiverZipCode, $receiverCity);
		}

		// If a taking address is given
		if(isset($param['taking'])) {
			// If address exists, use existing id for this address
			$depAddressId = $addressManager->existAddress($senderAddress, $senderZipCode, $senderCity);

			if($depAddressId == null) {
				$depAddressId = $addressManager->insertAddress($senderAddress, $senderZipCode, $senderCity);
			}

			$rpId = 'NULL';
		}
		else {
			// Get relay point id
			$rpId = $_SESSION['address'];
			$depAddressId = $relayPointManager->getRPAddress($rpId);
		}

		// TODO : Si connecté en admin, definir $_SESSION['address']
		// * * * * * * * * * * D E B U G  * * * * * * * * * * * * * * * * //
		$depAddressId = 1;
		$rpId = 1;
		// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * //

		// insert Order
		$orderId = $ordersManager->insertOrder($depAddressId, $arrivalAddress, $totalPrice, $userId, $reciverId, $rpId);

		// link order to parcel
		$orderParcelManager->linkParcelToOrder($parcelId, $orderId);
		// TODO : at validation, open new tab with A4 picture in two parts (or 2 x A4) : bar code + detailed bill

		die(json_encode([
			'stat'	=> 'ok',
			'msg'	=> 'Le dépot du colis a bien été enregistré. Son numéro de suivi est le ' . $trackingNumber . '.'
		]));
	}
}