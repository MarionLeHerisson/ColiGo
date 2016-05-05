<div class="container">
	<div class="col-md-1"></div>

	<div class="col-md-10">

		<h2>Extranet - <?php echo $sessionType; ?></h2>
		<br><br>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			
			<?php

			if ($_SESSION['type'] == 1) {	// Admin
				include_once('menu_extranet/role_utilisateur.php');
				include_once('menu_extranet/ajout_utilisateur.php');
				include_once('menu_extranet/ajout_point_relais.php');
			}
			if ($_SESSION['type'] != 3) {	// Admin or relay point
				include_once('menu_extranet/depot_extranet.php');
				include_once('menu_extranet/prise_en_charge.php');
				include_once('menu_extranet/livraison.php');
				include_once('menu_extranet/distribution.php');
			}
			include_once('menu_extranet/perdu.php');	// Everybody

			?>

		</div>
	</div>

	<div class="col-md-1"></div>
</div>