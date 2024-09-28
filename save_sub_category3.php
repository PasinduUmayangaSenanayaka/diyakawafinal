<?php
// Include database connection
include 'connection_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sc2_id = $_POST['sc2_id'];
    $sub_category3_name = $_POST['sub_category3_name'];

    // Validate input
    if (!empty($sc2_id) && !empty($sub_category3_name)) {
        // Prepare the SQL insert statement
        $sql = "INSERT INTO sub_category3 (sc2_id, sub_category3_name) VALUES (?, ?)";

        if ($stmt = $db->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param('is', $sc2_id, $sub_category3_name);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Sub-category 3 added successfully!";
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
