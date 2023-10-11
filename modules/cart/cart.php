<?php
if (isset($_SESSION['cart'])) {
    $prdId_list = "";
    foreach ($_SESSION['cart'] as $prd_id => $qty) {
        $prdId_list .= $prd_id.",";
    }
   // $prdId_list = 2,6,
   $prdId_list = rtrim($prdId_list,","); //$prdId_list = 2,6
   $sqlCart = "SELECT * FROM product WHERE prd_id IN($prdId_list)";
   $queryCart = mysqli_query($conn, $sqlCart);
?>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: left;">
        <!--	Cart	-->
        <div id="my-cart">
            <div class="row">
                <div style="box-sizing: border-box; font-size:20px;" class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
                <div style="box-sizing: border-box; font-size:20px;" class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Số sản phẩm</div>
                <div style="box-sizing: border-box; font-size:20px;" class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
            </div>
            <form method="post" action="modules/cart/process-cart.php?action=submit">
                <?php
                    $price_unit = 0;
                    $total_price = 0;
                    $kit_unit = 0;
                    $total_kit = 0;
                    while($cart_item = mysqli_fetch_assoc($queryCart)){
                        $price_unit = $_SESSION['cart'][$cart_item['prd_id']] * $cart_item['prd_price'];
                        $total_price += $price_unit;
                        $kit_unit = $_SESSION['cart'][$cart_item['prd_id']] * $cart_item['prd_kit'];
                        $total_kit += $kit_unit;
                ?>
                    <div class="cart-item row">
                        <div style="box-sizing: border-box;" class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                            <img src="admin/images/product/<?php echo $cart_item['prd_image']; ?>">
                            <h4 style="font-size:20px;"> <?php echo $cart_item['prd_name']; ?></h4>
                        </div>
                        <div style="box-sizing: border-box;" class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                            <input type="hidden" name="prd_price[<?php echo $cart_item['prd_id']; ?>]" value="<?php echo $cart_item['prd_price']; ?>">
                            <input min="1" style="box-sizing: border-box; font-size:20px; width: 100px;" type="number" id="quantity" class="form-control form-blue quantity" 
                                value="<?php echo $_SESSION['cart'][$cart_item['prd_id']]; ?>" 
                                name="quantity[<?php echo $cart_item['prd_id']; ?>]">
                        </div>
                        <div style="box-sizing: border-box;" class="cart-price col-lg-3 col-md-3 col-sm-12"><b style="font-size:20px;"><?php echo number_format($price_unit,0,',','.'); ?>đ</b>
                            <a href="modules/cart/process-cart.php?action=del&prd_id=<?php echo $cart_item['prd_id']; ?>">Xóa</a>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <div class="row">
                    <div style="box-sizing: border-box;" class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                        <button id="update-cart" class="btn btn-success" type="submit" name="update_cart" value="update">Cập nhật giỏ hàng</button>
                    </div>
                    <div style="box-sizing: border-box;" class="cart-total col-lg-2 col-md-2 col-sm-12"><b style="font-size:20px;">Tổng cộng:</b></div>
                    <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                    <input type="hidden" id="total_kit" name="total_kit" value="<?php echo $total_kit; ?>">
                    <div style="box-sizing: border-box;" class="cart-price col-lg-3 col-md-3 col-sm-12"><b style="font-size:20px;"><?php echo number_format($total_price,0,',','.'); ?>đ</b></div>
                </div>
            <!-- </form> -->
        </div>
        <!--	End Cart	-->
        <?php
            }else{
                echo "<div class='alert alert-danger mt-3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Có 0 sản phẩm trong giỏ hàng!</div>";
            }
        ?>
    </div>
</div>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: left;">
        <!--	Customer Info	-->
        <div id="customer">
            <!-- <form method="post"> -->
                <h3>Thông tin Khách hàng:</h3><br>
                <div class="row"> 
                    <div style="box-sizing: border-box; width: 100%; margin-left: 10px; margin-right: 10px;" id="pay_id" >
                        <select id="pay_id" name="pay_id" class="form-control">
                            <?php
                            $sqlPay = "SELECT * FROM paymentMethods WHERE status = 1 ORDER BY pay_id ASC";
                            $queryPay = mysqli_query($conn,$sqlPay);
                            while ($rowPay = mysqli_fetch_array($queryPay)){                                    
                            ?>
                            <option id="pay_id" name="pay_id" style=" box-sizing: border-box;" value="<?php echo $rowPay['pay_id']; ?>"><?php echo $rowPay['pay_name']; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div style="box-sizing: border-box;  margin-top: 10px;" id="customer-add" class="col-lg-12 col-md-12 col-sm-12">
                        <input style="box-sizing: border-box;" placeholder="Địa chỉ" type="text" name="customer_address" id="customer_address" class="form-control">
                        <span id="customer_address_error"></span>
                    </div>
                    <div style="box-sizing: border-box;" id="customer-name" class="col-lg-4 col-md-4 col-sm-12">
                        <input style="box-sizing: border-box;" placeholder="Họ và tên" type="text" name="customer_name" id="customer_name" class="form-control customer_name">
                        <span id="customer_name_error"></span>
                    </div>
                    <div style="box-sizing: border-box;" id="customer-phone" class="col-lg-4 col-md-4 col-sm-12">
                        <input style="box-sizing: border-box;" placeholder="Số điện thoại" type="number" name="customer_phone" id="customer_phone" class="form-control">
                        <span id="customer_phone_error"></span>
                    </div>
                    <div style="box-sizing: border-box;" id="customer-mail" class="col-lg-4 col-md-4 col-sm-12">
                        <input style="width: 419px; box-sizing: border-box;" placeholder="Email" type="text" name="customer_email" id="customer_email" class="form-control" onkeyup="validateEmail()">
                        <span id="customer_email_error"></span><span style="margin-left: 2px;" id="email_error"></span>
                    </div>
                </div><br>
                <p>* Quý khách vui lòng kiểm tra lại thông tin mình vừa nhập.</p><br>
            <!-- </form> -->
                <div class="row">
                    <div class="by-now col-lg-6 col-md-6 col-sm-12">
                        <button class="btn btn-danger" type="submit" name="insert_cart" onclick="return validateForm();" id="btn_insert" value="insert">
                            <b>Đặt ngay</b>
                            <span>Dịch vụ nhanh chóng</span>
                        </button>
                        <!-- <button style="background-color: green;" type="submit" class="btn" onclick="printOrder()">
                            <b>In hoá đơn</b>
                        </button>                    -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><br>
<!--	End Customer Info	-->
<script>
    function validateForm() {
        const EMPTY_STR = "";
        var check = true;
        var customer_name = document.getElementById('customer_name');
        var customer_phone = document.getElementById('customer_phone');
        var customer_email = document.getElementById('customer_email');
        var customer_address = document.getElementById('customer_address');
        var customer_name_error = document.getElementById('customer_name_error');
        var customer_phone_error = document.getElementById('customer_phone_error');
        var customer_email_error = document.getElementById('customer_email_error');
        var customer_address_error = document.getElementById('customer_address_error');
        // console.log(customer_name.value == "");
        if(customer_name.value == EMPTY_STR) {
            customer_name.style.border = "1px solid red";
            customer_name_error.innerHTML = "Bạn phải nhập họ tên";
            customer_name_error.style.color = "red";
            check = false;
        }
        if(customer_phone.value == EMPTY_STR) {
            customer_phone.style.border = "1px solid red";
            customer_phone_error.innerHTML = "Bạn phải nhập số điện thoại";
            customer_phone_error.style.color = "red";
            check = false;
        }
        if(customer_email.value == EMPTY_STR) {
            customer_email.style.border = "1px solid red";
            customer_email_error.innerHTML = "Bạn phải nhập email.";
            customer_email_error.style.color = "red";
            check = false;
        }if(customer_address.value == EMPTY_STR) {
            customer_address.style.border = "1px solid red";
            customer_address_error.innerHTML = "Bạn phải nhập địa chỉ";
            customer_address_error.style.color = "red";
            check = false;
        }
        if(!customer_email.value.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)){
            check = false;
        }
        return check;
    }
</script>
<script>
    function validateEmail() {
        var customer_email = document.getElementById('customer_email');
        var email_error = document.getElementById('email_error');
        if(!customer_email.value.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)){
            email_error.innerHTML = "Vui lòng nhập một email hợp lệ!";
            email_error.style.color = "red";
            return false;
        }
        email_error.innerHTML = "";
        return true;
    }
</script>
<script>
    function printOrder(){
        window.print();
    }
</script>
<link rel="stylesheet" href="css/oldd.css">