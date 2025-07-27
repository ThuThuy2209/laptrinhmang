<?php
include '../db.php';
session_start();

if (!isset($_SESSION['id'])) {
    die("Bạn chưa đăng nhập!");
}

$user_id = $_SESSION['id'];
$name = $_POST['name'];
$category = $_POST['category'];
$message = $_POST['message'];

$sql = "INSERT INTO feedback (user_id, name, category, message) 
        VALUES ('$user_id', '$name', '$category', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Phản hồi đã được gửi!'); window.location.href='index.php';</script>";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>
