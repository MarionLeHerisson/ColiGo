function submitDepotForm() {
    // get fields to check
    var data = {
        firstname : $('#firstname').val(),
        lastname : $('#name').val(),
        mail : $('#mail').val(),
        weight : $('#weight').val(),
        receiverFirstname : $('#destfirstname').val(),
        receiverLastname : $('#destname').val(),

//        address : $('#autocomplete2'),
        streetnumber : $('#street_number2').val(),
        route : $('#route2').val(),
        city : $('#locality2').val(),
        zipcode : $('#postal_code2').val(),
        country : $('#country2').val(),

//        ramaddress : $('#autocomplete3'),
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
//        checkZipCode = /^[0-9]{5}$/,
        label = 'formDepot';



    // if errors are shown, hide them
    $.each(data, function() {
        $(this).parents('.form-group').removeClass('has-error');
    });

    // verif inputs
    if(data.firstname === '') {
        showMessage(label, 'Le prénom de l\'envoyeur est obligatoire.', 1);
        error ++;
    } else if (data.firstname.length < 2) {
        showMessage(label, 'Le prénom de l\'envoyeur doit contenir au moins deux caractères.', 1);
        error ++;
    }

    if(data.lastname === '') {
        showMessage(label, 'Le nom de l\'envoyeur est obligatoire.', 1);
        error ++;
    } else if (data.lastname.length < 2) {
        showMessage(label, 'Le nom de l\'envoyeur doit contenir au moins deux caractères.', 1);
        error ++;
    }

    if(data.mail === '' || !checkMail.test(data.mail)) {
        showMessage(label, 'Le mail de l\'envoyeur est obligatoire.', 1);
        error ++;
    }

    if(data.receiverFirstname === '') {
        showMessage(label, 'Le prénom du destinataire est obligatoire.', 1);
        error ++;
    } else if (data.receiverFirstname.length < 2) {
        showMessage(label, 'Le prénom du destinataire doit contenir au moins deux caractères.', 1);
        error ++;
    }

    if(data.receiverLastname === '') {
        showMessage(label, 'Le nom du destinataire est obligatoire.', 1);
        error ++;
    } else if (data.receiverLastname.length < 2) {
        showMessage(label, 'Le nom du destinataire doit contenir au moins deux caractères.', 1);
        error ++;
    }


    // If no error : submit form
    if(error === 0) {

        $.ajax({
            type: "POST",
            url: 'accueil_extranet',
            data: {
                action: 'parcelPosting',
                param: data
            },
            success: function(ret) {
                var dataObject = JSON.parse(ret);	// transforms json return from php to js object

                if(dataObject.stat === 'ko') {
                    showMessage(label, dataObject.msg, 1);
                }
                else if(dataObject.stat === 'ok') {
                    showMessage(label, dataObject.msg, 0);
                    window.open("facture?tracking_number=" + dataObject.num);
                    $('#depot-form')[0].reset();
                }
                else {
                    showMessage(label, 'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.', 1);
                }
            },
            error: function() {
                showMessage(label, 'Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer.' +
                    'Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.', 1);
            }
        });
    }
}

function claculateQuotation(event) {
    var weight = $('#weight').val(),
        divNewPrice = $('#billTotalPrice'),
        actualPrice = parseInt(divNewPrice.text()),
        input = $(event.target),
        price = parseInt(input.attr('data-price')),
        label = input.attr('name'),
        tbody = $('#tbody'),
        newExtra = '<tr>' +
            '<td class="billLabel" data-label="'+ label + '">' + label + '</td>' +
            '<td class="billPrice">' + price + '</td>' +
        '</tr>';

    if(input.attr('name') == 'type') {
        // calculate weight price
        $.ajax({
            type: "POST",
            url: 'accueil_extranet',
            data: {
                action: 'getWeightPrice',
                param: weight
            },
            success: function(ret) {
                var dataObject = JSON.parse(ret);	// transforms json return from php to js object

            },
            error: function() {
                showMessage(label, 'Une erreur de connexion s\'est produite. Veuillez recharger la page et réessayer.' +
                    'Si l\'erreur persiste, veuillez contacter l\'équipe technique de ColiGo.', 1);
            }
        });
    }
    else if (input.attr('name') == 'emballage') {

        if (price === parseInt(price, 10)) {

            if ($('[data-label="emballage"]')) {
                $('[data-label="emballage"]').parent().addClass('none');
            }

            tbody.append(newExtra);
        }
        else {
            $('[data-label="emballage"]').parent().addClass('none');
        }
    }
    else if((input).is(':checked')) {

        if($('[data-label="' + label + '"]')) {
            $('[data-label="' + label + '"]').parent().addClass('none');
        }

        tbody.append(newExtra);

    }
    else {
        $('[data-label="' + label + '"]').parent().addClass('none');
    }
    console.log('actual price : ' + actualPrice);
    console.log('price : ' + price);
    console.log(input);
    // TODO : calculer prix total à partir du contenu des divs apparentes + prix au poid
    // TODO : réussir à récupérer le prix des radio buttons
}

function blockRamAddress() {

    var autocomplete = $('#autocomplete3');

    if($('input[name=ramassage]').is(':checked')) {
        autocomplete.removeAttr('disabled');
    } else {
        autocomplete.attr('disabled', 'disabled');
        autocomplete.val('');
        $('#street_number3').val('');
        $('#route3').val('');
        $('#locality3').val('');
        $('#postal_code3').val('');
        $('#country3').val('');
    }
}