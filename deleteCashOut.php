<?php
// dbConfig.php should contain your database connection setup
require_once "connection_db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rowId = $_POST['rowId']; // Get the row ID from the AJAX request

    // Prepare and execute the deletion query
    $sql = "DELETE FROM cash_out WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $rowId); // Bind the ID parameter
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Row deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting row.']);
    }
    
    $stmt->close();
}
$db->close();
?>
