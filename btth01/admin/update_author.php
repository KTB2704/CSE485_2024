<?php
include '../db.php'; // 

// Kiểm tra nếu đã gửi dữ liệu từ form
if (isset($_POST['ma_tgia']) && isset($_POST['ten_tgia'])) {
    // Lấy dữ liệu từ form
    $ma_tloai = $_POST['ma_tgia'];
    $ten_tloai = $_POST['ten_tgia'];


    // Truy vấn để cập nhật thể loại
    $sql = "UPDATE tacgia SET ten_tgia = ? WHERE ma_tgia = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $ten_tloai, $ma_tloai);

    // Thực hiện câu lệnh và kiểm tra kết quả
    if ($stmt->execute()) {
        echo "Cập nhật tác giả thành công!";
        header("Location: author.php"); 
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
