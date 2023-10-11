<?php 
    if(isset($_POST['search_payment'])){
        $keyword = $_POST['keyword'];
        $rowPerPage = 7; //Số danh mục trên 1 trang.
        $sql_payment = "SELECT * FROM paymentMethods WHERE status = 1 AND pay_name LIKE '%$keyword%'";
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
        $sql_pagination = "SELECT * FROM paymentMethods WHERE status = 1 AND pay_name LIKE '%$keyword%' 
        ORDER BY pay_id DESC LIMIT $start,$rowPerPage";
        $resultPagination = mysqli_query($conn, $sql_pagination);
    }else{
        header("location: index.php?page=payment");
    }
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
            <h1 class="page-header">Danh sách phương thức thanh toán chứa từ khoá "<?php echo $_POST['keyword']; ?>"</h1>
        </div>
    </div><!--/.row-->   
    <?php if (checkPrivilege('index.php?page=add_payment')) { ?>
        <div id="toolbar" class="btn-group">      
            <a href="index.php?page=add_payment" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm phương thức thanh toán
            </a>
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
                    </table><br>
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