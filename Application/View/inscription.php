<?php
require_once("header.php");
//API KEY : AIzaSyAPuG1oh7adZDZ1E_N5_owPxzz5bhtV4FI
?>

<div class="cover-container cover-form">
	<div class="inner cover">
		<br><br><br>
		<h2>Inscrivez vous afin de bénéficier de nos services.</h2>
		<br><br><br>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-3"></div>

	<form method="POST" action="validation" enctype="multipart/form-data" class="form-horizontal col-md-9" id="inscription-form">

		<div class="form-group">
			<label class="control-label col-md-2" for="email">Prénom* :</label>
			<div class="col-md-6">
				<input name="firstname" id="formFirstname" type="text" class="form-control" placeholder="Catherine">
			</div>
			<p class="col-md-4 none ttFistname bg-danger">
				<!-- TODO : http://getbootstrap.com/css/#forms-control-validation 
					ajouter class has-error en cas d'erreur -->
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

	</form>

	<div class="col-md-3"></div>

	<div class="col-md-6">
		<button type="button" class="btn btn-primary btn-lg" onclick="submitInscForm()">Inscription</button>
		<div class="form-group"><h6>Les champs suivis du symbole * sont obligatoires. Votre email vous servira d'identifiant pour vous connecter, vous ne recevrez aucun spam. Vous pouvez entrer votre adresse postale afin de bénéficier de services plus personnalisés.</h6></div>
	</div>

</div>


<?php
require_once("footer.php");
?>