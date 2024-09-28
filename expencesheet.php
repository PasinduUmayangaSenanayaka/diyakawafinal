
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
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-submit {
            background-color: #8A2BE2;
            color: white;
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


  
              <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">Add Expense Sheet</h2>
                    
                    <!-- Expense Categories Form -->
                    <div>
                        <!-- Main Category -->
                        <div class="form-group">
                            <label for="mainCategory">Main Category</label>
                            <select class="form-select" id="mainn_category" onchange="loadsubmain();">
    <option value="0">Select Main Expence Category</option>
    <?php
     include 'connection_db.php';
    $sqlcat11 = "SELECT mc_id, main_category FROM main_categories"; 

    // Execute the query
    $result111 = $db->query($sqlcat11);
    if ($result111) {
        
        while ($row = $result111->fetch_assoc()) {
            echo '<option value="' . $row['mc_id'] . '">' . htmlspecialchars($row['main_category']) . '</option>';
        }
     
        $result111->free();
    } else {
     
        echo '<option value="0">No categories found</option>';
    }

   
 


    ?>
</select>
                        </div>

                        <!-- Sub-Main Category -->
                        <div class="form-group">
                            <label for="mainsubcatt">Sub-Main Category</label>
                            <select class="form-control" id="mainsubcatt"  onchange="loadsubcatt();">
                                <option value="0">Select Sub-Main Category</option>
                            </select>
                        </div>

                        <!-- Sub Category -->
                        <div class="form-group">
                            <label for="subsCategory">Sub Categories 1</label>
                            <select class="form-control" id="subsCategory"  onchange="loadsubcat1();">
                                <option value="0">Select Sub Category</option>
                            </select>
                        </div>

                        <!-- Sub-Sub Category -->
                        <div class="form-group">
                            <label for="subSubCategory1">Sub Categories 2</label>
                            <select class="form-control" id="subSubCategory1" onchange="loadsubcat2();">
                                <option value="0">Select Sub-Sub Category</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subcat111">Sub Categories 3</label>
                            <select class="form-control" id="subcat111" >
                                <option value="0">Select Sub-Sub Category</option>
                            </select>
                        </div>

                        <!-- Location -->
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select class="form-select" id="location">
    <option value="0">Select Location</option>
    <?php
   
    $sqlcat11 = "SELECT id, location FROM location"; 

    // Execute the query
    $result111 = $db->query($sqlcat11);
    if ($result111) {
        
        while ($row = $result111->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['location']) . '</option>';
        }
     
        $result111->free();
    } else {
     
        echo '<option value="0">No location found</option>';
    }

    ?>
</select>
                        </div>

                        <!-- Employee -->
                        <div class="form-group">
                            <label for="employee">Employee</label>
                            <select class="form-control" id="employee" name="employee" required>
                                <option value="0">Select Employee</option>
                                <?php
   
   $sqlcat11 = "SELECT id, first_name,last_name FROM employee_data"; 

   // Execute the query
   $result111 = $db->query($sqlcat11);
   if ($result111) {
       
       while ($row = $result111->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</option>';
       }
    
       $result111->free();
   } else {
    
       echo '<option value="0">No location found</option>';
   }

   ?>
                            </select>
                        </div>

                        <!-- Payment Method -->
                        <div class="form-group">
                            <label for="paymentMethod">Payment Method</label>
                            <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                                <option value="0">Select Payment Method</option>
                                <?php
   
   $sqlcat11 = "SELECT id, payment_method FROM payment_method"; 

   // Execute the query
   $result111 = $db->query($sqlcat11);
   if ($result111) {
       
       while ($row = $result111->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['payment_method']) . '</option>';
       }
    
       $result111->free();
   } else {
    
       echo '<option value="0">No location found</option>';
   }

   ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" placeholder="Enter Amount" />

                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-submit" onclick="addexpences();">Add Expense</button>
</div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card mt-2">
            <h2 class="header-title text-center text-bg-info">Expence Category Registration </h2>
                <div class="card-body mt-2">
                    <h3 class="header-title">Add Expense Main Category</h3>

                    <div class="col-12">
    <div class="row">
        <div class="col-9">
            <input type="text" class="form-control" id="main_category_input" placeholder="Enter Main Category Name" />
        </div>
        <div class="col-3">
            <button class="btn btn-outline-primary" onclick="savemaincategory();">Save</button>
        </div>
    </div>
