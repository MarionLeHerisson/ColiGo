<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwelve">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                <i class="material-icons">attach_money</i> Accéder à sa rémunération
            </a>
        </h4>
    </div>
    <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
        <div class="panel-body">

            getRemuneration(<?php echo $_SESSION['mail']; ?>);


            <div id="MailEmployeRem" class="none alert alert-dismissible fade in col-md-12" role="alert">
                <button type="button" class="close" onclick="closePopin()">
                    <span>×</span>
                </button>
                <p id="MailEmployeRemMsg"></p>
            </div>
        </div>
    </div>
</div>