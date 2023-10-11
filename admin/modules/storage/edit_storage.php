<?php 
    //Lấy các thông tin của danh mục cần sửa
    if(isset($_GET['storage_id'])) {
        $storage_id = $_GET['storage_id'];
        $sqlstorage = "SELECT * FROM storage WHERE storage_id = $storage_id";
        $resultstorage = mysqli_query($conn, $sqlstorage);
        $storageEdit = mysqli_fetch_assoc($resultstorage);
        //Sửa danh mục
        //Lấy thông tin mới
        if(isset($_POST['sbm'])) {
            $amount = $_POST['amount'];

            $sqlUpdate = "UPDATE storage SET amount = '$amount' WHERE storage_id = $storage_id";

            if(mysqli_query($conn, $sqlUpdate)) {
                header("location: index.php?page=storage");
            }else{
                echo "<script>alert('Cập nhật danh mục không thành công');</script>";
            }
        }
    }else{
        header('location: index.php?page=storage');
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a style="text-decoration: none; color: #606468;" href="index.php?page=storage">Quản lý vật liệu</a></li>
            <li class="active"><?php echo $storageEdit['storage_name']; ?></li>
        </ol>
    </div><!--/.row-->   
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Vật liệu: <?php echo $storageEdit['storage_name']; ?></h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Tên vật liệu</label>
                            <input disabled type="text" name="storage_name" required class="form-control" value="<?php echo $storageEdit['storage_name']; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="number" min="0" name="amount" required class="form-control" value="<?php echo $storageEdit['amount']; ?>" placeholder="">
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