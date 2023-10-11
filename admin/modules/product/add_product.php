<?php
    //Thêm sản phẩm
    if(isset($_POST['sbm'])) {
        if(empty($_POST['prd_name'])) {
            echo "Bạn chưa nhập tên sản phẩm";
        }else{
            $prd_name = $_POST['prd_name'];
        }
        if(isset($_FILES['prd_image'])) {
            if($_FILES['prd_image']['error'] > 0) {
                $prd_image = 'no-img.png';
            }else{       
                $prd_image = $_FILES['prd_image']['name'];
                $tmp_name = $_FILES['prd_image']['tmp_name'];
                $target_file = "images/product/".$prd_image;
            }
        }
        $prd_price = $_POST['prd_price'];
        $prd_kit = $_POST['prd_kit'];
        if(empty($_POST['prd_featured'])) {
            $prd_featured = 0;
        }else{
            $prd_featured = 1;
        }
        $category_id = $_POST['category_id'];
        $prd_details = $_POST['prd_details'];
        $status = 1;
         
        $sqlInsert = "INSERT INTO product(prd_name, prd_image, prd_price, prd_kit, prd_featured, category_id, prd_details, status) VALUES 
        ('$prd_name', '$prd_image', '$prd_price', '$prd_kit', '$prd_featured', '$category_id', '$prd_details', '$status')";

        if(mysqli_query($conn, $sqlInsert)) {
            move_uploaded_file($tmp_name, $target_file);
            header("location: index.php?page=product");
        }else{
            echo "<script>alert('Thêm sản phẩm không thành công');</script>";
        }
    }   
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a style="text-decoration: none; color: #606468;" href="index.php?page=product">Quản lý sản phẩm</a></li>
            <li class="active">Thêm sản phẩm</li>
        </ol>
    </div><!--/.row-->   
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm sản phẩm</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input required name="prd_name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label>
                            <select name="category_id" required class="form-control">
                                <option>Chọn danh mục sản phẩm</option>
                                <?php
                                $sqlCat = "SELECT * FROM category ORDER BY category_id DESC";
                                $queryCat = mysqli_query($conn,$sqlCat);
                                while ($rowCat = mysqli_fetch_array($queryCat)){                                    
                                ?>
                                <option value="<?php echo $rowCat['category_id']; ?>"><?php echo $rowCat['category_name']; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>                                                           
                        <div class="form-group">
                            <label>Số kit</label>
                            <input required name="prd_kit" type="number" min="0" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input required name="prd_price" type="number" min="0" class="form-control">
                        </div>                                                         
                        <div class="form-group">
                            <label>Sản phẩm nổi bật</label>
                            <div class="checkbox">
                                <label>
                                    <input name="prd_featured" type="checkbox" value=1>Nổi bật
                                </label>
                            </div>
                        </div>
                        <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>                         
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input required name="prd_image" type="file" onchange="preview();"><br>
                            <div>
                                <img id="prd_image" width="300px" height="260px" src="img/no-img.png">
                            </div>
                        </div>                           
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea id="prd_details" required name="prd_details" class="form-control" rows="5"></textarea>
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
        prd_image.src=URL.createObjectURL(event.target.files[0]);
    }
</script>
<script>
    CKEDITOR.replace( 'prd_details' );
</script>