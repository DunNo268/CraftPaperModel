<?php 
    //Lấy các thông tin của sản phẩm cần sửa
    if(isset($_GET['prd_id'])) {
        $prd_id = $_GET['prd_id'];
        $sqlProd = "SELECT * FROM product WHERE prd_id = $prd_id";
        $resultProd = mysqli_query($conn, $sqlProd);
        $prodEdit = mysqli_fetch_assoc($resultProd);
        //Sửa sản phẩm
        //Lấy thông tin mới
        if(isset($_POST['sbm'])) {
            if(empty($_POST['prd_name'])) {
                echo "Bạn chưa nhập tên sản phẩm!";
            }else{
                $prd_name = $_POST['prd_name'];
            }
            if(isset($_FILES['prd_image'])) {
                if($_FILES['prd_image']['name']) {
                    if($_FILES['prd_image']['error'] > 0) {
                        $prd_image = 'no-img.png';
                    }else{
                        $prd_image = $_FILES['prd_image']['name'];
                        $tmp_name = $_FILES['prd_image']['tmp_name'];
                        $target_file = "images/product/".$prd_image;
                        move_uploaded_file($tmp_name, $target_file);
                    }
                }else{
                    $prd_image = $prodEdit['prd_image'];
                }               
            }else{
                $prd_image = $prodEdit['prd_image'];
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
            
            $sqlUpdate = "UPDATE product SET
                prd_name = '$prd_name',
                prd_image = '$prd_image',
                prd_price = $prd_price,
                prd_kit = '$prd_kit',
                prd_featured = '$prd_featured',
                category_id = '$category_id',
                prd_details = '$prd_details'
                WHERE prd_id = $prd_id";
            if(mysqli_query($conn, $sqlUpdate)) {                
                header("location: index.php?page=product");
            }else{
                echo "<script>alert('Cập nhật sản phẩm không thành công');</script>";
            }
        }
    }else{
        header('location: index.php?page=product');
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/CraftPaperModel2/admin/index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li><a style="text-decoration: none; color: #606468;" href="index.php?page=product">Quản lý sản phẩm</a></li>
            <li class="active"><?php echo $prodEdit['prd_name']; ?></li>
        </ol>
    </div><!--/.row-->   
    <div class="row">
        <div class="col-lg-12">
            <h1 style="font-size:30px;" class="page-header">Sản phẩm: <?php echo $prodEdit['prd_name']; ?></h1>
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
                            <input type="text" name="prd_name" required class="form-control" value="<?php echo $prodEdit['prd_name']; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label>
                            <select name="category_id" required class="form-control">
                                <?php
                                $sqlCat = "SELECT * FROM category ORDER BY category_id DESC";
                                $queryCat = mysqli_query($conn,$sqlCat);
                                while ($rowCat = mysqli_fetch_array($queryCat)){  
                                    if ($rowCat['category_id'] == $prodEdit['category_id']) {                           
                                ?>
                                <option selected value="<?php echo $rowCat['category_id']; ?>"><?php echo $rowCat['category_name']; ?></option>
                                <?php }else{
                                    ?>
                                    <option value="<?php echo $rowCat['category_id']; ?>"><?php echo $rowCat['category_name']; ?></option>
                                    <?php 
                                } }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Số kit</label>
                            <input type="number" min="0" name="prd_kit" required class="form-control" value="<?php echo $prodEdit['prd_kit']; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input type="number" min="0" name="prd_price" required value="<?php echo $prodEdit['prd_price']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm nổi bật</label>
                            <div class="checkbox">
                                <label>
                                    <?php if($prodEdit['prd_featured'] == 1) {
                                    ?>
                                        <input checked name="prd_featured" type="checkbox" value=1>Nổi bật
                                    <?php }else{ ?>
                                        <input name="prd_featured" type="checkbox" value=1>Nổi bật
                                    <?php } ?>
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>                     
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input type="file"  name="prd_image" onchange="preview();"><br>
                            <div>
                                <img width="300px" height="260px" id="prd_image" src="images/product/<?php echo $prodEdit['prd_image']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea height="30px;" id="prd_details" name="prd_details" required class="form-control" rows="5"><?php echo $prodEdit['prd_details']; ?></textarea>
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
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#prd_details' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>