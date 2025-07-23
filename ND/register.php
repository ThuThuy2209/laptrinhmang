<?php
include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Đăng ký thành công! Đăng nhập ngay.'); window.location.href='user_login.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Đăng ký tài khoản người dùng</h1>
</header>
<div class="container">
    <form method="post">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" required>

        <label>Mật khẩu:</label>
        <input type="password" name="password" required>

        <button type="submit">Đăng ký</button>
    </form>
    <p>Đã có tài khoản? <a href="user_login.php">Đăng nhập</a></p>
</div>
<footer>
    &copy; 2025 Nhaflower
</footer>
</body>
</html>
