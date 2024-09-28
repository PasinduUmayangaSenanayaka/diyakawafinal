<?php

session_start();
require_once "connection_db.php";
require_once "currencyLoard.php";

date_default_timezone_set('Asia/Colombo');


$query = "SELECT expence_id, purpose FROM expence_purpose";
$result = $db->query($query);

$expenseOptions = '';
while ($row = $result->fetch_assoc()) {
    $expenseOptions .= '<option value="' . $row['expence_id'] . '">' . $row['purpose'] . '</option>';
}

$currentDate = date('Y-m-d'); // Use selected date or default to today

$query = "SELECT currency_value.id, currency_value.currency, currency_value.exchange_rate, currency_value.amount, currency.currencyName FROM currency_value JOIN currency ON currency.id = currency_value.currency WHERE currency_value.date = '$currentDate'";
$result = $db->query($query);


$totalcurrency = 0;


// Store rows as HTML to be echoed into the table body
$rows = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

            // Correct calculation: Multiply amount by exchange_rate to get the correct total
            $rowTotal = $row['amount'] * $row['exchange_rate'];
            // Add the current row's total to the overall total currency
            $totalcurrency += $rowTotal;
            
        $rows .= "<tr>
                    <td>{$row['currencyName']}</td>
                    <td><input type='number' step='0.01' value='{$row['exchange_rate']}' class='form-control text-end' id='exchangeRate{$row['id']}' oninput='calculateRowTotal({$row['id']})'></td>
                    <td><input type='number' step='0.01' value='{$row['amount']}' class='form-control text-end' id='amount{$row['id']}' oninput='calculateRowTotal({$row['id']})'></td>
                    <td><i class='fa fa-trash-o fs-5 text-danger' onclick='deleteRowcurrency({$row['id']})'></i></td>
                  </tr>";
    }
} else {
    $rows = "<tr><td colspan='4' class='text-center'>No Data Available</td></tr>";
}

$optionsep = '';
$sql3 = "SELECT id, first_name, last_name FROM employee_data"; // Adjust as needed
$resultEmpOptions = $db->query($sql3);
if ($resultEmpOptions->num_rows > 0) {
    while ($empRow = $resultEmpOptions->fetch_assoc()) {
        $optionsep .= "<option value='{$empRow['id']}'>{$empRow['first_name']} {$empRow['last_name']}</option>";
    }
}

$totalcurrencyEX = 0; // Initialize total currency if needed

$rowex = '';

$sql1 = "SELECT cash_out.id, cash_out.job_no, cash_out.description, cash_out.date_cash_out, cash_out.amount, expence_purpose.purpose, expence_purpose.expence_id, cash_out.emp_id, employee_data.first_name, employee_data.last_name
FROM cash_out 
JOIN expence_purpose ON cash_out.purpose_id = expence_purpose.expence_id
JOIN employee_data ON employee_data.id = cash_out.emp_id
WHERE cash_out.date_cash_out = '$currentDate'";
$resulte = $db->query($sql1);

