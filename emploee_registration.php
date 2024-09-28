<?php
session_start();

require "connection_db.php";

if (isset($_POST)) {

  $employeeid = $_POST["employeeid"];
  $employeefirstname = $_POST["employeefirstname"];
  $employeelastname = $_POST["employeelastname"];
  $employeenic = $_POST["employeenic"];
  $mobile = $_POST["mobile"];
  $category = $_POST["category"];

  // Input validations
  if (empty($employeeid)) {
    echo "Invalid employee ID.";
  } else if (empty($employeefirstname)) {
    echo "Please enter employee first name.";
  } else if (empty($employeelastname)) {
    echo "Please enter employee last name.";
  } else if (empty($employeenic)) {
    echo "Please enter employee NIC.";
  } else if (empty($mobile)) {
    echo "Please enter employee mobile number.";
  } else if ($category == 0) {
    echo "Please select category.";
  } else {
    $queryCategory = "SELECT * FROM employee_data WHERE employye_id = ?";
    $stmt = $db->prepare($queryCategory);

    if ($stmt) {
      $stmt->bind_param("s", $employeeid); 
      $stmt->execute();
      $resultCategory = $stmt->get_result();

      if ($resultCategory->num_rows != 0) {
        echo "This employee ID already exists.";
      } else {

        $insertQuery = "INSERT INTO employee_data (first_name, last_name, employye_id, status, mobile, nic, category_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $db->prepare($insertQuery);

        if ($insertStmt) {
          $status = 1; 
          $insertStmt->bind_param("sssssss",  $employeefirstname, $employeelastname, $employeeid, $status, $mobile, $employeenic, $category);
          if ($insertStmt->execute()) {
            echo "success";
          } else {
            echo "Error adding employee: " . $insertStmt->error;
          }
        } else {
          echo "Error preparing insert statement: " . $db->error;
        }
      }
    } else {
      echo "Error preparing employee check statement: " . $db->error;
    }
  }
}
?>
