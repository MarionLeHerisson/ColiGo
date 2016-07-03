<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" id="modalForgotPwd">
    <div id="modalBackground"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mot de passe oublié</h4>
            </div>

            <div class="modal-body col-md-12" id="forgotPwd">
                <div class="col-md-2"></div>

                <div class="col-md-8 form-group">
                    <p>Veuillez entrer votre adresse mail. Des identifiants provisoires vous seront envoyés.<br>
                    Une fois connecté avec votre nouveau mot de passe, nous vous conseillons de changer celui-ci immédiatement depuis
                    votre profil.</p>

                    <label for="forgotPwdMail">Votre adresse mail :</label>
                    <input type="text" id="forgotPwdMail" class="form-control">

                    <div id="fgtPwd" class="none alert alert-dismissible fade in col-md-12" role="alert">
                        <button type="button" class="close" onclick="closePopin()">
                            <span>×</span>
                        </button>
                        <p id="fgtPwdMsg"></p>
                    </div>
                </div>

                <div class="col-md-2"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="forgotPwd()">Valider</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<span id="paramAdd" class="none"></span>