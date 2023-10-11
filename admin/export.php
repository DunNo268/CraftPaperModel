<?php
    require('Classes/PHPExcel.php');
    require('Classes/PHPExcel/Cell.php');
    require('Classes/PHPExcel/Style.php');
    $soluong = "SELECT prd_id, SUM(qty) AS N FROM orderdetail GROUP BY prd_id";
    $sql_product = "SELECT prd_id, prd_name, category_id, prd_price, prd_kit FROM product";
    $product = mysqli_query($conn, $sql_product);
    //Khởi tạo đối tượng
    $excel = new PHPExcel();
    //Chọn trang cần ghi (là số từ 0->n)
    $excel->setActiveSheetIndex(0);
    //Tạo tiêu đề cho trang. (có thể không cần)
    $excel->getActiveSheet()->setTitle('Thống kê sản phẩm bán được');
    // //Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    // //Xét in đậm cho khoảng cột
    $excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
    //Tạo tiêu đề cho từng cột
    $excel->getActiveSheet()->setCellValue('A1', 'ID');
    $excel->getActiveSheet()->setCellValue('B1', 'Tên sản phẩm');
    $excel->getActiveSheet()->setCellValue('C1', 'Danh mục sản phẩm');
    $excel->getActiveSheet()->setCellValue('D1', 'Giá');
    $excel->getActiveSheet()->setCellValue('E1', 'Số kit');
    // $excel->getActiveSheet()->setCellValue('F1', 'Số lượng bán');
    // thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
    // dòng bắt đầu = 2
    $numRow = 2;
    foreach ($product as $row) {
        $excel->getActiveSheet()->setCellValue('A' . $numRow, $row['prd_id']);
        $excel->getActiveSheet()->setCellValue('B' . $numRow, $row['prd_name']);
        $excel->getActiveSheet()->setCellValue('C' . $numRow, $row['category_id']);
        $excel->getActiveSheet()->setCellValue('D' . $numRow, $row['prd_price']);
        $excel->getActiveSheet()->setCellValue('E' . $numRow, $row['prd_kit']);
        // $excel->getActiveSheet()->setCellValue('F' . $numRow, $row[]);
        $numRow++;
    }
    
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="thong_ke_san_pham_ban_duoc'.time().'.xlsx"');
    PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
?>