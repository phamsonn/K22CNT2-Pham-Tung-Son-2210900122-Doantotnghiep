-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 27, 2026 at 10:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothingshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` varchar(5) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Passwd` varchar(255) NOT NULL,
  `Image` text NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Address` text NOT NULL,
  `Position` varchar(255) NOT NULL,
  `About` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Name`, `Email`, `Passwd`, `Image`, `Contact`, `Address`, `Position`, `About`) VALUES
('ad01', 'ABC', 'abc@gmail.com', 'abc', 'ad02.jpg', '0123456789', '273 An Duong Vuong', 'Quản lý', 'Quản lý');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `admin_id` varchar(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `thumbnail`, `admin_id`, `created_at`) VALUES
(1, 'Xu hướng thời trang 2026', 'Khám phá những xu hướng thời trang nổi bật năm 2026 với phong cách tối giản, màu sắc trung tính và chất liệu thân thiện môi trường.', 'download (3).jpg', 'ad01', '2026-04-27 14:42:11'),
(2, 'Cách phối đồ mùa hè năng động', 'Mùa hè đến, việc lựa chọn trang phục phù hợp không chỉ giúp phái mạnh cảm thấy thoải mái mà còn thể hiện phong cách cá nhân đầy năng động và cuốn hút. Trong bài viết này, bạn cùng Canifa Việt Nam khám phá 15 cách phối đồ nam mùa hè đẹp, năng động, cuốn hút, giúp bạn tự tin hơn trong mọi hoạt động.​\r\n\r\nNhững lưu ý khi phối đồ nam mùa hè\r\nTrước khi khám phá các outfit mùa hè nam, chúng ta cần chú ý đến một số yếu tố quan trọng để đảm bảo sự thoải mái và phong cách.\r\n\r\nKiểu dáng trang phục\r\nTrong mùa hè, ưu tiên lựa chọn những trang phục có kiểu dáng thoải mái, không quá bó sát để cơ thể dễ dàng thoát nhiệt. Áo thun, áo sơ mi ngắn tay, quần short hay quần jogger là những lựa chọn lý tưởng. \r\n\r\nLựa chọn chất liệu\r\nChất liệu trang phục đóng vai trò quan trọng trong việc tạo cảm giác mát mẻ. Các chất liệu như cotton, linen hay vải đũi có khả năng thấm hút mồ hôi tốt và thoáng khí. Bạn có thể chọn mua các sản phẩm', 'download (4).jpg', 'ad01', '2026-04-27 14:42:11'),
(3, 'Phong cách streetwear hiện đại', 'Streetwear ngày càng được ưa chuộng với áo hoodie, quần baggy và phụ kiện cá tính.', 'images (7).jpg', 'ad01', '2026-04-27 14:42:11'),
(4, 'Cách chọn áo sơ mi phù hợp', 'Hướng dẫn chọn áo sơ mi theo dáng người, màu da và hoàn cảnh sử dụng.', 'images (9).jpg', 'ad01', '2026-04-27 14:42:11'),
(5, 'Mix đồ công sở thanh lịch', 'Bí quyết phối đồ công sở vừa lịch sự vừa thời trang cho cả nam và nữ.', 'images (8).jpg', 'ad01', '2026-04-27 14:42:11'),
(6, 'Quần jeans – item không bao giờ lỗi mốt', 'Quần jeans là lựa chọn hoàn hảo cho mọi phong cách từ casual đến lịch sự.', 'images (6).jpg', 'ad01', '2026-04-27 14:42:11'),
(7, 'Phối màu trang phục chuẩn stylist', 'Học cách phối màu trang phục hài hòa để tạo ấn tượng mạnh mẽ.', 'download (2).jpg', 'ad01', '2026-04-27 14:42:11'),
(8, 'Chọn trang phục theo dáng người', 'Hiểu rõ dáng người để chọn trang phục phù hợp giúp tôn lên ưu điểm và che khuyết điểm.', 'download (1).jpg', 'ad01', '2026-04-27 14:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `ct_hoadon`
--

CREATE TABLE `ct_hoadon` (
  `MA_HD` int(10) NOT NULL,
  `MA_SP` varchar(10) NOT NULL,
  `SOLUONG` int(11) NOT NULL,
  `TONGTIEN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ct_hoadon`
--

INSERT INTO `ct_hoadon` (`MA_HD`, `MA_SP`, `SOLUONG`, `TONGTIEN`) VALUES
(1504270957, 'ao03', 1, 350000),
(1512051207, 'giay02', 1, 2500000),
(1612051219, 'ao05', 1, 420000),
(1612051219, 'giay03', 1, 1500000),
(1612051219, 'tui02', 1, 580000),
(1612051338, 'ao01', 1, 320000),
(1702270413, 'ao04', 3, 1020000),
(1702270605, 'ao01', 6, 1920000),
(1702270658, 'ao01', 3, 960000),
(1708191713, 'ao01', 1, 320000),
(1777277826, 'ao03', 1, 350000),
(1777280083, 'ao03', 1, 350000);

-- --------------------------------------------------------

--
-- Table structure for table `hangsx`
--

CREATE TABLE `hangsx` (
  `MA_HANGSX` varchar(10) NOT NULL,
  `TEN_HANGSX` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hangsx`
--

INSERT INTO `hangsx` (`MA_HANGSX`, `TEN_HANGSX`) VALUES
('H001', 'MISSOUT'),
('H002', 'ADIDAS'),
('H004', 'CONVERSE');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `MA_HD` int(10) NOT NULL,
  `MA_KH` int(11) NOT NULL,
  `TONGTIEN` int(11) NOT NULL,
  `TRANGTHAI` text DEFAULT NULL,
  `admin_id` varchar(5) DEFAULT NULL,
  `phuong_thuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`MA_HD`, `MA_KH`, `TONGTIEN`, `TRANGTHAI`, `admin_id`, `phuong_thuc`) VALUES
(1504270957, 15, 350000, 'Chưa Thanh Toán', 'ad01', 'COD'),
(1512051207, 15, 2500000, 'Chưa Thanh Toán', 'ad01', 'COD'),
(1612051219, 16, 2500000, 'Chưa Thanh Toán', 'ad01', 'COD'),
(1612051338, 16, 320000, 'Chưa Thanh Toán', 'ad01', 'COD'),
(1702270413, 17, 1020000, 'Chưa Thanh Toán', 'ad01', 'COD'),
(1702270605, 17, 1920000, 'Chưa Thanh Toán', 'ad01', 'COD'),
(1702270658, 17, 960000, 'Chưa Thanh Toán', 'ad01', 'COD'),
(1708191713, 17, 320000, 'Chưa Thanh Toán', 'ad01', 'COD'),
(1777277722, 15, 350000, 'Đã Thanh Toán', NULL, 'VNPay'),
(1777277826, 15, 350000, 'Đã Thanh Toán', NULL, 'VNPay'),
(1777280083, 15, 350000, 'Đã Thanh Toán', NULL, 'VNPay');

-- --------------------------------------------------------

--
-- Table structure for table `kh`
--

CREATE TABLE `kh` (
  `MA_KH` int(11) NOT NULL,
  `TEN_KH` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `MATKHAU` varchar(255) NOT NULL,
  `DIACHI` varchar(100) DEFAULT NULL,
  `AVATAR` varchar(500) DEFAULT NULL,
  `TRANGTHAI` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kh`
--

INSERT INTO `kh` (`MA_KH`, `TEN_KH`, `EMAIL`, `MATKHAU`, `DIACHI`, `AVATAR`, `TRANGTHAI`) VALUES
(15, 'Xin', 'xin@gmail.com', '12345678', 'PY', '1777277511_4k-Windows-11-Dark-Abstract-Blue-Purple-Wave-Wallpaper.jpg', ''),
(16, 'tien', 'tien@gmail.com', '123456', 'HCM', 'kh02.jpg', NULL),
(17, 'Nguyễn Thuỳ Trang', 'ntt@gmail.com', '12345678', '3602 Gaylord Dr', NULL, NULL),
(18, 'Nguyen Van A', 'test01@gmail.com', 'Password1', 'Ha Noi', NULL, NULL),
(19, 'Nguyen Van A', 'test01@gmail.com', 'Password1', 'Ha Noi', NULL, NULL),
(20, 'Nguyen Van A', 'test01@gmail.com', 'Password1', 'Ha Noi', NULL, NULL),
(21, 'Nguyen Van A', 'test01@gmail.com', 'Password1', 'Ha Noi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loaisp`
--

CREATE TABLE `loaisp` (
  `MA_LOAISP` varchar(10) NOT NULL,
  `TEN_LOAISP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `loaisp`
--

INSERT INTO `loaisp` (`MA_LOAISP`, `TEN_LOAISP`) VALUES
('L001', 'Giày'),
('L002', 'Áo'),
('L003', 'Quần'),
('L004', 'Tất');

-- --------------------------------------------------------

--
-- Table structure for table `sp`
--

CREATE TABLE `sp` (
  `MA_SP` varchar(10) NOT NULL,
  `TEN_SP` varchar(50) NOT NULL,
  `MA_LOAISP` varchar(10) NOT NULL,
  `MA_HANGSX` varchar(10) NOT NULL,
  `MIEUTA_SP` text DEFAULT NULL,
  `HINHANH_SP` text DEFAULT NULL,
  `GIA` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sp`
--

INSERT INTO `sp` (`MA_SP`, `TEN_SP`, `MA_LOAISP`, `MA_HANGSX`, `MIEUTA_SP`, `HINHANH_SP`, `GIA`) VALUES
('ao01', 'TEE SNOW BEAR', 'L002', 'H001', 'Chất liệu vải cotton thoáng khí', 'ao01.jpg', 320000),
('ao03', 'MELTING CHEESE', 'L002', 'H001', 'Chất liệu vải cotton thoáng khí', 'ao03.jpg', 350000),
('ao04', 'SPACE TEE MST', 'L002', 'H001', 'Chất liệu vải cotton thoáng khí', 'ao04.jpg', 340000),
('ao05', 'CARDIGAN LOGO M', 'L002', 'H001', 'Chất liệu vải cotton thoáng khí', 'ao05.jpg', 420000),
('ao06', 'SÆ  MI LOGO ( SHIRT )', 'L002', 'H001', 'Chất liệu vải cotton thoáng khí', 'ao06.png', 380000),
('ao07', 'LOGO LINE TEE', 'L002', 'H001', 'Chất liệu vải cotton thoáng khí', 'ao07.jpg', 320000),
('giay01', 'MST LOGO SLIPPER', 'L001', 'H001', 'Chất liệu vải cotton thoáng khí', 'giay01.jpg', 380000),
('giay02', 'ZX 1K BOOST', 'L001', 'H002', 'Chất liệu vải cotton thoáng khí', 'giay02.jpg', 2500000),
('giay03', 'CHUCK TAYLOR ALL STAR MADISON HYBRID SHINE', 'L001', 'H004', 'Chất liệu vải cotton thoáng khí', 'giay03.jpg', 1500000),
('quan01', 'LOGO PANTS', 'L003', 'H001', 'Chất liệu vải cotton thoáng khí', 'quan01.jpg', 420000),
('quan02', 'SWEATPANTS LOGO', 'L003', 'H001', 'Chất liệu vải cotton thoáng khí', 'quan02.jpg', 380000),
('tui01', 'Wallet Logo', 'L004', 'H004', 'Chất liệu vải cotton thoáng khí', 'tui01.jpg', 250000),
('tui02', 'BACKPACK LOGO MISSOUT', 'L004', 'H001', 'Chất liệu vải cotton thoáng khí', 'tui02.jpg', 580000),
('tui03', 'MST SHOULDER BAG', 'L004', 'H001', 'Chất liệu vải cotton thoáng khí', 'tui03.jpg', 350000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_blog_admin` (`admin_id`);

--
-- Indexes for table `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  ADD PRIMARY KEY (`MA_HD`,`MA_SP`),
  ADD KEY `FK_SP` (`MA_SP`);

--
-- Indexes for table `hangsx`
--
ALTER TABLE `hangsx`
  ADD PRIMARY KEY (`MA_HANGSX`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MA_HD`),
  ADD KEY `fk_hoadon_admin` (`admin_id`);

--
-- Indexes for table `kh`
--
ALTER TABLE `kh`
  ADD PRIMARY KEY (`MA_KH`);

--
-- Indexes for table `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MA_LOAISP`);

--
-- Indexes for table `sp`
--
ALTER TABLE `sp`
  ADD PRIMARY KEY (`MA_SP`),
  ADD KEY `MA_LOAISP` (`MA_LOAISP`),
  ADD KEY `MA_HANGSX` (`MA_HANGSX`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MA_HD` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1777280084;

--
-- AUTO_INCREMENT for table `kh`
--
ALTER TABLE `kh`
  MODIFY `MA_KH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `fk_blog_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  ADD CONSTRAINT `FK_HD` FOREIGN KEY (`MA_HD`) REFERENCES `hoadon` (`MA_HD`),
  ADD CONSTRAINT `FK_SP` FOREIGN KEY (`MA_SP`) REFERENCES `sp` (`MA_SP`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_hoadon_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`ID`);

--
-- Constraints for table `sp`
--
ALTER TABLE `sp`
  ADD CONSTRAINT `sp_ibfk_1` FOREIGN KEY (`MA_LOAISP`) REFERENCES `loaisp` (`MA_LOAISP`),
  ADD CONSTRAINT `sp_ibfk_2` FOREIGN KEY (`MA_HANGSX`) REFERENCES `hangsx` (`MA_HANGSX`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
