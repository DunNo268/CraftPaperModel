<?php 
// session_start();
if(!defined("ISLOGGED")) {
	header("location: index.php");
}
if(isset($_POST['login'])) {
	//kiểm email đã được nhập hay chưa
	if(!empty($_POST['email'])) {
		$email = trim($_POST['email']);
	}else{
		$error['email'] = "Bạn chưa nhập email";
	}
	//Kiểm tra password đã được nhập hay chưa
	if(!empty($_POST['pass'])) {
		$pass = $_POST['pass'];
	}else{
		$error['pass'] = "Bạn chưa nhập mật khẩu";
	}
	//Khi không có lỗi xảy ra
	if(!isset($error['email']) &&  !isset($error['pass'])) {
		//trường hợp thỏa mãn tài khoản đăng nhập
		$sql = "SELECT * FROM user WHERE user_mail = '$email' && user_pass='$pass'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if($count > 0) {
			$user_login = mysqli_fetch_assoc($result);
			if ($user_login['user_mail'] == "admin@gmail.com") {
				$user_login['privileges'] = array(
                    "index\.php$",
					"current_page=\d+$",
					"carbon\autoload\.php$",
					"export$",
					//profile
					"profile\.php$",
					"edit_pass\&user_id=\d+$",					
					//storage
					"storage$",
					"add_storage\&storage_id=\d+$",
                    "edit_storage\&storage_id=\d+$",
					//payment
					"payment$",
                    "add_payment$",
					"search_payment$",
                    "edit_payment\&pay_id=\d+$",
                    "del_payment\?pay_id=\d+$",
					//category
					"category$",
                    "add_category$",
					"search_category$",
                    "edit_category\&category_id=\d+$",
                    "del_category\?category_id=\d+$",
					//news
					"news$",
                    "add_news$",
					"search_news$",
                    "edit_news\&news_id=\d+$",
                    "del_news\?news_id=\d+$",
					//product
					"product$",
                    "add_product$",
					"search_product$",
                    "edit_product\&prd_id=\d+$",
                    "del_product\?prd_id=\d+$",
					//user
					"user$",
                    "add_user$",
					"search_user$",
                    "edit_user\&user_id=\d+$",
                    "del_user\?user_id=\d+$",
					//orders
					"order$",
					"cancel_order$",
					"cancel_order_detail\&order_id=\d+$",
					"order_delivering$",
					"order_processed$",
					"order_unprocessed$",
					"order_detail\&order_id=\d+$",
					"order_detail1\&order_id=\d+$",
                    "edit_order\&order_id=\d+$",
					"edit_order1\&order_id=\d+$",
					"edit_status\&order_id=\d+$",
					"edit_status1\&order_id=\d+$",
                    "del_order\&order_id=\d+$"
				);
			}else{
				$user_login['privileges'] = array(
					"index\.php$",
					"current_page=\d+$",
					"carbon\autoload\.php$",
					"export$",
					//profile
					"profile\.php$",
					"edit_pass\&user_id=\d+$",
					//storage
					"storage$",
					"add_storage\&storage_id=\d+$",
                    "edit_storage\&storage_id=\d+$",
					//category
					"category$",
                    "add_category$",
					"search_category$",
                    "edit_category\&category_id=\d+$",
                    "del_category\?category_id=\d+$",
					//news
					"news$",
                    "add_news$",
					"search_news$",
                    "edit_news\&news_id=\d+$",
                    "del_news\?news_id=\d+$",
					//product
					"product$",
                    "add_product$",
					"search_product$",
                    "edit_product\&prd_id=\d+$",
                    "del_product\?prd_id=\d+$",
					//orders
					"order$",
					"cancel_order$",
					"cancel_order_detail\&order_id=\d+$",
					"order_delivering$",
					"order_processed$",
					"order_unprocessed$",
					"order_detail\&order_id=\d+$",
					"order_detail1\&order_id=\d+$",
                    "edit_order\&order_id=\d+$",
					"edit_order1\&order_id=\d+$",
					"edit_status\&order_id=\d+$",
					"edit_status1\&order_id=\d+$",
                    "del_order\&order_id=\d+$"
				);
			}
			$_SESSION['user_login'] = $user_login;
			header("location: admin.php");
		}else{
			$error['invalid'] = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
		}
		// if($email == "admin@gmail.com" && $pass == "123456") {
		// 	$_SESSION['email'] = "admin@gmail.com";
		// 	header("location: admin.php");
		// }else{
		// 	//Trường hợp tài khoản không tại.
		// 	$error['invalid'] = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
		// }
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DunNo Kit - Administrator</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body style="background-color: #262626;">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">DunNo Kit - Administrator</div>
				<div class="panel-body">
					<?php if(isset($error['invalid'])) echo $error['invalid']; ?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
								<span style="color: red"><?php if(isset($error['email'])) echo $error['email']; ?></span>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
								<span style="color: red"><?php if(isset($error['email'])) echo $error['email']; ?></span>
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button style="margin-left: 157px;" type="submit" class="btn btn-primary" name="login">Đăng nhập</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>
</html>
