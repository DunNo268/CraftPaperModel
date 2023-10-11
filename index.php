<?php 
    session_start();
    include_once "config/connectDB.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Trang chủ</title>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/cart.css">
<link rel="stylesheet" href="css/success.css">
<link rel="stylesheet" href="css/products.css">
<link rel="stylesheet" href="css/news.css">
<link rel="stylesheet" href="css/feedback.css">
<script src="js/jquery-3.3.1.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/slideshow.js"></script>
</head>
<body>
<!--	Header	-->
<div id="header">
    <div style="width: 100%; height: 70px; display: flex;">
        <div style="width: 83%; float: left;">
            <?php include_once "modules/logo/logo.php"; ?>  
        </div>
        <div style="float: left; display: flex; align-items: right; justify-content: right; ">
            <div style=" margin-top: 15px;">
                <?php include_once "modules/search/search.php"; ?>
            </div>
        </div>
        <div style="width: 17%; float: left; margin-top: 20px;">
            <?php include_once "modules/cart/cart_notification.php"; ?>
        </div>
    </div>
    <div>
        <?php include_once "modules/header/menu.php"; ?>
    </div>
    <!-- <form action="index.php?page_layout=product_search" method="POST">
        <input type="text" placeholder="Tìm kiếm sản phẩm" name="keyword" />
        <input type="submit" name="product_search" value="Tìm kiếm" />
    </form> -->
<a href="https://www.youtube.com/c/ShortCode" target="_blank" id="ytb">
<i class="fab fa-youtube"> </i>
</a>
</div>
<!--	End Header	-->
<!--	Body	-->
<div id="body">
	<div>
        <?php 
            if(isset($_GET['page_layout'])) {
                switch ($_GET['page_layout']) {
                    case 'sendmail':
                        include_once "modules/cart/sendmail.php";
                        break;
                    case 'product_all':
                        include_once "modules/product/product_all.php";
                        break;
                    case 'product_featured':
                        include_once "modules/product/product_featured.php";
                        break;
                    case 'product_category':
                        include_once "modules/product/product_category.php";
                        break;
                    case 'product_search':
                        include_once "modules/product/product_search.php";
                        break;
                    case 'product':
                        include_once "modules/product/product.php";
                        break;
                    case 'news_all':
                        include_once "modules/news/news_all.php";
                        break;
                    case 'news':
                        include_once "modules/news/news.php";
                        break;
                    case 'rules':
                        include_once "modules/cut/rules.php";
                        break;
                    case 'payment':
                        include_once "modules/cut/payment.php";
                        break;
                    case 'delivery':
                        include_once "modules/cut/delivery.php";
                        break;
                    case 'cart':
                        include_once "modules/header/menu.php";
                        include_once "modules/cart/cart.php";
                        break;
                    case 'success':
                        include_once "modules/cart/success.php";
                        break;
                }
            }else{
                include_once "modules/cut/img.php";
                include_once "modules/cut/introduce.php";
                include_once "modules/cut/product_hot.php";
                include_once "modules/cut/news_hot.php";
                // include_once "modules/cut/product_new.php";
                // include_once "modules/slide/slide.php";
                include_once "modules/cut/coin.php";
            } 
        ?>   
    </div>
</div>
<!--	End Body	-->
<!-- Footer -->
<?php include_once "modules/footer/footer.php"; ?>
<!-- ./Endfooter -->
</body>
</html>
