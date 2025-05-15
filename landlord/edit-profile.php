<?php
session_start();
include 'db.php';
include 'navbar.php';
$landlord_id = $_SESSION['landlord_id'] ?? 1;
$query = $conn->query("SELECT * FROM landlords WHERE id = $landlord_id");
$landlord = $query->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $conn->query("UPDATE landlords SET name='$name', email='$email', password='$password' WHERE id = $landlord_id");
    } else {
        $conn->query("UPDATE landlords SET name='$name', email='$email' WHERE id = $landlord_id");
    }
    echo "<script>alert('Profile updated successfully!'); window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Profile</title>
</head>
<body>
<div class="container">
    <h1>Edit Profile</h1>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $landlord['name']; ?>" required><br>
        <input type="email" name="email" value="<?php echo $landlord['email']; ?>" required><br>
        <input type="password" name="password" placeholder="New Password (optional)"><br><br>
        <button type="submit">Update Profile</button>
    </form>
</div>
</body>
</html>