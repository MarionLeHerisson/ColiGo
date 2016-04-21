<form method="POST" action="validation" enctype="multipart/form-data" class="form-horizontal col-md-9" id="inscription-form">

    <div class="form-group">
        <label class="control-label col-md-2" for="email">Prénom* :</label>
        <div class="col-md-6">
            <input name="firstname" id="formFirstname" type="text" class="form-control" placeholder="Catherine">
        </div>
        <p class="col-md-4 none ttFistname bg-danger">
            Votre prénom est obligatoire
        </p>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="email">Nom* :</label>
        <div class="col-md-6">
            <input name="lastname" id="formLastname" type="text" class="form-control" placeholder="Dupuis">
        </div>
        <p class="col-md-4 none ttLastname bg-danger">
            Votre nom de famille est obligatoire
        </p>
    </div>

    <div class="form-group" data-example-id="static-tooltips">
        <label class="control-label col-md-2" for="email">Email* :</label>
        <div class="col-md-6">
            <input name="email" id="formEmail" type="email" class="form-control" placeholder="exemple@domaine.com">
        </div>
        <p class="col-md-4 none ttEmailObg bg-danger">
            Votre email est obligatoire
        </p>
        <p class="col-md-4 none ttEmailInv bg-danger">
            Adresse email invalide
        </p>
        <p class="col-md-4 none ttEmailExists bg-danger">
            Un compte existe déjà pour cette adresse mail. <a>Récupérez votre compte</a>
        </p>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="email">Mot de passe* :</label>
        <div class="col-md-6">
            <input name="pwd" id="formPwd" type="password" class="form-control" placeholder="*******">
        </div>
        <p class="col-md-4 none ttPwdObg bg-danger">
            Votre mot de passe est obligatoire
        </p>
        <p class="col-md-4 none ttPwdInv bg-danger">
            Votre mot de passe est trop cout : il doit contenir au moins 6 caractères
        </p>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="email">Confirmation du mot de passe* :</label>
        <div class="col-md-6">
            <input name="pwdconfirm" id="formPwdConfirm" type="password" class="form-control" placeholder="*******">
        </div>
        <p class="col-md-4 none ttPwdconfObg bg-danger">
            La confirmation du mot de passe est obligatoire
        </p>
        <p class="col-md-4 none ttPwdconfInv bg-danger">
            Les deux mots de passe ne sont pas identiques
        </p>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2" for="email">Adresse :</label>
        <div class="col-md-6">
            <input name="address" id="autocomplete" class="form-control" placeholder="1 bis Avenue de la République" onFocus="geolocate()"></input>
        </div>
    </div>

    <table id="address" class="none">
        <tr>
            <td>
                <input name="streetnumber" id="street_number"></input>
            </td>
            <td>
                <input name="route" id="route"></input>
            </td>
        </tr>
        <tr>
            <td>
                <input name="city" id="locality"></input>
            </td>
        </tr>
        <tr>
            <td>
                <input name="state" id="administrative_area_level_1"></input>
            </td>
            <td>
                <input name="zipcode" id="postal_code"></input>
            </td>
        </tr>
        <tr>
            <td>
                <input name="country" id="country"></input>
            </td>
        </tr>
    </table>

    <?php

    if($_SESSION['type'] == 1) {
        echo '
    <div class="form-group">
					<label class="control-label col-md-3" for="type">Type d\'utilisateur :</label>
					<div class="col-md-9">
						<div class="pull-left">
							<input type="radio" name="usertype" id="admin" value="1" checked>
							Administrateur
						</div><br>
						<div class="pull-left">
							<input type="radio" name="usertype" id="pointRelais" value="2">
							Point Relais **
						</div><br>
						<div class="pull-left">
							<input type="radio" name="usertype" id="livreur" value="3">
							Livreur
                        </div><br>
                        <div class="pull-left">
							<input type="radio" name="usertype" id="client" value="4">
							Client
                        </div>
					</div>

				</div>';

    }
    ?>

</form>