<?php

require_once "connection_db.php";

// Fetch the latest `activity_id` from the `main_product` table
$query = "SELECT main_p_id FROM main_product ORDER BY main_p_id DESC LIMIT 1";
$result = $db->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $activity_id = $row['main_p_id']; 
} else {
    die("No activity found in the `main_product` table.");
}

// Check if form data is provided
if (isset($_POST['currency']) && isset($_POST['amount'])) {
   
    $currencies = $_POST['currency']; 
    $amounts = $_POST['amount'];     
    
    foreach ($currencies as $index => $currency) {
        $amount = $amounts[$index];

        // Check if a record with the same `activity_id` and `currency_type` already exists
        $checkQuery = $db->prepare("SELECT ap_id FROM activity_price WHERE activity_id = ? AND currency_type = ?");
        $checkQuery->bind_param("ii", $activity_id, $currency);
        $checkQuery->execute();
        $checkQuery->store_result();

        if ($checkQuery->num_rows > 0) {
            // If exists, update the `amount`
            $updateStmt = $db->prepare("UPDATE activity_price SET amount = ? WHERE activity_id = ? AND currency_type = ?");
            $updateStmt->bind_param("dii", $amount, $activity_id, $currency);
            
            if ($updateStmt->execute()) {
                echo "Amount for activity is updated successfully.";
            } else {
                echo "Error updating amount: " . $updateStmt->error . "<br>";
            }

            $updateStmt->close();
        } else {
            // If not exists, insert a new record
            $insertStmt = $db->prepare("INSERT INTO activity_price (amount, currency_type, activity_id) VALUES (?, ?, ?)");
            $insertStmt->bind_param("dii", $amount, $currency, $activity_id);

            if ($insertStmt->execute()) {
                echo "New price for this activity added successfully.";
            } else {
                echo "Error inserting new price: " . $insertStmt->error . "<br>";
            }

            $insertStmt->close();
        }

        $checkQuery->close();
    }

} else {
    echo "No data to insert.";
}

$db->close();
?>
