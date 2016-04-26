// TODO : à la fermeture d'un onglet, faire disparaitre msg erreur ($(this) hasClass 'fermé' children addClass('none') + faire disparaitre contenu inputs
function closePopin() {
	$('.alert-danger').each(function() {
		$(this).addClass('none');
	});
	$('.alert-succes').each(function() {
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
			$('#' + parcelLabel + 'Msg').html('Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer. Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.');
			$('#' + parcelLabel).removeClass('alert-success').addClass('alert-danger').removeClass('none');
		}
	});
}

function addNewRelayPoint() {
	var rpMail = $('#rpmail').val(),
		rpAddress = $('#street_number4').val() + ', ' + $('#route4').val(),
		rpZipCode = $('#zipcode4').val(),
		rpCity = $('#city4').val(),
		rpCountry = $('#country4').val(),
		label = 'newRelayPoint',
		error = 0;

	if(rpCountry !== 'France') {
		$('#' + label + 'Msg').html('Erreur : Le point relais doit se situer en France.');
		$('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
		error = 1;
	}

	if(error === 0) {
		$.ajax({
			type: "POST",
			url: 'accueil_extranet',
			data: {
				action: 'addRelayPoint',
				param: [rpMail,rpAddress,rpZipCode,rpCity]
			},
			success: function(data) {
				var dataObject = JSON.parse(data);	// transforms json return from php to js object

				if(dataObject.stat === 'ko') {
					$('#' + label + 'Msg').html(dataObject.msg);
					$('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
				}
				else if(dataObject.stat === 'ok') {
					$('#' + label + 'Msg').html(dataObject.msg);
					$('#' + label).removeClass('alert-danger').addClass('alert-success').removeClass('none');
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
}

function redirectHome() {
	document.location.href="accueil";
}

function submitSuiviForm() {


    var input = $('#suivi'),
        number = input.val();

    if (number != parseInt(number, 10)) {
        //$('#suiviTooltip').tooltip('show');
        $('input[rel="txtTooltip"]').tooltip('show');
    } else {
        document.location.href="suivi?" + number;
    }
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

			address : $('#autocomplete2'),
			streetnumber : $('#street_number2').val(),
			route : $('#route2').val(),
			city : $('#locality2').val(),
			zipcode : $('#postal_code2').val(),
			country : $('#country2').val(),

			ramaddress : $('#autocomplete3'),
			ramstreetnumber : $('#street_number3').val(),
			ramroute : $('#route3').val(),
			ramcity : $('#locality3').val(),
			ramzipcode : $('#postal_code3').val(),
			ramcountry : $('#country3').val(),

			packaging : $('input:radio[name=emballage]:checked').val(),
			type : $('input:radio[name=type]:checked').val(),

			priority : $('#prioritaire').val(),// .attr('checked') == true ou isChecked ?
			unexpected : $('#unexpected').val(),
			indemnity : $('#indemnity').val(),
			taking : $('#taking').val(),
			saturday : $('#saturday').val()
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

/*	if(data.zipcode.val() === '' || !checkZipCode.test(data.zipcode.val())) {
		data.zipcode.parents('.form-group').addClass('has-error');
		error ++;
	}*/


	// If no error : submit form
	if(error === 0) {
		alert('submit');
		$('#depot-form').submit();
	}
}

function sendMessage() {
	var name = $('#contactName').val(),
		mail = $('#contactMail').val(),
		subject = $('#contactSubject').val(),
		message = $('#contactMessage').val(),
		label = 'sendMessage',
		error = 0;

	if(message == '') {
		$('#' + label + 'Msg').html('Votre message est vide !');
		$('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');

		error = 1;
	}

	if(error === 0) {
		$.ajax({
			type: "POST",
			url: 'contact',
			data: {
				action: 'sendMessage',
				param: [name, mail, message, subject]
			},
			success: function(data) {
				var dataObject = JSON.parse(data);	// transforms json return from php to js object

				if(dataObject.stat === 'ko') {
					$('#' + label + 'Msg').html(dataObject.msg);
					$('#' + label).removeClass('alert-success').addClass('alert-danger').removeClass('none');
				}
				else if(dataObject.stat === 'ok') {
					$('#' + label + 'Msg').html(dataObject.msg);
					$('#' + label).removeClass('alert-danger').addClass('alert-success').removeClass('none');

					setTimeout(function(){
						window.location.assign('accueil');
					}, 3000);
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
	autocomplete1,
	autocomplete2,
	autocomplete3,
	autocomplete4;

function initAutocomplete() {
	// Create the autocomplete object, restricting the search to geographical location types.
	autocomplete1 = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('autocomplete1')),
		{types: ['geocode']});
	autocomplete2 = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('autocomplete2')),
		{types: ['geocode']});
	autocomplete3 = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('autocomplete3')),
		{types: ['geocode']});
	autocomplete4 = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('autocomplete4')),
		{types: ['geocode']});

	// When the user selects an address from the dropdown, populate the address fields in the form.
	autocomplete1.addListener('place_changed', fillInAddress);
	autocomplete2.addListener('place_changed', fillInAddress);
	autocomplete3.addListener('place_changed', fillInAddress);
	autocomplete4.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
	// Get the place details from the autocomplete object.
	var place1 = autocomplete1.getPlace(),
		place2 = autocomplete2.getPlace(),
		place3 = autocomplete3.getPlace(),
		place4 = autocomplete4.getPlace();

	// Get each component of the address from the place details
	// and fill the corresponding field on the form.
	// TODO : O-PTI-MI-SA-TION

	console.log(place4);

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
		});
	}
}