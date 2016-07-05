<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" id="modalChangeMail">
    <div id="modalBackground"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Changement d'adresse mail</h4>
            </div>

            <div class="modal-body col-md-12">
                <div class="col-md-2"></div>

                <div class="col-md-8 form-group">

                    <label for="forgotPwdMail">Votre nouvelle adresse mail :</label>
                    <input type="text" id="newMail" class="form-control">

                    <div id="changeMail" class="none alert alert-dismissible fade in col-md-12" role="alert">
                        <button type="button" class="close" onclick="closePopin()">
                            <span>×</span>
                        </button>
                        <p id="changeMailMsg"></p>
                    </div>

                </div>

                <div class="col-md-2"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="changeMail()">Valider</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<span id="paramAdd" class="none"></span>