// const currencyOptions = [
//   {
//     id: 1,
//     currencyName: "USD",
//   },
//   {
//     id: 2,
//     currencyName: "EUR",
//   },
//   {
//     id: 3,
//     currencyName: "INR",
//   },
//   {
//     id: 4,
//     currencyName: "LKR",
//   },
// ];

// function addCurrencyRow() {
//   const row = currencyTable.insertRow();
//   const currencyCell = row.insertCell(0);
//   const amountCell = row.insertCell(1);
//   const actionCell = row.insertCell(2);

//   // Create a dropdown for currency selection
//   const select = document.createElement("select");
//   select.name = "currency";
//   currencyOptions.forEach((option) => {
//     const opt = document.createElement("option");
//     opt.value = option.id;
//     opt.textContent = option.currencyName;
//     select.appendChild(opt);
//   });
//   currencyCell.appendChild(select);

//   // Create an input for the amount
//   const amountInput = document.createElement("input");
//   amountInput.type = "number";
//   amountInput.name = "amount";
//   amountInput.placeholder = "Enter amount";
//   amountCell.appendChild(amountInput);

//   // Create a remove button for the row
//   const removeBtn = document.createElement("button");
//   removeBtn.textContent = "Remove";
//   removeBtn.type = "button";
//   removeBtn.classList.add("remove-btn");
//   removeBtn.onclick = () => currencyTable.deleteRow(row.rowIndex - 1); // Remove row
//   actionCell.appendChild(removeBtn);
// }

// function addRows() {
//   const tableBody = document.getElementById("currencyTableBody");

//   const newRow = document.createElement("tr");

//   // Define the content of the new row
//   newRow.innerHTML = `
//         <td>
//             <select class="form-control">
//                 <option value="">Select</option>

//                                                       `

//   var req = new XMLHttpRequest();

//   req.onreadystatechange = function () {
//     if (req.readyState == 4 && req.status == 200) {
//       // alert(req.responseText);
//       document.getElementById("loradDetails").innerHTML = req.responseText;

//     }
//   };
//   req.open("GET", "currencyLoard.php", true);
//   req.send();

//   `
//             </select>
//         </td>
//         <td><input class="form-control text-end" placeholder="00.00" type="number"></td>
//         <td><input class="form-control text-end" placeholder="00.00" type="number"></td>
//         <td><i class="fa fa-trash-o fs-5 text-danger" onclick="deleteRow(this)"></i></td>
//     `;

//   // Append the new row to the table
//   tableBody.appendChild(newRow);
// }

function deleteRow(element) {
  element.closest("tr").remove();
}

function onloradFunctions() {
  addRow();
  addRowcashOut();
  addemployeeDataRow();
  addSalaryDetailsRow();
  const dateInput = document.getElementById("date");
  const today = new Date();
  const formattedDate = today.toISOString().split("T")[0];
  dateInput.value = formattedDate;

  addIncomeRow();
  addExpenseRow();
}
// let rowCount = 0;

// function addRow() {
//   const tableBody = document.getElementById("currencyTableBody");
//   const template = document.getElementById("currencyRowTemplate");
//   rowCount++;

//   // Clone the template content and append it as a new row
//   const newRow = template.content.cloneNode(true);
//   tableBody.appendChild(newRow);
// }

// function deleteRowcurrency(element) {
//     const row = element.closest('tr');
//     row.remove();
//     updateGrandTotal();  // Recalculate the grand total after row deletion
// }

// function addRowcashOut() {
//   const tableBody = document.getElementById("cashoutTableBody");
//   const template = document.getElementById("cashoutRowTemplate");

//   // Clone the template content and append it as a new row
//   const newRow = template.content.cloneNode(true);
//   tableBody.appendChild(newRow);
// }

// function addIncomeRow() {
//   const tableBody = document.getElementById("incomeTableBody");
//   const template = document.getElementById("incomeTemplateBody");

//   // Clone the template content and append it as a new row
//   const newRow = template.content.cloneNode(true);
//   tableBody.appendChild(newRow);
// }

