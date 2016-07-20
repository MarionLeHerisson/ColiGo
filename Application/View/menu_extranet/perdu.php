<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <i class="material-icons">announcement</i> Déclarer la perte d'un colis
            </a>
        </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
        <div class="panel-body">

            <div class="col-md-3"></div>
            <div class="form-group col-md-6">
                <label for="idColisPerdu">Scannez le code-barre du colis perdu :</label>
                <input type="text" name="idColisPerdu" id="idColisPerdu" class="form-control input-lg"
                       oninput="updateParcelStatus(5)">
                <br>
                <button type="button" class="btn btn-primary btn-lg" onclick="updateParcelStatus(5)">Valider</button>
            </div>

            <div id="ColisPerdu" class="none alert alert-dismissible fade in col-md-12" role="alert">
                <button type="button" class="close" onclick="closePopin()">
                    <span>×</span>
                </button>
                <p id="ColisPerduMsg"></p>
            </div>
        </div>
    </div>
</div>