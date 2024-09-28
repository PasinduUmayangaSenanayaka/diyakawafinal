<?php
session_start();

if (isset($_SESSION['admin_user'])) {
    require_once "connection_db.php";  // Including the database connection

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collect and sanitize POST data
        $name = trim($_POST["name"]);
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $repassword = trim($_POST["reTypePassword"]);

        // Basic validation
        if (empty($name)) {
            echo "Please enter Admin name.";
        } else if (empty($username)) {
            echo "Please enter Username of Admin.";
        } else if (empty($password)) {
            echo "Please enter admin password.";
        } else if (empty($repassword)) {
            echo "Please retype your password.";
        } else if ($password !== $repassword) {
            echo "Your password and retype password do not match.";
        } else {
            // Secure the password by hashing it before storing in the database


            // Prepare the SQL query using prepared statements to avoid SQL injection
            $stmt = $db->prepare("INSERT INTO subadmin_users (admin_user_id, admin_name, password) VALUES (?, ?, ?)");

            if ($stmt) {
                // Bind parameters to the prepared statement
                $stmt->bind_param("sss", $username, $name, $password);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "sucess";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error preparing the statement: " . $db->error;
            }

            // Close the database connection
            $db->close();
        }
    }
} else {
    // Redirect to login page if the user is not an admin
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
?>