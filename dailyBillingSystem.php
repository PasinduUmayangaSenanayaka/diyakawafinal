<?php
require_once "connection_db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Water Sports Daily Expenses Sheet | Diyakawa</title>

    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="images/logo.png">
</head>

<body onload="onloradFunctions();">
    <div class="container-scroller">
        <?php require "header.php"; ?>
        <?php require "nav_bar.php"; ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <?php
                                    function generateNextCode($lastCode)
                                    {
                                        $prefix = 'BILLNO/';
                                        $number = (int)str_replace($prefix, '', $lastCode);
                                        $nextNumber = $number + 1;

                                        $newCode = $prefix . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

                                        return $newCode;
                                    }

                                    $queryAdminUser = "SELECT * FROM billing_tb ORDER BY job_no DESC LIMIT 1";
                                    $resultAdminUser = $db->query($queryAdminUser);

                                    if ($resultAdminUser) {

                                        if ($resultAdminUser->num_rows != 0) {
                                            $row = $resultAdminUser->fetch_assoc();
                                            $lastCode = $row['job_no'];
                                        } else {
                                            $lastCode = 'BILLNO/000000';
                                        }

                                        $nextCode = generateNextCode($lastCode);
                                    }

                                    ?>

                                    <div class="col-12 col-md-6">
                                        <h1 style="border: none;" class="card-title form-control fs-4"><i class="fa fa-spin fa-cog fs-3"></i> Daily Billing System / Bill No : <input id="billId" style="border: none; width: 230px;" class="fs-3" type="text" disabled value="<?php echo  $nextCode; ?>"></h1>
                                    </div>
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col-6 text-end">
                                                <h5 class="form-control" style="border: none;">Date :</h5>
                                            </div>
                                            <div class="col-6 aling-iteam-end">
                                                <input id="date" class="form-control scleHover" placeholder="Date" type="date">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-12 text-end">
                                        <h1 style="border: none;" class="card-title form-control fs-4">Unpaid Bill : <select onchange="loradUnpaidBillDetails();" id="unpaidDetails" style="border: none; width: 230px;" class="fs-5 text-dark " type="text" value="">
                                                <option value="0">Select</option>
                                                <?php
                                                $queryun = "SELECT * FROM billing_tb WHERE status_paid = ?";
                                                $stmtun = $db->prepare($queryun);

                                                if ($stmtun) {
                                                    $billId = 0;
                                                    $stmtun->bind_param("s", $billId);
                                                    $stmtun->execute();
                                                    $resultun = $stmtun->get_result();
                                                    for ($i = 0; $i < $resultun->num_rows; $i++) {
                                                        $unpaidrow = $resultun->fetch_assoc();
                                                ?>
                                                        <option value="<?php echo $unpaidrow['id']; ?>"><?php echo $unpaidrow['job_no']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select> </h1>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">







                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-12" id="onlordActivedive">


                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title fs-4 fw-bold" style="letter-spacing: 1px;">Bill Details </h4>
                                    <p class="card-description" id="errormassege">

                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">

                                            <tbody id="currencyTableBody">
                                                <tr>
                                                    <th>Custormer Name</th>
                                                    <th>Custormer Mobile</th>
                                                    <th>Custormer Email</th>
                                                    <th>Project</th>
                                                    <th>Location</th>


                                                </tr>

                                                <tr>
                                                    <td>


                                                        <div style="display: inline-block;">
                                                            <div class="dropdown">
                                                                <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterFunction()">
                                                                <div id="dropdownList" class="dropdown-list form-control ">

                                                                    <?php
                                                                    $queryCategory = "SELECT * FROM customer";
                                                                    $resultCategory = $db->query($queryCategory);
                                                                    if ($resultCategory) {
                                                                        for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                            $row = $resultCategory->fetch_assoc();
                                                                    ?>
                                                                            <div onclick="getCustormer(<?php echo $row['id']; ?>)" value="<?php echo $row['id']; ?>" ondblclick="selectOption('<?php echo $row['customer']; ?>')"><?php echo $row['customer']; ?><input id="custormerSearchMobileValue" type="text" value="<?php echo $row['id']; ?>" class="d-none"></div>

                                                                    <?php
                                                                        }
                                                                    } else {
                                                                        echo "Error: " . $db->error;
                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <i id="myBtn" onclick="popupCustoremerAddViwe();" class="fa fa-plus-square fs-4 text-info"></i>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <input id="custormerSearchMobile" class="form-control inpuFieldsBorders" type="text" />
                                                    </td>
                                                    <td>
                                                        <input id="custormerSearchEmail" class="form-control inpuFieldsBorders" type="text" />
                                                    </td>
                                                    <td>
                                                        <Select id="project" class="form-control card-title">

                                                            <?php
                                                            $queryCategory = "SELECT * FROM project_type";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['type']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>
                                                    <td>
                                                        <Select id="location" class="form-control card-title">

                                                            <?php
                                                            $queryCategory = "SELECT * FROM location";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['location']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>



                                                </tr>

                                                <tr>
                                                    <th>Passengers</th>
                                                    <th>Tour NO</th>
                                                    <th>Tour Type</th>
                                                    <th>Bill Method</th>
                                                    <th>Bill Status</th>

                                                </tr>

                                                <tr>
                                                    <td>
                                                        <input id="pxg" class="form-control inpuFieldsBorders" type="text" />
                                                    </td>
                                                    <td>
                                                        <input id="tourno" class="form-control inpuFieldsBorders" type="text" />
                                                    </td>
                                                    <td>
                                                        <Select id="tourtype" class="form-control card-title">

                                                            <?php
                                                            $queryCategory = "SELECT * FROM traverler_type";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['type']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>
                                                    <td>
                                                        <Select id="billmethod" class="form-control card-title">

                                                            <?php
                                                            $queryCategory = "SELECT * FROM payment_method";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['payment_method']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>
                                                    <td>
                                                        <Select id="billstatus" class="form-control card-title">

                                                            <?php
                                                            $queryCategory = "SELECT * FROM billing_status";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>


                                                </tr>


                                                <tr>


                                                    <th>Company</th>
                                                    <th>Vender Name</th>
                                                    <th>Operater</th>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <Select id="company" class="form-control card-title">

                                                            <?php
                                                            $queryCategory = "SELECT * FROM company";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>
                                                    <td>
                                                        <Select id="vender" class="form-control card-title">


                                                            <?php
                                                            $queryCategory = "SELECT * FROM vendor";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['vender_name']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>
                                                    <td>
                                                        <Select id="operater" class="form-control card-title">


                                                            <?php
                                                            $queryCategory = "SELECT * FROM operator";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['officer_name']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>
                                                </tr>



                                            </tbody>
                                        </table>



                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Item Listing</h4>
                                    <p class="card-description">

                                    </p>
                                    <div class="table-responsive">

                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th>Quntity</th>
                                                    <th>Rate</th>
                                                    <th>Cost</th>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <Select id="product" class="form-control card-title">
                                                            <?php
                                                            $queryCategory = "SELECT * FROM product";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['code']; ?>"><?php echo $row['code']; ?> - <?php echo $row['prduct_name']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>
                                                    <td>
                                                        <input onkeyup="calculateValu();" id="qty" value="0" class="form-control inpuFieldsBorders text-end" type="text" />
                                                    </td>
                                                    <td>
                                                        <input onkeyup="calculateValu();" id="rate" value="0" class="form-control inpuFieldsBorders text-end" type="text" />
                                                    </td>
                                                    <td>
                                                        <input id="totalValueData" value="0.00" class="form-control inpuFieldsBorders text-end" type="text" disabled />
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                        <br>
                                        <br>
                                        <div class="text-end">
                                            <button onclick="addRowIteamListings()" class="btn btn-info">Add Row</button>
                                        </div>

                                        <br><br>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <script>

                            function calculateValuDiscountWith(rowIndex) {
                               
                                let qty = parseFloat(document.getElementById(`qty${rowIndex}`).value);
                                let rate = parseFloat(document.getElementById(`rate${rowIndex}`).value);
                                let discountPercentage = parseFloat(document.getElementById(`dicountPresentage${rowIndex}`).value);

                                let total = qty * rate;
                                let discountValue = (total * discountPercentage) / 100;
                                document.getElementById(`discount${rowIndex}`).value = discountValue.toFixed(2);
                                let totalAfterDiscount = total - discountValue;
                                document.getElementById(`totalValue${rowIndex}`).value = totalAfterDiscount.toFixed(2);
                            }

                            let rowaddIteamListing = 0;

                            function addRowIteamListings() {



                                var product = document.getElementById("product").value;
                                var qty = document.getElementById("qty").value;
                                var rate = document.getElementById("rate").value;

                                let total = 0;
                                total = qty * rate;

                                rowaddIteamListing++;


                                const newRow = `
                <tr>
                    <td><i onclick="deleteRow(this)" class="fa fa-trash-o fs-5 text-danger"></i></td>
                    <td>
                        <input name="product" value="${product}" class="form-control inpuFieldsBorders" type="text" />
                    </td>                                                
                    <td>
                        <input name="qty" onkeyup="calculateValuDiscountWith(${rowaddIteamListing})" id="qty${rowaddIteamListing}" value="${qty}" class="form-control inpuFieldsBorders" type="number" />
                    </td>
                    <td>
                        <input name="rate" onkeyup="calculateValuDiscountWith(${rowaddIteamListing})" id="rate${rowaddIteamListing}" value="${rate}" class="form-control inpuFieldsBorders" type="text" />
                    </td>

                  
                    <td>
                        <input name="discount" onkeyup="calculateValuDiscountWith(${rowaddIteamListing})" id="dicountPresentage${rowaddIteamListing}"  value="0.00" class="form-control inpuFieldsBorders" type="text" />
                    </td>
                    <td>
                        <input name="" readonly id="discount${rowaddIteamListing}" value="0.00" class="form-control inpuFieldsBorders" type="text" />
                    </td>                                              

                      <td>
                        <Select name="currencyNameId" id="currencyToIteamSelect${rowaddIteamListing}" onchange="currencyCalculate(${rowaddIteamListing});" class="form-control card-title">
                            
                            <?php

                            $queryCategory = "SELECT * FROM currency";
                            $resultCategory = $db->query($queryCategory);
                            if ($resultCategory) {

                            ?>

<?php

                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                    $row = $resultCategory->fetch_assoc();
?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['currencyName']; ?></option>
                            <?php
                                }
                            } else {
                                echo "Error: " . $db->error;
                            }

                            ?>

                        </Select>
                    </td>
                    <td>
                        <input name="" value="${total}" id="currencyRate${rowaddIteamListing}" class="form-control inpuFieldsBorders" type="text" />
                    </td>

                    <td>
                        <input id="totalValue${rowaddIteamListing}" value="${total}" class="form-control inpuFieldsBorders" type="text" disabled />
                    </td>                                               
                   
                </tr>
`;

                                document
                                    .getElementById("iteamListingTableBody")
                                    .insertAdjacentHTML("beforeend", newRow);



                                if (rowaddIteamListing == 1) {
                                    deleteRow(document.getElementById("firstRow"));
                                }
                                countRows();
                                document.getElementById("product").selectOption = 0;
                                document.getElementById("qty").value = "0";
                                document.getElementById("rate").value = '0';
                                document.getElementById("totalValueData").value = "0.00";
                            }

                            let rowaddIteamListingunpaid = 0;

                            function addRowIteamListingUnpaid() {

                                var productunpaid = document.getElementById("productunpaid").value;
                                var qtyunpaid = document.getElementById("qtyupaid").value;
                                var rateunpaid = document.getElementById("rateunpaid").value;
                                let totalunpaid = 0;
                                let finaltotalunpaid = 0;
                                totalunpaid = qtyunpaid * rateunpaid;
                                $finaltotalunpaid = 0;

                                rowaddIteamListingunpaid++;


                                const newRow = `
                                            <tr>
                                                <td><i onclick="deleteRow(this)" class="fa fa-trash-o fs-5 text-danger"></i></td>
                                                <td>
                                                    <input name="productunpaid" value="${productunpaid}" class="form-control inpuFieldsBorders" type="text" />
                                                    <input type="hidden" name="hiddenPID" id="hiddenPID" class="d-none" value="0" />                                                   
                                                </td>                                                
                                                <td>
                                                    <input name="qtyunpaid" onkeyup="calculateValuDiscountWith(${rowaddIteamListingunpaid})" id="qty${rowaddIteamListingunpaid}" value="${qtyunpaid}" class="form-control inpuFieldsBorders" type="number" />
                                                </td>
                                                <td>
                                                    <input name="rateunpaid" onkeyup="calculateValuDiscountWith(${rowaddIteamListingunpaid})" id="rate${rowaddIteamListingunpaid}" value="${rateunpaid}" class="form-control inpuFieldsBorders" type="text" />
                                                </td>

                                              
                                                <td>
                                                    <input name="discountunpaid" onkeyup="calculateValuDiscountWith(${rowaddIteamListingunpaid})" id="dicountPresentage${rowaddIteamListingunpaid}"  value="0.00" class="form-control inpuFieldsBorders" type="text" />
                                                </td>
                                                <td>
                                                    <input name="" readonly id="discount${rowaddIteamListingunpaid}" value="0.00" class="form-control inpuFieldsBorders" type="text" />
                                                </td>                                              

                                                  <td>
                                                    <Select name="currencyunpaid" id="currencyToIteamSelect${rowaddIteamListingunpaid}" onchange="currencyCalculate(${rowaddIteamListingunpaid});" class="form-control card-title">
                                                        
                                                        <?php

                                                        $queryCategory = "SELECT * FROM currency";
                                                        $resultCategory = $db->query($queryCategory);
                                                        if ($resultCategory) {

                                                        ?>

<?php

                                                            for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                $row = $resultCategory->fetch_assoc();
?>
                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['currencyName']; ?></option>
                                                        <?php
                                                            }
                                                        } else {
                                                            echo "Error: " . $db->error;
                                                        }

                                                        ?>

                                                    </Select>
                                                </td>
                                                <td>
                                                    <input name="" value="${totalunpaid}" id="currencyRate${rowaddIteamListingunpaid}" class="form-control inpuFieldsBorders" type="text" disabled />
                                                </td>

                                                <td>
                                                    <input id="totalValue${rowaddIteamListingunpaid}" value="${totalunpaid}" class="form-control inpuFieldsBorders" type="text" disabled />
                                                </td>                                               
                                               
                                            </tr>
                            `;

                                document
                                    .getElementById("iteamListingTableBodyUnpaid")
                                    .insertAdjacentHTML("beforeend", newRow);


                                if (rowaddIteamListing == 1) {
                                    deleteRow(document.getElementById("firstRow"));
                                }

                                document.getElementById("productunpaid").selectOption = 0;
                                document.getElementById("qtyupaid").value = "0";
                                document.getElementById("rateunpaid").value = "0";
                                document.getElementById("totalValueData").value = "";
                            }











                            // ?????


                            function discountadd() {
                                var discountPresentage = document.getElementById("dicountPresentage").value;
                                var total = document.getElementById("totalValue").value;

                            }
                        </script>


                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Item Code</th>
                                                    <th>Quntity</th>
                                                    <th>Rate</th>
                                                    <th>Discount %</th>
                                                    <th>Discount</th>
                                                    <th>Currency</th>
                                                    <th>Currency Rate</th>
                                                    <th>Total ( LKR )</th>


                                                </tr>
                                            </thead>
                                            <tbody id="iteamListingTableBody">


                                                <tr readonly id="firstRow">
                                                    <td><i onclick="deleteRow(this)" class="fa fa-trash-o fs-5 text-danger"></i></td>
                                                    <td>
                                                        <input readonly class="form-control inpuFieldsBorders" type="text" />
                                                    </td>
                                                    <td>
                                                        <input class="form-control inpuFieldsBorders" type="number" />
                                                    </td>
                                                    <td>
                                                        <input class="form-control inpuFieldsBorders" type="text" />
                                                    </td>

                                                    <td>
                                                        <input class="form-control inpuFieldsBorders" type="text" />
                                                    </td>

                                                    <td>
                                                        <input class="form-control inpuFieldsBorders" type="text" />
                                                    </td>
                                                    <td>
                                                        <Select class="form-control card-title">

                                                            <?php
                                                            $queryCategory = "SELECT * FROM currency";
                                                            $resultCategory = $db->query($queryCategory);
                                                            if ($resultCategory) {
                                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                                    $row = $resultCategory->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['currencyName']; ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Error: " . $db->error;
                                                            }

                                                            ?>

                                                        </Select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control inpuFieldsBorders" type="text" />
                                                    </td>

                                                    <td>
                                                        <input class="form-control inpuFieldsBorders" type="text" disabled />
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>




                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-12 text-end " style="display: inline-block;">
                                        <button style="display: inline-block;" onclick="saveUnpaidFunction();" class="btn btn-danger text-end  ">Unpaid</button>
                                        <button style="display: inline-block;" onclick="saveUnpaidFunction();" class="btn btn-success text-end d-none ">Save Unpaid Data</button>
                                        <button style="display: inline-block;" onclick="saveFunction();" class="btn btn-info text-end  ">Save Data</button>


                                    </div>


                                    <br><br>

                                </div>
                            </div>

                        </div>

                        <script>
                            function countRows() {
                                var tableBody = document.getElementById("iteamListingTableBody");
                                var rowCount = tableBody.getElementsByTagName("tr").length;
                                console.log("Number of rows:", rowCount);
                                var pcount = document.getElementById("totalProjectCount");
                                pcount.value = rowCount;
                            }
                            countRows();
                        </script>




                        <div class="col-lg-12 grid-margin stretch-card d-none">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>Project Count</th>
                                                    <th>Amount</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input class="form-control" id="totalProjectCount" type="text"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>




                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body text-end">
                                    <button onclick="window.location = 'commission.php';" class="btn btn-dark">Go to Commission</button>
                                </div>
                            </div>
                        </div>

                        
                        

                    </div>

                    <div class="col-12 d-none" id="onlordInactiveDiv">

                    </div>


                </div>

            </div>

        </div>

    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="js/dailyBillingSystem.js"></script>

    <div id="popupCustormerRegister" class="modal">

        <div class="modal-content px-5">
            <span class="close">&times;</span>
            <br>
            <hr>
            <h3>Custormer Registration</h3>
            <br>

            <hr>

            <br>
            <p id="errorMsgs" class="text-danger">
                <br>
            <form class="forms-sample">
                <?php
                function generateNextCodes($lastCode)
                {
                    $prefix = 'CUID/';
                    $number = (int)str_replace($prefix, '', $lastCode);
                    $nextNumber = $number + 1;

                    $newCode = $prefix . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

                    return $newCode;
                }

                $queryAdminUser = "SELECT * FROM customer ORDER BY code DESC LIMIT 1";
                $resultAdminUser = $db->query($queryAdminUser);

                if ($resultAdminUser) {

                    if ($resultAdminUser->num_rows != 0) {
                        $row = $resultAdminUser->fetch_assoc();
                        $lastCode = $row['code'];
                    } else {
                        $lastCode = 'CUID/000000';
                    }

                    $nextCode = generateNextCodes($lastCode);
                }

                ?>

                <div class="form-group">
                    <label for="exampleInputName1">Custormer ID</label>
                    <input type="text" class="form-control scleHover" value="<?php echo $nextCode; ?>" id="custormerId" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Custormer Name</label>
                    <input type="text" class="form-control scleHover" id="custoermerName" placeholder="Custormer Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Custormer Mobile Number</label>
                    <input type="text" class="form-control scleHover" id="custoermerMobile" placeholder="Custormer Mobile Number">
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Custormer Email</label>
                    <input type="text" class="form-control scleHover" id="custoermerAddress" placeholder="Custormer Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Custormer Country</label>
                    <Select id="custormerCountry" class="form-control card-title">
                        <option value="">Select</option>
                        <?php
                        $querycountry = "SELECT * FROM country";
                        $resultcountry = $db->query($querycountry);
                        if ($resultcountry) {
                            for ($i = 0; $i < $resultcountry->num_rows; $i++) {

                                $rowcountry = $resultcountry->fetch_assoc();
                        ?>
                                <option value="<?php echo $rowcountry['id']; ?>"><?php echo $rowcountry['country']; ?></option>
                        <?php
                            }
                        } else {
                            echo "Error: " . $db->error;
                        }

                        ?>

                    </Select>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Custormer Contact By</label>
                    <input type="text" class="form-control scleHover" id="custoermerCountactBy" placeholder="Custormer Contact By">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Custormer Category</label>
                    <Select id="custormerCategory" class="form-control card-title">
                        <option value="">Select</option>
                        <?php
                        $queryCategory = "SELECT * FROM customer_category";
                        $resultCategory = $db->query($queryCategory);
                        if ($resultCategory) {
                            for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                $row = $resultCategory->fetch_assoc();
                        ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['category']; ?></option>
                        <?php
                            }
                        } else {
                            echo "Error: " . $db->error;
                        }

                        ?>

                    </Select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Custormer Sub Category</label>
                    <Select id="custormerSubCategory" class="form-control card-title">
                        <option value="">Select</option>
                        <?php
                        $queryCategory = "SELECT * FROM customer_sub_category";
                        $resultCategory = $db->query($queryCategory);
                        if ($resultCategory) {
                            for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                $row = $resultCategory->fetch_assoc();
                        ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['customer_sub_category']; ?></option>
                        <?php
                            }
                        } else {
                            echo "Error: " . $db->error;
                        }

                        ?>

                    </Select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail3">Company Name</label>
                    <Select id="company" class="form-control card-title">
                        <option value="">Select</option>
                        <?php
                        $queryCategory = "SELECT * FROM company";
                        $resultCategory = $db->query($queryCategory);
                        if ($resultCategory) {
                            for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                $row = $resultCategory->fetch_assoc();
                        ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                        <?php
                            }
                        } else {
                            echo "Error: " . $db->error;
                        }

                        ?>

                    </Select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail3">Currency Type</label>
                    <Select id="currency" class="form-control card-title">
                        <option value="">Select</option>
                        <?php
                        $queryCategory = "SELECT * FROM currency";
                        $resultCategory = $db->query($queryCategory);
                        if ($resultCategory) {
                            for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                $row = $resultCategory->fetch_assoc();
                        ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['currencyName']; ?></option>
                        <?php
                            }
                        } else {
                            echo "Error: " . $db->error;
                        }

                        ?>

                    </Select>
                </div>
                <br>
                <div class="text-end">
                    <button onclick="addCustormer()" class="btn btn-success">Add Custormer</button>
                </div>
                <br>
                <br>

            </form>

        </div>
    </div>
    <script>
        var modal = document.getElementById("popupCustormerRegister");
        var btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>