// function addSalaryDetailsRow() {
//   const tableBody = document.getElementById("SalaryDetailTableBody");
//   const template = document.getElementById("salaryDetailsTempalate");
//   const newRow = template.content.cloneNode(true);
//   tableBody.appendChild(newRow);
// }

// function addExpenseRow() {
//   const tableBody = document.getElementById("expenseTableBody");
//   const template = document.getElementById("expensesTempletBody");
//   const newRow = template.content.cloneNode(true);
//   tableBody.appendChild(newRow);
// }

function addemployeeDataRow() {
  const tableBody = document.getElementById("employeeTableBody");
  const template = document.getElementById("employeeTemplateBody");
  const newRow = template.content.cloneNode(true);
  tableBody.appendChild(newRow);
}

// function calculateTotal(i) {
//     var i = i;
//   var exchangeRate = parseFloat(document.getElementById("exchangeRate"+i).value);
//   var ammount = parseFloat(document.getElementById("ammount"+i).value);
//   var total = exchangeRate * ammount;

//   // Display the result in the <span> tag
//   document.getElementById("total").value = total
//     ? total.toFixed(2)
//     : "0.00";
// }

// function calculateTotal(i) {
//     const exchangeRate = parseFloat(document.getElementById("exchangeRate" + i).value) || 0;
//     const amount = parseFloat(document.getElementById("ammount" + i).value) || 0;
//     const rowTotal = exchangeRate * amount;

//     // Display the row total
//     document.getElementById("rowTotal" + i).textContent = rowTotal.toFixed(2);

//     // Update the grand total
//     updateGrandTotal();
// }

// function updateGrandTotal() {
//     let grandTotal = 0;

//     // Get all the row total spans
//     const rowTotals = document.querySelectorAll("[id^='rowTotal']");

//     // Sum all row totals
//     rowTotals.forEach(function (rowTotalSpan) {
//         grandTotal += parseFloat(rowTotalSpan.textContent) || 0;
//     });

//     // Update the grand total input
//     document.getElementById("total").value = grandTotal.toFixed(2);
// }

let rowCount = 0;

function calculateRowTotal(rowId) {
  const exchangeRate =
    parseFloat(document.getElementById(`exchangeRate${rowId}`).value) || 0;
  const amount =
    parseFloat(document.getElementById(`amount${rowId}`).value) || 0;
  const rowTotal = exchangeRate * amount;
  document.getElementById(`rowTotal${rowId}`).textContent = rowTotal.toFixed(2);

  updateGrandTotal();
}

function updateGrandTotal() {
  let grandTotal = 0;

  const rowTotals = document.querySelectorAll("[id^='rowTotal']");
  rowTotals.forEach((rowTotal) => {
    grandTotal += parseFloat(rowTotal.textContent) || 0;
  });

  document.getElementById("grandTotal").value = grandTotal.toFixed(2);
}
function deleteRow(element) {
  const row = element.closest("tr");
  row.remove();
  updateGrandTotal();
}

function updateCashOutTotal() {
  let totalCashOut = 0;

  const amounts = document.querySelectorAll('[id^="rowTotalcashOut"]');
  amounts.forEach(function (amount) {
    totalCashOut += parseFloat(amount.value) || 0;
  });

  document.getElementById("totalCashOut").value = totalCashOut.toFixed(2);
}

function updateCIncomeAmountTotal() {
  let rowCountinvoce = 0;

  const amounts = document.querySelectorAll('[id^="rowTotala"]');
  amounts.forEach(function (amount) {
    rowCountinvoce += parseFloat(amount.value) || 0;
  });

  document.getElementById("totalAmountInvoice").value =
    rowCountinvoce.toFixed(2);
}

function updateCommitionAmountTotal() {
  let rowCommitioninvoce = 0;

  const amounts = document.querySelectorAll('[id^="rowTotalcommition"]');
  amounts.forEach(function (amount) {
    rowCommitioninvoce += parseFloat(amount.value) || 0;
  });

  document.getElementById("totalCommitionInvoice").value =
    rowCommitioninvoce.toFixed(2);
}

