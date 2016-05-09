<?php

class factureController {

    public function indexAction() {

        if(!isset($_POST['tracking_number']) || $_POST['tracking_number'] == '') {
            //die('error');
            $trackingNumber = 1234567;
        } else {
            $trackingNumber = $_POST['tracking_number'];
        }

        $data = $this->getBillDatas($trackingNumber);

        include_once('../../library/Barcode.php');

        $template = imagecreatefromjpeg("../../Medias/facture.jpg");

        $im = $this->createBarcode($trackingNumber);

        $imPoids = $this->createImgText('Poids du colis : ' . $data['weight'], 2);
        $imDate = $this->createImgText('Edite le : ' . $data['date'], 2);
        $imBill = $this->createBill($data);

        // dest_img, src_img, dest_x, dest_y, src_x, src_y, src_width, src_height, transp
        imagecopy($template, $im, 450, 450, 0, 0, imagesx($im), imagesy($im));

        // Show picture
        header ("Content-type: image/png");  // tell the navigator that we show an image and not html code
        imagepng($imBill);

        imagedestroy($template);  // free memory
        imagedestroy($im);


        include_once('../View/blocks/facture.php');
    }

    /**
     * @param int $trackingNumber
     * @return resource
     */
    public function createBarcode($trackingNumber) {

        $im     = imagecreatetruecolor(500, 500);
        $black  = ImageColorAllocate($im,0x00,0x00,0x00);
        $white  = ImageColorAllocate($im,0xff,0xff,0xff);
        imagefilledrectangle($im, 0, 0, 500, 500, $white);
        // ressource, color, left, top, rotation, type, data, width, height
        $data = Barcode::gd($im, $black, 50, 175, 90, "code128", $trackingNumber, 3, 100);

        return $im;
    }

    /**
     * Return image containing string ($size -> 2 = small, 4 = bigger)
     * @param string $text
     * @param int $size
     * @return resource
     */
    public function createImgText($text, $size) {

        $im = imagecreatetruecolor(300, 20);
        $white = imagecolorallocate($im, 255, 255, 255);
        imagefilledrectangle($im, 0,0, 300, 20, $white);
        $text_color = imagecolorallocate($im, 0, 0, 0);
        imagestring($im, $size, 0, 0,  $text, $text_color);

        return $im;
    }

    /**
     * @param int $trackingNumber
     * @return array
     */
    public function getBillDatas($trackingNumber) {

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
         */

        $data['weight'] = 5;
        $data['date'] = '2016-05-05 11:30:26';
        $data['label'] = 'express';
        $data['weightPrice'] = 10.25;
        $data['extra'][0]['label'] = 'extra 1';
        $data['extra'][0]['price'] = 2;
        $data['extra'][1]['label'] = 'extra 2';
        $data['extra'][1]['price'] = 0.20;
        $data['totalPrice'] = 12.45;

        return $data;
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
        foreach($data['extra'] as $extra) {
            $imgExtra[] = [
                'label' => $this->createImgText($extra['label'], 2),
                'price' => $this->createImgText($extra['price'] . ' EUR', 2)
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
}