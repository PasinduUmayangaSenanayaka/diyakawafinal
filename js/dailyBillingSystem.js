// function deleteRow(element) {
//   element.closest("tr").remove();
// }

function onloadFunctions() {
  const dateInput = document.getElementById("date");
  
  // Create a date object for the current date
  const today = new Date();

  // Convert to Sri Lanka time (UTC +5:30)
  const sriLankanTime = new Date(today.toLocaleString("en-US", { timeZone: "Asia/Colombo" }));

  // Format the date as YYYY-MM-DD
  const formattedDate = sriLankanTime.toISOString().split("T")[0];
  dateInput.value = formattedDate;

  // Call your additional functions
  // addRow();
  // addRowcashOut();
  // addIncomeRow();
  // addExpenseRow();
  // addSalaryDetailsRow();
  // addemployeeDataRow();
  loadCashOutData();
}
function loadCashOutData() {
  const selectedDate = document.getElementById("searchDate").value;
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `load_cashout_data.php?date=${selectedDate}`, true);

  xhr.onload = function () {
      if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          const tableBody = document.getElementById("cashoutTableBody");
          tableBody.innerHTML = ""; // Clear previous data

          if (response.length > 0) {
              response.forEach(item => {
                  const row = `
                  <tr>
                      <td>${item.job_no}</td>
                      <td>${item.purpose}</td>
                      <td>${item.description}</td>
                      <td>${item.emp_name}</td>
                      <td>${item.amount}</td>
                      <td><i onclick="deleteRowcashOut(${item.id})" class="fa fa-trash-o fs-5 text-danger"></i></td>
                  </tr>
                  `;
                  tableBody.insertAdjacentHTML("beforeend", row);
              });
          } else {
              // Handle case where no data is found for the selected date
              tableBody.innerHTML = "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
          }
      } else {
          Swal.fire('Error', 'Failed to load cash-out data. Try again.', 'error');
      }
  };

  xhr.send();
}


function addemployeeDataRow() {
  const tableBody = document.getElementById("employeeTableBody");
  const template = document.getElementById("employeeTemplateBody");
  const newRow = template.content.cloneNode(true);
  tableBody.appendChild(newRow);
}

// let rowCount = 0;

// function calculateRowTotal(rowId) {
//   const exchangeRate =
//     parseFloat(document.getElementById(`exchangeRate${rowId}`).value) || 0;
//   const amount =
//     parseFloat(document.getElementById(`amount${rowId}`).value) || 0;
//   const rowTotal = exchangeRate * amount;
//   document.getElementById(`rowTotal${rowId}`).textContent = rowTotal.toFixed(2);

//   updateGrandTotal();
// }

// function updateGrandTotal() {
//   let grandTotal = 0;

//   const rowTotals = document.querySelectorAll("[id^='rowTotal']");
//   rowTotals.forEach((rowTotal) => {
//     grandTotal += parseFloat(rowTotal.textContent) || 0;
//   });

