<?php
// Include database connection
require_once "connection_db.php";

// Check if the 'id' is set in the POST request
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the query to delete the row
    $query = "DELETE FROM currency_value WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    // Close the statement and the connection
    $stmt->close();
    $db->close();
} else {
    echo "Invalid request.";
}
?>
