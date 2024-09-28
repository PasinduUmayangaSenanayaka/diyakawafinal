<?php
require "connection_db.php";
session_start();

if (isset($_SESSION['admin_user'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employee Category Creation</title>

        <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
        <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
        <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">

        <link rel="stylesheet" href="assets/css/style.css">

        <link rel="stylesheet" href="style.css" />
        <link rel="icon" href="images/logo.png">

    </head>

    <body>
        <div class="container-scroller">

            <?php require "header.php" ?>
            <?php require "nav_bar.php" ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Employee Registration</h4>
                                    <p class="msgColor" id="massege"></p>
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Employee ID : </label>
                                            <?php

                                            function generateNextCode($lastCode)
                                            {
                                                $prefix = 'DIYKAWA/';
                                                $number = (int)str_replace($prefix, '', $lastCode);
                                                $nextNumber = $number + 1;

                                                $newCode = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

                                                return $newCode;
                                            }

                                            $queryAdminUser = "SELECT * FROM employee_data ORDER BY employye_id DESC LIMIT 1";
                                            $resultAdminUser = $db->query($queryAdminUser);

                                            if ($resultAdminUser) {

                                                if ($resultAdminUser->num_rows != 0) {
                                                    $row = $resultAdminUser->fetch_assoc();
                                                    $lastCode = $row['employye_id']; 
                                                } else {
                                                    $lastCode = 'DIYKAWA/0001'; 
                                                }

                                                $nextCode = generateNextCode($lastCode);
                                            }

                                            ?>
                                            <input type="text" class="form-control scleHover" disabled id="employeeid" value="<?php echo $nextCode; ?>" placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Employee First Name : </label>
                                            <input type="text" class="form-control scleHover" id="employee_firstname" placeholder="First Name">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Employee Last Name : </label>
                                            <input type="text" class="form-control scleHover" id="employee_lastname" placeholder="Last Name">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Employee NIC :</label>
                                            <input type="text" class="form-control scleHover" id="employeenic" placeholder="NIC">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Mobile : </label>
                                            <input type="text" class="form-control scleHover" id="mobile" placeholder="Mobile">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Employee Category </label>
                                            <select id="categorySelect" class="form-select card-title ">

                                                <option value="0">Select</option>
                                                <?php
                                                $queryCategory = "SELECT * FROM employee_category";
                                                $resultCategory = $db->query($queryCategory);
                                                if ($resultCategory) {
                                                    for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                        $row = $resultCategory->fetch_assoc();
                                                ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['category']; ?></option>
                                                <?php
                                                    }
                                                } else {
                                                    echo "Error: " . $db->error;
                                                }

                                                ?>
                                            </select>
                                        </div>


                                        <button type="button" class="btn btn-primary me-2 buttouncss"
                                            onclick="addEmployee();">Add Employee</button>
                                        <button onclick="cleraData();" class="btn btn-light buttouncss">Clear</button>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Employee Other Data Updates</h4>
                                    <p class="msgColor" id="massegesearchdata"></p>
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Employee NIC :</label>
                                            <input onkeyup="searchUser();" type="text" class="form-control scleHover" id="employeenicdatasearch" placeholder="NIC">
                                        </div>
                                        <div id="loradDetails"></div>
                                        <div id="hidedata">
                                            <div class="form-group">
                                                <label for="exampleInputName1">Employee ID : </label>
                                                <input type="text" class="form-control scleHover" disabled id="employeeiddatasearch" value="" placeholder="">
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputName1">Employee First Name : </label>
                                                <input type="text" class="form-control scleHover" id="employee_firstname_search" placeholder="First Name">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputName1">Employee Last Name : </label>
                                                <input type="text" class="form-control scleHover" id="employee_lastname_search" placeholder="Last Name">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputName1">Mobile : </label>
                                                <input type="text" class="form-control scleHover" id="mobile_search" placeholder="Mobile">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputName1">Employee Category </label>
                                                <select id="categorySelect_search" class="form-select card-title ">

                                                    <option value="0">Select</option>
                                                    <?php
                                                    $queryCategory = "SELECT * FROM employee_category";
                                                    $resultCategory = $db->query($queryCategory);
                                                    if ($resultCategory) {
                                                        for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                            $row = $resultCategory->fetch_assoc();
                                                    ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['category']; ?></option>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "Error: " . $db->error;
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                            <button type="button" class="btn btn-success me-2 buttouncss">Update Employee</button>
                                            <button onclick="cleraData();" class="btn btn-light buttouncss">Clear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>





                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Employee Category Create</h4>
                                    <p class="msgColor" id="massegecategory"></p>
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Category </label>
                                            <input type="text" class="form-control scleHover" id="category" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Description</label>
                                            <textarea class="form-control scleHover" cols="30" rows="8" placeholder="Description" name="" id="categorydescription"></textarea>
                                            <!-- <input type="email" class="form-control scleHover" id="username"
                                            placeholder="User Name"> -->
                                        </div>


                                        <button type="button" class="btn btn-primary me-2 buttouncss"
                                            onclick="addCategory();">Add Category</button>
                                        <button onclick="cleraData();" class="btn btn-light buttouncss">Clear</button>
                                    </form>
                                </div>
                            </div>
                        </div>





                    </div>
                </div>

            </div>



        </div>
        <footer class="footer">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a
                                href="https://www.bootstrapdash.com/" class="text-muted"
                                target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Hand-crafted
                            & made with <i class="typcn typcn-heart-full-outline text-danger"></i></span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-panel ends -->
        </div>

        <script src="assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- inject:js -->
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/template.js"></script>
        <script src="assets/js/settings.js"></script>
        <script src="assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- plugin js for this page -->
        <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
        <script src="assets/vendors/select2/select2.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- Custom js for this page-->
        <script src="assets/js/file-upload.js"></script>
        <script src="assets/js/typeahead.js"></script>
        <script src="assets/js/select2.js"></script>
        <script src="js/admin_register.js"></script>

    </body>

    <script src="js/employee_data.js"></script>

    </html>
<?php
} else {
?>
    <script>
        window.location = "index.php"
    </script>
<?php
}
?>