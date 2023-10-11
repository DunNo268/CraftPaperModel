<?php 
    $rowPerPage = 12; //Số sản phẩm trên 1 trang.
    $sql_product = "SELECT * FROM product WHERE status = 1";
    $resultAll = mysqli_query($conn, $sql_product);
    $totalRecords = mysqli_num_rows($resultAll); //số bản ghi lấy được.
    //Tổng số trang
    $totalPage = ceil($totalRecords/$rowPerPage);
    //lấy trang hiện tại từ đường dẫn.
    if(isset($_GET['current_page'])) {
        $current_page = $_GET['current_page'];
    }else{
        $current_page = 1;
    }   
    if($current_page < 1) {
        $current_page = 1;
    }
    if($current_page > $totalPage) {
        $current_page = $totalPage;
    }
    // SELECT * FROM table_name LIMIT $start,$rowPerPage;
    $start = ($current_page - 1)*$rowPerPage;
    $sql_pagination = "SELECT * FROM product WHERE status = 1 ORDER BY prd_id DESC LIMIT $start,$rowPerPage";
    $resultPagination = mysqli_query($conn, $sql_pagination);
?>
<div style="width: 100%;">
    <img style="max-width: 100%;" src="imgs\product\b4.png">
</div>
<div style="width: 100%; display: flex;">
    <div style="width: 50%; margin: auto; text-align: center;">
        <br><br><h4>-------- Bạn đang ở trang Sản phẩm --------</h4><br><br>
    </div>
</div>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: justify;">
        <a style="text-decoration: none; color: #35417A;" href="index.php?page_layout=product_all"><strong>Sản phẩm</strong></a> - DunNo Kit cung cấp các <em><strong>bộ mô hình giấy</strong></em> thủ công được in theo tiêu chuẩn chất lượng tốt nhất. Thông qua các bộ mô hình được cập nhật liên tục, quý khách có thể nắm bắt, sưu tập thêm được nhiều mô hình thú vị.<br><br><hr><br><br>
    </div>
</div>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: center;">
        <div class="products">
            <div class="product-list row">
                <?php  if(mysqli_num_rows($resultAll) > 0) {
                    while ($row = mysqli_fetch_assoc($resultPagination)) {
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
        </div><br>
        <div class="pagination">
            <!-- Hiển thị nút trở về trang trước -->
            <?php if($current_page > 1) { ?>
                <a href="index.php?page_layout=product_all&current_page=<?php echo $current_page-1; ?>">&laquo;</a>
            <?php }else { ?>
                <a class="disabled" href="">&laquo;</a>
            <?php } ?>
            <!-- Page menu item -->
            <?php for($i = 1; $i <= $totalPage; $i++) { 
                    if($i > $current_page - 3 && $i < $current_page + 3) { 
                        if($i == $current_page) {   
            ?>
                            <a class="active" href="index.php?page_layout=product_all&current_page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php }else { ?>
                            <a href="index.php?page_layout=product_all&current_page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php 
                    }
                }
            }
            ?>
            <!-- Hiển thị nút next trang -->
            <?php if($current_page < $totalPage) { ?>
                <a href="index.php?page_layout=product_all&current_page=<?php echo $current_page + 1; ?>">&raquo;</a>
            <?php }else {?>
                <a class="disabled" href="">&raquo;</a>
            <?php } ?>
        </div>
    </div>
</div><br><br>
<link rel="stylesheet" href="css/oldd.css">
<style>
.pagination {
    display: inline-block;
}
.pagination a {
    color: #4678b2;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    border: 0.5px solid #ddd;
}
.pagination a.disabled {
    background-color: white;
    color: black;
    border: 0.5px solid #ddd;
    pointer-events: none;
}
.pagination a.active {
    background-color: #4678b2;
    color: white;
    border: 0.5px solid #4678b2;
}
.pagination a:hover:not(.active) {background-color: #ddd;}
.pagination a:first-child {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}
.pagination a:last-child {
border-top-right-radius: 5px;
border-bottom-right-radius: 5px;
}
#myDIV {
  width: 100%;
  height: 100%;
  background-color: #eef2f4;
}
</style>
<script>
    function myFunction() {
        var x = document.getElementById('myDIV');
        if (x.style.display === 'none') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    }
</script>
