<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: user_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Gửi phản hồi</title><link rel="stylesheet" href="style.css"></head>
<body>
<header><h1>Gửi phản hồi</h1></header>
<div class="container">
<form action="process_contact.php" method="post">
    <label>Họ tên:</label>
    <input type="text" name="name" required>
    <label>Loại phản hồi:</label>
    <select name="category" required>
        <option value="">-- Chọn loại --</option>
        <option value="Góp ý">Góp ý</option>
        <option value="Khiếu nại">Khiếu nại</option>
        <option value="Hỏi đáp">Hỏi đáp</option>
        <option value="Khác">Khác</option>
    </select>
    <label>Nội dung:</label>
    <textarea name="message" rows="5" required></textarea>
    <button type="submit">Gửi</button>
</form>
</div>
</body>
</html>
