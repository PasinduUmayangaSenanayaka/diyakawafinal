<?php
require_once "connection_db.php";

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {

    $stmt = $db->prepare("INSERT INTO operater_commission 
    (operater_id, operater_amount, guide, guide_amount, bill_number, driver, vehical, driver_amount)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($data as $row) {
        $opereter = $row['opereter'];
        $operetervalue = $row['operetervalue'];
        $guide = $row['guide'];
        $guidevalue = $row['guidevalue'];
        $billID = $row['billID'];
        $driver = $row['driver'];
        $vehicalNumber = $row['vehicalNumber'];
        $driveramount = $row['driveramount'];

        $stmt->bind_param('isisiiss', $opereter, $operetervalue, $guide, $guidevalue, $billID, $driver, $vehicalNumber, $driveramount);
        $stmt->execute();
    }

    $stmt->close();
    $db->close();

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
?>

