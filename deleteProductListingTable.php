<?php
require_once "connection_db.php";

if (isset($_POST)) {
    $id = $_POST['id'];
    $query = $db->prepare("DELETE FROM product_listing WHERE id = ?");

    $idToDelete = $id;
    $query->bind_param("i", $idToDelete);

    // Execute the query
    if ($query->execute()) {
        
    } else {
        echo "Error deleting row: " . $query->error;
    }

    $query->close();
}
