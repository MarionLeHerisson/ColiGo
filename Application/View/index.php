<?php
session_start();

require_once('../../library/coligo.php');
require_once('../../const.php');

// connection
if(isset($_POST['comail']) && $_POST['comail'] != '' && isset($_POST['copwd']) && $_POST['copwd'] != '') {

	$mail = ColiGo::sanitizeString($_POST['comail']);
	$pwd = md5($_POST['copwd']);

	// manager
	require_once('../Model/userModel.php');
	$userManager = new UserModel;

	// try to connect user
	$user = $userManager->connexion($mail, $pwd);
	$type = $user['type_id'];

    // if user does not exist
    if(!is_array($user)) {
        echo '<script type="text/javascript">
						document.location.href="accueil";
					</script>';
    }	// else, connect user
	else {
		$_SESSION['id'] = $user['id'];
		$_SESSION['first_name'] = $user['first_name'];
		$_SESSION['last_name'] = $user['last_name'];
		$_SESSION['mail'] = $user['mail'];
		$_SESSION['type'] = $user['type_id'];
		$_SESSION['address'] = $user['address_id'];
	}

    // get his favorite ralay point
    $fav = $userManager->getFavoriteRP($_SESSION['id']);
    if(is_array($fav)) {
        $_SESSION['favRP'] = $fav;
    }

    // if the user works for ColiGo -> redirect him to extranet
	if($type != 4) {
		echo '<script type="text/javascript">
						document.location.href="accueil_extranet";
					</script>';

	}
	else {
		echo '<script type="text/javascript">
						document.location.href="accueil";
					</script>';
	}

    if($type == null) {
        echo '<script type="text/javascript">
						document.location.href="cgu";
					</script>';
    }
}


// get actual page name
$exploded = explode('/', $_SERVER['REDIRECT_URL']);
$len = sizeof($exploded) - 1;
$thisPage = $exploded[$len];

// include actual page controller (if it exists)
if(file_exists(BASE_PATH . 'Application/Controller/' . $thisPage . 'Controller.php')) {

	require_once(BASE_PATH . 'Application/Controller/' . $thisPage . 'Controller.php');

	// Create instace and show index for this page
	$controllerName = $thisPage . 'Controller';
	$controller = new $controllerName;
	$controller->indexAction();
}