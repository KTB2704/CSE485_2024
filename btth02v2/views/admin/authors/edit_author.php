<?php
require_once('views/layouts/header_admin.php');

if (isset($_GET['id']))
    $arguments['matacgia'] = $_GET['id'];
    $author = $authorService->getById($arguments);
?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Sửa thông tin tác giả</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId">Mã tác giả</span>
                    <input type="text" class="form-control" name="ma_tgia" readonly
                        value="<?= $author->getMaTGia() ?? '' ?>">
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Tên tác giả</span>
                    <input type="text" class="form-control" name="ten_tgia"
                        value="<?= $author->getTenTGia() ?? '' ?>">
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName" style="width: 100px">Hình ảnh</span>
                    <input type="file" class="form-control" name="hinh_tgia">
                </div>

                <div class="form-group  float-end ">
                    <input type="submit" name="btn" value="lưu" class="btn btn-success">
                    <a href="?controller=author" class="btn btn-warning ">Quay lại</a>
                </div>
                <div class="form-group" style="color:red">
                    <?= $_GET['mess'] ?? "" ?>
                </div>
            </form>
        </div>
    </div>
</main>
<?php
require_once('views/layouts/footer.php');
?>