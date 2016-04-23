<div class="panel panel-default <?php if ($_SESSION['type'] == 3) {echo 'none';} ?>">
	<div class="panel-heading" role="tab" id="headingOne">
		<h4 class="panel-title">
			<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
				<i class="material-icons">local_shipping</i> Dépôt de colis
			</a>
		</h4>
	</div>
	<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		<div class="panel-body">

			<div class="col-md-1"></div>
			<form method="POST" action="accueil_extranet" enctype="multipart/form-data" class="form-horizontal col-md-10" id="depot-form">

				<br><h4>Informations client :</h4>
				<div class="form-group">
					<label class="control-label col-md-3" for="name">Nom :</label>
					<div class="col-md-6">
						<input name="name" id="name" type="text" class="form-control" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="firstname">Prenom :</label>
					<div class="col-md-6">
						<input name="firstname" id="firstname" type="text" class="form-control" placeholder="">
					</div>
					<p class="col-md-4 none ttLastname bg-danger">
						Prénom obligatoire 
					</p>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="firstname">Adresse mail :</label>
					<div class="col-md-6">
						<input name="mail" id="mail" type="email" class="form-control" placeholder="">
					</div>
					<p class="col-md-4 none ttLastname bg-danger">
						Adresse mail obligatoire 
					</p>
				</div>

				<br><h4>Informations colis :</h4>
				<div class="form-group"> 
					<label class="control-label col-md-3" for="type">Type de livraison :</label>
					<div class="col-md-9">
						<div class="pull-left">
							<input type="radio" name="type" id="expresse" value="2" checked>
							Livraison à horaires garantis
						</div>
						<div class="pull-left">
							<input type="radio" name="type" id="8h" value="1">
							Livraison le lendemain à 8h si la commande est passée avant 15h
						</div>
						<div class="pull-left">
							<input type="radio" name="type" id="urgence" value="3">
							Livraison d'urgence
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="firstname">Poids du colis :</label>
					<div class="col-md-4">
						<input name="weight" id="weight" type="text" class="form-control" placeholder="00.00"><p>kg</p>
					</div>
					<p class="col-md-4 none ttLastname bg-danger">
						Poids obligatoire 
					</p>
					<!-- TODO : Verif point ou virgule, puis js qui transforme virgule en point, retire -->
				</div>

				<br><h4>Services supplémentaires :</h4>
				<div class="form-group"> 
					<label class="control-label col-md-3" for="emballage">Type d'emballage :</label>
					<div class="col-md-9">
						<div class="pull-left">
							<input type="radio" name="emballage" id="craft" value="3">
							Papier craft (0,20€)
						</div><br>
						<div class="pull-left">
							<input type="radio" name="emballage" id="soie" value="2">
							Papier de soie (0,40€)
						</div><br>
						<div class="pull-left">
							<input type="radio" name="emballage" id="bulles" value="1">
							Papier bulles (0,60€)
						</div><br>
						<div class="pull-left">
							<input type="radio" name="emballage" id="poly" value="4">
							Particules de calage en polystirène (0,30€)
							<!-- TODO : Faire les prix en get -->
						</div><br>
						<div class="pull-left">
							<input type="radio" name="emballage" id="none" value="none" checked>
							Aucun
						</div>
					</div>
				</div>

				<br><h4>Informations destinataire :</h4>
				<div class="form-group">
					<label class="control-label col-md-3" for="name">Nom :</label>
					<div class="col-md-6">
						<input name="destname" id="destname" type="text" class="form-control" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="firstname">Prenom :</label>
					<div class="col-md-6">
						<input name="destfirstname" id="destfirstname" type="text" class="form-control" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="email">Adresse de livraison :</label>
					<div class="col-md-6">
						<input name="address" id="autocomplete2" class="autocomplete form-control" placeholder="1 bis Avenue de la République" onFocus="geolocate()">
					</div>
				</div>

				<div class="none">
					<table id="address">
						<input name="streetnumber" id="street_number2">
						<input name="route" id="route2">
						<input name="city" id="locality2">
						<input name="zipcode" id="postal_code2">
						<input name="country" id="country2">
					</table>
				</div>

				<div class="form-group"> 
					<label class="control-label col-md-3" for="type">Assurances :</label>
					<div class="col-md-9">
						<div class="pull-left">
							<input type="checkbox" name="prioritaire" id="prioritaire" value="7">
							Colis prioritaire (10,00€)
						</div><br>
						<div class="pull-left">
							<input type="checkbox" name="imprevu" id="imprevu" value="8">
							Colis livré par tous les moyens en cas d'imprévu (37,00€)
						</div><br>
						<div class="pull-left">
							<input type="checkbox" name="indemnisation" id="indemnisation" value="9">
							Indemnisation en cas de perte ou d'avarie (19,00€/kg)
						</div>
					</div>
				</div>

				<div class="form-group"> 
					<label class="control-label col-md-3" for="type">Autres services :</label>
					<div class="col-md-9">
						<div class="pull-left">
							<input type="checkbox" name="ramassage" id="ramassage" value="5">
							Ramassage au domicile ou sur un lieu de travail (8,00€)
							<!-- TODO : if checked, show adresse ramassage -->
						</div><br>
						<div class="pull-left">
							<input type="checkbox" name="samedi" id="samedi" value="6">
							Livraison le samedi (5,00€)
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="type">Veuillez préciser l'adresse de ramassage :</label>
					<div class="col-md-6">
						<input name="takingAddress" id="autocomplete3" class="autocomplete form-control" placeholder="1 bis Avenue de la République" onFocus="geolocate()">
					</div>
					<div class="none">
						<table id="address">
							<input name="streetnumber" id="street_number3">
							<input name="route" id="route3">
							<input name="city" id="locality3">
							<input name="zipcode" id="postal_code3">
							<input name="country" id="country3">
						</table>
					</div>
				</div>

				<button type="button" class="btn btn-primary btn-lg" onclick="submitDepotForm()">Valider</button>

			</form>
			<!-- TODO : calcul en temps réel du total + proposer un devis -->
		</div>
	</div>
</div>