<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to index.php after a delay (optional)
header("Refresh: 3; url=index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <!-- Add some basic styles to make the logout page visually appealing -->
    <style>
        body {
            background-color: #f0f0f5;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .logout-container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
            margin-bottom: 20px;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <div class="logout-container">
        <h1>Logged Out Successfully</h1>
        <p>You will be redirected to the login page in a moment...</p>
        <div class="spinner"></div>
        <p><small>If you're not redirected, <a href="index.php">click here</a>.</small></p>
    </div>

</body>
</html>
