<?php
include '../db.php';

if (isset($_GET['id'])) {
    $ma_bviet = $_GET['id'];

    // Truy vấn để lấy thông tin bài viết
    $sql = "SELECT ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh
            FROM baiviet 
            WHERE ma_bviet = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ma_bviet);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy bài viết.";
        exit;
    }
} else {
    echo "Mã bài viết không được cung cấp.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa bài viết</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h3>Sửa thông tin bài viết</h3>
        <form action="update_article.php" method="post">
            <input type="hidden" name="ma_bviet" value="<?php echo $row['ma_bviet']; ?>">
            <div class="mb-3">
                <label for="tieude" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" name="tieude" value="<?php echo ($row['tieude']); ?>">
            </div>
            <div class="mb-3">
                <label for="ten_bhat" class="form-label">Tên bài hát</label>
                <input type="text" class="form-control" name="ten_bhat" value="<?php echo ($row['ten_bhat']); ?>">
            </div>
            <div class="mb-3">
                <label for="ma_tloai" class="form-label">Mã thể loại</label>
                <input type="text" class="form-control" name="ma_tloai" value="<?php echo ($row['ma_tloai']); ?>">
            </div>
            <div class="mb-3">
                <label for="tomtat" class="form-label">Tóm tắt</label>
                <input type="text" class="form-control" name="tomtat" value="<?php echo ($row['tomtat']); ?>">
            </div>
            <div class="mb-3">
                <label for="tomtat" class="form-label">Nội dung</label>
                <input type="text" class="form-control" name="noidung" value="<?php echo ($row['noidung']); ?>">
            </div>
            <div class="mb-3">
                <label for="ma_tgia" class="form-label">Tác giả</label>
                <input type="text" class="form-control" name="ma_tgia" value="<?php echo ($row['ma_tgia']); ?>">
            </div>
            <div class="mb-3">
                <label for="ngayviet" class="form-label">Ngày viết</label>
                <input type="datetime-local" class="form-control" name="ngayviet" value="<?php echo date('Y-m-d\TH:i', strtotime($row['ngayviet'])); ?>">
            </div>
            <div class="mb-3">
                <label for="ngayviet" class="form-label">Hình ảnh</label>
                <input type="input" class="form-control" name="hinhanh" value="<?php echo ($row['hinhanh']);; ?>">
            </div>
            <button type="submit" class="btn btn-success">Lưu lại</button>
            <a href="article.php" class="btn btn-warning">Quay lại</a>
        </form>
    </div>
</body>

</html>