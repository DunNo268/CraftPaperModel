<?php
    //Thêm danh mục
    if(isset($_POST['sbm'])) {
        if(empty($_POST['category_name'])) {
            echo "Bạn chưa nhập tên danh mục";
        }else{
            $category_name = $_POST['category_name'];
        }
        $status = 1;

        $sqlInsert = "INSERT INTO category(category_name, status) VALUES 
        ('$category_name', '$status')";

        if(mysqli_query($conn, $sqlInsert)) {
            header("location: index.php?page=category");
        }else{
            echo "<script>alert('Thêm danh mục không thành công');</script>";
        }
    }   
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a style="text-decoration: none; color: #606468;" href="index.php?page=category">Quản lý danh mục</a></li>
            <li class="active">Thêm danh mục</li>
        </ol>
    </div><!--/.row-->   
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm danh mục</h1>
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
                            <input required name="category_name" class="form-control" placeholder=""><br>
                        </div>
                        <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>                                                                                   
                    </div>
                </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->   
</div>	<!--/.main-->