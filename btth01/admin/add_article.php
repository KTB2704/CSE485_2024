<!--thêm bài viết -->
<?php
include '../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['tieude'];
    $song = $_POST['ten_bhat'];
    $summary = $_POST['tomtat'];
    $maTG = $_POST['ma_tgia'];
    $maTL = $_POST['ma_tloai'];
    $ngay = $_POST['ngayviet'];
    $noidung = $_POST['noidung'];
    $img = $_POST['hinhanh'];
    $check_tgia = 0;
    $check_theloai = 0;

    if (!empty($title) || !empty($song) || !empty($summary) || !empty($maTG) || !empty($maTL) || !empty($ngay) || !empty($noidung) || !empty($img)) {
        $sql_check_tacgia = "SELECT ma_tgia from tacgia where ma_tgia = " . $maTG;
        $temp_check_tacgia = $conn->query($sql_check_tacgia);
        if ($temp_check_tacgia->num_rows > 0) {
            $check_tgia = 1;
        }
        $sql_check_theloai = "SELECT ma_tloai from theloai where ma_tloai = " . $maTL;
        $temp_check_theloai = $conn->query($sql_check_theloai);
        if ($temp_check_theloai->num_rows > 0) {
            $check_theloai = 1;
        }

        if ($check_tgia == 0 || $check_theloai == 0) {
            $message_missing_required = "YÊU CẦU NHẬP MÃ TÁC GIẢ HOẶC MÃ THỂ LOẠI ĐÃ TỒN TẠI";
            $redirectUrl_missing_required = "article.php";
            echo "<script type='text/javascript'>alert('$message_missing_required');";
            echo " window.location.href = '$redirectUrl_missing_required';";
            echo "</script>;";
        } else {
            $sql = "INSERT INTO baiviet(tieude,ten_bhat,ma_tloai,tomtat,noidung,ma_tgia,ngayviet,hinhanh) VALUES(?,?,?,?,?,?,?,?)";
            $temp = $conn->prepare($sql);
            if ($temp == false) {
                $message_error_query = "LỖI QUERRY: ";
                $redirectUrl_error_query = "article.php";
                // JavaScript code hiển thị pop-up
                echo "<script type='text/javascript'>alert('$message_error_query" . $conn->error . "');";
                echo " window.location.href = '$redirectUrl_error_query';";
                echo "</script>;";
            }

            $temp->bind_param("ssississ", $title, $song, $maTL, $summary, $noidung, $maTG, $ngay, $img);

            if ($temp->execute()) {
                $message_success = "THÊM THÔNG TIN THÀNH CÔNG";
                $redirectUrl_success = "article.php";
                echo "<script type='text/javascript'>alert('$message_success');";
                echo " window.location.href = '$redirectUrl_success';";
                echo "</script>;";
            } else {
                $message_error_execute = "LỖI EXECUTE: ";
                $redirectUrl_error_execute = "article.php";
                echo "<script type='text/javascript'>alert('$message_error_execute" . $temp->error . "');";
                echo " window.location.href = '$redirectUrl_error_execute';";
                echo "</script>;";
            }
            $temp->close();
        }
    } else {
        $message_missing_required = "YÊU CẦU NHẬP ĐỦ THÔNG TIN!";
        $redirectUrl_missing_required = "article.php";
        echo "<script type='text/javascript'>alert('$message_missing_required');";
        echo " window.location.href = '$redirectUrl_missing_required';";
        echo "</script>;";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm bài viết mới </h3>
                <form method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Tiêu đề</span>
                        <input type="text" class="form-control" name="tieude" >
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên bài hát</span>
                        <input type="text" class="form-control" name="ten_bhat" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Mã thể loại</span>
                        <input type="text" class="form-control" name="ma_tloai" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tóm tắt</span>
                        <input type="text" class="form-control" name="tomtat" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Nội dung</span>
                        <input type="text" class="form-control" name="noidung" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Mã tác giả</span>
                        <input type="text" class="form-control" name="ma_tgia" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblDate">Ngày viết</span>
                        <input type="date" class="form-control" name="ngayviet" required>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Hình ảnh</span>
                        <input type="file" class="form-control" name="hinhanh" >
                    </div>
                    <div class="form-group  float-end ">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>