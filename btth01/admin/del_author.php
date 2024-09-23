<?php
include '../db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra xem có nhận được mã thể loại không
if (isset($_GET['id'])) {
    $ma_tgia = $_GET['id'];

    // Kiểm tra xem thể loại có đang được sử dụng trong bài viết hay không
    $check_sql = "SELECT COUNT(*) AS count FROM baiviet WHERE ma_tgia = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $ma_tgia);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $row = $check_result->fetch_assoc();

    if ($row['count'] > 0) {
        // Nếu thể loại đang liên kết với bài viết
        echo "Tác giả đang liên kết với một bài viết. Vui lòng xóa bài viết trước.";
    } else {
        // Nếu thể loại không liên kết với bài viết, tiến hành xóa
        $delete_sql = "DELETE FROM tacgia WHERE ma_tgia = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("s", $ma_tgia);

        if ($delete_stmt->execute()) {
            $sqlUpdate = "SET @new_id = 0; UPDATE tacgia SET ma_tgia = (@new_id := @new_id + 1) ORDER BY ma_tgia";
            if ($conn->multi_query($sqlUpdate)) {
            do {
                // Chi tiết của từng truy vấn
            } while ($conn->more_results() && $conn->next_result());
            }
            header("Location: author.php");
            exit;
        } else {
            echo "Có lỗi xảy ra khi xóa tác giả: " . $delete_stmt->error;
        }

        $delete_stmt->close();
    }

    $check_stmt->close();
    $conn->close();
} else {
    echo "Không có mã tác giả";
    exit;
}
?>