<?php
// Database connection
require_once "connection_db.php";

$sql = "SELECT id, currencyName FROM currency";
$result = $db->query($sql);

$currencies = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $currencies[] = $row;
    }
}

// Return currencies as JSON
header('Content-Type: application/json');
echo json_encode($currencies);

$db->close();
?>
