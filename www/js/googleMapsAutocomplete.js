
/****** GOOGLE ADDRESS API ******/

var placeSearch,
    autocomplete1,
    autocomplete2,
    autocomplete3,
    autocomplete4,
    autocomplete5;

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical location types.
    if($('#autocomplete1').val() != undefined) {
        autocomplete1 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete1')),
            {types: ['geocode']});
        autocomplete1.addListener('place_changed', fillInAddress);
    }
    if($('#autocomplete2').val() != undefined) {
        autocomplete2 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete2')),
            {types: ['geocode']});
        autocomplete2.addListener('place_changed', fillInAddress);
    }
    if($('#autocomplete3').val() != undefined) {
        autocomplete3 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete3')),
            {types: ['geocode']});
        autocomplete3.addListener('place_changed', fillInAddress);
    }
    if($('#autocomplete4').val() != undefined) {
        autocomplete4 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete4')),
            {types: ['geocode']});
        autocomplete4.addListener('place_changed', fillInAddress);
    }
    if($('#autocomplete5').val() != undefined) {
        autocomplete5 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete5')),
            {types: ['geocode']});
        autocomplete5.addListener('place_changed', fillInAddress);
    }
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    if(autocomplete1 != undefined) var place1 = autocomplete1.getPlace();
    if(autocomplete2 != undefined) var place2 = autocomplete2.getPlace();
    if(autocomplete3 != undefined) var place3 = autocomplete3.getPlace();
    if(autocomplete4 != undefined) var place4 = autocomplete4.getPlace();
    if(autocomplete5 != undefined) var place5 = autocomplete5.getPlace();

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.

    if(place1 != undefined) {
        $('#street_number1').val(place1.address_components[0].long_name);
        $('#route1').val(place1.address_components[1].long_name);
        $('#locality1').val(place1.address_components[2].long_name);
        $('#country1').val(place1.address_components[5].long_name);
        $('#postal_code1').val(place1.address_components[6].long_name);
    }

    if(place2 != undefined) {
        $('#street_number2').val(place2.address_components[0].long_name);
        $('#route2').val(place2.address_components[1].long_name);
        $('#locality2').val(place2.address_components[2].long_name);
        $('#country2').val(place2.address_components[5].long_name);
        $('#postal_code2').val(place2.address_components[6].long_name);
    }

    if(place3 != undefined) {
        $('#street_number3').val(place3.address_components[0].long_name);
        $('#route3').val(place3.address_components[1].long_name);
        $('#locality3').val(place3.address_components[2].long_name);
        $('#country3').val(place3.address_components[5].long_name);
        $('#postal_code3').val(place3.address_components[6].long_name);
    }

    if(place4 != undefined) {
        $('#street_number4').val(place4.address_components[0].long_name);
        $('#route4').val(place4.address_components[1].long_name);
        $('#locality4').val(place4.address_components[2].long_name);
        $('#country4').val(place4.address_components[5].long_name);
        $('#postal_code4').val(place4.address_components[6].long_name);
    }

    if(place5 != undefined) {
        if(place5.address_components[0] != undefined) {
            $('#street_number5').val(place5.address_components[0].long_name);
        }
        $('#route5').val(place5.address_components[1].long_name);
        $('#locality5').val(place5.address_components[2].long_name);
        if(place5.address_components[5] != undefined) {
            $('#country5').val(place5.address_components[5].long_name);
        }
        if(place5.address_components[6] != undefined) {
            $('#postal_code5').val(place5.address_components[6].long_name);
        }
    }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete1.setBounds(circle.getBounds());
            autocomplete2.setBounds(circle.getBounds());
            autocomplete3.setBounds(circle.getBounds());
            autocomplete4.setBounds(circle.getBounds());
            autocomplete5.setBounds(circle.getBounds());
        });
    }
}