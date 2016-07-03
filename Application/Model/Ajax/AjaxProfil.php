<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 03/07/16
 * Time: 15:19
 */

class AjaxProfil {

    public function lostPwd($param) {
        // managers
        require_once('../Model/userModel.php');
        $userManager = new UserModel();

        $user = $userManager->getUserByMail($param[0]);

        if(!isset($user[0]['id'])) {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Aucun compte associé à cette adresse mail.'
            ]));
        }

        // If account is deleted, reactivate it
        $userManager->reactivateAccount($user[0]['id']);

        // create a unique lost_pwd_key
        do {
            $key = ColiGo::createUniqueId();
        } while($userManager->getUserByKey($key) > 0);

        // insert this key
        $userManager->setNewKey($user[0]['id'], $key);

        // send mail with a get url with the key
        $mail = 'Cliquez <a href="profil?key=' . $key . '">ici</a> pour réinitialiser votre mot de passe.';
        $headers = 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $res = mail($param[0],
            'Réinitialisation de votre mot de passe',
            $mail,
            $headers);

        if($res) {
            die(json_encode([
                'stat'	=> 'ok',
                'msg'	=> 'Un mail vous a été envoyé.'
            ]));
        }

        die(json_encode([
            'stat'	=> 'ko',
            'msg'	=> 'Votre message a correctement été envoyé à l\'équipe de ColiGo.'
        ]));
    }

    public function changePwd($param) {

    }

    public function changeMail($param) {

    }
}