-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2021 at 04:00 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-lobster`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_07_21_231737_coba', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `superadmin` tinyint(1) NOT NULL DEFAULT 0,
  `diblokir` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_bergabung` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_lengkap`, `email`, `password`, `foto`, `superadmin`, `diblokir`, `tanggal_bergabung`) VALUES
('ADM1809251', 'Muhammad Iqbal', 'miqbal.admin@email.com', '$2y$10$unsKNzWw/QYFD.dZXQtMd.gztNCpV4uHUiZXD7FsG17Kw5F7oZAS6', 'muhammad_iqbal.jpg', 1, 0, '2018-09-25 20:28:55'),
('ADM2107273', 'Dewiadmin', 'datacodingan@gmail.com', '$2y$10$BwzLZpw4uFL5iq84aROI.uZbOjU4f9uvLvmpQaisF40khYPeqyqMS', 'ADM2107273.png', 1, 0, '2021-07-27 15:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_merk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_barang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_barang` double NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `foto_barang` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `id_kategori`, `id_merk`, `deskripsi_barang`, `berat_barang`, `harga_satuan`, `stok_barang`, `foto_barang`, `tanggal_masuk`) VALUES
('BRG1810131', 'Wilson Highlight Original', 'K001', 'MRK1810131', '<p>WILSON HIGHLIGHT ORIGINAL<br />\r\nWarna: Black/Gold<br />\r\nHarga Retail: IDR 399.000<br />\r\n=============================<br />\r\nHarga kami: 340.000 -Hemat 59.000<br />\r\n=============================<br />\r\nSize: 7<br />\r\nArt #WTB068523<br />\r\n100% Original<br />\r\nMade In China<br />\r\nDesciption: Composite Leather</p>', 500, 340000, 95, 'BRG1810131.jpg', '2018-10-13 01:53:42'),
('BRG1810242', 'Mikasa MG MV 2200 Gold', 'K002', 'MRK1810242', '<p>Bola Voli Mikasa&nbsp;<br />\r\nBarang 100% Original<br />\r\nLengkap dengan Hologram, pentil, dan jaring Original</p>', 333, 590000, 98, 'BRG1810242.jpg', '2018-10-24 14:22:52'),
('BRG2107273', 'Lobster Mutiara Premium', 'KTG2107279', 'MRK2107273', '<h3>Pamulirus Ornatus</h3>', 1000, 300, 11, 'BRG2107273.jpg', '2021-07-27 15:56:08'),
('BRG2107274', 'Lobster red claw Premium', 'KTG2107275', 'MRK2107275', '<p>asdfghjk</p>', 250, 200000, 12, 'BRG2107274.jpg', '2021-07-27 15:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_pengguna`
--

CREATE TABLE `tbl_detail_pengguna` (
  `id_pengguna` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_rumah` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telepon` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_detail_pengguna`
--

INSERT INTO `tbl_detail_pengguna` (`id_pengguna`, `nama_lengkap`, `jenis_kelamin`, `alamat_rumah`, `no_telepon`) VALUES
('PGN1809201', 'Muhammad Iqbal', 'Laki - Laki', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.', '082298277709'),
('PGN2107273', 'Dewipengguna', 'Wanita', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_pesanan`
--

CREATE TABLE `tbl_detail_pesanan` (
  `id_pesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `subtotal_berat` double NOT NULL,
  `subtotal_biaya` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_detail_pesanan`
--

INSERT INTO `tbl_detail_pesanan` (`id_pesanan`, `id_barang`, `jumlah_beli`, `subtotal_berat`, `subtotal_biaya`) VALUES
('PSN1811041', 'BRG1810131', 3, 1500, 1020000),
('PSN1811041', 'BRG1810242', 2, 666, 1180000),
('PSN2107272', 'BRG2107273', 1, 1000, 300),
('PSN2107273', 'BRG2107273', 4, 4000, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `id_invoice` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pesanan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengguna` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_dibuat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`id_invoice`, `id_pesanan`, `id_pengguna`, `tanggal_dibuat`) VALUES
('INV1811171', 'PSN1811041', 'PGN1809201', '2018-11-17 19:03:30'),
('INV2107272', 'PSN2107272', 'PGN2107273', '2021-07-27 16:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
('KTG21072710', 'Lobster Kipas'),
('KTG2107275', 'Lobster Red Claw'),
('KTG2107276', 'Lobster Crayfish'),
('KTG2107277', 'Lobster Pasir'),
('KTG2107278', 'Lobster Bambu'),
('KTG2107279', 'Lobster Mutiara');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_pengguna` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `subtotal_biaya` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lupa_password`
--

CREATE TABLE `tbl_lupa_password` (
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `tanggal_dihapus` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_merk`
--

CREATE TABLE `tbl_merk` (
  `id_merk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_merk` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_merk`
--

INSERT INTO `tbl_merk` (`id_merk`, `nama_merk`) VALUES
('MRK1810131', 'Bambu'),
('MRK1810242', 'Cray Fish'),
('MRK2107273', 'Mutiara'),
('MRK2107274', 'Pasir'),
('MRK2107275', 'Red Claw'),
('MRK2107276', 'Kipas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengguna` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atas_nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_bukti` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pembayaran` tinyint(1) NOT NULL DEFAULT 0,
  `batas_pembayaran` date NOT NULL,
  `tanggal_upload` datetime DEFAULT current_timestamp(),
  `selesai` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pesanan`, `id_pengguna`, `bank`, `atas_nama`, `no_rekening`, `foto_bukti`, `status_pembayaran`, `batas_pembayaran`, `tanggal_upload`, `selesai`) VALUES
('PSN1811041', 'PGN1809201', 'Mandiri', 'Lukman Hakim', '12345678910', 'PSN1811041.jpg', 1, '2018-11-05', '2018-11-13 21:06:35', 0),
('PSN2107272', 'PGN2107273', 'BRI', 'dewi', '1234567890', 'PSN2107272.jpg', 1, '2021-07-28', '2021-07-27 16:02:52', 0),
('PSN2107273', 'PGN2107273', 'BNI', 'esdf', '123', NULL, 0, '2021-07-28', '2021-07-27 16:07:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id_pengguna` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bergabung` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id_pengguna`, `email`, `password`, `tanggal_bergabung`) VALUES
('PGN1809201', 'miqbal.pengguna@email.com', '$2y$10$s71/P0ScgkVsBzLgZq7phO7vYcBrhNJHvTlq0vTvHB/Pbk8.MFe.y', '2018-09-20 19:00:58'),
('PGN2107273', 'dewipengguna@gmail.com', '$2y$10$fcUXnkOpQPLlarmaciKvouGqyv2MoaALFjIH/3cGy760sJBTasKzi', '2021-07-27 15:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengguna` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layanan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkos_kirim` double NOT NULL,
  `total_bayar` double NOT NULL,
  `no_resi` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pesanan` tinyint(4) NOT NULL DEFAULT 0,
  `dibatalkan` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_dikirim` datetime DEFAULT NULL,
  `tanggal_diterima` datetime DEFAULT NULL,
  `tanggal_pesanan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `id_pengguna`, `nama_penerima`, `alamat_tujuan`, `no_telepon`, `keterangan`, `layanan`, `ongkos_kirim`, `total_bayar`, `no_resi`, `status_pesanan`, `dibatalkan`, `tanggal_dikirim`, `tanggal_diterima`, `tanggal_pesanan`) VALUES
('PSN1811041', 'PGN1809201', 'Muhammad Iqbal', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.', '082298277709', NULL, 'REG', 18000, 2200000, 'krirmresi123', 4, 0, '2018-11-17 20:11:08', NULL, '2018-11-04 09:27:03'),
('PSN2107272', 'PGN2107273', 'ratna', 'majalengka,sumberjaya|Kab. Bandung, Jawa Barat', '085808580858', 'di packing dengan rapih', 'OKE', 10000, 300, NULL, 1, 0, NULL, NULL, '2021-07-27 16:02:15'),
('PSN2107273', 'PGN2107273', 'fgd', 'sdfcg|Pilih Kota..., Bangka Belitung', '12345', 'we', 'OKE', 204000, 1200, NULL, 0, 0, NULL, NULL, '2021-07-27 16:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_verifikasi_akun`
--

CREATE TABLE `tbl_verifikasi_akun` (
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `tbl_admin_email_unique` (`email`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `tbl_barang_id_kategori_index` (`id_kategori`),
  ADD KEY `id_merk` (`id_merk`);

--
-- Indexes for table `tbl_detail_pengguna`
--
ALTER TABLE `tbl_detail_pengguna`
  ADD UNIQUE KEY `tbl_detail_pengguna_id_pengguna_unique` (`id_pengguna`);

--
-- Indexes for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  ADD KEY `tbl_detail_pesanan_id_barang_index` (`id_barang`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD UNIQUE KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tbl_lupa_password`
--
ALTER TABLE `tbl_lupa_password`
  ADD UNIQUE KEY `tbl_lupa_password_email_unique` (`email`);

--
-- Indexes for table `tbl_merk`
--
ALTER TABLE `tbl_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD UNIQUE KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `tbl_pengguna_email_unique` (`email`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `tbl_pesanan_id_pengguna_index` (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_barang_ibfk_2` FOREIGN KEY (`id_merk`) REFERENCES `tbl_merk` (`id_merk`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_detail_pengguna`
--
ALTER TABLE `tbl_detail_pengguna`
  ADD CONSTRAINT `tbl_detail_pengguna_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_detail_pesanan`
--
ALTER TABLE `tbl_detail_pesanan`
  ADD CONSTRAINT `tbl_detail_pesanan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_pesanan_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `tbl_pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD CONSTRAINT `tbl_keranjang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_keranjang_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `tbl_pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `tbl_pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_pembayaran_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pesanan` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD CONSTRAINT `tbl_pesanan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
