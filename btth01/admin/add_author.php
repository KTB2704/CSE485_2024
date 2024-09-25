
<?php  
        include '../db.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $author_name = $_POST['ten_tgia'];
            if (!empty($author_name)){
                $sql = "INSERT INTO tacgia (ten_tgia) VALUES (?)";
                $temp = $conn -> prepare($sql);
                if ($temp === false){
                    $message_error_query = "LỖI QUERRY: ";
                    $redirectUrl_error_query = "author.php";
                    // JavaScript code hiển thị pop-up
                    echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
                    echo " window.location.href = '$redirectUrl_error_query';";
                    echo "</script>;";
                }

                $temp->bind_param("s",$author_name);
                
                if ($temp -> execute()){
                    $message_success = "THÊM THÔNG TIN THÀNH CÔNG";
                    $redirectUrl_success = "author.php";
                    echo "<script type='text/javascript'>alert('$message_success');";
                    echo " window.location.href = '$redirectUrl_success';";
                    echo "</script>;";
                }
                else{
                    $message_error_execute = "LỖI EXECUTE: ";
                    $redirectUrl_error_execute = "author.php";
                    echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
                    echo " window.location.href = '$redirectUrl_error_execute';";
                    echo "</script>;";
                }
                $temp -> close();
            }
            else{
                $message_missing_required = "YÊU CẦU NHẬP ĐỦ THÔNG TIN!";
                $redirectUrl_missing_required = "author.php";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
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
                        <li class="nav-item"><a class="nav-link" href="./">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link" href="../index.php">Trang ngoài</a></li>
                        <li class="nav-item"><a class="nav-link " href="category.php">Thể loại</a></li>
                        <li class="nav-item"><a class="nav-link active fw-bold" href="author.php">Tác giả</a></li>
                        <li class="nav-item"><a class="nav-link" href="article.php">Bài viết</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới tác giả</h3>
                <form method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên tác giả</span>
                        <input type="text" class="form-control" name="ten_tgia" required>
                    </div>
                    <div class="form-group float-end">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="category.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
