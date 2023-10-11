<?php
    //Lấy các thông tin của danh mục cần sửa
    if(isset($_GET['news_id'])) {
        $news_id = $_GET['news_id'];
        $sqlnews = "SELECT * FROM news INNER JOIN user ON news.user_id = user.user_id WHERE news_id = $news_id";
        $resultnews = mysqli_query($conn, $sqlnews);
        $newsEdit = mysqli_fetch_assoc($resultnews);
        //Sửa danh mục
        //Lấy thông tin mới
        if(isset($_POST['sbm'])) {
            if(empty($_POST['news_name'])) {
                echo "Bạn chưa nhập tên tin tức!";
            }else{
                $news_name = $_POST['news_name'];
            }
            if(isset($_FILES['news_image'])) {
                if($_FILES['news_image']['name']) {
                    if($_FILES['news_image']['error'] > 0) {
                        $news_image = 'no-img.png';
                    }else{
                        $news_image = $_FILES['news_image']['name'];
                        $tmp_name = $_FILES['news_image']['tmp_name'];
                        $target_file = "images/news/".$_FILES['news_image']['name'];
                        move_uploaded_file($tmp_name, $target_file);
                    }
                }else{
                    $news_image = $newsEdit['news_image'];
                }
                
            }else{
                $news_image = $newsEdit['news_image'];
            }
            if(empty($_POST['news_featured'])) {
                $news_featured = 0;
            }else{
                $news_featured = 1;
            }
            $news_short = $_POST['news_short'];
            $news_details = $_POST['news_details'];

            $sqlUpdate = "UPDATE news SET
                    news_name = '$news_name',
                    news_image = '$news_image',
                    news_featured = '$news_featured',
                    news_short = '$news_short',
                    news_details = '$news_details'
                    WHERE news_id = $news_id
            ";

            if(mysqli_query($conn, $sqlUpdate)) {
                header("location: index.php?page=news");
            }else{
                echo "<script>alert('Cập nhật tin tức không thành công');</script>";
            }
        }
    }else{
        header('location: index.php?page=news');
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a href="">Quản lý tin tức</a></li>
            <li class="active"><?php echo $newsEdit['news_name']; ?></li>
        </ol>
    </div><!--/.row-->  
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tin tức: <?php echo $newsEdit['news_name']; ?></h1>
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
                            <input type="text" name="news_name" required class="form-control" value="<?php echo $newsEdit['news_name']; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Ảnh tin tức</label>
                            <input type="file"  name="news_image" onchange="preview();"><br>
                            <div>
                                <img width="340px" height="200px" id="news_image" src="images/news/<?php echo $newsEdit['news_image']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Người viết</label>
                            <input disabled name="user_full" required class="form-control" value="<?php echo $newsEdit['user_full']; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Ngày viết</label>
                            <input disabled name="news_created" required class="form-control" value="<?php echo date("d-m-Y",strtotime($newsEdit['news_created'])); ?>">
                        </div>
                        <div class="form-group">
                            <label>Tin tức nổi bật</label>
                            <div class="checkbox">
                                <label>
                                    <?php if($newsEdit['news_featured'] == 1) {
                                    ?>
                                        <input checked name="news_featured" type="checkbox" value=1>Nổi bật
                                    <?php }else{ ?>
                                        <input name="news_featured" type="checkbox" value=1>Nổi bật
                                    <?php } ?>
                                </label>
                            </div>
                        </div>       
                        <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tin tức ngắn</label>
                            <textarea id="news_short" name="news_short" required class="form-control" rows="5"><?php echo $newsEdit['news_short']; ?></textarea>
                        </div>  
                        <div class="form-group">
                            <label>Chi tiết tin tức</label>
                            <textarea id="news_details" name="news_details" required class="form-control" rows="15"><?php echo $newsEdit['news_details']; ?></textarea>
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