</div>
                   </div>
                </div>

            <div class="card mt-2">
                <div class="card-body">
                    <h3 class="header-title">Add Sub Main Expence Category</h3>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-5">
                            <select class="form-select" id="main_category_select" style="height: 40px;">
                            <option value="0">Select Sub Main Category Type</option>
    <?php
  
  include 'connection_db.php';
    $sql = "SELECT mc_id, main_category FROM `main_categories`";
    $result = $db->query($sql);
    if ($result) {
        
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['mc_id'] . '">' . htmlspecialchars($row['main_category']) . '</option>';
        }
     
        $result->free();
    } else {
     
        echo '<option value="0">No categories found</option>';
    }

 
    ?>
   
</select>

                            </div>
                            <div class="col-4">
            <input type="text" id="sub_category_input" class="form-control" placeholder="Enter Sub Category" />
        </div>
        <div class="col-2">
            <button class="btn btn-outline-primary" onclick="saveSubCategory()">Save Category</button>
        </div>
                        </div>
                    </div>
                   </div>
                </div>

            <div class="card mt-2">
                <div class="card-body">
                    <h3 class="header-title">Add Sub  Expence Category 1</h3>

                    <div class="col-12">
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select" id="sub_category1" style="height: 40px;">
    <option value="0">Select Sub Category 1 Type</option>
    <?php
     include 'connection_db.php';
    $sqlcat1 = "SELECT sm_id, sub_categories FROM sub_main_ctegory"; 

    // Execute the query
    $result11 = $db->query($sqlcat1);
    if ($result11) {
        
        while ($row = $result11->fetch_assoc()) {
            echo '<option value="' . $row['sm_id'] . '">' . htmlspecialchars($row['sub_categories']) . '</option>';
        }
     
        $result11->free();
    } else {
     
        echo '<option value="0">No categories found</option>';
    }



    ?>
</select>



                            </div>
                            <div class="col-4">
                            <input type="text" class="form-control" id="catex1"/>
                            </div>

                            <div class="col-2">
                                <button class="btn btn-outline-primary" onclick="savecategory2();">Save Category</button>
                            </div>
                        </div>
                    </div>
                   </div>
                  </div>

            <div class="card mt-2">
                <div class="card-body">
                    <h3 class="header-title">Add Sub Expence Category 2</h3>

                    <div class="col-12">
                    <div class="row">
                        <div class="col-5">
                        <select class="form-select" id="sub_category2" style="height: 40px;">
    <option value="0">Select Sub Category 2 Type</option>
    <?php
     include 'connection_db.php';
    $sqlcat11 = "SELECT sc_id, sub_category_name FROM sub_category1"; 

    // Execute the query
    $result111 = $db->query($sqlcat11);
    if ($result111) {
        
        while ($row = $result111->fetch_assoc()) {
            echo '<option value="' . $row['sc_id'] . '">' . htmlspecialchars($row['sub_category_name']) . '</option>';
        }
     
        $result111->free();
    } else {
     
        echo '<option value="">No categories found</option>';
    }

   


    ?>
</select>
                            </div>
                            <div class="col-4">
                            <input type="text" class="form-control" id="subcat3"/>
                            </div>

                            <div class="col-2">
                                <button class="btn btn-outline-primary" onclick="savecategory3();">Save Category</button>
                            </div>
                        </div>
                    </div>
                   </div>
                  </div>


            <div class="card mt-2">
                <div class="card-body">
                    <h3 class="header-title">Add Sub Expence Category 3</h3>

                    <div class="col-12">
                    <div class="row">
                        <div class="col-5">
                        <select class="form-select" id="sub_category3" style="height: 40px;">
    <option value="0">Select Sub Category 3 Type</option>
    <?php
     include 'connection_db.php';
    $sqlcat11 = "SELECT sc2_id, sub_category2_name FROM sub_category2"; 

    // Execute the query
    $result111 = $db->query($sqlcat11);
    if ($result111) {
        
        while ($row = $result111->fetch_assoc()) {
            echo '<option value="' . $row['sc2_id'] . '">' . htmlspecialchars($row['sub_category2_name']) . '</option>';
        }
     
        $result111->free();
    } else {
     
        echo '<option value="">No categories found</option>';
    }




    ?>
