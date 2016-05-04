<div class="cover-container">
    <div class="inner cover">
        <h3>Comment envoyer mon colis ?</h3>
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <div class="etape etape-1"></div>
            <p>Emballez votre colis.</p>
        </div>
        <div class="col-md-2">
            <div class="etape etape-2"></div>
            <p>Remplissez le formulaire de dépôt de colis et entrez vos informations de paiement.</p>
        </div>
        <div class="col-md-2">
            <div class="etape etape-3"></div>
            <p>Imprimez votre étiquette et votre reçu.</p>
        </div>
        <div class="col-md-2">
            <div class="etape etape-4"></div>
            <p>Collez l'étiquette sur votre colis et gardez bien votre reçu.</p>
        </div>
        <div class="col-md-2">
            <div class="etape etape-5"></div>
            <p>Vous pouvez maintenant déposer votre colis dans le point relais de votre choix.</p>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<div class="container">

    <div class="col-md-12 btn-envoi">
        <button type="button" class="btn btn-primary btn-lg">Envoyer un colis</button>
    </div>

    <div class="col-md-8">
        <h3 class="pull-left">Nos tarifs :</h3>
        <table class="table table-bordered table-responsive table-hover">
            <thead>
            <tr>
                <th>Poids du colis jusqu'à</th>
                <th>Livraison Express<br><small>Livraison le lendemain à horaires garantis</small></th>
                <th>Livraison 8h<br><small>Livraison le lendemain avant 8h*</small></th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach($prices as $key => $price) {

                if(!isset($price[2])) {$price[2] = '';}
                if(!isset($price[1])) {$price[1] = '';}

                echo '<tr>
                    <td>' . $key . '</td>
                    <td>' . $price[2] . '</td>
                    <td>' . $price[1] . '</td>
                </tr>';
            }

            ?>
            </tbody>
        </table>
    </div>

    <div class="col-md-4">
        <h3 class="pull-left">Différentes options s'offrent à vous :</h3>
        <table class="extra-prices-table table-responsive">
            <tbody>
            <?php

            foreach($extras as $extra) {
                echo '<tr>
                        <td>
                            <span class="badge cursor-hover" data-placement="left" rel="txtTooltip"
                            data-original-title="' . $extra['explaination'] . '" id="extra' . $extra['id'] . '"
                            onclick="showTooltip(\'extra' . $extra['id'] . '\')">?</span>' . $extra['label'] . '
                        </td>
                        <td class="tr-extra-prices"> ' . $extra['price'] . ' €</td>
                    </tr>';
            }
// TODO : bulles informatives (hover ou clic) pour chaque extra
            ?>
            </tbody>
        </table>
    </div>

    <small class="col-md-12">* Si colis déposé en point relais avant 15h ou ramassé le jour même.</small>

<?php
// TODO : Utiliser depot.php en changeant la phrase 'informations clients' par 'vos infos' etc
?>