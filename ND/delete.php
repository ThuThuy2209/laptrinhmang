<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: user_login.php");
    exit();
}

include("../db.php");

// Lấy thông tin user hiện tại
$username = $_SESSION['username'];
$user_result = $conn->query("SELECT id FROM users WHERE username = '$username'");
$user_data = $user_result->fetch_assoc();
$user_id = $user_data['id'];

// Lấy ID phản hồi từ URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Kiểm tra xem phản hồi này có thuộc về user hiện tại không
    $check = $conn->query("SELECT * FROM feedback WHERE id = $id AND user_id = $user_id");

    if ($check->num_rows > 0) {
        // Xóa phản hồi
        $conn->query("DELETE FROM feedback WHERE id = $id");
        echo "<script>alert('Xóa phản hồi thành công!'); window.location.href='edit.php';</script>";
    } else {
        echo "<script>alert('Bạn không có quyền xóa phản hồi này!'); window.location.href='edit.php';</script>";
    }
} else {
    echo "<script>alert('Không tìm thấy phản hồi để xóa.'); window.location.href='edit.php';</script>";
}
?>
