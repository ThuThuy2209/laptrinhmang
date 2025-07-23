<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: user_login.php");
    exit();
}
include '../db.php';

$username = $_SESSION['username']; // Lấy username từ session
$sql = "SELECT * FROM feedback WHERE reply IS NOT NULL AND name='$username' ORDER BY replied_at DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Lỗi SQL: " . $conn->error); // Thông báo nếu có lỗi SQL
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Phản hồi từ admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<header><h1>Phản hồi từ admin</h1></header>
<div class="container">
<table>
    <tr>
        <th>Loại</th>
        <th>Nội dung phản hồi</th>
        <th>Thời gian phản hồi</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['category']; ?></td>
        <td><?php echo $row['reply']; ?></td>
        <td><?php echo $row['replied_at']; ?></td>
    </tr>
    <?php } ?>
</table>
</div>
</body>
</html>