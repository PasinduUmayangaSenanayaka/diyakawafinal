<?php

require "connection_db.php";

if(isset($_POST)){

    $id = $_POST['id'];

    $queryun = "SELECT * FROM billing_tb WHERE id = ?";
    $stmtun = $db->prepare($queryun);

    if ($stmtun) {        
        $stmtun->bind_param("i", $id);
        $stmtun->execute();
        $resultun = $stmtun->get_result();
        if($resultun->num_rows != 0){
            $unpaidrow = $resultun->fetch_assoc();
            echo $unpaidrow['job_no'];
        }
    }


}
?>