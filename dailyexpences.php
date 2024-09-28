
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
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

<!-- Bootstrap JS (Ensure this is placed before your closing </body> tag) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="style.css" />
  <link rel="icon" href="images/logo.png">
  
  <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header-title {
            font-size: 24px;
            font-weight: bold;
            color: #8A2BE2;
        }
        .btn-new {
            background-color: #8A2BE2;
            color: white;
            float: right;
        }
        .btn-new i {
            margin-right: 5px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .table-wrapper {
            overflow-x: auto;
        }
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
    </style>
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

          <div class="col-md-12 grid-margin">
            <div class="card">
              <div class="card-body">
              <div class="container mt-4">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center">
                    <h2 class="header-title">
    <i class="typcn typcn-document-text"></i> Daily Expense Sheet - Diyakawa Water Sport
</h2>

                        <a href="expencesheet.php"> <button class="btn btn-new">
    <i class="typcn typcn-plus"></i> New
</button></a>

                    </div>

                    <!-- Search Bar -->
                    <div class="search-bar mt-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Sheet No, Date, or Sales">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" style="background-color: #8A2BE2; border-color: #8A2BE2;">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-wrapper">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sheet No</th>
                                    <th>Date</th>
                                    <th>Total Sales</th>
                                    <th>Total Expenses</th>
                                    <th>Profits</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableData">
                              
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <div class="form-group">
                            <select class="form-control" id="entriesPerPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                            </select>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#" id="prevPage">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#" id="nextPage">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
              
              </div>
            </div>
          </div>


        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="card">
          <div class="card-body">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024
                <a href="#" class="text-muted" target="_blank">Diyakawa</a>. All
                rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Water Sport
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


<script>
    $(document).ready(function() {
        let currentPage = 1;
        let entriesPerPage = 5;

        // Fetch data and handle pagination
        function loadTableData(page, perPage) {
            $.ajax({
                url: 'fetch_data.php',
                type: 'GET',
                data: {
                    page: page,
                    perPage: perPage
                },
                success: function(data) {
                    $('#tableData').html(data);
                }
            });
        }

        // Load initial data
        loadTableData(currentPage, entriesPerPage);

        // Handle entries per page change
        $('#entriesPerPage').on('change', function() {
            entriesPerPage = $(this).val();
            currentPage = 1;  // Reset to first page
            loadTableData(currentPage, entriesPerPage);
        });

        // Handle next and previous page
        $('#nextPage').on('click', function(e) {
            e.preventDefault();
            currentPage++;
            loadTableData(currentPage, entriesPerPage);
        });

        $('#prevPage').on('click', function(e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                loadTableData(currentPage, entriesPerPage);
            }
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