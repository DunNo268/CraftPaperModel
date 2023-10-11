<?php 
// Hàm khởi tạo session
session_start();
define("ISLOGGED",true);
include_once "../config/connectDB.php";
include 'regex_test.php';
if(isset($_SESSION['user_login'])) {
    include_once "admin.php";
    $regexResult = checkPrivilege(); //Kiểm tra quyền thành viên
    if(!$regexResult){
        echo "Bạn không có quyền truy cập chức năng này";
        exit;
    }
}else{
    include_once "login.php";
}
?>