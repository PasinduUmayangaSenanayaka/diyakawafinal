<?php  

require_once "connection_db.php";

// Get the JSON data
$data = json_decode(file_get_contents("php://input"), true);
$date = $data['date'];
$tableData = $data['data'];

// Loop through each currency data and update or insert into the database
foreach ($tableData as $entry) {
    $currency = $entry['currency'];
    $exchangeRate = $entry['exchangeRate'];
    $amount = $entry['amount'];
    $id = $entry['id'] ?? null; // Use the provided ID if exists

    if ($id) {
        // Update existing record
        $stmt = $db->prepare("UPDATE currency_value SET exchange_rate = ?, amount = ? WHERE id = ?");
        $stmt->bind_param("ddi", $exchangeRate, $amount, $id);
    } else {
        // Insert new record
        $stmt = $db->prepare("INSERT INTO currency_value (date, currency, exchange_rate, amount) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdd", $date, $currency, $exchangeRate, $amount);
    }
    
    $stmt->execute();
}

// Return success response
echo json_encode(['success' => true]);
