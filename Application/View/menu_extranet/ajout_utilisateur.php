<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTen">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                <i class="material-icons">person_add</i> Ajout d'un utilisateur
            </a>
        </h4>
    </div>
    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
        <div class="panel-body">

            <div class="col-md-2"></div>
            <?php include_once('blocks/form-inscription.php'); ?>
            <div class="col-md-2"></div>

            <div class="col-md-12">
                <button type="button" class="btn btn-primary btn-lg" onclick="submitInscForm()">Valider</button>
                <br><br>
                <div class="col-md-2"></div>
                <small class="col-md-8">* Champs obligatoires.<br>
                    ** N'oubliez pas de créer le point relais correspondant. L'adresse entrée ci-dessus correspond à l'adresse
                    personnelle de l'utilisateur inscrit et non à l'adresse de son point relais.</small>
            </div>

        </div>
    </div>
</div>