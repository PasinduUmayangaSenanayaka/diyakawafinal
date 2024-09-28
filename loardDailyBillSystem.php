<?php
session_start();

require "connection_db.php";

if (isset($_POST)) {
    $id = $_POST['id'];
    if (empty($username)) {
        echo "Please enter username.";
    }

    $queryCategory = "SELECT * FROM customer";
    $resultCategory = $db->query($queryCategory);
    if ($resultCategory) {
        for ($i = 0; $i < $resultCategory->num_rows; $i++) {

            $row = $resultCategory->fetch_assoc();
?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['customer']; ?></option>
    <?php
        }
    } else {
        echo "Error: " . $db->error;
    }
        ?>
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
                                        <Select id="custormerSearchMobileValue" onchange="getCustormer()" style="display: inline-block; width: 250px;" class="form-control card-title">
                                            <option value="0">Select</option>
                                            <?php
                                            $queryCategory = "SELECT * FROM customer";
                                            $resultCategory = $db->query($queryCategory);
                                            if ($resultCategory) {
                                                for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                    $row = $resultCategory->fetch_assoc();
                                            ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['customer']; ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "Error: " . $db->error;
                                            }

                                            ?>

                                        </Select> <i id="myBtn" onclick="popupCustoremerAddViwe();" class="fa fa-plus-square fs-4 text-info"></i>
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
                                    <input onkeyup="calculateValu();" id="qty" class="form-control inpuFieldsBorders" type="text" />
                                </td>
                                <td>
                                    <input onkeyup="calculateValu();" id="rate" class="form-control inpuFieldsBorders" type="text" />
                                </td>
                                <td>
                                    <input id="totalValueData" class="form-control inpuFieldsBorders" type="text" disabled />
                                </td>

                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <br>
                    <div class="text-end">
                        <button onclick="addRowIteamListing()" class="btn btn-info">Add Row</button>
                    </div>

                    <br><br>

                </div>
            </div>
        </div>
    </div>


    <script>
        let rowaddIteamListing = 0;



        function addRowIteamListing() {

            var product = document.getElementById("product").value;
            var qty = document.getElementById("qty").value;
            var rate = document.getElementById("rate").value;
            var currencyRateSelect = document.getElementById("currencyToIteamSelect").value;
            var currencyRate = document.getElementById("currencyRate").value;

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

            document.getElementById("product").value = 0;
            document.getElementById("currencyToIteamSelect").value = 0;
            document.getElementById("qty").value = "";
            document.getElementById("rate").value = '';
            document.getElementById("currencyToIteamSelect").value = 0;
            document.getElementById("currencyRate").value = "";
            document.getElementById("totalValueData").value = "";
        }

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
                                <th>Total</th>


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
                    <button style="display: inline-block;" onclick="saveUnpaidFunction();" class="btn btn-success text-end  ">Save Unpaid Data</button>
                    <button style="display: inline-block;" onclick="saveFunction();" class="btn btn-info text-end  ">Save Data</button>


                </div>


                <br><br>

            </div>
        </div>
    </div>


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Commission Method Operator</h4>
                <p class="card-description">

                </p>
                <div class="table-responsive">

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Operator</th>
                                <th>Amount</th>
                                <th>Guide</th>
                                <th>Amount</th>
                                <th>Driver</th>
                                <th>Vehicle No.</th>
                                <th>Amount</th>
                                <th>Total</th>
                                <th></th>
                            </tr>

                            <tr>
                                <td>
                                    <Select id="product" class="form-control card-title">
                                        <option value="0">Select</option>
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
                                <td>
                                    <input onkeyup="calculateValu();" id="qty" class="form-control inpuFieldsBorders" type="text" />
                                </td>
                                <td>
                                    <input onkeyup="calculateValu();" id="rate" class="form-control inpuFieldsBorders" type="text" />
                                </td>
                                <td>
                                    <input id="w" class="form-control inpuFieldsBorders" type="text" disabled />
                                </td>
                                <td>
                                    <Select onchange="currencyCalculate();" id="currencyToIteamSelect" class="form-control card-title">
                                        <option value="">Select</option>
                                        <?php
                                        $queryCategory = "SELECT * FROM driver";
                                        $resultCategory = $db->query($queryCategory);
                                        if ($resultCategory) {
                                            for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                $row = $resultCategory->fetch_assoc();
                                        ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['driver_name']; ?></option>
                                        <?php
                                            }
                                        } else {
                                            echo "Error: " . $db->error;
                                        }

                                        ?>

                                    </Select>
                                </td>
                                <td>
                                    <input id="w" class="form-control inpuFieldsBorders" type="text" />
                                </td>
                                <td>
                                    <input id="w" class="form-control inpuFieldsBorders" type="text" />
                                </td>

                                <td><i onclick="deleteRow(this)" class="fa fa-trash-o fs-5 text-danger"></i></td>

                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <br>
                    <div class="text-end">
                        <button onclick="addRowOperaterCommision()" class="btn btn-info">Add Row</button>
                    </div>

                    <br><br>

                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Commission Method Vender</h4>
                <p class="card-description">

                </p>
                <div class="table-responsive">

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Operator</th>
                                <th>Amount</th>
                                <th>Guide</th>
                                <th>Amount</th>
                                <th>Driver</th>
                                <th>Amount</th>
                                <th>Total</th>
                                <th></th>
                            </tr>

                            <tr>
                                <td>
                                    <Select id="product" class="form-control card-title">
                                        <option value="0">Select</option>
                                        <?php
                                        $queryCategory = "SELECT * FROM product";
                                        $resultCategory = $db->query($queryCategory);
                                        if ($resultCategory) {
                                            for ($i = 0; $i < $resultCategory->num_rows; $i++) {

                                                $row = $resultCategory->fetch_assoc();
                                        ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['code']; ?> - <?php echo $row['prduct_name']; ?></option>
                                        <?php
                                            }
                                        } else {
                                            echo "Error: " . $db->error;
                                        }

                                        ?>

                                    </Select>
                                </td>
                                <td>
                                    <input onkeyup="calculateValu();" id="qty" class="form-control inpuFieldsBorders" type="text" />
                                </td>
                                <td>
                                    <input onkeyup="calculateValu();" id="rate" class="form-control inpuFieldsBorders" type="text" />
                                </td>
                                <td>
                                    <input id="totalValueData" class="form-control inpuFieldsBorders" type="text" disabled />
                                </td>
                                <td>
                                    <Select onchange="currencyCalculate();" id="currencyToIteamSelect" class="form-control card-title">
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
                                </td>
                                <td>
                                    <input id="currencyRate" class="form-control inpuFieldsBorders" type="text" />
                                </td>
                                <td>
                                    <input id="currencyRate" class="form-control inpuFieldsBorders" type="text" />
                                </td>

                                <td><i onclick="deleteRow(this)" class="fa fa-trash-o fs-5 text-danger"></i></td>

                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <br>
                    <div class="text-end">
                        <button onclick="addRowVenderCommission()" class="btn btn-info">Add Row</button>
                    </div>

                    <br><br>

                </div>
            </div>
        </div>
    </div>




    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Commission</th>
                                <th>Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
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

<?php
}
?>