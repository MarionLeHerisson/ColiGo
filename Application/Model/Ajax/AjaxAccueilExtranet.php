<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 01/06/16
 * Time: 19:51
 */

class AjaxAccueilExtranet {

    /**
     * update parcel status
     *
     * @param array $param
     */
    public function updateStatus($param) {

        // manager
        require_once('../Model/parcelModel.php');
        $parcelManager = new ParcelModel();

        require_once('../Model/trackingModel.php');
        $trackingManager = new TrackingModel();

        require_once('../Model/ordersModel.php');
        $ordersManager = new OrdersModel();


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

                if($newStatus == 4) {
                    $ordersManager->setArrivalDate($parcelId);
                }

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
        $lat = floatval($param[4]);
        $lng = floatval($param[5]);
        $label = ColiGo::sanitizeString($param[6]);

        // If address exists, use existing id for this address
        $addressId = $addressManager->existAddress($address, $zipCode, $city);

        if($addressId == null) {
            $addressId = $addressManager->insertAddress($address, $zipCode, $city, $lat, $lng);
        }


        if(is_null($addressId)) {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Une erreur s\'est produite concernant l\'adresse.'
            ]));
        }

        $user = $userManager->getUserByMail($mail);

        if(isset($user[0])) {
            $userId = $user[0]['id'];
        } else {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Cet utilisateur n\'existe pas. Veuillez d\'abord procéder à son inscription.'
            ]));
        }

        $userType = $userManager->getUserType($userId);

        if($userType != 2) {
            $userManager->updateRights($userId, 2);
        }

        $rpId = $relayPointManager->insertRelayPoint($addressId, $userId, $label);

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
        echo '<pre>';
