<?php
include 'connection_db.php';

if (isset($_POST['maincat_id']) && isset($_POST['location']) && isset($_POST['employee']) && isset($_POST['payment_method']) && isset($_POST['amount'])) {
    
    // Sanitize and retrieve data
    $maincat_id = $_POST['maincat_id'];
    $sub_main_id = isset($_POST['sub_main_id']) ? $_POST['sub_main_id'] : NULL;
    $subcat_id = isset($_POST['subcat_id']) ? $_POST['subcat_id'] : NULL;
    $sub_cat1_id = isset($_POST['sub_cat1_id']) ? $_POST['sub_cat1_id'] : NULL;
    $sub_cat2_id = isset($_POST['sub_cat2_id']) ? $_POST['sub_cat2_id'] : NULL;
    $location = $_POST['location'];
    $employee = $_POST['employee'];
    $payment_method = $_POST['payment_method'];
    $amount = $_POST['amount'];

    // Prepare the SQL query
    $sql = "INSERT INTO expense (maincat_id, sub_main_id, subcat_id, sub_cat1_id, sub_cat2_id, location, employee, payment_method, amount, expense_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    // Prepare and bind the statement
    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("iiiiisssd", $maincat_id, $sub_main_id, $subcat_id, $sub_cat1_id, $sub_cat2_id, $location, $employee, $payment_method, $amount);

        // Execute and check if it was successful
        if ($stmt->execute()) {
            echo "Expense added successfully.";
        } else {
            echo "Error executing query: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing query: " . $db->error;
    }

    $db->close();
} else {
    echo "Required fields are missing.";
}
?>
