<?php 
    $rowPerPage = 7; //Số sản phẩm trên 1 trang.
    $sql_order = "SELECT * FROM orders WHERE status_id = '1';";
    $resultAll = mysqli_query($conn, $sql_order);
    $totalRecords = mysqli_num_rows($resultAll); //số bản ghi lấy được.
    //Tổng số trang
    $totalPage = ceil($totalRecords/$rowPerPage);
    //lấy trang hiện tại từ đường dẫn.
    if(isset($_GET['current_page'])) {
        $current_page = $_GET['current_page'];
    }else{
        $current_page = 1;
    }    
    if($current_page < 1) {
        $current_page = 1;
    }
    if($current_page > $totalPage) {
        $current_page = $totalPage;
    }
    // SELECT * FROM table_name LIMIT $start,$rowPerPage;
    $start = ($current_page - 1)*$rowPerPage;
    $sql_pagination = "SELECT * FROM orders WHERE status_id = '1' ORDER BY order_id ASC LIMIT $start,$rowPerPage";
    $resultPagination = mysqli_query($conn, $sql_pagination);
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active"><a style="text-decoration: none; color: #606468;" href="index.php?page=order">Quản lý đơn hàng</li>
		</ol>
	</div><!--/.row-->	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Đơn đang xử lý</h1>
		</div>
	</div><!--/.row-->
	<div id="toolbar" class="btn-group">
        <a style="border-radius: 6px;" href="index.php?page=order" class="btn btn-primary">
			<i class="glyphicon glyphicon-plus"></i> Đơn đã xử lý
		</a>
        <a style="margin-left: 10px; border-radius: 6px;" href="index.php?page=order_delivering" class="btn btn-success">
			<i class="glyphicon glyphicon-plus"></i> Đơn đang giao hàng
		</a>
        <a style="margin-left: 10px; border-radius: 6px;" href="index.php?page=order_processed" style="background-color: orange;" class="btn btn-warning">
			<i class="glyphicon glyphicon-plus"></i> Đơn đang xử lý
		</a>
        <a style="margin-left: 10px; border-radius: 6px;" href="index.php?page=order_unprocessed" style="background-color: red;" class="btn btn-danger">
			<i class="glyphicon glyphicon-plus"></i> Đơn chưa xử lý
		</a>
        <a style="margin-left: 10px; border-radius: 6px;" href="index.php?page=cancel_order"  class="btn btn-info">
			<i class="glyphicon glyphicon-plus"></i> Đơn đã bị huỷ
		</a>
	</div>
	<div class="row">
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">	
                        <thead>
                        <tr>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="name" data-sortable="true">Tên khách hàng</th>
                            <th data-field="email" data-sortable="true">Email</th>
                            <th data-field="phone" data-sortable="true">Số điện thoại</th>
                            <th data-field="address" data-sortable="true">Địa chỉ</th>
                            <th data-field="amount" data-sortable="true">Tổng tiền</th>
                            <th data-field="kits" data-sortable="true">Tổng kit</th>
                            <th data-field="created" data-sortable="true">Ngày tạo</th>
                            <th data-field="status_id" data-sortable="true">Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php  if(mysqli_num_rows($resultAll) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultPagination)) {
                            ?> 
                                <tr>
                                    <td style=""><?php echo $row['order_id']; ?></td>
                                    <td style=""><?php echo $row['customer_name']; ?></td>
                                    <td style=""><?php echo $row['customer_email']; ?></td>
                                    <td style=""><?php echo $row['customer_phone']; ?></td>
                                    <td style=""><?php echo $row['customer_address']; ?></td>
                                    <td style=""><?php echo number_format($row['amount'],0,",","."); ?>đ</td>
                                    <td style=""><?php echo number_format($row['kits'],0,",","."); ?></td>
                                    <td style=""><?php echo date("d-m-Y",strtotime($row['created'])); ?></td>
                                    <td><span class="label label-warning">Đang xử lý</span></td>
                                    <td class="form-group">
                                        <?php if (checkPrivilege('index.php?page=order_detail&order_id='.$row['order_id'])) { ?>
                                            <a title="Xem" href="index.php?page=order_detail&order_id=<?php echo $row['order_id']; ?>" class="btn btn-primary">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                        <?php } ?>
                                            <a title="Cập nhật trạng thái" onclick="return confirmUpd();" href="modules/orders/edit_order.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-warning">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                        <?php if (checkPrivilege('index.php?page=del_order&order_id='.$row['order_id'])) { ?>
                                            <?php  if($row['status_id'] == "0") { ?>  
                                                <a title="Huỷ đơn" onclick="return confirmDel();" href="index.php?page=del_order&order_id=<?php echo $row['order_id']; ?>" class="btn btn-danger">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </a>
                                            <?php  } ?> 
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php         
                                    }
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <!-- Hiển thị nút trở về trang trước -->
                            <?php if($current_page > 1) { ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=order_processed&current_page=<?php echo $current_page-1; ?>">&laquo;</a></li>
                            <?php }else { ?>
                                <li class="page-item disabled"><a class="page-link" href="">&laquo;</a></li>
                            <?php } ?>
                            <!-- Page menu item -->
                            <?php for($i = 1; $i <= $totalPage; $i++) { 
                                    if($i > $current_page - 3 && $i < $current_page + 3) { 
                                        if($i == $current_page) {   
                            ?>
                                            <li class="page-item active"><a class="page-link" href="index.php?page=order_processed&current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php }else { ?>
                                            <li class="page-item"><a class="page-link" href="index.php?page=order_processed&current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php 
                                    }
                                }
                            }
                            ?>
                            <!-- Hiển thị nút next trang -->
                            <?php if($current_page < $totalPage) { ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=order_processed&current_page=<?php echo $current_page + 1; ?>">&raquo;</a></li>
                            <?php }else {?>
                                <li class="page-item disabled"><a class="page-link disabled" href="">&raquo;</a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
<script>
    function confirmDel() {
        return confirm("Bạn có chắc chắn huỷ đơn này?");
    }
    function confirmUpd() {
        return confirm("Bạn có chắc chắn muốn chuyển đơn này sang trạng thái đang giao hàng?");
    }
</script>