function updateProfitAmountTotal() {
  let rowProfitinvoce = 0;

  const amounts = document.querySelectorAll('[id^="rowTotali"]');
  amounts.forEach(function (amount) {
    rowProfitinvoce += parseFloat(amount.value) || 0;
  });

  document.getElementById("totalProfitInvoice").value =
    rowProfitinvoce.toFixed(2);
}

function updateAddExpenseRow() {
  let rowExpense = 0;

  const amounts = document.querySelectorAll('[id^="expense"]');
  amounts.forEach(function (amount) {
    rowExpense += parseFloat(amount.value) || 0;
  });

  document.getElementById("totalExpense").value = rowExpense.toFixed(2);
}

function updaterowSalaryRow() {
  let rowSalary = 0;

  const amounts = document.querySelectorAll('[id^="salary"]');
  amounts.forEach(function (amount) {
    rowSalary += parseFloat(amount.value) || 0;
  });

  document.getElementById("totalSalary").value = rowSalary.toFixed(2);
}

function saveData() {
  const rows = document.querySelectorAll("#cashoutTableBody tr");
  let data = [];
  const date = document.getElementById("date").value; // Get the date value here

  rows.forEach((row) => {
    const jobNo = row.querySelector('input[name="job_no"]').value;
    const description = row.querySelector('input[name="description"]').value;
    const empName = row.querySelector('select[name="emp_name"]').value;
    const purpose = row.querySelector('select[name="expence"]').value;
    const amount = row.querySelector('input[name="amount"]').value;

    if (jobNo && description && empName && amount) {
      data.push({
        job_no: jobNo,
        description: description,
        emp_id: empName,
        purpose_id: purpose,
        amount: amount,
        date_cash_out: date,
      });
    }
  });

  if (data.length > 0) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "saveCashOut.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
        alert("Data saved successfully");

        document.getElementById("cashoutTableBody").innerHTML = "";
        document.getElementById("totalCashOut").value = "0.00";
        addRowcashOut();
      }
    };
    xhr.send(JSON.stringify(data));
  } else {
    document.getElementById("cardDescriptioncashou").innerHTML =
      "Please fill out all fields before saving.";
  }
}

function saveTableData() {
  let tableData = [];

  const rows = document.querySelectorAll("#currencyTableBody tr");
  const date = document.getElementById("date").value;

  rows.forEach(function (row, index) {
    const currency = row.querySelector("select").value;
    const exchangeRate = parseFloat(
      row.querySelector(`#exchangeRate${index + 1}`).value
    );
    const amount = parseFloat(row.querySelector(`#amount${index + 1}`).value);

    if (currency && exchangeRate && amount) {
      tableData.push({
        currency: currency,
        exchangeRate: exchangeRate,
        amount: amount,
        date: date,
      });
    }
  });

  if (tableData.length > 0) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "saveCurrency.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        alert("Data saved successfully!");

        document.getElementById("currencyTableBody").innerHTML = "";
        document.getElementById("grandTotal").value = "0.00";
        addRow();
      }
    };

    xhr.send(JSON.stringify({ data: tableData }));
  } else {
    document.getElementById("cardDescriptioncurrency").innerHTML =
      "Please fill in all fields before saving.";
  }
}

function saveSalaryDetails() {
  // Collect all data from the table
  let salaryDetails = [];
  let rows = document.querySelectorAll("#SalaryDetailTableBody tr");

  rows.forEach(function (row) {
    let empName = row.querySelector(".empName").value;
    let amount = row.querySelector(".salaryAmount").value;
    let reason = row.querySelector(".reason").value;

    // Ensure the row is not empty
    if (empName && amount && reason) {
      salaryDetails.push({
        empName: empName,
        amount: parseFloat(amount),
        reason: reason,
      });
    }
  });

  if (salaryDetails.length > 0) {
    fetch("saveSalaryDetails.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(salaryDetails),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Data saved successfully!");
        } else {
          alert("Failed to save data.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred.");
      });
  } else {
    alert("No data to save.");
  }
}


function leaveStatusEnable(id) {
  var id = id;
  
  var chekedStatus = document.getElementById("checkBox"+id);
  var inputFeild = document.getElementById("status"+id);

  if (chekedStatus.checked) {
    inputFeild.disabled = true;
  } else {
    inputFeild.disabled = false;
  }
}