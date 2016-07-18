var data = {};

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

function submitDepotForm() {
    // get fields to check
    data = {
        firstname : $('#firstname').val(),
        lastname : $('#name').val(),
        mail : $('#mail').val(),
        weight : $('#weight').val(),
        receiverFirstname : $('#destfirstname').val(),
        receiverLastname : $('#destname').val(),

        depAddress : $('#choosenTakingAddress').val(),
        streetnumber : $('#street_number2').val(),
        route : $('#route2').val(),
        city : $('#locality2').val(),
        zipcode : $('#postal_code2').val(),
        country : $('#country2').val(),

        arrAddress : $('#chosenDeliveryAddress').val(),
        ramstreetnumber : $('#ram_street_number').val(),
        ramroute : $('#ram_route').val(),
        ramcity : $('#ram_locality').val(),
        ramzipcode : $('#ram_postal_code').val(),
        ramcountry : $('#ram_country').val(),

        packaging : $('input:radio[name=emballage]:checked').val(),
        type : $('input:radio[name=type]:checked').val(),

        priority : $('#prioritaire:checked').val(),
        unexpected : $('#imprevu:checked').val(),
        indemnity : $('#indemnisation:checked').val(),
        taking : $('#ramassage:checked').val(),
        delivery : $('#livraison:checked').val(),
        saturday : $('#samedi:checked').val(),
        additionnal : $('#chAdd:checked').attr('data-price')
    };

    var checkMail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/i,
        label = 'formDepot';


    // if errors are shown, hide them
    $('.close').each(function() {
        $(this).trigger('click');
    });

    // verif inputs
    if(data.firstname === '') {
        showMessage(label, 'Le prénom de l\'envoyeur est obligatoire.', 1);
        return;
    } else if (data.firstname.length < 2) {
        showMessage(label, 'Le prénom de l\'envoyeur doit contenir au moins deux caractères.', 1);
        return;
    }

    if(data.lastname === '') {
        showMessage(label, 'Le nom de l\'envoyeur est obligatoire.', 1);
        return;
    } else if (data.lastname.length < 2) {
        showMessage(label, 'Le nom de l\'envoyeur doit contenir au moins deux caractères.', 1);
        return;
    }

    if(data.mail === '' || !checkMail.test(data.mail)) {
        showMessage(label, 'Le mail de l\'envoyeur est obligatoire.', 1);
        return;
    }

    if(data.weight == '') {
        showMessage(label, 'Le poids du colis est obligatoire.', 1);
        return;
    }

    if(data.depAddress == '') {
        showMessage(label, 'Veuillez sélectionner une adresse de départ.', 1);
        return;
    }

    if(data.receiverFirstname === '') {
        showMessage(label, 'Le prénom du destinataire est obligatoire.', 1);
        return;
    } else if (data.receiverFirstname.length < 2) {
        showMessage(label, 'Le prénom du destinataire doit contenir au moins deux caractères.', 1);
        return;
    }

    if(data.receiverLastname === '') {
        showMessage(label, 'Le nom du destinataire est obligatoire.', 1);
        return;
    } else if (data.receiverLastname.length < 2) {
        showMessage(label, 'Le nom du destinataire doit contenir au moins deux caractères.', 1);
        return;
    }

    if(data.arrAddress == '') {
        showMessage(label, 'Veuillez sélectionner une adresse de livraison.', 1);
        return;
    }

    // If normal user : show the modal simulating payment interface
    if($('#fret').val() == undefined) {
        showPaymentModal();
    }
    else {  // if admin, skip payment (we assume relay points have card machines, or they take cash)
        postParcel();
    }
}

function showPaymentModal() {
    $('#myModal').modal('show');
}

