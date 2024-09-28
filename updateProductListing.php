<?php
require_once "connection_db.php";

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    foreach ($data as $row) {
        $id = $row['productlist_id'];  
        $job_no = $row['job_no'];
        $qty = $row['qty'];
        $rate = $row['rate'];
        $discount = $row['discount'];
        $date = $row['date'];
        $currency_name_add_id = $row['currency_name_add_id'];

      

        $checkQuery = "SELECT id FROM product_listing WHERE id = ?";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bind_param('i', $id);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            
            $updateQuery = "UPDATE product_listing 
                            SET qty = ?, rate = ?, currency_name_add_id = ?, discount = ?, date = ? 
                            WHERE id = ?";
            $updateStmt = $db->prepare($updateQuery);
            if ($updateStmt) {
                $updateStmt->bind_param('ssissi', $qty, $rate, $currency_name_add_id, $discount, $date, $id);
                if (!$updateStmt->execute()) {
                    echo json_encode(['status' => 'error', 'message' => 'Update failed: ' . $updateStmt->error]);
                    exit;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to prepare update statement: ' . $db->error]);
                exit;
            }
        } else {
            if (isset($row['product_id'])) {
                $product = $db->real_escape_string($row['product_id']);
                $queryProduct = "SELECT id FROM product WHERE code = '$product'";
                $resultProduct = $db->query($queryProduct);
    
                if ($resultProduct && $resultProduct->num_rows != 0) {
                    $rowProduct = $resultProduct->fetch_assoc();
                    $product_id = $rowProduct['id'];
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Product not found: ' . $product]);
                    exit;
                }
            }

            $insertQuery = "INSERT INTO product_listing (job_no, qty, rate, date, currency_name_add_id, product_id, discount) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $db->prepare($insertQuery);
            if ($insertStmt) {
                $insertStmt->bind_param('ssssiis', $job_no, $qty, $rate, $date, $currency_name_add_id, $product_id, $discount);
                if (!$insertStmt->execute()) {
                    echo json_encode(['status' => 'error', 'message' => 'Insert failed: ' . $insertStmt->error]);
                    exit;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to prepare insert statement: ' . $db->error]);
                exit;
            }
        }
        $checkStmt->close();
    }

    $db->close();
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
?>