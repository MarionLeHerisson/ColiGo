<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingSix">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                <i class="material-icons">person</i> Gestion des rôles utilisateurs
            </a>
        </h4>
    </div>
    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
        <div class="panel-body">

            <div class="col-md-3"></div>
            <div class="form-group col-md-6">
                <label for="newRoleMail">Mail de l'utilisateur :</label>
                <!-- TODO : autocomplete en ajax -->
                <input type="text" name="newRoleMail" id="newRoleMail" class="form-control input-lg">
                <br>
                <label for="selectNewRole">Nouveau rôle :</label>
                <select id="selectNewRole">
                    <?php
                    foreach($types as $type) {
                        echo '<option value="' . $type['id'] . '">' . $type['label'] . '</option>';
                    }
                    ?>
                </select>
                <br><br>
                <button type="button" class="btn btn-primary btn-lg" onclick="updateNewRole()">Valider</button>
            </div>
<!-- TODO : ajouter dans clearEverything() -->

            <div id="newRole" class="none alert alert-dismissible fade in col-md-12" role="alert">
                <button type="button" class="close" onclick="closePopin()">
                    <span>×</span>
                </button>
                <p id="newRoleMsg"></p>
            </div>
        </div>
    </div>
</div>