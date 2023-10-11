<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: left;">
        <div style="width: 50%; float: left; text-align: left;">
            <h2 style="font-size: 30px; color: #35417A;">Sản phẩm mới</h2>
        </div>
        <div style="width: 50%; float: left; text-align: right;">
            <a style="text-decoration: none; color: puprle;;" href="index.php?page_layout=product_all">
                <br><p style="margin-right: 20px;">Xem tất cả</p>
            </a>
        </div>
    </div>
</div>
<?php
    $sql_product = "SELECT * FROM product WHERE status = 1 ORDER BY prd_id DESC LIMIT 3";
    $resultAll = mysqli_query($conn, $sql_product);
    $totalRecords = mysqli_num_rows($resultAll);
?>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: center;">
        <div class="products">
            <div class="product-list row">
                <?php
                    if(mysqli_num_rows($resultAll)) {
                        while ($row = mysqli_fetch_assoc($resultAll)) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mx-product" >
                    <div style="background: rgba(143, 151, 156, 0.6); width:340px;">
                        <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>">
                            <img style="display: block; max-width: 340px; max-height: 340px; width: auto; height: auto;" src="admin/images/product/<?php echo $row['prd_image']; ?>">
                        </a>
                    </div>
                    <div style="background: rgba(143, 151, 156, 0.6); width:340px;" style="margin-top: 5px; margin-left: 0px;">
                        <strong>
                            <a style="text-decoration: none; color: black;" href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>">
                                <?php echo $row['prd_name']; ?>
                            </a>
                        </strong><br><br>
                    </div>
                    <div style="background: rgba(143, 151, 156, 0.6); width:340px;">
                        <a style="text-decoration: none;" href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>">
                            <p style="color: red;">
                                <?php echo number_format($row['prd_price'],0,",","."); ?>đ
                            </p><br>
                        </a>
                    </div>
                    <div style="background: rgba(143, 151, 156, 0.6); width:340px;" style="margin: auto;">
                        <a class="fancybox box-book-tour" style="text-decoration: none;" href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>">Xem thêm</a>
                    </div><br><br>
                </div>
                <?php 
                        }
                    }      
                ?>
            </div>
        </div>
    </div>
</div><br>
<link rel="stylesheet" href="css/oldd.css">
