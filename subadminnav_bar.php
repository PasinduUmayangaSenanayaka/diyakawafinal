<div class="container-fluid page-body-wrapper">


  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">


    <ul class="nav">

      <?php

      require_once 'connection_db.php';
      if ($_SESSION) {
        $subadminid  = $_SESSION['subadmin_user']["id"];

        $user_asing_filter = $db->query("SELECT * FROM sidebar_acsses WHERE `user_id` = $subadminid AND validation =  1 ORDER BY slidebar_id ASC ");

        for ($i = 0; $i < $user_asing_filter->num_rows; $i++) {

          $rowuser_asing_filter = $user_asing_filter->fetch_assoc();


          if ($rowuser_asing_filter['slidebar_id'] == 1) {


      ?>

            <li class="nav-item">
              <a class="nav-link" href="submain.php">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

          <?php
          } else if ($rowuser_asing_filter['slidebar_id'] == 2) {
          ?>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="submain.php" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="typcn typcn-document-text menu-icon"></i>
                <span class="menu-title">Water Sport</span>
              </a>
            </li>
          <?php
          } else if ($rowuser_asing_filter['slidebar_id'] == 3) {
          ?>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="typcn typcn-film menu-icon"></i>
                <span class="menu-title">Paramotoring</span>
              </a>
            </li>
          <?php
          } else if ($rowuser_asing_filter['slidebar_id'] == 3) {
          ?>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="typcn typcn-chart-pie-outline menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
          <?php
          } else if ($rowuser_asing_filter['slidebar_id'] == 4) {
          ?>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="typcn typcn-th-small-outline menu-icon"></i>
                <span class="menu-title">Setuplist</span>
              </a>
            </li>

          <?php
          } else if ($rowuser_asing_filter['slidebar_id  '] == 5) {
          ?>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="typcn typcn-compass menu-icon"></i>
                <span class="menu-title">Sales</span>
              </a>
            </li>
          <?Php

          } else if ($rowuser_asing_filter['slidebar_id'] == 2) {
          ?>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="typcn typcn-user-add-outline menu-icon"></i>
                <span class="menu-title">Purchasing</span>
              </a>
            </li>

          <?Php

          } else if ($rowuser_asing_filter['slidebar_id'] == 3) {
          ?>

            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Cash Bank</span>
              </a>
            </li>
          <?Php

          } else if ($rowuser_asing_filter['slidebar_id'] == 4) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Stores</span>
              </a>
            </li>
          <?Php

          } else if ($rowuser_asing_filter['slidebar_id'] == 5) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Accounting</span>
              </a>
            </li>
          <?Php

          } else if ($rowuser_asing_filter['slidebar_id'] == 6) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Shipping</span>
              </a>
            </li>
          <?Php

          } else if ($rowuser_asing_filter['slidebar_id'] == 7) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">CRM</span>
              </a>
            </li>
          <?Php

          } else if ($rowuser_asing_filter['slidebar_id'] == 8) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Shoppin Sales</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 9) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Job Management</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 10) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Hrm Center</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 11) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Workshop</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 12) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Config Company</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 13) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Approval</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 14) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Un-Approval</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 15) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Excel Input</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 16) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Posting</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 17) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Transacting Type Posting</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 18) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Sales Posting</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 19) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="admin_register.php">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">user</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 20) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Mobile App</span>
              </a>
            </li>
          <?Php
          } else if ($rowuser_asing_filter['slidebar_id'] == 21) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="../../../docs/documentation.html">
                <i class="typcn typcn-mortar-board menu-icon"></i>
                <span class="menu-title">Rebuild</span>
              </a>
            </li>
      <?php
          }
        }
      }
      ?>
    </ul>
  </nav>