<?php
    $user = $_SESSION['user_login'];
    $user_id = $user['user_id'];
    $user_full = $user['user_full'];
    //Thêm sản phẩm
    if(isset($_POST['sbm'])) {
        if(empty($_POST['news_name'])) {
            echo "Bạn chưa nhập tên tin tức";
        }else{
            $news_name = $_POST['news_name'];
        }
        if(isset($_FILES['news_image'])) {
            if($_FILES['news_image']['error'] > 0) {
                $news_image = 'no-img.png';
            }else{
                $news_image = $_FILES['news_image']['name']; 
                $tmp_name = $_FILES['news_image']['tmp_name'];
                $target_file = "images/news/".$_FILES['news_image']['name'];      
            }    
        }
        if(empty($_POST['news_featured'])) {
            $news_featured = 0;
        }else{
            $news_featured = 1;
        }
        $news_short = $_POST['news_short'];
        $news_details = $_POST['news_details'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $news_created = date('Y-m-d H:i:s'); //datetime
        $status = 1;
        
        $sqlInsert = "INSERT INTO news(news_name, news_image, news_featured, news_short, news_details, news_created, status, user_id) VALUES 
        ('$news_name', '$news_image', '$news_featured', '$news_short', '$news_details', '$news_created', '$status', '$user_id')";

        if(mysqli_query($conn, $sqlInsert)) {
            move_uploaded_file($tmp_name, $target_file);
            header("location: index.php?page=news");
        }else{
            echo "<script>alert('Thêm tin tức không thành công');</script>";
        }
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a href="">Quản lý tin tức</a></li>
            <li class="active">Thêm tin tức</li>
        </ol>
    </div><!--/.row-->  
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm tin tức</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Tên tin tức</label>
                            <input required name="news_name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Người viết</label>
                            <input disabled required name="user_full" value="<?php echo $user_full; ?>" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Ảnh tin tức</label>
                            <input required name="news_image" type="file" onchange="preview();"><br>
                            <div>
                                <img id="news_image" width="340px" height="200px" src="img/no-img.png">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tin tức nổi bật</label>
                            <div class="checkbox">
                                <label>
                                    <input name="news_featured" type="checkbox" value=1>Nổi bật
                                </label>
                            </div>
                        </div>
                        <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>                                                                                   
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tin tức ngắn</label>
                            <textarea id="news_short" name="news_short" required class="form-control" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Chi tiết tin tức</label>
                            <textarea id="news_details" name="news_details" required class="form-control" rows="12"></textarea>
                        </div>                        
                    </div>
                </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->   
</div>	<!--/.main-->
<script>
    function preview() {
        news_image.src=URL.createObjectURL(event.target.files[0]);
    }
</script>
<script>
    CKEDITOR.replace( 'news_short' );
    CKEDITOR.replace( 'news_details' );
</script>