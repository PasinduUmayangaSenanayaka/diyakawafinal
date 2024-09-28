<?php
// Include database connection
require_once "connection_db.php"; 

header('Content-Type: application/json');

// Check if the database connection was successful
if ($db->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $db->connect_error]);
    exit();
}

$query = "SELECT id, category FROM product_category";
$result = $db->query($query);

if (!$result) {
    echo json_encode(['status' => 'error', 'message' => 'Query failed: ' . $db->error]);
    exit();
}

$categories = array();
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

echo json_encode($categories);

$db->close();
?>
