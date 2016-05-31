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
        unexpected : $('#imprevu').val(),
        indemnity : $('#indemnisation').val(),
        taking : $('#ramassage').val(),
        saturday : $('#samedi').val()
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

        myAjax(label, 'accueil_extranet', 'parcelPosting', data, function(ret) {
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
        });
    }
}

function claculateQuotation(event) {
    var weight = $('#weight').val(),
        input = $(event.target),
        label = input.attr('name'),

        price = parseFloat(input.attr('data-price')),
        tbody = $('#tbody'),
        newExtra = '<tr>' +
            '<td class="billLabel text-left" data-label="'+ label + '">' + label + '</td>' +
            '<td></td>'+
            '<td class="billPrice text-right">' + price + '</td>' +
        '</tr>';

    if(input.attr('name') == 'type' || input.attr('name') == 'weight') {
        showPriceType(label, weight);
    }
    else if (input.attr('name') == 'emballage') {
        showPriceEmballage(label, price, input, tbody);
    }
    else if((input).is(':checked')) {
        showPriceCheckbox(label, tbody, newExtra);
    }
    else {
        $('[data-label="' + label + '"]').parent().addClass('none');
    }

    showWithRightPrecision(calculateTotalPrice());
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

function calculateTotalPrice() {

    var totalPrice = 0;

    $('.billPrice').each(function() {
        if(!$(this).parent().hasClass('none')) {
            totalPrice = parseFloat($(this).text()) + parseFloat(totalPrice);
        }
    });

    return totalPrice;
}

function showWithRightPrecision(totalPrice) {

    if(totalPrice < 10) {
        $('#billTotalPrice').text(totalPrice.toPrecision(3));
    }
    else if(totalPrice < 100) {
        $('#billTotalPrice').text(totalPrice.toPrecision(4));
    }
    else{
        $('#billTotalPrice').text(totalPrice.toPrecision(5));
    }
}

function showPriceEmballage(label, price, input, tbody) {
    if (price === parseFloat(price)) {

        var emballage = $('[data-label="emballage"]'),
            newExtra = '<tr>' +
                '<td class="billLabel text-left" data-label="'+ label + '">' + input.attr('id') + '</td>' +
                '<td></td>' +
                '<td class="billPrice text-right">' + price.toPrecision(2) + '</td>' +
                '</tr>';

        if (emballage) {
            emballage.parent().addClass('none');
        }

        tbody.append(newExtra);
    }
    else {
        $('[data-label="emballage"]').parent().addClass('none');
    }
}

function showPriceCheckbox(label, tbody, newExtra) {

    if($('[data-label="' + label + '"]')) {
        $('[data-label="' + label + '"]').parent().addClass('none');
    }

    tbody.append(newExtra);
}

function showPriceType(label, weight) {
    var checkedType = $('[name="type"]:checked'),
        type = checkedType.val();

    $('#trType').text(checkedType.attr('id'));    // changes the type name in the quotation
    $('#trWeight').text(weight + ' kg');        // changes the weight in the quotation

    // calculate weight price
    myAjax(label, 'accueil_extranet', 'getWeightPrice', [weight, type], function(ret) {
        var dataObject = JSON.parse(ret);	// transforms json return from php to js object
        $('#trPrice').text(dataObject.price);
    });
}