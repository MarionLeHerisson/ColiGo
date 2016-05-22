function createMarker(latitude, longitude, message) {
    var marker = new google.maps.Marker({
        map: map,
        position: {lat: latitude, lng: longitude},
        title: message
    });

    console.log(marker);
    var infowindow = new google.maps.InfoWindow({
        size: new google.maps.Size(150,50),
        content: marker.title
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(marker.title);
        infowindow.open(map, this);
    });
}

var map;
function initMap() {
    // Gives time to function to load, otherwise the map behinds just like a picture
    setTimeout(function(){

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 46.845164, lng: 1.713867},
            zoom: 6
        });

        searchRP(75020);

    }, 1000);

}


function searchRP(zipCode) {

    var label = 'relayPointSearch';

    $.ajax({
        type: "POST",
        url: 'localiser',
        data: {
            action: 'searchRP',
            param: [zipCode]
        },
        success: function(data) {
            var dataObject = JSON.parse(data);	// transforms json return from php to js object

            if(dataObject.stat === 'ko') {
                $('#' + label + 'Msg').html(dataObject.msg);
                $('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
            }
            else if(dataObject.stat === 'ok') {
                //$('#' + label + 'Msg').html(dataObject.msg);
                //$('#' + label).removeClass('alert-danger').addClass('alert-success').removeClass('none');

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