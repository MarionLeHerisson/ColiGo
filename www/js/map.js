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

    }, 2000);

}

/**
 * Show popin to ask for confirmation
 * @param event
 * @param id
 */
function addFav(event, id) {
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();

    $('#fav_valid').attr('onclick','saveFav(' + id + ')');
    $('#modalAddFav').modal('show');
}

/**
 * Add a relay point in user's favorites
 * @param rpId
 */
function saveFav(rpId) {
    var label = 'addFavorite';

    myAjax(label, 'localiser', 'addFav', [rpId], function(data) {
        var dataObject = JSON.parse(data);	// transforms json return from php to js object
        if(dataObject.stat === 'ok') {
            showMessage(label, dataObject.msg, false);
        } else if(dataObject.stat === 'ko') {
            showMessage(label, dataObject.msg, true);
        } else {
            showMessage(label,'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.',true);
        }
    });

    $('#modalAddFav').modal('hide');
}

/**
 * Choose a relay point for a parcel to deliver
 * @param event
 * @param id
 */
function choose(event, id) {
    // without this block, the page reloads
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();

    var address = $('#' + id + 'addres').val(),
        city = $('#' + id + 'city').val(),
        pcode = $('#' + id + 'zip_code').val(),
        param = $('#paramRP').text(),
        label = $('#' + id + 'label').val();


    if(param === 'ram') {
        $('#choosenTakingAddress').val(label);

        $('#ram_street_number').val(address);
        $('#ram_locality').val(city);
        $('#ram_postal_code').val(pcode);
        $('#ram_country').val('France');
    }
    else if(param === 'liv') {
        $('#chosenDeliveryAddress').val(label);

        $('#street_number2').val(address);
        $('#locality2').val(city);
        $('#postal_code2').val(pcode);
        $('#country2').val('France');
    }

    $('#modalDeliveryRP').modal('hide');
}

/**
 * Shows all relay points
 */
function showAllRP() {

    var label = 'relayPointSearch',
        action = '',
        btnClass = 'none ',
        conf = $('#conf').text();

    if(conf === 'loc') {
        action = 'addFav';
        btnClass = '';
    }
    else if(conf === 'cho') {
        action = 'choose';
        btnClass = '';
    }

    myAjax(label, 'localiser', 'searchRP', [], function(data) {
        var dataObject = JSON.parse(data);	// transforms json return from php to js object

        if(dataObject.stat === 'ko') {
            $('#' + label + 'Msg').html(dataObject.msg);
            $('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
        }
        else if(dataObject.stat === 'ok') {

            var rpts = dataObject.relayPoints;

            rpts.forEach(function(rp) {
                createMarker(parseFloat(rp.lat), parseFloat(rp.lng), rp.label + '<br>' + rp.completeAddress +
                    '<br><button class="' + btnClass + 'btn btn-primary btn-sm" onclick="' + action + '(event, ' + rp.id + ')">Choisir ce point relais</button>' +
                    '<input class="none" id="' + rp.id + 'label" value="' + rp.label + '">' +
                    '<input class="none" id="' + rp.id + 'addres" value="' + rp.address + '">' +
                    '<input class="none" id="' + rp.id + 'zip_code" value="' + rp.zip_code + '">' +
                    '<input class="none" id="' + rp.id + 'city" value="' + rp.city + '">');
            })
        }
        else {
            showMessage(label,'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.',true);
        }
    });
}

/**
 * Search relay points in an area
 */
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

    // TODO : Vérifier que le point relais est bien en France métropolitaine

    myAjax(label, 'localiser', 'searchRP', [minLat, maxLat, minLng, maxLng], function(data) {
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
                listRelayPoint(rp.lat, rp.lng, rp.label, rp.completeAddress);
            });

            map.setCenter({lat: lat, lng: lng});
            map.setZoom(12);    // TODO : Zoom en fonction du rayon choisi
        }
        else {
            $('#' + label + 'Msg').html('Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.');
            $('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
        }
    });
}

/**
 * Revoves all markers (when showing results of a search)
 */
function deleteMarkers() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers = [];
}

/**
 * Listener for the chosen range of km
 */
$('#RPDistRange').on("change mousemove", function() {
    $('#kmValue').text($('#RPDistRange').val());
});

/**
 * TODO : Shows the list of relay points
 */
function listRelayPoint() {

}