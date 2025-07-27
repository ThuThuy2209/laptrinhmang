<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: user_login.php");
    exit();
}

include("../db.php");

$username = $_SESSION['username'];
$user_id = $_SESSION['id'];

// Nếu có tham số id → hiển thị form sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn phản hồi thuộc user hiện tại
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM feedback WHERE id=$id AND user_id = $user_id"));
    if (!$row) {
        die("Phản hồi không tồn tại hoặc không thuộc về bạn.");
    }
    $feedback = $row;
    // Nếu người dùng gửi cập nhật
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $category = $_POST['category'];
        $message = $_POST['message'];

        $update = $conn->prepare("UPDATE feedback SET category = ?, message = ? WHERE id = ?");
        $update->bind_param("ssi", $category, $message, $id);
        if ($update->execute()) {
            echo "<script>alert('Đã cập nhật phản hồi thành công!'); window.location='edit.php';</script>";
            exit();
        } else {
            echo "<p style='color:red;'>Cập nhật thất bại.</p>";
        }
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Sửa phản hồi</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <header><h1>Sửa phản hồi</h1></header>
    <div class="container">
    <form action="update.php" method="post">
    <label>Họ tên:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($feedback['name']) ?>" readonly>
    <input type="hidden" name="id" value="<?= $feedback['id'] ?>">

<label>Loại phản hồi:</label>
<select name="category" required>
    <option value="">-- Chọn loại --</option>
    <option value="Thái độ phục vụ" <?= $feedback['category'] == "Thái độ phục vụ" ? "selected" : "" ?>>Thái độ phục vụ</option>
    <option value="Đóng gói sản phẩm" <?= $feedback['category'] == "Đóng gói sản phẩm" ? "selected" : "" ?>>Đóng gói sản phẩm</option>
    <option value="Giao hàng" <?= $feedback['category'] == "Giao hàng" ? "selected" : "" ?>>Giao hàng</option>
    <option value="Website" <?= $feedback['category'] == "Website" ? "Website" : "" ?>>Website</option>
    <option value="chất lượng" <?= $feedback['category'] == "chất lượng" ? "selected" : "" ?>>Chất lượng</option>
    <option value="Khác" <?= $feedback['category'] == "Khác" ? "selected" : "" ?>>Khác</option>
</select>

<label>Nội dung:</label>
<textarea name="message" rows="5" required><?= htmlspecialchars($feedback['message']) ?></textarea>

<button type="submit">Cập nhật</button>
</form>
    </div>
    </body>
    </html>

<?php
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa phản hồi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Danh sách phản hồi của bạn</h1></header>
<a href="logout.php" style="float:right; color:white; margin-right:20px;">[Đăng xuất]</a>
</header>
<div class="container">
<table border="1" width="100%" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>Họ tên</th><th>Loại</th><th>Nội dung</th><th>Ngày gửi</th><th>Phản hồi</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM feedback WHERE user_id = $user_id ORDER BY created_at DESC");

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['message']}</td>
                <td>{$row['created_at']}</td>
         <td>
                <a href='edit.php?id=" . $row['id'] . "'>Sửa</a> | 
                <a href='delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
?>
</div>
</body>
</html>