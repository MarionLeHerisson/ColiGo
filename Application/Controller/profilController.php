<?php

class profilController {

    public function indexAction() {

        // If user is not connected
        if(!isset($_SESSION['first_name'])) {
            echo '<script type="text/javascript">
						document.location.href="accueil";
					</script>';
        }

        // ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {

            $action = $_POST['action'];
            $param = $_POST['param'];

            require_once('../Model/Ajax/AjaxProfil.php');
            $ajaxApi = new AjaxProfil();

            switch ($action) {
                case 'lostPwd' :
                    $ajaxApi->lostPwd($param);
                    break;
                case 'changeMail' :
                    $ajaxApi->changeMail($param);
                    break;
                case 'changePwd' :
                    $ajaxApi->changePwd($param);
                    break;
            }
        }

        // managers
        require_once('../Model/ordersModel.php');
        $ordersManager = new OrdersModel();

        require_once('../Model/FavoriteRelayPointModel.php');
        $relayPointManager = new FavoriteRelayPointModel();

        // veiw
        $history = $ordersManager->getOrdersHistory($_SESSION['id']);
        $tabHisto = '';

        foreach($history as $parcel) {

            isset($parcel['dep_label']) ? $dep = $parcel['dep_label'] . '<br>' . $parcel['dep_address'] : $dep = $parcel['dep_address'];
            isset($parcel['arr_label']) ? $arr = $parcel['arr_label'] : $arr = $parcel['first_name'] . ' ' . $parcel['last_name'];
            $parcel['status_date'] == $parcel['order_date'] ? $statusDate = '' : $statusDate = '<br>' . $parcel['status_date'];


            $tabHisto .= '<tr>
                    <td>' . ColiGo::frenchDate($parcel['order_date']) . '</td>
                    <td>' . $parcel['tracking_number'] . '</td>
                    <td>' . $parcel['status'] . $statusDate . '</td>
                    <td>' . $dep . '<br>' . $parcel['dep_zipcode'] . ', ' . $parcel['dep_city'] . '</td>
                    <td>' . $arr . '<br>' . $parcel['arr_address'] . '<br>' . $parcel['arr_zipcode'] . ', ' . $parcel['arr_city'] . '</td>
                    <td>' . $parcel['total_price'] . ' €<br><a target="_blank" href="facture?tracking_number=' . $parcel['tracking_number'] . '">détail</a></td>
                </tr>';
        }

        $fav = $relayPointManager->getFavorite();

        if(isset($fav[0]) && is_array($fav[0])) {
            $favRp = "<p>" . $fav[0]['label'] . "</p>
                    <p>" . $fav[0]['address'] . "</p>
                    <p>" . $fav[0]['zip_code'] . " " .$fav[0]['city'] . "</p>";
            $buttonLabel = 'Cahnger';
        }
        else {
            $favRp = "<p>Vous n'avez pas encore sélectionné de point relais favori.</p>";
            $buttonLabel = 'Choisir';
        }
        

        include_once('../View/header.php');
        include_once('../View/profil.php');
        include_once('../View/footer.php');
    }
}