<?php
require_once('views/layouts/header_admin.php');
?>

<main class="container">
    <form action="" method="post"
        style="width: 50%; background: #3d456a2e; border: 1px solid; border-radius: 10px; margin: 60px auto; padding: 30px;">
        <h3 style="margin-bottom: 30px">
            Bạn có chắc muốn xóa bài viết này không ?
        </h3>
        <div>
            <input class="btn btn-danger" type="submit" name='confirm' value="Xóa">
            <a href="?controller=article" class="btn btn-warning">Quay lại</a>
        </div>
    </form>
</main>

<?php
require_once('views/layouts/footer.php');
?>