<?php

class factureController {

    public function indexAction() {

        if(!isset($_POST['tracking_number']) || $_POST['tracking_number'] == '') {
            //die('error');
            $trackingNumber = 689472894;
        } else {
            $trackingNumber = $_POST['tracking_number'];
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
        $data = Barcode::gd($im, $black, 100, 100, 0, "code128", $trackingNumber, 3, 100);

        return $im;
    }

    /**
     * Return image containing string ($size -> 2 = small, 4 = bigger)
     * @param string $text
     * @param int $size
     * @return resource
     */
    public function createImgText($text, $size) {

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

        require_once('../Model/parcelModel.php');
        $parcelManager = new ParcelModel();

        $data = $parcelManager->getAllBillDatas($trackingNumber);

        //echo '<pre>';die(print_r($data));
        /*
        SELECT Parcel.delivery_type, Parcel.weight, parcel.id,
            OrderParcel.parcel_id, OrderParcel.order_id,
            Orders.id, Orders.departure_address, Orders.arrival_address, Orders.total_price, Orders.order_date, Orders.ordered_by, Orders.deliver_to
            ,ParcelExtra.parcel_id, ParcelExtra.extra_id
        FROM Parcel
        LEFT JOIN OrderParcel
        ON OrderParcel.parcel_id = Parcel.id
        LEFT JOIN Orders
        ON Orders.id = OrderParcel.order_id
        LEFT JOIN ParcelExtra
        ON ParcelExtra.parcel_id = Parcel.id
        LEFT JOIN Extra
        ON ParcelExtra.extra_id = Extra.id
        WHERE Parcel.tracking_number = 689472894

        + weight price
        + sender & receiver, departure address & arrival address


        $data['send_firstname'] = 'Marion';
        $data['send_lastname'] = 'Hurteau';
        $data['send_addr'] = '14, rue Monte Cristo';
        $data['send_cp'] = '75020';
        $data['send_city'] = 'Paris';

        $data['rec_firstname'] = 'Oriane';
        $data['rec_lastname'] = 'Payen de La Garanderie';
        $data['rec_addr'] = '10, rue Lisfranc';
        $data['rec_cp'] = '75020';
        $data['rec_city'] = 'Paris';

        $data['weight'] = 5;
        $data['date'] = '2016-05-05 11:30:26';
        $data['label'] = 'express';
        $data['weightPrice'] = 10.25;
        $data['extra'][0]['label'] = 'extra 1';
        $data['extra'][0]['price'] = 2;
        $data['extra'][1]['label'] = 'extra 2';
        $data['extra'][1]['price'] = 0.20;
        $data['totalPrice'] = 12.45;
*/
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