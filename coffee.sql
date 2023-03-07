
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlbh`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_dathang` (`SoDonDH` INT(11), `MSHH` INT(11), `SoLuong` INT(11), `GiaDatHang` INT(11))  BEGIN
    select SoLuongHang  from hanghoa as a where a.MSHH=MSHH;
	 INSERT into chitietdathang (SoDonDH,MSHH,SoLuong,GiaDatHang) values(SoDonDH,MSHH,SoLuong,GiaDatHang);
     UPDATE hanghoa as a SET SoLuongHang=SoLuongHang-SoLuong WHERE a.MSHH = MSHH;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_suahanghoa` (`TenHH` VARCHAR(30), `QuyCach` TEXT, `Gia` INT(11), `SoLuongHang` INT(11), `MaLoaiHang` INT(11), `TenHinh` VARCHAR(100), `MSHH` INT(11))  BEGIN
	UPDATE hanghoa as a SET a.TenHH=TenHH, a.QuyCach=QuyCach, a.Gia=Gia, a.SoLuongHang= SoLuongHang, a.MaLoaiHang=MaLoaiHang 
			WHERE a.MSHH=MSHH;
    UPDATE hinhhanghoa as a SET a.TenHinh=TenHinh
    WHERE a.MSHH=MSHH;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_themhanghoa` (`TenHH` VARCHAR(30), `QuyCach` TEXT, `Gia` INT(11), `SoLuongHang` INT(11), `MaLoaiHang` INT(11), `TenHinh` VARCHAR(100))  BEGIN
	declare MSHH int (11);
	INSERT INTO hanghoa(TenHH,QuyCach,Gia,SoLuongHang,MaLoaiHang) Values ( TenHH,QuyCach,Gia,SoLuongHang, MaLoaiHang);
    	SELECT LAST_INSERT_ID() into MSHH;
	INSERT INTO hinhhanghoa(TenHinh,MSHH) VALUES (TenHinh, MSHH);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_themkh` (`HoTenKH` VARCHAR(30), `TenCongTy` VARCHAR(300), `SoDienThoai` CHAR(10), `SoFax` VARCHAR(10), `MatKhau` VARCHAR(30), `DiaChi` VARCHAR(100))  BEGIN
	declare makh int(11);
    declare sdt char(10);
	INSERT INTO khachhang(HoTenKH,TenCongTy,SoDienThoai,SoFax,MatKhau) VALUES(HoTenKH,TenCongTy,SoDienThoai,SoFax,MatKhau);
	SELECT LAST_INSERT_ID() into makh;
    INSERT INTO diachikh(DiaChi,MSKH) VALUES (DiaChi,makh);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `SoDonDH` int(11) UNSIGNED NOT NULL,
  `MSHH` int(11) UNSIGNED NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaDatHang` int(11) NOT NULL,
  `GiamGia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `SoDonDH` int(11) UNSIGNED NOT NULL,
  `MSKH` int(11) UNSIGNED NOT NULL,
  `MSNV` int(11) UNSIGNED DEFAULT NULL,
  `NgayDH` date NOT NULL,
  `NgayGH` date DEFAULT NULL,
  `TrangThaiDH` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachikh`
--

