<?php
// Include the database connection file
include('db.php');

// Fetch properties from the database
$query = "SELECT * FROM properties";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listings</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <h1>Property Listings</h1>
    </header>

    <div class="container my-5">
        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card property-card">
                            <img src="uploads/'.$row['image'].'" class="card-img-top" alt="'.$row['property_name'].'">
                            <div class="card-body">
                                <h5 class="card-title">'.$row['property_name'].'</h5>
                                <p class="card-text">Location: '.$row['location'].'</p>
                                <p class="card-text">Price: ₹'.$row['price'].'</p>
                                <p class="card-text">Area: '.$row['area'].' sq. ft.</p>
                                <!-- Corrected href link -->
                                <a href="property-details.php?id='.$row['id'].'" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No properties available.</p>";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Shri Nivas - All rights reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
