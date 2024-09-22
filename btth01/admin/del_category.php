<?php
      // Connect to Database
      require_once("../db.php");

      // Get category ID from URL
      $catId = $_GET['id'];

      // Check if user wants to delete category
      if (isset($_GET['$catId'])) {
        $sql = "DELETE FROM theloai WHERE ma_tloai = $catId";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $catId);

        if ($stmt->execute()) {
          header("Location: category.php"); // Redirect to category list
          exit();
        } else {
          echo "Lỗi: " . $stmt->error;
        }

        $stmt->close();
      }
    ?>