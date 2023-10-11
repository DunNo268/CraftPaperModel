<?php
    //Thêm thành viên
    if(isset($_POST['sbm'])) {
        if(empty($_POST['user_full'])) {
            echo "Bạn chưa nhập tên thành viên!";
        }else{
            $user_full = $_POST['user_full'];
        }
		if($_POST['user_pass'] != $_POST['user_re_pass']) {
            echo "Mật khẩu xác nhận không khớp!";
        }
		$user_phone = $_POST['user_phone'];
        $user_mail = $_POST['user_mail'];
        $user_pass = $_POST['user_pass'];
        $level_id = 2;
		$status = 1;

        $sqlInsert = "INSERT INTO user(user_full, user_phone, user_mail, user_pass, level_id, status) VALUES 
        ('$user_full', '$user_phone', '$user_mail', '$user_pass', '$level_id', '$status')";

        if(mysqli_query($conn, $sqlInsert)) {
            header("location: index.php?page=user");
        }else{
            echo "<script>alert('Thêm Thành viên không thành công');</script>";
        }
    }   
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li><a style="text-decoration: none; color: #606468;" href="index.php?page=user">Quản lý tài khoản</a></li>
			<li class="active">Thêm tài khoản</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Thêm tài khoản</h1>
		</div>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-8">
						<!-- <div class="alert alert-danger">Email đã tồn tại !</div> -->
						<form role="form" method="post">
						<div class="form-group">
							<label>Họ & Tên</label>
							<input name="user_full" required class="form-control" placeholder="">
						</div><div class="form-group">
							<label>Số điện thoại</label>
							<input type="number" name="user_phone" required class="form-control" placeholder="">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input name="user_mail" required type="text" onkeyup="validateEmail()" class="form-control">
							<span id="email_error"></span>
						</div>                       
						<div class="form-group">
							<label>Mật khẩu</label>
							<input name="user_pass" required type="password" class="form-control">
						</div>
						<div class="form-group">
							<label>Nhập lại mật khẩu</label>
							<input name="user_re_pass" required type="password" class="form-control">
						</div>
						<button name="sbm" type="submit" onclick="return validateForm();" class="btn btn-success">Thêm mới</button>
						<button type="reset" class="btn btn-default">Làm mới</button>
					</div>
				</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
</div>	<!--/.main-->
<script>
    function validateForm() {
        var user_mail = document.getElementById('user_mail');
        var email_error = document.getElementById('email_error');
        if(!customer_email.value.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)){
            check = false;
        }
        return check;
    }
</script>
<script>
    function validateEmail() {
        var customer_email = document.getElementById('user_mail');
        var email_error = document.getElementById('email_error');
        if(!customer_email.value.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)){
            email_error.innerHTML = "Vui lòng nhập một email hợp lệ!";
            email_error.style.color = "red";
            return false;
        }
        email_error.innerHTML = "";
        return true;
    }
</script>