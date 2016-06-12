<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThirteen">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                <i class="material-icons">attach_money</i> Générer manuellement les fichiers XML
            </a>
        </h4>
    </div>
    <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThirteen">
        <div class="panel-body">

            <div class="col-md-3"></div>
            <div class="form-group col-md-6">
                <label for="idRpMail">Entrez l'adresse mail d'un propriétaire de point relais :</label>
                <input type="text" name="rpMail" id="idRpMail" class="form-control input-lg">
                <br>
                <button type="button" class="btn" onclick="xmlRelayPoint()">Générer pour un point relais</button>
                <br><br>
                <!-- TODO : menu déroulant pour sélectionner la région -->
                <button type="button" class="btn" onclick="xmlDay()">Générer pour tous les points relais de la région (jour)</button>
                <br><br>
                <button type="button" class="btn" onclick="xmlMonth()">Générer pour tous les points relais de France (mois)</button>
            </div>

            <div id="manualXml" class="none alert alert-dismissible fade in col-md-12" role="alert">
                <button type="button" class="close" onclick="closePopin()">
                    <span>×</span>
                </button>
                <p id="manualXmlMsg"></p>
            </div>
        </div>
    </div>
</div>

