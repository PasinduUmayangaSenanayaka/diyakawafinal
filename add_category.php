<?php
require_once "connection_db.php"; 

// Get the posted data
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['category'])) {
    $category = $db->real_escape_string($data['category']); // Sanitize input

    // Insert category into the product_category table
    $sql = "INSERT INTO product_category (category) VALUES ('$category')";

    if ($db->query($sql) === TRUE) {
        // Success response
        echo json_encode(['success' => true]);
    } else {
        // Error response
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $db->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}

$db->close();
?>
