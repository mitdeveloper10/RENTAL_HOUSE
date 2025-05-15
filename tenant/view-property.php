<?php
include './php/db.php';

// Get property ID from URL
$property_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch property and image details
$query = "SELECT p.*, d.property_name, d.house_type, d.bhk, d.bedroom_image, d.kitchen_image, d.hall_image, d.other_image 
          FROM properti p 
          JOIN properties d ON p.id = d.id 
          WHERE p.id = $property_id";

$result = mysqli_query($conn, $query);
$property = mysqli_fetch_assoc($result);

if (!$property) {
    echo "<h3 class='text-center mt-5'>Property not found!</h3>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $property['property_name']; ?> - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .image-section img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4"><?php echo $property['property_name']; ?></h2>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>House Type:</strong> <?php echo $property['house_type']; ?>
        </div>
        <div class="col-md-4">
            <strong>BHK:</strong> <?php echo $property['bhk']; ?>
        </div>
        <div class="col-md-4">
            <strong>Rent:</strong> ₹<?php echo number_format($property['rent']); ?>/month
        </div>
    </div>

    <div class="row image-section">
        <div class="col-md-6 mb-4">
            <span class="label">Bedroom</span>
            <img src="../<?php echo $property['bedroom_image']; ?>" alt="Bedroom Image">
        </div>
        <div class="col-md-6 mb-4">
            <span class="label">Kitchen</span>
            <img src="../<?php echo $property['kitchen_image']; ?>" alt="Kitchen Image">
        </div>
        <div class="col-md-6 mb-4">
            <span class="label">Hall</span>
            <img src="../<?php echo $property['hall_image']; ?>" alt="Hall Image">
        </div>
        <div class="col-md-6 mb-4">
            <span class="label">Other</span>
            <img src="../<?php echo $property['other_image']; ?>" alt="Other Image">
        </div>
    </div>

    <a href="tenant-dashboard.php" class="btn btn-secondary mt-4">← Back to Dashboard</a>
</div>

</body>
</html>
