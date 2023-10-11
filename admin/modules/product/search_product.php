<?php
    if(isset($_POST['search_product'])){
        $keyword = $_POST['keyword'];
        $rowPerPage = 100; //Số sản phẩm trên 1 trang.
        $sql_product = "SELECT * FROM product
        INNER JOIN category ON product.category_id = category.category_id
        WHERE product.status = 1 AND prd_name LIKE '%$keyword%'";
        $resultAll = mysqli_query($conn, $sql_product);
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
        $sql_pagination = "SELECT * FROM product
        INNER JOIN category ON product.category_id = category.category_id
        WHERE product.status = 1 AND prd_name LIKE '%$keyword%'
        ORDER BY prd_id DESC LIMIT $start,$rowPerPage";
        $resultPagination = mysqli_query($conn, $sql_pagination);
    }else{
        header("location: index.php?page=product");
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"><a style="text-decoration: none; color: #606468;" href="index.php?page=product">Danh sách sản phẩm</li></a>
        </ol>
    </div><!--/.row-->   
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách sản phẩm chứa từ khoá "<?php echo $_POST['keyword']; ?>"</h1>
        </div>
    </div><!--/.row-->   
    <?php if (checkPrivilege('index.php?page=add_product')) { ?>
        <div id="toolbar" class="btn-group">      
            <a href="index.php?page=add_product" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
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
                                <th data-field="name"  data-sortable="true">Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th data-field="category"  data-sortable="true">Danh mục</th>
                                <th data-field="price" data-sortable="true">Giá</th>
                                <th data-field="kit" data-sortable="true">Số kit</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  if(mysqli_num_rows($resultAll) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultPagination)) {
                            ?>      
                                <tr>
                                    <td style=""><?php echo $row['prd_id']; ?></td>
                                    <td style=""><?php echo $row['prd_name']; ?></td>
                                    <td id = "img_col">
                                        <img width="120" height="100" src="images/product/<?php echo $row['prd_image']; ?>" />
                                    </td>
                                    <td style=""><?php echo $row['category_name']; ?></td>
                                    <td style=""><?php echo number_format($row['prd_price'],0,",","."); ?>đ</td>
                                    <td style=""><?php echo $row['prd_kit']; ?></td>
                                    <td class="form-group">
                                        <?php if (checkPrivilege('index.php?page=edit_product&prd_id='.$row['prd_id'])) { ?>
                                            <a title="Sửa" href="index.php?page=edit_product&prd_id=<?php echo $row['prd_id']; ?>" class="btn btn-warning">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                        <?php } ?>
                                            <a title="Xoá" onclick="return confirmDel();" href="modules/product/del_product.php?prd_id=<?php echo $row['prd_id']; ?>" class="btn btn-danger">
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