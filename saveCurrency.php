<?php
require_once "connection_db.php"; 

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['data'])) {
    foreach ($data['data'] as $row) {

        $currency = $db->real_escape_string($row['currency']);
        $exchangeRate = $db->real_escape_string($row['exchangeRate']);
        $amount = $db->real_escape_string($row['amount']);
        $date = $db->real_escape_string($row['date']);

        echo "Currency: $currency, Exchange Rate: $exchangeRate, Amount: $amount, Date: $date \n";

        $sql = "INSERT INTO currency_value (currency, exchange_rate, amount, date) 
                VALUES ('$currency', '$exchangeRate', '$amount', '$date')";
        
        if ($db->query($sql) === TRUE) {
            echo "Record added successfully\n";
        } else {
            echo "Error: " . $sql . "\n" . $db->error;
        }
    }
} else {
    echo "No data to save!";
}

$db->close();
?>
