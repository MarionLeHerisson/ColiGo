<?php
require_once("header.php");
?>

<div class="cover-container cover-profile">
    <div class="inner cover">
        <br><br><br>
        <h2>Bonjour <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>, bienvenue sur votre profil.</h2>
        <br><br><br>
    </div>
</div>

<div class="container">

    <div class="col-md-4">
        <h3 class="pull-left">Informations personnelles</h3>

        <div class="col-md-12">
            <label><i class="material-icons icon-left">mail_outline</i>Adresse mail :</label><br>
            <p><?php echo $_SESSION['mail']?></p>
            <input type="button" value="Changer d'adresse mail" onclick="showChangeMail()" class="btn btn-primary">

        </div>

        <div class="col-md-12">
            <label><br><br><br><i class="material-icons icon-left">vpn_key</i>Mot de passe :</label><br>
            <input type="button" value="Changer de mot de passe" onclick="showChangePwd()" class="btn btn-primary">

        </div>

        <div class="col-md-12">
            <label><br><br><br><i class="material-icons icon-left">store</i>Votre point relais favoris :</label>
            <p><?php echo $_SESSION['favRP']['label']; ?></p>
            <p><?php echo $_SESSION['favRP']['address']; ?></p>
            <p><?php echo $_SESSION['favRP']['zip_code'] . ' ' . $_SESSION['favRP']['city']; ?></p>
            <a href="localiser"><input type="button" value="Changer" class="btn btn-primary"></a>
        </div>

        <div class="col-md-12">
            <div id="profil" class="none alert alert-dismissible fade in col-md-12" role="alert">
                <button type="button" class="close" onclick="closePopin()">
                    <span>×</span>
                </button>
                <p id="profilMsg"></p>
            </div>
        </div>

    </div>

    <div class="col-md-8">
        <h3>Historique de vos commandes</h3>
        <?php include_once('blocks/tableHistory.php'); ?>
    </div>

    <?php require_once('blocks/popin/change_mail.php');
    require_once('blocks/popin/change_pwd.php'); ?>
