<?php
session_start();

require "connection_db.php";

if (isset($_POST)) {

  $id = $_POST["custormerId"];
  $name = $_POST["custoermerName"];
  $mobile = $_POST["custoermerMobile"];
  $address = $_POST["custoermerAddress"];
  $country = $_POST["custormerCountry"];
  $contactby = $_POST["custoermerCountactBy"];
  $category = $_POST["custormerCategory"];
  $subcategory = $_POST["custormerSubCategory"];
  $company = $_POST["company"];
  $currency = $_POST["currency"];

  // Input validations
  if (empty($id)) {
    echo "Invalid Custormer ID.";
  } else if (empty($name)) {
    echo "Please enter custormer name.";
  }  else if (empty($mobile)) {
    echo "Please enter custormer mobile number.";
  } else if (empty($address)) {
    echo "Please enter custormer address.";
  } else if ($country == 0) {
    echo "Please select custormer country.";
  }else if (empty($contactby)) {
    echo "Please enter contact by person name.";
  } else if ($category == 0) {
    echo "Please select custormer category.";
  } else if ($subcategory == 0) {
    echo "Please select custormer sub category.";
  } else if ($company == 0) {
    echo "Please select company Of custormer.";
  } else if ($currency == 0) {
    echo "Please select currency Of custormer.";
  } else {
    $queryCategory = "SELECT * FROM customer WHERE code = ?";
    $stmt = $db->prepare($queryCategory);

    if ($stmt) {
      $stmt->bind_param("s", $id); 
      $stmt->execute();
      $resultCategory = $stmt->get_result();

      if ($resultCategory->num_rows != 0) {
        echo "This custormer ID already exists.";
      } else {

        $insertQuery = "INSERT INTO customer (code, customer, company_name, currency, customer_category, customer_sub_category, custormer_contact_by,costormer_address,costormer_mobile,custormer_country) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $db->prepare($insertQuery);

        if ($insertStmt) { 
          $insertStmt->bind_param("ssiiiisssi",  $id, $name, $company, $currency, $category, $subcategory,$contactby,$address,$mobile,$country);
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
