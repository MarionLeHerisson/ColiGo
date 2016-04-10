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
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4>Oh snap! You got an error!</h4>
				<p>Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>
				<p>
					<button type="button" class="btn btn-danger">Take this action</button>
					<button type="button" class="btn btn-default">Or do this</button>
				</p>
			</div>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4>Ok!</h4>
				<p>Tout s'est bien passé haha</p>
			</div>
		</div>
	</div>
</div>