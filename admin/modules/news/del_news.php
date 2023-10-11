<?php 
    session_start();
    if(isset($_SESSION['user_login'])) {
        define("ISLOGGED",true);
        include_once "../../../config/connectDB.php";
        if(isset($_GET['news_id'])) {
            $news_id = $_GET['news_id'];
            $sql_delete = "UPDATE news SET status = 0 WHERE news_id=$news_id";
            mysqli_query($conn, $sql_delete);
            header("location: /CraftPaperModel2/admin/index.php?page=news");
        }
    }
?>