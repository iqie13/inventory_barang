-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2016 at 12:20 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_inventory`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `dataUser`()
BEGIN
select a.id_user, b.id_karyawan, a.username, a.password, a.active, b.fullname, b.email, b.no_telp, b.`status`,b.id_job_title, c.url, d.nama_job_title from tbluser a
left join tblkaryawan b ON a.id_karyawan = b.id_karyawan
left join tblphotokaryawan c ON a.id_karyawan = c.id_karyawan
left join tbljobtitle d ON b.id_job_title = d.id_job_title;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `failed`(IN `user` varchar(200))
BEGIN
select a.id_karyawan, a.email, b.id_user, b.username, b.active from tblkaryawan a
join tbluser b using(id_karyawan)
where a.email = user or b.username = user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `loginProcess`(IN `user` varchar(200), IN `pass` varchar(1000))
BEGIN
select a.id_user, b.id_karyawan, a.username, a.password, a.active, b.id_code, b.fullname as nama_karyawan, b.email, b.`status`,b.id_job_title, c.url, d.nama_job_title from tbluser a
left join tblkaryawan b ON a.id_karyawan = b.id_karyawan
left join tblphotokaryawan c ON a.id_karyawan = c.id_karyawan
left join tbljobtitle d ON b.id_job_title = d.id_job_title
where (a.username = user OR b.email = user) AND a.password = pass;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `datauser`
--
CREATE TABLE IF NOT EXISTS `datauser` (
`id_user` int(11)
,`id_karyawan` int(11)
,`username` varchar(100)
,`password` varchar(500)
,`active` int(11)
,`nama_karyawan` varchar(200)
,`no_telp` varchar(45)
,`email` varchar(45)
,`status` int(45)
,`id_job_title` int(11)
,`url` varchar(1000)
,`nama_job_title` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `tblalamat`
--

CREATE TABLE IF NOT EXISTS `tblalamat` (
  `id_alamat` int(11) NOT NULL,
  `kode_pemilik` int(11) DEFAULT NULL,
  `nama_alamat` varchar(100) DEFAULT NULL,
  `kode_kota` int(11) DEFAULT NULL,
  `kode_provinsi` int(11) DEFAULT NULL,
  `kode_negara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblbarang`
--

CREATE TABLE IF NOT EXISTS `tblbarang` (
  `id_barang` int(11) NOT NULL,
  `kode_sn` varchar(50) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `kode_jenis` int(11) DEFAULT NULL,
  `qty_barang` int(11) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `expired_date` date DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `kode_suplier` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `update_id` int(11) NOT NULL,
  `update_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbarang`
--

INSERT INTO `tblbarang` (`id_barang`, `kode_sn`, `nama_barang`, `kode_jenis`, `qty_barang`, `satuan`, `expired_date`, `currency_id`, `harga`, `kode_suplier`, `description`, `warehouse_id`, `create_id`, `create_date`, `update_id`, `update_date`) VALUES
(1, '', 'Indomie Special', 2, 50, 'Dus', '2016-12-31', 1, 80000, 1, 'tesssss', 0, 0, '0000-00-00', 1, '2015-09-30'),
(2, '', 'Djarum super 16btg', 1, 10, 'Dus', '2018-09-30', 1, 150000, 4, 'Djarum super 16btg', 0, 1, '2015-09-21', 0, '0000-00-00'),
(3, '', 'Buku Tulis Sinar Dunia 38lbr', 3, 100, 'Packs', '0000-00-00', 1, 50000, 5, 'Buku Tulis Sinar Dunia 38lbr', 0, 2, '2015-09-30', 2, '2015-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `tblcurrency`
--

CREATE TABLE IF NOT EXISTS `tblcurrency` (
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(6) NOT NULL,
  `currency_name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcurrency`
--

INSERT INTO `tblcurrency` (`currency_id`, `currency_code`, `currency_name`) VALUES
(1, 'IDR', 'Rupiah'),
(2, 'USD', 'United State Dollar');

-- --------------------------------------------------------

--
-- Table structure for table `tblfailed`
--

CREATE TABLE IF NOT EXISTS `tblfailed` (
  `id_failed` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbljnsbarang`
