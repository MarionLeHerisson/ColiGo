// TODO : à la fermeture d'un onglet, faire disparaitre msg erreur ($(this) hasClass 'fermé' children addClass('none') + faire disparaitre contenu inputs
function closePopin() {
	$('.alert-danger').each(function() {
		$(this).addClass('none');
	});
}

function updateParcelStatus(idType) {

	var parcelInputId,
		parcelLabel = '',
		parcelId;

	switch (idType) {
		case 2 : parcelLabel = 'ColisPrisEnCharge';
			break;
		case 3 : parcelLabel = 'ColisLivre';
			break;
		case 4 : parcelLabel = 'ColisDistribue';
			break;
		case 5 : parcelLabel = 'ColisPerdu';
			break;
	}

	parcelInputId = 'id' + parcelLabel;

	parcelId = $('#' + parcelInputId).val();

	$.ajax({
		type: "POST",
		url: 'accueil_extranet',
		data: {
			action: 'updateParcelStatus',
			param: [parcelId,idType]
		},
		success: function(data) {
			var dataObject = JSON.parse(data);	// transforms json return from php to js object

			if(dataObject.stat === 'ko') {
				$('#' + parcelLabel + 'Msg').html(dataObject.msg);
				$('#' + parcelLabel).removeClass('alert-success').addClass('alert-danger').removeClass('none');
			}
			else if(dataObject.stat === 'ok') {
				$('#' + parcelLabel + 'Msg').html(dataObject.msg);
				$('#' + parcelLabel).removeClass('alert-danger').addClass('alert-success').removeClass('none');
			}
			else {
				$('#' + parcelLabel + 'Msg').html('Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.');
				$('#' + parcelLabel).removeClass('alert-success').addClass('alert-danger').removeClass('none');
			}
		},
		error: function() {
			$('#' + parcelLabel + 'Msg').html('Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer. Sinon, veuillez contacter l\'équipe technique de ColiGo.');
			$('#' + parcelLabel).removeClass('alert-success').addClass('alert-danger').removeClass('none');
		}
	});
}

function redirectHome() {
	document.location.href="accueil";
}

function submitSuiviForm() {
    var form = $('#suivi');

}

function submitDepotForm() {
	// get fields to check
	// TODO : (On vérifie aussi ceux qui ne sont pas rentrés "manuellement" des fois qu'un codeur s'amuse à modifier l'attribut value
	var data = {
			firstname : $('#firstname'),
			lastname : $('#name'),
			mail : $('#mail'),
			weight : $('#weight'),
			receiverFirstname : $('#destfirstname'),
			receiverLastname : $('#destname'),
			address : $('#autocomplete'),
			streetnumber : $('#street_number'),
			route : $('#route'),
			city : $('#locality'),
			zipcode : $('#postal_code'),
			packaging : $('input:radio[name=emballage]:checked'),
			type : $('input:radio[name=type]:checked'),

			priority : $('#prioritaire'),// .attr('checked') == true ou isChecked ?
			unexpected : $('#unexpected'),
			indemnity : $('#indemnity'),
			taking : $('#taking'),
			saturday : $('#saturday')
		},
		error = 0,
		checkMail = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}$/i,
		checkZipCode = /^[0-9]{5}$/;

	// if errors are shown, hide them
	$.each(data, function() {
		$(this).parents('.form-group').removeClass('has-error');
	});

	// verif inputs
	if(data.firstname.val() === '' || data.firstname.val().length < 2) {
		data.firstname.parents('.form-group').addClass('has-error');
		error ++;
	}

	if(data.lastname.val() === '' || data.lastname.val().length < 2) {
		data.lastname.parents('.form-group').addClass('has-error');
		error ++;
	}

	if(data.mail.val() === '' || !checkMail.test(data.mail.val())) {
		data.mail.parents('.form-group').addClass('has-error');
		error ++;
	}

	if(data.receiverFirstname.val() === '' || data.receiverFirstname.val().length < 2) {
		data.receiverFirstname.parents('.form-group').addClass('has-error');
		error ++;
	}

	if(data.receiverLastname.val() === '' || data.receiverLastname.val().length < 2) {
		data.receiverLastname.parents('.form-group').addClass('has-error');
		error ++;
	}

	if(data.zipcode.val() === '' || !checkZipCode.test(data.zipcode.val())) {
		data.zipcode.parents('.form-group').addClass('has-error');
		error ++;
	}


	// If no error : submit form
	if(error === 0) {
		$('#depot-form').submit();
	}
}

function submitInscForm() {
	// if errors have alrady been shown, hide them
	$('.bg-danger').each(function(){$(this).addClass('none');});

	// get inputs values
	var firstname = $('#formFirstname').val(),
		lastname = $('#formLastname').val(),
		email = $('#formEmail').val(),
		pwd = $('#formPwd').val(),
		pwdConf = $('#formPwdConfirm').val(),
		error = 0;



	// firstname ?
	if(firstname == '') {
		$('.ttFistname').removeClass('none');
		error = 1;
	}

	// lastname ?
	if(lastname == '') {
		$('.ttLastname').removeClass('none');
		error = 1;
	}

	// mail ?
	if(email == '') {
		$('.ttEmailObg').removeClass('none');
		error = 1;
	}
	// mail ok ?
	else if(!/[\d\w.\-_]+@[\d\w.\-_]+\.[\w]{2,3}/.test(email)) {
		$('.ttEmailInv').removeClass('none');
		error = 1;
	}

	// mail alrady exists ?

	// password ?
	if(pwd == '') {
		$('.ttPwdObg').removeClass('none');
		error = 1;
	}
	// password long enough ?
	else if(pwd.length < 6) {
		$('.ttPwdInv').removeClass('none');
		error = 1;
	}

	// confirmation ?
	if(pwdConf == '') {
		$('.ttPwdconfObg').removeClass('none');
		error = 1;
	}
	// passwords identical ?
	else if(pwd != pwdConf) {
		$('.ttPwdconfInv').removeClass('none');
		error = 1;
	}
	
	// If there is no erreor, send form
	if(error == 0) {
		$('#inscription-form').submit();
	}
}



/****** GOOGLE ADDRESS API ******/

var placeSearch, 
	autocomplete,
	componentForm = {
		street_number: 'short_name',
		route: 'long_name',
		locality: 'long_name',
		administrative_area_level_1: 'short_name',
		country: 'long_name',
		postal_code: 'short_name'
	};

function initAutocomplete() {
	// Create the autocomplete object, restricting the search to geographical location types.
	autocomplete = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
		{types: ['geocode']});

	// When the user selects an address from the dropdown, populate the address fields in the form.
	autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
	// Get the place details from the autocomplete object.
	var place = autocomplete.getPlace();

	// initialize inputs
	for (var component in componentForm) {
		document.getElementById(component).value = '';
		document.getElementById(component).disabled = false;
	}

	// Get each component of the address from the place details
	// and fill the corresponding field on the form.
	for (var i = 0; i < place.address_components.length; i++) {
		var addressType = place.address_components[i].types[0];
		if (componentForm[addressType]) {
			var val = place.address_components[i][componentForm[addressType]];
			document.getElementById(addressType).value = val;
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
			autocomplete.setBounds(circle.getBounds());
		});
	}
}