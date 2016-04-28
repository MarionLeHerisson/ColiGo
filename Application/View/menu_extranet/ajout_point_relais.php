<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingEleven">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                <i class="material-icons">person_add</i> Ajout d'un point relais
            </a>
        </h4>
    </div>
    <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
        <div class="panel-body">

            <div class="col-md-1"></div>

            <div class="col-md-10">
                <div class="form-group">
                    <label class="control-label col-md-4" for="type">Adresse du point relais :</label>
                    <div class="col-md-8">
                        <input id="autocomplete4" class="autocomplete form-control" placeholder="1 bis Avenue de la République" onFocus="geolocate()">
                    </div>
                    <div class="<?php if(DEBUG == 0){echo 'none';}?>">
                        <table id="address">
                            <input name="streetnumber4" id="street_number4">
                            <input name="route4" id="route4">
                            <input name="city4" id="locality4">
                            <input name="zipcode4" id="postal_code4">
                            <input name="country4" id="country4">
                        </table>
                    </div>
                </div>

                <div class="form-group" data-example-id="static-tooltips">
                    <label class="control-label col-md-4">Email du propriétaire du point relais :</label>
                    <div class="col-md-8">
                        <input id="rpmail" type="email" class="form-control" placeholder="exemple@domaine.com">
                    </div>
                </div>
            </div>

            <div class="col-md-1"></div>

            <div id="newRelayPoint" class="none alert alert-dismissible fade in col-md-12" role="alert">
                <button type="button" class="close" onclick="closePopin()">
                    <span>×</span>
                </button>
                <p id="newRelayPointMsg"></p>
            </div>

            <br><br><br><br>
            <div class="col-md-12">
                <button type="button" class="btn btn-primary btn-lg" onclick="addNewRelayPoint()">Valider</button>
                <br><br>
                <small>Tous les champs sont obligatoires.<br></small>
            </div>

        </div>
    </div>
</div>