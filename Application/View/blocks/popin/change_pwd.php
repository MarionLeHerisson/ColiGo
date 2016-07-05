<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" id="modalChangePwd">
    <div id="modalBackground"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Changement de mot de passe</h4>
            </div>

            <div class="modal-body col-md-12">
                <div class="col-md-2"></div>

                <div class="col-md-8 form-group">

                    <label for="forgotPwdMail">Votre ancien mot de passe :</label>
                    <input type="password" id="oldPwd" class="form-control">

                    <label for="forgotPwdMail">Votre nouveau mot de passe :</label>
                    <input type="password" id="newPwd" class="form-control">

                    <label for="forgotPwdMail">Confirmation du nouveau mot de passe :</label>
                    <input type="password" id="confirmNewPwd" class="form-control">

                    <div id="changePwd" class="none alert alert-dismissible fade in col-md-12" role="alert">
                        <button type="button" class="close" onclick="closePopin()">
                            <span>×</span>
                        </button>
                        <p id="changePwdMsg"></p>
                    </div>

                </div>

                <div class="col-md-2"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="changePwd()">Valider</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<span id="paramAdd" class="none"></span>