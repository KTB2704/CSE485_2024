<?php
include '../db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra xem có nhận được mã thể loại không
if (isset($_GET['id'])) {
    $ma_tgia = $_GET['id'];

    // Kiểm tra xem thể loại có đang được sử dụng trong bài viết hay không
    $check_sql = "SELECT COUNT(*) AS count FROM baiviet WHERE ma_tloai = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $ma_tgia);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $row = $check_result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "Thể loại đang liên kết với một bài viết. Vui lòng xóa bài viết trước.";
    } else {
        // Nếu thể loại không liên kết với bài viết, tiến hành xóa
        $delete_sql = "DELETE FROM theloai WHERE ma_tloai = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("s", $ma_tgia);

        if ($delete_stmt->execute()) {
            $sqlUpdate = "SET @new_id = 0; UPDATE theloai SET ma_tloai = (@new_id := @new_id + 1) ORDER BY ma_tloai";
            if ($conn->multi_query($sqlUpdate)) {
            do {
                // Chi tiết của từng truy vấn
            } while ($conn->more_results() && $conn->next_result());
            }
            header("Location: category.php");
            exit;
        } else {
            echo "Có lỗi xảy ra khi xóa thể loại: " . $delete_stmt->error;
        }

        $delete_stmt->close();
    }

    $check_stmt->close();
    $conn->close();
} else {
    echo "Không có mã thể loại";
    exit;
}
?>