<?php
require "connection_db.php";
if (isset($_POST)) {

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


    if (empty($billId)) {
        echo "Please select Valide Bill for Update.";
    } else {
        $query = "SELECT * FROM billing_tb WHERE job_no = ?";
        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $billId);
            $stmt->execute();
            $resultCategory = $stmt->get_result();

            if ($resultCategory->num_rows != 0) {

                $updateQuery = "UPDATE billing_tb 
                SET project_id = ?, location_id = ?, company_id = ?, 
                    operetor_id = ?, tour_no = ?, vender_id = ?, pax_amount = ?, 
                    stutas_id = ?, payment_method_id = ?, traverler_typr_id = ?, 
                    status_paid = ? 
                WHERE job_no = ?";


                $updateStmt = $db->prepare($updateQuery);

                if ($updateStmt) {

                    $project = $project;
                    $location = $location;
                    $company = $company;
                    $operater = $operater;
                    $tourno = $tourno;
                    $vender = $vender;
                    $pxg = $pxg;
                    $status = 1;
                    $billmethod = $billmethod;
                    $tourtype = $tourtype;
                    $job_no = $billId;

                    $updateStmt->bind_param("iiiisisiiiis", $project, $location, $company, $operater, $tourno, $vender, $pxg, $billstatus, $billmethod, $tourtype, $status,$job_no);

                    if ($updateStmt->execute()) {
                        echo "Row updated successfully!";
                    } else {
                        echo "Error updating row: " . $updateStmt->error;
                    }
                } else {
                    echo "Error preparing update statement: " . $db->error;
                }

                $updateStmt->close();
            } else {
                echo "Invalide Bill Number, Please Try again later.";
            }
        } else {
            echo "Error preparing employee check statement: " . $db->error;
        }
    }
}
