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


// Fetch categories from the database
$query = "SELECT id, category FROM product_category";
$result = $db->query($query);

if (!$result) {
    die('Error: ' . $db->error); // Handle error
}





$db->close();
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

<!-- Include SweetAlert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.6/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.6/sweetalert2.all.min.js"></script>




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
              <h2>Create Activity</h2>

<!-- Add Activity Category Section -->
<div class="row mb-5 mt-4">
    <div class="col-12">
        <h5>Add Activity's Category</h5>
        <form id="categoryForm">
            <div class="mb-3">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" required>
            </div>
            <button type="submit" class="btn btn-success">Add Category</button>
        </form>
        <!-- Placeholder for success/error messages -->
        <div id="categoryMessage" class="mt-3"></div>
    </div>
</div>


<!-- Activity Details Form -->
<div class="row">
    <div class="col-12">
        <h5>Activity Details</h5>
    <!-- Activity Form -->
    <form id="activityForm">
    <div class="mb-3">
<label for="activityCategory" class="form-label">Select Activity Category</label>
<select class="form-select" id="activityCategory" name="activityCategory" required>
<option value="" disabled selected>Select a category</option>
<?php
// Populate the select options
while ($row = $result->fetch_assoc()) {
    echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['category']) . '</option>';
}
?>
</select>
</div>


    <div class="mb-3">
        <label for="activityName" class="form-label">Activity Name</label>
        <input type="text" class="form-control" id="activityName" name="activityName" required>
    </div>

    <div class="mb-3">
        <label for="activityCode" class="form-label">Activity Code</label>
        <input type="text" class="form-control" id="activityCode" name="activityCode" required>
    </div>

    <div class="mb-3">
        <label for="localPrice" class="form-label">Local Price</label>
        <input type="number" class="form-control" id="localPrice" name="localPrice" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="discount" class="form-label">Discount</label>
        <input type="number" class="form-control" id="discount" name="discount" required>
    </div>

    <button type="button" class="btn btn-primary" onclick="addactivity();">Add Activity</button>
</form>

            <!-- Foreign Currency Section -->
            <h6  class="mt-3">Foreign Price</h6>
<div class="mt-3">
<form id="foreignPriceForm">
    <table class="table table-bordered" id="foreignPriceTable">
        <thead>
            <tr>
                <th>Currency</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>
<select class="form-select currency-select" name="currency[]">
<!-- Currencies will be dynamically loaded -->
</select>
</td>

                <td>
                    <input type="number" class="form-control" name="amount[]" step="0.01" placeholder="Enter Amount" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-row">Remove</button>
                </td>
            </tr>
        </tbody>
    </table>
    <button type="button" id="addCurrencyRow" class="btn btn-primary">Add New Currency</button>
    <button type="submit" class="btn btn-success">Save Foreign Prices</button>
</form>
</div>

          

     
    </div>
</div>

              </div>
            </div>
          </div>
        </div>
        

     

       

 
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script>
    // Function to handle form submission
    function addactivity() {
        // Collect form data
        var category = document.getElementById('activityCategory').value;
        var name = document.getElementById('activityName').value;
        var code = document.getElementById('activityCode').value;
        var localPrice = document.getElementById('localPrice').value;
        var description = document.getElementById('description').value;
        var discount = document.getElementById('discount').value;

        // Check if all required fields are filled
        if (!category || !name || !code || !localPrice || !description || !discount) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please fill out all required fields.'
            });
            return;
        }

        // Create a FormData object
        var formData = new FormData();
        formData.append('category', category);
        formData.append('name', name);
        formData.append('code', code);
        formData.append('localPrice', localPrice);
        formData.append('description', description);
        formData.append('discount', discount);

        // Send data to the server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_activity.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Handle successful response
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Activity added successfully!'
                }).then(() => {
                    // Optionally clear the form or redirect
                    document.getElementById('activityForm').reset();
                });
            } else {
                // Handle error response
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while adding the activity.'
                });
            }
        };
        xhr.send(formData);
    }

    $(document).ready(function() {
    var currencyOptions = '';

    // Load currencies into the select elements
    $.ajax({
        url: 'get_currencies.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $.each(data, function(index, currency) {
                currencyOptions += '<option value="' + currency.id + '">' + currency.currencyName + '</option>';
            });
            
            // Append options to existing select elements
            $('#foreignPriceTable .currency-select').html(currencyOptions);
        },
        error: function() {
            alert('Failed to load currencies.');
        }
    });

    // Add new row
    $('#addCurrencyRow').click(function() {
        var newRow = '<tr>' +
            '<td>' +
            '<select class="form-select currency-select" name="currency[]">' +
            currencyOptions +  // Use the previously loaded options
            '</select>' +
            '</td>' +
            '<td>' +
            '<input type="number" class="form-control" name="amount[]" step="0.01" placeholder="Enter Amount" required>' +
            '</td>' +
            '<td>' +
            '<button type="button" class="btn btn-danger remove-row">Remove</button>' +
            '</td>' +
            '</tr>';
        $('#foreignPriceTable tbody').append(newRow);
    });

    // Remove row
    $('#foreignPriceTable').on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
    });

    // Handle form submission
    $('#foreignPriceForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'save_foreign_prices.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                $('#foreignPriceForm')[0].reset();
                $('#foreignPriceTable tbody').empty();
                var initialRow = '<tr>' +
                    '<td>' +
                    '<select class="form-select currency-select" name="currency[]">' +
                    currencyOptions +  // Use the previously loaded options
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="number" class="form-control" name="amount[]" step="0.01" placeholder="Enter Amount" required>' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-danger remove-row">Remove</button>' +
                    '</td>' +
                    '</tr>';
                $('#foreignPriceTable tbody').append(initialRow);
            },
            error: function() {
                alert('An error occurred while saving the foreign prices.');
            }
        });
    });
});

$(document).ready(function () {
    $('#categoryForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        let categoryName = $('#categoryName').val();

        // Perform AJAX request to add_category.php
        $.ajax({
            url: 'add_category.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ category: categoryName }),
            success: function (response) {
                let result = JSON.parse(response);
                if (result.success) {
                    $('#categoryMessage').html('<div class="alert alert-success">Category added successfully!</div>');
                    $('#categoryName').val(''); // Clear the input field
                    window.location.reload();
                } else {
                    $('#categoryMessage').html('<div class="alert alert-danger">Error: ' + result.message + '</div>');
                }
            },
            error: function () {
                $('#categoryMessage').html('<div class="alert alert-danger">An error occurred while processing the request.</div>');
            }
        });
    });
});


    </script>
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