--

CREATE TABLE IF NOT EXISTS `tbljnsbarang` (
  `kode_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljnsbarang`
--

INSERT INTO `tbljnsbarang` (`kode_jenis`, `nama_jenis`) VALUES
(1, 'Others'),
(2, 'Food & Drink'),
(3, 'Office');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobtitle`
--

CREATE TABLE IF NOT EXISTS `tbljobtitle` (
  `id_job_title` int(11) NOT NULL,
  `nama_job_title` varchar(50) DEFAULT NULL,
  `kode_job_title` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljobtitle`
--

INSERT INTO `tbljobtitle` (`id_job_title`, `nama_job_title`, `kode_job_title`) VALUES
(1, 'Administrator', 'ADM'),
(2, 'Staff', 'STAFF');

-- --------------------------------------------------------

--
-- Table structure for table `tblkaryawan`
--

CREATE TABLE IF NOT EXISTS `tblkaryawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_code` varchar(50) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `kota_lahir` int(11) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` int(45) DEFAULT NULL,
  `id_job_title` int(11) DEFAULT NULL,
  `join_date` date NOT NULL,
  `out_date` date NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `update_id` int(11) NOT NULL,
  `update_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkaryawan`
--

INSERT INTO `tblkaryawan` (`id_karyawan`, `id_code`, `firstname`, `lastname`, `fullname`, `gender`, `kota_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `email`, `status`, `id_job_title`, `join_date`, `out_date`, `create_id`, `create_date`, `update_id`, `update_date`) VALUES
(1, '2016.7CN.H214', 'Riki', 'Nurhidayat', 'Riki Nurhidayat', 'L', 1, '1991-03-12', 'Dusun Nanggela kidul RT 012/006', '089662432777', 'iqie13@gmail.com', 1, 1, '2016-01-07', '0000-00-00', 0, '0000-00-00', 1, '2016-01-07'),
(2, '2016.6ZC.T504', 'Harry', 'Potter', 'Harry Potter', 'L', 2, '1990-03-13', 'Manhattan, USA', '021123654', 'harry@gmail.com', 1, 2, '2016-01-07', '0000-00-00', 0, '0000-00-00', 1, '2016-01-07'),
(12, '2016.FAR.0322', 'Eko', 'Maulana Maghribi', 'Eko Maulana Maghribi', 'L', 4, '1991-01-01', 'Klaten Jawa tengah', '089662345678', 'eko@gmail.com', 1, 2, '2016-01-07', '2016-01-07', 1, '2016-01-07', 0, '0000-00-00'),
(13, '012016.885.7142', 'Tia', 'Wicaksono', 'Tia Wicaksono', 'L', 7, '1991-02-28', 'Mojokerto', '085234678543', 'tia.wicaksono@gmail.com', 1, 2, '2016-01-07', '0000-00-00', 1, '2016-01-07', 0, '0000-00-00'),
(14, '012016.4110.2000', 'Shinta', 'Rosdiana', 'Shinta Rosdiana', 'P', 11, '1989-01-10', 'Bandung', '085789987564', 'shinta@gmail.com', 1, 2, '2016-01-07', '0000-00-00', 1, '2016-01-07', 1, '2016-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `tblkota`
--

CREATE TABLE IF NOT EXISTS `tblkota` (
  `kode_kota` int(11) NOT NULL,
  `nama_kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkota`
--

INSERT INTO `tblkota` (`kode_kota`, `nama_kota`) VALUES
(1, 'Ciamis'),
(2, 'Tasikmalaya'),
(3, 'Garut'),
(4, 'Klaten'),
(5, 'Jakarta'),
(6, 'Surabaya'),
(7, 'Mojokerto'),
(8, 'Yogyakarta'),
(9, 'Malang'),
(10, 'Semarang'),
(11, 'Bandung');

-- --------------------------------------------------------

--
-- Table structure for table `tblloglogin`
--

CREATE TABLE IF NOT EXISTS `tblloglogin` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_login` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblloglogin`
--

INSERT INTO `tblloglogin` (`id_log`, `id_user`, `tgl_login`) VALUES
(2, 2, '2015-01-23 07:45:33'),
(3, 2, '2015-01-23 07:50:48'),
(4, 2, '2015-01-23 09:27:32'),
(5, 2, '2015-02-03 04:49:02'),
(6, 2, '2015-02-03 04:59:28'),
(7, 2, '2015-02-03 05:00:09'),
(8, 2, '2015-02-03 11:01:51'),
(9, 2, '2015-02-03 16:12:14'),
(10, 2, '2015-02-03 16:15:32'),
(11, 2, '2015-02-05 20:10:15'),
(12, 2, '2015-02-05 20:12:48'),
(13, 2, '2015-02-05 20:31:02'),
(14, 2, '2015-02-05 20:31:21'),
(15, 2, '2015-02-05 20:31:50'),
(16, 2, '2015-07-14 10:17:27'),
(17, 2, '2015-09-07 06:31:01'),
(18, 2, '2015-09-07 06:31:09'),
(19, 2, '2015-09-07 08:01:27'),
(20, 2, '2015-09-07 09:08:28'),
(21, 2, '2015-09-07 09:27:32'),
(22, 3, '2015-09-07 09:38:41'),
(23, 2, '2015-09-17 04:30:08'),
(24, 2, '2015-09-17 05:37:48'),
(25, 2, '2015-09-17 06:46:09'),
(26, 2, '2015-09-17 08:27:01'),
(27, 2, '2015-09-17 09:38:21'),
(28, 2, '2015-09-17 10:48:04'),
(29, 2, '2015-09-17 11:56:53'),
(30, 2, '2015-09-18 04:23:45'),
(31, 2, '2015-09-18 05:30:53'),
(32, 2, '2015-09-18 05:32:07'),
(33, 2, '2015-09-18 05:33:23'),
(34, 2, '2015-09-18 05:34:26'),
(35, 2, '2015-09-18 05:37:19'),
(36, 2, '2015-09-18 05:38:55'),
(37, 2, '2015-09-18 05:42:22'),
(38, 2, '2015-09-18 05:43:42'),
(39, 2, '2015-09-18 08:43:58'),
(40, 2, '2015-09-18 09:59:12'),
(41, 2, '2015-09-19 08:21:28'),
(42, 2, '2015-09-19 13:22:17'),
(43, 2, '2015-09-19 14:30:53'),
(44, 2, '2015-09-20 12:34:37'),
(45, 2, '2015-09-21 04:03:37'),
(46, 2, '2015-09-21 05:13:41'),
(47, 2, '2015-09-21 08:33:03'),
(48, 2, '2015-09-21 09:45:27'),
(49, 2, '2015-09-22 04:34:49'),
(50, 2, '2015-09-30 05:14:51'),
(51, 2, '2015-09-30 08:49:38'),
(52, 2, '2015-09-30 10:19:55'),
(53, 3, '2015-09-30 10:23:50'),
(54, 2, '2015-10-01 05:01:10'),
(55, 3, '2015-10-01 05:01:59'),
(56, 3, '2015-10-01 03:03:38'),
(57, 2, '2015-10-21 04:24:46'),
(58, 3, '2015-10-21 04:24:59'),
(59, 3, '2015-10-21 05:32:18'),
(60, 3, '2015-10-21 08:16:48'),
(61, 3, '2015-11-16 03:38:13'),
(62, 3, '2015-11-16 04:44:48'),
(63, 3, '2015-11-16 07:22:49'),
(64, 3, '2015-11-16 11:33:22'),
(65, 3, '2015-11-18 08:20:50'),
(66, 3, '2015-11-18 09:28:02'),
(67, 3, '2015-12-16 04:13:17'),
(68, 3, '2016-01-07 04:17:42'),
(69, 2, '2016-01-07 04:22:30'),
(70, 2, '2016-01-07 05:31:15'),
(71, 2, '2016-01-07 07:36:17'),
(72, 2, '2016-01-07 08:50:10'),
(73, 2, '2016-01-07 09:57:00'),
(74, 2, '2016-01-07 10:34:39'),
(75, 2, '2016-01-07 11:26:06'),
(76, 2, '2016-01-07 11:38:10'),
(77, 5, '2016-01-07 12:02:19'),
(78, 2, '2016-01-07 12:02:52'),
(79, 2, '2016-01-07 12:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblnegara`
--

CREATE TABLE IF NOT EXISTS `tblnegara` (
  `kode_negara` int(11) NOT NULL,
  `nama_negara` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE IF NOT EXISTS `tblorder` (
  `order_id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `costumer_name` varchar(100) NOT NULL,
  `alamat_costumer` text NOT NULL,
  `telp_costumer` varchar(15) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_item`
--

CREATE TABLE IF NOT EXISTS `tblorder_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_item_temp`
--

CREATE TABLE IF NOT EXISTS `tblorder_item_temp` (
  `id_temp` int(11) NOT NULL,
  `trancode` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qty_order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblorder_item_temp`
--

INSERT INTO `tblorder_item_temp` (`id_temp`, `trancode`, `id_barang`, `id_user`, `qty_order`) VALUES
(9, 'SO/ITEM-G6Y-0625', 1, 2, 1),
(10, 'SO/ITEM-L6X-0641', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblphotokaryawan`
--

CREATE TABLE IF NOT EXISTS `tblphotokaryawan` (
  `id_photo` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `filename` varchar(1000) NOT NULL,
  `tgl_upload` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblphotokaryawan`
--

INSERT INTO `tblphotokaryawan` (`id_photo`, `id_karyawan`, `url`, `filename`, `tgl_upload`) VALUES
(1, 12, 'files/fp-asdos/2016.FAR.0322/Koala.jpg', 'Koala.jpg', '2016-01-07'),
(2, 1, 'files/fp-asdos/2016.7CN.H214/3x4.jpg', '3x4.jpg', '2016-01-07'),
(3, 13, 'files/fp-asdos/012016.885.7142/closebar.png', 'closebar.png', '2016-01-07'),
(4, 14, 'files/fp-asdos/012016.4110.2000/2013-07-19 18.26.38.jpg', '2013-07-19 18.26.38.jpg', '2016-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `tblprovinsi`
--

CREATE TABLE IF NOT EXISTS `tblprovinsi` (
  `kode_provinsi` int(11) NOT NULL,
  `nama_provinsi` varchar(50) DEFAULT NULL,
  `nama_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstok`
--

CREATE TABLE IF NOT EXISTS `tblstok` (
  `id_stok` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_stok` int(11) DEFAULT NULL,
  `satuan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsuplier`
--

CREATE TABLE IF NOT EXISTS `tblsuplier` (
  `kode_suplier` int(11) NOT NULL,
  `nama_suplier` varchar(50) DEFAULT NULL,
  `alamat` text,
  `phone` varchar(15) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsuplier`
--

INSERT INTO `tblsuplier` (`kode_suplier`, `nama_suplier`, `alamat`, `phone`, `contact_name`, `status`, `create_date`, `update_date`) VALUES
(1, 'PT Indofood', 'Jakarta Raya', '(021) 234 456', 'Robert', 1, '0000-00-00', '2015-09-30'),
(2, 'PT Wings', 'Jln. Kapitan Pattimura No 16 Tanggerang', '(021) 357', 'Frans ', 1, '2015-09-17', '0000-00-00'),
(3, 'PT Gudang Garam Tbk', 'PT. Jl. Semampir II No. 1,Kediri 64121 Jawa Timur,Indonesia Jawa Timur', '(0265) 123 456', 'Indra Gunawan, MM.', 1, '2015-09-17', '2015-09-30'),
(4, 'PT Djarum Kudus', 'Jl. A. Yani No. 28, Jawa Tengah 10260, Indonesia', '+62 291 431691', 'Sophia', 1, '2015-09-17', '0000-00-00'),
(5, 'CV Alim Rugi', 'Bandung', '021 432567', 'Robert', 1, '2015-09-30', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `id_user` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id_user`, `id_karyawan`, `username`, `password`, `no_telp`, `email`, `active`, `create_id`, `create_date`) VALUES
(2, 1, 'admin', '124ac1d7f053d9acabe3c7a7c0728b12', '', '', 1, 0, '0000-00-00'),
(3, 2, 'username', '124ac1d7f053d9acabe3c7a7c0728b12', '021123654', 'harry@gmail.com', 1, 1, '2015-09-07'),
(4, 12, 'ekomaulana', 'fcea920f7412b5da7be0cf42b8c93759', '089662345678', 'eko@gmail.com', 1, 1, '2016-01-07'),
(5, 13, 'tiawicaksono', 'e10adc3949ba59abbe56e057f20f883e', '085234678543', 'tia.wicaksono@gmail.com', 1, 1, '2016-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `tblwarehouse`
--

CREATE TABLE IF NOT EXISTS `tblwarehouse` (
  `warehouse_id` int(11) NOT NULL,
  `nama_warehouse` varchar(150) NOT NULL,
  `alamat_warehouse` text NOT NULL,
  `telepon` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `datauser`
--
DROP TABLE IF EXISTS `datauser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datauser` AS select `a`.`id_user` AS `id_user`,`b`.`id_karyawan` AS `id_karyawan`,`a`.`username` AS `username`,`a`.`password` AS `password`,`a`.`active` AS `active`,`b`.`fullname` AS `nama_karyawan`,`b`.`no_telp` AS `no_telp`,`b`.`email` AS `email`,`b`.`status` AS `status`,`b`.`id_job_title` AS `id_job_title`,`c`.`url` AS `url`,`d`.`nama_job_title` AS `nama_job_title` from (((`tbluser` `a` left join `tblkaryawan` `b` on((`a`.`id_karyawan` = `b`.`id_karyawan`))) left join `tblphotokaryawan` `c` on((`a`.`id_karyawan` = `c`.`id_karyawan`))) left join `tbljobtitle` `d` on((`b`.`id_job_title` = `d`.`id_job_title`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblalamat`
--
ALTER TABLE `tblalamat`
  ADD PRIMARY KEY (`id_alamat`), ADD KEY `fk_tblAlamat_1_idx` (`kode_pemilik`), ADD KEY `fk_tblAlamat_2_idx` (`kode_kota`), ADD KEY `fk_tblAlamat_3_idx` (`kode_provinsi`), ADD KEY `fk_tblAlamat_4_idx` (`kode_negara`);

--
-- Indexes for table `tblbarang`
--
ALTER TABLE `tblbarang`
  ADD PRIMARY KEY (`id_barang`), ADD KEY `fk_tblBarang_1_idx` (`kode_jenis`), ADD KEY `fk_tblBarang_2_idx` (`kode_suplier`);

--
-- Indexes for table `tblcurrency`
--
ALTER TABLE `tblcurrency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `tblfailed`
--
ALTER TABLE `tblfailed`
  ADD PRIMARY KEY (`id_failed`);

--
-- Indexes for table `tbljnsbarang`
--
ALTER TABLE `tbljnsbarang`
  ADD PRIMARY KEY (`kode_jenis`);

--
-- Indexes for table `tbljobtitle`
--
ALTER TABLE `tbljobtitle`
  ADD PRIMARY KEY (`id_job_title`);

--
-- Indexes for table `tblkaryawan`
--
ALTER TABLE `tblkaryawan`
  ADD PRIMARY KEY (`id_karyawan`), ADD KEY `fk_tblKaryawan_1_idx` (`id_job_title`), ADD KEY `fk_tblKaryawan_2_idx` (`kota_lahir`);

--
-- Indexes for table `tblkota`
--
ALTER TABLE `tblkota`
  ADD PRIMARY KEY (`kode_kota`);

--
-- Indexes for table `tblloglogin`
--
ALTER TABLE `tblloglogin`
  ADD PRIMARY KEY (`id_log`), ADD KEY `fk_tblLogLogin_1_idx` (`id_user`);

--
-- Indexes for table `tblnegara`
--
ALTER TABLE `tblnegara`
  ADD PRIMARY KEY (`kode_negara`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tblorder_item`
--
ALTER TABLE `tblorder_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `tblorder_item_temp`
--
ALTER TABLE `tblorder_item_temp`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indexes for table `tblphotokaryawan`
--
ALTER TABLE `tblphotokaryawan`
  ADD PRIMARY KEY (`id_photo`);

--
-- Indexes for table `tblprovinsi`
--
ALTER TABLE `tblprovinsi`
  ADD PRIMARY KEY (`kode_provinsi`);

--
-- Indexes for table `tblstok`
--
ALTER TABLE `tblstok`
  ADD PRIMARY KEY (`id_stok`), ADD KEY `fk_tblStok_1_idx` (`id_barang`);

--
-- Indexes for table `tblsuplier`
--
ALTER TABLE `tblsuplier`
  ADD PRIMARY KEY (`kode_suplier`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id_user`), ADD KEY `fk_tblUser_1_idx` (`id_karyawan`);

--
-- Indexes for table `tblwarehouse`
--
ALTER TABLE `tblwarehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblalamat`
--
ALTER TABLE `tblalamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblbarang`
--
ALTER TABLE `tblbarang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblcurrency`
--
ALTER TABLE `tblcurrency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblfailed`
--
ALTER TABLE `tblfailed`
  MODIFY `id_failed` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbljnsbarang`
--
ALTER TABLE `tbljnsbarang`
  MODIFY `kode_jenis` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbljobtitle`
--
ALTER TABLE `tbljobtitle`
  MODIFY `id_job_title` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblkaryawan`
--
ALTER TABLE `tblkaryawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tblkota`
--
ALTER TABLE `tblkota`
  MODIFY `kode_kota` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblloglogin`
--
ALTER TABLE `tblloglogin`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `tblnegara`
--
ALTER TABLE `tblnegara`
  MODIFY `kode_negara` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblorder_item`
--
ALTER TABLE `tblorder_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblorder_item_temp`
--
ALTER TABLE `tblorder_item_temp`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblphotokaryawan`
--
ALTER TABLE `tblphotokaryawan`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblprovinsi`
--
ALTER TABLE `tblprovinsi`
  MODIFY `kode_provinsi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblstok`
--
ALTER TABLE `tblstok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblsuplier`
--
ALTER TABLE `tblsuplier`
  MODIFY `kode_suplier` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblwarehouse`
--
ALTER TABLE `tblwarehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblalamat`
--
ALTER TABLE `tblalamat`
ADD CONSTRAINT `fk_tblAlamat_1` FOREIGN KEY (`kode_pemilik`) REFERENCES `tblsuplier` (`kode_suplier`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tblAlamat_2` FOREIGN KEY (`kode_kota`) REFERENCES `tblkota` (`kode_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tblAlamat_3` FOREIGN KEY (`kode_provinsi`) REFERENCES `tblprovinsi` (`kode_provinsi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tblAlamat_4` FOREIGN KEY (`kode_negara`) REFERENCES `tblnegara` (`kode_negara`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tblAlamat_5` FOREIGN KEY (`kode_pemilik`) REFERENCES `tblkaryawan` (`id_karyawan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblbarang`
--
ALTER TABLE `tblbarang`
ADD CONSTRAINT `fk_tblBarang_1` FOREIGN KEY (`kode_jenis`) REFERENCES `tbljnsbarang` (`kode_jenis`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tblBarang_2` FOREIGN KEY (`kode_suplier`) REFERENCES `tblsuplier` (`kode_suplier`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblkaryawan`
--
ALTER TABLE `tblkaryawan`
ADD CONSTRAINT `fk_tblKaryawan_1` FOREIGN KEY (`id_job_title`) REFERENCES `tbljobtitle` (`id_job_title`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tblKaryawan_2` FOREIGN KEY (`kota_lahir`) REFERENCES `tblkota` (`kode_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblloglogin`
--
ALTER TABLE `tblloglogin`
ADD CONSTRAINT `fk_tblLogLogin_1` FOREIGN KEY (`id_user`) REFERENCES `tbluser` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblstok`
--
ALTER TABLE `tblstok`
ADD CONSTRAINT `fk_tblStok_1` FOREIGN KEY (`id_barang`) REFERENCES `tblbarang` (`id_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbluser`
--
ALTER TABLE `tbluser`
ADD CONSTRAINT `fk_tblUser_1` FOREIGN KEY (`id_karyawan`) REFERENCES `tblkaryawan` (`id_karyawan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
