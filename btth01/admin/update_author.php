<?php 
    include '../db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $author_name = $_POST['txtAuthorName'];
        $id = $_POST['txtAuthorId'];
        if (!empty($author_name)){
            $sql = "UPDATE tacgia SET ten_tgia = ? where ma_tgia = ?";
            $temp = $conn -> prepare($sql);
            if ($temp === false){
                $message_error_query = "LỖI QUERRY: ";
                $redirectUrl_error_query = "../admin/author.php";
                // JavaScript code hiển thị pop-up
                echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
                echo " window.location.href = '$redirectUrl_error_query';";
                echo "</script>;";
            }

            $temp->bind_param("si",$author_name,$id);
            
            if ($temp -> execute()){
                $message_success = "CHỈNH SỬA THÔNG TIN THÀNH CÔNG";
                $redirectUrl_success = "../admin/author.php";
                echo "<script type='text/javascript'>alert('$message_success');";
                echo " window.location.href = '$redirectUrl_success';";
                echo "</script>;";
            }
            else{
                $message_error_execute = "LỖI EXECUTE: ";
                $redirectUrl_error_execute = "../admin/edit_author.php?id=".$id;
                echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
                echo " window.location.href = '$redirectUrl_error_execute';";
                echo "</script>;";
            }
            $temp -> close();
        }
        else{
            $message_missing_required = "YÊU CẦU NHẬP ĐỦ THÔNG TIN!";
            $redirectUrl_missing_required = "../admin/edit_author.php?id=".$id;
            echo "<script type='text/javascript'>alert('$message_missing_required');";
            echo " window.location.href = '$redirectUrl_missing_required';";
            echo "</script>;";
        } 
    }
?>