<div class="col-md-1"></div>
<form method="POST" action="accueil_extranet" enctype="multipart/form-data" class="form-horizontal col-md-10" id="depot-form">

    <br><h4><?php echo $info;?></h4>
    <div class="form-group">
        <label class="control-label col-md-3" for="firstname">Prenom :</label>
        <div class="col-md-6">
            <input name="firstname" id="firstname" type="text" class="form-control" placeholder="" value="<?php echo $blockedFirstname; ?>" <?php echo $disabled; ?>>
        </div>
        <p class="col-md-4 none ttLastname bg-danger">
            Prénom obligatoire
        </p>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="name">Nom :</label>
        <div class="col-md-6">
            <input name="name" id="name" type="text" class="form-control" placeholder="" value="<?php echo $blockedLastname; ?>" <?php echo $disabled; ?>>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="firstname">Adresse mail :</label>
        <div class="col-md-6">
            <input name="mail" id="mail" type="email" class="form-control" placeholder="" value="<?php echo $blockedMail; ?>" <?php echo $disabled; ?>>
        </div>
        <p class="col-md-4 none ttLastname bg-danger">
            Adresse mail obligatoire
        </p>
    </div>

    <br><h4>Informations colis :</h4>
    <div class="form-group">
        <label class="control-label col-md-3" for="type">Type de livraison :</label>
        <div class="col-md-9">
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="radio" name="type" id="express" value="2" checked onclick="calculateQuotation(event)">
                    <label for="express" class="normal">
                        Livraison à horaires garantis
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="radio" name="type" id="8h" value="1" onclick="calculateQuotation(event)">
                    <label for="8h" class="normal">
                        Livraison le lendemain à 8h si la commande est passée avant 15h
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="radio" name="type" id="urgence" value="3" onclick="calculateQuotation(event)">
                    <label for="urgence" class="normal">
                        Livraison d'urgence
                    </label>
                </div>
            </div>
            <?php
            if($_SESSION['type'] == 1 || $_SESSION['type'] == 2) {
                echo '<div class="col-md-12">
                        <div class="pull-left">
                            <input type="radio" name="type" id="fret" value="4" onclick="calculateQuotation(event)">
                            <label for="fret" class="normal">
                                Livraison de fret
                            </label>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="firstname">Poids du colis :</label>
        <div class="col-md-4">
            <input name="weight" id="weight" type="text" class="form-control" placeholder="00.00" onkeyup="calculateQuotation(event)" onfocusout="sanitizeNumbers(event)"><p>kg</p>
        </div>
        <p class="col-md-4 none ttLastname bg-danger">
            Poids obligatoire
        </p>
    </div>

    <br><h4>Services supplémentaires :</h4>
    <div class="form-group">
        <label class="control-label col-md-3" for="emballage">Type d'emballage :</label>
        <div class="col-md-9">
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="radio" name="emballage" id="kraft" value="3" data-price="<?php echo $extraPrices[2]['price'];?>" onclick="calculateQuotation(event)">
                    <label for="kraft" class="normal">
                        Papier kraft (<?php echo $extraPrices[2]['price'];?> €)
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="radio" name="emballage" id="soie" value="2" data-price="<?php echo $extraPrices[1]['price'];?>" onclick="calculateQuotation(event)">
                    <label for="soie" class="normal">
                        Papier de soie (<?php echo $extraPrices[1]['price'];?> €)
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="radio" name="emballage" id="bulles" value="1"  data-price="<?php echo $extraPrices[0]['price'];?>" onclick="calculateQuotation(event)">
                    <label for="bulles" class="normal">
                        Papier bulles (<?php echo $extraPrices[0]['price'];?> €)
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="radio" name="emballage" id="polystyrene" value="4" data-price="<?php echo $extraPrices[3]['price'];?>" onclick="calculateQuotation(event)">
                    <label for="polystyrene" class="normal">
                        Particules de calage en polystirène (<?php echo $extraPrices[3]['price'];?> €)
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="radio" name="emballage" id="none" value="none" checked data-price="noPack" onclick="calculateQuotation(event)">
                    <label for="none" class="normal">
                        Aucun
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="type">Assurances :</label>
        <div class="col-md-9">
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="checkbox" class="checkboxes" name="prioritaire" id="prioritaire" value="7" data-price="<?php echo $extraPrices[6]['price'];?>" onclick="calculateQuotation(event)">
                    <label for="prioritaire" class="normal">
                        Colis prioritaire (<?php echo $extraPrices[6]['price'];?> €)
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="checkbox" class="checkboxes" name="imprevu" id="imprevu" value="8" data-price="<?php echo $extraPrices[7]['price'];?>" onclick="calculateQuotation(event)">
                    <label for="imprevu" class="normal">
                        Colis livré par tous les moyens en cas d'imprévu (<?php echo $extraPrices[7]['price'];?> €)
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="checkbox" class="checkboxes" name="indemnisation" id="indemnisation" value="9" data-price="<?php echo $extraPrices[8]['price'];?>" onclick="calculateQuotation(event)">
                    <label for="indemnisation" class="normal">
                        Indemnisation en cas de perte ou d'avarie (<?php echo $extraPrices[8]['price'];?> €)
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="type">Autres services :</label>
        <div class="col-md-9">
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="checkbox" class="checkboxes" name="samedi" id="samedi" value="6" data-price="<?php echo $extraPrices[5]['price'];?>" onclick="calculateQuotation(event)">
                    <label for="samedi" class="normal">
                        Livraison le samedi (<?php echo $extraPrices[5]['price'];?> €)
                    </label>
                </div>
            </div>
            <?php
            if(($_SESSION['type'] == 1 || $_SESSION['type'] == 2) && $disabled == '') {
            echo '<div class="col-md-12">
                <div class="pull-left">
                    <input type="checkbox" class="checkboxes" name="additionnel" id="additionnel" onclick="enableAdditionalPrice();">
                    <label for="additionnel" class="normal">
                        Charges additionnelles
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left">
                    <input type="text" name="addedPrice" id="addedPrice" class="form-control" placeholder="00.00" onfocusout="sanitizeNumbers(event);calcAddPrice();" disabled> €
                </div>
            </div>
            <div class="pull-left none"><input type="checkbox" class="checkboxes" name="Charges additionnelles" id="chAdd" data-price="0" onclick="calculateQuotation(event)"></div>';
            }
            ?>
            <div class="col-md-12">
                <div class="pull-left none">
                    <input type="checkbox" class="checkboxes" name="ramassage à domicile" id="ramassage" value="5" data-price="<?php echo $extraPrices[4]['price'];?>" onclick="calculateQuotation(event)">
                    Ramassage au domicile ou sur un lieu de travail (<?php echo $extraPrices[4]['price'];?> €)
                </div>
            </div>
            <div class="col-md-12">
                <div class="pull-left none">
                    <input type="checkbox" class="checkboxes" name="livraison à domicile" id="livraison" value="10" data-price="<?php echo $extraPrices[9]['price'];?>" onclick="calculateQuotation(event)">
                    Livraison au domicile ou sur un lieu de travail (<?php echo $extraPrices[9]['price'];?> €)
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="type">Adresse de départ :</label>
        <div class="col-md-6">
            <button type="button" class="btn btn-default<?php echo $isactive;?>" onclick="showChoixRP('ram')" id="choixRamRP">Point relais</button>
            <button type="button" class="btn btn-default" onclick="showChoixAd('ram')" id="choixRamAd">Autre adresse</button>
            <br><br>
            <input id="choosenTakingAddress" class="autocomplete form-control" placeholder='Cliquez sur "Point Relais" ou "Autre adresse"' disabled value="<?php echo $fav_label;?>">
        </div>
    </div>
    <div class="<?php if(DEBUG == 0){echo 'none';}?>">
        <table id="address">
            <input name="ram_streetnumber" id="ram_street_number" value="<?php echo $fav_streetnumber;?>">
            <input name="ram_route" id="ram_route">
            <input name="ram_city" id="ram_locality" value="<?php echo $fav_city;?>">
            <input name="ram_zipcode" id="ram_postal_code" value="<?php echo $fav_zipcode;?>">
            <input name="ram_country" id="ram_country" value="<?php echo $fav_country;?>">
        </table>
    </div>

    <br><h4>Informations destinataire :</h4>
    <div class="form-group">
        <label class="control-label col-md-3" for="firstname">Prenom :</label>
        <div class="col-md-6">
            <input name="destfirstname" id="destfirstname" type="text" class="form-control" placeholder="">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="name">Nom :</label>
        <div class="col-md-6">
            <input name="destname" id="destname" type="text" class="form-control" placeholder="">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="email">Adresse de livraison :</label>
        <div class="col-md-6">
            <button type="button" class="btn btn-default" onclick="showChoixRP('liv')" id="choixLivRP">Point relais</button>
            <button type="button" class="btn btn-default" onclick="showChoixAd('liv')" id="choixLivAd">Autre adresse</button>
            <br><br>
            <input id="chosenDeliveryAddress" class="form-control" placeholder='Cliquez sur "Point Relais" ou "Autre adresse"' disabled>
        </div>
    </div>

    <div class="<?php if(DEBUG == 0){echo 'none';}?>">
        <table id="address">
            <input name="streetnumber2" id="street_number2">
            <input name="route2" id="route2">
            <input name="city2" id="locality2">
            <input name="zipcode2" id="postal_code2">
            <input name="country2" id="country2">
        </table>
    </div>

    <div id="formDepot" class="none alert alert-dismissible fade in col-md-12" role="alert">
        <button type="button" class="close" onclick="closePopin()">
            <span>×</span>
        </button>
        <p id="formDepotMsg"></p>
    </div>

    <button type="button" class="btn btn-primary btn-lg" onclick="submitDepotForm()">Valider</button>
    <?php if(DEBUG != 0){echo '<button type="button" class="btn btn-primary none" id="myInput" onclick="showPaymentModal()">Test</button>';}?>

    <?php require_once('popin/simu_payment.php'); ?>
    <?php require_once('popin/choixAd.php'); ?>
    <?php require_once('popin/choixRP.php'); ?>

</form>

<?php include_once('billPanel.php'); ?>

<script src="www/js/depot.js"></script>