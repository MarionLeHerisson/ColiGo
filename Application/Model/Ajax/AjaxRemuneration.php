<?php

class AjaxRemuneration {
    
    /**
     * Generate an xml file containing all parcels recieved/sent from one relay point this day
     * @param array $param
     * @author Marion
    */
    public function getXmlRelayPoint($param) {
        
        $user = $this->getUserFromParam($param);
        $date = ColiGo::getDate();
        
        require_once('../Model/relayPointModel.php');
        $rpManager = new RelayPointModel();

        $parcels = $rpManager->getDayParcels($user[0]['id'], date('Y-m-d'));

        $rpId = $rpManager->getRpIdFromMail($param[0]);

        // Si le dossier n'existe pas, le créer + chmod
        $pathName = '../../Medias/Remunerations/day_details/' . $date;
        if(!file_exists($pathName)) {
            mkdir($pathName, 777, true);
        } else {
            chmod($pathName, 777);
        }
        
        $file = fopen($pathName . '/' . $date . '-' . $rpId . '.xml', 'w');
        
        if($file == false) {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Erreur lors de la création du fichier xml.'
            ]));
        }
        
        $content = '<?xml version = "1.0" encoding="UTF-8"?>';
        $content .= '<relay_point id="' . $rpId . '">';
        $content .= '<parcels>';

        if(!empty($parcels)) {
            foreach($parcels as $parcel) {
                $content .= '<parcel id="' . $parcel['id'] . '" total_price="' . $parcel['price'] . '">';
                $content .= round(20 / 100 * $parcel['price'], 2);
                $content .= '</parcel>';
            }
        }
        
        $content .= '</parcels>';
        $content .= '</relay_point>';
        
        fwrite($file, $content);
        fclose($file);

        die(json_encode([
            'stat'	=> 'ok',
            'msg'	=> 'Fichier xml correctement créé.'
        ]));
        // TODO : ouvrir XML dans une modal ?
/*
<?xml version = "1.0" encoding="UTF-8"?>
<relay_point id="19">       // $parcels[0]['departure_address'] || ['arrival_address]
    <parcels>
        <parcel id="14756" total_price="0.5">       //$parcel['id']    $parcel['price']
            <extras>
            </extras>
        </parcel>
        <parcel id="14786" total_price="19">
            <extras>
            </extras>
        </parcel>
        <parcel id="14786" total_price="0.1">
            <extras>
            </extras>
        </parcel>
    </parcels>
</relay_point>
*/
    }
    
    /**
     * Generate an xml file containing all parcels received/sent from all relay points of a region this day
     */
    public function getXmlDay($param) {

        $cPathName = '../../Medias/Remunerations/Remuneration';

        // TODO : launch C programm
        exec($cPathName, $output, $return_var);
        //print_r(($output));
        //print_r($return_var);

        // TODO : get result to show it ?

/*
<?xml version="1.0" encoding="UTF-8"?>
<rem>
    <remuneration relaypoint_id="1">4.00</remuneration>
    <remuneration relaypoint_id="2">41.77</remuneration>
</rem>
 */
    }

    /**
     * Generate an xml file containing all month remuneration
     * @param $param
     */
    public function getXmlMonth($param) {
        
    }
    
    /**
     * Get remuneration from an email
     * @param array $param
     */
    public function getRemuneration($param) {

        $user = $this->getUserFromParam($param);
        
        $month = ColiGo::getMonth();

        $type = $user[0]['type_id'];

        if($type == 3) {    // postman
            // TODO urgent : remuneration livreur
            // si livreur : repas du moi + essence du mois + payages du moi + prix au kilo des colis du mois * 20%
        } else if($type == 2) {     // relay point

            require_once('../Model/relayPointModel.php');
            $relayPointManager = new RelayPointModel();

            $monthParcels = $relayPointManager->getMonthParcels($user[0]['id'], $month);
            $rem = 0;

            foreach($monthParcels as $parcel) {     // month parcels * 20%
                $rem += round(20 / 100 * $parcel['price'], 2);
            }

            die(json_encode([
                'stat'	=> 'ok',
                'msg'	=> 'Rémunération pour le mois en cours : ' . $rem . ' €.'
            ]));

        } else {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Cet utilisateur n\'est ni un Point Relais ni un livreur, sa rémunération ne peut être calculée.'
            ]));
        }
    }
    
    // TODO : move in service
    public function getUserFromParam($param) {
        
        if(empty($param)) {
            $mail = $_SESSION['mail'];
        } else {
            $mail = ColiGo::sanitizeString($param[0]);
        }

        
        require_once('../Model/userModel.php');
        $userManager = new UserModel();

        $user = $userManager->getUserByMail($mail);

        if(empty($user)) {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Aucun utilisateur correspondant à cette addresse mail.'
            ]));
        }
        
        return $user;
    }
}