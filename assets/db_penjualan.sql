-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 04:47 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kd_barang` int NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kd_barang`, `nm_barang`, `harga_beli`, `harga_jual`, `satuan`, `kategori`, `stok`) VALUES
(1, 'Intel Core i3 Gen 11', 1200000, 1500000, 'PCS', 'Chipset', 0),
(3, 'Monitor AOC 14', 900000, 110000, 'PCS', 'Monitor', 3),
(4, 'Intel Core i5 Gen 12', 1500000, 1800000, 'PCS', 'Chipset', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int NOT NULL,
  `no_faktur` varchar(100) NOT NULL,
  `nm_konsumen` varchar(100) NOT NULL,
  `kd_barang` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `harga_total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_penjualan`, `no_faktur`, `nm_konsumen`, `kd_barang`, `jumlah`, `harga_satuan`, `harga_total`) VALUES
(4, '320111545', 'Kurniawan', 3, 3, 110000, 330000),
(5, '320111545', 'Kurniawan', 1, 2, 1500000, 3000000),
(6, '320111545', 'Kurniawan', 1, 2, 1500000, 3000000),
(7, '320111545', 'Kurniawan', 4, 1, 1800000, 1800000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `status`) VALUES
(1, 'awan', 'e90679e6ebbf21e3fd1b58757a58bae4', 'SuperAdmin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `ibf_kd_barang` (`kd_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `kd_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `ibf_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `tb_barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
