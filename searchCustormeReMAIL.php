<?php
session_start();

require "connection_db.php";

if (isset($_POST)) {

    $id = $_POST["mobile"];
    $queryCategory = "SELECT * FROM customer WHERE id = ?";
    $stmt = $db->prepare($queryCategory);

    if ($stmt) {
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $resultCategory = $stmt->get_result();
        if ($resultCategory->num_rows != 0) {
            $data = $resultCategory->fetch_assoc();
            echo $data['costormer_address'];
        }
    }
}