</select>
                            </div>
                            <div class="col-4">
                            <input type="text" id="subcat4" class="form-control" />
                            </div>

                            <div class="col-2">
                                <button class="btn btn-outline-primary" onclick="savecategory4();">Save Category</button>
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

  <!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function addexpences() {
    var mainn_category = document.getElementById("mainn_category").value;
    var mainsubcatt = document.getElementById("mainsubcatt").value;
    var subsCategory = document.getElementById("subsCategory").value;
    var subSubCategory1 = document.getElementById("subSubCategory1").value;
    var subcat111 = document.getElementById("subcat111").value;
    var location = document.getElementById("location").value;
    var employee = document.getElementById("employee").value;
    var paymentMethod = document.getElementById("paymentMethod").value;
    var amount = document.getElementById("amount").value;

    // Validate required fields
    if (mainn_category === "" || amount === "" || employee === "" || paymentMethod === "" || location === "") {
        alert("Please fill in all required fields.");
        return;
    }

    // Create an AJAX request to send the data to the server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_expense.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Prepare the data string
    var params = "maincat_id=" + encodeURIComponent(mainn_category) +
                 "&sub_main_id=" + encodeURIComponent(mainsubcatt) +
                 "&subcat_id=" + encodeURIComponent(subsCategory) +
                 "&sub_cat1_id=" + encodeURIComponent(subSubCategory1) +
                 "&sub_cat2_id=" + encodeURIComponent(subcat111) +
                 "&location=" + encodeURIComponent(location) +
                 "&employee=" + encodeURIComponent(employee) +
                 "&payment_method=" + encodeURIComponent(paymentMethod) +
                 "&amount=" + encodeURIComponent(amount);

    // Handle the response from the server
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert("Expense added successfully.");
            document.getElementById("expenseForm").reset(); // Reset the form after success
        } else {
            alert("Error: " + xhr.responseText);
        }
    };

    // Send the request
    xhr.send(params);
}

function loadsubcatt() {
    // Get the selected main category ID
    var subMainId = document.getElementById("mainsubcatt").value;

    // Ensure a main category is selected
    if (subMainId == "") {
        document.getElementById("subsCategory").innerHTML = '<option value="">Select Sub-Main Category</option>';
        return;
    }

    // Create a new AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'load_sub_category.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Handle the AJAX response
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Update the sub-main category dropdown with the response data
            document.getElementById("subsCategory").innerHTML = xhr.responseText;
        } else {
            console.error('Error loading sub-categories');
        }
    };

    // Send the selected subMainId to the server
    xhr.send('subMainId=' + subMainId);
}

function loadsubcat1(){
    var subcat1= document.getElementById("subsCategory").value;

       // Ensure a main category is selected
       if (subcat1 == "") {
        document.getElementById("subSubCategory1").innerHTML = '<option value="">Select Sub-Main Category</option>';
        return;
    }

    // Create a new AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'load_subsub_category.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Handle the AJAX response
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Update the sub-main category dropdown with the response data
            document.getElementById("subSubCategory1").innerHTML = xhr.responseText;
        } else {
            console.error('Error loading sub-categories');
        }
    };

    // Send the selected subMainId to the server
    xhr.send('subMainId=' + subcat1);

}
function loadsubcat2(){
    var subcat1= document.getElementById("subSubCategory1").value;

// Ensure a main category is selected
if (subcat1 == "") {
 document.getElementById("subcat111").innerHTML = '<option value="">Select Sub-Main Category</option>';
 return;
}

// Create a new AJAX request
var xhr = new XMLHttpRequest();
xhr.open('POST', 'load_subsubsub_category.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

// Handle the AJAX response
xhr.onload = function () {
 if (xhr.status === 200) {
     // Update the sub-main category dropdown with the response data
     document.getElementById("subcat111").innerHTML = xhr.responseText;
 } else {
     console.error('Error loading sub-categories');
 }
};

// Send the selected subMainId to the server
xhr.send('subMainId=' + subcat1);

}

function savemaincategory() {
    // Get the input value
    var mainCategoryName = document.getElementById('main_category_input').value;

    // Debugging: Log the category name to verify it
    console.log('Category Name:', mainCategoryName);

    // Validate input
    if (mainCategoryName === '') {
        alert('Please enter a main category name.');
        return;
    }

    // Create a new FormData object
    var f = new FormData();
    f.append("category_name", mainCategoryName);

    // AJAX request to save the main category
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "saveCategory.php", true);
    // No need to set Content-Type when using FormData; it will be set automatically
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                var response = JSON.parse(this.responseText);

                // Debugging: Log the server response
                console.log('Server Response:', response);

                if (response.status === 'success') {
                    alert('Main category saved successfully!');
                    document.getElementById('main_category_input').value = ''; // Clear the input field
                } else {
                    alert('Error: ' + response.message);
                }
            } else {
                alert('Error: Unable to contact the server.');
            }
        }
    };

    // Send the request with the FormData object
    xhr.send(f);
}

