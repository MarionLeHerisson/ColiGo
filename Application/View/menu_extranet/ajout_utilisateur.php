<div class="panel panel-default <?php if ($_SESSION['type'] != 1) {echo 'none';} ?>">
    <div class="panel-heading" role="tab" id="headingTen">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                <i class="material-icons">person_add</i> Ajout d'un utilisateur
            </a>
        </h4>
    </div>
    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
        <div class="panel-body">

            <?php include_once('../form-inscription.php'); ?>

            <div class="col-md-9">
                <button type="button" class="btn btn-primary btn-lg" onclick="submitInscForm()">Valider</button>
                <br><br>
                <small>* Champs obligatoires<br>
                    ** L'addresse entrée ci dessus sera considérée comme addresse du point relais. L'utilisteur propriétaire
                    du point relais aura la possibilité de s'ajouter une adresse personnelle depuis son profile.</small>
            </div>

        </div>
    </div>
</div>