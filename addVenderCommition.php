<?php
require "connection_db.php";
if (isset($_POST)) {

    $pid = $_POST['pid'];
    $vender = $_POST['vender'];
    $commissiontype = $_POST['commissiontype'];
    $commission = $_POST['commission'];

    if (empty($pid)) {
        echo "Please select Bill Number for add commition for.";
    } else {
        $query = "SELECT * FROM billing_tb WHERE id = ?";
        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $pid);
            $stmt->execute();
            $resultCategory = $stmt->get_result();

            if ($resultCategory->num_rows != 0) {
                $insertQuery = "INSERT INTO vender_commition (commision_type, commission, billNumber,vender) VALUES (?, ?, ?, ?)";
                $insertStmt = $db->prepare($insertQuery);

                if ($insertStmt) {
                    $status = 1;
                    $insertStmt->bind_param("isii",  $commissiontype, $commission, $pid, $vender );
                    if ($insertStmt->execute()) {
                        echo "success";
                    } else {
                        echo "Error adding employee: " . $insertStmt->error;
                    }
                } else {
                    echo "Error preparing insert statement: " . $db->error;
                }
            } else {
                echo "invalide bill number";
            }
        } else {
            echo "Error preparing employee check statement: " . $db->error;
        }
    }
}
