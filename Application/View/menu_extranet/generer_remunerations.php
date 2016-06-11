<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThirteen">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                <i class="material-icons">announcement</i> Générer manuellement les fichiers XML
            </a>
        </h4>
    </div>
    <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThirteen">
        <div class="panel-body">

            <div class="col-md-3"></div>
            <div class="form-group col-md-6">
                <label for="idColisPerdu">Entrez l'adresse mail d'un propriétaire de point relais :</label>
                <!-- TODO : changer les id / fonction js -->
                <input type="text" name="idColisPerdu" id="idColisPerdu" class="form-control input-lg">
                <br>
                <button type="button" class="btn btn-primary btn-lg" onclick="updateParcelStatus(5)">Générer pour un point relais</button>
                <br><br>
                <button type="button" class="btn btn-primary btn-lg" onclick="updateParcelStatus(5)">Générer pour tous les points relais de la région (jour)</button>
                <br><br>
                <button type="button" class="btn btn-primary btn-lg" onclick="updateParcelStatus(5)">Générer pour tous les points relais de France (mois)</button>
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

<!--
<____?xml version = "1.0" encoding="UTF-8"?>
<relay_point id="19">
    <parcels>
        <parcel id="14756" total_price="0.5">
            <extras>
            </extras>
        </parcel>
        <parcel id="14786" total_price="19">
            <extras>
            </extras>
        </parcel>
        <parcel id="14786" total_price="0.1">
            <extras>
            </extras>
        </parcel>
    </parcels>
</relay_point>
-->