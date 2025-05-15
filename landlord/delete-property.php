<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn->query("DELETE FROM properties WHERE id = $id");
    echo "<script>alert('Property Deleted Successfully!'); window.location.href='manage-property.php';</script>";
} else {
    echo "<script>alert('Invalid Request!'); window.location.href='manage-property.php';</script>";
}
?>
