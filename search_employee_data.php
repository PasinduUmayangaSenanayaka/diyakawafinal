<?php
require "connection_db.php";
if (isset($_POST)) {

    $nic = $_POST['nic'];

    $query = "SELECT * FROM employee_data WHERE nic = ?";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $nic);
        $stmt->execute();
        $results = $stmt->get_result();

        if ($results->num_rows != 0) {

            $result = $results->fetch_assoc();


?>

            <div class="form-group">
                <label for="exampleInputName1">Employee ID : </label>
                <input type="text" class="form-control scleHover" disabled id="employeeiddatasearch" value="<?php echo $result['employye_id']; ?>" placeholder="">
            </div>


            <div class="form-group">
                <label for="exampleInputName1">Employee First Name : </label>
                <input type="text" class="form-control scleHover" value="<?php echo $result['first_name']; ?>" id="employee_firstname_search" placeholder="First Name">
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Employee Last Name : </label>
                <input type="text" class="form-control scleHover" value="<?php echo $result['last_name']; ?>" id="employee_lastname_search" placeholder="Last Name">
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Mobile : </label>
                <input type="text" value="<?php echo $result['mobile']; ?>" class="form-control scleHover" id="mobile_search" placeholder="Mobile">
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Employee Category </label>
                <select id="employee_categorySelect_search" class="form-select card-title ">


                    <?php

                    $querymarital = "SELECT * FROM employee_category WHERE id = ?";
                    $datamarital = $db->prepare($querymarital);

                    if ($datamarital) {
                        $datamarital->bind_param("i", $result['category_id']);
                        $datamarital->execute();

                        $resultmarital = $datamarital->get_result();

                        if ($resultmarital->num_rows != 0) {
                            $rowmarital = $resultmarital->fetch_assoc();
                    ?>

                            <option value="<?php echo $rowmarital['id']; ?>"><?php echo $rowmarital['category']; ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="0">Select</option>
                            <?php
                        }
                    } else {
                        echo "Error preparing gender query: " . $db->error;
                    }



                    $querygenderall = "SELECT * FROM employee_category";
                    $datagenderall = $db->prepare($querygenderall);

                    if ($datagenderall) {
                        $datagenderall->execute();
                        $resultgenderall = $datagenderall->get_result();

                        while ($rowgenderall = $resultgenderall->fetch_assoc()) {
                            // Check if the current gender id does not match $gender
                            if ($rowgenderall['id'] != $result['category_id']) {
                            ?>
                                <option value="<?php echo $rowgenderall['id']; ?>">
                                    <?php echo $rowgenderall['category']; ?>
                                </option>
                    <?php
                            }
                        }
                    }
                    ?>                    
                </select>
            </div>

            <?php
            $query2 = "SELECT * FROM employee_other_details WHERE employee_id = ?";
            $data = $db->prepare($query2);

            $email = null;
            $birthday = null;
            $gender = null;
            $marital = null;
            $paymentid = null;
            $address = null;
            $basicsalary = null;
            $epf = null;
            $bank = null;
            $branch = null;
            $account = null;

            if ($data) {
                $data->bind_param("s", $result['id']);
                $data->execute();
                $resultdata = $data->get_result();

                if ($resultdata->num_rows != 0) {

                    $resultdata = $resultdata->fetch_assoc();
                    $email = $resultdata['email'];
                    $birthday = $resultdata['birth_day'];

                    $query3 = "SELECT * FROM gender WHERE id = ?";
                    $datagender = $db->prepare($query3);

                    if ($datagender) {
                        $datagender->bind_param("s", $result['gender_id']);
                        $datagender->execute();
                        $resultgender = $datagender->get_result();

                        if ($resultgender->num_rows != 0) {
                            $gender = $resultgender['name'];
                        }
                    }


                    $query4 = "SELECT * FROM marital WHERE id = ?";
                    $datamarital = $db->prepare($query4);

                    if ($datamarital) {
                        $datamarital->bind_param("s", $result['maritial_id']);
                        $datamarital->execute();
                        $resultmarital = $datamarital->get_result();

                        if ($resultmarital->num_rows != 0) {
                        }
                    }

                    $gender = $resultdata['gender_id'];
                    $marital = $resultdata['maritial_id'];
                    $paymentid = $resultdata['payment_method_id'];
                    $address = $resultdata['address'];
                    $basicsalary = $resultdata['basic_salary'];
                    $epf = $resultdata['epf_no'];
                    $bank = $resultdata['bank'];
                    $branch = $resultdata['branch'];
                    $account = $resultdata['account_no'];
                }
            }

            ?>

            <div class="form-group">
                <label for="exampleInputName1">Email : </label>
                <input type="text" value="<?php echo $email; ?>" class="form-control scleHover" id="email_search" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Birth Day : </label>
                <input type="date" value="<?php echo $birthday; ?>" class="form-control scleHover" id="birthday_search" placeholder="">
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Gender : </label>
                <select id="gender_search" class="form-select card-title ">

                    <?php

                    $querygender = "SELECT * FROM gender WHERE id = ?";
                    $datagender = $db->prepare($querygender);

                    if ($datagender) {
                        $datagender->bind_param("i", $gender);
                        $datagender->execute();

                        $resultgender = $datagender->get_result();

                        if ($resultgender->num_rows != 0) {
                            $rowgender = $resultgender->fetch_assoc();
                    ?>

                            <option value="<?php echo $rowgender['id']; ?>"><?php echo $rowgender['name']; ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="0">Select</option>
                            <?php
                        }
                    } else {
                        echo "Error preparing gender query: " . $db->error;
                    }



                    $querygenderall = "SELECT * FROM gender";
                    $datagenderall = $db->prepare($querygenderall);

                    if ($datagenderall) {
                        $datagenderall->execute();
                        $resultgenderall = $datagenderall->get_result();

                        while ($rowgenderall = $resultgenderall->fetch_assoc()) {
                            // Check if the current gender id does not match $gender
                            if ($rowgenderall['id'] != $gender) {
                            ?>
                                <option value="<?php echo $rowgenderall['id']; ?>">
                                    <?php echo $rowgenderall['name']; ?>
                                </option>
                    <?php
                            }
                        }
                    }
                    ?>

                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Marital : </label>
                <select id="marital_search" class="form-select card-title ">
                    <?php

                    $querymarital = "SELECT * FROM marital WHERE id = ?";
                    $datamarital = $db->prepare($querymarital);

                    if ($datamarital) {
                        $datamarital->bind_param("i", $marital);
                        $datamarital->execute();

                        $resultmarital = $datamarital->get_result();

                        if ($resultmarital->num_rows != 0) {
                            $rowmarital = $resultmarital->fetch_assoc();
                    ?>

                            <option value="<?php echo $rowmarital['id']; ?>"><?php echo $rowmarital['status']; ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="0">Select</option>
                            <?php
                        }
                    } else {
                        echo "Error preparing gender query: " . $db->error;
                    }



                    $querygenderall = "SELECT * FROM marital";
                    $datagenderall = $db->prepare($querygenderall);

                    if ($datagenderall) {
                        $datagenderall->execute();
                        $resultgenderall = $datagenderall->get_result();

                        while ($rowgenderall = $resultgenderall->fetch_assoc()) {
                            // Check if the current gender id does not match $gender
                            if ($rowgenderall['id'] != $marital) {
                            ?>
                                <option value="<?php echo $rowgenderall['id']; ?>">
                                    <?php echo $rowgenderall['status']; ?>
                                </option>
                    <?php
                            }
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Address : </label>
                <textarea id="address_search" name="" value="<?php echo $basicsalary; ?>" class="form-control scleHover" rows="8" cols="20" placeholder="Address"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Basic Salary : </label>
                <input type="text" value="<?php echo $basicsalary; ?>" class="form-control scleHover" id="basicsalary_search" placeholder="Basic Salary">
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Payment Method : </label>
                <select id="payment_method_search" class="form-select card-title">
                    <?php

                    $querymarital = "SELECT * FROM payment_method WHERE id = ?";
                    $datamarital = $db->prepare($querymarital);

                    if ($datamarital) {
                        $datamarital->bind_param("i", $paymentid);
                        $datamarital->execute();

                        $resultmarital = $datamarital->get_result();

                        if ($resultmarital->num_rows != 0) {
                            $rowmarital = $resultmarital->fetch_assoc();
                    ?>

                            <option value="<?php echo $rowmarital['id']; ?>"><?php echo $rowmarital['payment_method']; ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="0">Select</option>
                            <?php
                        }
                    } else {
                        echo "Error preparing gender query: " . $db->error;
                    }



                    $querygenderall = "SELECT * FROM payment_method";
                    $datagenderall = $db->prepare($querygenderall);

                    if ($datagenderall) {
                        $datagenderall->execute();
                        $resultgenderall = $datagenderall->get_result();

                        while ($rowgenderall = $resultgenderall->fetch_assoc()) {
                            // Check if the current gender id does not match $gender
                            if ($rowgenderall['id'] != $paymentid) {
                            ?>
                                <option value="<?php echo $rowgenderall['id']; ?>">
                                    <?php echo $rowgenderall['payment_method']; ?>
                                </option>
                    <?php
                            }
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName1">EPF No : </label>
                <input type="text" value="<?php echo $epf; ?>" class="form-control scleHover" id="epf_search" placeholder="EPF NO">
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Bank : </label>
                <input type="text" value="<?php echo $bank; ?>" class="form-control scleHover" id="bank_search" placeholder="Bank Name">
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Branch : </label>
                <input type="text" value="<?php echo $branch; ?>" class="form-control scleHover" id="branch_search" placeholder="Bank Branch">
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Account No : </label>
                <input type="text" value="<?php echo $account; ?>" class="form-control scleHover" id="account_search" placeholder="Account No">
            </div>
            <button type="button" class="btn btn-success me-2 buttouncss"
                onclick="updateEmployee();">Update Employee</button>
            <button onclick="cleraData();" class="btn btn-light buttouncss">Clear</button>

    <?php
        }
    } else {
        echo "Error preparing category check statement: " . $db->error;
    }

    ?>
<?php

} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
?>