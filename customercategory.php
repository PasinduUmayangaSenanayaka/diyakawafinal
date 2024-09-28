<?php
session_start();
require "connection_db.php";

if (!isset($_SESSION["admin_user"])) {
?>
  <script>
    window.location = "index.php";
  </script>
<?php
}else if (isset($_SESSION["subadmin_user"])){
  ?>
  <script>
    window.location = "submain.php";
  </script>
<?php
}


// Insert data into the table
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'];
    $description = $_POST['description'];

    $sql = "INSERT INTO customer_category (category, description) 
            VALUES ('$category', '$description')";

    if ($db->query($sql) === TRUE) {
        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'New category added successfully',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload(); // Reload the page after confirmation
          }
        });
      </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

// Fetch data from the table
$result = $db->query("SELECT * FROM customer_category");

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
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
         
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
              <div class="container mt-5">
    <h2>Customer Category</h2>

    <!-- Form to insert data -->
    <form method="POST" action="">
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!-- Display data in a table -->
    <h3 class="mt-5">Customer Category List</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['category'] . "</td>
                        <td>" . $row['description'] . "</td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

              </div>
            </div>
          </div>
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