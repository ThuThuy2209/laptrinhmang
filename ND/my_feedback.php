<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: user_login.php");
    exit();
}
include '../db.php';

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM feedback WHERE user_id = $user_id ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Lỗi SQL: " . $conn->error); // Thông báo nếu có lỗi SQL
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Phản hồi của tôi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Phản hồi của bạn</h1></header>
<div class="container">
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Loại</th>
        <th>Nội dung</th>
        <th>Thời gian gửi</th>
        <th>Phản hồi từ admin</th>
        <th>Thời gian phản hồi</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['category']; ?></td>
        <td><?php echo $row['message']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td><?php echo $row['reply'] ?? 'Chưa phản hồi'; ?></td>
        <td><?php echo $row['replied_at'] ?? '-'; ?></td>
    </tr>
    <?php } ?>
</table>
</div>
</body>
</html>
