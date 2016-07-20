<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="headingFour">
		<h4 class="panel-title">
			<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
				<i class="material-icons">local_shipping</i> Distribution de colis
			</a>
		</h4>
	</div>
	<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
		<div class="panel-body">

			<div class="col-md-3"></div>
			<div class="form-group col-md-6">
				<label for="idColisDistribue">Scannez le code-barre du colis distribué au client :</label>
				<input type="text" name="idColisDistribue" id="idColisDistribue" class="form-control input-lg"
					   oninput="updateParcelStatus(4)">
				<br>
				<button type="button" class="btn btn-primary btn-lg" onclick="updateParcelStatus(4)">Valider</button>
			</div>

			<div id="ColisDistribue" class="none alert alert-dismissible fade in col-md-12" role="alert">
				<button type="button" class="close" onclick="closePopin()">
					<span>×</span>
				</button>
				<p id="ColisDistribueMsg"></p>
			</div>
		</div>
	</div>
</div>


<!-- TODO : Colis distribué dans le mauvais point relais -->