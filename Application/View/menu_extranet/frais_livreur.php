<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFourteen">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                <i class="material-icons">local_shipping</i> Gérer des frais
            </a>
        </h4>
    </div>
    <div id="collapseFourteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFourteen">
        <div class="panel-body">

            <div class="col-md-1"></div>

            <div class="col-md-10">
                <form id="addRelayPoint-form">
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-4" for="type">Libellé :</label>
                        <div class="col-md-8">
                            <input id="costLabel" type="text" class="form-control" placeholder="Repas, essence, ...">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="control-label col-md-4">Montant :</label>
                        <div class="col-md-8">
                            <input id="costPrice" type="text" class="form-control" placeholder="00.00" onfocusout="sanitizeNumbers(event);"> €
                        </div>
                    </div>

                </form>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-3"></div>

            <div id="driverCosts" class="none alert alert-dismissible fade in col-md-6" role="alert">
                <button type="button" class="close" onclick="closePopin()">
                    <span>×</span>
                </button>
                <p id="driverCostsMsg"></p>
            </div>

            <br><br><br><br>
            <div class="col-md-12">
                <button type="button" class="btn btn-primary btn-lg" onclick="addCosts()">Valider</button>
                <br><br>
                <small>Pour chaque frais, un justificatif vous sera demandé.<br></small>
            </div>

        </div>
    </div>
</div>