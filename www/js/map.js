var markers = [],
    map;

function createMarker(latitude, longitude, message) {
    var marker = new google.maps.Marker({
        map: map,
        position: {lat: latitude, lng: longitude},
        title: message
    });

    markers.push(marker);
    var infowindow = new google.maps.InfoWindow({
        size: new google.maps.Size(150,50),
        content: marker.title
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(marker.title);
        infowindow.open(map, this);
    });
}

function initMap() {
    // Gives time to function to load, otherwise the map behinds just like a picture
    setTimeout(function(){

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 46.845164, lng: 1.713867},
            zoom: 6
        });

        showAllRP();

    }, 1000);

}

function showAllRP() {

    var label = 'relayPointSearch';

    $.ajax({
        type: "POST",
        url: 'localiser',
        data: {
            action: 'searchRP',
            param: []
        },
        success: function(data) {
            var dataObject = JSON.parse(data);	// transforms json return from php to js object

            if(dataObject.stat === 'ko') {
                $('#' + label + 'Msg').html(dataObject.msg);
                $('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
            }
            else if(dataObject.stat === 'ok') {

                var rpts = dataObject.relayPoints;

                rpts.forEach(function(rp) {
                    createMarker(parseFloat(rp.lat), parseFloat(rp.lng), rp.label + '<br>' + rp.completeAddress);
                })
            }
            else {
                $('#' + label + 'Msg').html('Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.');
                $('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
            }
        },
        error: function() {
            $('#' + label + 'Msg').html('Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer. Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.');
            $('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
        }
    });
}

function searchRP() {

    var label = 'relayPointSearch',
        lat = parseFloat($('#lat').val()),
        lng = parseFloat($('#lng').val()),
        unit = 0.006,
        km = parseInt($('#kmValue').text()),
        minLat = lat - (km * unit),
        maxLat = lat + (km * unit),
        minLng = lng - (km * unit),
        maxLng = lng + (km * unit);

    $.ajax({
        type: "POST",
        url: 'localiser',
        data: {
            action: 'searchRP',
            param: [minLat, maxLat, minLng, maxLng]
        },
        success: function(data) {
            var dataObject = JSON.parse(data);	// transforms json return from php to js object

            if(dataObject.stat === 'ko') {
                $('#' + label + 'Msg').html(dataObject.msg);
                $('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
            }
            else if(dataObject.stat === 'ok') {

                var rpts = dataObject.relayPoints;

                deleteMarkers();
                rpts.forEach(function(rp) {
                    createMarker(parseFloat(rp.lat), parseFloat(rp.lng), rp.label + '<br>' + rp.completeAddress);
                });

                // TODO : liste des points relais
                // TODO : zoom
            }
            else {
                $('#' + label + 'Msg').html('Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.');
                $('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
            }
        },
        error: function() {
            $('#' + label + 'Msg').html('Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer. Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.');
            $('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
        }
    });
}

function deleteMarkers() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers = [];
}

$('#RPDistRange').on("change mousemove", function() {
    $('#kmValue').text($('#RPDistRange').val());
});