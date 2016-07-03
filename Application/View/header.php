<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">

		<meta name="description" content="Premier service de livraison en France">
		<meta name="author" content="Hurteau-Ouriet">
		<link rel="icon" href="Medias/logo.png">

		<title>ColiGo - Premier service de livraison en France</title>

		<!-- Bootstrap core CSS -->
		<link href="www/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="www/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">

		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:300italic,400italic,500,500italic,700,700italic,100,100italic,900,900italic,400,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- ColiGo's css -->
		<link href="www/css/style.css" rel="stylesheet" type="text/css">

		<script src="www/js/jquery-1.12.2.min.js"></script>
		<script src="www/js/bootstrap.min.js"></script>
		<script src="www/js/functions.js"></script>
		<script src="www/js/googleMapsAutocomplete.js"></script>
		<script src="www/js/json2.js"></script>
	</head>

	<body>
		<nav class="class=navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="accueil"><img src="Medias/logo-name.png" width="100px"></a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="accueil">Accueil</a></li>
						<li><a href="cgu">À propos</a></li>
						<li><a href="contact">Contact</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if(!isset($_SESSION['type'])) {
							echo '
							<li>
								<a href="inscription">Inscription</a>
							</li>
							<li class="dropdown">
								<a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Connexion <span class="caret"></span> </a>

								<ul class="dropdown-menu" aria-labelledby="drop1">
									<form method="POST" action="accueil" id="conectForm">
										<li><input id="comail" type="text" name="comail" placeholder="Adresse e-mail"></li>
										<li><input id="copwd" type="password" name="copwd" placeholder="Mot de passe"></li>
										<li role="separator" class="divider"></li>
										<li><a href="#" onclick="showForgotPwdPopin()">Identifiants oubliés ?</a></li>
										<li role="separator" class="divider"></li>
										<li><input type="submit" class="btn btn-connect" value="Connexion"></li>
									</form>
								</ul>
							</li>';
						} else {
							if($_SESSION['type'] != 4) {
								echo '
								<li>
									<a href="accueil_extranet">Extranet</a>
								</li>';
							}
							echo'
							<li>
								<a href="profil">Profil</a>
							</li>
							<li>
								<a href="deconnexion">Déconnexion</a>
							</li>';
						}?>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>
		<?php include_once('blocks/popin/forgot_pwd.php') ?>