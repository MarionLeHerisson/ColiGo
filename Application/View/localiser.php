<div class="cover-container cover-localiser">
    <div class="inner cover">
        <br><br><br>
        <h2>Localiser le point relais le plus proche de chez vous</h2>
        <br><br><br>
    </div>
</div>

<div class="container">

    <div class="col-md-12">

        <div class="col-md-7">
            <div id="map"></div>
        </div>

        <div class="col-md-5">

            <label class="control-label col-md-12" for="type">Entrez une adresse, une ville, un code postal, ...</label>
            <div class="col-md-12">
                <input id="autocomplete4" class="autocomplete form-control" placeholder="1 bis Avenue de la République" onFocus="geolocate()" onBlur="getLatLng()">
            </div>
            <div class="none <?php if(DEBUG == 0){echo 'none';}?>">
                <table id="address">
                    <input name="streetnumber4" id="street_number4">
                    <input name="route4" id="route4">
                    <input name="city4" id="locality4">
                    <input name="zipcode4" id="postal_code4">
                    <input name="country4" id="country4">

                    <input name="lat" id="lat">
                    <input name="lng" id="lng">
                </table>
            </div>

            <br><br><br><br>
            <button type="button" class="btn btn-primary btn-lg" onclick="searchRP()">Trouver</button>

        </div>

    </div>

    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyAPuG1oh7adZDZ1E_N5_owPxzz5bhtV4FI" async defer></script>
    <script src="www/js/map.js"></script>


    <?php // key = AIzaSyAPuG1oh7adZDZ1E_N5_owPxzz5bhtV4FI ?>