die(print_r($param));
        $userFirstname = ColiGo::sanitizeString($param['firstname']);
        $userLastname = ColiGo::sanitizeString($param['lastname']);
        $userMail = ColiGo::sanitizeString($param['mail']);
        $deliveryType = ColiGo::sanitizeString($param['type']);
        $parcelWeight = ColiGo::sanitizeString($param['weight']);

        $receiverLastname = ColiGo::sanitizeString($param['receiverLastname']);
        $receiverFirstname = ColiGo::sanitizeString($param['receiverFirstname']);
        $receiverAddress = ColiGo::sanitizeString($param['streetnumber']) . ', ' . ColiGo::sanitizeString($param['route']);
        $receiverZipCode = ColiGo::sanitizeString($param['zipcode']);
        $receiverCity = ColiGo::sanitizeString($param['city']);

        // managers
        require_once('../Model/userModel.php');
        $userManager = new UserModel();

        require_once('../Model/addressModel.php');
        $addressManager = new AddressModel();

        require_once('../Model/parcelModel.php');
        $parcelManager = new ParcelModel();

        require_once('../Model/parcelExtraModel.php');
        $parcelExtraManager = new ParcelExtraModel();

        require_once('../Model/ordersModel.php');
        $ordersManager = new OrdersModel();

        require_once('../Model/relayPointModel.php');
        $relayPointManager = new RelayPointModel();

        require_once('../Model/trackingModel.php');
        $trackingManager = new TrackingModel();

        require_once('../Model/orderParcelModel.php');
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

        // create unique tracking number
        $trackingNumber = $this->createUniqueId();

        // insert tracking number
        $parcelManager->addTrackingNuber($parcelId, $trackingNumber);

        // Track the parcel with its status and date, keeps an history
        $trackingManager->updateParcelTracking($parcelId, 1);

        // put extras in an array
        $extras = [];

        if(isset($param['packaging']) && $param['packaging'] != 'none' && intval($param['packaging'] != 0)) {
            $extras[] = intval($param['packaging']);
        }
        if(isset($param['priority']) && $param['priority'] != '') {
            $extras[] = 7;
        }
        if(isset($param['unexpected']) && $param['unexpected'] != '') {
            $extras[] = 8;
        }
        if(isset($param['indemnity']) && $param['indemnity'] != '') {
            $extras[] = 9;
        }
        if(isset($param['taking']) && $param['taking'] != '') {
            $extras[] = 5;
            $senderAddress = ColiGo::sanitizeString($param['ramstreetnumber']) . ', ' . ColiGo::sanitizeString($param['ramroute']);
            $senderZipCode = ColiGo::sanitizeString($param['ramzipcode']);
            $senderCity = ColiGo::sanitizeString($param['ramcity']);
        }
        if(isset($param['saturday']) && $param['saturday'] != '') {
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
            if(isset($_SESSION['address'])) {
                // Get relay point id
                $rpId = $_SESSION['address'];
                $depAddressId = $relayPointManager->getRPAddress($rpId);
            }

            // TODO : selection d'un point relais
        }

        // TODO URGENT : Si connecté en admin, definir $_SESSION['address']
        // * * * * * * * * * * D E B U G  * * * * * * * * * * * * * * * * //
        $depAddressId = 1;
        $rpId = 1;
        // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * //

        // insert Order
        $orderId = $ordersManager->insertOrder($depAddressId, $arrivalAddress, $totalPrice, $userId, $reciverId, $rpId);

        // link order to parcel
        $orderParcelManager->linkParcelToOrder($parcelId, $orderId);

        die(json_encode([
            'stat'	=> 'ok',
            'msg'	=> 'Le dépot du colis a bien été enregistré. Son numéro de suivi est le ' . $trackingNumber . '.',
            'num'	=> $trackingNumber
        ]));
    }

    /**
     * @param array $param
     */
    public function updateUserRole($param) {
        // parameters
        $userMail = $param[0];
        $newRole = $param[1];

        // manager
        require_once('../Model/userModel.php');
        $userManager = new UserModel();


        if(empty($userMail)) {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Un email est obligatoire.'
            ]));
        } else if (empty($newRole) || $newRole < 1 || $newRole > 4) {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Veuillez entrer un rôle valide en utilisant le menu déroulant.'
            ]));
        }
        else {

            $user = $userManager->getUserByMail($userMail);

            if(empty($user)) {
                die(json_encode([
                    'stat'	=> 'ko',
                    'msg'	=> 'Aucun utilisateur associé à cette adresse mail.'
                ]));
            }

            $res = $userManager->updateRightsFromMail($userMail, $newRole);

            if($res == 0) {
                die(json_encode([
                    'stat'	=> 'ok',
                    'msg'	=> 'Le nouveau statut a bien été affecté.'
                ]));
            }
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Erreur'
            ]));
        }
    }

    /**
     * returns the price for a weight and a delivery type
     * @param array $param
     */
    public function getWeightPrice($param) {

        include_once('../Model/weightPriceModel.php');
        $weightPriceManager = new WeightPriceModel();

        $weight = floatval($param[0]);
        $type = intval($param[1]);

        if(empty($weight)) {
            $weight = 0;
        }

        $price = $weightPriceManager->getPrice($weight, $type);

        if(empty($price)) {
            $price = 'indisponible';
        }

        die(json_encode([
            'price'	=> $price,
        ]));
    }



    /**
     * add comas to have a correct INSERT INTO table VALUES (a,b),(a,b),(a,b) ...
     *
     * @param array $values
     * @param int $parcelId
     * @return string
     *
     * @author Marion
     * TODO : put in Service
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
     * TODO : put in Service
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
     * Create a unique tracking number
     * TODO : put in service
     */
    protected function createUniqueId() {
        $uniqueId = null;

        require_once('../Model/parcelModel.php');
        $parcelManager = new ParcelModel();

        do {
            for($i = 0; $i < 10; $i++) {
                $uniqueId .= rand(0,9);
            }
        } while($parcelManager->getIdFromTrackingNumber($uniqueId) != 0);

        return $uniqueId;
    }

    /**
     * Get remuneration from an email
     * @param array $param
     */
    public function getRemuneration($param) {

        include_once('../../library/coligo.php');
        $mail = ColiGo::sanitizeString($param[0]);

        require_once('../Model/userModel.php');
        $userManager = new UserModel();

        $user = $userManager->getUserByMail($mail);

        if(empty($user)) {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Aucun utilisateur correspondant à cette addresse mail.'
            ]));
        }

        $type = $user['type_id'];

        if($type == 3) {    // postman
            // TODO urgent : remuneration livreur
            // si livreur : repas du moi + essence du mois + payages du moi + prix au kilo des colis du mois * 20%
        } else if($type == 2) {     // relay point
/*
SELECT
rp.id, rp.owner_id, rp.address
,odep.id, odep.departure_address, odep.order_date
,oarr.id, oarr.arrival_address, oarr.delivery_date
,op.parcel_id, op.order_id
,p.id, p.weight, p.delivery_type
,SUM(wp.price), wp.delivery_type
FROM RelayPoint AS rp
WHERE rp.owner_id = 15

LEFT JOIN Orders AS odep
ON odep.departure_address = rp.address
AND MONTH(odep.order_date) = 6

LEFT JOIN Oreders AS oarr
ON oarr.arrival_address = rp.address
AND MONTH(oarr.delivery_date) = 6

LEFT JOIN OrderParcel AS op
ON op.order_id = odep.id
AND op.oder_id = oarr.id

LEFT JOIN Parcel AS p
ON p.id = op.parcel_id

LEFT JOIN WeightPrice AS wp
ON p.weight BETWEEN wp.min_weight AND wp.max_weight
AND p.delivery_type = wp.delivery_type;


-- owner id 15 = Milka
-- address id 57 : 30, Allée Maurice Sarraut, 31300, Toulouse
*/

            // prix au kilo des colis du mois * 20%

        } else {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Cet utilisateur n\'est ni un Point Relais ni un livreur, sa rémunération ne peut être calculée.'
            ]));
        }
    }
}


