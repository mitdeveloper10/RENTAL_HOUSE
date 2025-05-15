<?php
session_start();
include 'db.php';
include 'navbar.php';
$landlord_id = $_SESSION['landlord_id'] ?? 1;
$bookings = $conn->query("SELECT bookings.*, properties.title FROM bookings JOIN properties ON bookings.property_id = properties.id WHERE properties.landlord_id = $landlord_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Bookings</title>
</head>
<body>
<div class="container">
    <h1>Bookings</h1>
    <table>
        <tr><th>Property</th><th>User Name</th><th>Booking Date</th></tr>
        <?php while($row = $bookings->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['booking_date']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>