CREATE TABLE `diachikh` (
  `MaDC` int(11) UNSIGNED NOT NULL,
  `DiaChi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MSKH` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES
(1, 'Cần Thơ', 1),
(4, 'Cần Thơ', 4);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `donhang_view`
-- (See below for the actual view)
--
CREATE TABLE `donhang_view` (
`SoDonDH` int(11) unsigned
,`MSKH` int(11) unsigned
,`MSNV` int(11) unsigned
,`NgayDH` date
,`NgayGH` date
,`TenTrangThai` varchar(30)
,`TrangThaiDH` int(1)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` int(11) UNSIGNED NOT NULL,
  `TenHH` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `QuyCach` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Gia` int(11) UNSIGNED NOT NULL,
  `SoLuongHang` int(11) UNSIGNED NOT NULL,
  `MaLoaiHang` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`) VALUES
(1, 'Cà phê sữa đá', '', 39000, 49, 1),
(2, 'Bạc Sỉu', '', 29000, 49, 1),
(3, 'Latte Đá', '', 49000, 49, 1),
(16, 'Latte Nóng', '', 49000, 50, 1),
(17, 'Cà phê đen đá', '', 29000, 49, 1),
(20, 'Americano Đá', '', 39000, 50, 1),
(21, 'Caramel Macchiato Đá', '', 49000, 50, 1),
(22, 'Americano Nóng', '', 39000, 50, 1),
(23, 'Cappuccino Đá', '', 49000, 50, 1),
(24, 'Cappuccino Nóng', '', 49000, 22, 1),
(25, 'Espresso Đá', '', 45000, 11, 1),
(26, 'Espresso Nóng', '', 39000, 22, 1),
(27, 'Cold Brew Phúc Bồn Tử', '', 45000, 40, 1),
(28, 'Cold Brew Sữa Tươi', '', 45000, 40, 1),
(29, 'Cold Brew Truyền Thống', '\r\n', 45000, 40, 1),
(30, 'CloudFee Caramel', '', 49000, 50, 1),
(31, 'CloudFee Pandan Coconut', '', 49000, 50, 1),
(32, 'CloudTea Oolong Nướng Kem Chee', '', 55000, 50, 1),
(33, 'CloudTea Oolong Nướng Caramel', '', 55000, 50, 1),
(34, 'CloudTea Hồng Trà Arabica', '', 55000, 50, 1),
(35, 'CloudTea Oolong Nướng Kem Dừa', '', 55000, 50, 1),
(36, 'Trà Đào Cam Sả Nóng', '', 49000, 50, 2),
(37, 'Trà Hạt Sen Đá', '', 49000, 50, 2),
(38, 'Trà Hạt Sen Nóng', '', 49000, 50, 2),
(39, 'Trà Long Nhãn Hạt Chia', '', 49000, 50, 2),
(40, 'Trà Long Nhãn Hạt Chia Nóng', '', 49000, 50, 2),
(41, 'Bánh Mì Que Pate Cay', '', 20000, 50, 3),
(42, 'Bánh Mì VN Thịt Nguội', '', 35000, 50, 3),
(43, 'Croissant trứng muối', '', 35000, 50, 3),
(44, 'Chocolate Đá', '', 55000, 50, 4),
(45, 'Phúc Bồn Tử Mandarin', '', 49000, 50, 4),
(46, 'Đá Tuyết Xoài Đào', '', 55000, 50, 4);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `hanghoa_view`
-- (See below for the actual view)
--
CREATE TABLE `hanghoa_view` (
`MSHH` int(11) unsigned
,`TenHH` varchar(100)
,`QuyCach` text
,`Gia` int(11) unsigned
,`SoLuongHang` int(11) unsigned
,`MaLoaiHang` int(11) unsigned
,`TenLoaiHang` varchar(30)
,`TenHinh` varchar(100)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhhanghoa`
--

CREATE TABLE `hinhhanghoa` (
  `MaHinh` int(11) UNSIGNED NOT NULL,
  `TenHinh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MSHH` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinhhanghoa`
--

INSERT INTO `hinhhanghoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES
(1, 'img/1.png', 1),
(2, 'img/2.png', 2),
(3, 'img/3.png', 3),
(31, 'img/4.png', 16),
(32, 'img/5.png', 17),
(35, 'img/6.png', 20),
(36, 'img/7.png', 21),
(37, 'img/8.png', 22),
(38, 'img/9.png', 23),
(39, 'img/10.png', 24),
(40, 'img/11.png', 25),
(41, 'img/12.png', 26),
(42, 'img/13.png', 27),
(43, 'img/14.png', 28),
(44, 'img/15.png', 29),
(45, 'img/16.png', 30),
(46, 'img/17.png', 31),
(47, 'img/18.png', 32),
(48, 'img/19.png', 33),
(49, 'img/20.png', 34),
(50, 'img/21.png', 35),
(51, 'img/22.png', 36),
(52, 'img/23.png', 37),
(53, 'img/24.png', 38),
(54, 'img/25.png', 39),
(55, 'img/26.png', 40),
(56, 'img/27.png', 41),
(57, 'img/28.png', 42),
(58, 'img/29.png', 43),
(59, 'img/30.png', 44),
(60, 'img/31.png', 45),
(61, 'img/32.png', 46);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` int(11) UNSIGNED NOT NULL,
  `HoTenKH` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `TenCongTy` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SoDienThoai` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `SoFax` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MatKhau` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `TenCongTy`, `SoDienThoai`, `SoFax`, `MatKhau`) VALUES
(1, 'Nguyễn Văn A', NULL, '0123456789', NULL, '123123'),
(4, 'Phạm Văn B', 'Blabla', '0987654321', '', '123123');

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `khachhang_view`
-- (See below for the actual view)
--
CREATE TABLE `khachhang_view` (
`MSKH` int(11) unsigned
,`HoTenKH` varchar(30)
,`TenCongTy` varchar(300)
,`SoDienThoai` char(10)
,`SoFax` varchar(10)
,`DiaChi` varchar(100)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` int(11) UNSIGNED NOT NULL,
  `TenLoaiHang` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES
(1, 'Cà phê'),
(2, 'Trà'),
(3, 'Bánh & Snack'),
(4, 'Thức uống khác');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MSNV` int(11) UNSIGNED NOT NULL,
  `HoTenNV` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ChucVu` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SoDienThoai` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `MatKhau`) VALUES
(1, 'Nguyễn Ngọc Vân Anh', 'Quản lý', NULL, '0395557659', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trangthaidh`
--

CREATE TABLE `trangthaidh` (
  `TrangThaiDH` int(1) NOT NULL,
  `TenTrangThai` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `trangthaidh`
--

INSERT INTO `trangthaidh` (`TrangThaiDH`, `TenTrangThai`) VALUES
(1, 'Chưa xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đã giao hàng');

-- --------------------------------------------------------

--
-- Cấu trúc cho view `donhang_view`
--
DROP TABLE IF EXISTS `donhang_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `donhang_view`  AS SELECT `a`.`SoDonDH` AS `SoDonDH`, `a`.`MSKH` AS `MSKH`, `a`.`MSNV` AS `MSNV`, `a`.`NgayDH` AS `NgayDH`, `a`.`NgayGH` AS `NgayGH`, `b`.`TenTrangThai` AS `TenTrangThai`, `b`.`TrangThaiDH` AS `TrangThaiDH` FROM (`dathang` `a` join `trangthaidh` `b`) WHERE `a`.`TrangThaiDH` = `b`.`TrangThaiDH` ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `hanghoa_view`
--
DROP TABLE IF EXISTS `hanghoa_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hanghoa_view`  AS SELECT `a`.`MSHH` AS `MSHH`, `a`.`TenHH` AS `TenHH`, `a`.`QuyCach` AS `QuyCach`, `a`.`Gia` AS `Gia`, `a`.`SoLuongHang` AS `SoLuongHang`, `b`.`MaLoaiHang` AS `MaLoaiHang`, `b`.`TenLoaiHang` AS `TenLoaiHang`, `c`.`TenHinh` AS `TenHinh` FROM ((`hanghoa` `a` join `loaihanghoa` `b`) join `hinhhanghoa` `c`) WHERE `a`.`MaLoaiHang` = `b`.`MaLoaiHang` AND `a`.`MSHH` = `c`.`MSHH` ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `khachhang_view`
--
DROP TABLE IF EXISTS `khachhang_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `khachhang_view`  AS SELECT `a`.`MSKH` AS `MSKH`, `a`.`HoTenKH` AS `HoTenKH`, `a`.`TenCongTy` AS `TenCongTy`, `a`.`SoDienThoai` AS `SoDienThoai`, `a`.`SoFax` AS `SoFax`, `b`.`DiaChi` AS `DiaChi` FROM (`khachhang` `a` join `diachikh` `b`) WHERE `a`.`MSKH` = `b`.`MSKH` ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`MSHH`,`SoDonDH`) USING BTREE,
  ADD KEY `SoDonDH` (`SoDonDH`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`),
  ADD KEY `MSKH` (`MSKH`),
  ADD KEY `MSNV` (`MSNV`),
  ADD KEY `TrangThaiDH` (`TrangThaiDH`);

--
-- Chỉ mục cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `MaLoaiHang` (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD PRIMARY KEY (`MaHinh`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`);

--
-- Chỉ mục cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MSNV`);

--
-- Chỉ mục cho bảng `trangthaidh`
--
ALTER TABLE `trangthaidh`
  ADD PRIMARY KEY (`TrangThaiDH`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `SoDonDH` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MSHH` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  MODIFY `MaHinh` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MSKH` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLoaiHang` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MSNV` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `chitietdathang_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`),
  ADD CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`);

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`),
  ADD CONSTRAINT `dathang_ibfk_3` FOREIGN KEY (`TrangThaiDH`) REFERENCES `trangthaidh` (`TrangThaiDH`);

--
-- Các ràng buộc cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`);

--
-- Các ràng buộc cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD CONSTRAINT `hinhhanghoa_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
