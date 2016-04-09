<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="headingOne">
		<h4 class="panel-title">
			<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
				Dépôt de colis
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
							<input type="radio" name="type" id="expresse" value="express" checked>
							Livraison à horaires garantis
						</div>
						<div class="pull-left">
							<input type="radio" name="type" id="8h" value="8h">
							Livraison le lendemain à 8h si la commande est passée avant 15h
						</div>
						<div class="pull-left">
							<input type="radio" name="type" id="urgence" value="urgence">
							Livraison d'urgence
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3" for="firstname">Poids du colis :</label>
					<div class="col-md-4">
						<input name="weight" id="weight" type="text" class="form-control" placeholder="">
					</div>
					<p class="col-md-4 none ttLastname bg-danger">
						Poids obligatoire 
					</p>
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
						<input name="address" id="autocomplete" class="autocomplete form-control" placeholder="1 bis Avenue de la République" onFocus="geolocate()">
					</div>
				</div>

				<div class="none">
					<table id="address">
						<input name="streetnumber" id="street_number">
						<input name="route" id="route">
						<input name="city" id="locality">
						<input name="state" id="administrative_area_level_1">
						<input name="zipcode" id="postal_code">
						<input name="country" id="country">
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
						</div><br>
						<div class="pull-left">
							<input type="checkbox" name="samedi" id="samedi" value="6">
							Livraison le samedi (5,00€)
						</div>
					</div>
				</div>

<!--				<div class="form-group">
					<label class="control-label col-md-3" for="type">Veuillez préciser l'adresse de ramassage :</label>
					<div class="col-md-6">
						<input name="address" onfocus="initAutocomplete()" id="autocomplete" class="form-control" placeholder="1 bis Avenue de la République" onFocus="geolocate()">
					</div>
					<div class="">
						<table id="address">
							<input name="streetnumber" id="street_number">
							<input name="route" id="route">
							<input name="city" id="locality">
							<input name="state" id="administrative_area_level_1">
							<input name="zipcode" id="postal_code">
							<input name="country" id="country">
						</table>
					</div>
				</div>-->

				<button type="button" class="btn btn-primary btn-lg" onclick="submitDepotForm()">Valider</button>

			</form>
			<!-- TODO : calcul en temps réel du total + proposer un devis -->
		</div>
	</div>
</div>