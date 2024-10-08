<?php
require_once('services/ArticleService.php');
require_once('services/CategoryService.php');
require_once('services/AuthorService.php');

class ArticleController
{
    public function index()
    {
        $articleService = new ArticleService();
        include("views/admin/articles/index.php");
    }

    public function add_article()
    {
        $articleService = new ArticleService();
        $categoryService = new CategoryService();
        $authorService = new AuthorService();

        if (isset($_POST['btn'])) {
            $tieude = trim($_POST["tieude"] ?? '');
            $ten_bhat = trim($_POST["ten_bhat"] ?? '');
            $ten_tloai = $_POST["ten_tloai"] ?? '';
            $ten_tgia = $_POST["ten_tgia"] ?? '';
            $tomtat = trim($_POST["tomtat"] ?? '');
            $noidung = $_POST["noidung"] ?? '';

            $extensions = ['png', 'jpg'];
            $hinhanh = $_FILES['hinhanh']['name'] ?? '';
            $ext = pathinfo($hinhanh, PATHINFO_EXTENSION); // Get extension (lấy ra đuôi file), vd: .png, .jpg

            if (!empty($tieude) && !empty($ten_bhat) && !empty($tomtat)) {
                $ma_tloai = $categoryService->getAll("select * from theloai where ten_tloai = '$ten_tloai'")[0]->getMaTheLoai();
                $ma_tgia = $authorService->getAll("select * from tacgia where ten_tgia = '$ten_tgia'")[0]->getMaTGia();

                $arguments['tieude'] = $tieude;
                $arguments['tenbaihat'] = $ten_bhat;
                $arguments['matheloai'] = $ma_tloai;
                $arguments['tomtat'] = $tomtat;
                $arguments['noidung'] = $noidung;
                $arguments['matacgia'] = $ma_tgia;
                $arguments['hinhanh'] = $hinhanh;

                if (!empty($hinhanh)) {
                    if (in_array($ext, $extensions)) {
                        move_uploaded_file($_FILES['hinhanh']['tmp_name'], 'assets/images/songs/' . $hinhanh);
                        $articleService->insert($arguments);
                        header("location:?controller=article");
                    } else {
                        $mess = "Hình ảnh chỉ nhận file: .png, .jpg";
                        header("location:?controller=article&action=add_article&mess=$mess");
                    }
                } else {
                    $articleService->insert($arguments);
                    header("location:?controller=article");
                }

            } else {
                $mess = "Bạn vui lòng nhập đầy đủ thông tin";
                header("location:?controller=article&action=add_article&mess=$mess");
            }
        }
        include("views/admin/articles/add_article.php");
    }

    public function edit_article()
    {
        $articleService = new ArticleService();
        $categoryService = new CategoryService();
        $authorService = new AuthorService();

        $ma_bviet = $_POST["ma_bviet"] ?? '';
        $tieude = trim($_POST["tieude"] ?? '');
        $ten_bhat = trim($_POST["ten_bhat"] ?? '');
        $ten_tloai = $_POST["ten_tloai"] ?? '';
        $ten_tgia = $_POST["ten_tgia"] ?? '';
        $tomtat = trim($_POST["tomtat"] ?? '');
        $noidung = $_POST["noidung"] ?? '';

        $extensions = ['png', 'jpg'];
        $hinhanh = $_FILES['hinhanh']['name'] ?? '';
        $ext = pathinfo($hinhanh, PATHINFO_EXTENSION); // Get extension (lấy ra đuôi file), vd: .png, .jpg

        if (isset($_POST['btn'])) {
            if (!empty($tieude) && !empty($ten_bhat) && !empty($tomtat)) {
                $ma_tloai = $categoryService->getAll("select * from theloai where ten_tloai = '$ten_tloai'")[0]->getMaTheLoai();
                $ma_tgia = $authorService->getAll("select * from tacgia where ten_tgia = '$ten_tgia'")[0]->getMaTGia();

                $image = $hinhanh;
                if (empty($hinhanh)) { //trường hợp người dùng không chỉnh sửa lại ảnh thì không cần upload file ảnh vào thư mục chỉ cần cập nhật thông tin lên database
                    $argument['mabaiviet'] = $ma_bviet;
                    $image = $articleService->getById($argument)->getHinhAnh();
                } else {
                    //kiểm tra xem ảnh có tmdk không -> upload ảnh vào trong thư mục
                    if (in_array($ext, $extensions)) {
                        move_uploaded_file($_FILES['hinhanh']['tmp_name'], 'assets/images/songs/' . $image);
                    } else {
                        $mess = "Hình ảnh chỉ nhận file: .png, .jpg";
                        header("location:?controller=article&action=edit_article&id=$ma_bviet&mess=$mess");
                        die();
                    }
                }

                $arguments['mabaiviet'] = $ma_bviet;
                $arguments['tieude'] = $tieude;
                $arguments['tenbaihat'] = $ten_bhat;
                $arguments['matheloai'] = $ma_tloai;
                $arguments['tomtat'] = $tomtat;
                $arguments['noidung'] = $noidung;
                $arguments['matacgia'] = $ma_tgia;
                $arguments['hinhanh'] = $image;
                $articleService->update($arguments);

                header("location:?controller=article");
            } else {
                $mess = "Bạn vui lòng nhập đầy đủ thông tin";
                header("location:?controller=article&action=edit_article&id=$ma_bviet&mess=$mess");
            }
        }

        include("views/admin/articles/edit_article.php");
    }

    public function delete_article()
    {
        $articleService = new ArticleService();
        $arguments['mabaiviet'] = $_GET['id'];

        if (isset($_POST['confirm'])) {
            //xóa bản ghi ra khỏi database
            $articleService->delete($arguments);

            //xóa ảnh ra khỏi thư mục
            // $article = $articleService->getById($arguments);
            // $image = $article->getHinhAnh();

            // unlink("assets/images/songs/$image");
            header("location:?controller=article");
        }
        include("views/admin/articles/delete_article.php");
    }
}

?>