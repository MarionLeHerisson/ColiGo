<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modalDeliveryRP">
    <div id="modalBackground"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Paiement sécurisé</h4>
            </div>

            <div class="modal-body col-md-12">
                <div class="col-md-2"></div>

                <div class="col-md-8">
                    <input id="autocomplete22" class="autocomplete form-control" placeholder="1 bis Avenue de la République" onFocus="geolocate()">
                </div>

                <div class="col-md-2"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="cb_valid" onclick="selectRP()">Valider</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->