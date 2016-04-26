<?php
require_once("header.php");
?>

<div class="cover-container cover-contact">
    <div class="inner cover">
        <br><br><br>
        <h2>Nous contacter</h2>
        <br><br><br>
    </div>
</div>

<div class="container">
    <div class="col-md-12">
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="form-group col-md-6">
                <label for="contactName" class="pull-left">Votre nom :</label>
                <input type="email" class="form-control" id="contactName" placeholder="Luke Skywalker">
            </div>
            <div class="form-group col-md-6">
                <label for="contactMail" class="pull-left">Votre adresse mail :</label>
                <input type="email" class="form-control" id="contactMail" placeholder="exemple@domaine.com">
            </div>
            <div class="form-group col-md-12">
                <label for="contactSubject" class="pull-left">Le sujet de votre message :</label>
                <input type="email" class="form-control" id="contactSubject" placeholder="A propos de ...">
            </div>
            <div class="form-group col-md-12">
                <label for="contactMessage" class="pull-left">Votre message :</label>
                <textarea class="form-control" id="contactMessage" placeholder="..." rows="5"></textarea>
            </div>

            <button type="button" class="btn btn-primary btn-lg" onclick="sendMessage()">Envoyer</button>

            <br><br>
            <div id="sendMessage" class="none alert alert-dismissible fade in col-md-12" role="alert">
                <button type="button" class="close" onclick="closePopin()">
                    <span>×</span>
                </button>
                <p id="sendMessageMsg"></p>
            </div>
        </div>

        <div class="col-md-2"></div>
    </div>