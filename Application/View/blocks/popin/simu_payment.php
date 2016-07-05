<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="myModal">
    <div id="modalBackground"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Paiement sécurisé</h4>
            </div>

            <div class="modal-body col-md-12">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="control-label col-md-3" for="cb_owner">Nom tel qu'il est écrit sur la carte :</label>
                        <div class="col-md-6">
                            <input name="cb_owner" id="cb_owner" type="text" class="form-control" placeholder="Marie Martin">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="cb_number">Numéro de carte :</label>
                        <div class="col-md-6">
                            <input name="cb_number" id="cb_number" type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Date d'expiration :</label>
                        <div class="col-md-1">Mois</div>
                        <div class="col-md-2">
                            <select class="form-control" id="cb_select_month">
                                <?php
                                for($i = 1; $i < 12; $i++) {
                                    echo '<option>' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1">Année</div>
                        <div class="col-md-2">
                            <select class="form-control" id="cb_select_year">
                                <?php
                                for($i = date('Y'); $i < date('Y') + 5; $i++) {
                                    echo '<option>' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="crypto">Cryptogramme visuel : </label>
                        <div class="col-md-2">
                            <input name="crypto" id="crypto" type="text" class="form-control" placeholder="XXX">
                        </div>
                    </div>

                    <div id="formPayment" class="none alert alert-dismissible fade in col-md-12" role="alert">
                        <button type="button" class="close" onclick="closePopin()">
                            <span>×</span>
                        </button>
                        <p id="formPaymentMsg"></p>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="cb_valid" onclick="verifPayment()">Valider</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->