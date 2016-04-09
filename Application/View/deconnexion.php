<?php
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
?>

    <script src="www/js/jquery-1.12.2.min.js"></script>
    <script src="www/js/functions.js"></script>

    <div onload="redirectHome()"></div>

<?php
require_once('footer.php');