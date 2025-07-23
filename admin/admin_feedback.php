<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';
?>
<!DOCTYPE html>
<html>
<head><title>Danh sách phản hồi</title><link rel="stylesheet" href="style.css"></head>
<body>
<header>
    <h1>Danh sách phản hồi khách hàng</h1>
    <a href="logout.php" style="float:right; color:white; margin-right:20px;">[Đăng xuất]</a>
</header>
<div class="container">
<table border="1" width="100%" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>Họ tên</th><th>Loại</th><th>Nội dung</th><th>Ngày gửi</th><th>Phản hồi</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['message']}</td>
                <td>{$row['created_at']}</td>
                <td><a href='reply_feedback.php?id={$row['id']}'>Phản hồi</a></td>
              </tr>";
    }
    ?>
</table>
</div>
<footer>&copy; 2025 Nhaflower</footer>
</body>
</html>
