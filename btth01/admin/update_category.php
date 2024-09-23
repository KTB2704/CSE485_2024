<?php
include '../db.php'; 

// Kiểm tra nếu đã gửi dữ liệu từ form
if (isset($_POST['ma_tloai']) && isset($_POST['ten_tloai'])) {
    // Lấy dữ liệu từ form
    $ma_tloai = $_POST['ma_tloai'];
    $ten_tloai = $_POST['ten_tloai'];

    // Truy vấn để cập nhật thể loại
    $sql = "UPDATE theloai SET ten_tloai = ? WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $ten_tloai, $ma_tloai);

    // Thực hiện câu lệnh và kiểm tra kết quả
    if ($stmt->execute()) {
        echo "Cập nhật thể loại thành công!";
        header("Location: category.php"); 
        exit;
    } else {
        echo "Có lỗi xảy ra: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Không đầy đủ dữ liệu";
    exit;
}
?>
