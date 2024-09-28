<?php
require "connection_db.php";
if (isset($_POST)) {

    $cid = $_POST['cid'];
    $project = $_POST['project'];
    $location = $_POST['location'];
    $pxg = $_POST['pxg'];
    $tourno = $_POST['tourno'];
    $tourtype = $_POST['tourtype'];
    $billmethod = $_POST['billmethod'];
    $billstatus = $_POST['billstatus'];
    $company = $_POST['company'];
    $vender = $_POST['vender'];
    $operater = $_POST['operater'];
    $billId = $_POST['billId'];
    $date = $_POST['date'];

    if (empty($cid)) {
        echo "Please select Custormer";
    } else {
        $query = "SELECT * FROM billing_tb WHERE job_no = ?";
        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $billId);
            $stmt->execute();
            $resultCategory = $stmt->get_result();

            if ($resultCategory->num_rows != 0) {
                echo "This Bill NO already exists.";
            } else {

                $insertQuery = "INSERT INTO billing_tb (date_billing, project_id, location_id,company_id , 
                operetor_id ,job_no,tour_no,vender_id ,pax_amount,stutas_id,
                payment_method_id ,traverler_typr_id ,costormer_id,status_paid) 
                        VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?,?,?,?)";
                $insertStmt = $db->prepare($insertQuery);

                if ($insertStmt) {
                    $status = 1;
                    $insertStmt->bind_param("siiiissisiiiii",  $date, $project, $location, $company, $operater, $billId,$tourno,$vender,$pxg,$billstatus,$billmethod,$tourtype,$cid,$status);
                    if ($insertStmt->execute()) {
                        echo "success";
                    } else {
                        echo "Error adding employee: " . $insertStmt->error;
                    }
                } else {
                    echo "Error preparing insert statement: " . $db->error;
                }
            }
        } else {
            echo "Error preparing employee check statement: " . $db->error;
        }
    }
}
