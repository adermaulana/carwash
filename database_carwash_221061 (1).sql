-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 06:25 AM
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
-- Database: `database_carwash_221061`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_221061`
--

CREATE TABLE `customer_221061` (
  `id_customer_221061` int(10) NOT NULL,
  `username_221061` varchar(20) NOT NULL,
  `nama_221061` varchar(30) NOT NULL,
  `no_hp_221061` varchar(25) NOT NULL,
  `alamat_221061` varchar(50) NOT NULL,
  `password_221061` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer_221061`
--

INSERT INTO `customer_221061` (`id_customer_221061`, `username_221061`, `nama_221061`, `no_hp_221061`, `alamat_221061`, `password_221061`) VALUES
(64, 'gunjack', 'Gunjack', '12', '12', '182cda3fef93c5a311d5cdd654541133'),
(65, 'pelanggan', 'pelanggan', '3032', 'pelanggan', '7f78f06d2d1262a0a222ca9834b15d9d'),
(66, 'pelanggan umum', 'Pelanggan Umum', '-', '-', '827ccb0eea8a706c4c34a16891f84e7b'),
(67, 'kue', 'kue', 'kue', 'kue', '640a3ae9a93298b2784ec762368c8a39'),
(68, 'ubi', 'ubi', 'ubi', 'ubi', '6c51b6f4f61c76b6811ca72fa7a6f896');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cucian_221061`
--

CREATE TABLE `jenis_cucian_221061` (
  `id_jenis_cucian_221061` int(1) NOT NULL,
  `jenis_cucian_221061` varchar(50) NOT NULL,
  `biaya_221061` int(10) NOT NULL,
  `kuota_221061` int(11) NOT NULL,
  `gambar_221061` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jenis_cucian_221061`
--

