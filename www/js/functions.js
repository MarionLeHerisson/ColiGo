function closePopin() {
	$('.alert-dismissible').each(function() {
		$(this).addClass('none');
	});
}

/**
 * Ajax function to be used in this code
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
		label = 'sendMessage',
		error = 0;

	if(message == '') {
		showMessage(label, 'Votre message est vide !', true);
		error = 1;
	}
	else if(!/[\d\w.\-_]+@[\d\w.\-_]+\.[\w]{2,3}/.test(mail)) {
		showMessage(label, 'Merci de renseigner une adresse mail valide.', true)
	}

	if(error === 0) {
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
            scrollTop:1000
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
	if(mail == null) {
		mail = $('#idMailEmployeRem').val();
	}

	// TODO : regexp (dans tous les cas)

	var label = 'MailEmployeRem';

	myAjax(label, 'accueil_extranet', 'getRemuneration', [mail], function() {

	})
}