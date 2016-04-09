<?php
require_once('header.php');

// Si l'utilisateur n'a pas l'autorisation d'aller sur cette page
if(!isset($_SESSION['type']) || $_SESSION['type'] == 4) {
	echo '<script type="text/javascript">
				document.location.href="accueil";
			</script>';
}

// Récupération du nom de la page actuelle
$exploded = explode('/', $_SERVER['REDIRECT_URL']);
$len = sizeof($exploded) - 1;
$thisPage = $exploded[$len];

// On inclut le controller correspondant
require_once('/Applications/MAMP/htdocs/ProjAnnuel2016/Application/Controller/' . $thisPage . 'Controller.php');
// On l'instancie & on lance la première méthode
$controllerName = $thisPage . 'Controller';
$controller = new $controllerName;
$controller->indexAction();

// TODO : mettre dans un fichier séparé & éviter répétit° code avec Extrarnet/View/index.php

?>