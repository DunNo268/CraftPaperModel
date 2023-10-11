-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 25, 2023 lúc 03:26 PM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.11

SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `craftPaperModel2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paymentMethods`
--

CREATE TABLE `status` (
  `status_id` int(1) PRIMARY KEY AUTO_INCREMENT,
  `status_name` varchar(255) UNIQUE KEY
) ;

--
-- Đang đổ dữ liệu cho bảng `paymentMethods`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(0, 'Chưa xử lý'),
(1, 'Đang xử lý'),
(2, 'Đang giao hàng'),
(3, 'Đã xử lý'),
(4, 'Đã huỷ');

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `storage`
--

CREATE TABLE `storage` (
  `storage_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `storage_name` varchar(255) UNIQUE KEY,
  `amount` int(100) NOT NULL,
  CHECK(`amount` > 0)
) ;

--
-- Đang đổ dữ liệu cho bảng `storage`
--

INSERT INTO `storage`(`storage_id`,`storage_name`,`amount`) VALUES
(1, 'Giấy Nhũ Stardream A4 120gsm (Kit)', 10000),
(2, 'Mực in', 50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(255) UNIQUE KEY,
  `status` int(1) NOT NULL
) ;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `status`) VALUES
(1, 'Mô hình giấy Anime - Game', 1),
(2, 'Mô hình giấy Đồ vật - Đồ chơi', 1),
(3, 'Mô hình giấy Kiến trúc', 1),
(4, 'Mô hình giấy Phương tiện', 1),
(5, 'Mô hình giấy Động - Thực vật', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `prd_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `prd_name` varchar(255) UNIQUE KEY,
  `prd_image` varchar(255) NOT NULL,
  `prd_price` int(11) NOT NULL,
  `prd_kit` int(5) NOT NULL,
  `prd_featured` int(1) NOT NULL,
  `prd_details` text NOT NULL,
  `status` int(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  CHECK(`prd_price` > 0),
  CHECK(`prd_kit` > 0),
  CONSTRAINT fk_htk_category_id
  FOREIGN KEY (category_id)
  REFERENCES category (category_id)
) ;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`prd_id`, `prd_name`, `prd_image`, `prd_price`, `prd_kit`, `prd_featured`, `category_id`, `status`, `prd_details`) VALUES
(1, 'Mô hình giấy Anime Game Robot SD 5cm Z Gundam', 'h1.png', '45000', 3, 0, 1, 1, 'Bộ sản phẩm Mô hình giấy Anime Game Robot SD 5cm Z Gundam bao gồm:<br>
1. 03 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(2, 'Mô hình giấy Máy ảnh kĩ thuật số Rubikon', 'p2.png', '30000', 2, 0, 2, 1, 'Bộ sản phẩm Mô hình giấy Máy ảnh kĩ thuật số Rubikon bao gồm:<br>
1. 02 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(3, 'Mô hình giấy Anime Game Robot SD The XVX-016 Gundam Aerial', 'p3.png', '30000', 2, 0, 1, 1, 'Mô hình giấy Anime Game Robot SD The XVX-016 Gundam Aerial bao gồm:<br>
1. 02 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(4, 'Mô hình giấy động vật trừu tượng Polygon Cat', 'p4.png', '30000', 2, 0, 5, 1, 'Mô hình giấy động vật trừu tượng Polygon Cat bao gồm:<br>
1. 02 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(5, 'Mô hình giấy Xe máy tuần tra giao thông', 'p5.png', '15000', 1, 0, 4, 1, 'Mô hình giấy Xe máy tuần tra giao thông bao gồm:<br>
1. 01 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(6, 'Mô hình giấy Xe ô tô Mazda Savanna RX-7', 'p6.png', '15000', 1, 0, 4, 1, 'Mô hình giấy Xe ô tô Mazda Savanna RX-7 bao gồm:<br>
1. 01 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(7, 'Mô hình giấy kiến trúc Cửa hàng bán bánh mì', 'p7.png', '255000', 17, 0, 3, 1, 'Mô hình giấy kiến trúc Cửa hàng bán bánh mì bao gồm:<br>
1. 17 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(8, 'Mô hình giấy kiến trúc Cắm trại Glamping', 'p8.png', '180000', 12, 0, 3, 1, 'Mô hình giấy kiến trúc Cắm trại Glamping bao gồm:<br>
1. 12 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(9, 'Mô hình giấy kiến trúc Góc nhà sân vườn', 'p9.png', '180000', 12, 0, 3, 1, 'Mô hình giấy kiến trúc Góc nhà sân vườn bao gồm:<br>
1. 12 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(10, 'Mô hình giấy kiến trúc Cửa hàng chocolate', 'p10.png', '225000', 15, 0, 3, 1, 'Mô hình giấy kiến trúc Cửa hàng chocolate bao gồm:<br>
1. 15 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(11, 'Mô hình giấy động vật Hồ cá vàng phong thuỷ', 'p11.png', '75000', 5, 0, 5, 1, 'Mô hình giấy động vật Hồ cá vàng phong thuỷ bao gồm:<br>
1. 05 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(12, 'Mô hình giấy động vật Rồng Lửa Polygon', 'p12.png', '105000', 7, 1, 5, 1, 'Mô hình giấy động vật Rồng Lửa Polygon bao gồm:<br>
1. 07 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(13, 'Mô hình giấy động vật Chó phốc sóc lông trắng', 'p13.png', '105000', 7, 1, 5, 1, 'Mô hình giấy động vật Chó phốc sóc lông trắng bao gồm:<br>
1. 07 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(14, 'Mô hình giấy động vật 3 chú chuột Hamster', 'p14.png', '75000', 5, 0, 5, 1, 'Mô hình giấy động vật 3 chú chuột Hamster bao gồm:<br>
1. 05 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(15, 'Mô hình giấy động vật Mèo giáng sinh Xmas', 'p15.png', '105000', 7, 0, 5, 1, 'Mô hình giấy động vật Mèo giáng sinh Xmas bao gồm:<br>
1. 07 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(16, 'Mô hình giấy động vật 3D theo góc nhìn', 'p16.png', '180000', 12, 0, 5, 1, 'Mô hình giấy động vật 3D theo góc nhìn bao gồm:<br>
1. 12 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(17, 'Mô hình giấy Thuyền du lịch Nippon Maru', 'p17.png', '60000', 4, 0, 4, 1, 'Mô hình giấy Thuyền du lịch Nippon Maru bao gồm:<br>
1. 04 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(18, 'Mô hình giấy Máy ảnh Olympus OM1 (tỉ lệ 1:1)', 'p18.png', '60000', 4, 0, 2, 1, 'Mô hình giấy Máy ảnh Olympus OM1 (tỉ lệ 1:1) bao gồm:<br>
1. 04 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(19, 'Mô hình giấy đồ vật đồ chơi Bàn Pinball', 'p19.png', '135000', 9, 0, 2, 1, 'Mô hình giấy đồ vật đồ chơi Bàn Pinball bao gồm:<br>
1. 09 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(20, 'Mô hình giấy đồ vật đồ chơi Sách cô bé quàng khăn đỏ', 'p20.png', '120000', 8, 1, 2, 1, 'Mô hình giấy đồ vật đồ chơi Sách cô bé quàng khăn đỏ bao gồm:<br>
1. 08 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(21, 'Mô hình giấy Anime Game Chibi Jinbei - One Piece', 'p21.png', '30000', 2, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Jinbei - One Piece bao gồm:<br>
1. 02 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(22, 'Mô hình giấy Anime Game Chibi Franky - One Piece', 'p22.png', '30000', 2, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Franky - One Piece bao gồm:<br>
1. 02 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(23, 'Mô hình giấy Anime Game Chibi Chopper - One Piece', 'p23.png', '75000', 5, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Chopper - One Piece bao gồm:<br>
1. 05 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(24, 'Mô hình giấy Anime Game Chibi Luffy - One Piece', 'p24.png', '75000', 5, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Luffy - One Piece bao gồm:<br>
1. 05 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(25, 'Mô hình giấy Anime Game Chibi Brook - One Piece', 'p25.png', '60000', 4, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Brook - One Piece bao gồm:<br>
1. 04 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(26, 'Mô hình giấy Anime Game Chibi Sanji - One Piece', 'p26.png', '60000', 4, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Sanji - One Piece bao gồm:<br>
1. 04 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(27, 'Mô hình giấy Anime Game Chibi Nami - One Piece', 'p27.png', '60000', 4, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Nami - One Piece bao gồm:<br>
1. 04 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(28, 'Mô hình giấy Anime Game Chibi Usopp - One Piece', 'p28.png', '60000', 4, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Usopp - One Piece bao gồm:<br>
1. 04 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(29, 'Mô hình giấy Anime Game Chibi Nico Robin - One Piece', 'p29.png', '60000', 4, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Nico Robin - One Piece bao gồm:<br>
1. 04 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(30, 'Mô hình giấy Anime Game Chibi Roronoa Zoro - One Piece', 'p30.png', '60000', 4, 0, 1, 1, 'Mô hình giấy Anime Game Chibi Roronoa Zoro - One Piece bao gồm:<br>
1. 04 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(31, 'Mô hình giấy Anime Game Robot Gundam Rekka Musha', 'p31.png', '135000', 9, 0, 1, 1, 'Mô hình giấy Anime Game Robot Gundam Rekka Musha bao gồm:<br>
1. 09 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(32, 'Mô hình giấy Anime Game Robot SD Hi-v Gundam ver Yobee', 'p32.png', '270000', 18, 0, 1, 1, 'Mô hình giấy Anime Game Robot SD Hi-v Gundam ver Yobee bao gồm:<br>
1. 18 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(33, 'Mô hình giấy Anime Game Robot SD GAT-X105BFP Build Strike Gundam', 'p33.png', '255000', 17, 0, 1, 1, 'Mô hình giấy Anime Game Robot SD GAT-X105BFP Build Strike Gundam bao gồm:<br>
1. 17 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(34, 'Mô hình giấy Anime Game Robot SD MBF-P03 Gundam', 'p34.png', '315000', 21, 0, 1, 1, 'Mô hình giấy Anime Game Robot SD MBF-P03 Gundam bao gồm:<br>
1. 21 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(35, 'Mô hình giấy Anime Game Robot Gundam SD Unit-01', 'p35.png', '45000', 3, 0, 1, 1, 'Mô hình giấy Anime Game Robot Gundam SD Unit-01 bao gồm:<br>
1. 03 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(36, 'Mô hình giấy Anime Game Robot Gundam SD Unit-00', 'p36.png', '45000', 3, 0, 1, 1, 'Mô hình giấy Anime Game Robot Gundam SD Unit-00 bao gồm:<br>
1. 03 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(37, 'Mô hình giấy Anime Game Robot MSZ-006 Hyper Zeta Gundam', 'p37.png', '525000', 35, 0, 1, 1, 'Mô hình giấy Anime Game Robot MSZ-006 Hyper Zeta Gundam bao gồm:<br>
1. 35 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(38, 'Mô hình giấy Anime Game Robot Gundam PMX-003 The O', 'p38.png', '990000', 66, 0, 1, 1, 'Mô hình giấy Anime Game Robot Gundam PMX-003 The O bao gồm:<br>
1. 66 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(39, 'Mô hình giấy Anime Game Robot RX-93-V2 Hi-v Gundam', 'p39.png', '930000', 62, 0, 1, 1, 'Mô hình giấy Anime Game Robot RX-93-V2 Hi-v Gundam bao gồm:<br>
1. 62 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.'),
(40, 'Mô hình giấy Anime Game Robot XXXG-00W0 Wing Gundam', 'p40.png', '480000', 32, 0, 1, 1, 'Mô hình giấy Anime Game Robot XXXG-00W0 Wing Gundam bao gồm:<br>
1. 32 trang kit A4 chứa các chi tiết lắp giáp.<br>
2. Hướng dẫn lắp ráp mô hình papercraft.<br>
3. Sơ đồ mảnh ghép chi tiết.<br>
4. Xuất xứ: Việt Nam.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `userLevel`
--

CREATE TABLE `userLevel` (
  `level_id` int(1) PRIMARY KEY AUTO_INCREMENT,
  `level_name` varchar(255) UNIQUE KEY
) ;

--
-- Đang đổ dữ liệu cho bảng `userLevel`
--

INSERT INTO `userLevel` (`level_id`, `level_name`) VALUES
(1, 'Administrator'),
(2, 'Nhân viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_full` varchar(255) NOT NULL,
  `user_phone` varchar(30) NOT NULL,
  `user_mail` varchar(255) UNIQUE KEY,
  `user_pass` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `level_id` int(1) NOT NULL,
  CONSTRAINT fk_htk_level_id
  FOREIGN KEY (level_id)
  REFERENCES userLevel (level_id)
) ;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `user_full`, `user_phone`, `user_mail`, `user_pass`, `status`, `level_id`) VALUES
(1, 'Administrator', '0358840802', 'admin@gmail.com', '123456', 1, 1),
(2, 'Nguyễn Văn A', '0912542207', 'nv1@gmail.com', '123456', 1, 2),
(3, 'Nguyễn Thị B', '0346335646', 'nv2@gmail.com', '123456', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paymentMethods`
--

CREATE TABLE `paymentMethods` (
  `pay_id` int(1) PRIMARY KEY AUTO_INCREMENT,
  `pay_name` varchar(255) UNIQUE KEY,
  `status` int(1) NOT NULL
) ;

--
-- Đang đổ dữ liệu cho bảng `paymentMethods`
--

INSERT INTO `paymentMethods` (`pay_id`, `pay_name`, `status`) VALUES
(1, 'Thanh toán bằng chuyển khoản', 1),
(2, 'Thanh toán khi nhận hàng (COD)', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(30) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `amount` int(100) NOT NULL,
  `pay_id` int(1) NOT NULL,
  `kits` int(100) NOT NULL,
  `created` varchar(30) NOT NULL,
  `status_id` int(1) NOT NULL,
  `user_id` int(11),
  `reason` varchar(255),
  CONSTRAINT fk_htk_user_id
  FOREIGN KEY (user_id)
  REFERENCES user (user_id),
  CONSTRAINT fk_htk_pay_id
  FOREIGN KEY (pay_id)
  REFERENCES paymentMethods (pay_id),
  CONSTRAINT fk_htk_status_id
  FOREIGN KEY (status_id)
  REFERENCES status (status_id)
) ;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders`(`order_id`,`customer_name`,`customer_phone`,`customer_email`,`customer_address`,`amount`,`status_id`,`pay_id`,`kits`,`created`,`user_id`) VALUES
(1, 'Nguyễn Văn C', '0834086145', 'nguyenvana@gmail.com', 'Hà Nội', '240000', 3, 1, 16, '2023-01-01', 1),
(2, 'Trần Thị D', '0791075832', 'tranthid@gmail.com', 'Hải Phòng', '90000', 3, 2, 6, '2023-01-18', 2),
(3, 'Lê Văn E', '0143598421', 'levane@gmail.com', 'Bắc Thái', '150000', 3, 1, 10, '2023-01-29', 3),
(4, 'Phạm Văn F', '0834386145', 'phamvanf@gmail.com', 'Cao Bằng', '150000', 3, 1, 10, '2023-02-05', 1),
(5, 'Hoàng Thị G', '0591055832', 'hoangthig@gmail.com', 'Hà Giang', '75000', 3, 2, 5, '2023-02-17', 2),
(7, 'Phan Văn I', '0334036145', 'phanvani@gmail.com', 'Hải Hưng', '2160000', 3, 1, 96, '2023-03-15', 3),
(9, 'Võ Văn K', '0943595421', 'vovank@gmail.com', 'Hoà Bình', '2040000', 3, 1, 120, '2023-03-26', 1),
(10, 'Đặng Văn L', '0134086145', 'dangvanl@gmail.com', 'Lào Cai', '675000', 3, 2, 45, '2023-04-07', 2),
(11, 'Bùi Thị M', '0591675832', 'buithim@gmail.com', 'Lạng Sơn', '975000', 3, 2, 65, '2023-04-15', 3),
(12, 'Đỗ Văn N', '0243498421', 'dovann@gmail.com', 'Nam Hà', '840000', 3, 1, 56, '2023-04-24', 1),
(13, 'Hồ Văn O', '0634076145', 'hovano@gmail.com', 'Nghệ An', '540000', 3, 1, 36, '2023-05-11', 2),
(15, 'Dương Văn K', '0143598421', 'duongvank@gmail.com', 'Ninh Bình', '120000', 3, 1, 8, '2023-05-17', 3),
(16, 'Lý Văn R', '0834056145', 'lyvanr@gmail.com', 'Quảng Bình', '675000', 3, 2, 45, '2023-05-29', 1),
(17, 'Phùng Thị S', '0621075832', 'phungthis@gmail.com', 'Lai Châu', '840000', 3, 2, 56, '2023-06-01', 2),
(18, 'Nguyễn Văn T', '0443598421', 'nguyenvant@gmail.com', 'Sơn La', '90000', 3, 1, 6, '2023-06-08', 3),
(20, 'Lê Thị V', '0891035832', 'lethiv@gmail.com', 'Yên Bái', '150000', 3, 2, 10, '2023-06-15', 1),
(22, 'Hoàng Văn X', '0774086145', 'hoangvanx@gmail.com', 'Thanh Hoá', '480000', 3, 1, 32, '2023-06-18', 2),
(24, 'Phan Văn Z', '0249598421', 'phanvanz@gmail.com', 'Vĩnh Phú', '360000', 3, 1, 24, '2023-06-24', 3),
(25, 'Vũ Văn C', '0334046145', 'vuvanc@gmail.com', 'Quảng Trị', '180000', 3, 1, 12, '2023-06-27', 1),
(26, 'Võ Thị D', '0791025832', 'vothid@gmail.com', 'Thừa Thiên', '300000', 3, 2, 20, '2023-07-06', 2),
(27, 'Đặng Văn E', '0147598421', 'dangvane@gmail.com', 'Quảng Nam', '810000', 3, 1, 54, '2023-07-17', 3),
(28, 'Bùi Văn F', '0834886145', 'buivanf@gmail.com', 'Quảng Tín', '4050000', 3, 2, 270, '2023-07-18', 1),
(29, 'Đỗ Thị G', '0991045832', 'dothig@gmail.com', 'Quảng Ngãi', '2040000', 2, 2, 136, '2023-07-19', 2),
(30, 'Hồ Văn H', '0643538421', 'hovanh@gmail.com', 'Bình Định', '1260000', 2, 1, 84, '2023-07-20', 3),
(31, 'Ngô Văn I', '0434586145', 'ngovani@gmail.com', 'Phú Yên', '585000', 2, 1, 39, '2023-07-21', 1),
(32, 'Dương Thị J', '0761075832', 'duongthij@gmail.com', 'Khánh Hoà', '3675000', 1, 2, 245, '2023-07-22', 2),
(33, 'Lý Văn K', '0243538421', 'lyvank@gmail.com', 'Ninh Thuận', '11700000', 1, 1, 780, '2023-07-23', 3),
(34, 'Hoàng Văn L', '0124086145', 'hoangvanl@gmail.com', 'Bình Thuận', '1365000', 2, 2, 91, '2023-07-24', 1),
(35, 'Phùng Thị N', '0419075832', 'phungthin@gmail.com', 'Kon Tum', '840000', 1, 2, 56, '2023-07-25', 2),
(36, 'Trần Văn M', '0542598421', 'tranvanm@gmail.com', 'Pleiku', '1320000', 1, 1, 88, '2023-07-26', 3);

INSERT INTO `orders`(`order_id`,`customer_name`,`customer_phone`,`customer_email`,`customer_address`,`amount`,`status_id`,`pay_id`,`kits`,`reason`,`created`,`user_id`) VALUES
(6, 'Huỳnh Văn H', '0342598421', 'huynhvanh@gmail.com', 'Hà Tây', '3570000', 4, 1, 238, 'Khách không xác nhận đơn hàng', '2023-03-01', 1),
(8, 'Vũ Thị J', '0691025832', 'vuthij@gmail.com', 'Hải Bắc', '1080000', 4, 2, 72, 'Khách không xác nhận đơn hàng', '2023-03-20', 2),
(14, 'Ngô Thị P', '0791375832', 'ngothip@gmail.com', 'Hà Tĩnh', '900000', 4, 1, 60, 'Khách không xác nhận đơn hàng', '2023-05-13', 3),
(19, 'Trần Văn U', '0335086145', 'tranvanu@gmail.com', 'Nghĩa Lộ', '210000', 4, 1, 14, 'Khách không xác nhận đơn hàng', '2023-06-10', 1),
(21, 'Phạm Văn W', '0546598421', 'phamvanw@gmail.com', 'Thái Bình', '900000', 4, 2, 60, 'Khách không xác nhận đơn hàng', '2023-06-16', 2),
(23, 'Huỳnh Thị Y', '0681075832', 'huynhthiy@gmail.com', 'Tuyên Quang', '180000', 4, 2, 12, 'Khách không xác nhận đơn hàng', '2023-06-20', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `order_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `qty` varchar(30) NOT NULL,
  CHECK(`qty` > 0),
  CONSTRAINT fk_htk_order_id
  FOREIGN KEY (order_id)
  REFERENCES orders (order_id),
  CONSTRAINT fk_htk_prd_id
  FOREIGN KEY (prd_id)
  REFERENCES product (prd_id)
) ;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail`(`order_id`,`prd_id`,`qty`) VALUES
(1, 1, '4'),
(1, 2, '2'),
(2, 3, '3'),
(3, 4, '5'),
(4, 5, '10'),
(5, 6, '5'),
(6, 7, '14'),
(7, 8, '12'),
(8, 9, '6'),
(9, 10, '8'),
(10, 11, '9'),
(11, 12, '5'),
(11, 14, '6'),
(12, 15, '8'),
(13, 16, '3'),
(14, 17, '15'),
(15, 18, '2'),
(16, 19, '5'),
(17, 20, '7'),
(18, 21, '3'),
(19, 22, '7'),
(20, 23, '2'),
(21, 24, '8'),
(21, 25, '5'),
(22, 26, '8'),
(23, 27, '3'),
(24, 28, '6'),
(25, 29, '3'),
(26, 30, '5'),
(27, 31, '6'),
(28, 32, '15'),
(29, 33, '8'),
(30, 34, '4'),
(31, 35, '8'),
(31, 36, '5'),
(32, 37, '7'),
(33, 38, '5'),
(33, 39, '7'),
(33, 20, '2'),
(34, 20, '7'),
(34, 12, '5'),
(35, 20, '7'),
(36, 20, '3'),
(36, 40, '2');


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `news_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `news_name` varchar(255) UNIQUE KEY,
  `news_image` varchar(255) NOT NULL,
  `news_featured` int(1) NOT NULL,
  `news_created` date,
  `news_short` text NOT NULL,
  `news_details` text NOT NULL,
  `status` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  CONSTRAINT fk_htk_userr_id
  FOREIGN KEY (user_id)
  REFERENCES user (user_id)
) ;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`news_id`, `news_name`, `news_image`, `news_featured`, `news_created`, `status`, `user_id`, `news_short`, `news_details`) VALUES
(1, 'Phân loại tất cả các mô hình giấy 3D Papercraft', 'h1.png', 0, '2023-06-01', 1, 1, 
'DunNoKit đã làm nhiều mẫu sản phẩm mô hình giấy 3D Papercraft và nhận ra rằng mẫu mô hình Papercraft đã vô cùng phát triển với rất nhiều mẫu thiết kế khác nhau. Chắc hẳn những bạn mới chơi sẽ vô cùng phân vân để lựa chọn cho mình loại hình mô hình để bắt đầu. Trong bài này nhóm sẽ chia sẻ và cố gắng phân loại các mẫu mô hình mà nhóm biết để các bạn có thể hiểu hơn về môn nghệ thuật này.', 
'Có 2 cách chính để phân loại mô hình giấy 3D Papercraft đó là phân loại theo hình mẫu chủ đề và phân loại theo mức độ chi tiết của mô hình.<br><br>
<strong>1. Phân loại theo hình mẫu chủ đề:</strong><br><br>
Cách thức phân loại này vô cùng dễ hiểu và đơn giản đó là các mẫu mô hình có chủ đề động vật, robot, kiến trúc, oto, gundam, nhân vật phim, nhân vật truyện tranh… Các thức phân loại này khá là rộng và cũng thường thấy trên các website giúp khách hàng có thể dễ dàng tìm thấy mô hình theo chủ đề mong muốn.<br><br>
<strong>2. Phân loại theo mức độ chi tiết của mô hình</strong><br><br>
<strong>Mô hình giấy giản lược:</strong><br><br>
Các bạn chắc hẳn khi tìm kiếm các mẫu mô hình papercraft trên các trang bằng tiếng anh sẽ thấy mô tả “Low Poly Papercraft” nghĩa là mô hình giấy giản lược và đây cũng là nhóm mô hình đông đảo nhất đối với Papercraft.<br><br>
Vậy giản lược là như nào và tại sao phải giản lược? Giản lược nghĩa là các chi tiết của mô hình được đơn giản hóa dưới dạng lưới đa giác, thường là tam giác hoặc tứ giác. Sẽ gần như không có lưới ngũ giác bởi trong các thuật toán thiết kế hình ngũ giác sẽ không thể hiện tốt trong không gian dẫn tới những sai sót trong việc cắt ghép mô hình. Vậy tại sao phải giản lược? môt hình papercraft được ghép lại với các mảnh ghép giấy và để ghép lại với nhau các mảnh ghép đều có cạnh ghép là những đoạn thẳng và đây có thể coi là lý do đầu tiên giải thích vì sao mô hình papercraft thường có dạng lưới đa giác. Lý do thứ 2 là do những mô hình quá phức tạp sẽ rất khó cho người chơi để có thể hoàn thành và sản phẩm sau khi hoàn thành cũng khó có tính thẩm mỹ bởi việc có quá nhiều mảnh ghép dẫn tới việc đường ghép trên mô hình quá nhiều khiến mô hình không còn thống nhất, liền lạc.<br><br>
Trong mô hình giấy papercraft giản lược nhóm có thể chia làm hai dạng chính bao gồm mô hình liền khối và dạng thứ hai cũng đang được rất nhiều bạn mới chơi lựa chọn bởi tính đơn giản là mô hình ghép khối.<br><br>
Mô hình giấy giản lược thường có độ khó thấp nên sẽ phù hợp hơn với những bạn mới chơi hay không có quá nhiều thời gian cho môn nghê thuật papercraft.<br><br>
<strong>Mô hình giấy chi tiết</strong><br><br>
Sau một thời gian chơi với những mô hình giản lược một số bạn sẽ muốn những mô hình thử thách hơn và lúc này các bạn có thể chọn mô hình papercraft với thiết kế chi tiết hơn.<br><br>
Để so sánh rõ ràng giữa mô hình giản lược và mô hình giấy chi tiết có lẽ rất khó bởi sự khác biệt chính nằm ở cách thức xây dựng mảnh ghép (Tách kit) để tạo nên mô hình.<br><br>
Đối với mô hình giản lược các chi tiết sẽ khá to và số lượng đường gấp ít chính vì điều này khiến mô hình có dạng lưới còn đối với những mô hình chi tiết các mảnh ghép sẽ có nhiều đường gấp hơn, các cạnh ghép cũng nhỏ và nhiều hơn vì vậy mà đường nét của mô hình lúc này sẽ thể hiện được những phần bo tròn những chi tiết khó.<br><br>
'),
(2, 'Điểm danh các loại giấy làm mô hình giấy 3D phổ biến', '2.png', 1, '2023-06-02', 1, 2,
'Nói đến mô hình giấy gấp 3D đương nhiên nguyên liệu quan trọng không thể thiếu là giấy. Ngoài việc nắm vững các kỹ năng cơ bản thì biết cách chọn giấy cũng là điều cần thiết. Chọn được giấy gấp tốt thì quá trình thực hiện mô hình cũng trở nên dễ dàng hơn. Hãy cùng tìm hiểu 5 loại giấy gấp 3D được nhiều người sử dụng nhất hiện nay nhé.', 
'<strong>Đặc điểm chung của giấy gấp 3D:</strong><br><br>
Có rất nhiều loại giấy trên thị trường: giấy báo, giấy bìa, giấy thủ công,… Còn có cả những loại giấy thậm chí bạn còn không biết tên gọi chính xác của chúng. Tuy nhiên các loại giấy đều có một quy chuẩn chung cơ bản là GSM (Grams per Square Meter – cân nặng gram trên mét vuông). Giấy có chỉ số GSM càng lớn nghĩa là giấy đó càng nặng và thường sẽ dày hơn.<br><br>
Nhưng điều đó không quan trọng. Điểm mấu chốt của bí quyết chọn giấy gấp 3D không nằm ở tên gọi, mà ở đặc điểm của nó. Cụ thể:<br><br>
<strong>Giấy không quá bóng:</strong><br><br>
Các loại giấy có độ bóng cao thường rất trơn, hoàn toàn không phù hợp để làm các mô hình. Giấy trơn làm cho việc tạo nếp gấp trở nên khó khăn hơn. Còn với giấy ảnh bóng thì sẽ khiến các nếp gấp bị gãy, vỡ và làm rạn mực in trên giấy. Bởi vậy giấy gấp 3D không nên chọn loại quá bóng, thay vào đó là những loại có bề mặt bình thường hoặc hơi thô ráp cũng được.<br><br>
<strong>Giấy không quá dày:</strong><br><br>
Nhiều người nghĩ rằng giấy càng dày thì làm mô hình càng chắc chắn. Tuy nhiên, bạn quên rằng các mô hình 3D thường có những chi tiết rất nhỏ. Nếu chọn giấy quá dày sẽ làm cho thao tác của bạn gặp khó khăn, thậm chí không thể làm được.<br><br>
<strong>Giấy không quá mỏng:</strong><br><br>
Ngược lại, để hoàn thành được một mô hình yêu cầu độ cứng cáp nhất định. Trong trường hợp chọn giấy gấp 3D quá mỏng, mô hình không có điểm tựa để đứng vững. Hoặc mô hình có thể đứng được nhưng khó giữ hình dạng ổn định.<br><br>
Muốn biết giấy đó là dày hay mỏng, thông tin dựa vào định lượng giấy. Thông thường, mức mỏng nhất được chấp nhận cho giấy gấp 3D là khoảng 75gsm và mức dày nhất là khoảng 250gsm. Loại giấy gấp 3D khoảng 180gsm được cho là phù hợp nhất để làm các mô hình giấy.<br><br>
<strong>Top 3 loại giấy gấp 3D thông dụng:</strong><br><br>
Thấy những đặc điểm của giấy gấp 3D khiến nhiều người nghĩ lo lắng không biết tìm loại giấy nào để phù hợp. Thực ra, chúng lại là những loại giấy vô cùng gần gũi, được sử dụng rất nhiều trong cuộc sống. Dựa trên đặc điểm chung của giấy 3D, dưới đây là 3 loại được các tín đồ mô hình giấy ưa chuộng nhất:<br><br>
<strong>Giấy Kraft:</strong><br><br>
Tên gọi Kraft có lẽ khá lạ lẫm với đa số mọi người. Nhưng nhắc đến giấy xi măng thì nó lại trở nên quen thuộc hơn nhiều. Giấy xi măng là một loại giấy tái sinh, tương đối thô, có tính dai, chống thấm tốt. Định lượng giấy dao động trong khoảng 50 – 170gsm, phù hợp để làm giấy gấp 3D có kích thước nhỏ.<br><br>
<strong>Giấy Couche:</strong><br><br>
Lại thêm một cái tên về giấy tưởng chừng xa lạ nhưng thực ra rất thân quen. Giấy Couche chính là loại giấy in phổ thông chúng ta đang dùng hằng ngày. Giấy được dùng để in danh thiếp, in bìa sách vở, in tờ rơi, vé số,…Có rất nhiều loại Couche, nhưng đa phần mẫu giấy đang dùng hiện nay có định lượng 100 – 200gms. Giấy có độ bóng, nhưng không quá nhiều, vừa đủ để làm giấy gấp 3D.<br><br>
<strong>Giấy Ford:</strong><br><br>
Hiểu một cách đơn giản thì đây chính là giấy A4 chúng ta nhìn thấy mỗi ngày. Giấy có màu trắng và vàng, được ứng dụng để làm ruột sổ, giấy nhớ,… Bề mặt giấy mịn, bột giấy xử lý theo phương pháp hóa nghiền nên khả năng lưu trữ tốt, khó bị ố vàng. Định lượng giấy phổ biến khoảng 80 – 120gsm, được coi là loại giấy gấp 3D “quốc dân” vì vừa tiện lại rẻ.<br><br>
Đây là 3 loại được nêu ra theo tên khoa học chuẩn xác. Còn để đơn giản hóa thì bạn chỉ cần nhớ giấy xi măng, giấy vở, giấy A4,…là đủ. Đây đều là những loại dùng làm giấy gấp 3D dễ mua, giá thành rẻ. Hầu hết các hiệu sách, cửa hàng văn phòng phẩm đều có bán. Nếu bạn muốn mô hình của mình có thêm màu sắc, hoặc không tìm được cái loại giấy gấp 3D có màu thì bạn hoàn toàn có thể tự tô màu. Mong rằng thông qua bài viết này, bạn đã biết cách chọn giấy gấp 3D và sẽ có những mô hình thật đẹp.
'),
(3, 'Cách chọn không gian phù hợp làm mô hình giấy gấp 3D', '3.png', 0, '2023-06-03', 1, 3,
'Khi bắt đầu chơi mô hình giấy gấp 3D, những yếu tố thường được quan tâm đến là dụng cụ, tìm “kit”, chất lượng giấy… Có một điều mà ít người để tâm đến đó là không gian thích hợp để thực hiện mô hình. Điều này tưởng chừng ít quan trọng nhưng có thực tế lại cho thấy không gian phù hợp giúp các người chơi thoải mái trong suốt quá trình lắp ráp và kết quả cuối cùng chính là những sản phẩm đẹp, chất lượng hơn.', 
'<strong>Không gian làm mô hình giấy có quan trọng không?</strong><br><br>
Không nhiều người để ý đến vấn đề không gian khi nói tới thực hiện mô hình giấy gấp 3D. Đúng là bạn hoàn toàn có thể tận dụng bất cứ chỗ nào cũng có thể ghép các chi tiết. Nhưng đó là với mô hình nhỏ, còn mô hình to thì sao? Nếu bạn không có một không gian đủ rộng để đặt mô hình, bạn không thể hoàn thành nó được. Nên đừng xem nhẹ yếu tố không gian trong quá trình làm mô hình giấy.<br><br>
Thêm nữa, khi làm mô hình, chắc chắn bạn sẽ phải ghép những chi tiết nhỏ, thậm chí rất nhỏ. Bạn phải thật chăm chút, làm từng bước tỉ mỉ và chính xác. Một không gian không đủ ánh sáng sẽ làm cản trở bạn. Vì thế, một nơi đầy đủ ánh sáng sẽ giúp bạn thực hiện thao tác nhanh hơn, dễ dàng hơn và cũng bảo vệ đôi mắt của bạn hơn nữa. Chỉ với hai ví dụ nhỏ như vậy cũng đủ chứng minh rằng việc chọn lựa không gian rất có ý nghĩa khi làm mô hình giấy gấp 3D.<br><br>
<strong>Những lưu ý khi chọn địa điểm làm mô hình giấy gấp 3D:</strong><br><br>
Đa số mọi người không để tâm đến chuyện không gian. Nhưng số người để ý đến điều đó cũng chưa chắc đã biết phải tìm địa điểm phù hợp như thế nào. Dưới đây là một số gợi ý cho bạn:<br><br>
<strong>Không gian thoáng mát, đủ sáng:</strong><br><br>
Quá trình làm mô hình giấy gấp 3D không phải lúc nào cũng suôn sẻ. Một không gian thoáng đãng sẽ giúp bạn bớt cảm thấy buồn chán hay khó chịu những lúc như vậy. Không đòi hỏi bạn phải có một địa điểm rộng rãi, vừa đủ là được. Nhưng nếu bạn ấp ủ làm một mô hình khổng lồ thì cần tìm nơi nào đó có thể làm được nó.<br><br>
Một không gian đủ ánh sáng sẽ giúp bạn không lắp ghép nhầm các chi tiết. Tuy nhiên, bạn không nên để ánh sáng mặt trời chiếu trực tiếp vào mô hình đang làm. Cũng không nên đóng cửa phòng liên tục nếu bạn không thể thực hiện tiếp tục mô hình một thời gian dài. Khi ấy, phòng sẽ bị ẩm, mốc, dễ làm ảnh hưởng đến mô hình.<br><br>
<strong>Sắp xếp không gian gọn gàng, ngăn nắp:</strong><br><br>
Một nơi được xếp đặt có trật tự luôn khiến công việc có hiệu quả hơn. Khi không gian làm việc của bạn được thu dọn sạch sẽ, gọn gàng, vị trí làm mô hình giấy gấp 3D cũng như rộng hơn. Đặc biệt, các mảnh ghép mô hình không được vứt bừa bãi, dễ bị mất chi tiết. Bạn cũng nên đặt nó ở nơi dễ nhìn thấy để không chểnh mảng với việc làm mô hình của mình.<br><br>
Nếu bạn đang dùng chung không gian với người khác thì hãy cố gắng sắp xếp để có vị trí thực hiện mô hình thuận tiện. Còn nếu chỗ bạn có trẻ em, lưu ý đến các dụng cụ làm việc. Có nhiều đồ sắc nhọn có thể gây nguy hiểm cho trẻ em như dao, kéo,… Xếp những món đồ đó trong hộp hay treo lên cao, tránh càng xa tầm với của trẻ càng tốt.<br><br>
<strong>Vị trị đặt bàn:</strong><br><br>
Vị trí lắp ghép mô hình phải vừa tầm tay và cao ngang tầm mắt của bạn. Vì như thế bạn mới thực hiện các thao tác dễ dàng, đỡ xảy ra sai sót. Nếu không, rất có thể bạn sẽ bị ghép sai, phải làm lại tốn thời gian và chi phí. Điều này cũng bảo vệ cổ và tay bạn khỏi đau.<br><br>
Một chi tiết nữa không thể bỏ qua là việc dính mép bàn để tránh các chi tiết hay mô hình va quẹt vào bị rách. Bạn cũng có thể bồi thêm một lớp băng dính để các miếng cắt không bị mắc vào các góc.<br><br>
Bên cạnh các yếu tố liên quan đến dụng cụ, kỹ thuật,…thì không gian làm mô hình giấy gấp 3D cũng có vai trò quan trọng. Để có được mô hình hoàn hảo nhất thì đừng bỏ qua điều này, tránh những sai sót không đáng có do vấn đề không gian, địa điểm gây nên.
'),
(4, 'Mô hình gấp giấy 3D – Môn nghệ thuật hiện đại mới', '4.png', 1, '2023-06-06', 1, 1,
'Những năm gần đây, mô hình giấy gấp 3D (hay tiếng anh Papercraft) là bộ môn thu hút sự chú ý của đông đảo giới trẻ. Được thỏa sức sáng tạo với những mảnh ghép, nhiều người có thể dành cả ngày để tạo ra được mô hình ưng ý. Vậy mô hình giấy gấp 3D là gì mà lại có sức hút mãnh liệt đến vậy?', 
'<strong>Mô hình giấy gấp 3D là gì?</strong><br><br>
Mô hình giấy là việc sử dụng giấy hoặc bìa theo tỷ lệ để tạo nên các vật thể. Các mẫu vật ở đây rất đa dạng: nhân vật thật trong đời sống, nhân vật giả tưởng, nhân vật hoạt hình, đồ chơi sáng tại hay các mô hình trang trí nội thất, mô hình trang trí để bàn… Các mô hình được tạo ra có thể là một, hai hoặc ba chiều. Mô hình giấy gấp 3D chính là mô hình vật thể ba chiều.<br><br>
So với các mô hình khác, mô hình giấy gấp 3D được lắp với nhau bằng các khớp nối. Người chơi có thể tự tìm các bản vẽ 3D trên các nguồn từ internet, in ra và tự lắp ráp. Tất nhiên nó không hề dễ dàng. Chính vì vậy tại 3DBox chúng tôi mang tới các mẫu mô hình đã được cắt và dập sẵn giúp quý khách dễ dàng có được những mô hình hành tráng và đặc biệt do không cần sử dụng dao và kéo mô hình Papercraft đến được với những khách hàng nhỏ tuổi những khách hàng luôn thích sự sáng tạo và tò mò.<br><br>
<strong>Ưu – nhược điểm khi chơi mô hình giấy gấp 3D:</strong><br><br>
Trước hết phải khẳng định, chơi mô hình giấy 3D có lợi nhiều hơn có hại. Nó được coi như một môn thủ công dành cho trẻ em. Còn với người lớn, nó trở thành một thú vui tiêu khiển lành mạnh.<br><br>
<strong>Ưu điểm mô hình giấy gấp 3D:</strong><br><br>
<strong>1. Trò chơi kích thích tư duy trí não, phát huy tính sáng tạo của người chơi:</strong><br><br>
Mô hình giấy gấp 3D khác biệt hoàn toàn so với các mẫu mô hình sẵn có. Bạn phải suy nghĩ để tìm ra cách lắp sao cho chính xác và đẹp mắt. Với những mô hình do chính bạn nghĩ ra, không dựa trên kit đã có lại càng đỏi hỏi phải tư duy nhiều hơn.<br><br>
<strong>2. Thể hiện tính chất cá nhân của mỗi người:</strong><br><br>
Mô hình 3D thể hiện người làm ra chúng. Có thể cùng một vật thể nhưng mỗi người sẽ cho ra sản phẩm cuối cùng khác nhau dựa trên “cái tôi” của họ khi làm nó. Thậm chí, cảm xúc của bạn cũng được bộc lộ qua từng vị trí dán.<br><br>
<strong>3. Rèn luyện tính kiên nhân, tỉ mỉ:</strong><br><br>
Rõ ràng để thực hiện được một mô hình giấy gấp 3D cần người chơi bỏ ra rất nhiều thời gian, công sức. Bạn sẽ chẳng bao giờ thành công nếu vừa làm đã chán. Hay nếu cẩu thả trong quá trình làm, mô hình của bạn chắc chắn không thể đẹp được.<br><br>
<strong>4. Thành phẩm độc đáo, ít bị “đụng hàng”:</strong><br><br>
Mỗi mô hình bạn làm ra đều trở thành một vật phẩm dùng để trang trí. Không gian đó cũng trở nên mới lạ hơn. Và vì yếu tố cá nhân nên bạn cũng chẳng lo có mô hình giống 100% như mô hình của bạn.<br><br>
<strong>5. Giá thành thấp:</strong><br><br>
Để đầu tư chơi mô hình giấy gấp 3D không tốn kém như nhiều thú chơi khác. Dụng cụ rẻ, dễ tìm, dễ mua; các mẫu mô hình được chia sẻ rộng rãi.<br><br>
<strong>Nhược điểm mô hình giấy gấp 3D:</strong><br><br>
Vì là mô hình được làm từ giấy nên không tránh được việc khó bảo quản. Khi đã thành hình các vật thể thì ảnh hưởng của thời tiết hay tác động ngoại lực vẫn dễ làm chúng bị hư hỏng.<br><br>
<strong>Cách bảo quản mô hình giấy gấp 3D:</strong><br><br>
Để lưu giữ được các mô hình giấy được lâu thì việc bảo quản hết sức quan trọng. Nếu bạn bảo quản không kĩ, rất dễ xảy ra tình trạng mô hình bị ẩm và hỏng. Nên tốt nhất là bạn hãy để mô hình giấy gấp 3D của mình ở những nơi thoáng mát, tránh ánh nắng trực tiếp chiếu vào. Hoặc bạn cũng có thể sơn một lớp ATM bóng bên ngoài để hiệu quả bảo quản được tốt hơn. Nếu có điều kiện thì làm hộp mica để đựng, tất nhiên với những mô hình có kích thước không quá lớn.<br><br>
Một điều nữa cần nhớ là tránh để mô hỉnh bị va đập. Nếu nhẹ, chỗ va đập còn có thể điều chỉnh. Nhưng nếu va đập mạnh, mô hình giấy gấp 3D sẽ trở nên méo mó, khó sửa lại được hình dạng ban đầu.<br><br>
Muốn chơi bất cứ bộ môn nào, việc hiểu những điều căn bản về nó là rất cần thiết. Mong rằng, qua những thông tin trên, bạn đã hiểu hơn về mô hình giấy gấp 3D.
'),
(5, 'Mô hình giấy 3D Papercraft có phải Origami không?', '5.png', 1, '2023-06-08', 1, 2,
'Nghệ thuật gấp giấy Origami đã trở nên quen thuộc từ lâu. Loại hình này thu hút được sự chú ý và tham gia của rất nhiều người. Sau đó lại xuất hiện thêm một thuật ngữ khác về gấp giấy là mô hình giấy gấp 3D hay “Papercraft”. Câu hỏi mô hình giấy gấp 3D có phải Origami không vẫn là băn khoăn của không ít người.', 
'<strong>Nguồn gốc của Papercraft và Orgami:</strong><br><br>
Nghệ thuật gấp giấy Origami có nguồn gốc từ Nhật Bản. Đây là một nét truyền thống rất riêng trong văn hóa ở xứ sở hoa anh đào. Xuất phát từ công nghệ làm giấy Trung Quốc, nhưng người Nhật đã khéo léo áp dụng và cải biến thành loại giấy Washi chất lượng, bền, đẹp. Cùng với đó là kĩ thuật điêu luyện của người dân xứ Phù Tang khi biến những mảnh giấy ấy thành những vật thể độc đáo và ấn tượng. Cứ thế, bộ môn nghệ thuật dân gian này của Nhật Bạn cứ tự nhiên lan tỏa rồi dần trở nên phổ biến trên toàn thế giới.<br><br>
Mô hình giấy (Papercraft) thường bị hiểu nhầm là Origami. Thực tế, từ đầu thế kỉ 20, trên các tờ tạp chí tại châu Âu đã xuất hiện những mô hình giấy gấp đầu tiên. Thời đại hoàng kim của mô hình giấy thời điểm đó là khi bước vào Thế chiến thứ II. Khi đó, ai cũng chơi gấp giấy, đến cả những binh sĩ bị thương cũng chơi. Sau đó, sự phát triển của khoa học công nghệ với những thứ mới lạ hơn, không còn nhiều người chơi bộ môn này nữa. Cho đến khoảng vài năm gần đây khi công nghệ máy tính hiện đại giúp dựng lên những mô hình giấy chân thực và dễ lắp ráp, mô hình giấy nói chung và mô hình giấy gấp nói riêng mới trở lại mạnh mẽ và thu hút nhiều người chơi hơn.<br><br>
<strong>Mô hình giấy gấp 3D không phải Orgami:</strong><br><br>
Có thể khẳng định chắc chắn rằng mô hình giấy gấp 3D không phải là Origami, cũng không thuộc một nhánh nhỏ nào của Origami cả. Nguồn gốc của hai loại hình này hoàn toàn khác nhau. Có lẽ vì Origami quá quen thuộc và nổi tiếng nên khi đều liên quan đến việc gấp giấy dễ gây hiểu lầm cho mọi người.<br><br>
Dù đều dựa trên nguyên tắc xây dựng các mẫu vật bằng giấy nhưng papercraft và origami rất khác nhau. Điểm khác biệt rõ nét nằm ở yếu tố cắt dán để làm ra thành phẩm. Orgami dựa trên các đường gấp, không cắt dán; mô hình giấy gấp 3D lại tự do cắt, dán để ra vật thể như ý là được.<br><br>
<strong>Papercraft và Origami – chơi gì dễ hơn?</strong><br><br>
Từ đặc điểm cho phép cắt dán của hai loại hình, nhiều người cho rằng chơi mô hình giấy gấp 3D sẽ dễ hơn. Vì bạn nghĩ, có sự hỗ trợ của dao, kéo hay hồ dán sẽ thuận lợi hơn việc chỉ dùng tay để tạo hình? Không, mỗi loại đều đòi hỏi những kỹ năng riêng và có độ khó nhất định của nó.<br><br>
Origami cần ở bạn một chút khéo tay, hiểu được cách gấp sao cho thành hình. Thì với mô hình giấy, bạn lại phải biết cách ghép thế nào cho đúng tỷ lệ và khéo léo để mô hình được đẹp. Có những mô hình quả thật rất đơn giản, chỉ 4 – 5 miếng ghép là đã xong. Ngược lại cũng có những mô hình giấy gấp 3D phức tạp lên tới hàng trăm, hàng ngàn miếng ghép. Và có những miếng ghép bé đến mức chỉ tính bằng milimet, không cẩn thận sẽ ghép sai mà làm hỏng cả mô hình.<br><br>
Lại có người nói rằng, cái chi tiết trong mô hình giấy 3D đã được đánh số, chỉ cần xếp vào là được. Nhưng đâu phải bạn đang xếp những mảnh ghép ấy chỉ đơn giản theo đường thẳng hay vòng tròn. Việc tỉ mẩn ghép được một mô hình nhiều chi tiết thành công có khi tốn đến hàng tuần, hàng tháng. Vì vậy, dù là Origami hay mô hình giấy gấp 3D thì cũng không thể khẳng định loại hình nào dễ hơn.<br><br>
Nhưng có những điều Papercraft và Origami mang lại có giá trị rất giống nhau. Đó là ở việc rèn luyện sự kiên nhẫn, thận trọng; khả năng tư duy logic và tính sáng tạo cá nhân. Không chỉ giúp bạn giải trí, hai loại hình này còn giúp bạn phát triển bản thân. Nên nếu bạn đang có ý định muốn theo đuổi loại hình nào thì hãy cân nhắc và lựa chọn. Tin rằng, dù là mô hình giấy gấp 3D hay Origami, chỉ cần bạn thực sự muốn làm thì nhất định sẽ thành công.
'),
(6, 'Phân loại độ khó mô hình giấy 3D Papercraft', '6.png', 0, '2023-06-15', 1, 3,
'Mô hình giấy 3D Papercraft tới nay đã có hàng triệu mẫu thiết kế trong đó có những mẫu vô cùng đơn giản có thể hoàn thành trong thời gian ngắn nhưng cũng có những mẫu vô cùng phức tạp với thời gian hoàn thiện có thể tính bằng tháng. Nếu bạn là người mới sẽ vô cùng khó nếu bạn lựa chọn những mẫu quá khó nhưng ngược lại nếu bạn đã quen với việc lắp ráp mô hình papercraft sẽ thật buồn tẻ nếu bạn chọn mẫu quá đơn giản. Vậy làm sao để ước lượng một cách chính xác nhất độ khó của một mô hình giấy 3D papercraft.', 
'<strong>Mức độ khó dựa trên chi tiết mô hình:</strong><br><br>
Một số mẫu mô hình papercraft không có ghi rõ mức độ khó hoặc đôi khi mức độ khó được ghi với tính chủ quan cao nên việc đánh giá mức độ khó bằng những hình thức khác là cần thiết.<br><br>
Độ khó của một mẫu mô hình được thể hiện rõ nhất ở mức độ chi tiết và kích thước của từng chi tiết. Một mô hình với nhiều đường nét và các chi tiết nhỏ thậm chí là nhỏ hơn 1cm sẽ là những mô hình có độ khó cao bởi việc lắp ghép các mảnh ghép nhỏ bao gồm việc đi nét, gập và tra keo tại các mấu ghép có độ rộng chưa tới 2mm thậm trí 1mm cần mức độ tập trung cao và tỉ mỉ. Chính vì vậy đối với các bạn mới chơi nên chọn các mô hình ít chi tiết và có thể lựa chọn kit in trên khổ giấy lớn như A3 để việc lắp ghép trở nên đơn giản hơn.<br><br>
Các sản phẩm có mức độ khó cao từ 4 tới 5 sao có thể kể tới các mô hình Gundam, robot, và phương tiện giao thông… Các mô hình này thường được thiết kế rất chi tiết tới từng mảnh giáp, khớp ngón tay, khớp chân hay xích bánh xe vậy nên nếu như các bạn chưa trải nghiệm những mô hình đơn giản hơn để có kinh nghiệm thì không nên vội chọn các mô hình có mức độ khó từ 4 tới 5 sao.<br><br>
<strong>Mức độ khó dựa trên độ đóng và mở của mô hình papercraft:</strong><br><br>
Bên cạnh yếu tố về độ chi tiết một yếu tố khác cũng thường được dùng để đánh giá độ khó của một mô hình papercraft đó chính là mức độ đóng và mở của mô hình.<br><br>
Mức độ đóng và mở là để mô tả mô hình sau khi hoàn thành sẽ được bao quanh bởi toàn bộ các miếng ghép hay sẽ có mặt hở. Do các mô hình Papercraft thường được dùng để trang trí trên tường, trên bàn nên một mặt thường sẽ được làm phẳng và hở để thuận tiện cho việc treo và gắn lên các bề mặt trang trí. Chính từ khoảng hở này giúp cho người chơi dễ dàng hơn trong việc lắp các miếng ghép cuối cùng những miếng ghép nếu không có khoảng hở sẽ không có điểm tựa để tra keo và giữ cố định các mối ghép.<br><br>
Với kinh nghiệm của bản thân đối với các mô hình đóng việc ráp mô hình nên dựa trên số thứ tự từ 1-2-… của nhà sản xuất bởi đây thường là phương án lắp ráp tối ưu nhất. Đôi khi việc lắp theo sở thích không theo thứ tự đôi khi sẽ dấn tới việc đóng mô hình tại những chi tiết vô cùng khó khiến sản phẩm cuối cùng đôi khi không có được tính thẩm mỹ như mong muốn.<br><br>
<strong>Kết luận:</strong><br><br>
Một mẫu mô hình to không chắc là khó và một mẫu mô hình nhỏ chưa chắc đã đơn giản. Trước khi lựa chọn mua hoặc lắp ráp một mẫu mô hình giấy papercraft các bạn nên đọc kỹ phần hướng dẫn xem mức độ khó từ nhà sản xuất và đánh giá độ chi tiết và độ mở của mô hình để lựa chọn cho mình một sản phẩm phù hợp.
'),
(7, 'Lịch sử nghệ thuật gấp giấy từ xa xưa đến nay', '7.png', 0, '2023-06-22', 1, 1, 
'Có lẽ từ “nghệ thuật gấp giấy” đã vô cùng quen thuộc với hầu hết mọi người, trong đó một nhầm tưởng cũng thường thấy bởi phần đông đó là Origami là nghệ thuật gấp giấy và nghệ thuật gấp giấy là Origami. Tuy nhiên nghệ thuật gấp giấy thực sự bao gồm rất nhiều môn nghệ thuật với chất liệu chính là giấy như gấp giấy, cắt giấy, ghép giấy… và Origami là một môn nghệ thuật nằm trong đó. Thực tế từ “nghệ thuật gấp giấy” chưa thực sự mô ta hết sự rộng lớn của môn nghệ thuật này bởi như đã nói ở trên có rất rất nhiều cách thể hiện, mô tả và truyền đạt ý tưởng qua chất liếu giấy tuy nhiên do từ nghệ thuật gấp giấy đã trở nên quen thuộc và phổ biến nên được coi như là từ khóa đại diện cho toàn bộ.', 
'<strong>Lịch sử nghệ thuật gấp giấy:</strong><br><br>
Giấy được phát minh bởi người Trung Quốc trong khoảng 105 năm sau công nguyên và đất nước Trung cũng chính là quốc gia phát minh ra môn nghệ thuật đầu tiên liên quan tới giấy đó chính là nghệ thuật cắt giấy. Tờ giấy cổ đại nhất được tìm thấy dưới hình dạng một vòng tròn đối xứng được coi là sản phất cắt giấy đầu tiên có niên đại vào khoảng thế kỷ thứ 6 tại vùng Tân Cương Trung Quốc.<br><br>
Sau khi được phát minh giấy ngày càng trở nên phổ biến và cũng bởi sự phổ biến, tính năng mền dai dễ gấp, gập, cắt và dán tạo tiền đề cho rất nhiều môn nghệ thuật gấp giấy ra đời trên nhiều quốc gia trong đó có thể kể tới một số môn nghệ thuật nổi tiếng và phổ biến nhất như: nghệ thuật gấp giấy (Origami) đến từ đất nước Nhật Bản, nghệ thuật giấy đục lỗ (Papel Picado) của đất nước Mexico, nghệ thuật giấy cắt bóng (silhouette) của Đức, nghệ thuật giấy trang trí ketubahs đền từ người dân Do Thái và rất rất nhiều môn nghệ thuật khác có khởi nguồn từ giấy.<br><br>
<strong>Nghệ thuật cắt giấy Trung Quốc:</strong><br><br>
Nghệ thuật cắt giấy Trung Quốc có lẽ khởi thành từ thế kỷ thứ 6 bởi phong tục tập quán thờ phụng tổ tiên, thánh thần. Các hoạ tiết hoa văn hay chữ mang tính chất cầu may, cầu tài được cắt từ giấy và dán lên cửa của mỗi nhà như một hình thức cầu sự may mắn thành công đến cho toàn bộ thành viên. Dần dần với sự phổ biến của giấy và sự sáng tạo của những người phụ nữ Trung Quốc các hình trang trí bằng giấy ngày càng trở nên sáng tạo với nhiều ý nghĩa khác nhau.<br><br>
<strong>Nghệ thuật gấp Nhật Bản Origami:</strong><br><br>
Nằm tiếp giáp với Trung Quốc nên việc giấy du nhập sang đất nước Nhật Bản và tại đây người dân Nhật Bản sáng tạo ra môn nghệ thuật gấp giấy của riêng mình là một điều vô cùng dễ hiểu. Vào thế kỷ thứ 14 tại triều Muromachi (1392–1573) những hình giấy gấp đầu tiên với tên gọi orikata (tên gọi cổ của Origami) đã được sáng tạo với mục đích chính là trang trí những gói quá trong nghi lễ Noshi.<br><br>
Cũng bởi mục đích ban đầu là trang trí những gói quà nền nghệ thuật gấp giấy Origami dựa trên nguyên tắc là sử dụng các miếng giấy hình vuông hoặc chữ nhật nhưng chủ yếu là hình vuông với các cách gấp và gắn kết khác nhau để tạo nên vô vàn hình dạng đẹp mắt mà hoàn toàn không sử dụng tới kéo hoặc keo.<br><br>
<strong>Nghệ thuật giấy đục lỗ (Papel Picado) Mexico:</strong><br><br>
Nghệ thuật giấy đục lỗ (Papel Picado) tại Mexico có khởi nguồn thừ thập kỷ thứ 14 thời kỳ của người Aztec. Khác với nghệ thuật cắt giấy tại Trung Quốc với dụng cụ chủ yếu là dao và kéo người Aztec thể hiện các hoạt tiết hoa văn trên giấy bằng cách xếp chồng nhiều lớp giấy mỏng lên nhau và dùng búa và đục để trổ hoa văn. Các hoa văn trên giấy Picado thường là hình động vật, hoa lá cỏ cây, bộ xương và chúng thường được dùng các dịp lễ lớn trong đó đặc biệt phải kể tới ngày lễ của người chết với vô vàn giấy Picado được treo trên các tuyến phố, các ngôi nhà.<br><br>
<strong>Nghệ thuật giấy cắt bóng (Silhouette) của Đức:</strong><br><br>
Giống với nghệ thuật cắt giấy Trung Quốc, nghệ thuật cắt bóng (Silhouette) cũng sử dụng dao và kéo nhưng những sản phẩm của nghệ thuật cắt bóng lại thể hiện hình ảnh của người hay vật bởi những đường viền bên ngoài trên nền giấy đơn sắc thường là mầu đen. Ra đời trong thế kỷ thứ 17 môn nghệt thuật này phản ánh mong muốn lưu trữ hình ảnh của người thân những kỷ niệm đáng nhớ một cách tiết kiệm hơn so với các hình thức khác như vẽ chân dung. Tuy chỉ đơn giản cắt theo viền bên ngoài của sự vật nhưng dưới bàn tay của những nghệ sĩ tài hoa những sản phẩm cắt bóng lại vô cùng chi tiết thậm chí đây cũng là khởi nguồn của rất nhiều bộ môn nghệ thuật khác như mua rối bóng, kiến trúc và nhiếp ảnh…<br><br>
<strong>Nghệ thuật gấp giấy hiện đại:</strong><br><br>
Dưới sự phổ biến của mình chất liệu giấy đã là nguyên liệu chính của rất nhiều môn nghệ thuật đặc sắc. Trong những năm gần đây dưới sự phát triển của công nghệ nghệ thuật gấp giấy ngày một phát triển với rất nhiều hình thức thể hiện mới chi tiết và độc đáo hơn trong đó phải kể tới:<br><br>
<strong>Nghệ thuật gấp giấy 3D (Papercraft):</strong><br><br>
Mô hình giấy 3D lần đầu tiên được giới thiệu trên các tờ tạp chí tại Châu Âu trong thế kỷ 20. Môn nghê thuật này đơn giản là việc cắt và ghép các mảnh ghép mô hình bằng giấy. Tuy nhiên sản phẩm cuối cùng lại khá là chi tiết và có dạng hình khối 3D nên được rất nhiều độc giá yêu thích. Thời hoàng kim của môn nghệ thuật giải trí này lại chính là trong thế chiến thứ II khi mà mọi người đều cắt và gấp giấy 3D để giải trí đặc biệt là những người lính trên chiến trường với những mô hình xe tăng, máy bay, oto… Trong những năm gần đây dưới sự phát triển của máy tính, máy cắt laser nhiều mô hình với mức độ chi tiết hơn, lớn hơn khiến cho môn nghệ thuật này ngày càng phổ biến. Nhiều bậc phụ huynh lựa chọn sản phẩm mô hình giấy 3D để có thể giải trí cùng con cái cũng như rèn luyện sự kiên nhẫn cho các bé. Đối với người lớn sản phẩm mô hình giấy 3D lại là vật dung trang trí đẹp mắt với giá thành vô cùng hấp dẫn.<br><br>
<strong>Nghệ thuật cắt giấy trang trí ketubahs:</strong><br><br>
Ketubah là hợp đồng hôn nhân của người Do Thái trong đó ghi lại trách nhiệm của người chồng người vợ trong việc xây dựng một gia đình hạnh phúc. Là một vật có tính linh thương vậy nên hợp đồng hôn nhân ketubahs thường được trang trí vô cùng cầu kỳ và đẹp mắt. Các biểu tượng, hoạt tiết trang trí được làm tỉ mỉ trong đó nổi bật là hình tượng nút thắt bất tận tượng trưng cho tình yêu vĩnh của cửa vợ chồng. Trước đây khi các họa tiết trang trí trên Ketubah được cắt thủ công việc tạo ra một sản phẩm là vô cùng mất thời gian bởi sự tỉ mỉ trong từng công đoạn nhưng với sự hỗ trợ của công nghệ, cụ thể là máy cắt laser các hoạt tiết trang trí được làm với tốc độ nhanh gấp liệu lần và độ chi tiết cũng tăng nhiều lần.
'),
(8, 'Hướng dẫn chi tiết lắp ráp mô hình giấy Papercraft', '8.png', 0, '2023-06-24', 1, 2,
'Mô hình giấy 3D Papercraft đã và đang được rất nhiều người lựa chọn là sản phẩm trang trí, sản phẩm giải trí và thử thách tính kiên nhẫn. Tuy nhiên do là một môn nghệ thuật mới nên nhiều bạn chưa thực sự hiểu và có kinh nghiệm trong việc lắp ráp các mảnh ghép của mô hình Papercraft. Trong bài này chúng tôi sẽ chia sẽ một cách chi tiết và đơn giản nhất trong việc hoàn thiện một mẫu mô hình papercraft tại DunNoKit', 
'<strong>B1: Xác định hình khối 3D:</strong><br><br>
Rất nhiều bạn khi làm một mẫu mô hình thường bắt đầu ngay với việc cắt các chi tiết nhưng việc đầu tiên các bạn nên làm đối với mỗi sản phẩm mô hình của 3DBox đó là xem hướng dẫn, vị trí các mảnh ghép và hình ảnh đa hướng của sản phẩm để có thể hình dung rõ nhất về sản phẩm cuối.<br><br>
Có nhiều bạn cho rằng cắt các chi tiết ra cũng vẫn có thể xác định được hình khối và vị trí các mảnh ghép. Điều này là hoàn toàn đúng nhưng khi các mảnh ghép được trải ra trên giấy thì việc xác định vị trí sẽ dễ hơn rất nhiều.<br><br>
<strong>B2: Chuẩn bị dụng cụ cần thiết:</strong><br><br>
Đối với mỗi bộ sản phẩm mô hình giấy các bạn nên chuẩn bị bộ dụng cụ cần thiết bao gồm:<br><br>
1. Kéo cắt giấy.<br>
2. Dao rọc giấy.<br>
3. Thước kẻ kim loại.<br>
4. Bút bi hết mực / Dụng cụ tạo nếp.<br>
5. Keo dán phù hợp.<br>
6. Tấm lót cắt giấy<br><br>
<strong>B3: Cắt / tách chi tiết mô hình Papercraft:</strong><br><br>
Giấy làm mô hình Papercraft thường là các loại giấy mỹ thuật giấy có định lượng lớn (từ 180 – 300 GSM) nên việc cắt và tách các mảnh chi tiết sẽ cần một số kinh nghiệp giúp đơn giản một trong những bước tốn thời gian và công sức nhất.<br><br>
Đầu tiên các bạn nên sử dụng kéo để chia tờ giấy thành các mảnh nhỏ hơn giúp các thao tác rọc giấy tách chi tiết sau này đơn giản hơn.<br><br>
Với kinh nghiệm của nhóm đối với các chi tiết dài và có thể dùng kéo các bạn nên dùng kéo còn đối với các chi tiết nhỏ và góc cắt hợp dao rọc giấy là một lựa chọn gần như duy nhất. Các chi tiết này các bạn đừng cố dùng kéo vì dùng kéo sẽ gây cong và đôi khi là gẫy giấy anh hưởng tới thẩm mỹ của mô hình sau này.<br><br>
<strong>B4: Đi nét, tạo nếp cho các mảnh ghép:</strong><br><br>
Đối với tất cả mô hình giấy papercraft sẽ chỉ có 2 nếp gấp đó là nếp gấp lên (Mountain Fold) và nếp gấp xuống (Valley Fold) các bạn “Cần” xác định rõ hướng dẫn để có thể đi nét và tạo nếp cho đúng. Nếu các bạn tạp nếp nhầm và phải gập lại sẽ tạo đường gấp nổi trên bề mặt khiến mô hình không được đẹp.<br><br>
Kinh nghiệm của chúng mình đó là sử dụng 2 bút bi một bút mực xanh một bút mực đủ để có thể đi nét và tạo nếp. Lúc này các bạn nên thống nhất mầu mực xanh cho nếp gấp xuống, mầu mực đỏ cho nếp gấp lên hoặc ngược lại.<br><br>
Đối với các mô hình có thiết kế chi tiết mô hình nằm ở mặt ngoài và nằm cùng với các đường đi nếp các bạn bắt buộc phải xử dụng bút bi hết mực hoặc dụng cụ tạo nếp chuyên dụng để không để lại mực ở mặt ngoài sản phẩm.<br><br>
<strong>B5: Ghép kết nối các mảnh ghép:</strong><br><br>
Sau khi hoàn thiện mô hình một số bạn sẽ có nhu cầu sơn trang trí hoặc sơn bảo vệ mô hình. Việc sơn lên mô hình cũng không quá phức tạp nhưng 3DBox cũng có một số lưu ý nhỏ:<br><br>
1. Nên sơn tại các nơi kín gió vì gió sẽ làm các lớp sơn không đều và đôi khi còn cuốn theo bụi bẩn lên bề mặt mô hình khiến cho bề mặt không mịn và có đốm bẩn.<br>
2. Nên sơn các lớp mỏng và sơn nhiều lớp để giấy không bị ngấm sơn và mất dáng.<br>
3. Cuối cùng các bạn nên ghép hết các mảnh ghép rồi sơn phủ, không nên sơn phút sau đó mới ghép vì keo dán thường sẽ không ăn được vào bề mặt sơn khiến các mảnh ghép không chắc chắn và lớp sơn một phần cũng sẽ bị loang.
'),
(9, 'Hướng dẫn làm mô hình giấy 3D cực dễ', '9.png', 0, '2023-06-26', 1, 3,
'Giữa nhiều lựa chọn để chơi một bộ môn nào đó, có những người lại chỉ mê mẩn những mô hình giấy. Họ tỉ mỉ cắt ghép từng chi tiết, chịu khó tìm tòi mẫu vật mới, rồi có thể dành hàng giờ đồng hồ để ngắm những thành phẩm mình làm. Mô hình giấy gấp 3D thật sự đã tạo nên một sức hút mãnh liệt đến vậy. Nếu bạn cũng đang muốn thử làm mà chưa biết bắt đầu từ đâu, hãy theo dõi hướng dẫn dưới đây.', 
'<strong>Chuẩn bị đầy đủ dụng cụ cần thiết:</strong><br><br>
Để làm được mô hình giấy gấp 3D, trước hết bạn cần biết phải chuẩn bị những dụng cụ gì. Đa số các dụng cụ để thực hiện mô hình đều dễ tìm, dễ mua.<br><br>
<strong>Dao:</strong> Có nhiều loại dao để lựa chọn, từ dao rọc giấy bình thường đến loại chuyên dụng như OFLA Nhật Bản. Nhưng loại được nhiều người khuyên dùng nhất là dao mổ y tế. Cửa hàng bán dụng cụ y tế nào cũng sẵn có, bạn đến mua như mua thuốc thôi. Nhớ chọn lưỡi dao số 11 vì mũi dao loại này rất sắc, bạn thao thác cũng dễ hơn.<br><br>
<strong>Kéo:</strong> Không có yêu cầu nào cụ thể về kéo cả. Bạn chọn loại nào có lưỡi kéo dài và dầy một chút là được vì giấy làm mô hình thường cứng hơn giấy thông thường.<br><br>
<strong>Keo dán:</strong> Keo nước, keo sữa, keo 502,…là hàng loạt những loại keo bạn có thể lựa chọn. Tuy thế, những người chơi mô hình giấy gấp 3D nhiều kinh nghiệm khuyên rằng nên chọn keo sữa. Keo sữa lành tính, độ bám dính cao, khô nhanh, dễ bảo quản.<br><br>
<strong>Tấm lót:</strong> Thay vì dùng vài quyển tạp chí hay một bề mặt tạm bợ nào đó thì bạn nên đầu tư một tấm cutting mat. Giá thành dao động khoảng 100 – 150 ngàn, nhưng vô cùng tiện dụng vì trên đó có chia sẵn đơn vị centimet dễ làm hơn rất nhiều.<br><br>
Cùng với đó, bạn chuẩn bị thêm một số công cụ hỗ trợ như thước kẻ, bút bi hết mực, nhíp, kẹp giấy, tăm hoặc que nhọn,…thì càng tốt.<br><br>
<strong>Các bước làm mô hình giấy gấp 3D:</strong><br><br>
Làm mô hình giấy gấp 3D thực sự không quá phức tạp nếu bạn biết cách. Sau khi chuẩn bị đủ nguyên liệu, dụng cụ xong, bạn làm theo những bước này là được.<br><br>
<strong>Tìm “kit”:</strong><br><br>
Tờ bìa có đánh sẵn số các chi tiết của mô hình được gọi là “kit”. Cắt tờ bìa đó ra, bạn đã có chi tiết mô hình, sau đó chỉ cần dán ghép lại theo hướng dẫn là được. Tùy mô hình giấy gấp 3D bạn chọn mà số lượng chi tiết ít hay nhiều, số lượng “kit” cũng từ đó mà thay đổi theo.<br><br>
“Kit” cũng rất dễ tìm. Trong thế giới công nghệ thông tin phát triển, chỉ cần vài click chuột là bạn đã tìm được những tệp kit hoàn toàn miễn phí. Tiếp theo, bạn có thể tự in hoặc mang đến quán để in. Lưu ý loại giấy in của bạn phải phù hợp để làm mô hình giấy.<br><br>
Ngoài ra, bạn cũng có thể đặt mua từ các trang web nước ngoài. Bạn sẽ tìm được nhiều kit độc, lạ để có những mô hình giấy gấp 3D ấn tượng. Tuy nhiên, bạn nên cân nhắc kĩ vì giá thành kit khá cao, chi phí vận chuyển cũng không hề rẻ.<br><br>
<strong>Cách làm:</strong><br><br>
Các chi tiết đang có trên kit vẫn là ở mặt phẳng 2D. Muốn biến chúng thành một mô hình 3D đòi hỏi bạn phải có sự kiên nhẫn, cẩn thận và cả một chút khéo léo nữa. Đừng vội bắt tay vào làm ngay, hãy đọc thật kĩ hướng dẫn để biết các bước cần thực hiện.<br><br>
Tiếp theo, dùng dao hoặc kéo cắt các chi tiết trên kit thật thận trọng sao cho đường cắt được sắc nét và tinh tế nhất. Quan sát kĩ tờ hướng dẫn, bắt đầu ghép từng chi tiết một theo tương ứng với số thứ tự. Tất nhiên để tạo được một mô hình, các chi tiết riêng lẻ đó phải được gấp, uốn sao cho phù hợp. Trước khi dán lại bằng keo, nhớ ướm thật chính xác để tránh phải lột ra dán lại, mất thời gian và không đảm bảo tính thẩm mĩ nữa.<br><br>
Có một lưu ý quan trọng bạn nên lưu ý khi đọc tờ hướng dẫn. Đó là những kí hiệu riêng được đánh dấu trên đó. Có những kí hiệu để bạn biết rằng chi tiết này phải bồi giấy, chi tiết kia phải dán mép…<br><br>
Như vậy, chỉ với hai bước cơ bản, bạn đã nắm được cách cơ bản để làm mô hình giấy gấp 3D. Đầu tư thêm thời gian, công sức và chăm chỉ tập luyện nữa, chắc chắn bạn sẽ sớm thành thạo thôi.
'),
(10, 'Học mà chơi với mô hình giấy trang trí 3D Papercraft', '10.png', 0, '2023-06-30', 1, 1,
'Thời gian gần đây, thú chơi cắt, xếp mô hình giấy 3D (papercraft) đang dần du nhập vào nước ta qua những hội yêu thích nghệ thuật xếp giấy. Khác với trò xếp giấy truyền thống của Nhật Bản Origami, nghệ thuật mô hình giấy gấp 3D thiên về các mô hình 3D sống động và đòi hỏi người chơi phải có một trí tưởng tượng phong phú. Dạo qua các diễn đàn xếp giấy nghệ thuật, website dành cho những người đam mê papercraft, bạn sẽ dễ dàng dễ dàng bắt gặp thế giới muôn màu, muôn vẻ của hàng loạt các mô hình 3D bằng giấy độc đáo.', 
'<strong>Mô hình giấy Papercraft – không chỉ là trò chơi “giết thời gian”:</strong><br><br>
Minh Dũng (lớp 11, trường THPT Lê Qúy Đôn, quận 3, TP HCM), một bạn vừa gia nhập bộ môn xếp mô hình giấy 3D chia sẻ: “Cách đây không lâu, khi nhắc tới nghệ thuật gấp giấy, mình chỉ nghĩ đến Origami của Nhật Bản. Nhưng sau đó, được đứa bạn thân khoe một con Danbo bằng giấy cực kỳ cute, mình mới bắt đầu tìm hiểu thêm về trò chơi papercraft và nhận ra đó thực sự là một lĩnh vực hấp dẫn và rất dễ gây nghiện.”<br><br>
Theo nhiều bạn yêu thích thú chơi mô hình giấy gấp 3D, bộ môn này không yêu cầu bạn cần phải có một cuốn catalogue hướng dẫn sắp xếp từ A đến Z, mà điều quan trọng là bạn phải biết vận dụng óc tưởng tượng của mình một cách khéo léo. Từ những kit mô hình in ra giấy, bạn có thể tạo nên những mô hình giấy giống với chủ thể ngoài thực tế một cách chính xác và đặc biệt là cực kỳ dễ thương. Thời gian đầu, papercraft đối với nhiều người chỉ là những mô hình xếp giấy đơn giản, chi tiết ít, độ phức tạp không cao, nhưng sau đó đã dần dần xuất hiện nhiều mô hình giấy gấp 3D gần gũi, sống động như Danbo (một nhân vật rất quen thuộc với các bạn đam mê papercraft), biệt đội Avengers, người máy Wall-E, hay thậm chí là những công trình kiến trúc nổi tiếng như nhà hát Con Sò, Tháp nghiêng Pise, tòa nhà Bitexco,…<br><br>
Thùy Dung (lớp 10, trường THPT Nguyễn Du, quận 10), một fan girl đã làm quen với papercraft được 4 tháng cho biết đã sưu tập được gần 50 bộ kit khác nhau để luyện xếp mô hình giấy 3D. “Điều mình thích ở bộ môn này là việc nó cho phép mình tư duy sáng tạo, không rập khuôn, và luyện khả năng tập trung, chú ý đến từng chi tiết nhỏ nhất. Cũng có nhiều cách để trưng dụng thành quả, ví dụ như để trang trí góc học tập, có thể làm thêm background cho lung linh hơn, hoặc gắn thêm đèn led cho vui mắt…”<br><br>
<strong>Nâng cao kiến thức, kĩ năng chơi mô hình giấy gấp 3D:</strong><br><br>
Theo các tín đồ papercraft, để làm quen với bộ môn này cũng không phải là chuyện dễ dàng. Đối với những bạn vừa tập chơi, yêu cầu đầu tiên là phải khéo léo và bình tĩnh, bởi chỉ với một nhát cắt quá lố thôi là một bộ kit được in ấn công phu, kỹ lưỡng của bạn sẽ phải “đi tong”. Việc có thể cắt xếp rồi dán giấy thành một mô hình đòi hỏi bạn phải có tư duy để liên hệ các chi tiết với nhau một cách logic, không để sót bất kỳ chi tiết nào. Khi đã thành thạo các thao tác cắt, dán các chi tiết từ các mô hình kit, bạn có thể thử sức ở một “level” cao hơn: tự sáng tạo nên những bộ kit theo ý thích. Việc này đòi hỏi khá nhiều thời gian và công sức để nghiên cứu và vẽ lại các chi tiết papercraft từ vật thể thật ở ngoài đời. Vì thế, một mô hình gấp giấy 3D như vậy có khi phải mất cả tháng để hoàn thành, và tất nhiên cảm giác hoàn thiện sản phẩm chắc chắn sẽ rất khó tả đấy.<br><br>
Bên cạnh đó, vì gấp mô hình giấy 3D là một bộ môn khá mới mẻ, nên bạn cần phải biết chút ít ngoại ngữ để đọc hiểu các tài liệu hướng dẫn cũng như các hướng dẫn thao tác trên các website chuyên cung cấp kit in ấn mô hình. Bạn cũng phải bỏ thời gian để nghiên cứu một số kỹ thuật cơ bản của papercraft nhằm đọc hiểu các bản vẽ, như các nét in liền (cắt), nét chấm gạch (gập lõm), nét in rời (gập nổi) và nhiều kỹ thuật khó khác như phun sơn, bồi giấy,…<br><br>
Hiện nay, trên Facebook cũng như các diễn đàn trực tuyến có rất nhiều hội nhóm đam mê papercraft. Có thể thấy, tuy là bộ môn mới và khá khó nhằn, tuy nhiên papercraft vẫn hấp dẫn không ít các bạn trẻ. Mong rằng các bạn sẽ luôn giữ được niềm đam mê với bộ môn làm mô hình giấy gấp 3D khá “hại não” song cũng cực gây nghiện này.
');

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;