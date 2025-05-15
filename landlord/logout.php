<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged Out</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
        }
        .message {
            background: white;
            padding: 30px;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: orange;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>

<div class="message">
    <h2>You have been logged out successfully!</h2>
    <a href="../Login-Form/loginn.html">Login Again</a>
</div>

</body>
</html>
