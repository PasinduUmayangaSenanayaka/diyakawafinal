<?php

require_once "connection_db.php";

if ($_POST) {
    $pid = $_POST['pid'];

    if (empty($data["pid"])) {

        $query = "
        SELECT pl.qty, pl.rate, pl.discount
        FROM billing_tb b
        INNER JOIN product_listing pl ON b.job_no = pl.job_no
        WHERE b.id = $pid;
    ";

        $result = $db->query($query);

        if ($result) {
            $total = 0;

            if ($result->num_rows > 0) {

                while ($rowp = $result->fetch_assoc()) {
                    $qty = $rowp['qty'];
                    $rate = $rowp['rate'];
                    $discount = $rowp['discount'];

                    $value = $qty * $rate;
                    $total += ($value - ($value * $discount / 100));
                }

                echo $total;
            } else {
                echo "No products found for the given bill number.";
            }
        } else {
            echo "Error executing query: " . $db->error;
        }
    }
}
