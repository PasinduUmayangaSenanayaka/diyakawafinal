<?php
require "connection_db.php";
session_start();

if (isset($_SESSION['admin_user'])) {
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

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="container mt-4">
                        <!-- Search and Add Country Section -->
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search"
                                        placeholder="Search Country By Country code or Country..."
                                        onkeyup="searchCountry()">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button"
                                            onclick="searchCountry()">Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <button class="btn btn-primary" onclick="window.location.href='newCountry.php'">Add
                                    Country</button>
                            </div>
                        </div>

                        <!-- Country Table -->
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Country Code</th>
                                    <th>Country Name</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody id="countryTBody">
                                <!-- Example Rows -->
                                <?php
                                    $queryCountry = "SELECT * FROM country";
                                    $resultCountry = $db->query($queryCountry);
                                    if ($resultCountry) {
                                        for ($i = 0; $i < $resultCountry->num_rows; $i++) {

                                            $row = $resultCountry->fetch_assoc();
                                    ?>
                                <tr>
                                    <td><?php echo $row['code']; ?></td>
                                    <td><?php echo $row['country']; ?></td>
                                    <td><button class="btn btn-primary btn-sm"
                                            onclick="viewCountry('<?php echo $row['id']; ?>')">View</button>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                        echo "Error: " . $db->error;
                                    }

                                    ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Controls -->
                    <nav>
                        <ul class="pagination" id="paginationControls">
                            <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>


                </div>
            </div>
            <footer class="footer">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024
                                <a href="https://www.bootstrapdash.com/" class="text-muted"
                                    target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                            <span
                                class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Hand-crafted
                                & made with <i class="typcn typcn-heart-full-outline text-danger"></i></span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="js/country.js"></script>

</body>

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