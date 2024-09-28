<?php
// Database connection
require_once "connection_db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging: Log the received data
    error_log('POST Data: ' . print_r($_POST, true));

    $categoryName = $_POST['category_name'];

    // Debugging: Log the extracted category name
    error_log('Category Name: ' . $categoryName);

    // Insert into the database
    $sql = "INSERT INTO main_categories (main_category) VALUES (?)"; // Correct SQL
    $stmt = $db->prepare($sql);

    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => $db->error]);
        exit;
    }

    $stmt->bind_param("s", $categoryName);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $db->error]);
    }

    $stmt->close();
}
$db->close();
?>
