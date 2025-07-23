<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: user_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Nhaflower</title><link rel="stylesheet" href="style.css"></head>
<body>
<header>
    <h1>Chào mừng đến với Nhaflower</h1>
    <a href="user_logout.php" style="float:right; color:white; margin-right: 20px;">[Đăng xuất]</a>
</header>
<div class="container">
    <p>Chúng tôi luôn sẵn sàng lắng nghe phản hồi từ bạn!</p>
    <a href="contact.php"><button>Gửi phản hồi</button></a>
    <a href="my_feedback.php"><button>Xem phản hồi từ Admin</button></a>
</div>
<footer>&copy; 2025 Nhaflower</footer>
</body>
</html>
