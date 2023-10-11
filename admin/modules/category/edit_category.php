<?php 
    //Lấy các thông tin của danh mục cần sửa
    if(isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        $sqlcategory = "SELECT * FROM category WHERE category_id = $category_id";
        $resultcategory = mysqli_query($conn, $sqlcategory);
        $categoryEdit = mysqli_fetch_assoc($resultcategory);
        //Sửa danh mục
        //Lấy thông tin mới
        if(isset($_POST['sbm'])) {
            if(empty($_POST['category_name'])) {
                echo "Bạn chưa nhập tên danh mục!";
            }else{
                $category_name = $_POST['category_name'];
            }

            $sqlUpdate = "UPDATE category SET category_name = '$category_name' WHERE category_id = $category_id";

            if(mysqli_query($conn, $sqlUpdate)) {
                header("location: index.php?page=category");
            }else{
                echo "<script>alert('Cập nhật danh mục không thành công');</script>";
            }
        }
    }else{
        header('location: index.php?page=category');
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a style="text-decoration: none; color: #606468;" href="index.php?page=category">Quản lý danh mục</a></li>
            <li class="active"><?php echo $categoryEdit['category_name']; ?></li>
        </ol>
    </div><!--/.row-->   
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh mục: <?php echo $categoryEdit['category_name']; ?></h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" name="category_name" required class="form-control" value="<?php echo $categoryEdit['category_name']; ?>" placeholder="">
                        </div>                   
                        <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row --> 
</div>	<!--/.main-->