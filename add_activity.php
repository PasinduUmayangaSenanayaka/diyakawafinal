<?php
// Include database connection
require_once "connection_db.php";

// Get POST data
$category = $_POST['category'];
$name = $_POST['name'];
$code = $_POST['code'];
$localPrice = $_POST['localPrice'];
$description = $_POST['description'];
$discount = $_POST['discount'];

// Validate and sanitize inputs (basic example)
$category = $db->real_escape_string($category);
$name = $db->real_escape_string($name);
$code = $db->real_escape_string($code);
$localPrice = floatval($localPrice);
$description = $db->real_escape_string($description);
$discount = floatval($discount);

// Prepare and execute SQL query
$query = "INSERT INTO main_product (category_id, product_name, code, local_price, discount, description) VALUES ('$category', '$name', '$code', '$localPrice', '$discount', '$description')";

if ($db->query($query) === TRUE) {
    echo "Success";
} else {
    echo "Error: " . $db->error;
}

// Close the database connection
$db->close();
?>
