<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $username; // Lưu tên đăng nhập
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Sai tài khoản hoặc mật khẩu!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập người dùng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Đăng nhập người dùng</h1>
</header>
<div class="container">
    <form method="post">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" required>
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
        <button type="submit">Đăng nhập</button>
    </form>
    <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
</div>
<footer>
    &copy; 2025 Nhaflower
</footer>
</body>
</html>