//   document.getElementById("grandTotal").value = grandTotal.toFixed(2);
// }
// function deleteRow(element) {
//   const row = element.closest("tr");
//   row.remove();
//   updateGrandTotal();
// }

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
  const date = document.getElementById("date").value;

  rows.forEach((row) => {
      const jobNo = row.querySelector('input[name="job_no"]').value;
      const description = row.querySelector('input[name="description"]').value || null; // Allow null
      const empName = row.querySelector('select[name="emp_name"]').value;
      const purpose = row.querySelector('select[name="expence"]').value;
      const amount = row.querySelector('input[name="amount"]').value;

      if (jobNo && purpose && empName && amount) {
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
    console.log("Data being sent to the server:", data); // Log the data before sending
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
      alert("Please fill out all fields before saving.");
  }
}

// function saveTableData() {

//   alert("dhi");
//   let tableData = [];

//   const rows = document.querySelectorAll("#currencyTableBody tr");
//   const date = document.getElementById("date").value;

//   rows.forEach(function (row, index) {
//     const currency = row.querySelector("select").value;
//     const exchangeRate = parseFloat(
//       row.querySelector(`#exchangeRate${index + 1}`).value
//     );
//     const amount = parseFloat(row.querySelector(`#amount${index + 1}`).value);

//     if (currency && exchangeRate && amount) {
//       tableData.push({
//         currency: currency,
//         exchangeRate: exchangeRate,
//         amount: amount,
//         date: date,
//       });
//     }
//   });

//   if (tableData.length > 0) {
//     const xhr = new XMLHttpRequest();
//     xhr.open("POST", "saveCurrency.php", true);
//     xhr.setRequestHeader("Content-Type", "application/json");

//     xhr.onreadystatechange = function () {
//       if (xhr.readyState === 4 && xhr.status === 200) {
//         alert("Data saved successfully!");

//         document.getElementById("currencyTableBody").innerHTML = "";
//         document.getElementById("grandTotal").value = "0.00";
//         addRow();
//       }
//     };

//     xhr.send(JSON.stringify({ data: tableData }));
//   } else {
//     alert("Please fill in all fields before saving.");
//   }
// }

function saveSalaryDetails() {
  let salaryDetails = [];
  let rows = document.querySelectorAll("#SalaryDetailTableBody tr");

  rows.forEach(function (row) {
    let empName = row.querySelector(".empName").value;
    let amount = row.querySelector(".salaryAmount").value;
    let reason = row.querySelector(".reason").value;

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

function addCustormer() {

  var custormerId = document.getElementById("custormerId").value;
  var custoermerName = document.getElementById("custoermerName").value;
  var custoermerMobile = document.getElementById("custoermerMobile").value;
  var custoermerAddress = document.getElementById("custoermerAddress").value;
  var custormerCountry = document.getElementById("custormerCountry").value;
  var custoermerCountactBy = document.getElementById("custoermerCountactBy").value;
  var custormerCategory = document.getElementById("custormerCategory").value;
  var custormerSubCategory = document.getElementById("custormerSubCategory").value;
  var company = document.getElementById("company").value;
  var currency = document.getElementById("currency").value;

  var f = new FormData();
  f.append("custormerId", custormerId);
  f.append("custoermerName", custoermerName);
  f.append("custoermerMobile", custoermerMobile);
  f.append("custoermerAddress", custoermerAddress);
  f.append("custormerCountry", custormerCountry);
  f.append("custoermerCountactBy", custoermerCountactBy);
  f.append("custormerCategory", custormerCategory);
  f.append("custormerSubCategory", custormerSubCategory);
  f.append("company", company);
  f.append("currency", currency);

  var x = new XMLHttpRequest();

  x.onreadystatechange = function () {
    if (x.readyState === 4 && x.status === 200) {

      if (x.responseText == "success") {
        alert("Data saved successfully !");
        window.location.reload();
      } else {
        document.getElementById("errorMsgs").innerText = x.responseText;
      }

    }
  };

  x.open("POST", "saveCustormerData.php", true);
  x.send(f);
}

function getCustormer() {
  getCustormerMobile();
  getCustormereMAIL();

}

function getCustormerMobile() {

  var mobile = document.getElementById("custormerSearchMobileValue").value;

  var f = new FormData();
  f.append("mobile", mobile);

  var x = new XMLHttpRequest();

  x.onreadystatechange = function () {
    if (x.readyState === 4 && x.status === 200) {
      document.getElementById("custormerSearchMobile").value = x.responseText;
    }
  };

  x.open("POST", "searchCustormerMobileNumber.php", true);
  x.send(f);

}

function getCustormereMAIL() {

  var mobile = document.getElementById("custormerSearchMobileValue").value;

  var f = new FormData();
  f.append("mobile", mobile);

  var x = new XMLHttpRequest();

  x.onreadystatechange = function () {
    if (x.readyState === 4 && x.status === 200) {
      document.getElementById("custormerSearchEmail").value = x.responseText;
    }
  };

  x.open("POST", "searchCustormeReMAIL.php", true);
  x.send(f);

}

function calculateValu() {
  let quentity = 0;
  let rate = 0;
  let total = 0;


  var qty = document.getElementById("qty").value;
  var ratedata = document.getElementById("rate").value;
  var totalvalue = document.getElementById("totalValueData");

  if (qty != null) {
    quentity = qty;
  }

  if (ratedata != null) {
    rate = ratedata;
  }

  total = rate * quentity;
  totalvalue.value = total;
}

function calculateValuDiscountWith(id) {
  var id = id;
  let quentity = 0;
  let rate = 0;
  let total = 0;
  let discount = 0;
  let disountValue = 0;


  var qty = document.getElementById("qty" + id).value;
  var ratedata = document.getElementById("rate" + id).value;
  var discounts = document.getElementById("dicountPresentage" + id).value;
  var totalvalue = document.getElementById("totalValue" + id);
  var discountvalues = document.getElementById("discount" + id);

  if (qty != null) {
    quentity = qty;
  }

  if (ratedata != null) {
    rate = ratedata;
  }

  if (discounts != null) {
    discount = discounts;
  }

  total = rate * quentity;
  total = total - (total * discount / 100);
  disountValue = total * discount / 100;
  totalvalue.value = total;
  discountvalues.value = disountValue;
}

function currencyCalculate(id) {
  var id = id;
  var currency = document.getElementById("currencyToIteamSelect" + id).value;
  var total = document.getElementById("totalValue" + id).value;

  var f = new FormData();
  f.append("currency", currency);

  var x = new XMLHttpRequest();

  x.onreadystatechange = function () {
    if (x.readyState === 4 && x.status === 200) {
      // document.getElementById("currencyRate").value = x.responseText;

      total = total / x.responseText;
      document.getElementById("currencyRate" + id).value = total;

    }
  };

  x.open("POST", "currencyCalculation.php", true);
  x.send(f);
}

function saveFunction() {
  saveIteamListing();
  custormerDataUpdate();
  saveData();
}

function saveUnpaidFunction() {
  saveIteamListingUnpaid();
  custormerDataUpdate();
  saveData();
}

function saveIteamListingUnpaid() {

  var cid = document.getElementById("custormerSearchMobileValue").value;
  var project = document.getElementById("project").value;
  var location = document.getElementById("location").value;
  var pxg = document.getElementById("pxg").value;
  var tourno = document.getElementById("tourno").value;
  var tourtype = document.getElementById("tourtype").value;
  var billmethod = document.getElementById("billmethod").value;
  var billstatus = document.getElementById("billstatus").value;
  var company = document.getElementById("company").value;
  var vender = document.getElementById("vender").value;
  var operater = document.getElementById("operater").value;
  var billId = document.getElementById("billId").value;
  var date = document.getElementById("date").value;

  var form = new FormData();

  form.append("billId", billId);
  form.append("date", date);
  form.append("cid", cid);
  form.append("project", project);
  form.append("location", location);
  form.append("pxg", pxg);
  form.append("tourno", tourno);
  form.append("tourtype", tourtype);
  form.append("billmethod", billmethod);
  form.append("billstatus", billstatus);
  form.append("company", company);
  form.append("vender", vender);
  form.append("operater", operater);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState === 4 && req.status === 200) {

      if (req.responseText == "success") {

      } else {
        alert(req.responseText);
      }

    }
  };

  req.open("POST", "addBillUnPayiedData.php", true);
  req.send(form)

}

function saveIteamListing() {

  var cid = document.getElementById("custormerSearchMobileValue").value;
  var project = document.getElementById("project").value;
  var location = document.getElementById("location").value;
  var pxg = document.getElementById("pxg").value;
  var tourno = document.getElementById("tourno").value;
  var tourtype = document.getElementById("tourtype").value;
  var billmethod = document.getElementById("billmethod").value;
  var billstatus = document.getElementById("billstatus").value;
  var company = document.getElementById("company").value;
  var vender = document.getElementById("vender").value;
  var operater = document.getElementById("operater").value;
  var billId = document.getElementById("billId").value;
  var date = document.getElementById("date").value;

  var form = new FormData();

  form.append("billId", billId);
  form.append("date", date);
  form.append("cid", cid);
  form.append("project", project);
  form.append("location", location);
  form.append("pxg", pxg);
  form.append("tourno", tourno);
  form.append("tourtype", tourtype);
  form.append("billmethod", billmethod);
  form.append("billstatus", billstatus);
  form.append("company", company);
  form.append("vender", vender);
  form.append("operater", operater);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState === 4 && req.status === 200) {

      if (req.responseText == "success") {

      } else {
        alert(req.responseText);
      }

    }
  };

  req.open("POST", "addBillPayiedData.php", true);
  req.send(form)

}

