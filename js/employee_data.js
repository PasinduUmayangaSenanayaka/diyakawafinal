function addCategory() {
  var category = document.getElementById("category").value;
  var description = document.getElementById("categorydescription").value;

  var form = new FormData();

  form.append("category", category);
  form.append("description", description);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var text = req.responseText;
      if (text == "success") {
        alert("Category successfully added.");
        window.location.reload();
      } else {
        document.getElementById("massegecategory").innerHTML = text;
      }
    }
  };
  req.open("POST", "employeecategoryregister.php", true);
  req.send(form);
}

function addEmployee() {
  var employeeid = document.getElementById("employeeid").value;
  var employeefirstname = document.getElementById("employee_firstname").value;
  var employeelastname = document.getElementById("employee_lastname").value;
  var employeenic = document.getElementById("employeenic").value;
  var mobile = document.getElementById("mobile").value;
  var category = document.getElementById("categorySelect").value;

  var form = new FormData();

  form.append("employeeid", employeeid);
  form.append("employeefirstname", employeefirstname);
  form.append("employeelastname", employeelastname);
  form.append("employeenic", employeenic);
  form.append("mobile", mobile);
  form.append("category", category);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var text = req.responseText;
      if (text == "success") {
        alert("Employee successfully added.");
        window.location.reload();
      } else {
        document.getElementById("massege").innerHTML = text;
      }
    }
  };
  req.open("POST", "emploee_registration.php", true);
  req.send(form);
}

function cleraData() {
  this.location.reload();
}

function searchUser() {
  var usernic = document.getElementById("employeenicdatasearch");

  var f = new FormData();

  f.append("nic", usernic.value);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      // alert(req.responseText);
      document.getElementById("loradDetails").innerHTML = req.responseText;
      document.getElementById("hidedata").classList.add("d-none");
    }
  };
  req.open("POST", "search_employee_data.php", true);
  req.send(f);
}

function updateEmployee() {
  var employeeid = document.getElementById("employeeiddatasearch").value;
  var employee_firstname = document.getElementById(
    "employee_firstname_search"
  ).value;
  var employee_lastname = document.getElementById(
    "employee_lastname_search"
  ).value;
  var employee_mobile = document.getElementById("mobile_search").value;
  var employee_category = document.getElementById(
    "employee_categorySelect_search"
  ).value;
  var employee_email = document.getElementById("email_search").value;
  var employee_birthday = document.getElementById("birthday_search").value;
  var employee_gender = document.getElementById("gender_search").value;
  var employee_marital = document.getElementById("marital_search").value;
  var employee_address = document.getElementById("address_search").value;
  var employee_basicsalary =
    document.getElementById("basicsalary_search").value;
  var employee_payementmethod = document.getElementById(
    "payment_method_search"
  ).value;
  var employee_epf = document.getElementById("epf_search").value;
  var employee_bank = document.getElementById("bank_search").value;
  var employee_branch = document.getElementById("branch_search").value;
  var employee_account = document.getElementById("account_search").value;

  var f = new FormData();

  f.append("id", employeeid);
  f.append("fisrtname", employee_firstname);
  f.append("lastname", employee_lastname);
  f.append("mobile", employee_mobile);
  f.append("category", employee_category);
  f.append("email", employee_email);
  f.append("birthday", employee_birthday);
  f.append("gender", employee_gender);
  f.append("marital", employee_marital);
  f.append("address", employee_address);
  f.append("basic", employee_basicsalary);
  f.append("paymentmethod", employee_payementmethod);
  f.append("epf", employee_epf);
  f.append("bank", employee_bank);
  f.append("branch", employee_branch);
  f.append("account", employee_account);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      document.getElementById("massegesearchdata").innerHTML = req.responseText;
    }
  };
  req.open("POST", "updateemployeedata.php", true);
  req.send(f);
}
