<?php
require_once "connection_db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!empty($data)) {

        $sql = "INSERT INTO vender_commition (vender,commission, billNumber,commision_type)
                VALUES (:vendorCommission, :commission, :billNumber, :paymentmethod)";
        $stmt = $conn->prepare($sql);

        foreach ($data as $row) {
            $stmt->bindParam(':vendorCommission', $row['vendorCommission']);
            $stmt->bindParam(':commission', $row['commission']);
            $stmt->bindParam(':billNumber', $_POST['paidDetails']);
            $stmt->bindParam(':paymentmethod', $row['paymentmethod']);

            $stmt->execute();
        }

        echo "Data inserted successfully!";
    } else {
        echo "No data to insert!";
    }
} else {
    echo "Invalid request method!";
}