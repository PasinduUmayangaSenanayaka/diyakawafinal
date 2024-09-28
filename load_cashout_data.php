<?php
require_once "connection_db.php";

if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    
    
    $query = "SELECT cash_out.id, cash_out.job_no, cash_out.description, cash_out.date_cash_out, cash_out.amount, expence_purpose.purpose FROM cash_out JOIN expence_purpose ON cash_out.purpose_id = expence_purpose.expence_id WHERE cash_out.date_cash_out = ?";
    
    if ($stmt = $db->prepare($query)) {
        $stmt->bind_param("s", $selectedDate);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
        $stmt->close();
    }
}

$db->close();
?>
