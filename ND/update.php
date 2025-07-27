<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_logged_in'])) {
    die("Bạn chưa đăng nhập!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id']; // lấy id phản hồi
    $category = $_POST['category'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("UPDATE feedback SET category=?, message=? WHERE id=?");
    $stmt->bind_param("ssi", $category, $message, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='edit.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
