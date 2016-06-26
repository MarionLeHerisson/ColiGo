<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modalDeliveryRP">
    <div id="modalBackground"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Choix d'un point relais</h4>
            </div>

            <div class="modal-body col-md-12" id="choixRP">
                <div class="col-md-1"></div>

                <div class="col-md-10">
                    <div class="form-group"><label class="control-label col-md-12" for="type">Entrez une adresse, une ville, un code postal, ...</label>
                        <div class="col-md-12">
                            <input id="autocomplete5" class="autocomplete form-control" placeholder="1 bis Avenue de la République"
                                   onFocus="geolocate()" onBlur="getLatLng()">
                        </div>
                        <div class=" <?php if(DEBUG == 0){echo 'none';}?>">
                            <table id="address">
                                <input name="streetnumber5" id="street_number5">
                                <input name="route5" id="route5">
                                <input name="city5" id="locality4">
                                <input name="zipcode5" id="postal_code5">
                                <input name="country5" id="country5">

                                <input name="lat" id="lat">
                                <input name="lng" id="lng">
                            </table>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div id="map" style="width: 400px; height: 400px;"></div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-md-12" for="RPDistRange">Dans un rayon de :</label>
                            <div class="col-md-12">
                                <input id="RPDistRange" type="range" min="1" max="30" step="1" value="2"/>
                                <p><span id="kmValue">2</span>&nbsp;km</p>
                            </div>
                        </div>

                        <br><br><br>
                        <button type="button" class="btn btn-primary btn-lg" onclick="searchRP()">Trouver</button>
                        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyAPuG1oh7adZDZ1E_N5_owPxzz5bhtV4FI" async defer></script>
                        <script src="www/js/map.js"></script>
                    </div>

                </div>

                <div class="col-md-1"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Valider</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<span id="conf" class="none">cho</span>