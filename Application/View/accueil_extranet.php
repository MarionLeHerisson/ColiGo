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
				include_once('menu_extranet/employeeRemuneration.php');
				include_once('menu_extranet/generer_remunerations.php');
			}
			if ($_SESSION['type'] != 3) {	// Admin or relay point
				include_once('menu_extranet/depot_extranet.php');
				include_once('menu_extranet/prise_en_charge.php');
				include_once('menu_extranet/livraison.php');
				include_once('menu_extranet/distribution.php');
			}
			include_once('menu_extranet/perdu.php');	// Admin, Relay Point or Postman

			if($_SESSION['type'] != 1) {	// Relay point or Postman
				include_once('menu_extranet/remuneration.php');
			}

            include_once('blocks/scrollButton.php');

			?>

		</div>
	</div>

	<div class="col-md-1"></div>
    <script type="text/javascript" src="www/js/extranet.js"></script>
</div>