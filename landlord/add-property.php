<?php
session_start();
include 'db.php';
include 'navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $bhk = $_POST['bhk'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $scarefit = $_POST['scarefit'];
    $landlord_id = $_SESSION['landlord_id'] ?? 1;

    // Handle image uploads
    $image = $_FILES['image']['name'];
    $hall_image = $_FILES['hall_image']['name'];
    $kitchen_image = $_FILES['kitchen_image']['name'];
    $bedroom_image = $_FILES['bedroom_image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$image);
    move_uploaded_file($_FILES['hall_image']['tmp_name'], 'uploads/'.$hall_image);
    move_uploaded_file($_FILES['kitchen_image']['tmp_name'], 'uploads/'.$kitchen_image);
    move_uploaded_file($_FILES['bedroom_image']['tmp_name'], 'uploads/'.$bedroom_image);

    $conn->query("INSERT INTO properties (title, description, price, image, bhk, category, location, scarefit, hall_image, kitchen_image, bedroom_image, landlord_id) 
    VALUES ('$title', '$description', '$price', '$image', '$bhk', '$category', '$location', '$scarefit', '$hall_image', '$kitchen_image', '$bedroom_image', '$landlord_id')");
    
    echo "<script>alert('Property Added!'); window.location.href='manage-property.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Add Property</title>
</head>
<body>
<div class="container">
    <h1>Add Property</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="number" name="price" placeholder="Price" required><br>
        <input type="text" name="bhk" placeholder="BHK" required><br>
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="flat">Flat</option>
            <option value="house">House</option>
            <option value="apartment">Apartment</option>
            <!-- Add more categories as needed -->
        </select><br>
        <input type="text" name="location" placeholder="Location" required><br>
        <input type="text" name="scarefit" placeholder="Scarefit" required><br>
        <input type="file" name="image" required><br>
        <input type="file" name="hall_image" required><br>
        <input type="file" name="kitchen_image" required><br>
        <input type="file" name="bedroom_image" required><br><br>
        <button type="submit">Add Property</button>
    </form>
</div>
</body>
</html>