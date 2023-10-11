<?php
    //Thêm phương thức thanh toán
    if(isset($_POST['sbm'])) {
        if(empty($_POST['pay_name'])) {
            echo "Bạn chưa nhập tên phương thức thanh toán";
        }else{
            $pay_name = $_POST['pay_name'];
        }
        $status = 1;

        $sqlInsert = "INSERT INTO paymentMethods(pay_name, status) VALUES 
        ('$pay_name', '$status')";

        if(mysqli_query($conn, $sqlInsert)) {
            header("location: index.php?page=payment");
        }else{
            echo "<script>alert('Thêm phương thức thanh toán không thành công');</script>";
        }
    }   
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a style="text-decoration: none; color: #606468;" href="index.php?page=payment">Quản lý phương thức thanh toán</a></li>
            <li class="active">Thêm phương thức thanh toán</li>
        </ol>
    </div><!--/.row-->    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm phương thức thanh toán</h1>
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
                            <input required name="pay_name" class="form-control" placeholder=""><br>
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