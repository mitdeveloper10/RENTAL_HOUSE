<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "shrinivas";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM properties";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Properties</title>
    <link rel="stylesheet" href="property.css">
</head>
<body>

<nav id="navbar">
    <img src="images/logo2.png" class="logo">
    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
    </ul>
    <a href="landlord/signup.php" class="register-btn">Signup</a>
</nav>

<div class="container">
    <h1>All Properties</h1>
    <p>Browse all available properties listed by landlords.</p>

    <div class="property-list">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="property">
                    <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Property Image">
                    <div class="property-info">
                        <h3><?php echo htmlspecialchars($row['property_name']); ?></h3>
                        <p>Location: <?php echo htmlspecialchars($row['location']); ?></p>
                        <p>Price: <?php echo htmlspecialchars($row['price']); ?> Rs./month</p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No properties available.</p>";
        }
        ?>
    </div>
</div>

<div class="footer">
    <p>&copy; 2025 Shri Nivas. All Rights Reserved.</p>
</div>

</body>
</html>

<?php
$conn->close();
?>
