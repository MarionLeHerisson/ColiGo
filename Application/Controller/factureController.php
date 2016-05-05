<?php

class factureController {

    public function indexAction() {
        header ("Content-type: image/png");  // tell the navigator that we show an image and not html code

        include_once('../../library/Barcode.php');

        // Create barcode
        $im     = imagecreatetruecolor(2480, 3508);  // A4
        $template = imagecreatefromjpeg("../../Medias/facture.jpg");

        $black  = ImageColorAllocate($im,0x00,0x00,0x00);
        $white  = ImageColorAllocate($im,0xff,0xff,0xff);
        imagefilledrectangle($im, 0, 0, 2480, 3508, $white);
        // ressource, color, left, top, rotation, type, data, width, height
        $data = Barcode::gd($im, $black, 250, 150, 90, "code128", "12345678", 4, 100);
        imagepng($im); // show barcode
        imagedestroy($im);  // free memory


        include_once('../View/facture.php');
    }
}