<?php

class factureController {

    public function indexAction() {

        $trackingNumber = $_POST['tracking_number'];

        if(!isset($_POST['tracking_number']) || $_POST['tracking_number'] == '') {
            //die('error');
            $trackingNumber = 1234567;
        }

        include_once('../../library/Barcode.php');

        $template = imagecreatefromjpeg("../../Medias/facture.jpg");

        // Create barcode
        $im     = imagecreatetruecolor(595, 842);  // A4
        $black  = ImageColorAllocate($im,0x00,0x00,0x00);
        $white  = ImageColorAllocate($im,0xff,0xff,0xff);
        imagefilledrectangle($im, 0, 0, 595, 842, $white);
        // ressource, color, left, top, rotation, type, data, width, height
        $data = Barcode::gd($im, $black, 50, 175, 90, "code128", $trackingNumber, 3, 100);

        // get width and height of the picture to place
        $sourceWidth = imagesx($im);
        $sourceHeight = imagesy($im);

        // Show picture
        header ("Content-type: image/png");  // tell the navigator that we show an image and not html code
        imagecopymerge($template, $im, 450, 450, 0, 0, $sourceWidth, $sourceHeight, 50);

        imagepng($template); // show barcode
        imagedestroy($template);  // free memory
        imagedestroy($im);


        include_once('../View/facture.php');
    }
}