INSERT INTO `jenis_cucian_221061` (`id_jenis_cucian_221061`, `jenis_cucian_221061`, `biaya_221061`, `kuota_221061`, `gambar_221061`) VALUES
(10, 'Cuci Eksterior', 50000, 2, 'istockphoto-174781838-612x612.jpg'),
(11, 'Cuci Interior & Eksterior', 100000, 3, 'Cuci-Interior-Mobil-Surabaya-Harga-Mulai-400-Ribuan.jpg'),
(12, 'Cuci Premium', 150000, 5, 'Tampak_Seperti_Baru_Dengan_Cuci_Premium-1517981472.jpeg'),
(13, 'Detailing Eksterior', 350000, 5, 'Salon-Exterior.jpg'),
(14, 'Detailing Interior', 400000, 5, '6-Cara-Merawat-Detailing-Interior-Mobil-Agar-Awet.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_221061`
--

CREATE TABLE `pendaftaran_221061` (
  `id_pendaftaran_221061` int(11) NOT NULL,
  `id_customer_221061` int(10) NOT NULL,
  `id_jenis_cucian_221061` int(1) NOT NULL,
  `tgl_pendaftaran_221061` date NOT NULL,
  `jam_pendaftaran_221061` time NOT NULL,
  `total_biaya_221061` int(10) NOT NULL,
  `status_221061` enum('Pending','Dalam Pengerjaan','Selesai','Ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pendaftaran_221061`
--

INSERT INTO `pendaftaran_221061` (`id_pendaftaran_221061`, `id_customer_221061`, `id_jenis_cucian_221061`, `tgl_pendaftaran_221061`, `jam_pendaftaran_221061`, `total_biaya_221061`, `status_221061`) VALUES
(119, 65, 10, '2024-11-19', '12:00:00', 50000, 'Pending'),
(120, 65, 10, '2024-11-19', '13:00:00', 50000, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `rating_221061`
--

CREATE TABLE `rating_221061` (
  `id_rating_221061` int(11) NOT NULL,
  `id_customer_221061` int(11) NOT NULL,
  `id_jenis_cucian_221061` int(11) NOT NULL,
  `rating_221061` int(11) NOT NULL,
  `deskripsi_221061` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_221061`
--

INSERT INTO `rating_221061` (`id_rating_221061`, `id_customer_221061`, `id_jenis_cucian_221061`, `rating_221061`, `deskripsi_221061`) VALUES
(3, 65, 10, 5, '3');

-- --------------------------------------------------------

--
-- Table structure for table `slot_waktu_221061`
--

CREATE TABLE `slot_waktu_221061` (
  `id_slot_221061` int(11) NOT NULL,
  `jam_221061` time DEFAULT NULL,
  `status_221061` enum('Aktif','Nonaktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slot_waktu_221061`
--

INSERT INTO `slot_waktu_221061` (`id_slot_221061`, `jam_221061`, `status_221061`) VALUES
(4, '15:00:00', 'Aktif'),
(5, '16:00:00', 'Aktif'),
(6, '17:00:00', 'Aktif'),
(7, '13:00:00', 'Aktif'),
(8, '14:00:00', 'Aktif'),
(9, '12:00:00', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_221061`
--

CREATE TABLE `transaksi_221061` (
  `id_transaksi_221061` int(10) NOT NULL,
  `id_pendaftaran_221061` int(11) NOT NULL,
  `no_nota_221061` varchar(255) NOT NULL,
  `tanggal_221061` date NOT NULL,
  `status_221061` enum('Pending','Lunas','Ditolak') NOT NULL,
  `bukti_pembayaran_221061` varchar(255) DEFAULT NULL,
  `id_user_221061` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaksi_221061`
--

INSERT INTO `transaksi_221061` (`id_transaksi_221061`, `id_pendaftaran_221061`, `no_nota_221061`, `tanggal_221061`, `status_221061`, `bukti_pembayaran_221061`, `id_user_221061`) VALUES
(58, 119, 'NOTA-20241119-119', '2024-11-19', 'Pending', '', NULL),
(59, 120, 'NOTA-20241119-120', '2024-11-19', 'Pending', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_221061`
--

CREATE TABLE `user_221061` (
  `id_user_221061` int(1) NOT NULL,
  `username_221061` varchar(25) NOT NULL,
  `password_221061` varchar(250) NOT NULL,
  `name_221061` varchar(25) NOT NULL,
  `alamat_221061` varchar(50) NOT NULL,
  `hp_221061` varchar(25) NOT NULL,
  `status_221061` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_221061`
--

INSERT INTO `user_221061` (`id_user_221061`, `username_221061`, `password_221061`, `name_221061`, `alamat_221061`, `hp_221061`, `status_221061`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', '0853', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_221061`
--
ALTER TABLE `customer_221061`
  ADD PRIMARY KEY (`id_customer_221061`);

--
-- Indexes for table `jenis_cucian_221061`
--
ALTER TABLE `jenis_cucian_221061`
  ADD PRIMARY KEY (`id_jenis_cucian_221061`);

--
-- Indexes for table `pendaftaran_221061`
--
ALTER TABLE `pendaftaran_221061`
  ADD PRIMARY KEY (`id_pendaftaran_221061`),
  ADD KEY `id_customer_221061` (`id_customer_221061`),
  ADD KEY `id_jenis_cucian_221061` (`id_jenis_cucian_221061`);

--
-- Indexes for table `rating_221061`
--
ALTER TABLE `rating_221061`
  ADD PRIMARY KEY (`id_rating_221061`),
  ADD KEY `id_customer_221061` (`id_customer_221061`,`id_jenis_cucian_221061`),
  ADD KEY `id_jenis_cucian_221061` (`id_jenis_cucian_221061`);

--
-- Indexes for table `slot_waktu_221061`
--
ALTER TABLE `slot_waktu_221061`
  ADD PRIMARY KEY (`id_slot_221061`);

--
-- Indexes for table `transaksi_221061`
--
ALTER TABLE `transaksi_221061`
  ADD PRIMARY KEY (`id_transaksi_221061`),
  ADD KEY `id_pendaftaran_221061` (`id_pendaftaran_221061`,`id_user_221061`),
  ADD KEY `id_user_221061` (`id_user_221061`);

--
-- Indexes for table `user_221061`
--
ALTER TABLE `user_221061`
  ADD PRIMARY KEY (`id_user_221061`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_221061`
--
ALTER TABLE `customer_221061`
  MODIFY `id_customer_221061` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `jenis_cucian_221061`
--
ALTER TABLE `jenis_cucian_221061`
  MODIFY `id_jenis_cucian_221061` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pendaftaran_221061`
--
ALTER TABLE `pendaftaran_221061`
  MODIFY `id_pendaftaran_221061` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `rating_221061`
--
ALTER TABLE `rating_221061`
  MODIFY `id_rating_221061` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slot_waktu_221061`
--
ALTER TABLE `slot_waktu_221061`
  MODIFY `id_slot_221061` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi_221061`
--
ALTER TABLE `transaksi_221061`
  MODIFY `id_transaksi_221061` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user_221061`
--
ALTER TABLE `user_221061`
  MODIFY `id_user_221061` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran_221061`
--
ALTER TABLE `pendaftaran_221061`
  ADD CONSTRAINT `pendaftaran_221061_ibfk_1` FOREIGN KEY (`id_customer_221061`) REFERENCES `customer_221061` (`id_customer_221061`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_221061_ibfk_2` FOREIGN KEY (`id_jenis_cucian_221061`) REFERENCES `jenis_cucian_221061` (`id_jenis_cucian_221061`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_221061`
--
ALTER TABLE `rating_221061`
  ADD CONSTRAINT `rating_221061_ibfk_1` FOREIGN KEY (`id_customer_221061`) REFERENCES `customer_221061` (`id_customer_221061`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_221061_ibfk_2` FOREIGN KEY (`id_jenis_cucian_221061`) REFERENCES `jenis_cucian_221061` (`id_jenis_cucian_221061`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_221061`
--
ALTER TABLE `transaksi_221061`
  ADD CONSTRAINT `transaksi_221061_ibfk_1` FOREIGN KEY (`id_pendaftaran_221061`) REFERENCES `pendaftaran_221061` (`id_pendaftaran_221061`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_221061_ibfk_2` FOREIGN KEY (`id_user_221061`) REFERENCES `user_221061` (`id_user_221061`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
