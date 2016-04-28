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

            <div class="col-md-1"></div>
            <?php include_once('form-inscription.php'); ?>
            <div class="col-md-1"></div>

            <div class="col-md-12">
                <button type="button" class="btn btn-primary btn-lg" onclick="submitInscForm()">Valider</button>
                <br><br>
                <div class="col-md-2"></div>
                <small class="col-md-8">* Champs obligatoires<br>
                    ** L'addresse entrée ci dessus sera considérée comme addresse du point relais. L'utilisteur propriétaire
                    du point relais aura la possibilité de s'ajouter une adresse personnelle depuis son profil.</small>
            </div>

        </div>
    </div>
</div>