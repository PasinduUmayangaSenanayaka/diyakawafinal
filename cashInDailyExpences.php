<?php

session_start();
require_once "connection_db.php";
require_once "currencyLoard.php";

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

    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="images/logo.png">
</head>

<body onload="onloradFunctions()">
    <div class="container-scroller">

        <?php require "header.php" ?>
        <?php require "nav_bar.php"; ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6" style="justify-content: space-between;">
                                        <h1 style="border: none;" class="card-title form-control fs-4"><i class="fa fa-spin fa-cog fs-3"></i> Day Start Process : DEX/00105</h1>

                                    </div>
                                    <div class="col-6">
                                        <div class="row text-end">
                                            <div class="col-6 text-end">
                                                <h4 class="form-control fs-6" style="border: none;">Date :</h4>
                                            </div>
                                            <div class="col-6 aling-iteam-end">
                                                <input class="form-control scleHover" id="date" placeholder="Date" type="date">
                                            </div>
                                        </div>


                                    </div>
                                    <!-- <div class="col-12 text-end">
                                        <button class="btn btn-dark">Reset <i class="fa fa-save"></i></button>
                                        <button class="btn btn-danger">Delete <i class="fa fa-save"></i></button>
                                    </div> -->
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cash Balance</h4>
                                <p id="cardDescriptioncurrency" class="text-danger">

                                </p>
                                <?php
                                ?>
                                <div class="table-responsive">

                                    <!-- Table to hold the dynamically added rows -->
                                    <table class="table" id="currencyTable">
                                        <thead>
                                            <tr>
                                                <th>Currency</th>
                                                <th>Exchange Rate</th>
                                                <th>Amount</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="currencyTableBody">
                                            <!-- Rows will be added dynamically here -->
                                        </tbody>
                                    </table>

                                    <br>
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-6">
                                                <button onclick="addRow();" class="btn btn-info">Add Row</button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <button onclick="saveTableData();" class="btn btn-info">save <i class="fa fa-save"></i></button>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <div>
                                        <h6 style="border: none;" class="form-control fs-6 text-end">
                                            Total Cash  (LKR) : <input id="grandTotal" type="text" disabled>
                                        </h6>
                                    </div>

                                    <script>
                                        function addRow() {
                                            rowCount++;

                                            const newRow = `
                                                <tr>
                                                    <td>
                                                        <select class="form-control text-dark">
                                                            <option value="">Select</option>
                                                            <?php echo $options; ?>
                                                        </select>
                                                    </td>
                                                    <td><input oninput="calculateRowTotal(${rowCount})" class="form-control text-end" placeholder="00.00" id="exchangeRate${rowCount}" type="number" step="0.01"></td>
                                                    <td><input oninput="calculateRowTotal(${rowCount})" class="form-control text-end" placeholder="00.00" id="amount${rowCount}" type="number" step="0.01"></td>
                                                    <span class="d-none" id="rowTotal${rowCount}">0.00</span>
                                                    <td><i class="fa fa-trash-o fs-5 text-danger" onclick="deleteRow(this)"></i></td>
                                                </tr>
                                            `;

                                            document
                                                .getElementById("currencyTableBody")
                                                .insertAdjacentHTML("beforeend", newRow);
                                        }
                                    </script>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cash Out</h4>
                                <p id="cardDescriptioncashou" class="text-danger">

                                </p>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Job No</th>
                                                <th>Description</th>
                                                <th>Emp Name</th>
                                                <th>Amount</th>
                                                <th></th>
                                            </tr>
                                        </thead>


                                        <?php

                                        ?>

                                        <tbody id="cashoutTableBody">

                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-6">
                                                <button onclick="addRowcashOut()" class="btn btn-info">Add Row</button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <button onclick="saveData();" class="btn btn-info">save <i class="fa fa-save"></i></button>
                                            </div>
                                        </div>

                                    </div>


                                    <br>
                                    <div>
                                        <h6 style="border: none;" class="form-control fs-6 text-end">
                                            Total Cash Out (LKR): <input type="text" id="totalCashOut" disabled>
                                        </h6>

                                    </div>

                                    <script>
                                        let rowCountcashOut = 0;

                                        function addRowcashOut() {
                                            rowCountcashOut++;
                                            const newRow = `
                                                <tr>
                                                    <td><input name="job_no" class="form-control text-end" type="text" placeholder="Job No"></td>
                                                    <td><input name="description" class="form-control text-end" type="text" placeholder="Description"></td>
                                                    <td class="text-danger">
                                                        <select name="emp_name" style="min-width: 150px;" class="form-control text-end  text-dark">
                                                            <option value="0">Select</option>
                                                            <?php echo $optionsep; ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input name="amount" style="min-width: 150px;" class="form-control text-end" type="number" step="0.01" placeholder="Amount" id="rowTotalcashOut${rowCountcashOut}" onchange="updateCashOutTotal()">
                                                    </td>
                                                    <td><i onclick="deleteRow(this)" class="fa fa-trash-o fs-5 text-danger"></i></td>
                                                </tr>
                                            `;
                                            document.getElementById("cashoutTableBody").insertAdjacentHTML("beforeend", newRow);
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Employee Attendence</h4>
                                <p class="card-description">

                                </p>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>NIC</th>
                                                <th>Employee Attendence</th>

                                            </tr>
                                        </thead>

                                        <template id="employeeTemplateBody">
                                            <?php
                                            $queryemployee = "SELECT * FROM employee_data";
                                            $resultemployee = $db->query($queryemployee);

                                            if ($resultemployee) {
                                                while ($rowemployee = $resultemployee->fetch_assoc()) {

                                            ?>
                                                    <tr>
                                                        <td>
                                                            <h6><?php echo $rowemployee['first_name'];
                                                                echo " ";
                                                                echo $rowemployee['last_name']; ?></h6>
                                                        </td>
                                                        <td>
                                                            <h6><?php echo $rowemployee['nic']; ?></h6>
                                                        </td>
                                                        <td class="">
                                                            <label class="toggle-switch toggle-switch-info">
                                                                <input id="" value="<?php echo $rowemployee['id']; ?>"
                                                                    type="checkbox" checked>
                                                                <span class="toggle-slider round"></span>
                                                            </label>
                                                        </td>
                                                        <!-- <td><i class="fa fa-trash-o fs-5 text-danger" onclick="deleteRow(this)"></i></td> -->
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </template>

                                        <tbody id="employeeTableBody">
                                        </tbody>
                                    </table>
                                    <br><br><br>
                                    <div class="text-end">
                                        <button onclick="addemployeeDataRow()" class="btn btn-info">Save Attendence</button>
                                    </div>
                                    <br><br>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Salary Advanced Payments</h4>
                                <p class="card-description">

                                </p>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Emp Name</th>
                                                <th>Amount</th>
                                                <th>Reason</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody id="SalaryDetailTableBody">

                                        </tbody>
                                    </table>

                                    <script>
                                        let rowSalary = 0;

                                        function addSalaryDetailsRow() {
                                            rowSalary++;

                                            const newRow = `

                                            <tr>
                                                <td>
                                                    <select class="form-control text-end text-dark" name="" id="">
                                                        <option>Select</option>
                                                        <?php echo $optionsep ?>
                                                    </select>
                                                </td>
                                                <td><input class="form-control text-end" id="salary${rowSalary}" onchange="updaterowSalaryRow();" type="number" name="" id=""></td>
                                                <td><input class="form-control text-end" type="text" name="" id=""></td>
                                                <td><i class="fa fa-trash-o fs-5 text-danger" onclick="deleteRow(this)"></i></td>
                                            </tr>

                                            `;

                                            document
                                                .getElementById("SalaryDetailTableBody")
                                                .insertAdjacentHTML("beforeend", newRow);
                                        }
                                    </script>


                                    <br>
                                    <button onclick="addSalaryDetailsRow();" class="btn btn-info">Add Row</button>

                                    <br>
                                    <div>
                                        <h6 style="border: none;" class="form-control fs-6 text-end">
                                            Salary Amount : <input type="text" id="totalSalary" disabled>
                                        </h6>

                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="js/dailyexpencesshet.js"></script>

</body>

</html>