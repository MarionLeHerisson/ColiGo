/**
 * Created by Marion on 19/07/16.
 */

var driverId = $('#driverId').val(),
    label = 'itineraire',
    zipCode = $('#zip_code'),
    kmDrive = 0,
    kmMax = 800,
    lat = $('#lat'),
    lng = $('#lng'),
    latBase = $('#latBase'),
    lngBase = $('#lngBase');

myAjax(label, 'itineraire', 'getDriverAddress', driverId, function(data) {
    var dataObject = JSON.parse(data);	// transforms json return from php to js object

    zipCode.val(dataObject.address + ', ' + dataObject.zip_code + ', ' + dataObject.city);
    latBase.val(dataObject.lat);
    lngBase.val(dataObject.lng);

    if(latBase.val() == 0 || lngBase.val() == 0) {
        getLatLng2($('#zip_code').val(), latBase, lngBase);
    }
});

setTimeout(function() {
    myAjax(label, 'itineraire', 'getClosestRP', [latBase.val(), lngBase.val()], function(data) {
        var dataObject = JSON.parse(data);
        $('#closestId').val(dataObject.id);
        $('#closestLabel').val(dataObject.label);
        $('#closestAddress').val(dataObject.address + ', ' + dataObject.zip_code + ', ' + dataObject.city);
        $('#closestLat').val(dataObject.lat);
        $('#closestLng').val(dataObject.lng);
    });
}, 1000);

setTimeout(function() {
    myAjax(label, 'itineraire', 'getParcelsRP', [$('#closestId').val()], function(data) {
        var dataObject = JSON.parse(data);
        $('#tbodyId').html(dataObject.ret);
        $('#steps').val(dataObject.steps);
    });
}, 2000);

setTimeout(function() {
    $.ajax({
        url:"https://maps.googleapis.com/maps/api/directions/json?origin=paris&destination=toulouse&region=fr&waypoints=optimize:true"
        + $('#steps') + "&units=metric" +
        "&key=AIzaSyDLhSbz-WEcWDN8L4yL2-LNwIXLAREHyYE",
        type: "POST",
        success:function(res){
            console.log('caca');
            console.log(res);
        }
    });
}, 3000);

/*
 * REQUETE :
 * origin=A         // point de départ
 * destination=B        // point d'arrivée
 * waypoints=optimize:true|C|D|E    // réorganise les points
 * region=fr        // limite à la France
 * units=metric     // km
 *
 */

function getLatLng2(address, lat, lng) {

    var latitude = "NULL",
        longitude = "NULL";

    var res = address.replace(/ /g, "+");

    $.ajax({
        url:"http://maps.googleapis.com/maps/api/geocode/json?address="+res+"&sensor=false",
        type: "POST",
        success:function(res){
            latitude = res.results[0].geometry.location.lat;
            longitude = res.results[0].geometry.location.lng;

            lat.val(latitude);
            lng.val(longitude);
        }
    });
}