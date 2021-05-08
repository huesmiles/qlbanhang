-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 06, 2021 lúc 03:09 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tranhuong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_px`
--

CREATE TABLE `chitiet_px` (
  `ma_hh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sl` float(10,2) NOT NULL DEFAULT 1.00,
  `don_gia` int(100) NOT NULL DEFAULT 0,
  `ma_phieuxuat` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiet_px`
--

INSERT INTO `chitiet_px` (`ma_hh`, `sl`, `don_gia`, `ma_phieuxuat`) VALUES
('1', 1.00, 32132, 99364),
('1', 1.00, 5455, 36742);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hang_hoa`
--

CREATE TABLE `hang_hoa` (
  `ma_hh` int(100) NOT NULL,
  `ten_hh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nhacc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dongia_ban` int(255) NOT NULL DEFAULT 0,
  `dongia_nhap` int(11) NOT NULL,
  `anh_hh` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hang_hoa`
--

INSERT INTO `hang_hoa` (`ma_hh`, `ten_hh`, `nhacc`, `dongia_ban`, `dongia_nhap`, `anh_hh`) VALUES
(1, 'sản phẩm 1', 'A', 32132, 5455, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_kh` int(100) NOT NULL,
  `ten_kh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zalo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sinhnhat` date NOT NULL,
  `phanloai` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`ma_kh`, `ten_kh`, `mobile`, `dia_chi`, `facebook`, `zalo`, `email`, `sinhnhat`, `phanloai`) VALUES
(2, 'Khách hàng 3', '121', 'Hà Nội111', '0', '0', 'itthinhphat@gmail.com', '0000-00-00', 'Khách hàng'),
(3, 'Khách hàng 4', '121', 'Hà Nội434343', '0', '0', 'itthinhphat@gmail.com', '0000-00-00', 'Khách hàng'),
(4, 'nhà cung cấp 1', '121', 'Hà Nội111', '0', '0', 'phucvu365@gmail.com', '0000-00-00', 'Nhà cung cấp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `ma_nv` int(100) NOT NULL,
  `ten_nv` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `mat_khau` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cap_bac` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tencuahang` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_vien`
--

INSERT INTO `nhan_vien` (`ma_nv`, `ten_nv`, `mobile`, `dia_chi`, `mat_khau`, `cap_bac`, `tencuahang`) VALUES
(81, 'admin', '1', 'Hà Nội', '1', 'quan_tri', 'fdádf'),
(83, 'nhanvien', '097479886312', 'Hà Nội', '1', 'nhan_vien', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_thu`
--

CREATE TABLE `phieu_thu` (
  `ma_phieuthu` int(100) NOT NULL,
  `ngay_thu` date NOT NULL,
  `tien_thu` int(100) NOT NULL DEFAULT 0,
  `noi_dung` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_kh` int(30) NOT NULL,
  `phanloaithuchi` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_thu`
--

INSERT INTO `phieu_thu` (`ma_phieuthu`, `ngay_thu`, `tien_thu`, `noi_dung`, `ma_kh`, `phanloaithuchi`) VALUES
(1, '2021-04-05', 0, 'Số ban đầu', 1, 'Phiếu thu'),
(2, '2021-04-06', 0, 'Số ban đầu', 2, 'Phiếu thu'),
(3, '2021-04-06', 0, 'Số ban đầu', 3, 'Phiếu thu'),
(4, '2021-04-06', 0, 'Số ban đầu', 4, 'Phiếu thu'),
(5, '2021-04-06', 100000, 'fsdfsd', 4, 'Phiếu chi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_xuat`
--

CREATE TABLE `phieu_xuat` (
  `ma_phieuxuat` int(100) NOT NULL,
  `ma_kh` int(100) NOT NULL,
  `ma_nv` int(100) NOT NULL,
  `ngay_xuat` date NOT NULL,
  `tien_km_don_hang` int(255) NOT NULL DEFAULT 0,
  `tien_ship_dh` int(255) NOT NULL DEFAULT 0,
  `ghi_chu_dh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phanloai` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hinhthuctt` text COLLATE utf8_unicode_ci NOT NULL,
  `nhanvien` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_xuat`
--

INSERT INTO `phieu_xuat` (`ma_phieuxuat`, `ma_kh`, `ma_nv`, `ngay_xuat`, `tien_km_don_hang`, `tien_ship_dh`, `ghi_chu_dh`, `phanloai`, `hinhthuctt`, `nhanvien`) VALUES
(36742, 4, 81, '2021-04-06', 0, 0, '', 'Phiếu nhập', 'tienmat', 'Nguyễn Văn A'),
(99364, 2, 81, '2021-04-06', 0, 0, '', 'Phiếu xuất', 'tienmat', 'Nguyễn Văn A');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `hang_hoa`
--
ALTER TABLE `hang_hoa`
  ADD PRIMARY KEY (`ma_hh`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_kh`);

--
-- Chỉ mục cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`ma_nv`);

--
-- Chỉ mục cho bảng `phieu_thu`
--
ALTER TABLE `phieu_thu`
  ADD PRIMARY KEY (`ma_phieuthu`);

--
-- Chỉ mục cho bảng `phieu_xuat`
--
ALTER TABLE `phieu_xuat`
  ADD PRIMARY KEY (`ma_phieuxuat`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `hang_hoa`
--
ALTER TABLE `hang_hoa`
  MODIFY `ma_hh` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `ma_kh` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  MODIFY `ma_nv` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `phieu_thu`
--
ALTER TABLE `phieu_thu`
  MODIFY `ma_phieuthu` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `phieu_xuat`
--
ALTER TABLE `phieu_xuat`
  MODIFY `ma_phieuxuat` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99365;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
