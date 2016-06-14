<div class="form-group">
    <label class="control-label col-md-3" for="cb_owner">Nom du propriétaire de la carte :</label>
    <div class="col-md-6">
        <input name="cb_owner" id="cb_owner" type="text" class="form-control" placeholder="Marie Martin">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="cb_number">Numéro de carte :</label>
    <div class="col-md-6">
        <input name="cb_number" id="cb_number" type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Date d'expiration :</label>
    <div class="col-md-1">Mois</div>
    <div class="col-md-2">
        <select class="form-control" id="cb_select_month">
            <?php
            for($i = 1; $i < 12; $i++) {
                echo '<option>' . $i . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="col-md-1">Année</div>
    <div class="col-md-2">
        <select class="form-control" id="cb_select_year">
            <?php
            for($i = ColiGo::getYear(); $i < ColiGo::getYear() + 5; $i++) {
                echo '<option>' . $i . '</option>';
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3" for="name">Cryptogramme visuel : </label>
    <div class="col-md-2">
        <input name="destname" id="destname" type="text" class="form-control" placeholder="XXX">
    </div>
</div>
