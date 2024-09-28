function userDataForm() {
  var name = document.getElementById("name").value;
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var reTypePassword = document.getElementById("reTypePassword").value;

  var form = new FormData();
  form.append("name", name);
  form.append("username", username);
  form.append("password", password);
  form.append("reTypePassword", reTypePassword);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var response = req.responseText;
      if (response == "sucess") {
        alert("Successfuly added user!");
        window.location = "admin_register.php";
      } else {
        document.getElementById("massege").innerHTML = response;
      }
    }
  };

  req.open("POSt", "register_process.php", true);
  req.send(form);
}

// function addUserAdmin() {
//   var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
//   alert(checkboxes);
//   var selectedCheckboxes = [];

//   // Push the values of the checked checkboxes into the array
//   checkboxes.forEach(function (checkbox) {
//     selectedCheckboxes.push(checkbox.value);
//   });

//   // Create an AJAX request
//   var xhr = new XMLHttpRequest();
//   xhr.open("POST", "user_typeAddingProcess.php", true);
//   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

//   // Convert array to URL-encoded string for POST request
//   var params = "checkboxes=" + encodeURIComponent(selectedCheckboxes.join(","));

//   // Handle response
//   xhr.onload = function () {
//     if (xhr.status == 200) {
//         var response = req.responseText;
//       console.log("Response from server: " + xhr.responseText);
//     }
//   };

//   // Send the request with the selected checkboxes
//   xhr.send(params);
// }

// 2024-09-12 editing

function loardUserData() {
  var userId = document.getElementById("userSelectId").value;
  document.getElementById("area1").style.visibility = "hidden";
  document.getElementById("area1").style.height = "0px";

  document.getElementById("area2").style.visibility = "visible";

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var response = req.responseText;

      document.getElementById("area2").innerHTML = response;
      //document.getElementById("area1").outerHTML = "";
    }
  };

  req.open("GET", "user_typeAddingProcess.php?user=" + userId, true);
  req.send();
}
function changeUserEx(iconid, userid) {
  var iconid = iconid;
  var userid = userid;
  var validation = document.getElementById("id" + iconid).checked;
  var form = new FormData();
  form.append("user", userid);
  form.append("iconid", iconid);
  form.append("validation", validation);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var response = req.responseText;
      console.log(response);
    }
  };

  req.open("POSt", "adduser_expireance.php", true);
  req.send(form);
}

function loardDataSlideBar() {
  var userId = document.getElementById("userSelectIdslidbar").value;
  document.getElementById("slidearea1").style.visibility = "hidden";
  document.getElementById("slidearea1").style.height = "0px";

  document.getElementById("slidearea2").style.visibility = "visible";

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var response = req.responseText;

      document.getElementById("slidearea2").innerHTML = response;
      //document.getElementById("area1").outerHTML = "";
    }
  };

  req.open("GET", "user_slidebaraddingProcess.php?user=" + userId, true);
  req.send();
}

function changeUserSlideBarEx(iconid, userid) {
  var iconid = iconid;
  var userid = userid;
  var validation = document.getElementById("id" + iconid).checked;
  var form = new FormData();
  form.append("user", userid);
  form.append("iconid", iconid);
  form.append("validation", validation);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var response = req.responseText;
      console.log(response);
    }
  };

  req.open("POSt", "addslidebaruser_expireance.php", true);
  req.send(form);
}

function loardpage() {
  this.location.reload();
}
