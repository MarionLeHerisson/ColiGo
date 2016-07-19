<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 19/07/16
 * Time: 14:10
 */

class AjaxItineraire {

    public function getDriverAddress($param) {
        $driverId = $param[0];

        require_once('../Model/UserModel.php');
        $userManager = new UserModel();

        $address = $userManager->getUserAddress($driverId);

        die(json_encode($address));
    }

    public function getClosestRP($param) {
        $lat = $param[0];
        $lng = $param[1];

        require_once('../Model/AddressModel.php');
        $addressManager = new AddressModel();

        $relayPoint = $addressManager->getClosestRP($lat, $lng);

        die(json_encode($relayPoint));

    }

    public function getParcelsRP($param) {
        $rpId = $param[0];

        require_once('../Model/relayPointModel.php');
        $rpManager = new RelayPointModel();

        $parcels = $rpManager->getLeavingParcels($rpId);

        $ret = '';
        $steps = '';

        foreach($parcels as $parcel) {
            $ret .= '<tr>';
            $ret .= '<td>' . $parcel['id'] . '</td>' .
                '<td>' . $parcel['tracking_number'] . '</td>' .
                '<td>' . $parcel['name'] . '<br>' . $parcel['complete_address'] . '</td>';
            $ret .= '</tr>';

            $steps .= '|' . $parcel['city'];
        }

        die(json_encode(['ret' => $ret, 'steps' => $steps]));
    }
}