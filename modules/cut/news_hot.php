<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: left;">
        <div style="width: 50%; float: left; text-align: left;">
            <h2 style="font-size: 30px; color: #35417A;">Tin tức</h2>
        </div>
        <div style="width: 50%; float: left; text-align: right;">
            <a style="text-decoration: none; color: puprle;" href="index.php?page_layout=news_all">
                <br><p style="margin-right: 20px;">Xem tất cả</p>
            </a>
        </div>
    </div>
</div>
<?php
    $sql_news = "SELECT * FROM news WHERE status = 1 AND news_featured = 1 LIMIT 3";
    $resultAll = mysqli_query($conn, $sql_news);
    $totalRecords = mysqli_num_rows($resultAll);
?>
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto;">
        <div class="products">
            <div class="product-list row">
                <?php
                    if(mysqli_num_rows($resultAll)) {
                        while ($row = mysqli_fetch_assoc($resultAll)) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mx-product" >
                    <div style="width:340px;">
                        <a class="wrap" href="index.php?page_layout=news&news_id=<?php echo $row['news_id']; ?>">
                            <img style="display: block; max-width: 340px; max-height: 250px; width: auto; height: auto;" src="admin/images/news/<?php echo $row['news_image']; ?>">
                        </a>
                    </div>
                    <div style="width:340px;" style="margin-top: 5px; margin-left: 0px;">
                        <strong>
                            <a style="text-decoration: none; color: black;" href="index.php?page_layout=news&news_id=<?php echo $row['news_id']; ?>">
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
</div><br><br>
<link rel="stylesheet" href="css/oldd.css">