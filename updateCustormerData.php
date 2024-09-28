<?php
require "connection_db.php";
if (isset($_POST)) {

    $cid = $_POST['cid'];
    $cmobile = $_POST['cmobile'];
    $cemail = $_POST['cemail'];

    $updateQuery = "UPDATE customer SET costormer_address = ?, costormer_mobile = ? WHERE id = ?";
    $stmt = $db->prepare($updateQuery);

    if ($stmt) {
        $stmt->bind_param(
            "sss",
            $cemail,
            $cmobile,
            $cid,
            
        );

        if ($stmt->execute()) {
        }
    }
}
