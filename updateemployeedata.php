<?php
session_start();

require "connection_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST)) {

        $id = $_POST["id"];
        $fisrtname = $_POST['fisrtname'];
        $lastname = $_POST['lastname'];
        $mobile = $_POST['mobile'];
        $category = $_POST['category'];
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];
        $marital = $_POST['marital'];
        $address = $_POST['address'];
        $basic = $_POST['basic'];
        $paymentmethod = $_POST['paymentmethod'];
        $epf = $_POST['epf'];
        $bank = $_POST['bank'];
        $branch = $_POST['branch'];
        $account = $_POST['account'];

        if (empty($id)) {
            echo "Invalide Employee.";
        } else if (empty($fisrtname)) {
            echo "Please enter employee first name.";
        } else if (empty($lastname)) {
            echo "Please enter employee last name.";
        } else if (empty($mobile)) {
            echo "Please enter employee mobile number.";
        } else if ($category == 0) {
            echo "Please select employee category.";
        } else if (empty($email)) {
            echo "Please enter employee email.";
        } else if (empty($birthday)) {
            echo "Please enter employee birthday.";
        } else if ($gender == 0) {
            echo "Please select employee gender.";
        } else if ($marital == 0) {
            echo "Please select employee marital status.";
        } else if (empty($address)) {
            echo "Please enter employee address.";
        } else if (empty($basic)) {
            echo "Please enter employee basic salary.";
        } else if ($paymentmethod == 0) {
            echo "Please enter employee payment method.";
        } else if (empty($epf)) {
            echo "Please enter employee EPF no.";
        } else if (empty($bank)) {
            echo "Please enter employee bank name.";
        } else if (empty($branch)) {
            echo "Please enter employee branch name.";
        } else if (empty($account)) {
            echo "Please enter employee account number.";
        } else {

            // $queryCategory = "SELECT * FROM employee_data WHERE employye_id = ?";
            // $stmt = $db->prepare($queryCategory);

            // if ($stmt) {
            //     $stmt->bind_param("s", $employeeid);
            //     $stmt->execute();
            //     $resultCategory = $stmt->get_result();

            //     if ($resultCategory->num_rows != 0) {
            //         echo "This employee ID already exists.";
            //     } else {

            //         $insertQuery = "UPDATE employee_data SET first_name = $fisrtname, last_name = $lastname, mobile = $mobile, category_id = $category WHERE employye_id = $employeeid";
            //         $insertStmt = $db->prepare($insertQuery);

            //         if ($insertStmt) {
            //             if ($insertStmt->execute()) {
            //                 echo "success";
            //             } else {
            //                 echo "Error adding employee: " . $insertStmt->error;
            //             }
            //         } else {
            //             echo "Error preparing insert statement: " . $db->error;
            //         }
            //     }
            // } else {
            //     echo "Error preparing employee check statement: " . $db->error;
            // }, email = ?, birthday = ?, gender_id = ?, marital_status = ?, address = ?, basic_salary = ?, payment_method = ?, epf_number = ?, bank_name = ?, branch_name = ?, account_number = ?


            $updateQuery = "UPDATE employee_data SET first_name = ?, last_name = ?, mobile = ?, category_id = ? WHERE employye_id = ?";
            $stmt = $db->prepare($updateQuery);

            if ($stmt) {
                $stmt->bind_param(
                    "sssis",
                    $fisrtname,
                    $lastname,
                    $mobile,
                    $category,
                    $id
                );

                if ($stmt->execute()) {

                    $employee_id = 0;

                    $queryemployee = "SELECT * FROM employee_data WHERE employye_id = ?";
                    $stmtemployee = $db->prepare($queryemployee);

                    if ($stmtemployee) {
                        
                        $stmtemployee->bind_param("s", $id);
                        $stmtemployee->execute();
                        $resultsemploye = $stmtemployee->get_result();
                        if ($resultsemploye->num_rows > 0) {

                            $resultemployee = $resultsemploye->fetch_assoc();
                            $employee_id = $resultemployee['id'];
                        }
                    }
                    echo $employee_id;

                    $queryep = "SELECT * FROM employee_other_details WHERE employee_id = ?";
                    $stmtep = $db->prepare($queryep);

                    if ($stmtep) {
                        $stmtep->bind_param("s", $employee_id);
                        $stmtep->execute();
                        $resultsep = $stmtep->get_result();

                        if ($resultsep->num_rows > 0) {

                            $updateQueryep = "UPDATE employee_other_details SET email = ?, birth_day = ?, address = ?,
                             gender_id = ?, maritial_id = ?, basic_salary = ?, payment_method_id = ?,
                             epf_no = ? , bank = ? , branch = ? , account_no = ? WHERE employee_id = ?";
                            $stmtupdate = $db->prepare($updateQueryep);

                            if ($stmtupdate) {
                                $stmtupdate->bind_param(
                                    "sssiisisssss",
                                    $email,
                                    $birthday,
                                    $address,
                                    $gender,
                                    $marital,
                                    $basic,
                                    $paymentmethod,
                                    $epf,
                                    $bank,
                                    $branch,
                                    $account,
                                    $employee_id
                                );
                                if ($stmtupdate->execute()) {
                                    echo "success";
                                } else {
                                    echo "error insert";
                                }
                            }
                        } else {
                            $insertQuery = "INSERT INTO employee_other_details 
                            (email, birth_day,address, gender_id, maritial_id, basic_salary, payment_method_id, epf_no,bank,branch,account_no,employee_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $insertStmt = $db->prepare($insertQuery);

                            if ($insertStmt) {

                                $insertStmt->bind_param(
                                    "sssiisisssss",
                                    $email,
                                    $birthday,
                                    $address,
                                    $gender,
                                    $marital,
                                    $basic,
                                    $paymentmethod,
                                    $epf,
                                    $bank,
                                    $branch,
                                    $account,
                                    $employee_id
                                );
                                if ($insertStmt->execute()) {
                                    echo "success";
                                } else {
                                    echo "error update" . $db->error;
                                }
                            } else {
                                echo "Error preparing insert statement: " . $db->error;
                            }
                        }
                    }
                } else {
                    echo "Error updating employee: " . $stmt->error;
                }
            } else {
                echo "Error preparing update statement: " . $db->error;
            }
        }
    }
}
