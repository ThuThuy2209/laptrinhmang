<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Đăng nhập Admin</title><link rel="stylesheet" href="style.css"></head>
<body>
<header><h1>Đăng nhập Quản trị</h1></header>
<div class="container">
<form method="post" action="login.php">
    <label>Tên đăng nhập:</label>
    <input type="text" name="username" required>
    <label>Mật khẩu:</label>
    <input type="password" name="password" required>
    <button type="submit">Đăng nhập</button>
</form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../db.php';
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_feedback.php");
        exit();
    } else {
        echo "<script>alert('Sai tài khoản hoặc mật khẩu!');</script>";
    }
}
?>
<footer>&copy; 2025 Nhaflower</footer>
</body>
</html>
