function logInAdmin() {
  var username = document.getElementById("username");
  var password = document.getElementById("password");

  var formData = new FormData();

  formData.append("username", username.value);
  formData.append("password", password.value);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var response = req.responseText;
      if (response == "success") {
        window.location = "main.php";
      } else {
        document.getElementById("massege").innerHTML = response;
      }
    }
  };

  req.open("POST", "logInProcess.php", true);
  req.send(formData);
}

function sublogInAdmin() {
  var username = document.getElementById("username");
  var password = document.getElementById("password");

  var formData = new FormData();

  formData.append("username", username.value);
  formData.append("password", password.value);

  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var response = req.responseText;
      if (response == "success") {
        window.location = "submain.php";
      } else {
        document.getElementById("massege").innerHTML = response;
      }
    }
  };

  req.open("POSt", "sublogInProcess.php", true);
  req.send(formData);
}