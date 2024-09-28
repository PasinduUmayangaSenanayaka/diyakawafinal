<?php
require_once "connection_db.php";

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {

    $stmt = $db->prepare("INSERT INTO product_listing (job_no, qty, rate, date, currency_name_add_id, product_id, discount) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Statement preparation failed: ' . $db->error]);
        exit;
    }

    foreach ($data as $row) {
        
        $job_no = $row['job_no'];
        $qty = $row['qty'];
        $rate = $row['rate'];
        $date = $row['date'];
        $currency_name_add_id = $row['currency_name_add_id'];
        if(isset($row['product_id'])){ 
            $product = $row['product_id'];
            $password = $db->real_escape_string($product);

            $queryAdminUser = "SELECT * FROM product WHERE `code` = '$password'";
            $resultAdminUser = $db->query($queryAdminUser);
        
            if ($resultAdminUser) {

                if ($resultAdminUser->num_rows != 0) {
                    $rowUser = $resultAdminUser->fetch_assoc();
                    $product_id = $rowUser['id'];                    
                }

            }             
        }
       
        $discount = $row['discount'];

        $stmt->bind_param('ssssiis', $job_no, $qty, $rate, $date, $currency_name_add_id, $product_id, $discount);

        if (!$stmt->execute()) {
            echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
            exit;
        }
    }

    $stmt->close();
    $db->close();

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
?>
