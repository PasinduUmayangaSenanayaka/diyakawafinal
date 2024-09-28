<?php
require "connection_db.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$array = [];

if (empty($data["countryName"])) {
    $array["msg"] = "Please Enter Country Name.";
    $array["success"] = false;
} else if (empty($data["countryCode"])) {
    $array["msg"] = "Please Enter Country Code.";
    $array["success"] = false;
} else {

    $queryCountry = "SELECT * FROM country WHERE code = '" . $data["countryCode"] . "' AND country ='" . $data["countryName"] . "'";
    $resultCountry = $db->query($queryCountry);
    if ($resultCountry) {
        if ($resultCountry->num_rows != 0) {

            $array["msg"] = "This Country Already Exists.";
            $array["success"] = false;
        } else {

            $queryCountry = "INSERT INTO country (code, country) VALUES ('" . $data["countryCode"] . "', '" . $data["countryName"] . "')";

            $db->query($queryCountry);

            $array["msg"] = "Country Added Successfully.";
            $array["success"] = true;
        }
    }
}

echo json_encode($array);