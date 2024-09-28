<?php
session_start();

require "connection_db.php";

if (!isset($_SESSION["subadmin_user"])) {
?>
  <script>
    window.location = "subindex.php";
  </script>
<?php
} else if (isset($_SESSION["admin_user"])) {
?>
  <script>
    window.location = "main.php";
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
  <title>Sub Admin Dashboard</title>
  <!-- base:css -->
  <link rel="stylesheet" href="assets/vendors/typicons/typicons.css" />
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />

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
    <?php require "subadminnav_bar.php" ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">

          <?php
          if ($_SESSION) {
            $subadminid  = $_SESSION['subadmin_user']["id"];

            $user_asing_filter = $db->query("SELECT * FROM user_assing WHERE `user_type` = $subadminid AND validate =  1 ORDER BY icon_id ASC  ");

            for ($i = 0; $i < $user_asing_filter->num_rows; $i++) {

              $rowuser_asing_filter = $user_asing_filter->fetch_assoc();
              if ($rowuser_asing_filter['icon_id'] == 1) {
          ?>



                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="bi bi-graph-up-arrow iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-4 text-md-center text-lg-center">
                            Bill System
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 2) {

              ?>

                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi-calculator-fill iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Daily Expense Sheet
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 3) {
              ?>

                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-receipt iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Invoice
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 4) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-building-check iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Credi Bill
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 5) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-bank iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Expenses
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 6) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-person-fill-add iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Supplier Statement
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 7) {
              ?>


                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-bank2 iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Patment Receipts
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 8) {
              ?>

                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-cart-plus-fill iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center"></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 9) {
              ?>

                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-people-fill iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Guest
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 10) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-globe-central-south-asia iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Country
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 11) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-briefcase-fill iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Employee
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 12) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-person-fill iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Vendor
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 13) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-building iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Business Category
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 14) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-rocket-takeoff-fill iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Activites
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 15) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-person-gear iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Operater
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 16) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-person-fill-check iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Guide
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 17) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-car-front-fill iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Driver
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 18) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-person-up iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Vendor Category
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 19) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-person-up iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Vendor Sub Category
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 20) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-person-x-fill iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Customer Category
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 21) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-person-x-fill iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Customer Sub Category
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 22) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-building iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Company
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 23) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-card-checklist iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Licen Category
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowuser_asing_filter['icon_id'] == 24) {
              ?>
                <div class="col-md-4 grid-margin stretch-card cardSize">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-center flex-wrap mb-4">
                        <div style="
                          display: flex;
                          flex-direction: column;
                          align-items: center;
                          justify-content: center;
                          text-align: center;
                        ">
                          <h1 class="mb-0">
                            <i class="ms-3 ms-md-0 bi bi-bus-front iconSize"></i>
                          </h1>
                          <h4 class="mb-2 ms-0 text-md-center text-lg-center">
                            Vehical Category
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

          <?php
              }
            }
          }
          ?>




        </div>




      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="card">
          <div class="card-body">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024
                <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>. All
                rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Hand-crafted & made
                with
                <i class="typcn typcn-heart-full-outline text-danger"></i></span>
            </div>
          </div>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="assets/vendors/chart.js/chart.umd.js"></script>
  <script src="assets/js/jquery.cookie.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <!-- End custom js for this page-->
</body>

</html>