<?php
require_once "connection_db.php";

// Check for connection error
if ($db->connect_error) {
    error_log("Connection failed: " . $db->connect_error);
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

// Retrieve the data sent from the frontend
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    // Log the received data
    error_log("Data received: " . json_encode($data));

    // Prepare the SQL statement
    $stmt = $db->prepare("INSERT INTO cash_out (job_no, description, date_cash_out, emp_id, amount, purpose_id) VALUES (?, ?, ?, ?, ?, ?)");

    // Loop through the data and bind parameters for each row
    foreach ($data as $row) {
        $job_no = $row['job_no'];
        $description = !empty($row['description']) ? $row['description'] : NULL;  // Allow null
        $date_cash_out = $row['date_cash_out'];
        $emp_id = $row['emp_id'];
        $amount = $row['amount'];
        $purpose_id = $row['purpose_id'];

        // Bind parameters: 'sssidd' (string, string, string, integer, double, integer)
        $stmt->bind_param('sssidi', $job_no, $description, $date_cash_out, $emp_id, $amount, $purpose_id);

        // Execute the statement and log any errors
        if (!$stmt->execute()) {
            error_log("Insert failed: " . $stmt->error);
            echo json_encode(['status' => 'error', 'message' => 'Insert failed: ' . $stmt->error]);
            exit;
        }
    }

    // Close the statement and database connection
    $stmt->close();
    $db->close();

    // Send success response
    echo json_encode(['status' => 'success']);
} else {
    error_log("No data received");
    // If no data is received, send an error response
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
?>
