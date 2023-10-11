<?php 
    if(isset($_GET['prd_id'])) {
        $prd_id = $_GET['prd_id'];
        $sql = "SELECT * FROM product 
        INNER JOIN category ON product.category_id = category.category_id 
        WHERE prd_id = $prd_id";
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);
    }else{
        header("location: index.php");
    }
?>
<!--	List Product	-->
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: left;">
        <div id="product">
            <br><br><h3><?php echo $product['prd_name']; ?></h3><br><br>
            <div id="product-head" class="row">
                <div id="product-img">
                    <div style="width:50%; float: left;">
                        <img style="max-width: 450px; max-height: 450px; width: auto; height: auto;" src="admin/images/product/<?php echo $product['prd_image']; ?>">
                    </div>
                    <div style="width:50%; float: left;">
                        <br><h3 style="color: #b63b3b; text-transform: uppercase; text-align: justify;"><?php echo $product['prd_name']; ?></h3><br>
                        <span style="margin-left: 20px; color: red;" id="price"> <?php echo number_format($product['prd_price'],0,",","."); ?>đ</span><br><br>
                        <strong style="margin-left: 20px;">Số kit :</strong> <?php echo $product['prd_kit']; ?><br><hr style="border-top: 1px dashed #8c8b8b;"><br>
                        <strong style="margin-left: 20px;">Giấy in :</strong> Giấy Nhũ Stardream A4 120gsm<br><hr style="border-top: 1px dashed #8c8b8b;"><br>
                        <strong style="margin-left: 20px;">Kiểu in :</strong> In màu Laser<br><hr style="border-top: 1px dashed #8c8b8b;"><br>
                        <strong style="margin-left: 20px;">Danh mục sản phẩm :</strong> <?php echo $product['category_name']; ?><br><hr style="border-top: 1px dashed #8c8b8b;"><br>
                        <img style="max-width: 25px; max-height: 25px; width: auto; height: auto;" src="imgs/icons/hl.png"><span style="margin-left: 10px; color: green;">Hotline: 035 884 0802</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <img style="max-width: 25px; max-height: 25px; width: auto; height: auto;" src="imgs/icons/ml.png"><span style="margin-left: 10px; color: green;">Mail: dunnokit@gmail.com</span><br><br><br>
                        <div>
                            <a class="fancybox box-book-tour" style="margin-left: 140px; text-decoration: none;" href="modules/cart/process-cart.php?action=add&prd_id=<?php echo $product['prd_id']; ?>">Đặt hàng</a>
                        </div>
                        <div id="add-cartt"><a style="color: white;" href="modules/cart/process-cart.php?action=add&prd_id=<?php echo $product['prd_id']; ?>">.</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: justify;">
        <div id="product">
            <div id="product-details">
                <br><hr style="border: none; height: 20px; width: 100%; height: 50px; border-bottom: 1px solid #1f1209; box-shadow: 0 20px 20px -20px #333; margin: -50px auto 10px;"><br><br><br>
                <h2 style="color: #0094da;">Mô tả</h2><br>
                <h3 style="text-align: center;"><?php echo $product['prd_name']; ?></h3><br>
                <h3 style="color: #0094da;">Thông tin chi tiết sản phẩm:</h3><br>
                <?php echo $product['prd_details']; ?><br><br><br>
                <h3 style="color: #0094da;">Lưu ý:</h3><br>
                <ul style="margin-left: 30px;">
                    <li>Sản phẩm là bộ kit in trên giấy, khi bạn mua về sẽ phải tự cắt ra và dán lại thủ công bằng keo sữa ạ!</li>
                    <li>Sản phẩm không phù hợp cho trẻ em dưới 10 tuổi.</li>
                    <li>Quý khách vui lòng đọc các <strong>Điều khoản Mua Bán, Chính sách Thanh Toán, Chính sách Giao Hàng</strong> trước khi đặt hàng.</li>
                </ul><br><br>
            </div>
        </div>
    </div>
</div><br><br>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: center;">
        <h3 style="text-align: center;"><strong>DunNo Kit</strong> xin chân thành cảm ơn sự quan tâm, ủng hộ của quý khách!</h3>
    </div>
</div><br>
<!--	End Product	-->
<style>
.box-book-tour:hover {
    background: #00608c; text-decoration: none;
    border-color: #0094da;
}
.box-book-tour {
    background: #0094da;
    color: #FFF;
    padding: 10px 30px;
    border-radius: 25px;
    font-weight: bold;
    border-bottom: 3px solid #00608c;
}
</style>