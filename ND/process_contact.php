<?php
include '../db.php';
session_start();

$name = $_POST['name'];
$category = $_POST['category'];
$message = $_POST['message'];

$sql = "INSERT INTO feedback (name, category, message) 
        VALUES ('$name', '$category', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Phản hồi đã được gửi!'); window.location.href='index.php';</script>";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>
