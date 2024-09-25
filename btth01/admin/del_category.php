<?php 
    include '../db.php';
    $id = $_GET['id'];
    $sql_check = "SELECT * from baiviet where ma_tloai = " . $id;
    $result = $conn -> query($sql_check);
    if ($result -> num_rows != 0){
        $message_error_constraint = "VUI LÒNG XÓA BÀI VIẾT CÓ MÃ THỂ LOẠI LÀ " . $id . " RỒI MỚI ĐƯỢC XÓA THỂ LOẠI NÀY";
        $redirectUrl_error_constraint = "../admin/article.php";
        // JavaScript code hiển thị pop-up
        echo "<script type='text/javascript'>alert('$message_error_constraint');";
        echo " window.location.href = '$redirectUrl_error_constraint';";
        echo "</script>;";
    }
    else{
        $sql = "DELETE from theloai WHERE ma_tloai = ?";
        $temp = $conn -> prepare($sql);
        if($temp === false){
            $message_error_query = "LỖI QUERRY: ";
            $redirectUrl_error_query = "../admin/category.php";
            // JavaScript code hiển thị pop-up
            echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
            echo " window.location.href = '$redirectUrl_error_query';";
            echo "</script>;";
        }

        $temp -> bind_param("i",$id);
        
        if ($temp -> execute()){
            $sqlUpdate = "SET @new_id = 0; UPDATE theloai SET ma_tloai = (@new_id := @new_id + 1) ORDER BY ma_tloai";
            if ($conn->multi_query($sqlUpdate)) {
            do {
                // Chi tiết của từng truy vấn
            } while ($conn->more_results() && $conn->next_result());
            }
            $message_success = "XÓA THÔNG TIN THÀNH CÔNG";
            $redirectUrl_success = "../admin/category.php";
            echo "<script type='text/javascript'>alert('$message_success');";
            echo " window.location.href = '$redirectUrl_success';";
            echo "</script>;";
        }
        else{
            $message_error_execute = "LỖI EXECUTE: ";
            $redirectUrl_error_execute = "../admin/category.php?id=".$id;
            echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
            echo " window.location.href = '$redirectUrl_error_execute';";
            echo "</script>;";
        }
        $temp -> close();
    }
?>

