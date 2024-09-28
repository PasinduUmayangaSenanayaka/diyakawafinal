<?php
session_start();

if (isset($_SESSION["subadmin_user"])) {
?>
  <script>
    window.location = "submain.php";
  </script>
<?php
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="images/logo.png">

  <title>Diyakawa Admin Login</title>
</head>

<body>


  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/diyakawaLOgin.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">

            <div class="mb-4">
            <h3 style="font-weight: bold;">User Admin Log In</h3>
              <h3 style="font-weight: bold;">Diyakawa Water Sport Center</h3>
              <br />
              <h3>Sign In</h3>

              <h5 class="msgColor" id="massege"></h5>

            </div>
            <form action="#" method="post">
              <div class="form-group first">
                <label for="username" class="scleHover">Username</label>
                <input type="text" class="form-control" id="username">

              </div>
              <div class="form-group last mb-3 ">
                <label for="password" class="scleHover">Password</label>
                <input type="password" class="form-control" id="password">

              </div>

              <div class="last ms-3 mb-3">
                <button class="form-control buttouncss" type="button" onclick="sublogInAdmin();">Log In</button>
              </div>


            </form>
          </div>
        </div>
      </div>
    </div>


  </div>



  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/login.js"></script>
</body>

</html>