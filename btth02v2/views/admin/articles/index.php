<?php
require_once('views/layouts/header_admin.php');
?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="?controller=article&action=add_article" class="btn btn-success">THÊM MỚI BÀI VIẾT</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tiêu đề</th>
                        <th>Tên bài hát</th>
                        <th>Tóm tắt</th>
                        <th>Nội dung</th>
                        <th>Ngày viết</th>
                        <th>Hình ảnh</th>
                        <th>SỬA</th>
                        <th>XÓA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $articles = $articleService->getAll("select * from baiviet");
                    foreach ($articles as $article) {
                        ?>
                        <tr>
                            <th scope="row">
                                <?= $count++ ?>
                            </th>
                            <td>
                                <?= $article->getTieuDe() ?>
                            </td>
                            <td>
                                <?= $article->getTenBHat() ?>
                            </td>
                            <td>
                                <?= $article->getTomTat() ?>
                            </td>
                            <td>
                                <?= $article->getNoiDung() ?>
                            </td>
                            <td>
                                <?= $article->getNgayViet() ?>
                            </td>
                            <td> <div style="width:150px"><img src="assets/images/songs/<?= $article->getHinhAnh() ?>" alt="<?= $article->getHinhAnh() ?>" style="width: 100%;"></div></td>
                            <td>
                                <a href="?controller=article&action=edit_article&id=<?= $article->getMaBViet() ?>"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="?controller=article&action=delete_article&id=<?= $article->getMaBViet() ?>"><i
                                        class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
require_once('views/layouts/footer.php');
?>