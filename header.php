<?php
session_start();
date_default_timezone_set('Asia/Colombo');
$currentDatetime = date('Y-m-d H:i:s');

if (!isset($_SESSION["admin_user"])) {
    echo "<script>window.location = 'index.php';</script>";
} else if (isset($_SESSION["subadmin_user"])) {
    echo "<script>window.location = 'submain.php';</script>";
} else {
    $adminName = $_SESSION["admin_user"]["admin_name"];
}
?>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center col-6 col-md-3" style="background-color: blueviolet;">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a href="main.php"><img src="images/logo.png" alt="Logo" style="height: 50px; width: auto;"></a>&nbsp;&nbsp;
            <span class="textCss"> Diyakawa Water Center Park</span>
        </div>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end col-6 col-md-9" style="background-color: blueviolet;">
      

        <ul class="navbar-nav navbar-nav-right me-5">
            <!-- Date and Notifications -->
            <li class="nav-item nav-date">
                <a class="nav-link d-flex justify-content-center align-items-center" href="#">
                    <h6 class="date mb-0">Today: <?php echo $currentDatetime; ?></h6>
                    <i class="typcn typcn-calendar"></i>
                </a>
            </li>
            <!-- Messages dropdown -->
            <!-- <li class="nav-item dropdown"> -->
                <!-- <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="typcn typcn-mail mx-0"></i>
                </a> -->
                <!-- <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown"> -->
                    <!-- Add message items here -->
                <!-- </div>
            </li> -->
            <!-- Notifications dropdown -->
    <li class="nav-item dropdown me-0">
    <a class="nav-link  dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown" >
    <img src="images/logo.png" alt="Admin Logo" class="rounded-circle" style="width: 30px;height:30px;">
    <span class="ms-2"><?php echo $adminName; ?></span>
        <!-- <span class="badge bg-danger">3</span> Notification count -->
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
        <!-- User Profile -->
        <a class="dropdown-item d-flex align-items-center" href="#">
            <i class="typcn typcn-user-outline me-2"></i>
            <span>User Profile</span>
        </a>
        <!-- Messages -->
        <a class="dropdown-item d-flex align-items-center" href="logout.php">
            <i class="typcn typcn-mail me-2"></i>
            <span>Logout</span>
        </a>
        <!-- Divider -->
   
    </div>
</li>

            <!-- <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="images/logo.png" alt="Admin Logo" class="rounded-circle" style="width: 40px; height: 40px;">
                    <span class="ms-2"><?php echo $adminName; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="settings.php"><i class="typcn typcn-cog-outline"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php"><i class="typcn typcn-eject-outline"></i> Logout</a></li>
                </ul>
            </li> -->
        </ul>
      

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>
