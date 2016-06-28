<div class="col-md-1"></div>
<form method="POST" action="accueil_extranet" enctype="multipart/form-data" class="form-horizontal col-md-10" id="depot-form">

    <br><h4><?php echo $info; ?></h4>
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
            <div class="pull-left">
                <input type="radio" name="type" id="express" value="2" checked onclick="calculateQuotation(event)">
                Livraison à horaires garantis
            </div>
            <div class="pull-left">
                <input type="radio" name="type" id="8h" value="1" onclick="calculateQuotation(event)">
                Livraison le lendemain à 8h si la commande est passée avant 15h
            </div>
            <div class="pull-left">
                <input type="radio" name="type" id="urgence" value="3" onclick="calculateQuotation(event)">
                Livraison d'urgence
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="firstname">Poids du colis :</label>
        <div class="col-md-4">
            <input name="weight" id="weight" type="text" class="form-control" placeholder="00.00" onkeyup="calculateQuotation(event)"><p>kg</p>
        </div>
        <p class="col-md-4 none ttLastname bg-danger">
            Poids obligatoire
        </p>
        <!-- TODO : Verif point ou virgule, puis js qui transforme virgule en point, retire -->
    </div>

    <br><h4>Services supplémentaires :</h4>
    <div class="form-group">
        <label class="control-label col-md-3" for="emballage">Type d'emballage :</label>
        <div class="col-md-9">
            <div class="pull-left">
                <input type="radio" name="emballage" id="kraft" value="3" data-price="<?php echo $extraPrices[2]['price'];?>" onclick="calculateQuotation(event)">
                Papier kraft (0,20€)
            </div><br>
            <div class="pull-left">
                <input type="radio" name="emballage" id="soie" value="2" data-price="<?php echo $extraPrices[1]['price'];?>" onclick="calculateQuotation(event)">
                Papier de soie (0,40€)
            </div><br>
            <div class="pull-left">
                <input type="radio" name="emballage" id="bulles" value="1"  data-price="<?php echo $extraPrices[0]['price'];?>" onclick="calculateQuotation(event)">
                Papier bulles (0,60€)
            </div><br>
            <div class="pull-left">
                <input type="radio" name="emballage" id="polystyrene" value="4" data-price="<?php echo $extraPrices[3]['price'];?>" onclick="calculateQuotation(event)">
                Particules de calage en polystirène (0,30€)
            </div><br>
            <div class="pull-left">
                <input type="radio" name="emballage" id="none" value="none" checked data-price="noPack" onclick="calculateQuotation(event)">
                Aucun
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="type">Assurances :</label>
        <div class="col-md-9">
            <div class="pull-left">
                <input type="checkbox" class="checkboxes" name="prioritaire" id="prioritaire" value="7" data-price="<?php echo $extraPrices[6]['price'];?>" onclick="calculateQuotation(event)">
                Colis prioritaire (10,00€)
            </div><br>
            <div class="pull-left">
                <input type="checkbox" class="checkboxes" name="imprevu" id="imprevu" value="8" data-price="<?php echo $extraPrices[7]['price'];?>" onclick="calculateQuotation(event)">
                Colis livré par tous les moyens en cas d'imprévu (37,00€)
            </div><br>
            <div class="pull-left">
                <input type="checkbox" class="checkboxes" name="indemnisation" id="indemnisation" value="9" data-price="<?php echo $extraPrices[8]['price'];?>" onclick="calculateQuotation(event)">
                Indemnisation en cas de perte ou d'avarie (19,00€)
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="type">Autres services :</label>
        <div class="col-md-9">
            <div class="pull-left">
                <input type="checkbox" class="checkboxes" name="samedi" id="samedi" value="6" data-price="<?php echo $extraPrices[5]['price'];?>" onclick="calculateQuotation(event)">
                Livraison le samedi (5,00€)
            </div><br>
            <div class="pull-left none">
                <input type="checkbox" class="checkboxes" name="ramassage" id="ramassage" value="5" data-price="<?php echo $extraPrices[4]['price'];?>" onclick="calculateQuotation(event)">
                Ramassage au domicile ou sur un lieu de travail (8,00€)
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3" for="type">Adresse de ramassage :</label>
        <div class="col-md-6">
            <button type="button" class="btn btn-default" onclick="showChoixRP('ram')" id="choixRamRP">Point relais</button>
            <button type="button" class="btn btn-default" onclick="showChoixAd('ram')" id="choixRamAd">Autre adresse</button>
            <br><br>
            <input id="choosenTakingAddress" class="autocomplete form-control" placeholder='Cliquez sur "Point Relais" ou "Autre adresse"' disabled>
        </div>
    </div>
    <div class="<?php if(DEBUG == 0){echo 'none';}?>">
        <table id="address">
            <input name="ram_streetnumber" id="ram_street_number">
            <input name="ram_route" id="ram_route">
            <input name="ram_city" id="ram_localit">
            <input name="ram_zipcode" id="ram_postal_code">
            <input name="ram_country" id="ram_country">
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
            <!-- TODO : plus cher si livraison domicile -->
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