<?php

session_start();

require "connection_db.php";

if (isset($_POST["currency"])) {
    $currency = $_POST["currency"];

    $today = date("Y-m-d");

    $currency = $db->real_escape_string($currency);

    $queryAdminUser = "SELECT * FROM currency_value WHERE currency = '$currency' AND date = '$today'"; 
    $resultAdminUser = $db->query($queryAdminUser);

    if ($resultAdminUser) {
        if ($resultAdminUser->num_rows > 0) { 
            $rowUser = $resultAdminUser->fetch_assoc();
            echo $rowUser['exchange_rate'];        
        } else {
            echo "No records found.";
        }
    } else {
        echo "Error: " . $db->error;
    }
} else {
    echo "Error: Currency not provided.";
}