function saveSubCategory() {
    // Get the selected main category ID and the sub-category name
    var mainCategoryId = document.getElementById('main_category_select').value;
    var subCategoryName = document.getElementById('sub_category_input').value;

    // Validate input
    if (mainCategoryId === '' || subCategoryName === '') {
        alert('Please select a main category and enter a sub-category name.');
        return;
    }

    // AJAX request to save the sub-category
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "saveSubCategory.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                var response = JSON.parse(this.responseText);
                if (response.status === 'success') {
                    alert('Sub-category saved successfully!');
                    document.getElementById('sub_category_input').value = ''; // Clear the input field
                    document.getElementById('main_category_select').value = ''; // Reset the dropdown
                } else {
                    alert('Error: ' + response.message);
                }
            } else {
                alert('Error: Unable to contact the server.');
            }
        }
    };

    // S
    xhr.send("main_id=" + encodeURIComponent(mainCategoryId) + "&sub_category=" + encodeURIComponent(subCategoryName));
}
function savecategory2() {
    var subMainId = document.getElementById("sub_category1").value;
    var subCategoryName = document.getElementById("catex1").value;

    if(subMainId == "0" || subCategoryName == "") {
        alert("Please select a sub category type and enter a sub category name.");
        return;
    }

    var formData = new FormData();
    formData.append('sub_main_id', subMainId);
    formData.append('sub_category_name', subCategoryName);

    // Send data to the server via AJAX
    fetch('save_sub_category.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Display response message
        // Optionally clear fields after saving
        document.getElementById("sub_category1").value = "0";
        document.getElementById("catex1").value = "";
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
function savecategory3() {
    var sc1_id = document.getElementById("sub_category2").value;
    var subCategory2Name = document.getElementById("subcat3").value;

    if(sc1_id == "0" || subCategory2Name == "") {
        alert("Please select a sub category 1 and enter a sub category 2 name.");
        return;
    }

    var formData = new FormData();
    formData.append('sc1_id', sc1_id);
    formData.append('sub_category2_name', subCategory2Name);

    // Send data to the server via AJAX
    fetch('save_sub_category2.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Display response message
        // Optionally clear fields after saving
        document.getElementById("sub_category2").value = "0";
        document.getElementById("subcat3").value = "";
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function savecategory4() {
    var sc2_id = document.getElementById("sub_category3").value;
    var subCategory3Name = document.getElementById("subcat4").value;

    if(sc2_id == "0" || subCategory3Name === "") {
        alert("Please select a sub category 2 and enter a sub category 3 name.");
        return;
    }

    var formData = new FormData();
    formData.append('sc2_id', sc2_id);
    formData.append('sub_category3_name', subCategory3Name);

    // Send data to the server via AJAX
    fetch('save_sub_category3.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Display response message
        // Optionally clear fields after saving
        document.getElementById("sub_category3").value = "0";
        document.getElementById("subcat4").value = "";
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
function loadsubmain(){
    var maincat = document.getElementById('mainn_category').value;
    
    if(maincat == "0") {
        // Reset the sub-main category if no main category is selected
        document.getElementById("mainsubcatt").innerHTML = '<option value="">Select Sub-Main Category</option>';
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'load_sub_main_category.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Handle the response
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Update the sub-main category dropdown with the response
            document.getElementById("mainsubcatt").innerHTML = xhr.responseText;
        } else {
            console.error('Error loading sub-main categories');
        }
    };
    
    // Send the request with the selected main category ID
    xhr.send('mainCategoryId=' + maincat);
    
}


    $(document).ready(function() {
        // Load Sub-Main Categories based on Main Category selection
        $('#mainCategory').on('change', function() {
            let mainCategory = $(this).val();
            // Make AJAX call to fetch sub-main categories
            $.ajax({
                url: 'fetch_sub_main_category.php',
                type: 'POST',
                data: { mainCategory: mainCategory },
                success: function(data) {
                    $('#subMainCategory').html(data);
                    $('#subCategory').html('<option value="">Select Sub Category</option>');
                    $('#subSubCategory').html('<option value="">Select Sub-Sub Category</option>');
                }
            });
        });

        // Load Sub Categories based on Sub-Main Category selection
        $('#subMainCategory').on('change', function() {
            let subMainCategory = $(this).val();
            $.ajax({
                url: 'fetch_sub_category.php',
                type: 'POST',
                data: { subMainCategory: subMainCategory },
                success: function(data) {
                    $('#subCategory').html(data);
                    $('#subSubCategory').html('<option value="">Select Sub-Sub Category</option>');
                }
            });
        });

        // Load Sub-Sub Categories based on Sub Category selection
        $('#subCategory').on('change', function() {
            let subCategory = $(this).val();
            $.ajax({
                url: 'fetch_sub_sub_category.php',
                type: 'POST',
                data: { subCategory: subCategory },
                success: function(data) {
                    $('#subSubCategory').html(data);
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