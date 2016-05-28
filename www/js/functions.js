function closePopin() {
	$('.alert-dismissible').each(function() {
		$(this).addClass('none');
	});
}

/**
 * Ajax function to be used in this code
 * TODO : à tester
 *
 * @param String label		// Where error message will appear
 * @param String url		// The Controller to be called
 * @param String action		// The method to be called
 * @param Array param		// Parameters
 * @param Callable callback	// Called if success
 *
 * @author Marion
 */
function myAjax(label, url, action, param, callback) {

	$.ajax({
		type: "POST",
		url: url,
		data: {
			action: action,
			param: param
		},
		success: callback(),
		error: function() {
			showMessage(label,'Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer.' +
				'Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.', true);
		}
	});
}

function clearEverything() {
	closePopin();

	$('#depot-form')[0].reset();
	$('#addRelayPoint-form')[0].reset();
	$('#inscription-form')[0].reset();

	$('#idColisDistribue').val('');
	$('#idColisLivre').val('');
	$('#idColisPerdu').val('');
	$('#idColisPrisEnCharge').val('');
}

$('.collapsed').on('click', clearEverything);

function updateNewRole() {

	var mail = $('#newRoleMail').val(),
        role = $('#selectNewRole option:selected').val(),
        label = 'newRole';

	// TODO : créer une fonction myAjax();
	$.ajax({
		type: "POST",
		url: 'accueil_extranet',
		data: {
			action: 'updateUserRole',
			param: [mail,role]
		},
		success: function(data) {
			var dataObject = JSON.parse(data);	// transforms json return from php to js object

			if(dataObject.stat === 'ko') {
				showMessage(label,dataObject.msg, true);
			}
			else if(dataObject.stat === 'ok') {
				showMessage(label,dataObject.msg, false);
			}
			else {
				showMessage(label,'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.', true);
			}
		},
		error: function() {
			showMessage(label,'Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer.' +
				'Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.', true);
		}
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
				showMessage(parcelLabel, dataObject.msg, true);
			}
			else if(dataObject.stat === 'ok') {
				showMessage(parcelLabel, dataObject.msg, false);
			}
			else {
				showMessage(parcelLabel, 'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.', true);
			}
		},
		error: function() {
			showMessage(parcelLabel,'Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer.' +
				'Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.', true);
		}
	});
}

function addNewRelayPoint() {
	var rpMail = $('#rpmail').val(),
		rpAddress = $('#street_number4').val() + ', ' + $('#route4').val(),
		rpZipCode = $('#postal_code4').val(),
		rpCity = $('#locality4').val(),
		rpCountry = $('#country4').val(),
		rpLabel = $('#rpLabel').val(),
		lat = $('#lat').val(),
		lng = $('#lng').val(),
		label = 'newRelayPoint',
		error = 0;

	if(rpCountry !== 'France') {
		showMessage(label,'Le point relais doit se situer en France.', true);
		error = 1;
	}

	// If fields are empty
	if(rpAddress == '' || rpZipCode == '' || rpCity == '') {
		showMessage(label,'Veuillez entrer une adresse complète.', true);
        return;
	}
	// If fields are number / If zip code is string
	else if(rpAddress == parseInt(rpAddress) || rpZipCode != parseInt(rpZipCode) || rpCity == parseInt(rpCity)) {
		showMessage(label,'Veuillez entrer une adresse valide.', true);
        return;
	}
	// If mail field is empty
	else if(rpMail == '') {
		showMessage(label,'Veuillez entrer une adresse mail.', true);
        return;
	}
	else if(!/[\d\w.\-_]+@[\d\w.\-_]+\.[\w]{2,3}/.test(rpMail)) {
		showMessage(label,'Veuillez entrer une adresse mail valide.', true);
		return;
	}
	// If label is empty
	else if(rpLabel == '') {
		showMessage(label,'Veuillez entrer le nom de l\'enseigne.', true);
        return;
	}

	if(error === 0) {
		$.ajax({
			type: "POST",
			url: 'accueil_extranet',
			data: {
				action: 'addRelayPoint',
				param: [rpMail,rpAddress,rpZipCode,rpCity, lat, lng, rpLabel]
			},
			success: function(data) {
				var dataObject = JSON.parse(data);	// transforms json return from php to js object

				if(dataObject.stat === 'ko') {
					showMessage(label, dataObject.msg, true);
				}
				else if(dataObject.stat === 'ok') {
					showMessage(label, dataObject.msg, false);
				}
				else {
					showMessage(label, 'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.', true);
				}
			},
			error: function() {
				showMessage(label, 'Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer.' +
				'Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.', true);
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

function sendMessage() {
	var name = $('#contactName').val(),
		mail = $('#contactMail').val(),
		subject = $('#contactSubject').val(),
		message = $('#contactMessage').val(),
		label = 'sendMessage',
		error = 0;

	if(message == '') {
		showMessage(label, 'Votre message est vide !', true);
		error = 1;
	}
	else if(!/[\d\w.\-_]+@[\d\w.\-_]+\.[\w]{2,3}/.test(email)) {
		showMessage(label, 'Merci de renseigner une adresse mail valide.', true)
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
					showMessage(label, dataObject.msg, true);
				}
				else if(dataObject.stat === 'ok') {
					showMessage(label, dataObject.msg, false);

					setTimeout(function(){
						window.location.assign('accueil');
					}, 3000);
				}
				else {
					showMessage(label, 'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.', true);
				}
			},
			error: function() {
				showMessage(label, 'Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer. ' +
					'Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.', true);
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

function showMessage(label, message, isError) {

	var typeAdded ='success',
		typeRemoved = 'danger';
	if(isError == 1) {
		typeAdded = 'danger';
		typeRemoved = 'success';
	}

	$('#' + label + 'Msg').html(message);
	$('#' + label).removeClass('alert-' + typeRemoved).addClass('alert-' + typeAdded).removeClass('none');
}

/**
 * Show tooltips on page 'deposer'
 */
function showTooltip(label) {
	$('#' + label).tooltip('show');
}

function scrollToTop() {

    var body = $("html, body");
    body.animate({
            scrollTop:0
        },
        'slow'
    );
}

function scrollToBottom() {

    var body = $("html, body");
    body.animate({
            scrollTop:1000
        },
        'slow'
    );
}

function getLatLng() {

	var address = $('#autocomplete4').val(),
		latitude = "NULL",
		longitude = "NULL";

	var res = address.replace(/ /g, "+");

	$.ajax({
		url:"http://maps.googleapis.com/maps/api/geocode/json?address="+res+"&sensor=false",
		type: "POST",
		success:function(res){
			latitude = res.results[0].geometry.location.lat;
			longitude = res.results[0].geometry.location.lng;

			$('#lat').val(latitude);
			$('#lng').val(longitude);
		}
	});
}

// TODO : Fichier unique pour l'extranet
