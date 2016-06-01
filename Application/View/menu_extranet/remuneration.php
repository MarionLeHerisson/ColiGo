<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwelve">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                <i class="material-icons">attach_money</i> Accéder à sa rémunération
            </a>
        </h4>
    </div>
    <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
        <div class="panel-body">

            <div class="col-md-3"></div>
            <div class="form-group col-md-6">
                <label for="idColisPerdu">Scannez le code-barre du colis perdu :</label>
                <input type="text" name="idColisPerdu" id="idColisPerdu" class="form-control input-lg">
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