function verifPayment() {

    var checkName = /^[a-zA-Z\-]+[ ]{1}[a-zA-Z\-]+$/,
        label = 'formPayment',
        name = $('#cb_owner').val(),
        number = $('#cb_number').val(),
        month = $('#cb_select_month option:selected').val(),
        year = $('#cb_select_year option:selected').val(),
        crypto = $('#crypto').val(),
        date = new Date(),
        actualMonth = date.getMonth() + 1,
        actualYear = date.getFullYear();

    if(name === '' || !checkName.test(name)) {
        showMessage(label, 'Le nom du propriétaire de la carte est obligatoire.', 1);
        return;
    }

    if(number === '') {
        showMessage(label, 'Le numéro de carte bleue est obligatoire.', 1);
        return;
    } else if(number.replace(/ /g, '').length != 16 || parseInt(number) != number) {
        showMessage(label, 'Veuillez enter un numéro de carte bleue valide.', 1);
        return;
    }

    if(month === '' || month < 1 || month > 12 || parseInt(month) != month) {
        showMessage(label, 'Veuillez sélectionner un mois depuis le menu déroulant.', 1);
        return;
    } else if(year === '' || year < 2016 || parseInt(year) != year) {
        showMessage(label, 'Veuillez sélectionner une année depuis le menu déroulant.', 1);
        return;
    } else if (year == actualYear && month < actualMonth) {
        showMessage(label, 'Vous ne pouvez pas payer avec une carte périmée.', 1);
        return;
    }

    if(crypto === '') {
        showMessage(label, 'Le cryptogramme visuel est obligatoire.', 1);
        return;
    } else if(crypto.replace(/ /g, '').length != 3 || parseInt(crypto) != crypto) {
        showMessage(label, 'Veuillez enter un cryptogramme visuel valide.', 1);
        return;
    }

    showMessage(label, 'Votre paiement a bien été enregistré.');

    setTimeout(function(){
        $('#myModal').modal('hide');

        postParcel();

    }, 2000);
}

function postParcel() {

    var label = 'formDepot';

    myAjax(label, 'accueil_extranet', 'parcelPosting', data, function(ret) {
        var dataObject = JSON.parse(ret);	// transforms json return from php to js object

        if(dataObject.stat === 'ko') {
            showMessage(label, dataObject.msg, 1);
        }
        else if(dataObject.stat === 'ok') {
            showMessage(label, dataObject.msg, 0);
            window.open("facture?tracking_number=" + dataObject.num, "", "width=1000,height=800");
            $('#depot-form')[0].reset();
        }
        else {
            showMessage(label, 'Une erreur s\'est produite. Veuillez contacter l\'équipe technique de ColiGo.', 1);
        }
    });
}

function calculateQuotation(event) {
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
        showWithRightPrecision(calculateTotalPrice());
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
    showWithRightPrecision(calculateTotalPrice());
}

function showPriceCheckbox(label, tbody, newExtra) {

    if($('[data-label="' + label + '"]')) {
        $('[data-label="' + label + '"]').parent().addClass('none');
    }

    tbody.append(newExtra);
    showWithRightPrecision(calculateTotalPrice());
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
        showWithRightPrecision(calculateTotalPrice());
    });
}

function showChoixAd(param) {
    $('#modalDeliveryAddress').modal('show');

    if(param === 'ram') {
        $('#choixRamAd').addClass('active');
        $('#choixRamRP').removeClass('active');
    }
    else if(param === 'liv') {
        $('#choixLivAd').addClass('active');
        $('#choixLivRP').removeClass('active');
    }

    $('#paramAdd').text(param);
}

function showChoixRP(param) {
    $('#modalDeliveryRP').modal('show');
    initMap();

    if(param === 'ram') {
        $('#choixRamRP').addClass('active');
        $('#choixRamAd').removeClass('active');
    } else if(param === 'liv') {
        $('#choixLivRP').addClass('active');
        $('#choixLivAd').removeClass('active');
    }

    $('#paramRP').text(param);
}

function selectOtherAd() {

    var streetNum = $('#street_number3'),
        route = $('#route3'),
        postCode = $('#postal_code3'),
        loc = $('#locality3'),
        country = $('#country3'),
        address = "" + streetNum.val() + ", " + route.val() + ", " + postCode.val() + loc.val(),
        param = $('#paramAdd').text();

    if(param === 'ram') {
        $("#ramassage:not(:checked)").trigger( "click" );     // activate hidden input's event on click
        $('#choosenTakingAddress').val(address);

        $('#ram_street_number').val(streetNum.val());
        $('#ram_route').val(route.val());
        $('#ram_locality').val(loc.val());
        $('#ram_postal_code').val(postCode.val());
        $('#ram_country').val(country.val());
    }
    else if(param === 'liv') {
        $("#livraison:not(:checked)").trigger( "click" );     // activate hidden input's event on click
        $('#chosenDeliveryAddress').val(address);

        $('#street_number2').val(streetNum.val());
        $('#route2').val(route.val());
        $('#locality2').val(loc.val());
        $('#postal_code2').val(postCode.val());
        $('#country2').val(country.val());
    }

    // empty the popin
    $('#autocomplete3').val('');
    streetNum.val('');
    route.val('');
    loc.val('');
    postCode.val('');
    country.val('');

    $('#modalDeliveryAddress').modal('hide');
}