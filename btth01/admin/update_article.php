<?php
include '../db.php'; // Kết nối cơ sở dữ liệu

// Lấy mã bài viết từ POST
if (isset($_POST['ma_bviet'])) {
    $ma_bviet = $_POST['ma_bviet']; // Lấy mã bài viết
    $tieude = $_POST['tieude'];
    $ten_bhat = $_POST['ten_bhat'];
    $ma_tloai = $_POST['ma_tloai'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $ma_tgia = $_POST['ma_tgia'];
    $ngayviet = $_POST['ngayviet'];
    $hinhanh = $_POST['hinhanh'];

    // Truy vấn để cập nhật bài viết
    $sql = "UPDATE baiviet SET tieude = ?, ten_bhat = ?, ma_tloai = ?, tomtat = ?, noidung = ?, ma_tgia = ?, ngayviet = ?, hinhanh = ? WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Lỗi chuẩn bị câu truy vấn: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssssssssi", $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh, $ma_bviet);
    if ($stmt->execute()) {
        echo "Cập nhật thành công!";
        header("Location: article.php");
        exit;
    } else {
        echo "Có lỗi xảy ra: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Không có mã bài viết.";
    exit;
}
?>
