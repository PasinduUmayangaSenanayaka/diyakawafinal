<?php
session_start();

require "connection_db.php";

$username = $_POST["username"];
$password = $_POST["password"];

// Check if username and password are empty
if (empty($username)) {
    echo "Please enter username.";
} else if (empty($password)) {
    echo "Please enter password.";
} else {
    // Escape user input to prevent SQL injection
    $username = $db->real_escape_string($username);
    $password = $db->real_escape_string($password);

    // Query to fetch user from database
    $queryAdminUser = "SELECT * FROM admin_users WHERE admin_user_id = '$username' AND `password` = '$password'";
    $resultAdminUser = $db->query($queryAdminUser);

    // Check if query was successful
    if ($resultAdminUser) {
        if ($resultAdminUser->num_rows != 0) {
            $rowUser = $resultAdminUser->fetch_assoc();
            $_SESSION["admin_user"] = $rowUser;
            echo "success";
        } else {
            echo "Invalid Username or Password";
        }
    } else {
        // Query failed, output error
        echo "Error: " . $db->error;
    }
}

?>