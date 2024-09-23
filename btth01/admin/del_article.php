<?php
include '../db.php'; 


if (isset($_GET['id'])) {
    $ma_bviet = $_GET['id'];


    $sql = "DELETE FROM baiviet WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ma_bviet);
    if ($stmt->execute()) {
        header("Location: article.php");
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
