<?php
// Include database connection
include 'connection_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sub_main_id = $_POST['sub_main_id'];
    $sub_category_name = $_POST['sub_category_name'];

    // Validate input
    if (!empty($sub_main_id) && !empty($sub_category_name)) {
        // Prepare the SQL insert statement
        $sql = "INSERT INTO sub_category1 (sub_main_id, sub_category_name) VALUES (?, ?)";

        if ($stmt = $db->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param('is', $sub_main_id, $sub_category_name);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Sub-category added successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error: Could not prepare statement.";
        }
    } else {
        echo "Please provide all required fields.";
    }

    // Close database connection
    $db->close();
}
?>