function custormerDataUpdate() {
  var cid = document.getElementById("custormerSearchMobileValue").value;
  var cmobile = document.getElementById("custormerSearchMobile").value;
  var cemail = document.getElementById("custormerSearchEmail").value;

  var f = new FormData();
  f.append("cid", cid);
  f.append("cmobile", cmobile);
  f.append("cemail", cemail);

  var x = new XMLHttpRequest();

  x.onreadystatechange = function () {
    if (x.readyState === 4 && x.status === 200) {

    }
  };

  x.open("POST", "updateCustormerData.php", true);
  x.send(f);

}

function saveData() {
  const rows = document.querySelectorAll("#iteamListingTableBody tr");
  let data = [];
  const date = document.getElementById("date").value;
  const billId = document.getElementById("billId").value;

  rows.forEach((row) => {
    const product = row.querySelector('input[name="product"]').value;
    const qty = row.querySelector('input[name="qty"]').value;
    const rate = row.querySelector('input[name="rate"]').value;
    const discount = row.querySelector('input[name="discount"]').value;
    const currency = row.querySelector('select[name="currencyNameId"]').value;

    if (product && qty && rate && discount && currency) {
      data.push({
        product_id: product,
        qty: qty,
        rate: rate,
        discount: discount,
        currency_name_add_id: currency,
        date: date,
        job_no: billId,
      });
    }
  });

  if (data.length > 0) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "addProductListing.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {

        try {
          const response = JSON.parse(xhr.responseText);

          if (response.status === 'success') {
            alert("Bill saved successfully!");
            window.location.reload();
          } else {
            alert(response.message || "An error occurred while saving data.");
          }
        } catch (e) {
          console.error("Failed to parse response:", e);
          alert("An unexpected error occurred.");
        }
      }
    };
    xhr.send(JSON.stringify(data));
  } else {
    document.getElementById("errormassege").innerHTML =
      "Please fill out all fields before saving.";
  }
}

function loradUnpaidBillDetails() {

  var id = document.getElementById("unpaidDetails");
  var loard = document.getElementById("onlordActivedive");
  var unloard = document.getElementById("onlordInactiveDiv");

  loard.classList.add("d-none");
  unloard.classList.remove("d-none");

  var f = new FormData();
  f.append("id", id);

  var x = new XMLHttpRequest();

  x.onreadystatechange = function () {
    if (x.readyState === 4 && x.status === 200) {
      unloard.innerHTML = x.responseText;
    }
  };

  x.open("POST", "loardDailyBillSystem.php", true);
  x.send(f);

}