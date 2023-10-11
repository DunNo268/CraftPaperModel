<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hồ sơ của tôi</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<?php
	include '../config/connectDB.php';
	$error = false;
	if (isset($_GET['action']) && $_GET['action'] == 'edit') {
		if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password'])
		) {
			$userResult = mysqli_query($conn, "Select * from `user_id` WHERE (`user_id` = " . $_POST['user_id'] . " AND `user_pass` = '" . md5($_POST['old_password']) . "')");
			if ($userResult->num_rows > 0) {
				$result = mysqli_query($conn, "UPDATE `user_id` SET `user_pass` = MD5('" . $_POST['new_password'] . "') WHERE (`user_id` = " . $_POST['user_id'] . " AND `user_pass` = '" . md5($_POST['old_password']) . "')");
				if (!$result) {
					$error = "Không thể cập nhật tài khoản";
				}
			} else {
				$error = "Mật khẩu cũ không đúng.";
			}
			mysqli_close($conn);
			if ($error !== false) {
				?>
				<div id="error-notify" class="box-content">
					<h1>Thông báo</h1>
					<h4><?= $error ?></h4>
					<a href="./changePass.php">Đổi lại mật khẩu</a>
				</div>
			<?php } else { ?>
				<div id="edit-notify" class="box-content">
					<h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
					<a href="./index.php">Quay lại tài khoản</a>
				</div>
			<?php } ?>
		<?php } else { ?>
			<div id="edit-notify" class="box-content">
				<h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
				<a href="./changePass.php">Quay lại sửa tài khoản</a>
			</div>
			<?php
		}
	} else {
		session_start();
		$user = $_SESSION['user_login'];
		if (!empty($user)) { 
			?>
<body style="background-color: #262626;">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div style="text-align: center;" class="panel-heading"><strong>Hồ sơ của tôi</strong></div>
				<div class="panel-body">
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<label>Họ & Tên</label>
								<input disabled name="user_full" required class="form-control" value="<?php echo $user['user_full'];  ?>" placeholder="">
							</div>
							<div class="form-group">
								<label>Số điện thoại</label>
								<input disabled name="user_phone" required class="form-control" value="<?php echo $user['user_phone'];  ?>" placeholder="">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input disabled name="user_mail" required class="form-control" value="<?php echo $user['user_mail'];  ?>">
							</div>
							<div class="form-group">
								<label>Phân quyền</label>
								<?php if($user['level_id'] == 1) { ?>
									<input disabled name="level_name" required class="form-control" value="Administrator">
								<?php } else { ?> 
									<input disabled name="level_name" required class="form-control" value="Nhân viên">
								<?php } ?>
							</div>
							<div>						
								<button type="submit" style="height: 35px; margin-left: 67px;" class="btn btn-primary">
									<a style="text-decoration: none;" href="index.php?page=edit_pass&user_id=<?php echo $user['user_id']; ?>">
										<svg xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 448 512"><style>svg{fill:#ffffff}</style><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg> &nbsp;Đổi mật khẩu
									</a>
								</button>
								<button type="submit" style="height: 35px; margin-left: 10px;" class="btn btn-success">
									<a style="text-decoration: none;" href="/CraftPaperModel2/admin/index.php">
										<svg xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 576 512"><style>svg{fill:#ffffff}</style><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg> &nbsp;Về trang admin
									</a>
								</button>
							<div>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>
</html>
<?php
		}
	}
?>
<style>
	a {
		color: white;
		&:hover{color: white;}
	}
</style>