if ($resulte->num_rows > 0) {
    while ($rowe = $resulte->fetch_assoc()) {
        // Correct calculation: Adjust if necessary for exchange rate or any additional logic
        $rowTotale = $rowe['amount']; // Just amount for cash out
         // Add to total currency if needed
         $totalcurrencyEX += $rowTotale; 

        $rowex .= "<tr id='cashoutRow{$rowe['id']}'>
                    <td><input name='job_no' style='min-width: 140px;' class='form-control text-end' type='text' value='{$rowe['job_no']}' placeholder='Job No'></td>
                    <td>
                        <select name='expence' style='min-width: 150px;' class='form-control text-end text-dark'>
                            <option value='{$rowe['expence_id']}'>{$rowe['purpose']}</option>
                            $expenseOptions <!-- Populate from PHP, ensure this is correctly defined -->
                        </select>
                    </td>
                    <td><input name='description' style='min-width: 150px;' class='form-control text-end' type='text' value='{$rowe['description']}' placeholder='Description'></td>
                    <td class='text-danger'>
                        <select name='emp_name' style='min-width: 150px;' class='form-control text-end text-dark'>
                            <option value='{$rowe['emp_id']}'>{$rowe['first_name']} {$rowe['last_name']}</option>
                            $optionsep <!-- Populate employee options -->
                        </select>
                    </td>
                    <td>
                        <input name='amount' style='min-width: 150px;' s class='form-control text-end' type='number' step='0.01' value='{$rowe['amount']}' placeholder='Amount' id='rowTotalcashOut{$rowe['id']}' onchange='updateCashOutTotal()'>
                    </td>
                    <td><i onclick='deleteRowcashOut({$rowe['id']})' class='fa fa-trash-o fs-5 text-danger'></i></td>
                  </tr>";
       
    }
} else {
    $rowex = "<tr><td colspan='6' class='text-center'>No Data Available</td></tr>";
}

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
    <!-- SweetAlert2 CSS (optional for custom styling) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                                                <input type="date" id="date" class="form-control" value="<?php echo $currentDate; ?>">

                                            </div>
                                        </div>


                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cash Balance</h4>
                                <p id="cardDescriptioncurrency" class="text-danger"></p>

                                <!-- Date Picker -->
                                <input type="date" id="date" class="form-control" value="<?php echo $currentDate; ?>" readonly>

                                <div class="table-responsive">
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
                                            <?php echo $rows; ?>
                                          

                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-6">
                                                <button onclick="addRow();" class="btn btn-info">Add Row</button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <button onclick="saveTableDatacurrency();" class="btn btn-info">Save <i class="fa fa-save"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>

                                        <h6 style="border: none;" class="form-control fs-6 text-end">
                                            Total Cash: <input value="Rs. <?php echo $totalcurrency; ?>" id="grandTotal" type="text" disabled>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
    let rowCount = <?php echo $result->num_rows; ?>;

    function addRow() {
        rowCount++;
        const newRow = `
        <tr id="row${rowCount}">
            <td>
                <select class="form-control text-dark">
                    <option value="">Select</option>
                    <?php echo $options; ?>
                </select>
            </td>
            <td><input type="number" class="form-control text-end" id="exchangeRate${rowCount}" oninput="calculateTotal();" step="0.01" placeholder="00.00"></td>
            <td><input type="number" class="form-control text-end" id="amount${rowCount}" oninput="calculateTotal();" step="0.01" placeholder="00.00"></td>
            <td><i class="fa fa-trash-o fs-5 text-danger" onclick="deleteRowcurrency(this)"></i></td>
        </tr>
        `;
        document.getElementById("currencyTableBody").insertAdjacentHTML("beforeend", newRow);
    }

    function calculateTotal() {
        let grandTotal = 0;
        
        // Loop through existing rows to calculate totals
        for (let i = 1; i <= rowCount; i++) {
            const exchangeRate = parseFloat(document.getElementById(`exchangeRate${i}`)?.value) || 0;
            const amount = parseFloat(document.getElementById(`amount${i}`)?.value) || 0;
            grandTotal += exchangeRate * amount;
        }
        
        // Display the total in the grandTotal input
        document.getElementById("grandTotal").value = `Rs. ${grandTotal.toFixed(2)}`;
    }
    function saveTableDatacurrency() {
    var date = document.getElementById("date").value;

    // Prepare data to save
    let tableData = [];
    const rows = document.querySelectorAll("#currencyTableBody tr");

    rows.forEach((row, index) => {
        const currencySelect = row.querySelector("select");
        const exchangeRate = parseFloat(row.querySelector(`input[id^='exchangeRate']`)?.value) || 0;
        const amount = parseFloat(row.querySelector(`input[id^='amount']`)?.value) || 0;
        const id = row.getAttribute('data-id'); // Assuming you have a data-id attribute for existing rows

        // Only save rows that have a selected currency
        if (currencySelect && currencySelect.value) {
            tableData.push({
                id: id, // Include ID to know if we are updating or inserting
                currency: currencySelect.value,
                exchangeRate: exchangeRate,
                amount: amount
            });
        }
    });

    // Make an AJAX request to save the data
    fetch('save_currency_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ date: date, data: tableData }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Data saved successfully!");
            window.location.reload(); // Reload the page to see updated data
        } else {
            alert("Error saving data: " + data.message);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}


function deleteRowcurrency(rowId) {
    // Confirm with the user before deleting
    if (confirm("Are you sure you want to delete this currency?")) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_currency_data.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (xhr.status === 200) {
                    if (xhr.responseText.trim() === "success") {
                        alert("Row deleted successfully.");
                        window.location.reload(); // Reload the page after deletion
                    } else {
                        alert("Error deleting the row: " + xhr.responseText);
                    }
                }
            };

            xhr.onerror = function() {
                alert("Request failed.");
            };

            xhr.send("id=" + rowId);
        }
    
}

</script>


