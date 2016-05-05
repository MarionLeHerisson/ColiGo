<table id="tableSuivi" class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>Date</th>
        <th>Statut</th>
        <th></th>
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