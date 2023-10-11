<?php 
    session_start();
    if(isset($_SESSION['user_login'])) {
        define("ISLOGGED",true);
        include_once "../../../config/connectDB.php";
        if(isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            $sql_delete = "UPDATE category SET status = 0 WHERE category_id=$category_id";
            mysqli_query($conn, $sql_delete);
            header("location: /CraftPaperModel2/admin/index.php?page=category");
        }
    }
?>