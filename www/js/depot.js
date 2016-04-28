function submitDepotForm() {
    // get fields to check
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

        var params = sortData(data),
            label = 'formDepot';

        $.ajax({
            type: "POST",
            url: 'accueil_extranet',
            data: {
                action: 'parcelPosting',
                param: params
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

function sortData(data) {

    var params = [];

    $.each(data, function(key, value) {
        params[key] = value;
    });

    params['firstname'] = data.firstname.val();
    params['lastname'] = data.lastname.val();
    params['mail'] = data.mail.val();
    params['receiverFirstname'] = data.receiverFirstname.val();
    params['receiverLastname'] = data.receiverLastname.val();

    return params;
}

function claculateQuotation() {
    // TODO : calcul en temps réel du total + proposer un devis
}