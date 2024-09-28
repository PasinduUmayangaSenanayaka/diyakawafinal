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
                    <div class="container mt-5">
                        <h2 class="text-center mb-4">Add Country</h2>
                        <form>

                            <?php


                                if (isset($_GET['id'])) {
                                ?>

                            <?php
                                    $queryCountry = "SELECT * FROM country WHERE id = '" . $_GET['id'] . "'";
                                    $resultCountry = $db->query($queryCountry);
                                    if ($resultCountry) {
                                        if ($resultCountry->num_rows != 0) {

                                            $row = $resultCountry->fetch_assoc();
                                    ?>
                            <div class="form-group">
                                <label for="countryCode">Country Code</label>
                                <input type="text" class="form-control" id="countryCode"
                                    placeholder="Enter country code" required value="<?php echo $row['code']; ?>"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="countryName">Country Name</label>
                                <input type="text" class="form-control" id="countryName"
                                    placeholder="Enter country name" required value="<?php echo $row['country']; ?>"
                                    disabled>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-danger"
                                    onclick="deleteCountry('<?php echo $row['id']; ?>')">Delete</button>
                                <button type="button" onclick="window.location.href='country.php'"
                                    class="btn btn-secondary">Back</button>
                            </div>
                            <?php
                                        }
                                    } else {
                                        echo "Error: " . $db->error;
                                    }

                                    ?>

                            <?php
                                } else {

                                ?>
                            <div class="form-group">
                                <label for="countryCode">Country Code</label>
                                <input type="text" class="form-control" id="countryCode"
                                    placeholder="Enter country code" required>
                            </div>
                            <div class="form-group">
                                <label for="countryName">Country Name</label>
                                <input type="text" class="form-control" id="countryName"
                                    placeholder="Enter country name" required>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-primary" onclick="addNewCountry()">Add New</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                            <?php

                                }

                                ?>

                        </form>
                    </div>



                </div>
            </div>

            <footer class="footer">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright
                                © 2024
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