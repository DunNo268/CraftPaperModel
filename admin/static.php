<?php
    // $sqlPro = "SELECT product.prd_id FROM product WHERE status = '1';";
	// $resultPro = mysqli_query($conn, $sqlPro);
	// $a = mysqli_num_rows($resultPro);
	$sqlOrd = "SELECT orders.order_id FROM orders WHERE status_id = '0';";
	$resultOrd = mysqli_query($conn, $sqlOrd);
	$b = mysqli_num_rows($resultOrd);
	$sqlOrddd = "SELECT orders.order_id FROM orders WHERE status_id = '1';";
	$resultOrddd = mysqli_query($conn, $sqlOrddd);
	$c = mysqli_num_rows($resultOrddd);
	$sqlOrdd = "SELECT orders.order_id FROM orders WHERE status_id = '2';";
	$resultOrdd = mysqli_query($conn, $sqlOrdd);
	$d = mysqli_num_rows($resultOrdd);
	// $sqlCat = "SELECT category.category_id FROM category WHERE status = '1';";
	// $resultCat = mysqli_query($conn, $sqlCat);
	// $e = mysqli_num_rows($resultCat);
	// $sqlNews = "SELECT news.news_id FROM news WHERE status = '1';";
	// $resultNews = mysqli_query($conn, $sqlNews);
	// $f = mysqli_num_rows($resultNews);
	// $sqlUser = "SELECT user.user_id FROM user WHERE status = '1';";
	// $resultUser = mysqli_query($conn, $sqlUser);
	// $g = mysqli_num_rows($resultUser);
	$sqlOrddd = "SELECT orders.order_id FROM orders WHERE status_id = '3';";
	$resultOrddd = mysqli_query($conn, $sqlOrddd);
	$h = mysqli_num_rows($resultOrddd);
	// $sqlPay = "SELECT paymentMethods.pay_id FROM paymentMethods WHERE status = '1';";
	// $resultPay = mysqli_query($conn, $sqlPay);
	// $i = mysqli_num_rows($resultPay);
	$sqlPaper = "SELECT * FROM storage WHERE storage_id = '1';";
	$resultPaper = mysqli_query($conn, $sqlPaper);
    $j = mysqli_fetch_assoc($resultPaper);
	$sqlInk = "SELECT * FROM storage WHERE storage_id = '2';";
	$resultInk = mysqli_query($conn, $sqlInk);
    $k = mysqli_fetch_assoc($resultInk);
