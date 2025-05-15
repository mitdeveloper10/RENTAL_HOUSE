<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate phone number (server-side)
    if (!preg_match('/^\d{10}$/', $phone)) {
        echo "<script>alert('Phone number must be exactly 10 digits!'); window.location.href='signup.php';</script>";
        exit();
    }

    // Password matching check
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='signup.php';</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM landlords WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='signup.php';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO landlords (name, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Signup successful! Please login.'); window.location.href='login1.html';</script>";
        } else {
            echo "<script>alert('Signup failed! Try again.'); window.location.href='signup.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Signup</title>
    <style>
    body {
        background color:rgb(255, 255, 255);
        font-family: 'Poppins', sans-serif;
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .signup-container {
        background: #fff;
        padding: 30px 25px;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        width: 350px;
        max-width: 90%; /* responsive bana diya */
        box-sizing: border-box;
        text-align: center;
    }
    .signup-container h1 {
        margin-bottom: 25px;
        font-size: 28px;
        color: #e67e22;
    }
    .signup-container input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        background: #f9f9f9;
        box-sizing: border-box; /* important */
        font-size: 15px;
    }
    .signup-container .input-group {
        position: relative;
    }
    .signup-container .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: #999;
    }
    .signup-container button {
        width: 100%;
        padding: 12px;
        background: #E67E22;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 15px;
        transition: 0.3s;
    }
    .signup-container button:hover {
        background: #D35400;
    }
    #strength {
        text-align: left;
        font-size: 13px;
        margin-top: -8px;
        margin-bottom: 10px;
        color: #666;
    }
</style>

</head>
<body>
<div class="signup-container">
    <h1>Create Account</h1>
    <form method="POST" onsubmit="return validatePassword()">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="phone" placeholder="Phone Number" pattern="\d{10}" title="Phone number must be exactly 10 digits" required>

        <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Password" required onkeyup="checkStrength()">
            <span class="toggle-password" onclick="togglePassword('password')">&#128065;</span>
        </div>
        <div id="strength"></div>

        <div class="input-group">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <span class="toggle-password" onclick="togglePassword('confirm_password')">&#128065;</span>
        </div>

        <button type="submit">Sign Up</button>
    </form>
</div>

<script>
function checkStrength() {
    var strength = document.getElementById('strength');
    var password = document.getElementById('password').value;
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

    if(strongRegex.test(password)) {
        strength.innerHTML = "<span style='color:green'>Strong Password</span>";
    } else if(mediumRegex.test(password)) {
        strength.innerHTML = "<span style='color:orange'>Medium Password</span>";
    } else {
        strength.innerHTML = "<span style='color:red'>Weak Password</span>";
    }
}

function togglePassword(id) {
    var field = document.getElementById(id);
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}

function validatePassword() {
    var password = document.getElementById('password').value;
    var confirm_password = document.getElementById('confirm_password').value;

    if(password !== confirm_password) {
        alert('Passwords do not match!');
        return false;
    }
    return true;
}
</script>
</body>
</html>
