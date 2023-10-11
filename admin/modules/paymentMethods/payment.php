<?php 
    $rowPerPage = 7; //Số danh mục trên 1 trang.
    $sql_payment = "SELECT * FROM paymentMethods WHERE status = 1";
    $resultAll = mysqli_query($conn, $sql_payment);
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
    $sql_pagination = "SELECT * FROM paymentMethods WHERE status = 1 ORDER BY pay_id DESC LIMIT $start,$rowPerPage";
    $resultPagination = mysqli_query($conn, $sql_pagination);
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"><a style="text-decoration: none; color: #606468;" href="index.php?page=payment">Danh sách phương thức thanh toán</li></a>
        </ol>
    </div><!--/.row-->   
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách phương thức thanh toán</h1>
        </div>
    </div><!--/.row-->   
    <?php if (checkPrivilege('index.php?page=add_payment')) { ?>
        <div id="toolbar" class="btn-group">      
            <a style="border-radius: 6px;" href="index.php?page=add_payment" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm phương thức thanh toán
            </a>
            <div class="search-container" style="float:left; margin-left: 10px;">
                <form action="index.php?page=search_payment" method="POST">
                    <input type="text" name="keyword" id="keyword" placeholder="Tìm kiếm phương thức thanh toán">
                    <button type="submit" name="search_payment" onclick="return validateSearch();"><i class="fa fa-search"></i></button>
                    <span id="keyword_error"></span>
                </form>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table  data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name"  data-sortable="true">Tên phương thức thanh toán</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  if(mysqli_num_rows($resultAll) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultPagination)) {
                            ?>      
                                <tr>
                                    <td style=""><?php echo $row['pay_id']; ?></td>
                                    <td style=""><?php echo $row['pay_name']; ?></td>
                                    <td class="form-group">
                                        <?php if (checkPrivilege('index.php?page=edit_payment&pay_id='.$row['pay_id'])) { ?>
                                            <a title="Sửa" href="index.php?page=edit_payment&pay_id=<?php echo $row['pay_id']; ?>" class="btn btn-warning">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                        <?php } ?>
                                            <a title="Xoá" onclick="return confirmDel();" href="modules/paymentMethods/del_payment.php?pay_id=<?php echo $row['pay_id']; ?>" class="btn btn-danger">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
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
                                <li class="page-item"><a class="page-link" href="index.php?page=payment&current_page=<?php echo $current_page-1; ?>">&laquo;</a></li>
                            <?php }else { ?>
                                <li class="page-item disabled"><a class="page-link" href="">&laquo;</a></li>
                           <?php } ?>
                            <!-- Page menu item -->
                            <?php for($i = 1; $i <= $totalPage; $i++) { 
                                    if($i > $current_page - 3 && $i < $current_page + 3) { 
                                        if($i == $current_page) {   
                            ?>
                                            <li class="page-item active"><a class="page-link" href="index.php?page=payment&current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php }else { ?>
                                            <li class="page-item"><a class="page-link" href="index.php?page=payment&current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php 
                                    }
                                }
                            }
                            ?>
                            <!-- Hiển thị nút next trang -->
                            <?php if($current_page < $totalPage) { ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=payment&current_page=<?php echo $current_page + 1; ?>">&raquo;</a></li>
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
<style>
    #img_col {
        text-align: center !important;
    }
</style>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>	
<script>
    function confirmDel() {
        return confirm("Bạn có chắc chắn xóa?");
    }
</script>
<script>
    function validateSearch() {
        const EMPTY_STR = "";
        var check = true;
        var keyword = document.getElementById('keyword');
        var keyword_error = document.getElementById('keyword_error');
        if(keyword.value == EMPTY_STR) {
            keyword.style.border = "1px solid red";
            keyword_error.innerHTML = "Bạn phải nhập từ khoá tìm kiếm";
            keyword_error.style.color = "red";
            check = false;
        }
        return check;
    }
</script>
<style>
.search-container input[type=text] {
  font-size: 17px;
  width: 290px;
  height: 31px;
  border: none;
}
.search-container button {
  background: #ddd;
  font-size: 17px;
  width: 35px;
  border: none;
  cursor: pointer;
}
.search-container button:hover {
  background: #ccc;
}
</style>