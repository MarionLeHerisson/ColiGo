function closePopin() {
	$('.alert-dismissible').each(function() {
		$(this).addClass('none');
	});
}

function showForgotPwdPopin(mail) {
    if(mail != null && mail != '') {
        $('#forgotPwdMail').val(mail);
    }
	$('#modalForgotPwd').modal('show');
}

function forgotPwd() {

	var label = 'fgtPwd',
		mail = $('#forgotPwdMail').val(),
		checkMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-_]+.[a-zA-Z]{2,4}$/i;

	if(mail === '' || !checkMail.test(mail)) {
		showMessage(label, 'Veuillez entrer une adresse mail valide.', 1);
		return;
	}

	myAjax(label, 'profil', 'lostPwd', [mail], function(data) {
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
	});
}

function showChangeMail() {
    // empty the modal
    $('#newMail').val('');
    $('#changeMail').addClass('none');

    $('#modalChangeMail').modal('show');
}

function changeMail() {
    var newMail = $('#newMail').val(),
        label = 'changeMail';

    if(!/[\d\w.\-_]+@[\d\w.\-_]+\.[\w]{2,3}/.test(newMail) || newMail === '') {
        showMessage(label, 'Merci de renseigner une adresse mail valide.', true)
    }
    else {
        myAjax(label, 'profil', 'changeMail', [newMail], function(data) {
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
        });
    }
}

function showChangePwd() {
    // empty the modal
    $('#oldPwd').val('');
    $('#newPwd').val('');
    $('#confirmNewPwd').val('');
    $('#changePwd').addClass('none');

    $('#modalChangePwd').modal('show');
}

function changePwd() {
    var oldPwd = $('#oldPwd').val(),
        newPwd = $('#newPwd').val(),
        confNewPwd = $('#confirmNewPwd').val(),
        label = 'changePwd';

    if(oldPwd === '' || newPwd === '' || confNewPwd === '') {
        showMessage(label, 'Tous les champs sont requis.', true);
        return;
    }

    if(newPwd == confNewPwd) {
        myAjax(label, 'profil', 'changePwd', [oldPwd, newPwd], function(data) {
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
        });
    }
    else {
        showMessage(label, 'Le nouveau mot de passe et sa confirmation ne sont pas identiques.', true);
    }
}

function sanitizeNumbers(event) {
	var input = $(event.target),
		value = input.val();

	value = value.replace(/ /g, "");
	value = value.replace(/,/g, ".");

	var splited = value.split(".");

	if(splited.length == 2 && splited[1].length == 2) {
		input.val(value);
	}
	else if(splited.length == 2 && splited[1].length == 1) {
		input.val(value + "0");
	}
	else if(splited.length == 2 && splited[1].length == 0) {
		input.val(value + "00");
	}
	else if(splited.length == 1) {
		input.val(value + ".00");
	}
	else {
		input.val("");
	}
}

function clearEverything() {
	closePopin();

	$('#depot-form')[0].reset();
	$('#addRelayPoint-form')[0].reset();
	$('#inscription-form')[0].reset();

	$('#newRoleMail').val('');
	$('#idMailEmployeRem').val('');
	$('#idRpMail').val('');
	$('#idColisDistribue').val('');
	$('#idColisLivre').val('');
	$('#idColisPerdu').val('');
	$('#idColisPrisEnCharge').val('');
}

$('.collapsed').on('click', clearEverything);


/**
 * Ajax function to be used in this code
 *
 * @param String label		// Where error message will appear
 * @param String url		// The Controller to be called
 * @param String action		// The method to be called
 * @param Array param		// Parameters
 * @param Callable callback	// Called if success
 */
function myAjax(label, url, action, param, callback) {

	$.ajax({
		type: "POST",
		url: url,
		data: {
			action: action,
			param: param
		},
		success: callback,
		error: function() {
			showMessage(label,'Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer.' +
				'Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.', true);
		}
	});
}

/**
* Send message page
*/
function sendMessage() {
	var name = $('#contactName').val(),
		mail = $('#contactMail').val(),
		subject = $('#contactSubject').val(),
		message = $('#contactMessage').val(),
		label = 'sendMessage';

	if(message == '') {
		showMessage(label, 'Votre message est vide !', true);
		return;
	}
	else if(!/[\d\w.\-_]+@[\d\w.\-_]+\.[\w]{2,3}/.test(mail)) {
		showMessage(label, 'Merci de renseigner une adresse mail valide.', true);
		return;
	}

	myAjax(label, 'contact', 'sendMessage', [name, mail, message, subject], function(data) {
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
	});
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

function submitInscForm() {
	// if errors have alrady been shown, hide them
	$('.bg-danger').each(function(){$(this).addClass('none');});
	$('.alert-danger').each(function(){$(this).addClass('none');});

	// get inputs values
	var firstname = $('#formFirstname').val(),
		lastname = $('#formLastname').val(),
		email = $('#formEmail').val(),
		pwd = $('#formPwd').val(),
		pwdConf = $('#formPwdConfirm').val(),
		error = 0,
        label = 'insc',
		number = $('#street_number1').val(),
		route = $('#route1').val(),
		zip_code = $('#postal_code1').val(),
		city = $('#locality1').val(),
		country = $('#country1').val();


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

	// adress ?
	if(number != '' || route != '' || zip_code != '' || city != '') {
		if(number == '' || route == '' || zip_code == '' || city == '') {
			showMessage(label, 'Si vous entrez une adresse, celle-ci doit être complète. Merci de la sélectionner via la ' +
				'liste déroulante', true);
			return;
		}
		else if(country != 'France') {
			showMessage(label, 'Si vous entrer une adresse, celle-ci doit se trouver en France.', true);
			return;
		}
	}

    // mail alrady exists ?
    myAjax(label, 'inscription', 'mailExists', [email], function(data) {
        var dataObject = JSON.parse(data);		// transforms json return from php to js object

        if(dataObject.stat === 'ok') {
            // If there is no erreor, send form
            if(error == 0) {
                $('#inscription-form').submit();
            }
        }
        else if (dataObject.stat === 'ko') {
            showMessage(label, dataObject.msg, true);
        }
        else {
            showMessage(label, 'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.', true);
        }
    });

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

/**
* Scroll buttons
*/
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
            scrollTop:2000
        },
        'slow'
    );
}

/**
* Get latitude and longitude from an address provided by Google
*/
function getLatLng() {

	var address = $('#autocomplete4').val(),
		latitude = "NULL",
		longitude = "NULL";

	if(address == undefined) {
		address = $('#autocomplete5').val();
	}
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

function getRemuneration(mail) {
	mail = $('#idMailEmployeRem').val();

	// TODO : regexp (dans tous les cas)

	var label = 'MailEmployeRem';

	myAjax(label, 'accueil_extranet', 'getRemuneration', [mail], function(data) {
		var dataObject = JSON.parse(data);		// transforms json return from php to js object

		if(dataObject.stat === 'ok') {
			showMessage(label, dataObject.msg, false);
		}
		else {
			showMessage(label, 'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.', true);
		}
	})
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

	myAjax(parcelLabel, 'accueil_extranet', 'updateParcelStatus', [parcelId,idType], function(data) {
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
	});
}