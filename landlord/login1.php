<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check in landlords table
    $sql = "SELECT * FROM landlords WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['landlord_id'] = $row['id'];
            $_SESSION['landlord_name'] = $row['name'];

            header("Location: index.php"); // Redirect to landlord dashboard
            exit();
        } else {
            echo "<script>alert('Incorrect password!'); window.location.href='login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Landlord not found!'); window.location.href='login.php';</script>";
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
