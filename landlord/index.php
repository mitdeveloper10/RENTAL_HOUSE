<?php
session_start();
include 'db.php';
include 'navbar.php';
$landlord_id = $_SESSION['landlord_id'] ?? 1; // default 1 for testing
$total_properties = $conn->query("SELECT COUNT(*) FROM properties WHERE landlord_id = $landlord_id")->fetch_row()[0];
$total_bookings = $conn->query("SELECT COUNT(*) FROM bookings WHERE property_id IN (SELECT id FROM properties WHERE landlord_id = $landlord_id)")->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Landlord Dashboard</title>
</head>
<body>
<div class="container">
    <h1>Welcome to Landlord Dashboard</h1>
    <div class="card">Total Properties: <?php echo $total_properties; ?></div>
    <div class="card">Total Bookings: <?php echo $total_bookings; ?></div>
</div>
</body>
</html>