<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userName = $_POST['username'];
    $pw = $_POST['password'];


    // Truy vấn để tìm user theo username
     
    $sql = "SELECT * FROM users WHERE username = ?";
    $temp = $conn->prepare($sql);
    $temp->bind_param("s", $userName);
    $temp->execute();
    $result = $temp->get_result();
    
    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();        
        if ($pw == $users['password']) {
            header("Location: admin/index.php"); 
            exit();
        } else {
            $error = "Sai mật khẩu!";
        }
    } else {
        $error = "Không tìm thấy người dùng!";
    }

    $temp->close();
}
?>

<?php
if (isset($error)) {
    echo "<script>alert('$error'); window.history.back();</script>";
}
?>