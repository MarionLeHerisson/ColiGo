
<div class="col-md-4"></div>
<div class="col-md-3">
    <p>Id livreur :</p>
    <input class="form-control" type="text" id="driverId" value="6">
    <p><br>Addresse livreur :</p>
    <input class="form-control" type="text" id="zip_code">
    <p><br>Latitude , longitude :</p>
    <input class="form-control" type="text" id="latBase">
    <input class="form-control" type="text" id="lngBase">
    <p><br>Point relais le plus proche :</p>
    <input class="form-control" type="text" id="closestId">
    <input class="form-control" type="text" id="closestLabel">
    <input class="form-control" type="text" id="closestAddress">
    <input class="form-control" type="text" id="closestLat">
    <input class="form-control" type="text" id="closestLng">
    <p><br>Colis de ce point relais :</p>
</div>

<table id="tableId" class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tracking number</th>
        <th>Destinataire</th>
    </tr>
    </thead>
    <tbody id="tbodyId">
    </tbody>
</table>

<p><br>Steps : </p>
<input class="form-control" type="text" id="steps">

<hr>

<input type="text" id="lat">
<input type="text" id="lng">


<div class="col-md-12">
    <div class="col-md-6">
        <div id="itineraire" class="none alert alert-dismissible fade in col-md-12" role="alert">
            <button type="button" class="close" onclick="closePopin()">
                <span>×</span>
            </button>
            <p id="itineraireMsg"></p>
        </div>
    </div>
</div>


<script type="text/javascript" src="http://<?php echo BASE_URL ?>www/js/itineraire.js"></script>