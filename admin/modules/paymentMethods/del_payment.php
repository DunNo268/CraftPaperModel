<?php 
    session_start();
    if(isset($_SESSION['user_login'])) {
        define("ISLOGGED",true);
        include_once "../../../config/connectDB.php";
        if(isset($_GET['pay_id'])) {
            $pay_id = $_GET['pay_id'];
            $sql_delete = "UPDATE paymentMethods SET status = 0 WHERE pay_id=$pay_id";
            mysqli_query($conn, $sql_delete);
            header("location: /CraftPaperModel2/admin/index.php?page=payment");
        }
    }
?>