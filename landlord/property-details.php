<?php
// Include the database connection file
include('db.php');

// Get the property ID from the URL parameter
if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Fetch the property details from the database using the property ID
    $query = "SELECT * FROM properties WHERE id = '$property_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the property details
        $property = mysqli_fetch_assoc($result);
    } else {
        echo "<p>Property not found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid property ID.</p>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <h1>Property Details</h1>
    </header>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <img src="uploads/<?php echo $property['image']; ?>" class="img-fluid" alt="<?php echo $property['property_name']; ?>">
            </div>
            <div class="col-md-4">
                <h2><?php echo $property['property_name']; ?></h2>
                <p><strong>Location:</strong> <?php echo $property['location']; ?></p>
                <p><strong>Price:</strong> ₹<?php echo $property['price']; ?></p>
                <p><strong>Area:</strong> <?php echo $property['area']; ?> sq. ft.</p>
                <a href="contact-landlord.php?property_id=<?php echo $property['id']; ?>" class="btn btn-primary">Contact Landlord</a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Shri Nivas - All rights reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
