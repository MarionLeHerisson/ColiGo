<?php

class accueil_extranetController {
	
	public function indexAction() {

        // ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {

            $action = $_POST['action'];
			$param = [];

			if(isset($_POST['param'])) {
				$param = $_POST['param'];
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
            }
        }

        // manager
        require_once('../Model/extraModel.php');
        $extraManager = new ExtraModel();

		require_once('../Model/userTypeModel.php');
		$userTypeManager = new UserTypeModel();

        // view
		$types = $userTypeManager->getAllTypes();

        $blockedFirstname = '';
        $blockedLastname = '';
        $blockedMail = '';
        $disabled = '';

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
        $extraPrices = $extraManager->getAllExtras();

		require_once('../View/header.php');
		require_once('../View/accueil_extranet.php');
		require_once('../View/footer.php');
	}

}