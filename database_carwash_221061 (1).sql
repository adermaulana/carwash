-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 08:47 AM
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
(64, 'gunjack', 'Gunjack', '12', '12', '182cda3fef93c5a311d5cdd654541133');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cucian_221061`
--

CREATE TABLE `jenis_cucian_221061` (
  `id_jenis_cucian_221061` int(1) NOT NULL,
  `jenis_cucian_221061` varchar(50) NOT NULL,
  `biaya_221061` int(10) NOT NULL,
  `kuota_221061` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jenis_cucian_221061`
--

INSERT INTO `jenis_cucian_221061` (`id_jenis_cucian_221061`, `jenis_cucian_221061`, `biaya_221061`, `kuota_221061`) VALUES
(8, 'Cuci Menyeluruh', 40000, 0),
(9, 'Cuci Ban', 10000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_221061`
--

CREATE TABLE `pendaftaran_221061` (
  `id_pendaftaran_221061` int(11) NOT NULL,
  `id_customer_221061` int(10) NOT NULL,
  `id_jenis_cucian_221061` int(1) NOT NULL,
  `tgl_pendaftaran_221061` date NOT NULL,
  `total_biaya_221061` int(10) NOT NULL,
  `status_221061` enum('Pending','Dalam Pengerjaan','Selesai','Ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pendaftaran_221061`
--

INSERT INTO `pendaftaran_221061` (`id_pendaftaran_221061`, `id_customer_221061`, `id_jenis_cucian_221061`, `tgl_pendaftaran_221061`, `total_biaya_221061`, `status_221061`) VALUES
(105, 64, 9, '2024-10-28', 10000, 'Selesai');

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
(1, 64, 8, 3, '12');

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
(46, 105, 'NOTA-20241028-105', '2024-10-28', 'Pending', 'Screenshot (5).png', NULL);

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
  MODIFY `id_customer_221061` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `jenis_cucian_221061`
--
ALTER TABLE `jenis_cucian_221061`
  MODIFY `id_jenis_cucian_221061` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pendaftaran_221061`
--
ALTER TABLE `pendaftaran_221061`
  MODIFY `id_pendaftaran_221061` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `rating_221061`
--
ALTER TABLE `rating_221061`
  MODIFY `id_rating_221061` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_221061`
--
ALTER TABLE `transaksi_221061`
  MODIFY `id_transaksi_221061` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
