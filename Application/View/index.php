<?php

// get actual page name
$exploded = explode('/', $_SERVER['REDIRECT_URL']);
$len = sizeof($exploded) - 1;
$thisPage = $exploded[$len];

// track connection
include_once '/Applications/MAMP/htdocs/ProjAnnuel2016/Application/Controller/accueilController.php';
$controller = new accueilController();
$controller->connectAction();

// include actual page controller (if different from 'accueil')
if($thisPage != 'accueil' && file_exists('/Applications/MAMP/htdocs/ProjAnnuel2016/Application/Controller/' . $thisPage . 'Controller.php')) {
	require_once('/Applications/MAMP/htdocs/ProjAnnuel2016/Application/Controller/' . $thisPage . 'Controller.php');
	// On l'instancie & on lance la première méthode
	$controllerName = $thisPage . 'Controller';
	$controller = new $controllerName;
	$controller->indexAction();
}
else if ($thisPage == 'accueil') {
	$controller->indexAction();
}

// TODO : .htaccess -> redirect° index -> appel controllers -> appels vues

?>