<?php 
    //Lấy các thông tin của danh mục cần sửa
    if(isset($_GET['pay_id'])) {
        $pay_id = $_GET['pay_id'];
        $sqlpayment = "SELECT * FROM paymentMethods WHERE pay_id = $pay_id";
        $resultpayment = mysqli_query($conn, $sqlpayment);
        $paymentEdit = mysqli_fetch_assoc($resultpayment);
        //Sửa danh mục
        //Lấy thông tin mới
        if(isset($_POST['sbm'])) {
            if(empty($_POST['pay_name'])) {
                echo "Bạn chưa nhập tên danh mục!";
            }else{
                $pay_name = $_POST['pay_name'];
            }

            $sqlUpdate = "UPDATE paymentMethods SET
                    pay_name = '$pay_name'
                    WHERE pay_id = $pay_id";

            if(mysqli_query($conn, $sqlUpdate)) {
                header("location: index.php?page=payment");
            }else{
                echo "<script>alert('Cập nhật phương thức thanh toán không thành công');</script>";
            }
        }
    }else{
        header('location: index.php?page=payment');
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a style="text-decoration: none; color: #606468;" href="index.php?page=payment">Quản lý phương thức thanh toán</a></li>
            <li class="active"><?php echo $paymentEdit['pay_name']; ?></li>
        </ol>
    </div><!--/.row-->  
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Phương thức thanh toán: <?php echo $paymentEdit['pay_name']; ?></h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Tên phương thức thanh toán</label>
                            <input type="text" name="pay_name" required class="form-control" value="<?php echo $paymentEdit['pay_name']; ?>" placeholder="">
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