<?php 
    if(isset($_POST['search_news'])){
        $keyword = $_POST['keyword'];
        $rowPerPage = 100; //Số tin tức trên 1 trang.
        $sql_news = "SELECT * FROM news WHERE status = 1 AND news_name LIKE '%$keyword%'";
        $resultAll = mysqli_query($conn, $sql_news);
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
        $sql_pagination = "SELECT * FROM news WHERE status = 1 AND news_name LIKE '%$keyword%' 
        ORDER BY news_id DESC LIMIT $start,$rowPerPage";
        $resultPagination = mysqli_query($conn, $sql_pagination);
    }else{
        header("location: index.php?page=news");
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"><a style="text-decoration: none; color: #606468;" href="index.php?page=news">Danh sách tin tức</li></a>
        </ol>
    </div><!--/.row-->  
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách tin tức chứa từ khoá "<?php echo $_POST['keyword']; ?>"</h1>
        </div>
    </div><!--/.row-->   
    <?php if (checkPrivilege('index.php?page=add_news')) { ?>
        <div id="toolbar" class="btn-group">      
            <a href="index.php?page=add_news" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm tin tức
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
                                <th data-field="name"  data-sortable="true">Tên tin tức</th>
                                <th>Ảnh tin tức</th>
                                <th data-field="created" data-sortable="true">Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  if(mysqli_num_rows($resultAll) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultPagination)) {
                            ?>      
                                <tr>
                                    <td style=""><?php echo $row['news_id']; ?></td>
                                    <td style=""><?php echo $row['news_name']; ?></td>
                                    <td id = "img_col">
                                        <img width="120" height="100" src="images/news/<?php echo $row['news_image']; ?>" />
                                    </td>
                                    <td style=""><?php echo date("d-m-Y",strtotime($row['news_created'])); ?></td>
                                    <td class="form-group">
                                        <?php if (checkPrivilege('index.php?page=edit_news&news_id='.$row['news_id'])) { ?>
                                            <a title="Sửa" href="index.php?page=edit_news&news_id=<?php echo $row['news_id']; ?>" class="btn btn-warning">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                        <?php } ?>
                                            <a title="Xoá" onclick="return confirmDel();" href="modules/news/del_news.php?news_id=<?php echo $row['news_id']; ?>" class="btn btn-danger">
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