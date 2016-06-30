<div class="cover-container cover-suivi">
    <div class="inner cover">
        <br><br><br>
        <h2>Suivre un colis</h2>
        <br><br><br>
    </div>
</div>

<div class="container">

    <div class="col-md-1"></div>

    <div class="col-md-10">

    <?php

    if(empty($trackingStates)) {
        echo 'Aucun résultat pour ce numéro de suivi. Vérifiez que vous avez bien entré le bon numéro,
        ou réessayez plus tard : votre colis n\'a peut être pas encore été enregistré.';
    } else {

        include('blocks/tableSuivi.php');
    }

    ?>

    </div>

    <div class="col-md-1"></div>