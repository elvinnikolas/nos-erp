-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2021 at 08:10 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noserp`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailgajians`
--

CREATE TABLE `detailgajians` (
  `KodeGaji` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeBarang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `HargaBarang` varchar(10) NOT NULL,
  `JumlahBarang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SubtotalHargaBarang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `EnkripsiKodeGaji` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gajians`
--

CREATE TABLE `gajians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `KodeGaji` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeKaryawan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SubtotalGaji` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SubtotalLemburHarian` varchar(10) NOT NULL,
  `SubtotalLemburJam` varchar(10) NOT NULL,
  `SubtotalLemburMinggu` varchar(10) NOT NULL,
  `SubtotalBonus` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SubtotalHargaBarang` varchar(10) NOT NULL,
  `TotalGaji` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TanggalGaji` date NOT NULL,
  `Status` varchar(10) NOT NULL,
  `EnkripsiKodeGaji` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `koreksigajians`
--

CREATE TABLE `koreksigajians` (
  `KodeGaji` varchar(191) NOT NULL,
  `Kekurangan` varchar(10) NOT NULL,
  `Kelebihan` varchar(10) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tambahangajians`
--

CREATE TABLE `tambahangajians` (
  `KodeGaji` varchar(191) NOT NULL,
  `Gaji` varchar(10) NOT NULL,
  `JumlahHariKerja` varchar(10) NOT NULL,
  `LemburHarian` varchar(10) NOT NULL,
  `JumlahLemburHarian` varchar(10) NOT NULL,
  `LemburJam` varchar(10) NOT NULL,
  `JumlahLemburJam` varchar(10) NOT NULL,
  `Bonus` varchar(10) NOT NULL,
  `JumlahBonus` varchar(10) NOT NULL,
  `EnkripsiKodeGaji` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gajians`
--
ALTER TABLE `gajians`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gajians`
--
ALTER TABLE `gajians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
