<?php 
    $sql_category = "SELECT * FROM category WHERE status = 1";
    $resultAll = mysqli_query($conn, $sql_category);
?>
<div style="background: black; width: 100%; height: 100px;">
    <div style="width: 30%; margin: auto; display: flex;">
        <div class="menu_button" style="height: 40px; float: left; margin: auto; margin-top: 35px;">
            <a href="index.php">TRANG CHỦ</a>
        </div>
        <div class="dropdown" style="height: 40px; float: left; margin: auto; margin-top: 35px;">
            <a class="menu_button" style="height: 40px; text-decoration: none; color: puprle;" href="index.php?page_layout=product_all">SẢN PHẨM</a>
            <div class="dropdown-content">
                <a href="index.php?page_layout=product_all">Mô hình giấy mới nhất</a>
                <a href="index.php?page_layout=product_featured">Mô hình giấy hot</a>
                <?php
                  while ($row = mysqli_fetch_assoc($resultAll)) {
                ?>
                <a href="index.php?page_layout=product_category&category_id=<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="menu_button" style="height: 40px; float: left; margin: auto; margin-top: 35px;">       
            <a style="text-decoration: none; color: puprle;" href="index.php?page_layout=news_all">TIN TỨC</a>
        </div>
    </div>
</div>
<style>
.menu_button {
    background-image: linear-gradient(
    to right,
    red,
    red 50%,
    #fff 50%
  );
    background-size: 200% 100%;
    background-position: -100%;
    display: inline-block;
    border-width: 0;
    padding: 1px 0;
    position: relative;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: all 0.3s ease-in-out;
}
.menu_button:before {
    content: '';
    background: red;
    display: block;
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 0;
    height: 3px;
    transition: all 0.3s ease-in-out;
}
.menu_button:hover {
    background-position: 0;
}
.menu_button:hover::before {
    width:100%;
}
.dropdown {
    position: relative;
    display: inline-block;
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #b63b3b;
    min-width: 290px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}
.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}
.dropdown-content a:hover {background-color: #a21d18;}
.dropdown:hover .dropdown-content {display: block;}
.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>