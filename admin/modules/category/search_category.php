<?php 
    if(isset($_POST['search_category'])){
        $keyword = $_POST['keyword'];
        $rowPerPage = 7; //Số danh mục trên 1 trang.
        $sql_category = "SELECT * FROM category WHERE status = 1 AND category_name LIKE '%$keyword%'";
        $resultAll = mysqli_query($conn, $sql_category);
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
        $sql_pagination = "SELECT * FROM category WHERE status = 1 AND category_name LIKE '%$keyword%'
        ORDER BY category_id DESC LIMIT $start,$rowPerPage";
        $resultPagination = mysqli_query($conn, $sql_pagination);
    }else{
        header("location: index.php?page=category");
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"><a style="text-decoration: none; color: #606468;" href="index.php?page=category">Danh sách danh mục</li></a>
        </ol>
    </div><!--/.row-->   
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách danh mục chứa từ khoá "<?php echo $_POST['keyword']; ?>"</h1>
        </div>
    </div><!--/.row-->   
    <?php if (checkPrivilege('index.php?page=add_category')) { ?>
        <div id="toolbar" class="btn-group">      
            <a href="index.php?page=add_category" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm danh mục
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
                                <th data-field="name"  data-sortable="true">Tên danh mục</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  if(mysqli_num_rows($resultAll) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultPagination)) {
                            ?>      
                                <tr>
                                    <td style=""><?php echo $row['category_id']; ?></td>
                                    <td style=""><?php echo $row['category_name']; ?></td>
                                    <td class="form-group">
                                        <?php if (checkPrivilege('index.php?page=edit_category&category_id='.$row['category_id'])) { ?>
                                            <a title="Sửa" href="index.php?page=edit_category&category_id=<?php echo $row['category_id']; ?>" class="btn btn-warning">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                        <?php } ?>
                                            <a title="Xoá" onclick="return confirmDel();" href="modules/category/del_category.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-danger">
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