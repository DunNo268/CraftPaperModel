<?php 
// session_start();
if(!defined("ISLOGGED")) {
	header("location: index.php");
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/styles.css" rel="stylesheet">
<!--ckeditor-->
<script src="//cdn.ckeditor.com/4.22.1/basic/ckeditor.js"></script>
<!--Bieudothongkedoanhthu-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!--Icons-->
<script src="js/lumino.glyphs.js"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/CraftPaperModel2/admin/index.php"><span>DunNo</span>Kit</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Đã đăng nhập <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="profile.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Hồ sơ</a></li>
							<li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Đăng xuất</a></li>
						</ul>
					</li>
				</ul>
			</div>							
		</div><!-- /.container-fluid -->
	</nav>
	<!--sidebar-->	
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Dashboard</a></li>
			<?php if (checkPrivilege('index.php?page=user')) { ?>
			    <li><a href="index.php?page=user"><svg class="glyph stroked male user"><use xlink:href="#stroked-male-user"/></svg>Quản lý tài khoản</a></li>
			<?php } ?>
			<?php if (checkPrivilege('index.php?page=storage')) { ?>
			    <li><a href="index.php?page=storage"><svg xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 640 512"><style>svg{fill:#55a3f8}</style><path d="M0 488V171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4V488c0 13.3-10.7 24-24 24H568c-13.3 0-24-10.7-24-24V224c0-17.7-14.3-32-32-32H128c-17.7 0-32 14.3-32 32V488c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24zm488 24l-336 0c-13.3 0-24-10.7-24-24V432H512l0 56c0 13.3-10.7 24-24 24zM128 400V336H512v64H128zm0-96V224H512l0 80H128z"/></svg>&nbsp;&nbsp;&nbsp;Quản lý vật liệu</a></li>
			<?php } ?>
			<?php if (checkPrivilege('index.php?page=news')) { ?>
			    <li><a href="index.php?page=news"><svg class="glyph stroked-app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>Quản lý tin tức</a></li>
			<?php } ?>
			<?php if (checkPrivilege('index.php?page=category')) { ?>
			    <li><a href="index.php?page=category"><svg class="glyph stroked-app-window"><use xlink:href="#stroked-app-window"></use></svg>Quản lý danh mục</a></li>
			<?php } ?>
			<?php if (checkPrivilege('index.php?page=product')) { ?>
			    <li><a href="index.php?page=product"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>Quản lý sản phẩm</a></li>
			<?php } ?>
			<?php if (checkPrivilege('index.php?page=order')) { ?>
			    <li><a href="index.php?page=order"><svg class="glyph stroked-clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>Quản lý đơn hàng</a></li>
			<?php } ?>
			<?php if (checkPrivilege('index.php?page=payment')) { ?>
				<li><a href="index.php?page=payment"><i style="font-size:15px" class="fa">&#xf09d;</i>&nbsp;&nbsp;Quản lý phương thức thanh toán</a></li>
			<?php } ?>
		</ul>
	</div>
	<!--/.sidebar-->	
	<!-- Main Content -->
	<?php
	// switch-case	
	if(isset($_GET['page'])) {
		switch ($_GET['page']) {
			// case 'dashboard':
			// 	require_once "dashboard.php";
			// 	break;
			case 'export':
				require_once "export.php";
				break;
			// paymentMethods module
			case 'storage':
				require_once "modules/storage/storage.php";
				break;
			case 'add_storage':
				require_once "modules/storage/add_storage.php";
				break;
			case 'edit_storage':
				require_once "modules/storage/edit_storage.php";
				break;
			// paymentMethods module
			case 'payment':
				require_once "modules/paymentMethods/payment.php";
				break;
			case 'add_payment':
				require_once "modules/paymentMethods/add_payment.php";
				break;
			case 'edit_payment':
				require_once "modules/paymentMethods/edit_payment.php";
				break;
			case 'search_payment':
				require_once "modules/paymentMethods/search_payment.php";
				break;
			// category module
			case 'category':
				require_once "modules/category/category.php";
				break;
			case 'add_category':
				require_once "modules/category/add_category.php";
				break;
			case 'edit_category':
				require_once "modules/category/edit_category.php";
				break;
			case 'search_category':
				require_once "modules/category/search_category.php";
				break;
			// news module
			case 'news':
				require_once "modules/news/news.php";
				break;
			case 'add_news':
				require_once "modules/news/add_news.php";
				break;
			case 'edit_news':
				require_once "modules/news/edit_news.php";
				break;
			case 'search_news':
				require_once "modules/news/search_news.php";
				break;
			// product module
			case 'product':
				require_once "modules/product/product.php";
				break;
			case 'add_product':
				require_once "modules/product/add_product.php";
				break;
			case 'edit_product':
				require_once "modules/product/edit_product.php";
				break;
			case 'search_product':
				require_once "modules/product/search_product.php";
				break;
			// user module
			case 'user':
				require_once "modules/user/user.php";
				break;
			case 'add_user':
				require_once "modules/user/add_user.php";
				break;
			case 'edit_user':
				require_once "modules/user/edit_user.php";
				break;
			case 'search_user':
				require_once "modules/user/search_user.php";
				break;
			//order module
			case 'order':
				require_once "modules/orders/order.php";
				break;
			case 'order_detail':
				require_once "modules/orders/order_detail.php";
				break;
			case 'order_detail1':
				require_once "modules/orders/order_detail1.php";
				break;
			case 'cancel_order':
				require_once "modules/orders/cancel_order.php";
				break;
			case 'cancel_order_detail':
				require_once "modules/orders/cancel_order_detail.php";
				break;
			case 'order_unprocessed':
				require_once "modules/orders/unprocessed_order.php";
				break;
			case 'order_processed':
				require_once "modules/orders/processed_order.php";
				break;
			case 'order_delivering':
				require_once "modules/orders/delivering_order.php";
				break;
			case 'del_order':
				require_once "modules/orders/del_order.php";
				break;
			case 'edit_status':
				require_once "modules/orders/edit_status.php";
				break;
			case 'edit_status1':
				require_once "modules/orders/edit_status1.php";
				break;
			//profile module
			case 'profile':
				require_once "profile.php";
				break;
			case 'edit_pass':
				require_once "modules/user/edit_pass.php";
				break;
		}
	}else{
		require_once "static.php";
	}
	?>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		thongke();
		var char = new Morris.Area({
			// ID of the element in which to draw the chart.
			element: 'chart',
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			// The name of the data record attribute that contains x-values.
			xkey: 'date',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['order','kits','amount'],
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Đơn hàng số','Số kit','Doanh thu']
		});
		$('.select-date').change(function() {
			var thoigian = $(this).val();
			if(thoigian == "7ngay"){
				var text = "7 ngày qua";
			}else if(thoigian == "28ngay"){
				var text = "28 ngày qua";
			}else if(thoigian == "90ngay"){
				var text = "90 ngày qua";
			}else{
				var text = "365 ngày qua";
			}
			$.ajax({
				url:"modules/thongke.php",
				method:"POST",
				dataType:"JSON",
				data:{thoigian:thoigian},
				success:function(data){
					char.setData(data);
					$('#text-date').text(text);
				}
			});			
		});
		function thongke() {
			var text = '7 ngày qua';
			$.ajax({
				url:"modules/thongke.php",
				method:"POST",
				dataType:"JSON",
				success:function(data){
					char.setData(data);
					$('#text-date').text(text);
				}
			});
		}
	});
</script>
</body>
</html>