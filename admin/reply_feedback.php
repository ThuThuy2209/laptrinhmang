<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM feedback WHERE id = $id");
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reply = $_POST['reply'];
    $sql = "UPDATE feedback SET reply = '$reply', replied_at = NOW() WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Đã phản hồi người dùng'); window.location='admin_feedback.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Phản hồi người dùng</title><link rel="stylesheet" href="style.css"></head>
<body>
<header><h1>Phản hồi người dùng</h1></header>
<div class="container">
<p><strong>Họ tên:</strong> <?php echo $data['name']; ?></p>
<p><strong>Loại:</strong> <?php echo $data['category']; ?></p>
<p><strong>Nội dung:</strong><br><?php echo nl2br($data['message']); ?></p>
<form method="post">
    <label>Phản hồi của admin:</label>
    <textarea name="reply" rows="6" required><?php echo $data['reply']; ?></textarea>
    <button type="submit">Gửi phản hồi</button>
</form>
</div>
<footer>&copy; 2025 Nhaflower</footer>
</body>
</html>
