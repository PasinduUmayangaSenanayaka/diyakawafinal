<?php
session_start();
require "connection_db.php";
if (!isset($_SESSION["admin_user"])) {
?>
<script>
window.location = "index.php";
</script>
<?php
} else if (isset($_SESSION["subadmin_user"])) {
?>
<script>
window.location = "submain.php";
</script>
<?php
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Diyakawa Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css" />
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- endinject -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="images/logo.png">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php require "header.php" ?>
        <!-- partial -->
        <?php require "nav_bar.php" ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <!-- Header Section -->
                    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <div class="container">
                            <a class="navbar-brand" href="#">Billing Management</a>
                        </div>
                    </nav>

                    <div class="container mt-4">
                        <!-- Add and Search Section -->
                        <div class="row mb-3">
                            <div class="col-md-8 col-sm-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchBilling"
                                        placeholder="Search Billing...">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button"
                                            onclick="searchBilling()">Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 text-md-right text-center mt-2 mt-md-0">
                                <button class="btn btn-primary btn-block" onclick="addBilling()">Add New
                                    Billing</button>
                            </div>

                        </div>



                        <!-- Date Picker Section -->
                        <div class="row mb-4">
                            <div class="col-md-8 col-sm-12">
                                <form>
                                    <div class="form-group">
                                        <label for="billingDate" class="font-weight-bold">Billing Date</label>
                                        <input type="date" class="form-control" id="billingDate" name="billingDate"
                                            required>
                                        <small class="form-text text-muted">Please select the billing date.</small>
                                    </div>

                                    <!-- Buttons in the Same Row -->
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                        <button type="reset" class="btn btn-secondary btn-lg ml-2">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>





                        <!-- Billing Table -->
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Job Number</th>
                                    <th>Date</th>
                                    <th>Customer Name</th>
                                    <th>Project Name</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example Rows -->
                                <?php

                                $queryBilling = "SELECT * FROM billing_tb INNER JOIN customer ON billing_tb.costormer_id = customer.id

                                                    INNER JOIN project_type ON billing_tb.project_id = project_type.id
                                                    ";

                                $resultBilling = $db->query($queryBilling);
                                if ($resultBilling) {
                                    for ($i = 0; $i < $resultBilling->num_rows; $i++) {
                                        $total = 0;
                                        $row = $resultBilling->fetch_assoc();

                                        $job_no = $row['job_no'];

                                        $queryBilling2 = "SELECT * FROM product_listing WHERE job_no = '" . $job_no . "'  ";

                                        $resultBilling2 = $db->query($queryBilling2);

                                        for ($j = 0; $j < $resultBilling2->num_rows; $j++) {

                                            $row2 = $resultBilling2->fetch_assoc();

                                            $total += ($row2['qty'] * $row2['rate']);
                                        }

                                ?>
                                <tr>
                                    <td><?php echo $row['job_no']; ?></td>
                                    <td><?php echo $row['date_billing']; ?></td>
                                    <td><?php echo $row['customer']; ?></td>
                                    <td><?php echo $row['type']; ?></td>
                                    <td>Rs.<?php echo $total; ?>.00</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                                <?php

                                    }
                                } else {
                                    echo "Error: " . $db->error;
                                }

                                ?>

                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>



            <footer class="footer">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024
                                <a href="https://www.bootstrapdash.com/" class="text-muted"
                                    target="_blank">Bootstrapdash</a>.
                                All
                                rights reserved.</span>
                            <span
                                class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Hand-crafted
                                & made
                                with
                                <i class="typcn typcn-heart-full-outline text-danger"></i></span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


</body>

</html>