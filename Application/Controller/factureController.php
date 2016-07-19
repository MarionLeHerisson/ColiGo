<?php

class factureController {

    public function indexAction() {

        if(!isset($_GET['tracking_number']) || $_GET['tracking_number'] == '') {
            echo '<script>document.location.href="accueil"</script>';
        } else {
            $trackingNumber = $_GET['tracking_number'];
        }

        $data = $this->getBillDatas($trackingNumber);

        $template = imagecreatefromjpeg("../../Medias/facture.jpg");
        $template = imagerotate ($template, 270, 0);

        $pictures = $this->createPictures($data, $trackingNumber);
        $template = $this->createFullBill($template, $pictures);

        // Show picture
        header ("Content-type: image/png");  // tell the navigator that we show an image and not html code
        imagepng($template);

        // free memory
        imagedestroy($template);
        foreach($pictures as $ressource) {
            imagedestroy($ressource);
        }
    }

    /**
     * @param int $trackingNumber
     * @return resource
     */
    public function createBarcode($trackingNumber) {

        require_once('../../library/Barcode.php');

        $im     = imagecreatetruecolor(300, 200);
        $black  = ImageColorAllocate($im,0x00,0x00,0x00);
        $white  = ImageColorAllocate($im,0xff,0xff,0xff);
        imagefilledrectangle($im, 0, 0, 300, 200, $white);
        // ressource, color, left, top, rotation, type, data, width, height
        $data = Barcode::gd($im, $black, 150, 100, 0, "code128", $trackingNumber, 3, 100);

        return $im;
    }

    /**
     * Return image containing string ($size -> 2 = small, 4 = bigger)
     * @param string $text
     * @param int $size
     * @return resource
     */
    public function createImgText($text, $size) {

        $text = ColiGo::unaccent($text);
        $width = 300;

        if($size == 2) {
            $width = 180;
        }

        $im     = imagecreatetruecolor($width, 20);
        $white  = imagecolorallocate($im, 255, 255, 255);
        imagefilledrectangle($im, 0,0, $width, 20, $white);
        $text_color = imagecolorallocate($im, 0, 0, 0);
        imagestring($im, $size, 0, 0,  $text, $text_color);

        return $im;
    }

    /**
     * @param int $trackingNumber
     * @return array
     */
    public function getBillDatas($trackingNumber) {

        // Managers
        require_once('../Model/parcelModel.php');
        $parcelManager = new ParcelModel();

        require_once('../Model/extraModel.php');
        $extraManager = new ExtraModel();

        require_once('../Model/additionnalPriceModel.php');
        $addPriceManager = new AdditionnalPriceModel();


        $data = $parcelManager->getAllBillDatas($trackingNumber);

        if(empty($data)) {
            echo '<script>document.location.href="accueil"</script>';
        }

        $add = $addPriceManager->getAdditionnalPrice($data[0]['order_id']);

        if(!empty($add)) {
            $data[0]['add'] = $add;
        }

        $extras = $extraManager->getAllBillExtras($data[0]['parcel_id']);

        $data[0]['extra'] = $extras;

        return $data[0];
    }

