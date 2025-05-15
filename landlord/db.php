<?php
$conn = new mysqli('localhost', 'root', '', 'shrinivas');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
?>