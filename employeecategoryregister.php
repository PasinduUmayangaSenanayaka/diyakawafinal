<?php
session_start();

require "connection_db.php"; 

if (isset($_POST)) {
    $category = $_POST["category"];
    $description = $_POST["description"];
    if (empty($category)) {
        echo "Please enter category.";
    } else if (empty($description)) {
        echo "Please enter category description.";
    } else {

        $queryCategory = "SELECT * FROM employee_category WHERE category = ?";
        $stmt = $db->prepare($queryCategory);

        if ($stmt) {
            $stmt->bind_param("s", $category); 
            $stmt->execute();
            $resultCategory = $stmt->get_result();

            if ($resultCategory->num_rows != 0) {
                echo "This category name is already added.";
            } else {
 
                $insertQuery = "INSERT INTO employee_category (category, description) VALUES (?, ?)";
                $insertStmt = $db->prepare($insertQuery);

                if ($insertStmt) {
                    $insertStmt->bind_param("ss", $category, $description); 
                    if ($insertStmt->execute()) {
                        echo "success";
                    } else {
                        echo "Error adding category: " . $insertStmt->error;
                    }
                } else {
                    echo "Error preparing insert statement: " . $db->error;
                }
            }
        } else {
            echo "Error preparing category check statement: " . $db->error;
        }
    }
}
?>
