<?php
require "connection_db.php";
session_start();

if (isset($_SESSION['admin_user'])) {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin User registration</title>
    <!-- base:css -->
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->

    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="images/logo.png">
  </head>

  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <?php require "header.php" ?>
      <!-- partial -->
      <?php require "nav_bar.php" ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Admin registration</h4>
                  <p class="msgColor" id="massege"></p>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control scleHover" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">User Name</label>
                      <input type="email" class="form-control scleHover" id="username"
                        placeholder="User Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" class="form-control scleHover" id="password"
                        placeholder="Password">
                    </div>
                    <div class="form-group ">
                      <label for="exampleInputPassword4">Retype Password</label>
                      <input type="password" class="form-control scleHover" id="reTypePassword"
                        placeholder="Retype Password">
                    </div>



                    <button type="button" class="btn btn-primary me-2 buttouncss"
                      onclick="userDataForm();">Add User</button>
                    <button onclick="loardpage()" class="btn btn-light buttouncss">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Dashboard Access Management Area</h4>
                  <p class="card-description">Select the user to access given.</p>

                  <select onchange="loardUserData()" id="userSelectId" class="form-select card-title ">
                    <option value="0">Select </option>
                    <?php
                    $querySubAdmin = "SELECT * FROM `subadmin_users`";
                    $resultSubAdmin = $db->query($querySubAdmin);
                    if ($resultSubAdmin) {

                      for ($i = 0; $i < $resultSubAdmin->num_rows; $i++) {
                        $rowSubAdmin = $resultSubAdmin->fetch_assoc();
                    ?>
                        <option value="<?php echo $rowSubAdmin['id']; ?>"><?php echo $rowSubAdmin['admin_user_id']; ?>
                        </option>

                </div>
            <?php
                      }
                    }
            ?>

            </select>

            <br>
            <br>

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <div class="form-group row" id="area1">
                    <?php
                    $querySlidBarIcon = "SELECT * FROM `slidebar_icon`";
                    $resultSlidBarIcon = $db->query($querySlidBarIcon);
                    if ($resultSlidBarIcon) {

                      $numberOfSlides = $resultSlidBarIcon->num_rows;
                      $rowCount = $numberOfSlides / 6;

                      for ($i = 0; $i < $resultSlidBarIcon->num_rows; $i++) {

                        $rowSlideBar = $resultSlidBarIcon->fetch_assoc();

                    ?>
                        <div class="col-6 col-md-3 col-lg-3">
                          <p class="mb-2"><?php echo $rowSlideBar['icon']; ?></p>
                          <label class="toggle-switch toggle-switch-info">
                            <input id="" value="<?php echo $rowSlideBar['id']; ?>"
                              type="checkbox" disabled>
                            <span class="toggle-slider round"></span>
                          </label>
                        </div>
                    <?php
                      }
                    }
                    ?>


                  </div>

                  <div id="area2"> </div>

                  <br>
                  <br>
                  <div style=" align-content: end;">
                    <button type="button" class="btn btn-info me-2 buttouncss"
                      onclick="loardpage();">Clear</button>

                  </div>


                </div>
              </div>
            </div>

              </div>

            </div>
          </div>



          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Slide Bar Access Management Area</h4>
                <p class="card-description">Select the user to access given.</p>

                <select onchange="loardDataSlideBar()" id="userSelectIdslidbar" class="form-select card-title ">
                  <option value="0">Select </option>
                  <?php
                  $querySubAdmin = "SELECT * FROM `subadmin_users`";
                  $resultSubAdmin = $db->query($querySubAdmin);
                  if ($resultSubAdmin) {

                    for ($i = 0; $i < $resultSubAdmin->num_rows; $i++) {
                      $rowSubAdmin = $resultSubAdmin->fetch_assoc();
                  ?>
                      <option value="<?php echo $rowSubAdmin['id']; ?>"><?php echo $rowSubAdmin['admin_user_id']; ?>
                      </option>

              </div>
          <?php
                    }
                  }
          ?>

          </select>

          <br>
          <br>

          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">

                <div class="form-group row" id="slidearea1">
                  <?php
                  $querySlidBarIcon = "SELECT * FROM `slidebar_names`";
                  $resultSlidBarIcon = $db->query($querySlidBarIcon);
                  if ($resultSlidBarIcon) {

                                 for ($i = 0; $i < $resultSlidBarIcon->num_rows; $i++) {

                      $rowSlideBar = $resultSlidBarIcon->fetch_assoc();

                  ?>
                      <div class="col-2">
                        <p class="mb-2"><?php echo $rowSlideBar['slidebarName']; ?></p>
                        <label class="toggle-switch toggle-switch-info">
                          <input id="" value="<?php echo $rowSlideBar['id']; ?>"
                            type="checkbox" disabled>
                          <span class="toggle-slider round"></span>
                        </label>
                      </div>
                  <?php
                    }
                  }
                  ?>


                </div>

                <div id="slidearea2"> </div>

                <br>
                <br>
                <div style=" align-content: end;">
                  <button type="button" class="btn btn-info me-2 buttouncss"
                    onclick="loardpage();">Clear</button>

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
    <!-- partial:../../partials/_footer.html -->
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
    <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>

    <script>

    </script>
    <!-- page-body-wrapper ends -->

    <!-- container-scroller -->
    <!-- base:js -->
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
    <!-- End custom js for this page-->
  </body>

  </html>

<?php
} else {

?>
  <script>
    window.location = "index.php";
  </script>
<?php

}
?>