    /**
     * @param array $data
     * @return resource
     */
    public function createBill($data) {
        // bill background
        $imgBill = imagecreatetruecolor(300, 500);
        $white = imagecolorallocate($imgBill, 255, 255, 255);
        imagefilledrectangle($imgBill, 0,0, 300, 500, $white);

        // bill components
        $imgTitle = $this->createImgText('Votre facture a conserver :', 4);
        $imgWeight = $this->createImgText('Colis de ' . $data['weight'] . ' Kg', 2);
        $imgDeliveryType['label'] = $this->createImgText('Livraison ' . $data['label'], 2);
        $imgDeliveryType['price'] = $this->createImgText($data['weightPrice'] . ' EUR', 2);

        $imgExtra = [];
        if(isset($data['extra'])) {
            foreach($data['extra'] as $extra) {
                $imgExtra[] = [
                    'label' => $this->createImgText($extra['label'], 2),
                    'price' => $this->createImgText($extra['price'] . ' EUR', 2)
                ];
            }
        }
        if(isset($data['add']) && !empty($data['add'])) {
            $imgExtra[] = [
                'label' => $this->createImgText('prix additionnel', 2),
                'price' => $this->createImgText($data['add'] . ' EUR', 2)
            ];
        }

        $imgTotal['label'] = $this->createImgText('TOTAL TTC : ', 3);
        $imgTotal['price'] = $this->createImgText($data['totalPrice'] . ' EUR', 3);

        // put components on background
        // dest_img, src_img, dest_x, dest_y, src_x, src_y, src_width, src_height, transp
        imagecopy($imgBill, $imgTitle, 0, 0, 0, 0, imagesx($imgTitle), imagesy($imgTitle));
        imagecopy($imgBill, $imgWeight, 20, 30, 0, 0, imagesx($imgWeight), imagesy($imgWeight));
        imagecopy($imgBill, $imgDeliveryType['label'], 20, 50, 0, 0, imagesx($imgDeliveryType['label']), imagesy($imgDeliveryType['label']));
        imagecopy($imgBill, $imgDeliveryType['price'], 200, 50, 0, 0, imagesx($imgDeliveryType['price']), imagesy($imgDeliveryType['price']));

        $line = 70;
        foreach($imgExtra as $extra) {
            imagecopy($imgBill, $extra['label'], 20, $line, 0, 0, imagesx($extra['label']), imagesy($extra['label']));
            imagecopy($imgBill, $extra['price'], 200, $line, 0, 0, imagesx($extra['price']), imagesy($extra['price']));
            $line += 20;
        }

        imagecopy($imgBill, $imgTotal['label'], 20, $line, 0, 0, imagesx($imgTotal['label']), imagesy($imgTotal['label']));
        imagecopy($imgBill, $imgTotal['price'], 200, $line, 0, 0, imagesx($imgTotal['price']), imagesy($imgTotal['price']));

        return $imgBill;
    }

    /**
     * @param resource $template
     * @param array $pictures
     * @return resource
     */
    public function createFullBill($template, $pictures) {

        // dest_img, src_img, dest_x, dest_y, src_x, src_y, src_width, src_height, transp
        imagecopy($template, $pictures['weight'], 230, 55, 0, 0, imagesx($pictures['weight']), imagesy($pictures['weight']));
        imagecopy($template, $pictures['date'], 230, 75, 0, 0, imagesx($pictures['date']), imagesy($pictures['date']));
        imagecopy($template, $pictures['bill'], 470, 150, 0, 0, imagesx($pictures['bill']), imagesy($pictures['bill']));
        imagecopy($template, $pictures['barCode'], 75, 400, 0, 0, imagesx($pictures['barCode']), imagesy($pictures['barCode']));
        imagecopy($template, $pictures['send1'], 50, 125, 0, 0, imagesx($pictures['send1']), imagesy($pictures['send1']));
        imagecopy($template, $pictures['send2'], 50, 145, 0, 0, imagesx($pictures['send2']), imagesy($pictures['send2']));
        imagecopy($template, $pictures['send3'], 50, 165, 0, 0, imagesx($pictures['send3']), imagesy($pictures['send3']));
        imagecopy($template, $pictures['rec1'], 50, 300, 0, 0, imagesx($pictures['rec1']), imagesy($pictures['rec1']));
        imagecopy($template, $pictures['rec2'], 50, 320, 0, 0, imagesx($pictures['rec2']), imagesy($pictures['rec2']));
        imagecopy($template, $pictures['rec3'], 50, 340, 0, 0, imagesx($pictures['rec3']), imagesy($pictures['rec3']));
        imagecopy($template, $pictures['tracking'], 470, 450, 0, 0, imagesx($pictures['tracking']), imagesy($pictures['tracking']));

        return $template;
    }

    /**
     * @param array $data
     * @param int $trackingNumber
     * @return array
     */
    public function createPictures($data, $trackingNumber) {

        $pictures['barCode'] = $this->createBarcode($trackingNumber);

        $pictures['weight'] = $this->createImgText('Poids du colis : ' . $data['weight'], 2);
        $pictures['date'] = $this->createImgText('Edite le : ' . $data['date'], 2);
        $pictures['bill'] = $this->createBill($data);
        $pictures['tracking'] = $this->createImgText('Votre numero de suivi :' . $trackingNumber, 4);

        $pictures['send1'] = $this->createImgText($data['send_firstname'] . ' ' . $data['send_lastname'], 4);
        $pictures['send2'] = $this->createImgText($data['send_addr'], 4);
        $pictures['send3'] = $this->createImgText($data['send_cp'] . ' ' . $data['send_city'], 4);
        $pictures['rec1'] = $this->createImgText($data['rec_firstname'] . ' ' . $data['rec_lastname'], 4);
        $pictures['rec2'] = $this->createImgText($data['rec_addr'], 4);
        $pictures['rec3'] = $this->createImgText($data['rec_cp'] . ' ' . $data['rec_city'], 4);

        return $pictures;
    }
}