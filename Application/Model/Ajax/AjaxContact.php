<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 01/06/16
 * Time: 20:02
 */

class AjaxContact {

    /**
     * Send a message to ColiGo's crew
     *
     * @param array $param
     * @return array
     *
     * @author Marion
     */
    public function sendMessage($param) {
        $name = ColiGo::sanitizeString($param[0]);
        $mail = ColiGo::sanitizeString($param[1]);
        $message = ColiGo::sanitizeString($param[2]);
        $subject = ColiGo::sanitizeString($param[3]);

        // TODO : $to = 'marion.hurteau1@gmail.com, ouriet.romain@gmail.com';
        $to = 'marion.hurteau1@gmail.com';
        $headers = 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $return = mail($to, $subject, $message . '<br><br>Ce mail a été envoyé par : ' . $name . ' - ' . $mail, $headers);

//        ini_set("SMTP","localhost" );
//        ini_set('sendmail_from', 'me@localhost.com');

        mail($mail,
            'Confirmation de l\'envoi de votre message : ' . $subject,
            'Voici une copie du message que vous avez envoyé à l\'équipe de ColiGo : <br><br><br>' . $message,
            $headers);

        if($return == true) {
            die(json_encode([
                'stat'	=> 'ok',
                'msg'	=> 'Votre message a correctement été envoyé à l\'équipe de ColiGo.'
            ]));
        }

        die(json_encode([
            'stat'	=> 'ko',
            'msg'	=> 'Une erreur s\'est produite et votre message n\'a pas pu être envoyé. Vous pouvez réessayer ultérieurement.'
        ]));
    }
}