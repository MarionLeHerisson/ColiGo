<div class="container">
    <div class="col-md-10">
        <table id="tableSuivi" class="table table-striped table-responsive">
            <thead>
                <tr>
                    <td>Date</td>
                    <td>Statut</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            <?php

            foreach($trackingStates as $tracking) {

                if($tracking['label'] == 'distribution') {
                    $class = ' class="success"';
                }
                else if($tracking['label'] == 'perdu') {
                    $class = ' class="danger"';
                }

                echo '<tr' . $class . '>
                        <td>' . $tracking['new_status_date'] . '</td>
                        <td>' . $tracking['label'] . '</td>
                        <td>' . $tracking['description'] . '</td>
                    </tr>';
            }
            ?>
            </tbody>
        </table>
    </div>


<?php
// TODO : add class success when the parcel is delivered