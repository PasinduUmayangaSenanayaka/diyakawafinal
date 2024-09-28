<?php
require "connection_db.php";
// Check if form data is received via POST
if (isset($_POST)) {
    if (empty($_POST['user'])) {
    } elseif (empty($_POST['iconid'])) {
    } else {
        if ($_POST['validation'] == "true") {
            $validation = 1;
        } else {
            $validation = 0;
        }
        $user = $_POST['user'];
        $iconid = $_POST['iconid'];



        $user_asing = $db->query("SELECT * FROM user_assing WHERE `user_type` = $user");

        if ($user_asing) {

            $user_asing_filter = $db->query("SELECT * FROM user_assing WHERE `user_type` = $user AND icon_id =  $iconid");

            if ($user_asing_filter->num_rows != 0) {

                $rowuser_asing_filter = $user_asing_filter->fetch_assoc();
                echo ($rowuser_asing_filter['icon_id']);

                if ($rowuser_asing_filter['icon_id'] == $iconid) {
                    $stmt = $db->prepare("UPDATE `user_assing` SET validate = $validation WHERE `user_type` = $user AND `icon_id` = $iconid");
                    $stmt->execute();
                } else {
                    $stmt = $db->prepare("INSERT INTO user_assing (user_type, icon_id, validate) VALUES ($user, $iconid, $validation)");
                    $stmt->execute();
                }
            } else {
                 $stmt = $db->prepare("INSERT INTO user_assing (user_type, icon_id, validate) VALUES ($user, $iconid, $validation)");
                 $stmt->execute();
            }
        }



        // Close the database connection
        $db->close();
    }
}
