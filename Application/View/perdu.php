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
                <input type="text" name="idColisPerdu" id="idColisPerdu" class="form-control input-lg">
                <br>
                <button type="button" class="btn btn-primary btn-lg" onclick="updateParcelStatus(5)">Valider</button>
            </div>

            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Oh snap! You got an error!</h4>
                <p>Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>
                <p>
                    <button type="button" class="btn btn-danger">Take this action</button>
                    <button type="button" class="btn btn-default">Or do this</button>
                </p>
            </div>
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4>Ok!</h4>
                <p>Tout s'est bien passé haha</p>
            </div>
        </div>
    </div>
</div>