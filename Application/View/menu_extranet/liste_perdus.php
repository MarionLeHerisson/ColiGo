<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingEight">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                <i class="material-icons">announcement</i> Liste des colis perdus
            </a>
        </h4>
    </div>
    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
        <div class="panel-body">
            <?php
            require_once('../View/blocks/tableLost.php');
            ?>
        </div>
    </div>
</div>