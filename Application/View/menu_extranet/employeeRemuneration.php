<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwelve">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                <i class="material-icons">attach_money</i> Accès à la rémunération d'un employé
            </a>
        </h4>
    </div>
    <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
        <div class="panel-body">

            <div class="col-md-3"></div>
            <div class="form-group col-md-6">
                <label for="idMailEmployeRem">Entrez le mail d'un employé :</label>
                <input type="text" name="idMailEmployeRem" id="idMailEmployeRem" class="form-control input-lg">
                <br>
                <button type="button" class="btn btn-primary btn-lg" onclick="getRemuneration()">Valider</button>
            </div>

            <div id="MailEmployeRem" class="none alert alert-dismissible fade in col-md-6" role="alert">
                <button type="button" class="close" onclick="closePopin()">
                    <span>×</span>
                </button>
                <p id="MailEmployeRemMsg"></p>
            </div>
        </div>
    </div>
</div>