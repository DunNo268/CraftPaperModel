<?php 
    if(isset($_GET['news_id'])) {
        $news_id = $_GET['news_id'];
        $sql = "SELECT * FROM news INNER JOIN user ON news.user_id = user.user_id WHERE news_id=$news_id";
        $result = mysqli_query($conn, $sql);
        $news = mysqli_fetch_assoc($result);
    }else{
        header("location: index.php");
    }
?>
<!--	List News	-->
<div id="body"><br>
    <div style="width: 100%; display: flex;">
        <div style="width: 80%; margin: auto; text-align: justify;">
            <br><h3 style="text-transform: uppercase; color: #b63b3b;;"><?php echo $news['news_name']; ?></h3><br>
            <?php echo $news['news_short']; ?><br><br>
            <p style="margin-left: 890px;"><i>Ngày viết: <?php echo date("d-m-Y",strtotime($news['news_created'])); ?></i></p><br><hr><br>
        </div>
    </div>
    <div style="width: 100%; display: flex;">
        <div style="width: 80%; margin: auto; text-align: center;">
            <br><img class="anh" src="admin/images/news/<?php echo $news['news_image']; ?>"><br>
            <i><?php echo $news['news_name']; ?></i><br><br>
        </div>
    </div>
    <div style="width: 100%; display: flex;">
        <div style="width: 80%; margin: auto; text-align: justify;">
            <br><p><?php echo $news['news_details']; ?></p>
            <br><br><p style="margin-left: 850px;">Người viết: <?php echo ($news['user_full']); ?></p>
        </div>
    </div>
</div><br><br><br>
<!--	End News	-->
<div style="width: 100%; display: flex;">
    <div style="width: 80%; margin: auto; text-align: center;">
        <h3 style="text-align: center;"><strong>DunNo Kit</strong> xin chân thành cảm ơn sự quan tâm, ủng hộ của quý khách!</h3>
    </div>
</div><br>