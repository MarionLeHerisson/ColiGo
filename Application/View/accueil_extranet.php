<?php
//require_once('header.php');

$sessionType = '';

switch($_SESSION['type']) {
	case 1: $sessionType = 'Administrateur';
		break;
	case 2: $sessionType = 'Point Relais';
		break;
	case 3: $sessionType = 'Livreur';
		break;
	default : echo '<script type="text/javascript">document.location.href="accueil";</script>';
}
?>
<div class="container">
	<div class="col-md-1"></div>

	<div class="col-md-10">

		<h2>Extranet - <?php echo $sessionType; ?></h2>
		<br><br>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			
			<?php

			include_once('role_utilisateur.php');
			include_once('ajout_utilisateur.php');
			include_once('depot.php');
			include_once('prise_en_charge.php');
			include_once('livraison.php');
			include_once('distribution.php');
			include_once('perdu.php');
			include_once('');

			?>

			

			
			
			

		</div>
	</div>

	<div class="col-md-1"></div>
</div>