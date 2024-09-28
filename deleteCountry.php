<?php
require "connection_db.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$array = [];

if (empty($data["id"])) {
    $array["msg"] = "Oops Something went wrong.";
    $array["success"] = false;
} else {

    $queryCountry = "SELECT * FROM country WHERE id = '" . $data["id"] . "'";
    $resultCountry = $db->query($queryCountry);
    if ($resultCountry) {
        if ($resultCountry->num_rows == 0) {

            $array["msg"] = "Please try again later.";
            $array["success"] = false;
        } else {

            $queryCountry = "DELETE FROM country WHERE id = '" . $data["id"] . "'";


            $db->query($queryCountry);

            $array["msg"] = "Country Deleted Successfully.";
            $array["success"] = true;
        }
    }
}

echo json_encode($array);