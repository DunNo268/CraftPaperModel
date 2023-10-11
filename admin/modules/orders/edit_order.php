<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    error_reporting(0);
    define("SMTP_HOST", "smtp.gmail.com"); //Hostname of the mail server
    define("SMTP_PORT", "465"); //Port of the SMTP like to be 25, 80, 465 or 587
    define("SMTP_UNAME", "dunno0ple@gmail.com"); //Username for SMTP authentication any valid email created in your domain
    define("SMTP_PWORD", "mqvqivoggbpsphww"); //Password for SMTP authentication
    // you can get your SMTP host here http://www.asif18.com/6/php/list-of-smtp-and-pop3-severs,-hosts,-ports-email-servers/
    include('vendor/autoload.php');
    //Lấy thông tin người cập nhật đơn hàng
    $user = $_SESSION['user_login'];
    $user_id = $user['user_id'];
    if(isset($_SESSION['user_login'])) {
        define("ISLOGGED",true);
        include_once "../../../config/connectDB.php";
        if(isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];
            $sql_update1 = "UPDATE orders SET status_id = status_id + 1 WHERE order_id = $order_id ;";
            $sql_update2 = "UPDATE orders SET user_id = $user_id WHERE order_id = $order_id ;";
            mysqli_query($conn, $sql_update1);
            mysqli_query($conn, $sql_update2);
            //Send mail
            $sqlOrder = "SELECT * FROM orders WHERE order_id = $order_id ;";
            $resultOrder = mysqli_query($conn, $sqlOrder);
            while ($row = mysqli_fetch_assoc($resultOrder)) {
                $customer_email = $row['customer_email'];
                $customer_name = $row['customer_name'];
                $customer_phone = $row['customer_phone'];
                $customer_address = $row['customer_address'];
                $created = $row['created'];
                $amount = $row['amount'];
                $status_id = $row['status_id'];
            }
            $str_body .= '<p><h3 style="text-align: center; color: black;">CẬP NHẬT TRẠNG THÁI ĐƠN HÀNG</h3></p>';
            if($status_id == 2){
                $str_body .= ' 
                    <p>
                        <b style="color: black;">Mã đơn hàng: ' . $order_id . '</b><br>
                        <b style="color: black;">Khách hàng: ' . $customer_name . '</b><br>
                        <b style="color: black;">Số điện thoại: ' . $customer_phone . '</b><br>
                        <b style="color: black;">Địa chỉ: ' . $customer_address . '</b><br>
                        <b style="color: black;">Ngày tạo đơn: ' . date("d-m-Y H:i:s",strtotime($created)) . '</b><br>
                        <b style="color: black;">Trạng thái đơn hàng: Đang giao hàng</b><br>
                    </p>'
                ;
            }else if($status_id == 3){
                $str_body .= ' 
                    <p>
                        <b style="color: black;">Mã đơn hàng: ' . $order_id . '</b><br>
                        <b style="color: black;">Khách hàng: ' . $customer_name . '</b><br>
                        <b style="color: black;">Số điện thoại: ' . $customer_phone . '</b><br>
                        <b style="color: black;">Địa chỉ: ' . $customer_address . '</b><br>
                        <b style="color: black;">Ngày tạo đơn: ' . date("d-m-Y H:i:s",strtotime($created)) . '</b><br>
                        <b style="color: black;">Trạng thái đơn hàng: Đã giao hàng thành công</b><br>
                    </p>'
                ;
            }           
            $str_body .= '
            <table border="1" cellspacing="0" cellpadding="10" bordercolor="#C0C0C0" width="100%">
            <tr bgcolor="#C0C0C0">
                <td width="50%"><b>
                        <font style="color: black;">Tên sản phẩm</font>
                    </b></td>
                <td width="20%"><b>
                        <font style="color: black;">Giá tiền</font>
                    </b></td>
                <td width="10%"><b>
                        <font style="color: black;">Số lượng</font>
                    </b></td>
                <td width="20%"><b>
                        <font style="color: black;">Tổng tiền</font>
                    </b></td>
            </tr>
            ';
            $sqlOrder_detail = "SELECT product.prd_id, product.prd_name, product.prd_price, orderdetail.qty FROM orderdetail 
            INNER JOIN product ON orderdetail.prd_id = product.prd_id
            WHERE orderdetail.order_id = $order_id";
            $resultOrder_detail = mysqli_query($conn, $sqlOrder_detail);
            while ($row1 = mysqli_fetch_assoc($resultOrder_detail)) {
                $total = $row1['qty'] * $row1['prd_price'];
                $str_body .= '
                <tr>
                    <td width="50%" style="color: black;">' . $row1['prd_name']  . '</td>
                    <td width="20%" style="color: black;">' . number_format($row1['prd_price'],0,',','.')  . 'đ</td>
                    <td width="10%" style="color: black;">' . $row1['qty'] . '</td>
                    <td width="20%" style="color: black;">' . number_format($total,0,',','.') . 'đ</td>
                </tr>
                ';
            }
            $str_body .= '
            <tr>
            <td colspan="3" width="80%"></td>
            <td width="20%"><b>
                    <font color="#FF0000">' . number_format($amount,0,',','.') . 'đ</font>
                </b></td>
            </tr>
            </table>           
            ';
            $str_body .= '
            <p style="color: black;">
                Cám ơn quý khách đã tin tưởng và mua hàng tại <strong>DunNo Kit</strong>, đơn hàng sẽ được chuyển đến quý khách chậm nhất sau 5 ngày - tính từ ngày quý khách đặt hàng thành công.<br>
                <strong>Mọi thắc mắc vui vòng reply lại email này hoặc liên hệ Hotline: 0358840802 trong thời gian làm việc của chúng tôi.</strong>
            </p>
            ';
            $mail = new PHPMailer(true);
            try {
                $mail->CharSet = "UTF-8";
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_UNAME;
                $mail->Password = SMTP_PWORD;
                $mail->SMTPSecure = 'ssl';
                $mail->Port = SMTP_PORT;
                $mail->setFrom(SMTP_UNAME, "DunNo Kit");
                $mail->addAddress($customer_email, $customer_email);
                $mail->addReplyTo(SMTP_UNAME, 'DunNo Kit');
                $mail->isHTML(true);
                $mail->Subject = 'Cập nhật trạng thái đơn hàng';
                $mail->Body = $str_body;
                $resul = $mail->send();
                if (!$resul) {
                    $error = "Có lỗi xảy ra trong quá trình gửi mail";
                }
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
            if($status_id == 2){
                header("location: /CraftPaperModel2/admin/index.php?page=order_processed");       
            }else if($status_id == 3){
                header("location: /CraftPaperModel2/admin/index.php?page=order_delivering");          
            }
        }
    }
?>