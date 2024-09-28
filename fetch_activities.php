<?php
require "connection_db.php";

// Get paging and search parameters from the request
$limit = isset($_POST['length']) ? intval($_POST['length']) : 10; // How many records per page
$start = isset($_POST['start']) ? intval($_POST['start']) : 0; // From which record to start
$search = isset($_POST['search']['value']) ? $_POST['search']['value'] : ''; // Search term

// Query for total records count
$totalQuery = "SELECT COUNT(*) AS total FROM main_product";
$totalResult = $db->query($totalQuery);
$totalRecords = $totalResult ? $totalResult->fetch_assoc()['total'] : 0;

// Base query with JOIN to get category name
$query = "
    SELECT 
        main_product.product_name, 
        main_product.code, 
        main_product.local_price, 
        product_category.category, 
        main_product.main_p_id, 
        main_product.created_date 
    FROM 
        main_product 
    JOIN 
        product_category 
    ON 
        main_product.category_id = product_category.id";

// Apply search filter if a search term is provided
if (!empty($search)) {
    $query .= " WHERE product_name LIKE '%$search%' OR code LIKE '%$search%' OR category LIKE '%$search%'";
}

// Order by selected column and direction
$orderColumnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
$orderDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'ASC';
$orderColumns = ["product_name", "code", "local_price", "category"];
$orderColumn = isset($orderColumns[$orderColumnIndex]) ? $orderColumns[$orderColumnIndex] : $orderColumns[0];
$query .= " ORDER BY $orderColumn $orderDir";

// Add pagination
$query .= " LIMIT $start, $limit";

// Fetch records
$result = $db->query($query);
$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Add action buttons (Edit and Delete)
        $row['action'] = '
            <a href="edit_activity.php?id=' . $row['main_p_id'] . '" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete_activity.php?id=' . $row['main_p_id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>
        ';
        $data[] = $row;
    }
} else {
    die("Error: " . $db->error);
}

// Query for filtered records count
$filteredRecordsQuery = "
    SELECT COUNT(*) AS filtered 
    FROM main_product 
    JOIN product_category ON main_product.category_id = product_category.id";

if (!empty($search)) {
    $filteredRecordsQuery .= " WHERE product_name LIKE '%$search%' OR code LIKE '%$search%' OR category LIKE '%$search%'";
}

$filteredRecordsResult = $db->query($filteredRecordsQuery);
$filteredRecords = $filteredRecordsResult ? $filteredRecordsResult->fetch_assoc()['filtered'] : $totalRecords;

// Return the response in JSON format
$response = [
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $filteredRecords,
    "data" => $data
];

echo json_encode($response);

$db->close();
?>
