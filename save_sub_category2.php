<?php
// Include database connection
include 'connection_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sc1_id = $_POST['sc1_id'];
    $sub_category2_name = $_POST['sub_category2_name'];

    // Validate input
    if (!empty($sc1_id) && !empty($sub_category2_name)) {
        // Prepare the SQL insert statement
        $sql = "INSERT INTO sub_category2 (sc1_id, sub_category2_name) VALUES (?, ?)";

        if ($stmt = $db->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param('is', $sc1_id, $sub_category2_name);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Sub-category 2 added successfully!";
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
