<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    header('Location: manage-property.php');
    exit();
}

$id = (int)$_GET['id'];
$property = $conn->query("SELECT * FROM properties WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $bhk = $_POST['bhk'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $scarefit = $_POST['scarefit'];

    $conn->query("UPDATE properties SET 
        title = '$title', 
        description = '$description', 
        price = '$price', 
        bhk = '$bhk', 
        category = '$category', 
        location = '$location', 
        scarefit = '$scarefit' 
        WHERE id = $id
    ");

    echo "<script>alert('Property Updated Successfully!'); window.location.href='manage-property.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Property</title>
</head>
<body>
<div class="container">
    <h1>Edit Property</h1>
    <form method="POST">
        <input type="text" name="title" value="<?php echo htmlspecialchars($property['title']); ?>" required><br>
        <textarea name="description" required><?php echo htmlspecialchars($property['description']); ?></textarea><br>
        <input type="number" name="price" value="<?php echo htmlspecialchars($property['price']); ?>" required><br>
        <input type="text" name="bhk" value="<?php echo htmlspecialchars($property['bhk']); ?>" required><br>
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="flat" <?php if($property['category']=='flat') echo 'selected'; ?>>Flat</option>
            <option value="house" <?php if($property['category']=='house') echo 'selected'; ?>>House</option>
            <option value="apartment" <?php if($property['category']=='apartment') echo 'selected'; ?>>Apartment</option>
        </select><br>
        <input type="text" name="location" value="<?php echo htmlspecialchars($property['location']); ?>" required><br>
        <input type="text" name="scarefit" value="<?php echo htmlspecialchars($property['scarefit']); ?>" required><br><br>
        <button type="submit">Update Property</button>
    </form>
</div>
</body>
</html>
