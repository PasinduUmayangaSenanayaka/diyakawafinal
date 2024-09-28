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



        $user_asing = $db->query("SELECT * FROM sidebar_acsses WHERE `user_id` = $user");

        if ($user_asing) {

            $user_asing_filter = $db->query("SELECT * FROM sidebar_acsses WHERE `user_id` = $user AND slidebar_id =  $iconid");

            if ($user_asing_filter->num_rows != 0) {

                $rowuser_asing_filter = $user_asing_filter->fetch_assoc();
                echo ($rowuser_asing_filter['slidebar_id']);

                if ($rowuser_asing_filter['slidebar_id'] == $iconid) {
                    $stmt = $db->prepare("UPDATE `sidebar_acsses` SET validation = $validation WHERE `user_id` = $user AND `slidebar_id` = $iconid");
                    $stmt->execute();
                } else {
                    $stmt = $db->prepare("INSERT INTO sidebar_acsses (user_id, slidebar_id, validation) VALUES ($user, $iconid, $validation)");
                    $stmt->execute();
                }
            } else {
                $stmt = $db->prepare("INSERT INTO sidebar_acsses (user_id, slidebar_id, validation) VALUES ($user, $iconid, $validation)");
                $stmt->execute();
            }
        } else {
            echo "Invalide user";
        }



        // Close the database connection
        $db->close();
    }
}
