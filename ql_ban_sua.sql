-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 03, 2024 lúc 10:08 PM
-- Phiên bản máy phục vụ: 5.7.34
-- Phiên bản PHP: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_ban_sua`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_hoa_don`
--

CREATE TABLE `ct_hoa_don` (
  `so_hoa_don` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ma_sua` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_hoa_don`
--

INSERT INTO `ct_hoa_don` (`so_hoa_don`, `ma_sua`, `so_luong`, `don_gia`) VALUES
('D001', 'AB0001', 2, 107000),
('D001', 'DL0001', 12, 41000),
('D001', 'NTF002', 8, 45000),
('D001', 'VNM012', 4, 103500),
('D002', 'DL0001', 2, 41000),
('D002', 'MJ0001', 5, 196000),
('D002', 'MJ0004', 3, 198000),
('D003', 'AB0001', 8, 107000),
('D003', 'AB0003', 17, 87000),
('D003', 'DL0006', 13, 11500),
('D004', 'AB0001', 15, 107000),
('D004', 'AB0002', 25, 107000),
('D004', 'NTF001', 10, 46500),
('D004', 'VNM012', 8, 103500);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hang_sua`
--

CREATE TABLE `hang_sua` (
  `ma_hang_sua` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten_hang_sua` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dien_thoai` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hang_sua`
--

INSERT INTO `hang_sua` (`ma_hang_sua`, `ten_hang_sua`, `dia_chi`, `dien_thoai`, `email`) VALUES
('AB', 'Abbott Grow', 'Abbott Laboratories GmbH. Mê Linh Point Tower Tầng 9, Số 2 Ngô Đức Kế Quận 1, Thành phố Hồ Chí Minh, Việt Nam', '0906661220', 'pv.vietnam@abbott.com'),
('DL', 'Dutch Lady', 'Khu công nghiệp Biên Hòa - Đồng Nai', '7826451', 'dutchlady@dl.com'),
('DM', 'Dumex', 'Khu công nghiệp Sóng Thần Bình Dương', '6258943', 'dumex@dm.com'),
('DS', 'Daisy', 'Khu công nghiệp Sóng Thần Bình Dương', '5789321', 'daisy@ds.com'),
('MJ', 'Mead Johnson', 'Công ty nhập khẩu Việt Nam', '8741258', 'meadjohn@mj.com'),
('NTF', 'Nutifood', 'Khu công nghiệp Sóng Thần Bình Dương', '7895632', 'nutifood@ntf.com'),
('VNM', 'Vinamilk', '123 Nguyễn Du - Quận 1 - TP.HCM', '8794561', 'vinamilk@vnm.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `so_hoa_don` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_hd` date NOT NULL,
  `ma_khach_hang` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `tri_gia` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`so_hoa_don`, `ngay_hd`, `ma_khach_hang`, `tri_gia`) VALUES
('D001', '2023-01-01', 'KH001', 1480000),
('D002', '2023-01-02', 'KH002', 1656000),
('D003', '2023-01-03', 'KH003', 2484500),
('D004', '2023-01-04', 'KH002', 5573000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_khach_hang` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ten_khach_hang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phai` tinyint(1) NOT NULL,
  `dia_chi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dien_thoai` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`ma_khach_hang`, `ten_khach_hang`, `phai`, `dia_chi`, `dien_thoai`, `email`) VALUES
('kh001', 'Khuất Thủy Phương', 1, 'A21 Nguyễn Oanh quận Gò Vấp', '9874125', 'kh001@example.com'),
('kh002', 'Đỗ Lâm Thiên', 0, '357 Lê Hồng Phong Q.10', '8351056', 'kh002@example.com'),
('kh003', 'Phạm Thị Nhung', 1, '56 Đinh Tiên Hoàng quận 1', '9745698', 'kh003@example.com'),
('kh004', 'Nguyễn Khắc Thiên', 0, '12bis Đường 3-2 quận 10', '8769128', 'kh004@example.com'),
('kh005', 'Tô Trần Hồ Giảng', 0, '75 Nguyễn Kiệm quận Gò Vấp', '5792564', 'kh005@example.com'),
('kh006', 'Nguyễn Kiến Thi', 1, '357 Lê Hồng Phong Q.10', '9874125', 'kh006@example.com'),
('kh008', 'Nguyễn Anh Tuấn', 0, '1/2bis Nơ Trang Long Q.BT TP.HCM', '8753159', 'kh008@example.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_sua`
--

CREATE TABLE `loai_sua` (
  `ma_loai_sua` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_sua`
--

INSERT INTO `loai_sua` (`ma_loai_sua`, `ten_loai`) VALUES
('SB', 'Sữa bột'),
('SC', 'Sữa chua'),
('SD', 'Sữa đặc'),
('ST', 'Sữa tươi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sua`
--

CREATE TABLE `sua` (
  `ma_sua` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `ten_sua` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ma_hang_sua` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ma_loai_sua` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `trong_luong` int(11) NOT NULL,
  `don_gia` int(11) NOT NULL,
  `tp_dinh_duong` text COLLATE utf8_unicode_ci,
  `loi_ich` text COLLATE utf8_unicode_ci,
  `hinh` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sua`
--

INSERT INTO `sua` (`ma_sua`, `ten_sua`, `ma_hang_sua`, `ma_loai_sua`, `trong_luong`, `don_gia`, `tp_dinh_duong`, `loi_ich`, `hinh`) VALUES
('AB0001', 'Gain Advance', 'AB', 'SB', 400, 107000, 'Sữa không béo, dầu thực vật, đường lactose, đường', 'Sữa bột Gain Advance sữa bột tiếp theo giàu đạm TPA', 'Image/s_abbott_gainadvance_bot_400.jpg'),
('AB0002', 'Gain IQ', 'AB', 'SB', 400, 107000, '', 'GAIN IQ có nguồn đạm chất lượng cao. Hỗ trợ tăng trưởng.', 'Image/s_abbott_ganiq.jpg'),
('AB0003', 'Abbott Grow', 'AB', 'SB', 400, 87000, 'Năng lượng, taurine, choline, canxi', 'Sữa bột GROW được đặc chế và gia tăng thêm các lợi ích.', 'Image/s_abbott_grow_400.jpg'),
('AB0004', 'Abbott Grow School', 'AB', 'SB', 400, 146000, 'Các dưỡng chất và PEDIASURE với Synbiotics và MCT', 'Hỗ trợ phát triển chiều cao.', 'Image/s_abbott_school_bot_400.jpg'),
('AB0005', 'Abbott Pedia Sure', 'AB', 'SB', 400, 145000, 'Cung cấp DHA, ARA, Omega 3 & 6', 'Cung cấp đầy đủ các chất dinh dưỡng.', 'Image/s_abbott_pediasure_bot_400.jpg'),
('AB0006', 'Similac Neo Sure', 'AB', 'SB', 370, 41000, 'Chất dinh dưỡng, vitamin và khoáng chất', 'Giúp phát triển toàn diện.', 'Image/s_abbott_similac_400.jpg'),
('DL0001', 'Gái Hà Lan', 'DL', 'SD', 400, 52000, 'Sữa bột nguyên kem', 'Giúp hệ thần kinh của trẻ minh mẫn để tiếp thu tốt.', 'Image/s_dutchlady_bot_giay_400.jpg'),
('DL0002', 'Canximex', 'DL', 'SB', 900, 106000, 'Bổ sung các dinh dưỡng thiết yếu', 'Giàu canxi, ít béo.', 'Image/s_dutchlady_canximex_900.jpg'),
('DL0003', 'Friso', 'DL', 'SB', 400, 52600, 'Chứa DHA, axit béo omega', 'Hỗ trợ phát triển trí não.', 'Image/s_dutchlady_friso_400.jpg'),
('DL0004', 'Cô Gái Hà Lan 123', 'DL', 'SB', 400, 49500, 'Dinh dưỡng toàn diện', 'Phát triển thể chất và trí tuệ.', 'Image/s_dutchlady_123_bot.jpg'),
('DL0005', 'Cô Gái Hà Lan 456', 'DL', 'SB', 400, 9800, 'Hương vị ngọt dịu', 'Cung cấp năng lượng cho trẻ.', 'Image/s_dutchlady_bot_giay_456_400.jpg'),
('DL0006', 'Sữa đặc Trường Sinh', 'DL', 'SD', 360, 11500, 'Chứa vitamin và khoáng chất', 'Hỗ trợ sức khỏe hệ tiêu hóa.', 'Image/s_dutchlady_dac_truong_sinh.jpg'),
('DL0007', 'Sữa đặc Hoàn Hảo', 'DL', 'SD', 360, 3000, 'Giúp bạn luôn năng động và khỏe mạnh', 'Sữa tiệt trùng không chất bảo quản.', 'Image/s_dutchlady_hon_hao.jpg'),
('DL0008', 'Sữa chua Cô Gái Hà Lan', 'DL', 'SC', 100, 3500, 'Cung cấp đầy đủ chất dinh dưỡng', 'Giúp trẻ vui tươi và năng động.', 'Image/s_dutchlady_chua.jpg'),
('DL0009', 'Sữa chua uống Cô Gái Hà Lan', 'DL', 'ST', 180, 2500, 'Vị chua ngọt, thơm ngon', 'Giúp bạn luôn có làn da mịn màng.', 'Image/s_dutchlady_tuoi.jpg'),
('DL0010', 'Fristi', 'DL', 'ST', 180, 3600, 'Khoáng chất, taurine, vitamin D3, sắt', 'Đáp ứng mọi nhu cầu sử dụng.', 'Image/s_dutchlady_fristi.jpg'),
('DS0001', 'Daisy Không Đường', 'DS', 'SB', 900, 79000, 'Khoáng chất, vitamin D3', 'Giúp xương chắc khỏe.', 'Image/s_daisy_900.jpg'),
('DS0002', 'Daisy Vani', 'DS', 'SB', 454, 41000, 'Bổ sung đầy đủ nguồn dinh dưỡng', 'Giúp trẻ luôn khỏe mạnh.', 'Image/s_daisy_bot_400.jpg'),
('MJ0001', 'Enfa Mama A+', 'MJ', 'SB', 900, 196000, 'DHA, axit béo omega', 'Cung cấp nguồn dinh dưỡng đầy đủ.', 'Image/s_meadJohnson_mama.jpg'),
('MJ0002', 'Enfalac', 'MJ', 'SB', 400, 96000, 'Khoáng chất, taurine, vitamin D3, sắt', 'Giúp trẻ phát triển toàn diện.', 'Image/s_meadJohnson_enfalac.jpg'),
('MJ0003', 'EnfaGrow', 'MJ', 'SB', 400, 241000, 'DHA, ARA, vitamin và khoáng chất', 'Sữa dinh dưỡng cho trẻ từ 6 tháng.', 'Image/s_meadJohnson_enfagrow.jpg'),
('MJ0004', 'EnfaPro', 'MJ', 'SB', 900, 198000, 'Chất đạm, DHA, ARA', 'Hỗ trợ phát triển trí não.', 'Image/s_meadJohnson_enfapro.jpg'),
('MJ0005', 'EnfaPro A+', 'MJ', 'SB', 900, 198000, 'Chất đạm, DHA, ARA', 'Hỗ trợ phát triển trí não.', 'Image/s_meadJohnson_enfaproA.jpg'),
('NTF001', 'Nuti Mum', 'NTF', 'SB', 900, 241000, 'Cung cấp nguồn dinh dưỡng đầy đủ', 'Bổ sung đầy đủ dinh dưỡng cho trẻ.', 'Image/s_nutifood_mum.jpg'),
('VNM012', 'Cô Gái Hà Lan', 'VNM', 'ST', 300, 200000, 'Canxi, Carbonhydrates, Magie, Phốt pho, Kali, Protein, Riboflavin và Kẽm', 'Tăng cường sức khỏe, phát triển hệ xương', 'Image/cogaihalan.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ct_hoa_don`
--
ALTER TABLE `ct_hoa_don`
  ADD PRIMARY KEY (`so_hoa_don`,`ma_sua`),
  ADD KEY `ma_sua` (`ma_sua`);

--
-- Chỉ mục cho bảng `hang_sua`
--
ALTER TABLE `hang_sua`
  ADD PRIMARY KEY (`ma_hang_sua`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`so_hoa_don`),
  ADD KEY `ma_khach_hang` (`ma_khach_hang`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_khach_hang`);

--
-- Chỉ mục cho bảng `loai_sua`
--
ALTER TABLE `loai_sua`
  ADD PRIMARY KEY (`ma_loai_sua`);

--
-- Chỉ mục cho bảng `sua`
--
ALTER TABLE `sua`
  ADD PRIMARY KEY (`ma_sua`),
  ADD KEY `ma_hang_sua` (`ma_hang_sua`),
  ADD KEY `ma_loai_sua` (`ma_loai_sua`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
