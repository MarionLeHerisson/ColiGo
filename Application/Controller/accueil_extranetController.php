<?php

class accueil_extranetController {
	
	public function indexAction() {

        // ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
			$this->Ajax($_POST);
        }

        // manager
        require_once('../Model/extraModel.php');
        $extraManager = new ExtraModel();

		require_once('../Model/userTypeModel.php');
		$userTypeManager = new UserTypeModel();

        // view
		$types = $userTypeManager->getAllTypes();	// when adding new user

        $blockedFirstname = '';		// enable these filds and let them empty (!= depot_client)
        $blockedLastname = '';
        $blockedMail = '';
        $disabled = '';
        $isactive = '';
        $fav_streetnumber = '';
        $fav_label = '';
        $fav_city = '';
        $fav_zipcode = '';
        $fav_country = '';

		$tabLost = $this->getLostParcels();			// lost parcels array
		$tabUsers = $this->getUsers();				// users array

		switch($_SESSION['type']) {
			case 1: $sessionType = 'Administrateur';
				break;
			case 2: $sessionType = 'Point Relais';
				break;
			case 3: $sessionType = 'Livreur';
				break;
			default : echo '<script type="text/javascript">document.location.href="accueil";</script>';
		}

        $info = 'Informations client';		// != depot_client
        $extraPrices = $extraManager->getAllExtras();

		require_once('../View/header.php');
		require_once('../View/accueil_extranet.php');
		require_once('../View/footer.php');
	}

	/**
	 * @return string
	 */
	private function getLostParcels() {

		require_once('../Model/ordersModel.php');
		$ordersManager = new OrdersModel();

		$lostParcels = $ordersManager->getLostParcels();

		$tabLost = '';

		foreach($lostParcels as $parcel) {

			isset($parcel['dep_label']) ? $dep = $parcel['dep_label'] . '<br>' . $parcel['dep_address'] : $dep = $parcel['dep_address'];
			isset($parcel['arr_label']) ? $arr = $parcel['arr_label'] : $arr = $parcel['to_name'];
			$parcel['status_date'] == $parcel['order_date'] ? $statusDate = '' : $statusDate = '<br>' . $parcel['status_date'];

			$tabLost .= '<tr>
                    <td>' . ColiGo::frenchDate($parcel['order_date']) . '</td>
                    <td>' . $parcel['from_name'] . '<br>' . $parcel['from_mail'] . '</td>
                    <td>' . $parcel['tracking_number'] . '</td>
                    <td>' . $statusDate . '</td>
                    <td>' . $parcel['deliver_name'] . '<br>' . $parcel['deliver_mail'] . '</td>
                    <td>' . $dep . '<br>' . $parcel['dep_zipcode'] . ', ' . $parcel['dep_city'] . '</td>
                    <td>' . $arr . '<br>' . $parcel['arr_address'] . '<br>' . $parcel['arr_zipcode'] . ', ' . $parcel['arr_city'] . '</td>
                    <td>' . $parcel['total_price'] . ' €<br><a target="_blank" href="facture?tracking_number=' . $parcel['tracking_number'] . '">détail</a></td>
                </tr>';
		}

		return $tabLost;
	}

	private function getUsers() {

		require_once('../Model/userModel.php');
		$userManager = new UserModel();

		$users = $userManager->getAllUsers();

		$tabUsers = '';

		foreach($users as $user) {

			if($user['city'] == '') {
				$address = 'Non renseignée';
			} else {
				$address = $user['address'] . '<br>' . $user['zip_code'] . ', ' . $user['city'];
			}

			$tabUsers .= '<tr>
                    <td>' . $user['last_name'] . '</td>
                    <td>' . $user['first_name'] . '</td>
                    <td>' . $user['mail'] . '</td>
                    <td>' . $address . '</td>
                    <td>' . $user['label'] . '</td>
                </tr>';
		}

		return $tabUsers;
	}

	/**
	 * @param array $post
	 */
	private function Ajax($post) {

		$action = $post['action'];
		$param = [];

		if(isset($post['param'])) {
			$param = $post['param'];
		}

		require_once('../Model/Ajax/AjaxAccueilExtranet.php');
		$ajaxApi = new AjaxAccueilExtranet();

		require_once('../Model/Ajax/AjaxRemuneration.php');
		$ajaxApiRem = new AjaxRemuneration();

		switch($action) {
			case 'updateParcelStatus' :
				$ajaxApi->updateStatus($param);
				break;
			case 'addRelayPoint' :
				$ajaxApi->addRelayPoint($param);
				break;
			case 'parcelPosting' :
				$ajaxApi->postParcel($param);
				break;
			case 'updateUserRole' :
				$ajaxApi->updateUserRole($param);
				break;
			case 'getWeightPrice' :
				$ajaxApi->getWeightPrice($param);
				break;
			case 'getRemuneration' :
				$ajaxApiRem->getRemuneration($param);
				break;
			case 'xmlRelayPoint' :
				$ajaxApiRem->getXmlRelayPoint($param);
				break;
			case 'xmlDay' :
				$ajaxApiRem->getXmlDay($param);
				break;
			case 'xmlMonth' :
				$ajaxApiRem->getXmlMonth($param);
				break;
			case 'addCosts' :
				$ajaxApi->addCosts($param);
				break;
		}
	}

}