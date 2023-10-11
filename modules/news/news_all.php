<?php 
    $rowPerPage = 9; //Số sản phẩm trên 1 trang.
    $sql_news = "SELECT * FROM news WHERE status = 1";
    $resultAll = mysqli_query($conn, $sql_news);
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
    $sql_pagination = "SELECT * FROM news WHERE status = 1 ORDER BY news_id DESC LIMIT $start,$rowPerPage";
    $resultPagination = mysqli_query($conn, $sql_pagination);
?>
<div style="width: 100%;">
    <img style="max-width: 100%;" src="imgs\news\n2.png">
</div>
<div style="width: 100%; display: flex;">
    <div style="width: 50%; margin: auto; text-align: center;">
        <br><br><h4>-------- Bạn đang ở trang Tin tức --------</h4><br><br>
    </div>
</div>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: justify;">
        <a style="text-decoration: none; color: #35417A;" href="index.php?page_layout=news_all"><strong>Tin tức</strong></a> - Nơi DunNo Kit cung cấp các thông tin, các kiến thức về chủ đề <em><strong>mô hình giấy</strong></em>, hay đơn giản chỉ là chia sẻ các kinh nghiệm, trải nghiệm mới mẻ trong việc sáng tạo và lắp ghép mô hình giấy mà bạn không biết.<br><br><hr><br><br>
    </div>
</div>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto;">
        <div class="products">
            <div class="product-list row">
                <?php if(mysqli_num_rows($resultAll)) {
                    while ($row = mysqli_fetch_assoc($resultPagination)) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mx-product" >
                    <div style="width:340px;">
                        <a href="index.php?page_layout=news&news_id=<?php echo $row['news_id']; ?>">
                            <img style="display: block; width: 340px; height: 205px;" src="admin/images/news/<?php echo $row['news_image']; ?>">
                        </a>
                    </div>
                    <div style="width:340px;" style="margin-top: 5px; margin-left: 0px;">
                        <strong>
                            <a style="text-decoration: none;  color: black;" href="index.php?page_layout=news&news_id=<?php echo $row['news_id']; ?>">
                                <?php echo $row['news_name']; ?>
                            </a>
                        </strong><br>
                    </div>
                    <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; text-align:justify;">
                        <a style="text-decoration: none; color: black;" href="index.php?page_layout=news&news_id=<?php echo $row['news_id']; ?>">
                            <?php echo $row['news_short']; ?>
                        </a>
                    </div><br>
                </div>
                <?php 
                        }
                    }      
                ?>
            </div>
        </div>
    </div>
</div><br>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: center;">
        <div class="pagination">
            <!-- Hiển thị nút trở về trang trước -->
            <?php if($current_page > 1) { ?>
                <a href="index.php?page_layout=news_all&current_page=<?php echo $current_page-1; ?>">&laquo;</a>
            <?php }else { ?>
                <a class="disabled" href="">&laquo;</a>
            <?php } ?>
            <!-- Page menu item -->
            <?php for($i = 1; $i <= $totalPage; $i++) { 
                    if($i > $current_page - 3 && $i < $current_page + 3) { 
                        if($i == $current_page) {   
            ?>
                            <a class="active" href="index.php?page_layout=news_all&current_page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php }else { ?>
                            <a href="index.php?page_layout=news_all&current_page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php 
                    }
                }
            }
            ?>
            <!-- Hiển thị nút next trang -->
            <?php if($current_page < $totalPage) { ?>
                <a href="index.php?page_layout=news_all&current_page=<?php echo $current_page + 1; ?>">&raquo;</a>
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
</style>