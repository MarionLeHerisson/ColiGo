/**
* Removes all error messages and empty all inputs
*/
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


function xmlRelayPoint() {
    var rpMail = $('#idRpMail').val(),
        label = 'manualXml';
    
    // if errors have alrady been shown, hide them
	$('.alert').each(function(){$(this).addClass('none');});
    
    if(!/[\d\w.\-_]+@[\d\w.\-_]+\.[\w]{2,3}/.test(rpMail)) {
		showMessage(label,'Veuillez entrer une adresse mail valide.', true);
		return;
    }
    
    myAjax(label, 'accueil_extranet', 'xmlRelayPoint', [rpMail], function(data) {
        var dataObject = JSON.parse(data);	// transforms json return from php to js object

        if(dataObject.stat === 'ko') {
            showMessage(label, dataObject.msg, true);
        }
        else if(dataObject.stat === 'ok') {
            showMessage(label, dataObject.msg, false);
        }
        else {
            showMessage(label,'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.', true);
        }
    });
}

function xmlDay() {
}

function xmlMonth() {
}

/**
* updates the role of an user
*/
function updateNewRole() {

	var mail = $('#newRoleMail').val(),
        role = $('#selectNewRole option:selected').val(),
        label = 'newRole';
    
    if(mail == '') {
        showMessage(label, 'Veuillez entrer une adresse mail.', true);
        return;
    }
    else if(!/[\d\w.\-_]+@[\d\w.\-_]+\.[\w]{2,3}/.test(rpMail)) {
		showMessage(label,'Veuillez entrer une adresse mail valide.', true);
		return;
    }
    else if(role == '' || role < 0 || role > 4 || role != parseInt(role)) {
		showMessage(label,'Veuillez entrer un rôle valide via le menu déroulant.', true);
		return;
    }

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

/**
* Updates the status of a parcel
*/
function updateParcelStatus(idType) {

	var parcelLabel = '',
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

	parcelId = $('#id' + parcelLabel).val();
    
    if(parcelId == '') {
        showMessage(parcelLabel, 'Veuillez entrer l\'id du colis.', true);
        return;
    }
    else  if(parcelId != parseInt(parcelId)) {
        showMessage(parcelLabel, 'L\'id du colis doit être un nombre.', true);
        return;
    }

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

/**
* Adds a new relay point
*/
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

