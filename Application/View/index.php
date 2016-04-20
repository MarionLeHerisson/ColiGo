<?php
session_start();

require_once('../../library/coligo.php');

// connection
if(isset($_POST['comail']) && $_POST['comail'] != '' && isset($_POST['copwd']) && $_POST['copwd'] != '') {

	$mail = ColiGo::sanitizeString($_POST['comail']);
	$pwd = md5($_POST['copwd']);

	// manager
	require_once('../Model/userModel.php');
	$userManager = new UserModel;

	// connect user
	$type = $userManager->connexion($mail, $pwd);

	// if the user works for ColiGo -> redirect him to extranet
	if($type != 4) {

		// TODO : "clean" redirection ?

		echo '<script type="text/javascript">
						document.location.href="accueil_extranet";
					</script>';

	}
	else {
		echo '<script type="text/javascript">
						document.location.href="accueil";
					</script>';
	} // TODO : if $type = null -> msg erreur
}


// get actual page name
$exploded = explode('/', $_SERVER['REDIRECT_URL']);
$len = sizeof($exploded) - 1;
$thisPage = $exploded[$len];

// include actual page controller (if it exists)
if(file_exists('/Applications/MAMP/htdocs/ProjAnnuel2016/Application/Controller/' . $thisPage . 'Controller.php')) {

	require_once('/Applications/MAMP/htdocs/ProjAnnuel2016/Application/Controller/' . $thisPage . 'Controller.php');

	// Create instace and show index for this page
	$controllerName = $thisPage . 'Controller';
	$controller = new $controllerName;
	$controller->indexAction();
}