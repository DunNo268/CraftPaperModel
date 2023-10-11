<?php 
session_start();
require('carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
error_reporting(0);
define("SMTP_HOST", "smtp.gmail.com"); //Hostname of the mail server
define("SMTP_PORT", "465"); //Port of the SMTP like to be 25, 80, 465 or 587
define("SMTP_UNAME", "dunno0ple@gmail.com"); //Username for SMTP authentication any valid email created in your domain
define("SMTP_PWORD", "mqvqivoggbpsphww"); //Password for SMTP authentication
// you can get your SMTP host here http://www.asif18.com/6/php/list-of-smtp-and-pop3-severs,-hosts,-ports-email-servers/
include('vendor/autoload.php');
$action = $_GET['action'];
switch ($action) {
    case 'add':
        if(isset($_GET['prd_id'])) {
            $prd_id = $_GET['prd_id'];
        }
        if(isset($_SESSION['cart'][$prd_id])) {
            $_SESSION['cart'][$prd_id]++;
        }else{
            $_SESSION['cart'][$prd_id] = 1;
        }
        header("location: ../../index.php?page_layout=cart");
        break;    
    case 'del':
        if(isset($_SESSION['cart'][$_GET['prd_id']])) {
            unset($_SESSION['cart'][$_GET['prd_id']]);
        }

        if(empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }

        header("location: ../../index.php?page_layout=cart");
        break;
    case 'submit':
        if(isset($_POST['update_cart'])) {
            //Cập nhật giỏ hàng.
            foreach ($_POST['quantity'] as $prd_id => $qty) {
                $_SESSION['cart'][$prd_id] = $qty; //$qty là giá trị ở ô input.
                if($qty == 0) {
                    unset($_SESSION['cart']);
                }
            }
            header("location: ../../index.php?page_layout=cart");
        }
        if(isset($_POST['insert_cart'])) {
            include_once "../../config/connectDB.php";
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            //Thêm vào bảng order
            $customer_name = $_POST['customer_name'];
            $customer_phone = $_POST['customer_phone'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];
            $amount = $_POST['total_price'];
            $status_id = 0;
            $user_id = 1;
            $pay_id = $_POST['pay_id'];
            $kits = $_POST['total_kit'];
            // $created = date('Y-m-d H:i:s'); //datetime
            $created = Carbon::now('Asia/Ho_Chi_Minh'); //datetime

            $sqlOrder = "INSERT INTO orders(customer_name,customer_phone,customer_email,customer_address,amount,status_id,user_id,pay_id,kits,created) 
                        VALUES('$customer_name','$customer_phone','$customer_email','$customer_address',$amount,$status_id,$user_id,$pay_id,$kits,'$created')";
            // echo $sqlOrder;
            mysqli_query($conn, $sqlOrder);
            $order_id = mysqli_insert_id($conn);
            //Thêm vào bảng orderdetail
            $sqlDetail = "INSERT INTO orderdetail(order_id,prd_id,qty) VALUES";
            foreach($_SESSION['cart'] as $prd_id => $qty) {
                $sqlDetail .= "($order_id,$prd_id,$qty),";
            }
            $sqlDetail = rtrim($sqlDetail,","); //cắt ký tự "," bên phải cùng sql.
            mysqli_query($conn, $sqlDetail);

            unset($_SESSION['cart']);
            //send mail
            $str_body .= '<p><h3 style="text-align: center; color: black;">BẠN ĐÃ ĐẶT HÀNG THÀNH CÔNG !</h3></p>';
            $str_body .= '
            <p>
                <b style="color: black;">Mã đơn hàng: ' . $order_id . '</b><br>
                <b style="color: black;">Khách hàng: ' . $customer_name . '</b><br>
                <b style="color: black;">Số điện thoại: ' . $customer_phone . '</b><br>
                <b style="color: black;">Địa chỉ: ' . $customer_address . '</b><br>
                <b style="color: black;">Ngày tạo đơn: ' . date("d-m-Y H:i:s",strtotime($created)) . '</b><br>
                <b style="color: black;">Trạng thái đơn hàng: Chưa xử lý</b><br>
            </p>
            ';
            $str_body .= '
            <table border="1" cellspacing="0" cellpadding="10" bordercolor="#C0C0C0" width="100%">
            <tr bgcolor="#C0C0C0">
                <td width="50%" style="color: black;"><b>
                        <font>Tên sản phẩm</font>
                    </b></td>
                <td width="20%" style="color: black;"><b>
                        <font>Giá tiền</font>
                    </b></td>
                <td width="10%" style="color: black;"><b>
                        <font>Số lượng</font>
                    </b></td>
                <td width="20%" style="color: black;"><b>
                        <font>Tổng tiền</font>
                    </b></td>
            </tr>
            ';
            $sqlOrder_detail = "SELECT product.prd_id, product.prd_name, product.prd_price, orderdetail.qty FROM orderdetail 
            INNER JOIN product ON orderdetail.prd_id = product.prd_id
            WHERE orderdetail.order_id = $order_id";
            $resultOrder_detail = mysqli_query($conn, $sqlOrder_detail);
            while ($row = mysqli_fetch_assoc($resultOrder_detail)) {
                $total = $row['qty'] * $row['prd_price'];
                $str_body .= '
                <tr>
                    <td width="50%" style="color: black;">' . $row['prd_name']  . '</td>
                    <td width="20%" style="color: black;">' . number_format($row['prd_price'],0,',','.')  . 'đ</td>
                    <td width="10%" style="color: black;">' . $row['qty'] . '</td>
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
                Cám ơn quý khách đã tin tưởng và mua hàng tại <strong>DunNo Kit</strong>, chúng tôi sẽ liên hệ với quý khách để xác nhận trong vòng 24h kể từ khi đặt hàng thành công và chuyển hàng đến quý khách chậm nhất sau 5 ngày - tính từ ngày quý khách đặt hàng thành công.<br>
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
                $mail->addAddress('dunnokit@gmail.com');
                $mail->addReplyTo(SMTP_UNAME, 'DunNo Kit');
                $mail->isHTML(true);
                $mail->Subject = 'Xin chúc mừng thông báo';
                $mail->Body = $str_body;
                $resul = $mail->send();
                if (!$resul) {
                    $error = "Có lỗi xảy ra trong quá trình gửi mail";
                }
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
            header("location: ../../index.php?page_layout=success");
        }
        break;
    }
?>