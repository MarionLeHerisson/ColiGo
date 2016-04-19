<div class="panel panel-default <?php if ($_SESSION['type'] == 3) {echo 'none';} ?>">
	<div class="panel-heading" role="tab" id="headingThree">
		<h4 class="panel-title">
			<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				<i class="material-icons">local_shipping</i> Livraison de colis
			</a>
		</h4>
	</div>
	<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
		<div class="panel-body">

			<div class="col-md-3"></div>
			<div class="form-group col-md-6">
				<label for="idColisLivre">Scannez le code-barre du colis livré en point relais :</label>
				<input type="text" name="idColisLivre" id="idColisLivre" class="form-control input-lg">
				<br>
				<button type="button" class="btn btn-primary btn-lg" onclick="updateParcelStatus(3)">Valider</button>
			</div>

			<div id="ColisLivre" class="none alert alert-dismissible fade in" role="alert">
				<button type="button" class="close" onclick="closePopin()">
					<span>×</span>
				</button>
				<h4>Erreur</h4>
				<p id="ColisLivreMsg"></p>
			</div>
		</div>
	</div>
</div>