<?php
require "connection_db.php";

if (isset($_POST)) {
    $id = $_POST['id'];
    if (empty($id)) {
        echo "Invalide Bill Number, Please try again later.";
    } else {

        $querydb = "SELECT * FROM `billing_tb` WHERE `id` = $id;";
        $resultCategory = $db->query($querydb);

        if ($resultCategory) {

            $row = $resultCategory->fetch_assoc();
            $rowdata = $row['job_no'];

            $query = $db->prepare("DELETE FROM product_listing WHERE job_no = ?");
            $query->bind_param("s", $rowdata);

            if ($query->execute()) {
                $querybill = $db->prepare("DELETE FROM billing_tb WHERE id = ?");
                $querybill->bind_param("i", $id);

                if ($querybill->execute()) {
                    echo "success";
                }
            } else {
                echo "Error deleting row: " . $query->error;
            }

            $query->close();
        }
    }
}
