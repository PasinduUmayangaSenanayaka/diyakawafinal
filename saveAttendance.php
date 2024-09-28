<?php
require_once "connection_db.php";

// Decode JSON data
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    foreach ($data as $attendance) {
        $employeeId = $attendance['employee_id'];
        $attendanceStatus = $attendance['attendance'];
        $leaveStatus = $attendance['leave_status'];
        date_default_timezone_set('Asia/Colombo');
        $currentDate = date('Y-m-d'); 

        // Check if the employee_id already exists in the attendance table
        $checkQuery = $db->prepare("SELECT COUNT(*) FROM attendance WHERE employee_id = ? AND attendance_date = ?");
        $checkQuery->bind_param('is', $employeeId, $currentDate);
        $checkQuery->execute();
        $checkQuery->bind_result($count);
        $checkQuery->fetch();
        $checkQuery->close();

        if ($count > 0) {
            // If exists, update the existing record
            $updateStmt = $db->prepare("UPDATE attendance SET attendance = ?, leave_status = ? WHERE employee_id = ? AND attendance_date = ?");
            $updateStmt->bind_param('ssis', $attendanceStatus, $leaveStatus, $employeeId, $currentDate);
            $updateStmt->execute();
            $updateStmt->close();
        } else {
            // If doesn't exist, insert a new record
            $insertStmt = $db->prepare("INSERT INTO attendance (employee_id, attendance, leave_status, attendance_date) 
                                        VALUES (?, ?, ?, ?)");
            $insertStmt->bind_param('isss', $employeeId, $attendanceStatus, $leaveStatus, $currentDate);
            $insertStmt->execute();
            $insertStmt->close();
        }
    }

    // Close the database connection
    $db->close();

    // Return success response
    echo json_encode(['status' => 'success']);
} else {
    // Return error response if no data is received
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
?>
