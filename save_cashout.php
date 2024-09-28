<?php
require_once "connection_db.php";
ini_set('display_errors', 0);  // Disable error display
ini_set('log_errors', 1);  

if ($db->connect_error) {
    error_log('Database connection error: ' . $db->connect_error);
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit();
}

// Get the JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    date_default_timezone_set('Asia/Colombo');
    $currentDate = date('Y-m-d');

    foreach ($data as $row) {
        $job_no = $row['job_no'];
        $expence = $row['expence'];
        $description = $row['description'];
        $emp_name = $row['emp_name'];
        $amount = $row['amount'];

        // Check if the job_no already exists
        $checkQuery = "SELECT id FROM cash_out WHERE job_no = ?";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bind_param("s", $job_no);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            // If job_no exists, update the existing entry
            $rowId = $checkResult->fetch_assoc()['id']; // Get the existing row ID
            $updateQuery = "UPDATE cash_out 
                            SET purpose_id = ?, description = ?, emp_id = ?, amount = ?
                            WHERE id = ?";
            $updateStmt = $db->prepare($updateQuery);
            $updateStmt->bind_param("ssdss", $expence, $description, $emp_name, $amount,$rowId);

            if (!$updateStmt->execute()) {
                error_log('MySQL update execute error: ' . $updateStmt->error);
                echo json_encode(["success" => false, "message" => "Database update failed."]);
                exit();
            }
        } else {
            // If job_no does not exist, insert a new entry
            $insertQuery = "INSERT INTO cash_out (job_no, purpose_id, description, emp_id, amount, date_cash_out) 
                            VALUES (?, ?, ?, ?, ?, ?)";
            $insertStmt = $db->prepare($insertQuery);
            $insertStmt->bind_param("ssssds", $job_no, $expence, $description, $emp_name, $amount, $currentDate);
            
            if (!$insertStmt->execute()) {
                error_log('MySQL insert execute error: ' . $insertStmt->error);
                echo json_encode(["success" => false, "message" => "Database execution failed."]);
                exit();
            }
        }
    }

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "No data received."]);
}
?>
