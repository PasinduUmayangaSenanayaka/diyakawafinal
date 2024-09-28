<?php
require_once "connection_db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mainId = $_POST['main_id'];
    $subCategory = $_POST['sub_category'];

    // Prepare the SQL statement
    $sql = "INSERT INTO sub_main_ctegory (main_id, sub_categories) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("is", $mainId, $subCategory); // i = integer, s = string

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $db->error]);
    }

    $stmt->close();
    $db->close();
}
?>
