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
                                        <h1 style="border: none;" class="card-title form-control fs-4"><i class="fa fa-spin fa-cog fs-3"></i> Daily Expenses - Create : DEX/00105</h1>
                                        
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
                                    <div class="col-12 text-end">
                                    <button onclick="saveTableData();" class="btn btn-info">save <i class="fa fa-save"></i></button>
                                        <button class="btn btn-dark">Reset <i class="fa fa-save"></i></button>
                                        <button class="btn btn-danger">Delete <i class="fa fa-save"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cash Balance</h4>
                                <p class="card-description">

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
                                    <button onclick="addRow();" class="btn btn-info">Add Row</button>

                                    <br>
                                    <div>
                                        <h6 style="border: none;" class="form-control fs-6 text-end">
                                            Total Cash: <input id="grandTotal" type="text" disabled>
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
                                <p class="card-description">

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
                                    <button onclick="addRowcashOut()" class="btn btn-info">Add Row</button>

                                    <br>
                                    <div>
                                        <h6 style="border: none;" class="form-control fs-6 text-end">
                                            Total Cash Out: <input type="text" id="totalCashOut" disabled>
                                        </h6>

                                    </div>

                                    <script>
                                        let rowCountcashOut = 0;

                                        // Function to add a new row
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
                                <h4 class="card-title">Income</h4>
                                <p class="card-description"></p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Job No
                                                </th>
                                                <th>
                                                    Product Category
                                                </th>
                                                <th>
                                                    Company Name
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Country
                                                </th>
                                                <th>
                                                    PAX No
                                                </th>
                                                <th>
                                                    Currency
                                                </th>
                                                <th>
                                                    Pay.Type
                                                </th>
                                                <th>
                                                    Amount
                                                </th>
                                                <th>
                                                    +
                                                </th>
                                                <th>
                                                    Total
                                                </th>
                                                <th>
                                                    Vendor
                                                </th>
                                                <th>
                                                    Comm. Type
                                                </th>
                                                <th>
                                                    Commission
                                                </th>
                                                <th>
                                                    +
                                                </th>
                                                <th>
                                                    Profit
                                                </th>
                                                <th>
                                                    +
                                                </th>
                                                <th>
                                                    bin
                                                </th>
                                            </tr>
                                        </thead>

                                        <?php


                                        ?>

                                        <tbody id="incomeTableBody">

                                        </tbody>
                                    </table>

                                    <script>
                                        let rowCountinvoce = 0;
                                        let rowCommitioninvoce = 0;
                                        let rowProfitinvoce = 0;

                                        // Function to add a new row
                                        function addIncomeRow() {
                                            rowCountinvoce++;
                                            rowCommitioninvoce++;
                                            rowProfitinvoce++;
                                            const newRow = `
<tr>

                                                <td>
                                                    <input style="min-width: 100px;" class="form-control" type="text" name="" id="">
                                                </td>
                                                <td>
                                                    <select class="form-control  text-dark">
                                                        <option value="">Select</option>
                                                        <?php echo $optionsproduct; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control  text-dark">
                                                        <option value="">Select</option>
                                                        <?php echo $optionscompany; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control  text-dark"  style="min-width: 110px;">
                                                        <option value="">Select</option>
                                                        <?php echo $optionsstatus; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control  text-dark"  style="min-width: 150px;">
                                                        <option value="">Select</option>
                                                        <?php echo $optionscountry; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="" id=""  style="min-width: 100px;" >
                                                </td>
                                                <td>
                                                    <select class="form-control  text-dark">
                                                        <option value="">Select</option>
                                                        <?php echo $options; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control  text-dark">
                                                        <option value="">Select</option>
                                                        <?php echo $optionspaymentMethod; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="min-width: 150px;" class="form-control text-end" type="number" name="" id="rowTotala${rowCountinvoce}" onchange="updateCIncomeAmountTotal()">
                                                </td>
                                                <td>
                                                    <i class="fa fa-plus-square fs-4 text-info"></i>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="number" name="" id=""  style="min-width: 150px;"  disabled>
                                                </td>
                                                <td>
                                                    <select class="form-control  text-dark"  style="min-width: 150px;">
                                                        <option value="">Select</option>
                                                        <?php echo $optionsvendor; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control text-dark"  style="min-width: 200px;">
                                                        <option value="">Select</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="min-width: 150px;" class="form-control text-end" type="number" name="" id="rowTotalcommition${rowCommitioninvoce}" onchange="updateCommitionAmountTotal()">
                                                </td>
                                                <td>
                                                    <i class="fa fa-plus-square fs-4 text-info"></i>
                                                </td>
                                                <td>
                                                    <input style="min-width: 150px;" class="form-control text-end" type="number" name="" id="rowTotali${rowProfitinvoce}" onchange="updateProfitAmountTotal()">
                                                </td>
                                                <td>
                                                    <i class="fa fa-plus-square fs-4 text-info"></i>
                                                </td>
                                                <td>
                                                    <i class="fa fa-trash-o fs-4 text-danger" onclick="deleteRow(this)"></i>
                                                </td>
                                            </tr>
                                        `;
                                            document.getElementById("incomeTableBody").insertAdjacentHTML("beforeend", newRow);
                                        }
                                    </script>

                                </div>


                                <br>
                                <button onclick="addIncomeRow();" class="btn btn-info">Add Row</button>

                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <div>
                                            <h6 style="border: none;" class="form-control fs-6 text-center">
                                                Tolatl Amount
                                            </h6><input id="totalAmountInvoice" class="form-control" type="text" disabled>
                                        </div>


                                    </div>
                                    <div class="col-4">
                                        <h6 style="border: none;" class="form-control fs-6 text-center">
                                            Tolatl Commission
                                        </h6><input id="totalCommitionInvoice" class="form-control" type="text" disabled>

                                    </div>
                                    <div class="col-4">
                                        <h6 style="border: none;" class="form-control fs-6 text-center">
                                            Tolatl Profit
                                        </h6><input id="totalProfitInvoice" class="form-control" type="text" disabled>

                                    </div>
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



                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Expense</h4>
                                <p class="card-description">

                                </p>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Job No</th>
                                                <th>Description</th>
                                                <th>Unit</th>
                                                <th>Expense Category</th>
                                                <th>Payment Method</th>
                                                <th>Amount</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <template id="expensesTempletBody">

                                        </template>
                                        <tbody id="expenseTableBody">

                                        </tbody>
                                    </table>


                                    <script>
                                        let rowExpense = 0;

                                        function addExpenseRow() {
                                            rowExpense++;

                                            const newRow = `

                                            <tr>
                                                <td><input class="form-control text-end" type="text" name="" id=""></td>
                                                <td><input class="form-control text-end" type="text" name="" id=""></td>
                                                <td><input class="form-control text-end" type="text" name="" id=""></td>
                                                <td class="text-danger text-center">
                                                    <i class="fa fa-plus-square fs-4 text-info text-center"></i>
                                                </td>
                                                <td class="text-danger">
                                                    <select class="form-control text-end text-dark" name="" id="">
                                                        <option>Select</option>
                                                        <?php echo $optionspaymentMethod; ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input class="form-control text-end" type="number" min="0" name="" id="expense${rowExpense}" onchange="updateAddExpenseRow();">
                                                </td>
                                                <td><i class="fa fa-trash-o fs-5 text-danger" onclick="deleteRow(this)"></i></td>
                                            </tr>

                                            `;

                                            document
                                                .getElementById("expenseTableBody")
                                                .insertAdjacentHTML("beforeend", newRow);
                                        }
                                    </script>

                                    <br>
                                    <button onclick="addExpenseRow()" class="btn btn-info">Add Row</button>

                                    <br>
                                    <div>
                                        <h6 style="border: none;" class="form-control fs-6 text-end">
                                            Tolatl Expense : <input id="totalExpense" type="text" disabled>
                                        </h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Emp Detail</h4>
                                <p class="card-description">

                                </p>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Emp Name</th>
                                                <th>Leave Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <template id="employeeTemplateBody">
                                            <tr>
                                                <td>
                                                    <select class="form-control text-end text-dark" name="" id="">
                                                        <option>Select</option>
                                                        <?php echo $optionsep; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control text-end text-dark" name="" id="">
                                                        <option>Employee</option>
                                                    </select>
                                                </td>
                                                <td><i class="fa fa-trash-o fs-5 text-danger" onclick="deleteRow(this)"></i></td>
                                            </tr>

                                        </template>

                                        <tbody id="employeeTableBody">

                                        </tbody>
                                    </table>
                                    <br>
                                    <button onclick="addemployeeDataRow()" class="btn btn-info">Add Row</button>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Salary Details</h4>
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



                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>LKR</th>
                                                <th>USD</th>
                                                <th>INR</th>
                                                <th>DINNAR</th>
                                                <th>DIRHAMS</th>
                                                <th>EURO</th>
                                                <th>LKR Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sales</td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>

                                            </tr>
                                            <tr>
                                                <td>Expenses</td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                            </tr>
                                            <tr>
                                                <td>Profit</td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                            </tr>
                                            <tr>
                                                <td>Open Cash Balance</td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                            </tr>
                                            <tr>
                                                <td>Close Cash Balance</td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                                <td><input type="text" class="text-end form-control" disabled value="0.00"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Income</h4>
                                <p class="card-description">

                                </p>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Payment Method
                                                </th>
                                                <th>
                                                    Payment Method
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Pay Cash</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Bill</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Paid Cash Voucher</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Bank Transfer</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Credit card </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Free</td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table class="table ">

                                    <tbody>
                                        <tr>
                                            <td>
                                                Total Sales
                                            </td>
                                            <td>
                                                <input type="text" class="text-end form-control" value="0.00" id="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Total Expenses
                                            </td>
                                            <td>
                                                <input type="text" class="text-end form-control" value="0.00" id="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Profit
                                            </td>
                                            <td>
                                                <input type="text" class="text-end form-control" value="0.00" id="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Open Cash Balance
                                            </td>
                                            <td>
                                                <input type="text" class="text-end form-control" value="0.00" id="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Close Cash Balance
                                            </td>
                                            <td>
                                                <input type="text" class="text-end form-control" value="0.00" id="">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
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