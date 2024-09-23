<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra xem người dùng có để trống trường nào không
    if (empty($username) || empty($password)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
        exit();
    }

    // Truy vấn để tìm user theo username
    $sql = "SELECT * FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $User = $result->fetch_assoc();
    
        if ($password == $User['password']) {
            // Kiểm tra vai trò và chuyển hướng phù hợp
            if ($User['role'] == 'ad') {
                // Chuyển hướng đến trang quản trị viên
                header('location: admin/index.php');
                
                exit();
            } else {
                // Chuyển hướng đến trang người dùng
                header("Location: index.php");
                exit();
            }
        } else {
            // Mật khẩu không khớp
            echo "<script>alert('Sai mật khẩu!');</script>";
            exit();
        }
    } else {
        // Không tìm thấy người dùng
        echo "<script>alert('Không tìm thấy người dùng!');</script>";
        exit();
    }
}

$conn->close();
?>
