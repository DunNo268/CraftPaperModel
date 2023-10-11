<?php
    if(isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $sqlOrder_detail = "SELECT * FROM orderdetail 
        INNER JOIN product ON orderdetail.prd_id = product.prd_id
        INNER JOIN orders ON orderdetail.order_id = orders.order_id
        INNER JOIN paymentMethods ON paymentMethods.pay_id = orders.pay_id
        INNER JOIN user ON orders.user_id = user.user_id
        WHERE orderdetail.order_id = $order_id";
        $resultOrder_detail = mysqli_query($conn, $sqlOrder_detail);
    }else{
        header('location: index.php?page=orders');
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active"><a style="text-decoration: none; color: #606468;" href="index.php?page=order">Quản lý đơn hàng</a></li>
		</ol>
	</div><!--/.row-->	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản lý đơn hàng</h1>
		</div>
	</div><!--/.row-->
	<div class="row">
        <div class="col-12">
            <ul></ul>
        </div>
		<div class="col-md-12">
            <div class="panel panel-default">
                    <div class="panel-body">
                        <table  data-toolbar="#toolbar"data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="prd_name" data-sortable="true">Tên sản phẩm</th>
                                    <th data-field="prd_image" data-sortable="true">Hình ảnh sản phẩm</th>
                                    <th data-field="prd_kit" data-sortable="true">Số kit</th>
                                    <th data-field="prd_price" data-sortable="true">Giá sản phẩm</th>
                                    <th data-field="qty" data-sortable="true">Số lượng</th>
                                    <th data-field="payment" data-sortable="true">Phương thức thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                $customerPrinted = false; // Biến để kiểm tra xem tên khách hàng đã được in hay chưa
                                if (mysqli_num_rows($resultOrder_detail)) {
                                    while ($row = mysqli_fetch_assoc($resultOrder_detail)) {
                                        if (!$customerPrinted) {
                                            echo '<ul>';
                                            echo '<b>Tên khách hàng:</b> ' . $row['customer_name']; 
                                            if ($row['status_id'] != 0){ echo '<br><b>Người duyệt đơn: </b>' . $row['user_full'];}
                                            echo '</ul>';
                                            $customerPrinted = true; // Đánh dấu rằng tên khách hàng đã được in ra
                                        }
                                ?>
                                    <tr>
                                        <td style=""><?php echo $row['prd_id']; ?></td>
                                        <td style=""><?php echo $row['prd_name']; ?></td>
                                        <td id="img_col">
                                            <img width="140" height="120" src="images/product/<?php echo $row['prd_image']; ?>" />
                                        </td>
                                        <td style=""><?php echo $row['prd_kit']; ?></td>
                                        <td style=""><?php echo number_format($row['prd_price'], 0, ",", "."); ?>đ</td>
                                        <td style=""><?php echo $row['qty']; ?></td>
                                        <td style=""><?php echo $row['pay_name']; ?></td>
                                    </tr>
                                <?php         
                                    }
                                } 
                                ?>
                            </tbody>
                            <?php if (checkPrivilege('index.php?page=edit_status&order_id='.$order_id)) { ?>
                                <a title="Sửa trạng thái đơn hàng" href="index.php?page=edit_status&order_id=<?php echo $order_id; ?>" class="btn btn-warning">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            <?php } ?>
                        </table>
                    </div>
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
</style>