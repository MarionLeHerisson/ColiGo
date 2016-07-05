<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 03/07/16
 * Time: 15:19
 */

class AjaxProfil {

    /**
     * [complete this summary]
     * @param array $param
     * @author Marion
     */
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
            'msg'	=> 'Erreur lors de l\'envoi du mail de réinitialisation.'
        ]));
    }

    public function changePwd($param) {
        $pwd = md5(ColiGo::sanitizeString($param[0]));
        $newPwd = md5(ColiGo::sanitizeString($param[1]));

        require_once('../Model/userModel.php');
        $userManager = new UserModel();

        $actualPwd = $userManager->getPwd($_SESSION['id']);

        if($actualPwd == $pwd) {
            $res = $userManager->setNewPwd($newPwd, $_SESSION['id']);

            if($res == 0) {
                $_SESSION['mail'] = $param[0];

                die(json_encode([
                    'stat'	=> 'ok',
                    'msg'	=> 'Votre mot de passe a bien été mis à jour.'
                ]));
            }

            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.(changePwd)'
            ]));
        }

        die(json_encode([
            'stat'	=> 'ko',
            'msg'	=> 'Votre ancien mot de passe est incorrect.'
        ]));
    }

    public function changeMail($param) {

        require_once('../Model/userModel.php');
        $userManager = new UserModel();

        $user = $userManager->getUserByMail($param[0]);

        if(isset($user[0]['id'])) {
            die(json_encode([
                'stat'	=> 'ko',
                'msg'	=> 'Cette adresse mail est déjà assocée à un compte. Avez vous <a href="#" onclick="showForgotPwdPopin(\'' . $param[0] . '\')">perdu votre mot de passe</a> ?'
            ]));
        }

        $res = $userManager->setNewMail($param[0], $_SESSION['id']);

        if($res == 0) {
            $_SESSION['mail'] = $param[0];

            die(json_encode([
                'stat'	=> 'ok',
                'msg'	=> 'Votre adresse mail a bien été mise à jour.'
            ]));
        }

        die(json_encode([
            'stat'	=> 'ko',
            'msg'	=> 'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.(changeMail)'
        ]));
    }
}