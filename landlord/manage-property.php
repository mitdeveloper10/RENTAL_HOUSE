<?php
session_start();
include 'db.php';
include 'navbar.php';

if (!isset($_SESSION['landlord_id'])) {
    header('Location: ../login.php');
    exit();
}

$landlord_id = $_SESSION['landlord_id'];

// Sirf apni properties dikhao
$properties = $conn->query("SELECT * FROM properties WHERE landlord_id = $landlord_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Manage Properties</title>
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            width: 90%;
            margin: 80px auto;
            background:rgb(255, 255, 255);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #ff6600;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            overflow-x: auto;
        }
        th, td {
            text-align: center;
            padding: 5px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }
        th {
            background-color: #ff6600;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }
        .btn {
            padding: 6px 14px;
            margin: 2px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Manage Properties</h1>
    <table>
        <thead>
            <tr>
                <th>Main Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>Description</th>
                <th>BHK</th>
                <th>Category</th>
                <th>Location</th>
                <th>Scarefit</th>
                <th>Hall Image</th>
                <th>Kitchen Image</th>
                <th>Bedroom Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $properties->fetch_assoc()): ?>
        <tr>
            <td>
                <?php if (!empty($row['image'])): ?>
                    <img src="uploads/<?php echo $row['image']; ?>" alt="Main Image">
                <?php else: ?>
                    <img src="uploads/default.jpg" alt="No Image">
                <?php endif; ?>
            </td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td>₹<?php echo number_format($row['price'], 2); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
            <td><?php echo htmlspecialchars($row['bhk']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo htmlspecialchars($row['location']); ?></td>
            <td><?php echo htmlspecialchars($row['scarefit']); ?></td>
            <td>
                <?php if (!empty($row['hall_image'])): ?>
                    <img src="uploads/<?php echo $row['hall_image']; ?>" alt="Hall Image">
                <?php else: ?>
                    <img src="uploads/default.jpg" alt="No Image">
                <?php endif; ?>
            </td>
            <td>
                <?php if (!empty($row['kitchen_image'])): ?>
                    <img src="uploads/<?php echo $row['kitchen_image']; ?>" alt="Kitchen Image">
                <?php else: ?>
                    <img src="uploads/default.jpg" alt="No Image">
                <?php endif; ?>
            </td>
            <td>
                <?php if (!empty($row['bedroom_image'])): ?>
                    <img src="uploads/<?php echo $row['bedroom_image']; ?>" alt="Bedroom Image">
                <?php else: ?>
                    <img src="uploads/default.jpg" alt="No Image">
                <?php endif; ?>
            </td>
            <td>
                <a href="edit-property.php?id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a><br>
                <a href="delete-property.php?id=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
