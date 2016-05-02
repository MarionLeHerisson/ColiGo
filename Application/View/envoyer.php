<div class="cover-container cover-index">
    <div class="inner cover">
        <br><br><br>
        <h1 class="cover-heading"></h1>
        <p class="lead"> </p>
        <br><br><br>
    </div>
</div>

<div class="container">

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
    </div>

    <small>* Si colis déposé en point relais avant 15h ou ramassé le jour même.</small>

<?php
// TODO : Utiliser depot.php en changeant la phrase 'informations clients' par 'vos infos' etc
?>