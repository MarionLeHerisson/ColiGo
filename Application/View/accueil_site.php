<?php
require_once "header.php";
?>

    <div class="cover-container cover-index">
        <div class="inner cover">
            <br><br><br>
            <h1 class="cover-heading"><img src="Medias/logo-name.png" width="20%"></h1>
            <p class="lead">Le moyen le plus sûr et le plus rapide pour faire voyager vos colis en France.</p>
            <br><br><br>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="img-circle" src="Medias/avion-papier.jpg" width="140" height="140">
                <h3>Envoyer un colis</h3>
                <p>Accéder à nos tarifs et aux étapes de l'envoi de votre colis.</p>
                <p><a class="btn btn-default" href="depot_client" role="button">En savoir plus</a></p>
            </div>

            <div class="col-md-4">
                <img class="img-circle" src="Medias/loupe.jpg" width="140" height="140">
                <h3>Suivre un colis</h3>
                <p>Vous avez simplement besoin du numéro de suivi de votre colis et du code postal de l'adresse de livraison.</p>
                <p><input data-placement="bottom" rel="txtTooltip" title="Le numéro de suivi est uniquement composé de chiffres !" id="suivi" type="text" class="input-lg" placeholder="Numéro de suivi" onKeyPress="if(event.keyCode == 13) submitSuiviForm();"></p>
            </div>

            <div class="col-md-4">
                <img class="img-circle" src="Medias/localisation.jpg" width="140" height="140">
                <h3>Trouver un point relais</h3>
                <p>À partir d'un code postal, trouvez le point relais le plus proche pour déposer ou recevoir votre colis.</p>
                <p><a class="btn btn-default" href="localiser" role="button">En savoir plus</a></p>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Nos délais de livraison garantis <span class="text-muted">partout en France</span></h2>
                <p class="lead">Votre colis sera reçu dans les trois jours, au plus trad.
                    Mais vous pouvez choisir de le voir arriver demain à 8h.
                    Ou encore avant grâce à notre service d'urgence.</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="Medias/camion.jpeg" data-holder-rendered="true">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 col-md-push-5">
                <h2 class="featurette-heading">Des emballages <span class="text-muted">éco-responsables</span></h2>
                <p class="lead">Les chips de calage en polystyrène sont remplacées par des bouchons en carton recyclé, moins chers, respectueux de l'environnement et aussi efficaces.
                    Notre programme de <a href="colivoiturage">Colivoiturage</a> représente également une économie de transport et donc moins de co2 !</p>
            </div>
            <div class="col-md-5 col-md-pull-7">
                <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="Medias/paris.jpeg" data-holder-rendered="true">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Nous vous apportons des solutions <span class="text-muted">adaptées à vos besoins</span></h2>
                <p class="lead">Un colis volumineux ? Un colis fragile ? Un colis qui se mange, ou même un colis vivant ?
                    <a href="contact">Contactez</a> dès à présents nos conseillers, et nous trouverons ensemble la solution la plus adaptée à vos besoins.</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="Medias/solutions.jpeg" data-holder-rendered="true">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 col-md-push-5">
                <h2 class="featurette-heading">Faites du <span class="text-muted">Colivoiturage !</span></h2>
                <p class="lead">Vous allez là où va un de nos colis ? Avant votre départ, passez le prendre au point relais, et déposez-le au point relais de votre ville d'arrivée !
                    Nous vous payons pour ce service. Les colis qui vous sont proposés sont uniquement les colis déposés près de chez vous et à livrer là où vous allez !
                </p>
            </div>
            <div class="col-md-5 col-md-pull-7">
                <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="Medias/colivoiturage.jpeg" data-holder-rendered="true">
            </div>
        </div>

        <!-- #container closed in the footer -->

<?php
require "footer.php";
?>