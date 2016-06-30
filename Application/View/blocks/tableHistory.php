<table id="tableSuivi" class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>Date</th>
        <th>N° de suivi</th>
        <th>Status</th>
        <th>Adresse de départ</th>
        <th>Destinataire</th>
        <th>Prix</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach($history as $parcel) {
        echo '<tr>
                    <td>' . $parcel['order_date'] . '<br><a>détail</a></td>
                    <td>' . $parcel['tracking_number'] . '</td>
                    <td>' . $parcel['status'] . '<br>' . $parcel['status_date'] . '</td>
                    <td>' . $parcel['dep_name'] . '<br>' . $parcel['dep_address'] . '</td>
                    <td>' . $parcel['arr_name'] . '<br>' . $parcel['arr_address'] . '</td>
                    <td>' . $parcel['total_price'] . '</td>
                </tr>';
    }
/*
 SELECT orders.departure_address, orders.arrival_address, orders.total_price, orders.order_date, orders.ordered_by
,op.order_id, op.parcel_id
,parcel.id, parcel.tracking_number, parcel.status_id AS status,
,tracking.parcel_id, tracking.status_id, tracking.new_status_date AS status_date
,a1.id, a1.address AS dep_address, a1.zip_code, a1.city
,a2.id, a2.address AS arr_address, a2.zip_code, a2.city

FROM orders
LEFT JOIN orderparcel AS op ON op.order_id = orders.id
LEFT JOIN parcel ON p.id = op.parcel_id
LEFT JOIN tracking ON tracking.parcel_id = p.id
LEFT JOIN address AS a1 ON a1.id = orders.departure_address
LEFT JOIN address AS a2 ON a2.id = orders.arrival_address


WHERE tracking.status_id = parcel.status
AND ordered_by = $userId;
 */
    ?>
    </tbody>
</table>