<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cash Out</h4>
            <p id="cardDescriptioncashou" class="text-danger"></p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job No</th>
                            <th>Purpose</th>
                            <th>Description</th>
                            <th>Emp Name</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cashoutTableBody">
                        <?php echo $rowex; ?>
                    </tbody>
                </table>
                <br>
                <div class="col-11">
                    <div class="row">
                        <div class="col-6">
                            <button onclick="addRowcashOut()" class="btn btn-info">Add Row</button>
                        </div>
                        <div class="col-6 text-end">
                            <button onclick="saveDatacashout();" class="btn btn-info">Save <i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </div>
                <br>
                <div>
                    <h6 style="border: none;" class="form-control fs-6 text-end">
                        Total Cash Out: <input type="text" value="Rs. <?php echo $totalcurrencyEX; ?>" id="totalCashOut" disabled>
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let rowCountcashOut = 0;

    // Function to add new cash-out rows
    function addRowcashOut() {
        rowCountcashOut++;
        const newRow = `
        <tr id="cashoutRow${rowCountcashOut}">
            <td><input name="job_no" style='min-width: 140px;' class="form-control text-end" type="text" placeholder="Job No"></td>
            <td>
                <select name="expence" style='min-width: 150px;' class="form-control text-end text-dark">
                    <option value="0">Select Purpose</option>
                    <?php echo $expenseOptions; ?> <!-- Populate from PHP -->
                </select>
            </td>
            <td><input name="description" style='min-width: 150px;' class="form-control text-end" type="text" placeholder="Description"></td>
            <td class="text-danger">
                <select name="emp_name" style='min-width: 150px;'  class="form-control text-end text-dark">
                    <option value="0">Select</option>
                    <?php echo $optionsep; ?>
                </select>
            </td>
            <td>
                <input name="amount" style="min-width: 150px;" class="form-control text-end" type="number" step="0.01" placeholder="Amount" id="rowTotalcashOut${rowCountcashOut}" onchange="updateCashOutTotal()">
            </td>
            <td><i onclick="deleteRowcashOut(this)" class="fa fa-trash-o fs-5 text-danger"></i></td>
        </tr>
        `;
        document.getElementById("cashoutTableBody").insertAdjacentHTML("beforeend", newRow);
    }

    // Function to delete the row from the cash-out table
    function deleteRowcashOut(rowId) {
    // Confirm deletion
    if (confirm("Are you sure you want to delete this row?")) {
        // Create a new AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "deleteCashOut.php", true); // Use the correct path to your PHP script
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Send the rowId to the server
        xhr.send("rowId=" + rowId);

        // Handle the server response
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    // Remove the row from the table
                    window.location.reload();
                    alert(response.message); // Optional: show success message
                    window.location.reload();
                } else {
                    alert(response.message); // Optional: show error message
                }
            }
        };
    }
}


    // Function to update the total cash-out amount
    function updateCashOutTotal() {
        let totalCashOut = 0;
        const amounts = document.querySelectorAll('input[name="amount"]');
        amounts.forEach(input => {
            totalCashOut += parseFloat(input.value) || 0;
        });
        document.getElementById("totalCashOut").value = `Rs. ${totalCashOut.toFixed(2)}`;
    }


    function saveDatacashout() {
    const rows = document.querySelectorAll("#cashoutTableBody tr");
    let cashoutData = [];

    rows.forEach(row => {
        let job_noElement = row.querySelector('input[name="job_no"]');
        let expenceElement = row.querySelector('select[name="expence"]');
        let descriptionElement = row.querySelector('input[name="description"]');
        let emp_nameElement = row.querySelector('select[name="emp_name"]');
        let amountElement = row.querySelector('input[name="amount"]');

        // Ensure elements are not null before trying to access .value
        let job_no = job_noElement ? job_noElement.value : '';
        let expence = expenceElement ? expenceElement.value : '';
        let description = descriptionElement ? descriptionElement.value : '';
        let emp_name = emp_nameElement ? emp_nameElement.value : '';
        let amount = amountElement ? amountElement.value : '';

        console.log(job_no, expence, description, emp_name, amount);

        // Validate that all fields have values
        if (!job_no || expence == "0" || emp_name == "0" || !amount) {
            Swal.fire('Error', 'Please fill all the fields before saving!', 'error');
            return;
        }

        cashoutData.push({ job_no, expence, description, emp_name, amount });
    });

    if (cashoutData.length === 0) {
        Swal.fire('Error', 'No rows to save!', 'error');
        return;
    }

    console.log("Cashout Data: ", cashoutData); // Log the cashout data

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "save_cashout.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText);  // Log the raw response
            const response = JSON.parse(xhr.responseText);

            if (response.success) {
                Swal.fire('Success', 'Cash-out data saved successfully!', 'success');
                document.getElementById("cashoutTableBody").innerHTML = '';
                document.getElementById("totalCashOut").value = 'Rs. 0.00';
                window.location.reload();
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        } else {
            Swal.fire('Error', 'Failed to save cash-out data. Try again.', 'error');
        }
    };

    xhr.send(JSON.stringify(cashoutData));
}



