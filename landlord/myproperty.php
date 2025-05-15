<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "shrinivas"; // <-- your actual database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch properties
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Properties - Shri Nivas</title>
    <link rel="stylesheet" href="property.css">
    <style>
        .property-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .property {
            background-color: #ff6b6b;
            padding: 15px;
            border-radius: 10px;
            width: 250px;
            color: white;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .property img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .property-info h3 {
            margin: 5px 0;
        }

        .container {
            text-align: center;
            padding: 30px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f1f1f1;
        }

        #navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .logo {
            height: 40px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links a, .register-btn {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .register-btn {
            background-color: coral;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <nav id="navbar">
        <img src="images/logo3.png" class="logo" alt="Shri Nivas Logo">
        <ul class="nav-links">
            <li><a href="../index.html">Home</a></li>
        </ul>
        <a href="signup.php" class="register-btn">Register Now</a>
    </nav>

    <div class="container">
        <h1>All Properties</h1>
        <p>Browse all available properties listed by landlords.</p>

        <div class="property-list">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $imagePath = !empty($row['image']) ? 'uploaded/' . htmlspecialchars($row['image']) : 'images/default.png';

                    echo '<div class="property">';
                    echo '<img src="' . $imagePath . '" alt="Property Image">';
                    echo '<div class="property-info">';
                    echo '<h3>' . htmlspecialchars($row['property_name']) . '</h3>';
                    echo '<p>Location: ' . htmlspecialchars($row['location']) . '</p>';
                    echo '<p>Price: ' . number_format($row['price'], 2) . ' Rs./month</p>';
                    echo '</div>';
                    echo '</div>';
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
