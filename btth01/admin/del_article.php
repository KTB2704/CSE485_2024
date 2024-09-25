<?php
    include '../db.php';

    $id = $_GET['id'];
    
    $sql = "DELETE from baiviet WHERE ma_bviet = ?";
    $temp = $conn -> prepare($sql);
    if($temp === false){
        $message_error_query = "LỖI QUERRY: ";
        $redirectUrl_error_query = "../admin/article.php";
        // JavaScript code hiển thị pop-up
        echo "<script type='text/javascript'>alert('$message_error_query" . $conn -> error . "');";
        echo " window.location.href = '$redirectUrl_error_query';";
        echo "</script>;";
    }

    $temp -> bind_param("i",$id);

    if ($temp -> execute()){
        $sqlUpdate = "SET @new_id = 0; UPDATE baiviet SET ma_bviet = (@new_id := @new_id + 1) ORDER BY ma_bviet";
        if ($conn->multi_query($sqlUpdate)) {
        do {
            // Chi tiết của từng truy vấn
        } while ($conn->more_results() && $conn->next_result());
        }
        $message_success = "XÓA THÔNG TIN THÀNH CÔNG";
        $redirectUrl_success = "../admin/article.php";
        echo "<script type='text/javascript'>alert('$message_success');";
        echo " window.location.href = '$redirectUrl_success';";
        echo "</script>;";
    }
    else{
        $message_error_execute = "LỖI EXECUTE: ";
        $redirectUrl_error_execute = "../admin/article.php?id=".$id;
        echo "<script type='text/javascript'>alert('$message_error_execute" . $temp -> error . "');";
        echo " window.location.href = '$redirectUrl_error_execute';";
        echo "</script>;";
    }
    $temp -> close();        
?>