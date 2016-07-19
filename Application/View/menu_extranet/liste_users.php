<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingSeven">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                <i class="material-icons">group</i> Liste des utilisateurs
            </a>
        </h4>
    </div>
    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
        <div class="panel-body">
            <?php
            require_once('../View/blocks/tableUsers.php');
            ?>
        </div>
    </div>
</div>