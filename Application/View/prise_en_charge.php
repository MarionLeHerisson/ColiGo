<div class="panel panel-default  <?php if ($_SESSION['type'] == 3 || $_SESSION['type'] == 4) {echo 'none';} ?>">
	<div class="panel-heading" role="tab" id="headingTwo">
		<h4 class="panel-title">
			<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				<i class="material-icons">local_shipping</i> Prise en charge de colis
			</a>
		</h4>
	</div>
	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		<div class="panel-body">

			<div class="col-md-3"></div>
			<div class="form-group col-md-6">
				<label for="idColisPrisEnCharge">Scannez le code-barre du colis pris en charge :</label>
				<input type="text" name="idColisPrisEnCharge" id="idColisPrisEnCharge" class="form-control input-lg">
				<br>
				<button type="button" class="btn btn-primary btn-lg" onclick="updateParcelStatus(2)">Valider</button>
			</div>

				<!-- TODO : verif ajax que le colis n'est pas supprimé, qu'une étape n'a pas été sautée (idem pour livraison/distribution/perdu -->

		</div>
	</div>
</div>