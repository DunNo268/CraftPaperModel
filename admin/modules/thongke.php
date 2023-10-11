<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    include_once "../../config/connectDB.php";
    require('../carbon/autoload.php');
    //Lấy ra mốc thời gian
    if(isset($_POST['thoigian'])) {
        $thoigian = $_POST['thoigian'];
    }else{
        $thoigian = '';
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    }
    
    if($thoigian == "7ngay"){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    }elseif($thoigian == "28ngay"){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
    }elseif($thoigian == "90ngay"){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
    }elseif($thoigian == "365ngay"){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    }

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $subdays7 = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    //Biều đồ doanh thu theo mốc thời gian
    $sql = "SELECT * FROM orders INNER JOIN orderdetail ON orders.order_id = orderdetail.order_id WHERE (status_id = '1' OR status_id = '2' OR status_id = '3') AND created BETWEEN '$subdays' AND '$now' ORDER BY created ASC";
    $sql_query = mysqli_query($conn,$sql);

    while($val = mysqli_fetch_array($sql_query)) {
        $chart_data[] = array(
            'order' => $val['order_id'],
            'date' => $val['created'],
            'amount' => $val['amount'],
            'kits' => $val['kits']
        );
    }
    // print_r($chart_date);
    echo $data = json_encode($chart_data);

?>