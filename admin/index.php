<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
// Tự động điều hướng tới trang danh sách phản hồi
header("Location: admin_feedback.php");
exit();
