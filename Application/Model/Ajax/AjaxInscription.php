<?php
/**
 * Ajax from inscription page
 * Created by Marion.
 * Date: 04/07/2016
 * Time: 16:30
 */

class AjaxInscription {

    /**
     * Verify if an account with this mail alrady exists
     * @param array $param
     * @author Marion
     */
    public function existMail($param) {

        require_once('../Model/userModel.php');
        $userManager = new UserModel();

        $user = $userManager->getUserByMail($param[0]);

        if(isset($user[0]['id'])) {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Cette adresse mail est déjà assocée à un compte. Avez vous <a href="#" onclick="showForgotPwdPopin(\'' . $param[0] . '\')">perdu votre mot de passe</a> ?'
            ]));
        } else {
            die(json_encode([
                'stat'	=> 'ok',
            ]));
        }
    }
}