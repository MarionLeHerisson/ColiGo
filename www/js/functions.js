// TODO : à la fermeture d'un onglet, faire disparaitre msg erreur ($(this) hasClass 'fermé' children addClass('none') + faire disparaitre contenu inputs
function closePopin() {
	$('.alert-dismissible').each(function() {
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