?>
<?php
require('carbon/autoload.php');
require('Classes/PHPExcel.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;
date_default_timezone_set("Asia/Ho_Chi_Minh");
$today = date('Y-m-d');
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
$subdays7 = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
$subdays28 = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
$subdays90 = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
$subdays365 = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
$Sum = 0; $Sum7 = 0; $Sum28 = 0; $Sum90 = 0; $Sum365 = 0;
$Qty = 0; $Qty7 = 0; $Qty28 = 0; $Qty90 = 0; $Qty365 = 0;
//Tinh doanh thu hom nay
$sqlSum = "SELECT * FROM orders WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created LIKE '%".$today."%'";
$sql_query = mysqli_query($conn,$sqlSum);
$Ord = mysqli_num_rows($sql_query);
while($sqlSum = mysqli_fetch_array($sql_query)) {
    $Sum += $sqlSum['amount'];
}
//Tinh doanh thu 7 ngay gan nhat
$sqlSum7 = "SELECT * FROM orders WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created BETWEEN '$subdays7' AND '$now'";
$sql_query1 = mysqli_query($conn,$sqlSum7);
$Ord7 = mysqli_num_rows($sql_query1);
while($sqlSum7 = mysqli_fetch_array($sql_query1)) {
    $Sum7 += $sqlSum7['amount'];
}
//Tinh doanh thu 28 ngay gan nhat
$sqlSum28 = "SELECT * FROM orders WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created BETWEEN '$subdays28' AND '$now'";
$sql_query2 = mysqli_query($conn,$sqlSum28);
$Ord28 = mysqli_num_rows($sql_query2);
while($sqlSum28 = mysqli_fetch_array($sql_query2)) {
    $Sum28 += $sqlSum28['amount'];
}
//Tinh doanh thu 90 ngay gan nhat
$sqlSum90 = "SELECT * FROM orders WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created BETWEEN '$subdays90' AND '$now'";
$sql_query3 = mysqli_query($conn,$sqlSum90);
$Ord90 = mysqli_num_rows($sql_query3);
while($sqlSum90 = mysqli_fetch_array($sql_query3)) {
    $Sum90 += $sqlSum90['amount'];
}
//Tinh doanh thu 365 ngay gan nhat
$sqlSum365 = "SELECT * FROM orders WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created BETWEEN '$subdays365' AND '$now'";
$sql_query4 = mysqli_query($conn,$sqlSum365);
$Ord365 = mysqli_num_rows($sql_query4);
while($sqlSum365 = mysqli_fetch_array($sql_query4)) {
    $Sum365 += $sqlSum365['amount'];
}
//Tinh so san pham ban trong hom nay
$sqlQty = "SELECT * FROM orders INNER JOIN orderdetail ON orders.order_id = orderdetail.order_id WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created LIKE '%".$today."%'";
$sql_query9 = mysqli_query($conn,$sqlQty);
while($sqlQty = mysqli_fetch_array($sql_query9)) {
    $Qty += $sqlQty['qty'];
}
//Tinh so san pham ban trong 7 ngay gan nhat
$sqlQty7 = "SELECT * FROM orders INNER JOIN orderdetail ON orders.order_id = orderdetail.order_id WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created BETWEEN '$subdays7' AND '$now'";
$sql_query5 = mysqli_query($conn,$sqlQty7);
while($sqlQty7 = mysqli_fetch_array($sql_query5)) {
    $Qty7 += $sqlQty7['qty'];
}
//Tinh so san pham ban trong 28 ngay gan nhat
$sqlQty28 = "SELECT * FROM orders INNER JOIN orderdetail ON orders.order_id = orderdetail.order_id WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created BETWEEN '$subdays28' AND '$now'";
$sql_query6 = mysqli_query($conn,$sqlQty28);
while($sqlQty28= mysqli_fetch_array($sql_query6)) {
    $Qty28 += $sqlQty28['qty'];
}
//Tinh so san pham ban trong 90 ngay gan nhat
$sqlQty90 = "SELECT * FROM orders INNER JOIN orderdetail ON orders.order_id = orderdetail.order_id WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created BETWEEN '$subdays90' AND '$now'";
$sql_query7 = mysqli_query($conn,$sqlQty90);
while($sqlQty90 = mysqli_fetch_array($sql_query7)) {
    $Qty90 += $sqlQty90['qty'];
}
//Tinh so san pham ban trong 365 ngay gan nhat
$sqlQty365 = "SELECT * FROM orders INNER JOIN orderdetail ON orders.order_id = orderdetail.order_id WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created BETWEEN '$subdays365' AND '$now'";
$sql_query8 = mysqli_query($conn,$sqlQty365);
while($sqlQty365 = mysqli_fetch_array($sql_query8)) {
    $Qty365 += $sqlQty365['qty'];
}
//Tinh so don moi hom nay
$sqlOrdm = "SELECT * FROM orders WHERE created LIKE '%".$today."%'";
$sql_query15 = mysqli_query($conn,$sqlOrdm);
$Ordm = mysqli_num_rows($sql_query15);
//Tinh so don moi trong 7 ngay gan nhat
$sqlOrdm7 = "SELECT * FROM orders WHERE created BETWEEN '$subdays7' AND '$now'";
$sql_query16 = mysqli_query($conn,$sqlOrdm7);
$Ordm7 = mysqli_num_rows($sql_query16);
//Tinh so don moi trong 28 ngay gan nhat
$sqlOrdm28 = "SELECT * FROM orders WHERE created BETWEEN '$subdays28' AND '$now'";
$sql_query17 = mysqli_query($conn,$sqlOrdm28);
$Ordm28 = mysqli_num_rows($sql_query17);
//Tinh so don moi trong 90 ngay gan nhat
$sqlOrdm90 = "SELECT * FROM orders WHERE created BETWEEN '$subdays90' AND '$now'";
$sql_query18 = mysqli_query($conn,$sqlOrdm90);
$Ordm90 = mysqli_num_rows($sql_query18);
//Tinh so don moi trong 365 ngay gan nhat
$sqlOrdm365 = "SELECT * FROM orders WHERE created BETWEEN '$subdays365' AND '$now'";
$sql_query19 = mysqli_query($conn,$sqlOrdm365);
$Ordm365 = mysqli_num_rows($sql_query19);
//Tinh so don bi huy hom nay
$sqlOrdh = "SELECT * FROM orders WHERE status_id = '4' AND created LIKE '%".$today."%'";
$sql_query10 = mysqli_query($conn,$sqlOrdh);
$Ordh = mysqli_num_rows($sql_query10);
//Tinh so don bi huy trong 7 ngay gan nhat
$sqlOrdh7 = "SELECT * FROM orders WHERE status_id = '4' AND created BETWEEN '$subdays7' AND '$now'";
$sql_query11 = mysqli_query($conn,$sqlOrdh7);
$Ordh7 = mysqli_num_rows($sql_query11);
//Tinh so don bi huy trong 28 ngay gan nhat
$sqlOrdh28 = "SELECT * FROM orders WHERE status_id = '4' AND created BETWEEN '$subdays28' AND '$now'";
$sql_query12 = mysqli_query($conn,$sqlOrdh28);
$Ordh28 = mysqli_num_rows($sql_query12);
//Tinh so don bi huy trong 90 ngay gan nhat
$sqlOrdh90 = "SELECT * FROM orders WHERE status_id = '4' AND created BETWEEN '$subdays90' AND '$now'";
$sql_query13 = mysqli_query($conn,$sqlOrdh90);
$Ordh90 = mysqli_num_rows($sql_query13);
//Tinh so don bi huy trong 365 ngay gan nhat
$sqlOrdh365 = "SELECT * FROM orders WHERE status_id = '4' AND created BETWEEN '$subdays365' AND '$now'";
$sql_query14 = mysqli_query($conn,$sqlOrdh365);
$Ordh365 = mysqli_num_rows($sql_query14);
//Lay ra san pham ban nhieu nhat
$sqlPrdn = "SELECT prd_id, N
			FROM (SELECT prd_id, SUM(qty) AS N 
				FROM orderdetail
				GROUP BY prd_id) A
			WHERE N IN (SELECT MAX(B.X) FROM(SELECT prd_id, SUM(qty) AS X 
						FROM orderdetail 
						GROUP BY prd_id) B)";
$sql_query20 = mysqli_query($conn,$sqlPrdn);
while ($row = $sql_query20->fetch_assoc()) {
	$N = $row['N']."<br>";
	$prdn_id = $row['prd_id']."<br>";
}
//Lay ra san pham ban it nhat
$sqlPrdi = "SELECT prd_id, I
			FROM (SELECT prd_id, SUM(qty) AS I 
				FROM orderdetail
				GROUP BY prd_id) A
			WHERE I IN (SELECT MIN(B.Y) FROM(SELECT prd_id, SUM(qty) AS Y 
						FROM orderdetail 
						GROUP BY prd_id) B)";
$sql_query21 = mysqli_query($conn,$sqlPrdi);
while ($row = $sql_query21->fetch_assoc()) {
	$I = $row['I']."<br>";
	$prdi_id = $row['prd_id']."<br>";
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active"><a style="text-decoration: none; color: #606468;" href="/CraftPaperModel2/admin/index.php">Trang chủ quản trị</a></li>
		</ol>
	</div><!--/.row--><br>	
	<!-- <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Trang chủ quản trị</h1>
		</div>
	</div>	 -->
	<div class="row">
		<!-- <div class="col-xs-12 col-md-6 col-lg-3">
			<a href="index.php?page=user">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked-male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($g,0,",","."); ?></div>
							<div class="text-muted">Tài khoản</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<a href="index.php?page=news">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked-app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($f,0,",","."); ?></div>
							<div class="text-muted">Tin tức</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div  class="col-xs-12 col-md-6 col-lg-3">
		    <a href="index.php?page=category">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked-app-window"><use xlink:href="#stroked-app-window"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($e,0,",","."); ?></div>
							<div class="text-muted">Danh mục</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<a href="index.php?page=product">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($a,0,",","."); ?></div>
							<div class="text-muted">Sản phẩm</div>
						</div>
					</div>
				</div>
			</a>
		</div> -->
		<div class="col-xs-12 col-md-6 col-lg-3">
			<a href="index.php?page=order">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked-clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($h,0,",","."); ?></div>
							<div class="text-muted">Đơn đã xử lí</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<a href="index.php?page=order_delivering">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div style="background-color: green;" class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked-clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($d,0,",","."); ?></div>
							<div class="text-muted">Đơn đang giao</div>
		    			</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<a href="index.php?page=order_processed">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div style="background-color: orange;" class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked-clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>
				    	</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($c,0,",","."); ?></div>
							<div class="text-muted">Đơn đang xử lí</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<a href="index.php?page=order_unprocessed">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked-clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($b,0,",","."); ?></div>
							<div class="text-muted">Đơn chưa xử lí</div>
						</div>
		     		</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<a href="index.php?page=storage">
				<div class="panel panel-blue panel-widget">
					<div class="row no-padding">
						<div style="background-color: #444444;" class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked-paperclip"><use xlink:href="#stroked-paperclip"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($j['amount'],0,",","."); ?></div>
							<div class="text-muted">Giấy in trong kho</div>
							<?php if($j['amount'] < 3000) {
								echo "<script>alert('Số giấy in trong kho sắp hết');</script>";
							} ?>
						</div>
		     		</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<a href="index.php?page=storage">
				<div class="panel panel-blue panel-widget">
					<div class="row no-padding">
						<div style="background-color: #444444;" class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked-printer"><use xlink:href="#stroked-printer"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo number_format($k['amount'],0,",","."); ?></div>
							<div class="text-muted">Mực in trong kho</div>
							<?php if($k['amount'] < 50) {
								echo "<script>alert('Số mực in trong kho sắp hết');</script>";
							} ?>
						</div>
		     		</div>
				</div>
			</a>
		</div>
	</div><!--/.row--><br>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!--Dashboard-->
                    <br><h4><strong>Biểu đồ thống kê doanh thu theo đơn hàng trong:
                        <select style="border: none;" class="select-date">
                            <option value="7ngay">7 ngày qua</option>
                            <option value="28ngay">28 ngày qua</option>
                            <option value="90ngay">90 ngày qua</option>
                            <option value="365ngay">365 ngày qua</option>
                        </select><span hidden id="text-date"></span>
					</strong></h4><br>
                    <div id="chart" style="height: 250px;"></div><br>
                    <!--Bảng thống kê-->
                    <table style="text-align: center;" data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th><strong>Chi tiết thống kê</strong></th>
                                <th><strong>Hôm nay</strong></th>
                                <th><strong>7 ngày qua</strong></th>
                                <th><strong>28 ngày qua</strong></th>
                                <th><strong>90 ngày qua</strong></th>
                                <th><strong>365 ngày qua</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php ?> 
                                <tr>
                                    <td>Doanh thu bán hàng</td>
                                    <td><?php echo number_format($Sum,0,',','.'); ?></td>
                                    <td><?php echo number_format($Sum7,0,',','.'); ?></td>
                                    <td><?php echo number_format($Sum28,0,',','.'); ?></td>
                                    <td><?php echo number_format($Sum90,0,',','.'); ?></td>
                                    <td><?php echo number_format($Sum365,0,',','.'); ?></td>
                                </tr>
								<tr>
                                    <td>Số đơn hàng mới</td>
                                    <td><?php echo number_format($Ordm,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ordm7,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ordm28,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ordm90,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ordm365,0,',','.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Số đơn hàng được xử lý</td>
                                    <td><?php echo number_format($Ord,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ord7,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ord28,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ord90,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ord365,0,',','.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Số đơn hàng bị huỷ</td>
                                    <td><?php echo number_format($Ordh,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ordh7,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ordh28,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ordh90,0,',','.'); ?></td>
                                    <td><?php echo number_format($Ordh365,0,',','.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Số sản phẩm bán được</td>
                                    <td><?php echo number_format($Qty,0,',','.'); ?></td>
                                    <td><?php echo number_format($Qty7,0,',','.'); ?></td>
                                    <td><?php echo number_format($Qty28,0,',','.'); ?></td>
                                    <td><?php echo number_format($Qty90,0,',','.'); ?></td>
                                    <td><?php echo number_format($Qty365,0,',','.'); ?></td>
                                </tr>
                            <?php ?>
                        </tbody>
                    </table>
					<!--Thong ke san pham-->
                    <br><br><h4><strong>Thống kê sản phẩm:</strong></h4>
					<!-- <a style="border-radius: 6px;" href="index.php?page=export" class="btn btn-success">
						<i class="glyphicon glyphicon-plus"></i> Export
					</a> -->
					<table data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr style="text-align: center;">
								<th><strong>Thống kê theo</strong></th>
                                <th data-field="id" data-sortable="true"><strong>ID</strong></th>
                                <th data-field="name"  data-sortable="true"><strong>Tên sản phẩm</strong></th>
                                <th><strong>Ảnh sản phẩm</strong></th>
                                <th data-field="category"  data-sortable="true"><strong>Danh mục</strong></th>
                                <th data-field="price" data-sortable="true"><strong>Giá</strong></th>
                                <th data-field="kit" data-sortable="true"><strong>Số kit</strong></th>
                                <th><strong>Số lượng bán</strong></th>
                            </tr>
                        </thead>
                        <tbody>      
							<tr>
								<?php
									$sql_product = "SELECT * FROM product
									INNER JOIN category ON product.category_id = category.category_id
									WHERE prd_id = + '$prdn_id' ;";
									$resultPrdn = mysqli_query($conn, $sql_product);
									$row1 = mysqli_fetch_assoc($resultPrdn);
								?> 
								<td>Sản phẩm bán nhiều nhất</td>
								<td><?php echo $row1['prd_id']; ?></td>
								<td><?php echo $row1['prd_name']; ?></td>
								<td id = "img_col">
									<img width="120" height="100" src="images/product/<?php echo $row1['prd_image']; ?>" />
								</td>
								<td><?php echo $row1['category_name']; ?></td>
								<td><?php echo number_format($row1['prd_price'],0,",","."); ?>đ</td>
								<td><?php echo $row1['prd_kit']; ?></td>
								<td><?php echo $N ?></td>
								<?php ?>
							</tr>
							<tr>
								<?php
									$sql_product = "SELECT * FROM product
									INNER JOIN category ON product.category_id = category.category_id
									WHERE prd_id = + '$prdi_id' ;";
									$resultPrdi = mysqli_query($conn, $sql_product);
									$row2 = mysqli_fetch_assoc($resultPrdi)
								?> 
								<td>Sản phẩm bán ít nhất</td>
								<td><?php echo $row2['prd_id']; ?></td>
								<td><?php echo $row2['prd_name']; ?></td>
								<td id = "img_col">
									<img width="120" height="100" src="images/product/<?php echo $row2['prd_image']; ?>" />
								</td>
								<td><?php echo $row2['category_name']; ?></td>
								<td><?php echo number_format($row2['prd_price'],0,",","."); ?>đ</td>
								<td><?php echo $row2['prd_kit']; ?></td>
								<td><?php echo $I ?></td>
								<?php ?>
							</tr>
                        </tbody>
                    </table>
                </div><br>
            </div>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
<style>
    #img_col {
        text-align: center !important;
    }
    table thead tr th {text-align: center;}
</style>