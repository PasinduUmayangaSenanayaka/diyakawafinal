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

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Admin - Activities</title>
  <!-- base:css -->
  <link rel="stylesheet" href="assets/vendors/typicons/typicons.css" />
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="icon" href="images/logo.png">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require "header.php"; ?>
    <!-- partial -->
    <?php require "nav_bar.php"; ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <!-- Flex container with justify-content-between -->
                <div class="row d-flex justify-content-between align-items-center">
                  <h1 class="col">Activities</h1>
                  <a href="newactivity.php" class="btn btn-primary col-auto">
                      <i class="fas fa-plus"></i> Add New Activity
                  </a>
                </div>

                <div class="row mt-3">
                  <table id="activitiesTable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Code</th>
                        <th>Local Price</th>
                        <th>Category</th>
                        <th>Created Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- main-panel ends -->
    </div>
  </div>

  <!-- DataTables initialization with pagination and entries options -->
  <script>
    $(document).ready(function() {
      $('#activitiesTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "fetch_activities.php", // PHP file to handle the AJAX request
          "type": "POST"
        },
        "lengthMenu": [10, 25, 50, 100, 200, 500], // Entries per page options
        "pageLength": 10, // Default number of entries per page
        "columns": [
          { "data": "product_name" },
          { "data": "code" },
          { "data": "local_price" },
          { "data": "category" },
          { "data": "created_date" },
          {
            "data": "action",
            "orderable": false,
            "searchable": false
          }
        ]
      });
    });
  </script>
</body>
</html>