</script>



<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Employee Attendance</h4>
            <p class="card-description"></p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>NIC</th>
                            <th>Employee Attendance</th>
                            <th>Leave Status</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                        <?php
                        // Fetch current date
                        $currentDate = date('Y-m-d'); // Format: YYYY-MM-DD

                        // Fetch employee data
                        $queryemployee = "SELECT * FROM employee_data";
                        $resultemployee = $db->query($queryemployee);

                        if ($resultemployee) {
                            while ($rowemployee = $resultemployee->fetch_assoc()) {
                                $employeeId = $rowemployee['id'];

                                // Check if there is already an attendance record for this employee for the current date
                                $queryAttendance = "SELECT attendance, leave_status FROM attendance 
                                                    WHERE employee_id = ? AND attendance_date = ?";
                                $stmt = $db->prepare($queryAttendance);
                                $stmt->bind_param('is', $employeeId, $currentDate);
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($attendanceStatus, $leaveStatus);

                                // Check if attendance exists
                                $attendanceExists = $stmt->num_rows > 0;
                                if ($attendanceExists) {
                                    $stmt->fetch();
                                } else {
                                    $attendanceStatus = 'absent'; // Default if no record exists
                                    $leaveStatus = ''; // Default leave status
                                }
                                $stmt->close();
                        ?>
                                <tr>
                                    <td>
                                        <h6><?php echo $rowemployee['first_name'] . " " . $rowemployee['last_name']; ?></h6>
                                    </td>
                                    <td>
                                        <h6><?php echo $rowemployee['nic']; ?></h6>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-info">
                                            <input onchange="toggleLeaveStatus(<?php echo $employeeId; ?>)"
                                                id="checkBox<?php echo $employeeId; ?>"
                                                value="<?php echo $employeeId; ?>"
                                                type="checkbox"
                                                <?php echo $attendanceStatus == 'present' ? 'checked' : ''; ?>>
                                            <span class="toggle-slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <select class="form-control text-dark"
                                            name="leave_status"
                                            id="status<?php echo $employeeId; ?>"
                                            <?php echo $attendanceStatus == 'present' ? 'disabled' : ''; ?>>
                                            <option value="">Select Status</option>
                                            <?php
                                            // Fetch leave statuses
                                            $queryleave = "SELECT * FROM leave_status";
                                            $resultleave = $db->query($queryleave);
                                            if ($resultleave) {
                                                while ($rowleave = $resultleave->fetch_assoc()) {
                                            ?>
                                                    <option value="<?php echo $rowleave['status']; ?>"
                                                        <?php echo $rowleave['status'] == $leaveStatus ? 'selected' : ''; ?>>
                                                        <?php echo $rowleave['status']; ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4'>No employees found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="text-end">
                    <button onclick="saveAttendanceData()" class="btn btn-info">Save Attendance</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleLeaveStatus(employeeId) {
        const checkbox = document.getElementById(`checkBox${employeeId}`);
        const leaveStatusDropdown = document.getElementById(`status${employeeId}`);

        leaveStatusDropdown.disabled = checkbox.checked; // Disable if present
    }

    function saveAttendanceData() {
        var date = document.getElementById("date").value;


    
        const rows = document.querySelectorAll('#employeeTableBody tr');
        let attendanceData = [];

        rows.forEach(row => {
            const employeeId = row.querySelector('input[type="checkbox"]').value;
            const isChecked = row.querySelector('input[type="checkbox"]').checked;
            const leaveStatus = row.querySelector('select[name="leave_status"]').value;

            attendanceData.push({
                employee_id: employeeId,
                attendance: isChecked ? 'present' : 'absent',
                leave_status: isChecked ? null : leaveStatus
            });
        });

        // AJAX request to save data to the database
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'saveAttendance.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                alert("Attendance saved successfully");
                window.location.reload();
            }
        };
        xhr.send(JSON.stringify(attendanceData));
    }
</script>






                </div>

            </div>

        </div>





    </div>

    <script>
    

    
    </script>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="js/dailyexpencesshet.js"></script>

</body>

</html>