-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2020 at 08:23 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `alamatpelanggans`
--

CREATE TABLE `alamatpelanggans` (
  `id` int(11) NOT NULL,
  `KodePelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kota` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Provinsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Negara` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Telepon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NoIndeks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alamatpelanggans`
--

INSERT INTO `alamatpelanggans` (`id`, `KodePelanggan`, `Alamat`, `Kota`, `Provinsi`, `Negara`, `Faks`, `Telepon`, `NoIndeks`, `created_at`, `updated_at`) VALUES
(1, 'PLG-001', '-', 'Surabaya', NULL, NULL, NULL, NULL, 1, '2020-07-13 04:44:49', '2020-08-06 03:32:36'),
(2, 'PLG-002', '-', 'Surabaya', NULL, NULL, NULL, NULL, 1, '2020-07-13 07:33:12', '2020-07-13 07:33:12'),
(3, 'PLG-004', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:35:15', '2020-07-14 03:35:15'),
(4, 'PLG-005', '-', 'Surabaya', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:35:53', '2020-08-06 03:37:19'),
(5, 'PLG-006', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:36:09', '2020-07-14 03:36:09'),
(6, 'PLG-007', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:36:21', '2020-07-14 03:36:21'),
(7, 'PLG-008', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:36:32', '2020-07-14 03:36:32'),
(8, 'PLG-009', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:36:53', '2020-07-14 03:36:53'),
(9, 'PLG-010', '-', 'Surabaya', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:37:03', '2020-08-06 03:31:50'),
(10, 'PLG-011', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:37:18', '2020-07-14 03:37:18'),
(11, 'PLG-012', '-', 'Surabaya', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:37:32', '2020-08-06 03:31:33'),
(12, 'PLG-013', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:37:47', '2020-07-14 03:37:47'),
(13, 'PLG-014', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:38:04', '2020-07-14 04:48:57'),
(14, 'PLG-015', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:38:24', '2020-07-14 03:38:24'),
(15, 'PLG-016', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:38:36', '2020-07-14 03:38:36'),
(16, 'PLG-017', '-', 'Pasuruan', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:38:48', '2020-08-06 03:32:21'),
(17, 'PLG-018', 'Jalan Madukoro Blok aa/bb No. 8', 'Semarang', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:39:12', '2020-08-06 03:29:42'),
(18, 'PLG-019', 'Perum Permata Gading 2 VV 4/6 Lingkar Timur', 'Sidoarjo', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:39:28', '2020-08-06 03:35:22'),
(19, 'PLG-021', '-', 'Surabaya', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:41:49', '2020-08-06 03:36:00'),
(20, 'PLG-022', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:42:14', '2020-07-14 03:42:14'),
(21, 'PLG-023', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:42:26', '2020-07-14 03:42:26'),
(22, 'PLG-024', 'Jalan Asumka No. 31', 'Jakarta', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:42:35', '2020-08-06 03:28:23'),
(23, 'PLG-025', '-', '-', NULL, NULL, NULL, NULL, 1, '2020-07-14 03:42:47', '2020-07-14 03:43:12'),
(24, 'PLG-003', 'Jalan Pangeran Jayakarta 123 No. 26/82', 'Jakarta', NULL, NULL, NULL, NULL, 1, '2020-07-17 09:37:14', '2020-08-06 03:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `alatbayarkasirs`
--

CREATE TABLE `alatbayarkasirs` (
  `KodeAlatBayarKasir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UntukPembayaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` double NOT NULL,
  `PPN` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NominalPPN` double NOT NULL,
  `Bayar` double NOT NULL,
  `Kembali` double NOT NULL,
  `Ongkir` double NOT NULL,
  `KodeJenisBayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `NomorRekening` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaBank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nomor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `KodeDriver` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaDriver` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kontak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Handphone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIK` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eventlogs`
--

CREATE TABLE `eventlogs` (
  `id` bigint(20) NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `Jam` time NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eventlogs`
--

INSERT INTO `eventlogs` (`id`, `KodeUser`, `Tanggal`, `Jam`, `Keterangan`, `Tipe`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-07-23', '15:13:54', 'Tambah user lili', 'OPN', '2020-07-23 08:13:54', '2020-07-23 08:13:54'),
(2, 'lili', '2020-07-23', '15:44:09', 'Update gudang GUD-001', 'OPN', '2020-07-23 08:44:09', '2020-07-23 08:44:09'),
(3, 'admin', '2020-07-24', '11:34:06', 'Update item ABG-047', 'OPN', '2020-07-24 04:34:06', '2020-07-24 04:34:06'),
(4, 'admin', '2020-07-24', '11:34:32', 'Tambah item ABG-322', 'OPN', '2020-07-24 04:34:32', '2020-07-24 04:34:32'),
(5, 'admin', '2020-07-24', '11:35:00', 'Tambah item ABG-323', 'OPN', '2020-07-24 04:35:00', '2020-07-24 04:35:00'),
(6, 'admin', '2020-07-24', '11:35:34', 'Update item ABG-044', 'OPN', '2020-07-24 04:35:34', '2020-07-24 04:35:34'),
(7, 'admin', '2020-07-24', '11:35:59', 'Tambah item ABG-324', 'OPN', '2020-07-24 04:35:59', '2020-07-24 04:35:59'),
(8, 'admin', '2020-07-24', '11:36:22', 'Tambah item ABG-325', 'OPN', '2020-07-24 04:36:22', '2020-07-24 04:36:22'),
(9, 'admin', '2020-07-24', '11:39:38', 'Update item ABG-046', 'OPN', '2020-07-24 04:39:38', '2020-07-24 04:39:38'),
(10, 'admin', '2020-07-24', '11:40:01', 'Tambah item ABG-326', 'OPN', '2020-07-24 04:40:01', '2020-07-24 04:40:01'),
(11, 'admin', '2020-07-24', '11:40:24', 'Tambah item ABG-327', 'OPN', '2020-07-24 04:40:24', '2020-07-24 04:40:24'),
(12, 'admin', '2020-07-24', '11:41:03', 'Update item ABG-045', 'OPN', '2020-07-24 04:41:03', '2020-07-24 04:41:03'),
(13, 'admin', '2020-07-24', '11:41:22', 'Tambah item ABG-328', 'OPN', '2020-07-24 04:41:22', '2020-07-24 04:41:22'),
(14, 'admin', '2020-07-24', '11:41:38', 'Tambah item ABG-329', 'OPN', '2020-07-24 04:41:38', '2020-07-24 04:41:38'),
(15, 'admin', '2020-07-24', '11:42:10', 'Update item ABG-048', 'OPN', '2020-07-24 04:42:10', '2020-07-24 04:42:10'),
(16, 'admin', '2020-07-24', '11:42:24', 'Tambah item ABG-330', 'OPN', '2020-07-24 04:42:24', '2020-07-24 04:42:24'),
(17, 'admin', '2020-07-24', '11:43:11', 'Tambah item ABG-331', 'OPN', '2020-07-24 04:43:11', '2020-07-24 04:43:11'),
(18, 'admin', '2020-07-24', '11:43:58', 'Update item ABG-041', 'OPN', '2020-07-24 04:43:58', '2020-07-24 04:43:58'),
(19, 'admin', '2020-07-24', '11:44:25', 'Tambah item ABG-332', 'OPN', '2020-07-24 04:44:25', '2020-07-24 04:44:25'),
(20, 'admin', '2020-07-24', '11:44:43', 'Tambah item ABG-333', 'OPN', '2020-07-24 04:44:43', '2020-07-24 04:44:43'),
(21, 'admin', '2020-07-24', '11:45:02', 'Tambah item ABG-334', 'OPN', '2020-07-24 04:45:02', '2020-07-24 04:45:02'),
(22, 'admin', '2020-07-24', '11:48:21', 'Update item ART-005', 'OPN', '2020-07-24 04:48:21', '2020-07-24 04:48:21'),
(23, 'admin', '2020-07-24', '11:49:34', 'Tambah item ART-018', 'OPN', '2020-07-24 04:49:34', '2020-07-24 04:49:34'),
(24, 'admin', '2020-07-24', '11:49:56', 'Tambah item ART-019', 'OPN', '2020-07-24 04:49:56', '2020-07-24 04:49:56'),
(25, 'admin', '2020-07-24', '11:50:15', 'Tambah item ART-020', 'OPN', '2020-07-24 04:50:15', '2020-07-24 04:50:15'),
(26, 'admin', '2020-07-24', '11:50:34', 'Tambah item ART-021', 'OPN', '2020-07-24 04:50:34', '2020-07-24 04:50:34'),
(27, 'admin', '2020-07-24', '11:50:57', 'Tambah item ART-022', 'OPN', '2020-07-24 04:50:57', '2020-07-24 04:50:57'),
(28, 'admin', '2020-07-24', '11:51:17', 'Tambah item ART-023', 'OPN', '2020-07-24 04:51:17', '2020-07-24 04:51:17'),
(29, 'admin', '2020-07-24', '11:51:34', 'Tambah item ART-024', 'OPN', '2020-07-24 04:51:34', '2020-07-24 04:51:34'),
(30, 'admin', '2020-07-24', '11:52:53', 'Tambah item ABG-335', 'OPN', '2020-07-24 04:52:53', '2020-07-24 04:52:53'),
(31, 'admin', '2020-07-24', '11:53:52', 'Update item ABG-042', 'OPN', '2020-07-24 04:53:52', '2020-07-24 04:53:52'),
(32, 'admin', '2020-07-24', '11:54:26', 'Tambah item ABG-336', 'OPN', '2020-07-24 04:54:26', '2020-07-24 04:54:26'),
(33, 'admin', '2020-07-24', '11:54:50', 'Tambah item ABG-337', 'OPN', '2020-07-24 04:54:50', '2020-07-24 04:54:50'),
(34, 'admin', '2020-07-24', '11:55:11', 'Tambah item ABG-338', 'OPN', '2020-07-24 04:55:11', '2020-07-24 04:55:11'),
(35, 'admin', '2020-07-24', '11:55:39', 'Tambah item ABG-339', 'OPN', '2020-07-24 04:55:39', '2020-07-24 04:55:39'),
(36, 'admin', '2020-07-24', '11:56:47', 'Update item ABG-040', 'OPN', '2020-07-24 04:56:47', '2020-07-24 04:56:47'),
(37, 'admin', '2020-07-24', '11:57:09', 'Tambah item ABG-340', 'OPN', '2020-07-24 04:57:09', '2020-07-24 04:57:09'),
(38, 'admin', '2020-07-24', '11:57:31', 'Tambah item ABG-341', 'OPN', '2020-07-24 04:57:31', '2020-07-24 04:57:31'),
(39, 'admin', '2020-07-24', '11:57:57', 'Tambah item ABG-342', 'OPN', '2020-07-24 04:57:57', '2020-07-24 04:57:57'),
(40, 'admin', '2020-07-24', '11:58:15', 'Tambah item ABG-343', 'OPN', '2020-07-24 04:58:15', '2020-07-24 04:58:15'),
(41, 'admin', '2020-07-24', '11:59:30', 'Update item ABG-034', 'OPN', '2020-07-24 04:59:30', '2020-07-24 04:59:30'),
(42, 'admin', '2020-07-24', '11:59:46', 'Tambah item ABG-344', 'OPN', '2020-07-24 04:59:46', '2020-07-24 04:59:46'),
(43, 'admin', '2020-07-24', '12:00:03', 'Tambah item ABG-345', 'OPN', '2020-07-24 05:00:03', '2020-07-24 05:00:03'),
(44, 'admin', '2020-07-24', '16:10:42', 'Tambah pemesanan penjualan SO-20070001', 'OPN', '2020-07-24 09:10:42', '2020-07-24 09:10:42'),
(45, 'admin', '2020-08-06', '09:22:34', 'Update supplier SUP-031', 'OPN', '2020-08-06 02:22:34', '2020-08-06 02:22:34'),
(46, 'admin', '2020-08-06', '09:25:47', 'Update supplier SUP-015', 'OPN', '2020-08-06 02:25:47', '2020-08-06 02:25:47'),
(47, 'admin', '2020-08-06', '09:37:30', 'Update supplier SUP-015', 'OPN', '2020-08-06 02:37:30', '2020-08-06 02:37:30'),
(48, 'admin', '2020-08-06', '09:39:49', 'Update supplier SUP-056', 'OPN', '2020-08-06 02:39:49', '2020-08-06 02:39:49'),
(49, 'admin', '2020-08-06', '09:41:52', 'Update supplier SUP-007', 'OPN', '2020-08-06 02:41:52', '2020-08-06 02:41:52'),
(50, 'admin', '2020-08-06', '09:43:04', 'Update supplier SUP-022', 'OPN', '2020-08-06 02:43:04', '2020-08-06 02:43:04'),
(51, 'admin', '2020-08-06', '09:43:39', 'Update supplier SUP-024', 'OPN', '2020-08-06 02:43:39', '2020-08-06 02:43:39'),
(52, 'admin', '2020-08-06', '09:45:44', 'Update supplier SUP-034', 'OPN', '2020-08-06 02:45:44', '2020-08-06 02:45:44'),
(53, 'admin', '2020-08-06', '09:47:25', 'Update supplier SUP-011', 'OPN', '2020-08-06 02:47:25', '2020-08-06 02:47:25'),
(54, 'admin', '2020-08-06', '09:48:48', 'Update supplier SUP-041', 'OPN', '2020-08-06 02:48:48', '2020-08-06 02:48:48'),
(55, 'admin', '2020-08-06', '09:50:31', 'Update supplier SUP-030', 'OPN', '2020-08-06 02:50:31', '2020-08-06 02:50:31'),
(56, 'admin', '2020-08-06', '09:51:44', 'Update supplier SUP-013', 'OPN', '2020-08-06 02:51:44', '2020-08-06 02:51:44'),
(57, 'admin', '2020-08-06', '09:54:05', 'Update supplier SUP-039', 'OPN', '2020-08-06 02:54:05', '2020-08-06 02:54:05'),
(58, 'admin', '2020-08-06', '09:55:36', 'Update supplier SUP-040', 'OPN', '2020-08-06 02:55:36', '2020-08-06 02:55:36'),
(59, 'admin', '2020-08-06', '09:57:48', 'Update supplier SUP-055', 'OPN', '2020-08-06 02:57:48', '2020-08-06 02:57:48'),
(60, 'admin', '2020-08-06', '09:58:38', 'Update supplier SUP-028', 'OPN', '2020-08-06 02:58:38', '2020-08-06 02:58:38'),
(61, 'admin', '2020-08-06', '09:59:34', 'Update supplier SUP-003', 'OPN', '2020-08-06 02:59:34', '2020-08-06 02:59:34'),
(62, 'admin', '2020-08-06', '10:01:19', 'Update supplier SUP-014', 'OPN', '2020-08-06 03:01:19', '2020-08-06 03:01:19'),
(63, 'admin', '2020-08-06', '10:05:46', 'Update supplier SUP-023', 'OPN', '2020-08-06 03:05:46', '2020-08-06 03:05:46'),
(64, 'admin', '2020-08-06', '10:07:16', 'Update supplier SUP-025', 'OPN', '2020-08-06 03:07:16', '2020-08-06 03:07:16'),
(65, 'admin', '2020-08-06', '10:12:47', 'Update supplier SUP-012', 'OPN', '2020-08-06 03:12:47', '2020-08-06 03:12:47'),
(66, 'admin', '2020-08-06', '10:13:19', 'Update supplier SUP-012', 'OPN', '2020-08-06 03:13:19', '2020-08-06 03:13:19'),
(67, 'admin', '2020-08-06', '10:19:26', 'Update supplier SUP-048', 'OPN', '2020-08-06 03:19:26', '2020-08-06 03:19:26'),
(68, 'admin', '2020-08-06', '10:19:56', 'Update pelanggan PLG-001', 'OPN', '2020-08-06 03:19:56', '2020-08-06 03:19:56'),
(69, 'admin', '2020-08-06', '10:20:20', 'Update pelanggan PLG-001', 'OPN', '2020-08-06 03:20:20', '2020-08-06 03:20:20'),
(70, 'admin', '2020-08-06', '10:23:20', 'Update pelanggan PLG-003', 'OPN', '2020-08-06 03:23:20', '2020-08-06 03:23:20'),
(71, 'admin', '2020-08-06', '10:26:07', 'Update karyawan KAR-002', 'OPN', '2020-08-06 03:26:07', '2020-08-06 03:26:07'),
(72, 'admin', '2020-08-06', '10:28:23', 'Update pelanggan PLG-024', 'OPN', '2020-08-06 03:28:23', '2020-08-06 03:28:23'),
(73, 'admin', '2020-08-06', '10:29:42', 'Update pelanggan PLG-018', 'OPN', '2020-08-06 03:29:42', '2020-08-06 03:29:42'),
(74, 'admin', '2020-08-06', '10:31:09', 'Update pelanggan PLG-019', 'OPN', '2020-08-06 03:31:09', '2020-08-06 03:31:09'),
(75, 'admin', '2020-08-06', '10:31:33', 'Update pelanggan PLG-012', 'OPN', '2020-08-06 03:31:33', '2020-08-06 03:31:33'),
(76, 'admin', '2020-08-06', '10:31:50', 'Update pelanggan PLG-010', 'OPN', '2020-08-06 03:31:50', '2020-08-06 03:31:50'),
(77, 'admin', '2020-08-06', '10:32:21', 'Update pelanggan PLG-017', 'OPN', '2020-08-06 03:32:21', '2020-08-06 03:32:21'),
(78, 'admin', '2020-08-06', '10:32:36', 'Update pelanggan PLG-001', 'OPN', '2020-08-06 03:32:36', '2020-08-06 03:32:36'),
(79, 'admin', '2020-08-06', '10:35:22', 'Update pelanggan PLG-019', 'OPN', '2020-08-06 03:35:22', '2020-08-06 03:35:22'),
(80, 'admin', '2020-08-06', '10:36:01', 'Update pelanggan PLG-021', 'OPN', '2020-08-06 03:36:01', '2020-08-06 03:36:01'),
(81, 'admin', '2020-08-06', '10:37:19', 'Update pelanggan PLG-005', 'OPN', '2020-08-06 03:37:19', '2020-08-06 03:37:19'),
(82, 'admin', '2020-08-06', '10:42:30', 'Update supplier SUP-048', 'OPN', '2020-08-06 03:42:30', '2020-08-06 03:42:30'),
(83, 'admin', '2020-08-06', '10:45:52', 'Update supplier SUP-010', 'OPN', '2020-08-06 03:45:52', '2020-08-06 03:45:52'),
(84, 'admin', '2020-08-06', '10:47:40', 'Update supplier SUP-008', 'OPN', '2020-08-06 03:47:40', '2020-08-06 03:47:40'),
(85, 'admin', '2020-08-06', '10:50:09', 'Update supplier SUP-046', 'OPN', '2020-08-06 03:50:09', '2020-08-06 03:50:09'),
(86, 'admin', '2020-08-06', '10:59:36', 'Tambah pemesanan penjualan SO-20080001', 'OPN', '2020-08-06 03:59:36', '2020-08-06 03:59:36'),
(87, 'admin', '2020-08-06', '11:03:21', 'Tambah pemesanan penjualan SO-20080002', 'OPN', '2020-08-06 04:03:21', '2020-08-06 04:03:21'),
(88, 'admin', '2020-08-06', '11:04:43', 'Tambah pemesanan penjualan SO-20080003', 'OPN', '2020-08-06 04:04:43', '2020-08-06 04:04:43'),
(89, 'admin', '2020-08-06', '11:06:18', 'Tambah pemesanan penjualan SO-20080004', 'OPN', '2020-08-06 04:06:18', '2020-08-06 04:06:18'),
(90, 'admin', '2020-08-06', '11:07:58', 'Tambah pemesanan penjualan SO-20080005', 'OPN', '2020-08-06 04:07:58', '2020-08-06 04:07:58'),
(91, 'admin', '2020-08-06', '11:09:34', 'Tambah pemesanan penjualan SO-20080006', 'OPN', '2020-08-06 04:09:34', '2020-08-06 04:09:34'),
(92, 'admin', '2020-08-06', '11:10:59', 'Tambah pemesanan penjualan SO-20080007', 'OPN', '2020-08-06 04:10:59', '2020-08-06 04:10:59'),
(93, 'admin', '2020-08-06', '11:12:30', 'Tambah pemesanan penjualan SO-20080008', 'OPN', '2020-08-06 04:12:30', '2020-08-06 04:12:30'),
(94, 'admin', '2020-08-06', '11:13:49', 'Tambah pemesanan penjualan SO-20080009', 'OPN', '2020-08-06 04:13:49', '2020-08-06 04:13:49'),
(95, 'admin', '2020-08-06', '11:15:05', 'Tambah pemesanan penjualan SO-20080010', 'OPN', '2020-08-06 04:15:05', '2020-08-06 04:15:05'),
(96, 'admin', '2020-08-06', '11:15:52', 'Tambah pemesanan penjualan SO-20080011', 'OPN', '2020-08-06 04:15:52', '2020-08-06 04:15:52'),
(97, 'admin', '2020-08-06', '11:17:04', 'Tambah pemesanan penjualan SO-20080012', 'OPN', '2020-08-06 04:17:04', '2020-08-06 04:17:04'),
(98, 'admin', '2020-08-06', '11:18:09', 'Tambah pemesanan penjualan SO-20080013', 'OPN', '2020-08-06 04:18:09', '2020-08-06 04:18:09'),
(99, 'admin', '2020-08-06', '11:18:47', 'Tambah pemesanan penjualan SO-20080014', 'OPN', '2020-08-06 04:18:47', '2020-08-06 04:18:47'),
(100, 'admin', '2020-08-06', '11:20:02', 'Tambah pemesanan penjualan SO-20080015', 'OPN', '2020-08-06 04:20:02', '2020-08-06 04:20:02'),
(101, 'admin', '2020-08-06', '11:22:45', 'Tambah pemesanan penjualan SO-20080016', 'OPN', '2020-08-06 04:22:45', '2020-08-06 04:22:45'),
(102, 'admin', '2020-08-06', '11:23:48', 'Tambah pemesanan penjualan SO-20080017', 'OPN', '2020-08-06 04:23:48', '2020-08-06 04:23:48'),
(103, 'admin', '2020-08-06', '11:26:05', 'Tambah pemesanan penjualan SO-20080018', 'OPN', '2020-08-06 04:26:05', '2020-08-06 04:26:05'),
(104, 'admin', '2020-08-06', '11:27:53', 'Tambah pemesanan penjualan SO-20080019', 'OPN', '2020-08-06 04:27:53', '2020-08-06 04:27:53'),
(105, 'admin', '2020-08-06', '11:30:31', 'Tambah pemesanan penjualan SO-20080020', 'OPN', '2020-08-06 04:30:31', '2020-08-06 04:30:31'),
(106, 'admin', '2020-08-06', '11:32:03', 'Tambah pemesanan penjualan SO-20080021', 'OPN', '2020-08-06 04:32:03', '2020-08-06 04:32:03'),
(107, 'admin', '2020-08-06', '11:33:03', 'Tambah pemesanan penjualan SO-20080022', 'OPN', '2020-08-06 04:33:03', '2020-08-06 04:33:03'),
(108, 'admin', '2020-08-06', '11:34:21', 'Tambah pemesanan penjualan SO-20080023', 'OPN', '2020-08-06 04:34:21', '2020-08-06 04:34:21'),
(109, 'admin', '2020-08-06', '11:36:21', 'Tambah pemesanan penjualan SO-20080024', 'OPN', '2020-08-06 04:36:21', '2020-08-06 04:36:21'),
(110, 'admin', '2020-08-06', '11:40:02', 'Tambah pemesanan penjualan SO-20080025', 'OPN', '2020-08-06 04:40:02', '2020-08-06 04:40:02'),
(111, 'admin', '2020-08-06', '11:45:47', 'Tambah pemesanan penjualan SO-20080026', 'OPN', '2020-08-06 04:45:47', '2020-08-06 04:45:47'),
(112, 'admin', '2020-08-06', '11:48:15', 'Tambah pemesanan penjualan SO-20080027', 'OPN', '2020-08-06 04:48:15', '2020-08-06 04:48:15'),
(113, 'admin', '2020-08-06', '11:49:28', 'Tambah pemesanan penjualan SO-20080028', 'OPN', '2020-08-06 04:49:28', '2020-08-06 04:49:28'),
(114, 'admin', '2020-08-06', '11:50:53', 'Tambah pemesanan penjualan SO-20080029', 'OPN', '2020-08-06 04:50:53', '2020-08-06 04:50:53'),
(115, 'admin', '2020-08-06', '11:53:47', 'Tambah pemesanan penjualan SO-20080030', 'OPN', '2020-08-06 04:53:47', '2020-08-06 04:53:47'),
(116, 'admin', '2020-08-06', '11:55:08', 'Tambah pemesanan penjualan SO-20080031', 'OPN', '2020-08-06 04:55:08', '2020-08-06 04:55:08'),
(117, 'admin', '2020-08-06', '11:56:12', 'Tambah pemesanan penjualan SO-20080032', 'OPN', '2020-08-06 04:56:12', '2020-08-06 04:56:12'),
(118, 'admin', '2020-08-06', '11:58:16', 'Tambah pemesanan penjualan SO-20080033', 'OPN', '2020-08-06 04:58:16', '2020-08-06 04:58:16'),
(119, 'admin', '2020-08-06', '11:58:56', 'Tambah pemesanan penjualan SO-20080034', 'OPN', '2020-08-06 04:58:56', '2020-08-06 04:58:56'),
(120, 'admin', '2020-08-06', '11:59:41', 'Tambah pemesanan penjualan SO-20080035', 'OPN', '2020-08-06 04:59:41', '2020-08-06 04:59:41'),
(121, 'admin', '2020-08-06', '13:03:44', 'Tambah pemesanan penjualan SO-20080036', 'OPN', '2020-08-06 06:03:44', '2020-08-06 06:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `hutangs`
--

CREATE TABLE `hutangs` (
  `KodeHutang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` datetime NOT NULL,
  `KodeSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeLPB` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Jumlah` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Term` double NOT NULL,
  `Koreksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kembali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `InvoiceSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TanggalInvoiceSupplier` date NOT NULL,
  `hutangcol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicehutangdetails`
--

CREATE TABLE `invoicehutangdetails` (
  `KodeHutang` int(191) NOT NULL,
  `KodeLPB` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Subtotal` double NOT NULL,
  `KodeInvoiceHutang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicehutangs`
--

CREATE TABLE `invoicehutangs` (
  `KodeInvoiceHutang` int(11) NOT NULL,
  `KodeInvoiceHutangShow` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` double DEFAULT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Term` double DEFAULT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicepiutangdetails`
--

CREATE TABLE `invoicepiutangdetails` (
  `KodePiutang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSuratJalan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Subtotal` double NOT NULL,
  `TotalReturn` double NOT NULL DEFAULT 0,
  `KodeInvoicePiutang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicepiutangs`
--

CREATE TABLE `invoicepiutangs` (
  `KodeInvoicePiutang` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodePelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NoFaktur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Term` double DEFAULT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `KodeInvoicePiutangShow` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invopnames`
--

CREATE TABLE `invopnames` (
  `Tanggal` datetime NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtyOPN` double NOT NULL,
  `qtyIN` double NOT NULL,
  `qtyOUT` double NOT NULL,
  `qtyInHand` double NOT NULL,
  `qtyOpname` double NOT NULL,
  `qtyBlc` double NOT NULL,
  `HargaRata` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itemkonversis`
--

CREATE TABLE `itemkonversis` (
  `id` int(11) NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Konversi` double NOT NULL,
  `HargaBeli` double NOT NULL,
  `HargaJual` double NOT NULL,
  `HargaGrosir` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itemkonversis`
--

INSERT INTO `itemkonversis` (`id`, `KodeItem`, `KodeSatuan`, `Konversi`, `HargaBeli`, `HargaJual`, `HargaGrosir`, `created_at`, `updated_at`) VALUES
(1, 'ABG-001', 'Pcs', 1, 0, 18000, 0, '2020-07-13 04:43:12', '2020-07-13 04:43:12'),
(2, 'ABG-001', 'Dzn', 12, 0, 216000, 0, '2020-07-13 04:43:12', '2020-07-13 04:43:12'),
(3, 'ABG-002', 'Dzn', 1, 0, 17500, 0, '2020-07-13 07:16:56', '2020-07-13 07:18:03'),
(4, 'ABG-003', 'Dzn', 1, 0, 17500, 0, '2020-07-13 07:17:51', '2020-07-13 07:17:51'),
(5, 'ABG-004', 'Dzn', 1, 0, 17500, 0, '2020-07-13 07:19:24', '2020-07-13 07:19:24'),
(6, 'ABG-004', 'Dzn', 1, 0, 0, 0, '2020-07-13 07:19:24', '2020-07-13 07:19:24'),
(7, 'ABG-005', 'Dzn', 1, 0, 17000, 0, '2020-07-13 07:20:37', '2020-07-13 07:20:37'),
(8, 'ABG-006', 'Dzn', 1, 0, 17500, 0, '2020-07-13 07:22:17', '2020-07-13 07:22:17'),
(9, 'ABG-007', 'Dzn', 1, 0, 17000, 0, '2020-07-13 07:23:03', '2020-07-13 07:23:03'),
(10, 'ABG-008', 'Dzn', 1, 0, 17500, 0, '2020-07-13 07:25:02', '2020-07-13 07:25:02'),
(11, 'ABG-009', 'Dzn', 1, 0, 17500, 0, '2020-07-13 07:25:30', '2020-07-13 07:25:30'),
(12, 'ABG-009', 'Dzn', 1, 0, 0, 0, '2020-07-13 07:25:30', '2020-07-13 07:25:30'),
(13, 'ABG-0010', 'Dzn', 1, 0, 17500, 0, '2020-07-13 07:26:23', '2020-07-13 07:26:23'),
(14, 'ABG-011', 'Dzn', 1, 0, 16750, 0, '2020-07-13 07:27:10', '2020-07-13 07:27:10'),
(15, 'ABG-012', 'Dzn', 1, 0, 16750, 0, '2020-07-13 07:27:42', '2020-07-13 07:27:42'),
(16, 'ABG-012', 'Dzn', 1, 0, 0, 0, '2020-07-13 07:27:42', '2020-07-13 07:27:42'),
(17, 'ABG-013', 'Dzn', 1, 0, 16750, 0, '2020-07-13 07:28:20', '2020-07-13 07:28:20'),
(18, 'ABG-014', 'Dzn', 1, 0, 16243, 0, '2020-07-13 07:28:57', '2020-07-13 07:30:08'),
(19, 'ABG-015', 'Dzn', 1, 0, 16750, 0, '2020-07-13 07:29:34', '2020-07-13 07:29:34'),
(20, 'ABG-016', 'Dzn', 1, 0, 16500, 0, '2020-07-13 07:31:03', '2020-07-13 07:31:03'),
(21, 'ABG-017', 'Set', 500, 0, 0, 0, '2020-07-14 02:58:59', '2020-07-14 02:58:59'),
(22, 'ABG-018', 'Pcs', 1000, 0, 0, 0, '2020-07-14 02:59:45', '2020-07-14 02:59:45'),
(23, 'ABG-019', 'Set', 750, 0, 0, 0, '2020-07-14 03:00:22', '2020-07-14 03:00:22'),
(24, 'ABG-020', 'Pcs', 250, 0, 0, 0, '2020-07-14 03:01:01', '2020-07-14 03:01:01'),
(25, 'ABG-021', 'Pcs', 250, 0, 0, 0, '2020-07-14 03:01:28', '2020-07-14 03:01:28'),
(26, 'ABG-022', 'Pcs', 500, 0, 0, 0, '2020-07-14 03:01:56', '2020-07-14 03:01:56'),
(27, 'ABG-023', 'Pcs', 500, 0, 0, 0, '2020-07-14 03:02:18', '2020-07-14 03:02:18'),
(28, 'SPR-001', 'Set', 50, 0, 0, 0, '2020-07-14 03:05:16', '2020-07-14 03:05:16'),
(29, 'ART-001', 'Pcs', 250, 0, 0, 0, '2020-07-14 03:09:35', '2020-07-14 03:09:35'),
(30, 'ART-002', 'Pcs', 250, 0, 0, 0, '2020-07-14 03:10:00', '2020-07-14 03:10:00'),
(31, 'ART-003', 'Pcs', 500, 0, 0, 0, '2020-07-14 03:10:28', '2020-07-14 03:10:28'),
(32, 'ART-004', 'Pcs', 500, 0, 0, 0, '2020-07-14 03:10:52', '2020-07-14 03:10:52'),
(33, 'SPR-002', 'Dzn', 60, 0, 0, 0, '2020-07-14 03:12:21', '2020-07-14 03:12:21'),
(34, 'ART-005', 'Dzn', 100, 0, 0, 0, '2020-07-14 03:12:50', '2020-07-24 04:48:21'),
(35, 'ART-006', 'Dzn', 1, 0, 0, 0, '2020-07-14 03:13:07', '2020-07-14 03:13:07'),
(36, 'ART-007', 'Dzn', 1, 0, 0, 0, '2020-07-14 03:13:27', '2020-07-14 03:13:27'),
(37, 'ART-008', 'Dzn', 17, 0, 0, 0, '2020-07-14 03:14:02', '2020-07-14 03:14:02'),
(38, 'ART-009', 'Dzn', 18, 0, 0, 0, '2020-07-14 03:14:33', '2020-07-14 03:14:33'),
(39, 'ART-0010', 'Dzn', 26, 0, 0, 0, '2020-07-14 03:14:55', '2020-07-14 03:14:55'),
(40, 'ABG-024', 'Pcs', 1, 0, 0, 0, '2020-07-14 03:15:21', '2020-07-14 03:15:21'),
(41, 'ABG-025', 'Pcs', 1, 0, 0, 0, '2020-07-14 03:15:42', '2020-07-14 03:15:42'),
(42, 'ABG-026', 'Set', 1, 0, 0, 0, '2020-07-14 03:16:14', '2020-07-14 03:16:14'),
(43, 'ABG-027', 'Set', 12, 0, 0, 0, '2020-07-14 03:16:35', '2020-07-14 03:16:35'),
(44, 'ABG-028', 'Set', 1, 0, 0, 0, '2020-07-14 03:16:52', '2020-07-14 03:16:52'),
(45, 'SPR-003', 'Set', 1, 0, 0, 0, '2020-07-14 03:17:20', '2020-07-14 03:17:20'),
(46, 'ART-011', 'Pcs', 30, 0, 0, 0, '2020-07-14 03:17:44', '2020-07-14 03:17:44'),
(47, 'ART-012', 'Pcs', 30, 0, 0, 0, '2020-07-14 03:18:09', '2020-07-14 03:18:09'),
(48, 'ART-013', 'Pcs', 30, 0, 0, 0, '2020-07-14 03:18:30', '2020-07-14 03:18:30'),
(49, 'ART-014', 'Pcs', 30, 0, 0, 0, '2020-07-14 03:19:10', '2020-07-14 03:19:10'),
(50, 'ART-015', 'Pcs', 30, 0, 0, 0, '2020-07-14 03:19:39', '2020-07-14 03:19:39'),
(51, 'ABG-029', 'Dzn', 1, 0, 0, 0, '2020-07-14 03:19:59', '2020-07-14 03:19:59'),
(52, 'ABG-030', 'Dzn', 1, 0, 0, 0, '2020-07-14 03:20:14', '2020-07-14 03:20:14'),
(53, 'ABG-031', 'Dzn', 1, 0, 0, 0, '2020-07-14 03:20:31', '2020-07-14 03:20:31'),
(54, 'ABG-032', 'Dzn', 1, 0, 0, 0, '2020-07-14 03:20:44', '2020-07-14 03:20:44'),
(55, 'ABG-033', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:21:06', '2020-07-14 03:21:06'),
(56, 'ABG-034', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:21:24', '2020-07-24 04:59:30'),
(57, 'ABG-035', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:21:43', '2020-07-14 03:21:43'),
(58, 'ABG-036', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:22:18', '2020-07-14 03:22:18'),
(59, 'ABG-037', 'Dzn', 36, 0, 0, 0, '2020-07-14 03:23:49', '2020-07-14 03:23:49'),
(60, 'ABG-038', 'Dzn', 36, 0, 0, 0, '2020-07-14 03:24:12', '2020-07-14 03:24:12'),
(61, 'ABG-039', 'Dzn', 36, 0, 0, 0, '2020-07-14 03:24:32', '2020-07-14 03:24:32'),
(62, 'ABG-040', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:24:56', '2020-07-24 04:56:47'),
(63, 'ABG-041', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:25:16', '2020-07-24 04:43:58'),
(64, 'ABG-042', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:25:32', '2020-07-24 04:53:52'),
(65, 'ABG-043', 'Dzn', 36, 0, 0, 0, '2020-07-14 03:25:51', '2020-07-14 03:25:51'),
(66, 'ABG-044', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:26:10', '2020-07-24 04:35:34'),
(67, 'ABG-045', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:26:27', '2020-07-24 04:41:03'),
(68, 'ABG-046', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:26:57', '2020-07-24 04:39:38'),
(69, 'ABG-047', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:27:18', '2020-07-24 04:34:06'),
(70, 'ABG-048', 'Dzn', 36, 0, 0, 0, '2020-07-14 03:27:53', '2020-07-24 04:42:10'),
(71, 'ABG-049', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:28:15', '2020-07-14 03:28:15'),
(72, 'ABG-050', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:28:32', '2020-07-14 03:28:32'),
(73, 'ABG-051', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:28:50', '2020-07-14 03:28:50'),
(74, 'ABG-052', 'Dzn', 30, 0, 0, 0, '2020-07-14 03:29:06', '2020-07-14 03:29:06'),
(75, 'ABG-053', 'Dzn', 1, 0, 0, 0, '2020-07-14 03:29:23', '2020-07-14 03:29:23'),
(76, 'ART-016', 'Dzn', 1, 0, 0, 0, '2020-07-14 03:29:39', '2020-07-14 03:29:39'),
(77, 'ABG-054', 'Dzn', 6, 0, 0, 0, '2020-07-14 03:30:04', '2020-07-14 03:30:04'),
(78, 'ART-017', 'Dzn', 2, 0, 0, 0, '2020-07-14 03:30:27', '2020-07-14 03:30:27'),
(79, 'ABG-055', 'Kg', 1, 0, 0, 0, '2020-07-14 04:56:00', '2020-07-14 04:56:00'),
(80, 'ABG-056', 'Pcs', 1, 0, 0, 0, '2020-07-14 06:07:18', '2020-07-14 06:07:18'),
(81, 'ABG-057', 'Kg', 1, 0, 0, 0, '2020-07-14 06:37:56', '2020-07-14 06:37:56'),
(82, 'ABG-058', 'Kg', 1, 0, 0, 0, '2020-07-16 01:15:27', '2020-07-16 01:15:27'),
(83, 'ABG-059', 'Kg', 1, 0, 0, 0, '2020-07-16 01:16:07', '2020-07-16 01:16:07'),
(84, 'ABG-060', 'Set', 1, 0, 0, 0, '2020-07-16 01:16:37', '2020-07-16 01:16:37'),
(85, 'ABG-061', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:17:24', '2020-07-16 01:17:24'),
(86, 'ABG-062', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:17:47', '2020-07-16 01:17:47'),
(87, 'ABG-063', 'Batang', 1, 0, 0, 0, '2020-07-16 01:19:22', '2020-07-16 01:19:22'),
(88, 'ABG-063', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:19:22', '2020-07-16 01:19:22'),
(89, 'ABG-064', 'Kg', 1, 0, 0, 0, '2020-07-16 01:20:11', '2020-07-16 01:20:11'),
(90, 'ABG-065', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:20:41', '2020-07-16 01:20:41'),
(91, 'ABG-066', 'Kg', 1, 0, 0, 0, '2020-07-16 01:21:21', '2020-07-16 01:21:21'),
(92, 'ABG-067', 'Kg', 1, 0, 0, 0, '2020-07-16 01:21:48', '2020-07-16 01:21:48'),
(93, 'ABG-068', 'Kg', 1, 0, 0, 0, '2020-07-16 01:22:05', '2020-07-16 01:22:05'),
(94, 'ABG-069', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:22:28', '2020-07-16 01:22:28'),
(95, 'ABG-070', 'Kg', 1, 0, 0, 0, '2020-07-16 01:22:59', '2020-07-16 01:22:59'),
(96, 'ABG-071', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:23:30', '2020-07-16 01:23:30'),
(97, 'ABG-072', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:23:54', '2020-07-16 01:23:54'),
(98, 'ABG-073', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:24:32', '2020-07-16 01:24:32'),
(99, 'ABG-074', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:24:57', '2020-07-16 01:24:57'),
(100, 'ABG-075', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:25:18', '2020-07-16 01:25:18'),
(101, 'ABG-076', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:25:38', '2020-07-16 01:25:38'),
(102, 'ABG-077', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:25:58', '2020-07-16 01:25:58'),
(103, 'ABG-078', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:26:24', '2020-07-16 01:26:24'),
(104, 'ABG-079', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:27:03', '2020-07-16 01:27:03'),
(105, 'ABG-080', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:27:40', '2020-07-16 01:27:40'),
(106, 'ABG-081', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:30:23', '2020-07-16 01:30:23'),
(107, 'ABG-082', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:30:53', '2020-07-16 01:30:53'),
(108, 'ABG-083', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:31:14', '2020-07-16 01:31:14'),
(109, 'ABG-084', 'Kg', 1, 0, 0, 0, '2020-07-16 01:31:32', '2020-07-16 01:31:32'),
(110, 'ABG-085', 'M3', 1, 0, 0, 0, '2020-07-16 01:34:22', '2020-07-16 01:34:22'),
(111, 'ABG-086', 'Kg', 1, 0, 0, 0, '2020-07-16 01:34:43', '2020-07-16 01:34:43'),
(112, 'ABG-087', 'Kg', 1, 0, 0, 0, '2020-07-16 01:35:07', '2020-07-16 01:35:07'),
(113, 'ABG-088', 'Kg', 1, 0, 0, 0, '2020-07-16 01:36:11', '2020-07-16 01:36:11'),
(114, 'ABG-089', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:37:10', '2020-07-16 01:37:10'),
(115, 'ABG-090', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:37:45', '2020-07-16 01:37:45'),
(116, 'ABG-091', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:38:19', '2020-07-16 01:38:19'),
(117, 'ABG-092', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:38:34', '2020-07-16 01:38:34'),
(118, 'ABG-093', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:38:54', '2020-07-16 01:38:54'),
(119, 'ABG-094', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:39:32', '2020-07-16 01:39:32'),
(120, 'ABG-095', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:39:55', '2020-07-16 01:39:55'),
(121, 'ABG-096', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:40:13', '2020-07-16 01:40:13'),
(122, 'ABG-097', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:40:33', '2020-07-16 01:40:33'),
(123, 'ABG-098', 'Pcs', 1, 0, 0, 0, '2020-07-16 01:41:03', '2020-07-16 01:41:03'),
(124, 'ABG-099', 'Kg', 1, 0, 0, 0, '2020-07-16 02:01:41', '2020-07-16 02:01:41'),
(125, 'ABG-0100', 'Drum', 1, 0, 0, 0, '2020-07-16 02:02:14', '2020-07-16 02:02:14'),
(126, 'ABG-101', 'Kg', 1, 0, 0, 0, '2020-07-16 02:02:26', '2020-07-16 02:02:26'),
(127, 'ABG-102', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:02:45', '2020-07-16 02:02:45'),
(128, 'ABG-103', 'Kg', 1, 0, 0, 0, '2020-07-16 02:03:18', '2020-07-16 02:03:18'),
(129, 'ABG-104', 'Kg', 1, 0, 0, 0, '2020-07-16 02:03:30', '2020-07-16 02:03:30'),
(130, 'ABG-105', 'Kg', 1, 0, 0, 0, '2020-07-16 02:03:57', '2020-07-16 02:03:57'),
(131, 'ABG-106', 'Kg', 1, 0, 0, 0, '2020-07-16 02:04:24', '2020-07-16 02:11:04'),
(132, 'ABG-107', 'Kg', 1, 0, 0, 0, '2020-07-16 02:04:49', '2020-07-16 02:11:41'),
(133, 'ABG-108', 'Kg', 1, 0, 0, 0, '2020-07-16 02:06:52', '2020-07-16 02:10:47'),
(134, 'ABG-109', 'Kg', 1, 0, 0, 0, '2020-07-16 02:07:30', '2020-07-16 02:12:07'),
(135, 'ABG-110', 'Kg', 1, 0, 0, 0, '2020-07-16 02:07:55', '2020-07-16 02:12:52'),
(136, 'ABG-111', 'Kg', 1, 0, 0, 0, '2020-07-16 02:08:15', '2020-07-16 02:13:36'),
(137, 'ABG-112', 'Kg', 1, 0, 0, 0, '2020-07-16 02:08:42', '2020-07-16 02:15:02'),
(138, 'ABG-113', 'Kg', 1, 0, 0, 0, '2020-07-16 02:15:35', '2020-07-16 02:15:35'),
(139, 'ABG-114', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:15:54', '2020-07-16 02:15:54'),
(140, 'ABG-115', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:16:17', '2020-07-16 02:16:17'),
(141, 'ABG-116', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:16:33', '2020-07-16 02:16:33'),
(142, 'ABG-117', 'Set', 1, 0, 0, 0, '2020-07-16 02:16:59', '2020-07-16 02:16:59'),
(143, 'ABG-118', 'M3', 1, 0, 0, 0, '2020-07-16 02:17:24', '2020-07-16 02:17:24'),
(144, 'ABG-119', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:17:56', '2020-07-16 02:17:56'),
(145, 'ABG-120', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:18:36', '2020-07-16 02:18:36'),
(146, 'ABG-121', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:19:12', '2020-07-16 02:19:12'),
(147, 'ABG-122', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:19:41', '2020-07-16 02:19:41'),
(148, 'ABG-123', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:20:01', '2020-07-16 02:20:01'),
(149, 'ABG-124', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:20:13', '2020-07-16 02:20:13'),
(150, 'ABG-125', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:20:31', '2020-07-16 02:20:31'),
(151, 'ABG-126', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:20:54', '2020-07-16 02:20:54'),
(152, 'ABG-127', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:21:52', '2020-07-16 02:25:29'),
(153, 'ABG-128', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:22:36', '2020-07-16 02:22:36'),
(154, 'ABG-129', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:22:54', '2020-07-16 02:22:54'),
(155, 'ABG-130', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:23:16', '2020-07-16 02:23:16'),
(156, 'ABG-131', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:23:30', '2020-07-16 02:23:30'),
(157, 'ABG-132', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:26:55', '2020-07-16 02:26:55'),
(158, 'ABG-133', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:27:16', '2020-07-16 02:27:16'),
(159, 'ABG-134', 'Set', 1, 0, 0, 0, '2020-07-16 02:27:36', '2020-07-16 02:27:36'),
(160, 'ABG-135', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:27:58', '2020-07-16 02:27:58'),
(161, 'ABG-136', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:28:28', '2020-07-16 02:28:28'),
(162, 'ABG-137', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:29:03', '2020-07-16 02:29:03'),
(163, 'ABG-138', 'Set', 1, 0, 0, 0, '2020-07-16 02:29:31', '2020-07-16 02:29:31'),
(164, 'ABG-139', 'Set', 1, 0, 0, 0, '2020-07-16 02:30:59', '2020-07-16 02:30:59'),
(165, 'ABG-140', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:31:15', '2020-07-16 02:31:15'),
(166, 'ABG-141', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:31:29', '2020-07-16 02:31:29'),
(167, 'ABG-142', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:31:47', '2020-07-16 02:31:47'),
(168, 'ABG-143', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:32:17', '2020-07-16 02:32:17'),
(169, 'ABG-144', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:32:32', '2020-07-16 02:32:32'),
(170, 'ABG-145', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:33:03', '2020-07-16 02:33:03'),
(171, 'ABG-146', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:33:31', '2020-07-16 02:33:31'),
(172, 'ABG-147', 'Kg', 1, 0, 0, 0, '2020-07-16 02:34:03', '2020-07-16 02:34:03'),
(173, 'ABG-148', 'Kg', 1, 0, 0, 0, '2020-07-16 02:34:28', '2020-07-16 02:34:28'),
(174, 'ABG-149', 'Kg', 1, 0, 0, 0, '2020-07-16 02:34:50', '2020-07-16 02:34:50'),
(175, 'ABG-150', 'Kg', 1, 0, 0, 0, '2020-07-16 02:35:18', '2020-07-16 02:35:18'),
(176, 'ABG-151', 'Kg', 1, 0, 0, 0, '2020-07-16 02:36:22', '2020-07-16 02:36:22'),
(177, 'ABG-152', 'Kg', 1, 0, 0, 0, '2020-07-16 02:36:46', '2020-07-16 02:36:46'),
(178, 'ABG-153', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:37:09', '2020-07-16 02:37:09'),
(179, 'ABG-154', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:37:28', '2020-07-16 02:37:28'),
(180, 'ABG-155', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:38:15', '2020-07-16 02:38:15'),
(181, 'ABG-156', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:38:57', '2020-07-16 02:38:57'),
(182, 'ABG-157', 'Kg', 1, 0, 0, 0, '2020-07-16 02:39:19', '2020-07-16 02:39:19'),
(183, 'ABG-158', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:39:43', '2020-07-16 02:39:43'),
(184, 'ABG-159', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:40:40', '2020-07-16 02:40:40'),
(185, 'ABG-160', 'Ltr', 1, 0, 0, 0, '2020-07-16 02:41:46', '2020-07-16 02:41:46'),
(186, 'ABG-161', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:42:13', '2020-07-16 02:42:13'),
(187, 'ABG-162', 'Kg', 1, 0, 0, 0, '2020-07-16 02:42:33', '2020-07-16 02:42:33'),
(188, 'ABG-163', 'Kg', 1, 0, 0, 0, '2020-07-16 02:43:35', '2020-07-16 02:43:35'),
(189, 'ABG-163', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:43:35', '2020-07-16 02:43:35'),
(190, 'ABG-164', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:44:03', '2020-07-16 02:44:03'),
(191, 'ABG-165', 'Kg', 1, 0, 0, 0, '2020-07-16 02:44:26', '2020-07-16 02:44:26'),
(192, 'ABG-166', 'Kg', 1, 0, 0, 0, '2020-07-16 02:44:52', '2020-07-16 02:44:52'),
(193, 'ABG-167', 'pack', 1, 0, 0, 0, '2020-07-16 02:50:15', '2020-07-16 02:50:15'),
(194, 'ABG-168', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:51:11', '2020-07-16 02:51:11'),
(195, 'ABG-169', 'pack', 1, 0, 0, 0, '2020-07-16 02:51:31', '2020-07-16 02:51:31'),
(196, 'ABG-170', 'pack', 1, 0, 0, 0, '2020-07-16 02:52:02', '2020-07-16 02:52:02'),
(197, 'ABG-170', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:52:02', '2020-07-16 02:52:02'),
(198, 'ABG-171', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:52:25', '2020-07-16 02:52:25'),
(199, 'ABG-172', 'Unit', 1, 0, 0, 0, '2020-07-16 02:53:34', '2020-07-16 02:53:34'),
(200, 'ABG-173', 'Unit', 1, 0, 0, 0, '2020-07-16 02:53:51', '2020-07-16 02:53:51'),
(201, 'ABG-174', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:54:26', '2020-07-16 02:54:26'),
(202, 'ABG-175', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:54:51', '2020-07-16 02:54:51'),
(203, 'ABG-176', 'Kg', 1, 0, 0, 0, '2020-07-16 02:55:07', '2020-07-16 02:55:07'),
(204, 'ABG-177', 'Kg', 1, 0, 0, 0, '2020-07-16 02:55:19', '2020-07-16 02:55:19'),
(205, 'ABG-178', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:56:50', '2020-07-16 02:56:50'),
(206, 'ABG-178', 'Kg', 1, 0, 0, 0, '2020-07-16 02:56:50', '2020-07-16 02:56:50'),
(207, 'ABG-179', 'Pcs', 1, 0, 0, 0, '2020-07-16 02:57:15', '2020-07-16 02:57:15'),
(208, 'ABG-180', 'Kg', 1, 0, 0, 0, '2020-07-16 02:57:36', '2020-07-16 02:57:36'),
(209, 'ABG-181', 'Kg', 1, 0, 0, 0, '2020-07-16 02:58:01', '2020-07-16 02:58:01'),
(210, 'ABG-182', 'Unit', 1, 0, 0, 0, '2020-07-16 02:58:20', '2020-07-16 02:58:20'),
(211, 'ABG-183', 'Kg', 1, 0, 0, 0, '2020-07-16 02:58:42', '2020-07-16 02:58:42'),
(212, 'ABG-184', 'Kg', 1, 0, 0, 0, '2020-07-16 02:59:01', '2020-07-16 02:59:01'),
(213, 'ABG-185', 'Kg', 1, 0, 0, 0, '2020-07-16 02:59:28', '2020-07-16 02:59:28'),
(214, 'ABG-186', 'Kg', 1, 0, 0, 0, '2020-07-16 02:59:53', '2020-07-16 02:59:53'),
(215, 'ABG-187', 'Kg', 1, 0, 0, 0, '2020-07-16 03:01:01', '2020-07-16 03:01:01'),
(216, 'ABG-188', 'Kg', 1, 0, 0, 0, '2020-07-16 03:01:20', '2020-07-16 03:01:20'),
(217, 'ABG-189', 'Kg', 1, 0, 0, 0, '2020-07-16 03:01:33', '2020-07-16 03:01:33'),
(218, 'ABG-190', 'Kg', 1, 0, 0, 0, '2020-07-16 03:01:52', '2020-07-16 03:01:52'),
(219, 'ABG-191', 'Kg', 1, 0, 0, 0, '2020-07-16 03:02:05', '2020-07-16 03:02:05'),
(220, 'ABG-192', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:04:33', '2020-07-16 03:05:21'),
(221, 'ABG-193', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:05:04', '2020-07-16 03:05:59'),
(222, 'ABG-194', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:06:32', '2020-07-16 03:06:32'),
(223, 'ABG-195', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:07:01', '2020-07-16 03:07:01'),
(224, 'ABG-196', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:07:23', '2020-07-16 03:08:44'),
(225, 'ABG-197', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:08:06', '2020-07-16 03:09:01'),
(226, 'ABG-198', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:11:02', '2020-07-16 03:11:02'),
(227, 'ABG-198', 'Kg', 1, 0, 0, 0, '2020-07-16 03:11:02', '2020-07-16 03:11:02'),
(228, 'ABG-199', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:12:04', '2020-07-16 03:12:04'),
(229, 'ABG-200', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:12:23', '2020-07-16 03:12:23'),
(230, 'ABG-201', 'Roll', 1, 0, 0, 0, '2020-07-16 03:12:46', '2020-07-16 03:12:46'),
(231, 'ABG-202', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:13:15', '2020-07-16 03:13:15'),
(232, 'ABG-203', 'Tab', 1, 0, 0, 0, '2020-07-16 03:13:35', '2020-07-16 03:13:35'),
(233, 'ABG-204', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:13:56', '2020-07-16 03:13:56'),
(234, 'ABG-205', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:14:22', '2020-07-16 03:14:22'),
(235, 'ABG-206', 'Kg', 1, 0, 0, 0, '2020-07-16 03:14:37', '2020-07-16 03:14:37'),
(236, 'ABG-207', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:14:55', '2020-07-16 03:14:55'),
(237, 'ABG-208', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:15:15', '2020-07-16 03:15:15'),
(238, 'ABG-209', 'Unit', 1, 0, 0, 0, '2020-07-16 03:15:34', '2020-07-16 03:15:34'),
(239, 'ABG-210', 'Kg', 1, 0, 0, 0, '2020-07-16 03:15:46', '2020-07-16 03:15:46'),
(240, 'ABG-211', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:19:04', '2020-07-16 03:19:04'),
(241, 'ABG-212', 'Unit', 1, 0, 0, 0, '2020-07-16 03:19:24', '2020-07-16 03:19:24'),
(242, 'ABG-213', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:19:50', '2020-07-16 03:19:50'),
(243, 'ABG-214', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:20:29', '2020-07-16 03:20:29'),
(244, 'ABG-215', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:20:56', '2020-07-16 03:20:56'),
(245, 'ABG-216', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:21:24', '2020-07-16 03:21:24'),
(246, 'ABG-217', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:21:55', '2020-07-16 03:21:55'),
(247, 'ABG-218', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:22:31', '2020-07-16 03:22:31'),
(248, 'ABG-219', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:22:49', '2020-07-16 03:22:49'),
(249, 'ABG-220', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:23:04', '2020-07-16 03:23:04'),
(250, 'ABG-221', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:23:37', '2020-07-16 03:23:37'),
(251, 'ABG-222', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:23:57', '2020-07-16 03:23:57'),
(252, 'ABG-223', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:24:16', '2020-07-16 03:24:16'),
(253, 'ABG-224', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:25:02', '2020-07-16 03:25:02'),
(254, 'ABG-225', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:25:37', '2020-07-16 03:25:37'),
(255, 'ABG-226', 'Ltr', 1, 0, 0, 0, '2020-07-16 03:25:50', '2020-07-16 03:25:50'),
(256, 'ABG-227', 'Ltr', 1, 0, 0, 0, '2020-07-16 03:26:10', '2020-07-16 03:26:10'),
(257, 'ABG-228', 'Kg', 1, 0, 0, 0, '2020-07-16 03:29:13', '2020-07-16 03:29:13'),
(258, 'ABG-229', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:29:46', '2020-07-16 03:29:46'),
(259, 'ABG-230', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:30:26', '2020-07-16 03:30:26'),
(260, 'ABG-231', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:30:46', '2020-07-16 03:30:46'),
(261, 'ABG-232', 'Btg', 1, 0, 0, 0, '2020-07-16 03:31:15', '2020-07-16 03:31:15'),
(262, 'ABG-232', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:31:15', '2020-07-16 03:31:15'),
(263, 'ABG-233', 'Btg', 1, 0, 0, 0, '2020-07-16 03:32:04', '2020-07-16 03:32:04'),
(264, 'ABG-234', 'Btg', 1, 0, 0, 0, '2020-07-16 03:32:20', '2020-07-16 03:32:20'),
(265, 'ABG-235', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:32:50', '2020-07-16 03:32:50'),
(266, 'ABG-236', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:33:29', '2020-07-16 03:33:29'),
(267, 'ABG-237', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:34:00', '2020-07-16 03:34:00'),
(268, 'ABG-238', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:34:22', '2020-07-16 03:34:22'),
(269, 'ABG-239', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:35:09', '2020-07-16 03:35:09'),
(270, 'ABG-240', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:35:46', '2020-07-16 03:35:46'),
(271, 'ABG-241', 'Kg', 1, 0, 0, 0, '2020-07-16 03:36:06', '2020-07-16 03:36:06'),
(272, 'ABG-242', 'Kg', 1, 0, 0, 0, '2020-07-16 03:36:23', '2020-07-16 03:36:23'),
(273, 'ABG-243', 'Kg', 1, 0, 0, 0, '2020-07-16 03:36:44', '2020-07-16 03:36:44'),
(274, 'ABG-244', 'Kg', 1, 0, 0, 0, '2020-07-16 03:37:09', '2020-07-16 03:37:09'),
(275, 'ABG-245', 'Kg', 1, 0, 0, 0, '2020-07-16 03:37:37', '2020-07-16 03:37:37'),
(276, 'ABG-246', 'Kg', 1, 0, 0, 0, '2020-07-16 03:45:06', '2020-07-16 03:45:06'),
(277, 'ABG-247', 'Kg', 1, 0, 0, 0, '2020-07-16 03:45:44', '2020-07-16 03:45:44'),
(278, 'ABG-248', 'Kg', 1, 0, 0, 0, '2020-07-16 03:46:18', '2020-07-16 03:46:18'),
(279, 'ABG-249', 'Kg', 1, 0, 0, 0, '2020-07-16 03:46:33', '2020-07-16 03:46:33'),
(280, 'ABG-250', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:47:07', '2020-07-16 03:47:07'),
(281, 'ABG-251', 'Kg', 1, 0, 0, 0, '2020-07-16 03:47:31', '2020-07-16 03:47:31'),
(282, 'ABG-252', 'Kg', 1, 0, 0, 0, '2020-07-16 03:48:01', '2020-07-16 03:48:01'),
(283, 'ABG-253', 'Kg', 1, 0, 0, 0, '2020-07-16 03:48:22', '2020-07-16 03:48:22'),
(284, 'ABG-254', 'Pcs', 1, 0, 0, 0, '2020-07-16 03:48:52', '2020-07-16 03:48:52'),
(285, 'ABG-255', 'Kg', 1, 0, 0, 0, '2020-07-16 03:49:19', '2020-07-16 03:49:19'),
(286, 'ABG-256', 'Kg', 1, 0, 0, 0, '2020-07-16 03:49:43', '2020-07-16 03:49:43'),
(287, 'ABG-257', 'Kg', 1, 0, 0, 0, '2020-07-16 03:50:02', '2020-07-16 03:50:02'),
(288, 'ABG-258', 'Kg', 1, 0, 0, 0, '2020-07-16 03:50:20', '2020-07-16 03:50:20'),
(289, 'ABG-259', 'Kg', 1, 0, 0, 0, '2020-07-16 03:51:04', '2020-07-16 03:51:04'),
(290, 'ABG-260', 'Kg', 1, 0, 0, 0, '2020-07-16 03:51:26', '2020-07-16 03:51:26'),
(291, 'ABG-261', 'Kg', 1, 0, 0, 0, '2020-07-16 03:51:44', '2020-07-16 03:53:58'),
(292, 'ABG-262', 'Kg', 1, 0, 0, 0, '2020-07-16 03:52:05', '2020-07-16 03:52:05'),
(293, 'ABG-263', 'Kg', 1, 0, 0, 0, '2020-07-16 03:56:34', '2020-07-16 03:56:34'),
(294, 'ABG-264', 'Kg', 1, 0, 0, 0, '2020-07-16 03:57:11', '2020-07-16 03:57:11'),
(295, 'ABG-265', 'Kg', 1, 0, 0, 0, '2020-07-16 03:57:35', '2020-07-16 03:57:35'),
(296, 'ABG-266', 'Kg', 1, 0, 0, 0, '2020-07-16 03:58:50', '2020-07-16 03:58:50'),
(297, 'ABG-267', 'Kg', 1, 0, 0, 0, '2020-07-16 03:59:47', '2020-07-16 03:59:47'),
(298, 'ABG-268', 'Kg', 1, 0, 0, 0, '2020-07-16 04:00:28', '2020-07-16 04:00:28'),
(299, 'ABG-269', 'Kg', 1, 0, 0, 0, '2020-07-16 04:00:54', '2020-07-16 04:00:54'),
(300, 'ABG-270', 'Kg', 1, 0, 0, 0, '2020-07-16 04:01:22', '2020-07-16 04:01:22'),
(301, 'ABG-271', 'Kg', 1, 0, 0, 0, '2020-07-16 04:01:47', '2020-07-16 04:01:47'),
(302, 'ABG-272', 'Kg', 1, 0, 0, 0, '2020-07-16 04:06:51', '2020-07-16 04:06:51'),
(303, 'ABG-273', 'Kg', 1, 0, 0, 0, '2020-07-16 04:07:15', '2020-07-16 04:07:15'),
(304, 'ABG-274', 'Kg', 1, 0, 0, 0, '2020-07-16 04:07:31', '2020-07-16 04:07:31'),
(305, 'ABG-275', 'Set', 1, 0, 0, 0, '2020-07-16 04:08:39', '2020-07-16 04:08:39'),
(306, 'ABG-276', 'Kg', 1, 0, 0, 0, '2020-07-16 04:09:03', '2020-07-16 04:09:40'),
(307, 'ABG-277', 'Kg', 1, 0, 0, 0, '2020-07-16 04:09:22', '2020-07-16 04:09:22'),
(308, 'ABG-278', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:10:06', '2020-07-16 04:10:06'),
(309, 'ABG-279', 'Roll', 1, 0, 0, 0, '2020-07-16 04:10:26', '2020-07-16 04:10:26'),
(310, 'ABG-280', 'M3', 1, 0, 0, 0, '2020-07-16 04:10:39', '2020-07-16 04:10:39'),
(311, 'ABG-281', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:11:24', '2020-07-16 04:11:24'),
(312, 'ABG-282', 'Kg', 1, 0, 0, 0, '2020-07-16 04:11:45', '2020-07-16 04:11:45'),
(313, 'ABG-283', 'Set', 1, 0, 0, 0, '2020-07-16 04:12:04', '2020-07-16 04:12:04'),
(314, 'ABG-284', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:12:24', '2020-07-16 04:12:24'),
(315, 'ABG-285', 'Kg', 1, 0, 0, 0, '2020-07-16 04:12:38', '2020-07-16 04:12:38'),
(316, 'ABG-286', 'Kg', 1, 0, 0, 0, '2020-07-16 04:12:51', '2020-07-16 04:12:51'),
(317, 'ABG-287', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:13:27', '2020-07-16 04:13:27'),
(318, 'ABG-288', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:13:48', '2020-07-16 04:13:48'),
(319, 'ABG-289', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:14:13', '2020-07-16 04:14:13'),
(320, 'ABG-290', 'Kg', 1, 0, 0, 0, '2020-07-16 04:15:02', '2020-07-16 04:15:02'),
(321, 'ABG-290', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:15:02', '2020-07-16 04:15:02'),
(322, 'ABG-291', 'Kg', 1, 0, 0, 0, '2020-07-16 04:15:17', '2020-07-16 04:15:17'),
(323, 'ABG-292', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:15:46', '2020-07-16 04:15:46'),
(324, 'ABG-293', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:16:08', '2020-07-16 04:16:08'),
(325, 'ABG-294', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:16:31', '2020-07-16 04:16:31'),
(326, 'ABG-295', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:16:47', '2020-07-16 04:16:47'),
(327, 'ABG-296', 'Roll', 1, 0, 0, 0, '2020-07-16 04:17:33', '2020-07-16 04:17:33'),
(328, 'ABG-297', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:18:01', '2020-07-16 04:18:01'),
(329, 'ABG-298', 'Kg', 1, 0, 0, 0, '2020-07-16 04:18:27', '2020-07-16 04:18:27'),
(330, 'ABG-299', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:18:46', '2020-07-16 04:18:46'),
(331, 'ABG-300', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:19:22', '2020-07-16 04:19:22'),
(332, 'ABG-301', 'Kg', 1, 0, 0, 0, '2020-07-16 04:19:52', '2020-07-16 04:19:52'),
(333, 'ABG-302', 'Kg', 1, 0, 0, 0, '2020-07-16 04:20:19', '2020-07-16 04:20:19'),
(334, 'ABG-303', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:21:08', '2020-07-16 04:21:08'),
(335, 'ABG-304', 'Unit', 1, 0, 0, 0, '2020-07-16 04:21:35', '2020-07-16 04:21:35'),
(336, 'ABG-305', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:21:51', '2020-07-16 04:21:51'),
(337, 'ABG-306', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:22:12', '2020-07-16 04:22:12'),
(338, 'ABG-307', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:22:49', '2020-07-16 04:22:49'),
(339, 'ABG-308', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:23:23', '2020-07-16 04:23:23'),
(340, 'ABG-309', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:23:46', '2020-07-16 04:25:24'),
(341, 'ABG-310', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:24:00', '2020-07-16 04:26:22'),
(342, 'ABG-311', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:27:12', '2020-07-16 04:27:12'),
(343, 'ABG-312', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:27:39', '2020-07-16 04:27:39'),
(344, 'ABG-313', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:28:01', '2020-07-16 04:28:01'),
(345, 'ABG-314', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:29:53', '2020-07-16 04:29:53'),
(346, 'ABG-315', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:31:24', '2020-07-16 04:31:24'),
(347, 'ABG-316', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:32:37', '2020-07-16 04:32:37'),
(348, 'ABG-317', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:32:58', '2020-07-16 04:32:58'),
(349, 'ABG-318', 'Kg', 1, 0, 0, 0, '2020-07-16 04:33:13', '2020-07-16 04:33:13'),
(350, 'ABG-319', 'Kg', 1, 0, 0, 0, '2020-07-16 04:33:35', '2020-07-16 04:33:35'),
(351, 'ABG-320', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:34:00', '2020-07-16 04:34:00'),
(352, 'ABG-321', 'Pcs', 1, 0, 0, 0, '2020-07-16 04:34:28', '2020-07-16 04:34:28'),
(353, 'ABG-322', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:34:32', '2020-07-24 04:34:32'),
(354, 'ABG-323', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:35:00', '2020-07-24 04:35:00'),
(355, 'ABG-324', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:35:59', '2020-07-24 04:35:59'),
(356, 'ABG-325', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:36:22', '2020-07-24 04:36:22'),
(357, 'ABG-326', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:40:01', '2020-07-24 04:40:01'),
(358, 'ABG-327', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:40:24', '2020-07-24 04:40:24'),
(359, 'ABG-328', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:41:22', '2020-07-24 04:41:22'),
(360, 'ABG-329', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:41:38', '2020-07-24 04:41:38'),
(361, 'ABG-330', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:42:24', '2020-07-24 04:42:24'),
(362, 'ABG-331', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:43:11', '2020-07-24 04:43:11'),
(363, 'ABG-332', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:44:25', '2020-07-24 04:44:25'),
(364, 'ABG-333', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:44:43', '2020-07-24 04:44:43'),
(365, 'ABG-334', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:45:02', '2020-07-24 04:45:02'),
(366, 'ART-018', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:49:34', '2020-07-24 04:49:34'),
(367, 'ART-019', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:49:56', '2020-07-24 04:49:56'),
(368, 'ART-020', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:50:15', '2020-07-24 04:50:15'),
(369, 'ART-021', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:50:34', '2020-07-24 04:50:34'),
(370, 'ART-022', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:50:57', '2020-07-24 04:50:57'),
(371, 'ART-023', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:51:17', '2020-07-24 04:51:17'),
(372, 'ART-024', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:51:34', '2020-07-24 04:51:34'),
(373, 'ABG-335', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:52:53', '2020-07-24 04:52:53'),
(374, 'ABG-336', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:54:26', '2020-07-24 04:54:26'),
(375, 'ABG-337', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:54:50', '2020-07-24 04:54:50'),
(376, 'ABG-338', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:55:11', '2020-07-24 04:55:11'),
(377, 'ABG-339', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:55:39', '2020-07-24 04:55:39'),
(378, 'ABG-340', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:57:09', '2020-07-24 04:57:09'),
(379, 'ABG-341', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:57:31', '2020-07-24 04:57:31'),
(380, 'ABG-342', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:57:57', '2020-07-24 04:57:57'),
(381, 'ABG-343', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:58:15', '2020-07-24 04:58:15'),
(382, 'ABG-344', 'Dzn', 1, 0, 0, 0, '2020-07-24 04:59:46', '2020-07-24 04:59:46'),
(383, 'ABG-345', 'Dzn', 1, 0, 0, 0, '2020-07-24 05:00:03', '2020-07-24 05:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeKategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenisitem` enum('bahanbaku','bahanjadi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`KodeItem`, `KodeKategori`, `NamaItem`, `Alias`, `jenisitem`, `Keterangan`, `Status`, `KodeUser`, `created_at`, `updated_at`) VALUES
('ABG-001', 'KLA-001', 'Grendel per', '-', 'bahanjadi', '-', 'DEL', 'admin', '2020-07-13 04:43:12', '2020-07-13 07:15:28'),
('ABG-0010', 'KLA-001', 'Grendel Per Exito', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:26:23', '2020-07-13 07:26:23'),
('ABG-002', 'KLA-001', 'Grendel Per VOC', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:16:56', '2020-07-13 07:18:03'),
('ABG-003', 'KLA-001', 'Grendel Per SKT', '-', 'bahanbaku', '-', 'DEL', 'admin', '2020-07-13 07:17:51', '2020-07-13 07:20:44'),
('ABG-004', 'KLA-001', 'Grendel Per Reyner', '-', 'bahanjadi', '-', 'DEL', 'admin', '2020-07-13 07:19:24', '2020-07-13 07:20:54'),
('ABG-005', 'KLA-001', 'Grendel Per FRT', '-', 'bahanbaku', '-', 'DEL', 'admin', '2020-07-13 07:20:37', '2020-07-13 07:22:36'),
('ABG-006', 'KLA-001', 'Grendel Per Reyner', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:22:16', '2020-07-13 07:22:16'),
('ABG-007', 'KLA-001', 'Grendel Per FRT', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:23:03', '2020-07-13 07:23:03'),
('ABG-008', 'KLA-001', 'Grendel Per SKT', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:25:02', '2020-07-13 07:25:02'),
('ABG-009', 'KLA-001', 'Grendel Per Exito', '-', 'bahanjadi', '-', 'DEL', 'admin', '2020-07-13 07:25:30', '2020-07-13 07:25:43'),
('ABG-0100', 'KLA-001', 'Caltex KIXX drum CI-4 15W/40', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:02:14', '2020-07-16 02:02:14'),
('ABG-011', 'KLA-001', 'Grendel Overval VOC', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:27:10', '2020-07-13 07:27:10'),
('ABG-012', 'KLA-001', 'Grendel Overval HONA', '-', 'bahanjadi', '-', 'DEL', 'admin', '2020-07-13 07:27:42', '2020-07-13 07:28:29'),
('ABG-013', 'KLA-001', 'Grendel Overval SKT', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:28:20', '2020-07-13 07:28:20'),
('ABG-014', 'KLA-001', 'Grendel Overval HONA', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:28:57', '2020-07-13 07:30:08'),
('ABG-015', 'KLA-001', 'Grendel Overval FRT', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:29:34', '2020-07-13 07:29:34'),
('ABG-016', 'KLA-001', 'Grendel Nanas ECT', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-13 07:31:03', '2020-07-13 07:31:03'),
('ABG-017', 'KLA-001', 'Metal Post + baut', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 02:58:59', '2020-07-14 02:58:59'),
('ABG-018', 'KLA-001', 'Connecting', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 02:59:45', '2020-07-14 02:59:45'),
('ABG-019', 'KLA-001', 'Metal Post Kecil + Baut', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:00:22', '2020-07-14 03:00:22'),
('ABG-020', 'KLA-001', 'Bed Fitting L', '-', 'bahanjadi', '-', 'DEL', 'admin', '2020-07-14 03:01:01', '2020-07-14 03:07:27'),
('ABG-021', 'KLA-001', 'Bed Fitting R', '-', 'bahanjadi', '-', 'DEL', 'admin', '2020-07-14 03:01:28', '2020-07-14 03:07:56'),
('ABG-022', 'KLA-001', 'Bed Fitting Kecil L', '-', 'bahanjadi', '-', 'DEL', 'admin', '2020-07-14 03:01:56', '2020-07-14 03:08:06'),
('ABG-023', 'KLA-001', 'Bed Fitting Kecil R', '-', 'bahanjadi', '-', 'DEL', 'admin', '2020-07-14 03:02:18', '2020-07-14 03:08:14'),
('ABG-024', 'KLA-001', 'Tutup Klep CB100', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:15:21', '2020-07-14 03:15:21'),
('ABG-025', 'KLA-001', 'Tutup Klep C70', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:15:41', '2020-07-14 03:15:41'),
('ABG-026', 'KLA-001', 'Reclining Ver Keong', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:16:13', '2020-07-14 03:16:13'),
('ABG-027', 'KLA-001', 'Reclining', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:16:35', '2020-07-14 03:16:35'),
('ABG-028', 'KLA-001', 'Lipatan Kijang', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:16:52', '2020-07-14 03:16:52'),
('ABG-029', 'KLA-001', 'Hamock Spring Jumbo', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:19:59', '2020-07-14 03:19:59'),
('ABG-030', 'KLA-001', 'Hamock Spring Double', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:20:14', '2020-07-14 03:20:14'),
('ABG-031', 'KLA-001', 'Hamock Spring 3', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:20:31', '2020-07-14 03:20:31'),
('ABG-032', 'KLA-001', 'Hamock Spring 5', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:20:44', '2020-07-14 03:20:44'),
('ABG-033', 'KLA-001', 'Hamock Spring Double Jumbo', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:21:06', '2020-07-14 03:21:06'),
('ABG-034', 'KLA-001', 'Tower Bolt ECT GOLD', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:21:24', '2020-07-24 04:59:30'),
('ABG-035', 'KLA-001', 'Tower Bolt 3\" ECT', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:21:43', '2020-07-14 03:21:43'),
('ABG-036', 'KLA-001', 'Tang Potong Keramik FERZA', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:22:18', '2020-07-14 03:22:18'),
('ABG-037', 'KLA-001', 'Grendel OCP EVA', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:23:49', '2020-07-14 03:23:49'),
('ABG-038', 'KLA-001', 'Grendel OCP VOC', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:24:12', '2020-07-14 03:24:12'),
('ABG-039', 'KLA-001', 'Grendel OCP Reyner', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:24:32', '2020-07-14 03:24:32'),
('ABG-040', 'KLA-001', 'Slide Action Towerbolt VOC GOLD', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:24:56', '2020-07-24 04:56:47'),
('ABG-041', 'KLA-001', 'Slide Action Towerbolt HONA Gold', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:25:16', '2020-07-24 04:43:58'),
('ABG-042', 'KLA-001', 'Slide Action Towerbolt SKT GOLD', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:25:32', '2020-07-24 04:53:52'),
('ABG-043', 'KLA-001', 'Slide Action Towerbolt FRT', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:25:51', '2020-07-14 03:25:51'),
('ABG-044', 'KLA-001', 'Tower Bolt SKT Gold', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:26:10', '2020-07-24 04:35:34'),
('ABG-045', 'KLA-001', 'Tower Bolt VOC Gold', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:26:27', '2020-07-24 04:41:03'),
('ABG-046', 'KLA-001', 'Tower Bolt Reyner Gold', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:26:57', '2020-07-24 04:39:38'),
('ABG-047', 'KLA-001', 'Tower Bolt Exito Gold', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:27:18', '2020-07-24 04:34:06'),
('ABG-048', 'KLA-001', 'Tower Bolt FRT Gold', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:27:53', '2020-07-24 04:42:10'),
('ABG-049', 'KLA-001', 'Tower Bolt SKT 3\"', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:28:15', '2020-07-14 03:28:15'),
('ABG-050', 'KLA-001', 'Lamskar ATC', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:28:32', '2020-07-14 03:28:32'),
('ABG-051', 'KLA-001', 'Lamskar VOC', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:28:50', '2020-07-14 03:28:50'),
('ABG-052', 'KLA-001', 'Lamskar NSK', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:29:06', '2020-07-14 03:29:06'),
('ABG-053', 'KLA-001', 'Sring Knife', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:29:23', '2020-07-14 03:29:23'),
('ABG-054', 'KLA-001', 'Ultra Grass', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:30:04', '2020-07-14 03:30:04'),
('ABG-055', 'KLA-001', 'Besi Tua', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 04:56:00', '2020-07-14 04:56:00'),
('ABG-056', 'KLA-001', 'Tap JF 12 x 1 1/2', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 06:07:18', '2020-07-14 06:07:18'),
('ABG-057', 'KLA-001', 'Plat Besi Afalan', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 06:37:56', '2020-07-14 06:37:56'),
('ABG-058', 'KLA-001', 'ABS 750 SW', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:15:27', '2020-07-16 01:15:27'),
('ABG-059', 'KLA-001', 'ABS Gading', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:16:07', '2020-07-16 01:16:07'),
('ABG-060', 'KLA-001', 'Alat Potong Kawat dan Baut', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:16:37', '2020-07-16 01:16:37'),
('ABG-061', 'KLA-001', 'Alko Ca 6.00 L 3/8/1200', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:17:24', '2020-07-16 01:17:24'),
('ABG-062', 'KLA-001', 'AS 14mm', '-', 'bahanbaku', '-', 'DEL', 'admin', '2020-07-16 01:17:47', '2020-07-16 01:18:52'),
('ABG-063', 'KLA-001', 'AS 14mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:19:22', '2020-07-16 01:19:22'),
('ABG-064', 'KLA-001', 'AS Bubut Kerekan', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:20:11', '2020-07-16 01:20:11'),
('ABG-065', 'KLA-001', 'AS Drat 3/8', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:20:41', '2020-07-16 01:20:41'),
('ABG-066', 'KLA-001', 'AS Fross', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:21:21', '2020-07-16 01:21:21'),
('ABG-067', 'KLA-001', 'AS Kerekan', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:21:48', '2020-07-16 01:21:48'),
('ABG-068', 'KLA-001', 'AS Overall', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:22:05', '2020-07-16 01:22:05'),
('ABG-069', 'KLA-001', 'AS Rehard Chrome', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:22:28', '2020-07-16 01:22:28'),
('ABG-070', 'KLA-001', 'AS SKT', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:22:58', '2020-07-16 01:22:58'),
('ABG-071', 'KLA-001', 'Bar Feeder Set', '-', 'bahanbaku', 'Pipa', 'OPN', 'admin', '2020-07-16 01:23:30', '2020-07-16 01:23:30'),
('ABG-072', 'KLA-001', 'Baut Seng 1/4 x 2', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:23:54', '2020-07-16 01:23:54'),
('ABG-073', 'KLA-001', 'Baut L 3/8 x 1 1/2', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:24:32', '2020-07-16 01:24:32'),
('ABG-074', 'KLA-001', 'Baut L 1/2 x3', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:24:57', '2020-07-16 01:24:57'),
('ABG-075', 'KLA-001', 'Baut L 1/4 x 3/4', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:25:18', '2020-07-16 01:25:18'),
('ABG-076', 'KLA-001', 'Baut L 5/16 x 1', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:25:38', '2020-07-16 01:25:38'),
('ABG-077', 'KLA-001', 'Baut L 5/16 x 1 1/2', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:25:58', '2020-07-16 01:25:58'),
('ABG-078', 'KLA-001', 'Baut L 5/16 x 2 1/2', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:26:24', '2020-07-16 01:26:24'),
('ABG-079', 'KLA-001', 'Baut L 5/16 x 3/4', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:27:03', '2020-07-16 01:27:03'),
('ABG-080', 'KLA-001', 'Baut L 5/16 x 2', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:27:40', '2020-07-16 01:27:40'),
('ABG-081', 'KLA-001', 'Baut Pisau Potong', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:30:23', '2020-07-16 01:30:23'),
('ABG-082', 'KLA-001', 'Betel Widia C 105/C 120', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:30:53', '2020-07-16 01:30:53'),
('ABG-083', 'KLA-001', 'Betel Widia C 107', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:31:14', '2020-07-16 01:31:14'),
('ABG-084', 'KLA-001', 'Betfitting', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:31:32', '2020-07-16 01:31:32'),
('ABG-085', 'KLA-001', 'Beotonmix', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:34:22', '2020-07-16 01:34:22'),
('ABG-086', 'KLA-001', 'BFF 160/709/KS 3', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:34:43', '2020-07-16 01:34:43'),
('ABG-087', 'KLA-001', 'BFF 160/8992/KS 10', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:35:07', '2020-07-16 01:35:07'),
('ABG-088', 'KLA-001', 'BFF 160/1103/K 19', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:36:11', '2020-07-16 01:36:11'),
('ABG-089', 'KLA-001', 'Box ABS 125 x 175 x 100T - 1217/10TenT', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:37:10', '2020-07-16 01:37:10'),
('ABG-090', 'KLA-001', 'Box ABS 150 x 200 x 100T - 1520/10TenT', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:37:45', '2020-07-16 01:37:45'),
('ABG-091', 'KLA-001', 'Box ABS 150 x 200 x 130T - 1520/13TenT', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:38:19', '2020-07-16 01:38:19'),
('ABG-092', 'KLA-001', 'Box Catrol', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:38:34', '2020-07-16 01:38:34'),
('ABG-093', 'KLA-001', 'Box Pluit Polos', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:38:54', '2020-07-16 01:38:54'),
('ABG-094', 'KLA-001', 'Box Tower Bolt Reyner', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:39:32', '2020-07-16 01:39:32'),
('ABG-095', 'KLA-001', 'Box Tower Bolt SKT', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:39:55', '2020-07-16 01:39:55'),
('ABG-096', 'KLA-001', 'Box Tower Bolt VOC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:40:13', '2020-07-16 01:40:13'),
('ABG-097', 'KLA-001', 'Box Tower Bolt Exito', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:40:33', '2020-07-16 01:40:33'),
('ABG-098', 'KLA-001', 'Box Tower Bolt FRT', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 01:41:03', '2020-07-16 01:41:03'),
('ABG-099', 'KLA-001', 'Brown Metalik', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:01:41', '2020-07-16 02:01:41'),
('ABG-101', 'KLA-001', 'Cantolan Hanger', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:02:26', '2020-07-16 02:02:26'),
('ABG-102', 'KLA-001', 'Cascade Universal', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:02:45', '2020-07-16 02:02:45'),
('ABG-103', 'KLA-001', 'Cigweld Kawat Las MIQ 0.8 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:03:18', '2020-07-16 02:03:18'),
('ABG-104', 'KLA-001', 'Clener', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:03:30', '2020-07-16 02:03:30'),
('ABG-105', 'KLA-001', 'Coil Sliting Galvanil 0.7 x 65 x 11 pt', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:03:57', '2020-07-16 02:03:57'),
('ABG-106', 'KLA-001', 'Coil Slitting Galvanil 0.60 x 65 x C', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:04:24', '2020-07-16 02:11:04'),
('ABG-107', 'KLA-001', 'Coil Slitting Galvanil 0.60 x 78 x C', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:04:49', '2020-07-16 02:11:41'),
('ABG-108', 'KLA-001', 'Coil Slitting Galvanil 0.70 x 65 x 17 Pita', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:06:52', '2020-07-16 02:10:47'),
('ABG-109', 'KLA-001', 'Coil Slitting Galvanil 0.70 x 65 x C', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:07:30', '2020-07-16 02:12:07'),
('ABG-110', 'KLA-001', 'Coil Slitting Galvanil 0.70 x 65 x 2 Pita', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:07:55', '2020-07-16 02:12:52'),
('ABG-111', 'KLA-001', 'Coil Slitting Galvanil 0.70 x 65 x 20 Pita', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:08:15', '2020-07-16 02:13:36'),
('ABG-112', 'KLA-001', 'Coil Slitting Galvanil 0.70 x 78 x 5 Pita', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:08:42', '2020-07-16 02:15:02'),
('ABG-113', 'KLA-001', 'Coil Slitting Galvanil 0.70 x 78 x C', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:15:35', '2020-07-16 02:15:35'),
('ABG-114', 'KLA-001', 'Coil Spring SR 25-80', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:15:54', '2020-07-16 02:15:54'),
('ABG-115', 'KLA-001', 'Coil Spring SR 26-50', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:16:17', '2020-07-16 02:16:17'),
('ABG-116', 'KLA-001', 'Collet 7.5mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:16:33', '2020-07-16 02:16:33'),
('ABG-117', 'KLA-001', 'Complete Seal Slinder MVO 31/6', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:16:59', '2020-07-16 02:16:59'),
('ABG-118', 'KLA-001', 'Concrete Pump', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:17:24', '2020-07-16 02:17:24'),
('ABG-119', 'KLA-001', 'Contactor LC 1 D 09 220 volt Schneider', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:17:56', '2020-07-16 02:17:56'),
('ABG-120', 'KLA-001', 'Contactor SN-20/380 volt Mitsubishi', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:18:36', '2020-07-16 02:18:36'),
('ABG-121', 'KLA-001', 'Contactor Tesys LC 1 D 09 (AC) Schneider', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:19:12', '2020-07-16 02:19:12'),
('ABG-122', 'KLA-001', 'Contactor Tesys LC 1 D 12', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:19:41', '2020-07-16 02:19:41'),
('ABG-123', 'KLA-001', 'Coupling Clow Dia 40 21.6 x 30', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:20:01', '2020-07-16 02:20:01'),
('ABG-124', 'KLA-001', 'Coupling Ring', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:20:13', '2020-07-16 02:20:13'),
('ABG-125', 'KLA-001', 'Dies Set 50 x 37.9 x 37.6', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:20:31', '2020-07-16 02:20:31'),
('ABG-126', 'KLA-001', 'Dies Slot Grendel 9.45 x 22 B5 x31', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:20:54', '2020-07-16 02:20:54'),
('ABG-127', 'KLA-001', 'Dos Grendel Exito', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:21:52', '2020-07-16 02:25:29'),
('ABG-128', 'KLA-001', 'Dos FRT Brown', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:22:36', '2020-07-16 02:22:36'),
('ABG-129', 'KLA-001', 'Dos FRT Gold', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:22:54', '2020-07-16 02:22:54'),
('ABG-130', 'KLA-001', 'Dos Grendel Brown', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:23:16', '2020-07-16 02:23:16'),
('ABG-131', 'KLA-001', 'Dos Grendel VOC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:23:30', '2020-07-16 02:23:30'),
('ABG-132', 'KLA-001', 'Dos Grendel Gold', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:26:55', '2020-07-16 02:26:55'),
('ABG-133', 'KLA-001', 'Dos Grendel Silver', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:27:16', '2020-07-16 02:27:16'),
('ABG-134', 'KLA-001', 'Dos Grendel Reyner Biru', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:27:36', '2020-07-16 02:27:36'),
('ABG-135', 'KLA-001', 'Dos Grendel SKT', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:27:58', '2020-07-16 02:27:58'),
('ABG-136', 'KLA-001', 'Dos Luar Kerekan Sumur ECO hijau Hioshi', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:28:28', '2020-07-16 02:28:28'),
('ABG-137', 'KLA-001', 'Dos Luar Kerekan Sumur Laker Merah Hioshi', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:29:03', '2020-07-16 02:29:03'),
('ABG-138', 'KLA-001', 'Dos Pluit Acme Lengkap', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:29:31', '2020-07-16 02:29:31'),
('ABG-139', 'KLA-001', 'Dos VOC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:30:58', '2020-07-16 02:30:58'),
('ABG-140', 'KLA-001', 'Dos VOC Bottom', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:31:15', '2020-07-16 02:31:15'),
('ABG-141', 'KLA-001', 'Dos VOC Merah', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:31:29', '2020-07-16 02:31:29'),
('ABG-142', 'KLA-001', 'Dos VOC Top', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:31:47', '2020-07-16 02:31:47'),
('ABG-143', 'KLA-001', 'Enjector Pin Straight EPD 5 x 200nn', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:32:16', '2020-07-16 02:32:16'),
('ABG-144', 'KLA-001', 'Enjector Pin Straight EPD 6 x 200nn', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:32:32', '2020-07-16 02:32:32'),
('ABG-145', 'KLA-001', 'Enjector Pins EPD 6.5 x 150', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:33:03', '2020-07-16 02:33:03'),
('ABG-146', 'KLA-001', 'Enjector Pins Straight EPD dia 6.5 x 100 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:33:31', '2020-07-16 02:33:31'),
('ABG-147', 'KLA-001', 'FF 160 / 5921 /K1', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:34:03', '2020-07-16 02:34:03'),
('ABG-148', 'KLA-001', 'FF 160 / 6018 /K4', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:34:28', '2020-07-16 02:34:28'),
('ABG-149', 'KLA-001', 'FF 160 / 6903 /K1', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:34:50', '2020-07-16 02:34:50'),
('ABG-150', 'KLA-001', 'FF 160 / 709 /KS 3', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:35:18', '2020-07-16 02:35:18'),
('ABG-151', 'KLA-001', 'FF 160 / 8992 / KS 10', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:36:22', '2020-07-16 02:36:22'),
('ABG-152', 'KLA-001', 'FF 160 / 4911 /K9', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:36:46', '2020-07-16 02:36:46'),
('ABG-153', 'KLA-001', 'Filter Masker RC 203', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:37:09', '2020-07-16 02:37:09'),
('ABG-154', 'KLA-001', 'Filter Spray Booth', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:37:28', '2020-07-16 02:37:28'),
('ABG-155', 'KLA-001', 'Filter Udara 21214', '-', 'bahanbaku', 'untuk SprayBooth', 'OPN', 'admin', '2020-07-16 02:38:15', '2020-07-16 02:38:15'),
('ABG-156', 'KLA-001', 'Finished Dies W 106 dia 7.5 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:38:57', '2020-07-16 02:38:57'),
('ABG-157', 'KLA-001', 'Gold Dragon', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:39:19', '2020-07-16 02:39:19'),
('ABG-158', 'KLA-001', 'Gotri 5/16', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:39:43', '2020-07-16 02:39:43'),
('ABG-159', 'KLA-001', 'Grinding Wheel', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:40:40', '2020-07-16 02:40:40'),
('ABG-160', 'KLA-001', 'Hand Sanitizer', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:41:46', '2020-07-16 02:41:46'),
('ABG-161', 'KLA-001', 'HB/N M 8 x 50 K12', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:42:13', '2020-07-16 02:42:13'),
('ABG-162', 'KLA-001', 'HB/O M 8 x 20', '-', 'bahanbaku', '-', 'DEL', 'admin', '2020-07-16 02:42:33', '2020-07-16 02:43:12'),
('ABG-163', 'KLA-001', 'HB/O M 8 x 20', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:43:35', '2020-07-16 02:43:35'),
('ABG-164', 'KLA-001', 'Hex Collet C-9 Dia 3.5', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:44:03', '2020-07-16 02:44:03'),
('ABG-165', 'KLA-001', 'Hilub - CL 105 S/ISP', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:44:26', '2020-07-16 02:44:26'),
('ABG-166', 'KLA-001', 'HLW Bronze 13/4\" x 1\"', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:44:52', '2020-07-16 02:44:52'),
('ABG-167', 'KLA-001', 'Isi Staples', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:50:15', '2020-07-16 02:50:15'),
('ABG-168', 'KLA-001', 'Isi Staples Etona', '-', 'bahanbaku', '-', 'DEL', 'admin', '2020-07-16 02:51:11', '2020-07-16 02:51:45'),
('ABG-169', 'KLA-001', 'Isi Staples Greatwall', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:51:31', '2020-07-16 02:51:31'),
('ABG-170', 'KLA-001', 'Isi Staples Etona', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:52:02', '2020-07-16 02:52:02'),
('ABG-171', 'KLA-001', 'Iwara Kaca las Hitam no 12', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:52:25', '2020-07-16 02:52:25'),
('ABG-172', 'KLA-001', 'Jasa Service Mesin Spraygun', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:53:34', '2020-07-16 02:53:34'),
('ABG-173', 'KLA-001', 'Jasa Service Mesin Spraygun Wagner', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:53:51', '2020-07-16 02:53:51'),
('ABG-174', 'KLA-001', 'JCK Betel Bubut Bulat 8 x 100 mm /4\"', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:54:26', '2020-07-16 02:54:26'),
('ABG-175', 'KLA-001', 'Katana Grease Black Pail', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:54:51', '2020-07-16 02:54:51'),
('ABG-176', 'KLA-001', 'Kawat 4 ml', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:55:06', '2020-07-16 02:55:06'),
('ABG-177', 'KLA-001', 'Kawat 7.5 ml', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:55:19', '2020-07-16 02:55:19'),
('ABG-178', 'KLA-001', 'Kawat Las MIG 0.8 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:56:50', '2020-07-16 02:56:50'),
('ABG-179', 'KLA-001', 'Kawat Las NSN 312 3.2mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:57:15', '2020-07-16 02:57:15'),
('ABG-180', 'KLA-001', 'Kawat Las RB-26 2.6mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:57:36', '2020-07-16 02:57:36'),
('ABG-181', 'KLA-001', 'Kawat Las RB 26 3.2mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:58:01', '2020-07-16 02:58:01'),
('ABG-182', 'KLA-001', 'Kawat Treker kaki 2 6', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:58:20', '2020-07-16 02:58:20'),
('ABG-183', 'KLA-001', 'Kelling 3.5 x 19.5 T 1 L 5.8', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:58:42', '2020-07-16 02:58:42'),
('ABG-184', 'KLA-001', 'Kelling 6.9 x 115 F', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:59:01', '2020-07-16 02:59:01'),
('ABG-185', 'KLA-001', 'Kelling 9.8 x 38 F', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:59:28', '2020-07-16 02:59:28'),
('ABG-186', 'KLA-001', 'Kelling 5.2 x 7F', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 02:59:53', '2020-07-16 02:59:53'),
('ABG-187', 'KLA-001', 'Kelling 7.8 x 1/2\"', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:01:01', '2020-07-16 03:01:01'),
('ABG-188', 'KLA-001', 'Kelling Catrol', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:01:20', '2020-07-16 03:01:20'),
('ABG-189', 'KLA-001', 'Kelling Grendel', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:01:33', '2020-07-16 03:01:33'),
('ABG-190', 'KLA-001', 'Kelling Jamur 8 x 15', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:01:52', '2020-07-16 03:01:52'),
('ABG-191', 'KLA-001', 'Kelling SKT', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:02:05', '2020-07-16 03:02:05'),
('ABG-192', 'KLA-001', 'Kinik Batu Osco W 170 (8x13)', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:04:33', '2020-07-16 03:05:20'),
('ABG-193', 'KLA-001', 'Kinik Batu Osco W 176 (10x13)', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:05:03', '2020-07-16 03:05:58'),
('ABG-194', 'KLA-001', 'Kinik Batu Osco W 185 (13x13)', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:06:32', '2020-07-16 03:06:32'),
('ABG-195', 'KLA-001', 'Kinik Off Hand Grinding Wheels Widia 6x1x1 1/4', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:07:01', '2020-07-16 03:07:01'),
('ABG-196', 'KLA-001', 'Kinik Putih 205x13x31.75 WA 60', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:07:23', '2020-07-16 03:08:44'),
('ABG-197', 'KLA-001', 'Kinik Putih 205x19x31.75 WA 80', '-', 'bahanbaku', '-', 'DEL', 'admin', '2020-07-16 03:08:06', '2020-07-16 03:10:27'),
('ABG-198', 'KLA-001', 'Kinik Putih 205x19x31.75 WA 80', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:11:02', '2020-07-16 03:11:02'),
('ABG-199', 'KLA-001', 'Kinik Putih 8\" x 19 x 31.75 WA 60', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:12:04', '2020-07-16 03:12:04'),
('ABG-200', 'KLA-001', 'Kursi Tunggu 4 Dudukan', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:12:23', '2020-07-16 03:12:23'),
('ABG-201', 'KLA-001', 'Lakban', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:12:46', '2020-07-16 03:12:46'),
('ABG-202', 'KLA-001', 'Limit Switch D4MC2020 Omron', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:13:15', '2020-07-16 03:13:15'),
('ABG-203', 'KLA-001', 'LPG 50KG', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:13:35', '2020-07-16 03:13:35'),
('ABG-204', 'KLA-001', 'Masker Hijau', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:13:56', '2020-07-16 03:13:56'),
('ABG-205', 'KLA-001', 'Masker NP 305', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:14:22', '2020-07-16 03:14:22'),
('ABG-206', 'KLA-001', 'Masterbad', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:14:37', '2020-07-16 03:14:37'),
('ABG-207', 'KLA-001', 'MCB 400/3P', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:14:55', '2020-07-16 03:14:55'),
('ABG-208', 'KLA-001', 'Mesin Autolathe Lico type 32', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:15:15', '2020-07-16 03:15:15'),
('ABG-209', 'KLA-001', 'Mesin Timecard Amano EX 3500 N', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:15:34', '2020-07-16 03:15:34'),
('ABG-210', 'KLA-001', 'Metalpost', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:15:46', '2020-07-16 03:15:46'),
('ABG-211', 'KLA-001', 'Mitsubishi mata bor 9.6mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:19:04', '2020-07-16 03:19:04'),
('ABG-212', 'KLA-001', 'Motor 1.5 HP 3 phase', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:19:24', '2020-07-16 03:19:24'),
('ABG-213', 'KLA-001', 'Mur Hex M8 K12', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:19:50', '2020-07-16 03:19:50'),
('ABG-214', 'KLA-001', 'Nanchi Mata Bor 10.5mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:20:29', '2020-07-16 03:20:29'),
('ABG-215', 'KLA-001', 'Nanchi Mata Bor 4mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:20:56', '2020-07-16 03:20:56'),
('ABG-216', 'KLA-001', 'Nanchi Mata Bor 4.2 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:21:24', '2020-07-16 03:21:24'),
('ABG-217', 'KLA-001', 'Nanchi Mata Bor 6 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:21:55', '2020-07-16 03:21:55'),
('ABG-218', 'KLA-001', 'Nanchi Mata Bor 7.5 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:22:31', '2020-07-16 03:22:31'),
('ABG-219', 'KLA-001', 'Nanchi Mata Bor 8 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:22:49', '2020-07-16 03:22:49'),
('ABG-220', 'KLA-001', 'Nanchi Mata Bor 9 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:23:04', '2020-07-16 03:23:04'),
('ABG-221', 'KLA-001', 'Nanchi Twist Drill SS dia 2.5 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:23:37', '2020-07-16 03:23:37'),
('ABG-222', 'KLA-001', 'Nanchi Twist Drill SS dia 3 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:23:57', '2020-07-16 03:23:57'),
('ABG-223', 'KLA-001', 'Nanchi Twist Drill SS dia 3.5 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:24:16', '2020-07-16 03:24:16'),
('ABG-224', 'KLA-001', 'NH 3/8 K14', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:25:02', '2020-07-16 03:25:02'),
('ABG-225', 'KLA-001', 'NYY 4x6 mm Eterna', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:25:37', '2020-07-16 03:25:37'),
('ABG-226', 'KLA-001', 'Olie Bor', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:25:50', '2020-07-16 03:25:50'),
('ABG-227', 'KLA-001', 'Olie Hydrolic AW 68', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:26:10', '2020-07-16 03:26:10'),
('ABG-228', 'KLA-001', 'Ongkir', 'Ongkos Kirim', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:29:13', '2020-07-16 03:29:13'),
('ABG-229', 'KLA-001', 'Overload LRD 06/1-1.6 Amp Scheneider', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:29:46', '2020-07-16 03:29:46'),
('ABG-230', 'KLA-001', 'Overload Tesys LRD 08/2.5-4 A Schneider', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:30:26', '2020-07-16 03:30:26'),
('ABG-231', 'KLA-001', 'PB push ON BT -3 otto', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:30:46', '2020-07-16 03:30:46'),
('ABG-232', 'KLA-001', 'Pipa Gas 14 mm x 1.8', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:31:15', '2020-07-16 03:31:15'),
('ABG-233', 'KLA-001', 'Pipa Kotak 20x40x1.2', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:32:04', '2020-07-16 03:32:04'),
('ABG-234', 'KLA-001', 'Pipa Kotak 40x40x1.4', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:32:20', '2020-07-16 03:32:20'),
('ABG-235', 'KLA-001', 'Pipa Metalpos', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:32:50', '2020-07-16 03:32:50'),
('ABG-236', 'KLA-001', 'Pipa Ulir Drat Luar dan Dalam', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:33:29', '2020-07-16 03:33:29'),
('ABG-237', 'KLA-001', 'Pir Ring 5-5K Pluit', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:34:00', '2020-07-16 03:34:00'),
('ABG-238', 'KLA-001', 'Pir SKT 15-5K', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:34:22', '2020-07-16 03:34:22'),
('ABG-239', 'KLA-001', 'PL 22 mm LED AD 22-22 DS/220 V', '-', 'bahanbaku', 'Merah', 'OPN', 'admin', '2020-07-16 03:35:09', '2020-07-16 03:35:09'),
('ABG-240', 'KLA-001', 'PL 22 mm LED AD 16-22 DS', '-', 'bahanbaku', 'Merah TenT', 'OPN', 'admin', '2020-07-16 03:35:45', '2020-07-16 03:35:45'),
('ABG-241', 'KLA-001', 'Plastik PP 0.02x10', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:36:06', '2020-07-16 03:36:06'),
('ABG-242', 'KLA-001', 'Plat 1.2x80xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:36:23', '2020-07-16 03:36:23'),
('ABG-243', 'KLA-001', 'Plat 1.6x35xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:36:44', '2020-07-16 03:36:44'),
('ABG-244', 'KLA-001', 'Plat Galvaniel 0.6-0.65x57xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:37:09', '2020-07-16 03:37:09'),
('ABG-245', 'KLA-001', 'Plat Galvaniel 0.6-0.65x78xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:37:37', '2020-07-16 03:37:37'),
('ABG-246', 'KLA-001', 'Plat Galvaniel 0.6-0.7x65xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:45:06', '2020-07-16 03:45:06'),
('ABG-247', 'KLA-001', 'Plat Galvaniel 1.6x35xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:45:44', '2020-07-16 03:45:44'),
('ABG-248', 'KLA-001', 'Plat Galvaniel 0.60', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:46:17', '2020-07-16 03:46:17'),
('ABG-249', 'KLA-001', 'Plat Galvaniel 0.70', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:46:33', '2020-07-16 03:46:33'),
('ABG-250', 'KLA-001', 'Plat Galvanil 0.80x4\"x8\"', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:47:07', '2020-07-16 03:47:07'),
('ABG-251', 'KLA-001', 'Plat Hitam 2x245xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:47:31', '2020-07-16 03:47:31'),
('ABG-252', 'KLA-001', 'Plat Hitam 2x30xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:48:01', '2020-07-16 03:48:01'),
('ABG-253', 'KLA-001', 'Plat Hitam 2x90xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:48:22', '2020-07-16 03:48:22'),
('ABG-254', 'KLA-001', 'Plat Hitam 2.5x4\"x8\"', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:48:52', '2020-07-16 03:48:52'),
('ABG-255', 'KLA-001', 'Plat Karoseri 0.65x764x416', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:49:19', '2020-07-16 03:49:19'),
('ABG-256', 'KLA-001', 'Plat Karoseri 0.65x868x610', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:49:43', '2020-07-16 03:49:43'),
('ABG-257', 'KLA-001', 'Plat Ovar pall', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:50:01', '2020-07-16 03:50:01'),
('ABG-258', 'KLA-001', 'Plat PO 2x245xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:50:20', '2020-07-16 03:50:20'),
('ABG-259', 'KLA-001', 'Plat PO 2x40xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:51:04', '2020-07-16 03:51:04'),
('ABG-260', 'KLA-001', 'Plat PO 2x477xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:51:26', '2020-07-16 03:51:26'),
('ABG-261', 'KLA-001', 'Plat Putih 0.6-0.65x57xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:51:44', '2020-07-16 03:53:58'),
('ABG-262', 'KLA-001', 'Plat Putih 0.65x65xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:52:05', '2020-07-16 03:52:05'),
('ABG-263', 'KLA-001', 'Plat Putih 0.6-0.65x78xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:56:34', '2020-07-16 03:56:34'),
('ABG-264', 'KLA-001', 'Plat Putih 0.6-0.69x65xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:57:11', '2020-07-16 03:57:11'),
('ABG-265', 'KLA-001', 'Plat Putih 0.6-0.65x78xC', '-', 'bahanbaku', '-', 'DEL', 'admin', '2020-07-16 03:57:35', '2020-07-16 04:04:44'),
('ABG-266', 'KLA-001', 'Plat Putih 0.6-0.69x78xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:58:50', '2020-07-16 03:58:50'),
('ABG-267', 'KLA-001', 'Plat Putih 0.6x1717xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 03:59:47', '2020-07-16 03:59:47'),
('ABG-268', 'KLA-001', 'Plat Putih 0.60-0.70x57xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:00:28', '2020-07-16 04:00:28'),
('ABG-269', 'KLA-001', 'Plat Putih 0.60-0.70x65xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:00:54', '2020-07-16 04:00:54'),
('ABG-270', 'KLA-001', 'Plat Putih 0.65x1220xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:01:22', '2020-07-16 04:01:22'),
('ABG-271', 'KLA-001', 'Plat Putih 0.65x57xC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:01:47', '2020-07-16 04:01:47'),
('ABG-272', 'KLA-001', 'Powder Coating Black Semi', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:06:51', '2020-07-16 04:06:51'),
('ABG-273', 'KLA-001', 'Powder Coating Red Afal', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:07:15', '2020-07-16 04:07:15'),
('ABG-274', 'KLA-001', 'Powder Coating Silver', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:07:31', '2020-07-16 04:07:31'),
('ABG-275', 'KLA-001', 'Power Trowel + Mesin Honda GP 160', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:08:39', '2020-07-16 04:08:39'),
('ABG-276', 'KLA-001', 'PP 0.02x10x12', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:09:03', '2020-07-16 04:09:40'),
('ABG-277', 'KLA-001', 'PP 0.002x18x30', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:09:22', '2020-07-16 04:09:22'),
('ABG-278', 'KLA-001', 'Punch Mold', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:10:06', '2020-07-16 04:10:06'),
('ABG-279', 'KLA-001', 'PVC Curtain', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:10:26', '2020-07-16 04:10:26'),
('ABG-280', 'KLA-001', 'Ready Mix', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:10:39', '2020-07-16 04:10:39'),
('ABG-281', 'KLA-001', 'Reclening', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:11:24', '2020-07-16 04:11:24'),
('ABG-282', 'KLA-001', 'Ring pluit', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:11:45', '2020-07-16 04:11:45'),
('ABG-283', 'KLA-001', 'Roda Samping', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:12:04', '2020-07-16 04:12:04'),
('ABG-284', 'KLA-001', 'RRT Betel Bubut 3/8x4', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:12:24', '2020-07-16 04:12:24'),
('ABG-285', 'KLA-001', 'Rumah VOC', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:12:38', '2020-07-16 04:12:38'),
('ABG-286', 'KLA-001', 'SAN 335 T', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:12:51', '2020-07-16 04:12:51'),
('ABG-287', 'KLA-001', 'Selektor 1-0.25 mm CRSL-252 A 1 Hanyoung', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:13:27', '2020-07-16 04:13:27'),
('ABG-288', 'KLA-001', 'Siku 30x3', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:13:48', '2020-07-16 04:13:48'),
('ABG-289', 'KLA-001', 'SKC Hand Tap High Grade BSW 5/16x1875829', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:14:13', '2020-07-16 04:14:13'),
('ABG-290', 'KLA-001', 'Skrup 3x1/2\"', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:15:01', '2020-07-16 04:15:01'),
('ABG-291', 'KLA-001', 'Skrup Grendel', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:15:17', '2020-07-16 04:15:17'),
('ABG-292', 'KLA-001', 'Skrup Kayu 3x1/2 JF', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:15:46', '2020-07-16 04:15:46'),
('ABG-293', 'KLA-001', 'Skun 6-6mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:16:08', '2020-07-16 04:16:08'),
('ABG-294', 'KLA-001', 'Slang PU Orange 8x5 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:16:31', '2020-07-16 04:16:31'),
('ABG-295', 'KLA-001', 'Snapring H 46', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:16:47', '2020-07-16 04:16:47'),
('ABG-296', 'KLA-001', 'Isolasi', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:17:33', '2020-07-16 04:17:33'),
('ABG-297', 'KLA-001', 'Solenoid Valve SV 210-02 220 v Sham Ho', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:18:01', '2020-07-16 04:18:01'),
('ABG-298', 'KLA-001', 'Stood Conecting', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:18:27', '2020-07-16 04:18:27'),
('ABG-299', 'KLA-001', 'Stud 5/16x40', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:18:46', '2020-07-16 04:18:46'),
('ABG-300', 'KLA-001', 'Taiwan Slang PU Orange 6x4', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:19:22', '2020-07-16 04:19:22'),
('ABG-301', 'KLA-001', 'Techweld Kawat Las MIQ 0.8 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:19:52', '2020-07-16 04:19:52'),
('ABG-302', 'KLA-001', 'Techweld Kawat Las SS 3.2 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:20:18', '2020-07-16 04:20:18'),
('ABG-303', 'KLA-001', 'Tempat Rak Kartu Absensi', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:21:08', '2020-07-16 04:21:08'),
('ABG-304', 'KLA-001', 'Transtecho Helical Gear Motor', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:21:35', '2020-07-16 04:21:35'),
('ABG-305', 'KLA-001', 'Tscrew 12x11/2', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:21:51', '2020-07-16 04:21:51'),
('ABG-306', 'KLA-001', 'Ver SKT', '-', 'bahanbaku', 'Baru dan Lama', 'OPN', 'admin', '2020-07-16 04:22:12', '2020-07-16 04:22:12'),
('ABG-307', 'KLA-001', 'Wipro Air Filter Regulator 1/2\" Double', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:22:49', '2020-07-16 04:22:49'),
('ABG-308', 'KLA-001', 'Wipro Fitting JSC 08-0100073', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:23:23', '2020-07-16 04:23:23'),
('ABG-309', 'KLA-001', 'Wipro Fitting SPC 08-02001312', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:23:46', '2020-07-16 04:25:24'),
('ABG-310', 'KLA-001', 'Wipro Fitting SPL 08-03 00307', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:24:00', '2020-07-16 04:26:22'),
('ABG-311', 'KLA-001', 'Wipro Fitting SPU 8 00136', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:27:12', '2020-07-16 04:27:12'),
('ABG-312', 'KLA-001', 'Wipro Fitting SPX 08-01 00102', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:27:39', '2020-07-16 04:27:39'),
('ABG-313', 'KLA-001', 'Wipro Hand Tap L 3/8x16', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:28:01', '2020-07-16 04:28:01'),
('ABG-314', 'KLA-001', 'Wipro Kepala Bor KBS 16 HD 16 mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:29:53', '2020-07-16 04:29:53'),
('ABG-315', 'KLA-001', 'Wipro Kunci Ring Pas Set 11 pcs 8-24 mm Satin', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:31:24', '2020-07-16 04:31:24'),
('ABG-316', 'KLA-001', 'Wipro Obeng Tembus WP 5112 6\"x6mm', '-', 'bahanbaku', 'Minus dan Plus', 'OPN', 'admin', '2020-07-16 04:32:37', '2020-07-16 04:32:37'),
('ABG-317', 'KLA-001', 'Wire Drawing Machine', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:32:58', '2020-07-16 04:32:58'),
('ABG-318', 'KLA-001', 'Wirerod 7.5', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:33:13', '2020-07-16 04:33:13'),
('ABG-319', 'KLA-001', 'Wirerod SWRM12 dia 8mm', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:33:35', '2020-07-16 04:33:35'),
('ABG-320', 'KLA-001', 'Yamawa Machine Tap SP BSW 5/16x18', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:34:00', '2020-07-16 04:34:00'),
('ABG-321', 'KLA-001', 'Yamawa Machine Tap SP M8x1.25', '-', 'bahanbaku', '-', 'OPN', 'admin', '2020-07-16 04:34:28', '2020-07-16 04:34:28'),
('ABG-322', 'KLA-001', 'Tower Bolt Exito Brown', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:34:32', '2020-07-24 04:34:32'),
('ABG-323', 'KLA-001', 'Tower Bolt Exito Silver', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:35:00', '2020-07-24 04:35:00'),
('ABG-324', 'KLA-001', 'Tower Bolt SKT Brown', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:35:59', '2020-07-24 04:35:59'),
('ABG-325', 'KLA-001', 'Tower Bolt SKT Silver', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:36:22', '2020-07-24 04:36:22'),
('ABG-326', 'KLA-001', 'Tower Bolt Reyner Brown', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:40:01', '2020-07-24 04:40:01'),
('ABG-327', 'KLA-001', 'Tower Bolt Reyner Silver', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:40:23', '2020-07-24 04:40:23'),
('ABG-328', 'KLA-001', 'Tower Bolt VOC Brown', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:41:22', '2020-07-24 04:41:22'),
('ABG-329', 'KLA-001', 'Tower Bolt VOC Silver', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:41:38', '2020-07-24 04:41:38'),
('ABG-330', 'KLA-001', 'Tower Bolt FRT Brown', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:42:24', '2020-07-24 04:42:24'),
('ABG-331', 'KLA-001', 'Tower Bolt FRT Silver', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:43:11', '2020-07-24 04:43:11'),
('ABG-332', 'KLA-001', 'Slide Action Towerbolt HONA Brown', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:44:25', '2020-07-24 04:44:25'),
('ABG-333', 'KLA-001', 'Slide Action Towerbolt HONA Silver', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:44:43', '2020-07-24 04:44:43'),
('ABG-334', 'KLA-001', 'Slide Action Towerbolt HONA Orange', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:45:02', '2020-07-24 04:45:02'),
('ABG-335', 'KLA-001', 'Slide Action Towerbolt HONA Green', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:52:53', '2020-07-24 04:52:53'),
('ABG-336', 'KLA-001', 'Slide Action Towerbolt SKT BROWN', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:54:26', '2020-07-24 04:54:26'),
('ABG-337', 'KLA-001', 'Slide Action Towerbolt SKT SILVER', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:54:50', '2020-07-24 04:54:50'),
('ABG-338', 'KLA-001', 'Slide Action Towerbolt SKT GREEN', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:55:11', '2020-07-24 04:55:11'),
('ABG-339', 'KLA-001', 'Slide Action Towerbolt SKT ORANGE', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:55:39', '2020-07-24 04:55:39'),
('ABG-340', 'KLA-001', 'Slide Action Towerbolt VOC BROWN', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:57:09', '2020-07-24 04:57:09'),
('ABG-341', 'KLA-001', 'Slide Action Towerbolt VOC SILVER', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:57:31', '2020-07-24 04:57:31'),
('ABG-342', 'KLA-001', 'Slide Action Towerbolt VOC GREEN', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:57:57', '2020-07-24 04:57:57'),
('ABG-343', 'KLA-001', 'Slide Action Towerbolt VOC ORANGE', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:58:15', '2020-07-24 04:58:15'),
('ABG-344', 'KLA-001', 'Tower Bolt ECT BROWN', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:59:46', '2020-07-24 04:59:46'),
('ABG-345', 'KLA-001', 'Tower Bolt ECT SILVER', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 05:00:03', '2020-07-24 05:00:03'),
('ART-001', 'KLA-002', 'Bed Fitting L', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:09:35', '2020-07-14 03:09:35'),
('ART-0010', 'KLA-002', 'Hanger Plastik S', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:14:55', '2020-07-14 03:14:55'),
('ART-002', 'KLA-002', 'Bed Fitting R', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:10:00', '2020-07-14 03:10:00'),
('ART-003', 'KLA-002', 'Bed Fitting Kecil L', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:10:28', '2020-07-14 03:10:28'),
('ART-004', 'KLA-002', 'Bed Fitting Kecil R', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:10:52', '2020-07-14 03:10:52'),
('ART-005', 'KLA-002', 'Peluit ACME RED', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:12:50', '2020-07-24 04:48:21'),
('ART-006', 'KLA-002', 'Hanger Jas', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:13:07', '2020-07-14 03:13:07'),
('ART-007', 'KLA-002', 'Hanger Steel', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:13:27', '2020-07-14 03:13:27'),
('ART-008', 'KLA-002', 'Hanger Plastik L', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:14:02', '2020-07-14 03:14:02'),
('ART-009', 'KLA-002', 'Hanger Plastik M', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:14:33', '2020-07-14 03:14:33'),
('ART-011', 'KLA-002', 'Kerekan Sumur Silver', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:17:44', '2020-07-14 03:17:44'),
('ART-012', 'KLA-002', 'Kerekan Sumur Hioshi', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:18:09', '2020-07-14 03:18:09'),
('ART-013', 'KLA-002', 'Kerekan Sumur Warna', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:18:30', '2020-07-14 03:18:30'),
('ART-014', 'KLA-002', 'Kerekan Warna With Bearing', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:19:10', '2020-07-14 03:19:10'),
('ART-015', 'KLA-002', 'Kerekan Sumur ATC', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:19:39', '2020-07-14 03:19:39'),
('ART-016', 'KLA-002', 'Gunting SKT', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:29:39', '2020-07-14 03:29:39'),
('ART-017', 'KLA-002', 'Garden Tools', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:30:27', '2020-07-14 03:30:27'),
('ART-018', 'KLA-002', 'Peluit ACME ORANGE', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:49:34', '2020-07-24 04:49:34'),
('ART-019', 'KLA-002', 'Peluit ACME YELLOW', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:49:56', '2020-07-24 04:49:56'),
('ART-020', 'KLA-002', 'Peluit ACME BLACK', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:50:15', '2020-07-24 04:50:15'),
('ART-021', 'KLA-002', 'Peluit ACME BLUE', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:50:34', '2020-07-24 04:50:34'),
('ART-022', 'KLA-002', 'Peluit ACME PURPLE', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:50:57', '2020-07-24 04:50:57'),
('ART-023', 'KLA-002', 'Peluit ACME GREEN', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:51:17', '2020-07-24 04:51:17'),
('ART-024', 'KLA-002', 'Peluit ACME WHITE', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-24 04:51:34', '2020-07-24 04:51:34'),
('SPR-001', 'KLA-003', 'Roda Samping', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:05:16', '2020-07-14 03:05:16'),
('SPR-002', 'KLA-003', 'Roda Samping Pendek', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:12:21', '2020-07-14 03:12:21'),
('SPR-003', 'KLA-003', 'Safety Belt Plastic', '-', 'bahanjadi', '-', 'OPN', 'admin', '2020-07-14 03:17:20', '2020-07-14 03:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `jenisbayars`
--

CREATE TABLE `jenisbayars` (
  `KodeJenisBayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `JenisBayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` int(10) UNSIGNED NOT NULL,
  `KodeKaryawan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kota` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Propinsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Negara` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `JenisKelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `TanggalDaftar` date DEFAULT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `KodeKaryawan`, `Nama`, `Alamat`, `Kota`, `Propinsi`, `Negara`, `Telepon`, `Email`, `JenisKelamin`, `TanggalDaftar`, `KodeUser`, `Status`, `Jabatan`, `created_at`, `updated_at`) VALUES
(1, 'KAR-001', 'Nn', 'Jln coba', 'Malang', NULL, NULL, '12345', NULL, 'Laki-laki', NULL, 'admin', 'DEL', 'Driver', '2020-07-13 04:46:59', '2020-07-14 04:08:33'),
(2, 'KAR-002', 'YONO', '-', 'Malang', NULL, NULL, '-', NULL, 'Laki-laki', NULL, 'admin', 'OPN', 'Driver', '2020-07-17 09:32:54', '2020-08-06 03:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `kasbanks`
--

CREATE TABLE `kasbanks` (
  `KodeKasBank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` datetime NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TanggalCheque` date NOT NULL,
  `KodeBayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TipeBayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoLink` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BayarDari` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Untuk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `KodeKasBankID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `KodeKategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaKategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItemAwal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`KodeKategori`, `NamaKategori`, `KodeItemAwal`, `Status`, `KodeUser`, `created_at`, `updated_at`) VALUES
('KLA-001', 'Alat bangunan', 'ABG', 'OPN', 'admin', '2020-07-13 04:39:42', '2020-07-13 04:39:42'),
('KLA-002', 'Alat Rumah Tangga', 'ART', 'OPN', 'admin', '2020-07-14 03:04:30', '2020-07-14 03:04:30'),
('KLA-003', 'Sparepart', 'SPR', 'OPN', 'admin', '2020-07-14 03:04:43', '2020-07-14 03:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `keluarmasukbarangs`
--

CREATE TABLE `keluarmasukbarangs` (
  `id` bigint(20) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `JenisTransaksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeTransaksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qty` double NOT NULL,
  `HargaRata` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idx` bigint(20) NOT NULL,
  `indexmov` bigint(20) NOT NULL,
  `saldo` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasiitems`
--

CREATE TABLE `lokasiitems` (
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qty` double NOT NULL,
  `Konversi` double NOT NULL,
  `HargaRata` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasis`
--

CREATE TABLE `lokasis` (
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasis`
--

INSERT INTO `lokasis` (`KodeLokasi`, `NamaLokasi`, `Tipe`, `Status`, `KodeUser`, `created_at`, `updated_at`) VALUES
('GUD-001', 'DRAGON', 'INV', 'OPN', 'lili', NULL, '2020-07-23 08:44:09'),
('GUD-002', 'GUDANG PLUIT', 'INV', 'OPN', 'admin', '2020-07-13 07:14:17', '2020-07-13 07:14:17'),
('GUD-003', 'GUDANG KEREKAN', 'INV', 'OPN', 'admin', '2020-07-13 07:14:55', '2020-07-13 07:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `matauangs`
--

CREATE TABLE `matauangs` (
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nilai` double NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matauangs`
--

INSERT INTO `matauangs` (`KodeMataUang`, `NamaMataUang`, `Nilai`, `Status`, `KodeUser`, `created_at`, `updated_at`) VALUES
('Rp', 'Rupiah', 1, 'OPN', 'admin', '2020-07-13 04:43:50', '2020-07-13 04:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `KodePelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaPelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kontak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Handphone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIK` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NPWP` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LimitPiutang` double DEFAULT NULL,
  `Diskon` double DEFAULT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`KodePelanggan`, `NamaPelanggan`, `Kontak`, `Handphone`, `Email`, `NIK`, `NPWP`, `LimitPiutang`, `Diskon`, `Status`, `KodeLokasi`, `KodeUser`, `created_at`, `updated_at`) VALUES
('PLG-001', 'Abadi', '0', NULL, NULL, '0', '123', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-13 04:44:49', '2020-08-06 03:32:36'),
('PLG-002', 'Abadi Surya', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-13 07:33:12', '2020-07-13 07:33:12'),
('PLG-003', 'PT Ferido', '089609521108', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-13 07:34:17', '2020-08-06 03:23:20'),
('PLG-004', 'Affandy', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:35:15', '2020-07-14 03:35:15'),
('PLG-005', 'Antara', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:35:52', '2020-08-06 03:37:19'),
('PLG-006', 'Anugrah', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:36:09', '2020-07-14 03:36:09'),
('PLG-007', 'Asia Sport', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:36:21', '2020-07-14 03:36:21'),
('PLG-008', 'Dunia Mas', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:36:32', '2020-07-14 03:36:32'),
('PLG-009', 'Ginza', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:36:53', '2020-07-14 03:36:53'),
('PLG-010', 'Gunung Subur', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:37:03', '2020-08-06 03:31:50'),
('PLG-011', 'Haji Madjid', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:37:18', '2020-07-14 03:37:18'),
('PLG-012', 'PT Karya Bintang Baru', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:37:32', '2020-08-06 03:31:33'),
('PLG-013', 'Ko Yong Lie', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:37:47', '2020-07-14 03:37:47'),
('PLG-014', 'Lukas', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:38:04', '2020-07-14 04:48:57'),
('PLG-015', 'Madjid', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:38:24', '2020-07-14 03:38:24'),
('PLG-016', 'Mandalindo', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:38:36', '2020-07-14 03:38:36'),
('PLG-017', 'Millenia', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:38:48', '2020-08-06 03:32:21'),
('PLG-018', 'Nusa Indah', '(0241) 7605093', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:39:11', '2020-08-06 03:29:42'),
('PLG-019', 'Penghela (Denny)', '081249648825', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:39:28', '2020-08-06 03:35:22'),
('PLG-020', 'Rejeki', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:41:17', '2020-07-14 03:41:17'),
('PLG-021', 'Sanjaya', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:41:49', '2020-08-06 03:36:00'),
('PLG-022', 'Sentral Jaya', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:42:13', '2020-07-14 03:42:13'),
('PLG-023', 'UD Amirudin', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:42:26', '2020-07-14 03:42:26'),
('PLG-024', 'Union', '(021) 6927857 - 6909887', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:42:35', '2020-08-06 03:28:23'),
('PLG-025', 'Wijaya Pratama Nusantara', '0', NULL, NULL, '0', '0', NULL, NULL, 'OPN', NULL, 'admin', '2020-07-14 03:42:47', '2020-07-14 03:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `pelunasanhutangs`
--

CREATE TABLE `pelunasanhutangs` (
  `KodePelunasanHutangID` int(11) NOT NULL,
  `KodePelunasanHutang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeHutang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeInvoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeBayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TipeBayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Jumlah` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeKasBank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelunasanpiutangs`
--

CREATE TABLE `pelunasanpiutangs` (
  `KodePelunasanPiutang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodePiutang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeInvoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeBayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TipeBayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Jumlah` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeKasBank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `KodePelunasanPiutangID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelianlangsungdetails`
--

CREATE TABLE `pembelianlangsungdetails` (
  `KodePembelianLangsung` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qty` double NOT NULL,
  `Harga` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoUrut` int(11) NOT NULL,
  `Subtotal` double NOT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelianlangsungs`
--

CREATE TABLE `pembelianlangsungs` (
  `KodePembelianLangsung` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` double NOT NULL,
  `PPN` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NilaiPPN` double NOT NULL,
  `Printed` double NOT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `Subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesananpembeliandetails`
--

CREATE TABLE `pemesananpembeliandetails` (
  `id` bigint(20) NOT NULL,
  `KodePO` varchar(100) NOT NULL,
  `KodeItem` varchar(100) NOT NULL,
  `Qty` double NOT NULL,
  `Harga` double NOT NULL,
  `NoUrut` int(11) NOT NULL,
  `Subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemesananpembelians`
--

CREATE TABLE `pemesananpembelians` (
  `id` int(11) NOT NULL,
  `KodePO` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Total` double DEFAULT NULL,
  `PPN` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NilaiPPN` double DEFAULT NULL,
  `Printed` double DEFAULT NULL,
  `Diskon` double DEFAULT NULL,
  `NilaiDiskon` double DEFAULT NULL,
  `Subtotal` double DEFAULT NULL,
  `KodeSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Expired` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesananpenjualans`
--

CREATE TABLE `pemesananpenjualans` (
  `id` int(11) NOT NULL,
  `KodeSO` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Total` double NOT NULL,
  `PPN` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NilaiPPN` double DEFAULT NULL,
  `Printed` double DEFAULT NULL,
  `Diskon` double DEFAULT 0,
  `NilaiDiskon` double DEFAULT 0,
  `Subtotal` double DEFAULT NULL,
  `KodePelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Expired` double DEFAULT NULL,
  `KodeSales` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `POPelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `term` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NoFaktur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesananpenjualans`
--

INSERT INTO `pemesananpenjualans` (`id`, `KodeSO`, `Tanggal`, `KodeLokasi`, `KodeMataUang`, `Status`, `KodeUser`, `Total`, `PPN`, `NilaiPPN`, `Printed`, `Diskon`, `NilaiDiskon`, `Subtotal`, `KodePelanggan`, `Expired`, `KodeSales`, `POPelanggan`, `created_at`, `updated_at`, `tgl_kirim`, `term`, `keterangan`, `NoFaktur`) VALUES
(1, 'SO-20070001', '2020-01-03', 'GUD-001', 'Rp', 'OPN', 'admin', 88200000, 'tidak', 0, 0, 0, 0, 88200000, 'PLG-020', 30, '0', 'PO', '2020-07-24 09:10:42', '2020-07-24 09:10:42', '2020-01-03', '30', '-', NULL),
(2, 'SO-20080001', '2020-01-03', 'GUD-001', 'Rp', 'OPN', 'admin', 104925000, 'tidak', 0, 0, 0, 0, 104925000, 'PLG-003', 30, '0', 'PO', '2020-08-06 03:59:36', '2020-08-06 03:59:36', '2020-01-03', '30', '-', NULL),
(3, 'SO-20080002', '2020-01-07', 'GUD-001', 'Rp', 'OPN', 'admin', 124575000, 'tidak', 0, 0, 0, 0, 124575000, 'PLG-003', 30, '0', 'PO', '2020-08-06 04:03:21', '2020-08-06 04:03:21', '2020-01-07', '30', '-', NULL),
(4, 'SO-20080003', '2020-01-07', 'GUD-001', 'Rp', 'OPN', 'admin', 50400000, 'tidak', 0, 0, 0, 0, 50400000, 'PLG-020', 30, '0', 'PO', '2020-08-06 04:04:42', '2020-08-06 04:04:42', '2020-01-07', '30', '-', NULL),
(5, 'SO-20080004', '2020-01-07', 'GUD-001', 'Rp', 'OPN', 'admin', 79275000, 'tidak', 0, 0, 0, 0, 79275000, 'PLG-018', 30, '0', 'PO', '2020-08-06 04:06:17', '2020-08-06 04:06:17', '2020-01-07', '30', '-', NULL),
(6, 'SO-20080005', '2020-01-08', 'GUD-001', 'Rp', 'OPN', 'admin', 31200000, 'tidak', 0, 0, 0, 0, 31200000, 'PLG-001', 30, '0', 'PO', '2020-08-06 04:07:58', '2020-08-06 04:07:58', '2020-01-08', '30', '-', NULL),
(7, 'SO-20080006', '2020-01-14', 'GUD-001', 'Rp', 'OPN', 'admin', 45449600, 'tidak', 0, 0, 0, 0, 45449600, 'PLG-025', 30, '0', 'PO', '2020-08-06 04:09:34', '2020-08-06 04:09:34', '2020-01-14', '30', '-', NULL),
(8, 'SO-20080007', '2020-01-14', 'GUD-001', 'Rp', 'OPN', 'admin', 118875000, 'tidak', 0, 0, 0, 0, 118875000, 'PLG-005', 30, '0', 'PO', '2020-08-06 04:10:59', '2020-08-06 04:10:59', '2020-01-14', '30', '-', NULL),
(9, 'SO-20080008', '2020-01-16', 'GUD-001', 'Rp', 'OPN', 'admin', 45150000, 'tidak', 0, 0, 0, 0, 45150000, 'PLG-018', 30, '0', 'PO', '2020-08-06 04:12:30', '2020-08-06 04:12:30', '2020-01-16', '30', '-', NULL),
(10, 'SO-20080009', '2020-01-16', 'GUD-001', 'Rp', 'OPN', 'admin', 71400000, 'tidak', 0, 0, 0, 0, 71400000, 'PLG-021', 30, '0', 'PO', '2020-08-06 04:13:49', '2020-08-06 04:13:49', '2020-01-16', '30', '-', NULL),
(11, 'SO-20080010', '2020-01-16', 'GUD-001', 'Rp', 'OPN', 'admin', 59325000, 'tidak', 0, 0, 0, 0, 59325000, 'PLG-002', 30, '0', 'PO', '2020-08-06 04:15:05', '2020-08-06 04:15:05', '2020-01-16', '30', '-', NULL),
(12, 'SO-20080011', '2020-01-20', 'GUD-001', 'Rp', 'OPN', 'admin', 24000000, 'tidak', 0, 0, 0, 0, 24000000, 'PLG-017', 30, '0', 'PO', '2020-08-06 04:15:52', '2020-08-06 04:15:52', '2020-01-20', '30', '-', NULL),
(13, 'SO-20080012', '2020-01-20', 'GUD-001', 'Rp', 'OPN', 'admin', 146475000, 'tidak', 0, 0, 0, 0, 146475000, 'PLG-001', 30, '0', 'PO', '2020-08-06 04:17:04', '2020-08-06 04:17:04', '2020-01-20', '30', '-', NULL),
(14, 'SO-20080013', '2020-01-20', 'GUD-001', 'Rp', 'OPN', 'admin', 52258500, 'tidak', 0, 0, 0, 0, 52258500, 'PLG-015', 30, '0', 'PO', '2020-08-06 04:18:09', '2020-08-06 04:18:09', '2020-01-20', '30', '-', NULL),
(15, 'SO-20080014', '2020-01-23', 'GUD-001', 'Rp', 'OPN', 'admin', 12082500, 'tidak', 0, 0, 0, 0, 12082500, 'PLG-015', 30, '0', 'PO', '2020-08-06 04:18:47', '2020-08-06 04:18:47', '2020-01-23', '30', '-', NULL),
(16, 'SO-20080015', '2020-01-24', 'GUD-001', 'Rp', 'OPN', 'admin', 64800000, 'tidak', 0, 0, 0, 0, 64800000, 'PLG-002', 30, '0', 'PO', '2020-08-06 04:20:02', '2020-08-06 04:20:02', '2020-01-24', '30', '-', NULL),
(17, 'SO-20080016', '2020-01-27', 'GUD-001', 'Rp', 'OPN', 'admin', 38150000, 'tidak', 0, 0, 0, 0, 38150000, 'PLG-019', 30, '0', 'PO', '2020-08-06 04:22:45', '2020-08-06 04:22:45', '2020-01-27', '30', '-', NULL),
(18, 'SO-20080017', '2020-01-28', 'GUD-001', 'Rp', 'OPN', 'admin', 23200000, 'tidak', 0, 0, 0, 0, 23200000, 'PLG-017', 30, '0', 'PO', '2020-08-06 04:23:48', '2020-08-06 04:23:48', '2020-01-28', '30', '-', NULL),
(19, 'SO-20080018', '2020-01-28', 'GUD-001', 'Rp', 'OPN', 'admin', 95220000, 'tidak', 0, 0, 0, 0, 95220000, 'PLG-024', 30, '0', 'PO', '2020-08-06 04:26:04', '2020-08-06 04:26:04', '2020-01-28', '30', '-', NULL),
(20, 'SO-20080019', '2020-01-29', 'GUD-001', 'Rp', 'OPN', 'admin', 27000000, 'tidak', 0, 0, 0, 0, 27000000, 'PLG-008', 30, '0', 'PO', '2020-08-06 04:27:53', '2020-08-06 04:27:53', '2020-01-29', '30', '-', NULL),
(21, 'SO-20080020', '2020-01-29', 'GUD-001', 'Rp', 'OPN', 'admin', 6600000, 'tidak', 0, 0, 0, 0, 6600000, 'PLG-007', 30, '0', 'PO', '2020-08-06 04:30:31', '2020-08-06 04:30:31', '2020-01-29', '30', '-', NULL),
(22, 'SO-20080021', '2020-01-29', 'GUD-001', 'Rp', 'OPN', 'admin', 53280000, 'tidak', 0, 0, 0, 0, 53280000, 'PLG-014', 30, '0', 'PO', '2020-08-06 04:32:03', '2020-08-06 04:32:03', '2020-01-29', '30', '-', NULL),
(23, 'SO-20080022', '2020-01-31', 'GUD-001', 'Rp', 'OPN', 'admin', 14350000, 'tidak', 0, 0, 0, 0, 14350000, 'PLG-017', 30, '0', 'PO', '2020-08-06 04:33:03', '2020-08-06 04:33:03', '2020-01-31', '30', '-', NULL),
(24, 'SO-20080023', '2020-01-31', 'GUD-001', 'Rp', 'OPN', 'admin', 207825000, 'tidak', 0, 0, 0, 0, 207825000, 'PLG-003', 30, '0', 'PO', '2020-08-06 04:34:21', '2020-08-06 04:34:21', '2020-01-31', '30', '-', NULL),
(25, 'SO-20080024', '2020-01-31', 'GUD-001', 'Rp', 'OPN', 'admin', 23115000, 'tidak', 0, 0, 0, 0, 23115000, 'PLG-020', 30, '0', 'PO', '2020-08-06 04:36:21', '2020-08-06 04:36:21', '2020-01-31', '30', '-', NULL),
(26, 'SO-20080025', '2020-01-24', 'GUD-001', 'Rp', 'OPN', 'admin', 62475000, 'tidak', 0, 0, 0, 0, 62475000, 'PLG-018', 30, '0', 'PO', '2020-08-06 04:40:01', '2020-08-06 04:40:01', '2020-01-24', '30', '-', NULL),
(27, 'SO-20080026', '2020-02-01', 'GUD-001', 'Rp', 'OPN', 'admin', 31900000, 'tidak', 0, 0, 0, 0, 31900000, 'PLG-016', 30, '0', 'PO', '2020-08-06 04:45:47', '2020-08-06 04:45:47', '2020-02-01', '30', '-', NULL),
(28, 'SO-20080027', '2020-02-04', 'GUD-001', 'Rp', 'OPN', 'admin', 109200000, 'tidak', 0, 0, 0, 0, 109200000, 'PLG-018', 30, '0', 'PO', '2020-08-06 04:48:15', '2020-08-06 04:48:15', '2020-02-04', '30', '-', NULL),
(29, 'SO-20080028', '2020-02-04', 'GUD-001', 'Rp', 'OPN', 'admin', 32010000, 'tidak', 0, 0, 0, 0, 32010000, 'PLG-001', 30, '0', 'PO', '2020-08-06 04:49:28', '2020-08-06 04:49:28', '2020-02-04', '30', '-', NULL),
(30, 'SO-20080029', '2020-02-05', 'GUD-001', 'Rp', 'OPN', 'admin', 52020000, 'tidak', 0, 0, 0, 0, 52020000, 'PLG-025', 30, '0', 'PO', '2020-08-06 04:50:53', '2020-08-06 04:50:53', '2020-02-05', '30', '-', NULL),
(31, 'SO-20080030', '2020-02-05', 'GUD-001', 'Rp', 'OPN', 'admin', 45390000, 'tidak', 0, 0, 0, 0, 45390000, 'PLG-005', 30, '0', 'PO', '2020-08-06 04:53:47', '2020-08-06 04:53:47', '2020-02-05', '30', '-', NULL),
(32, 'SO-20080031', '2020-02-05', 'GUD-001', 'Rp', 'OPN', 'admin', 27000000, 'tidak', 0, 0, 0, 0, 27000000, 'PLG-006', 30, '0', 'PO', '2020-08-06 04:55:08', '2020-08-06 04:55:08', '2020-02-05', '30', '-', NULL),
(33, 'SO-20080032', '2020-02-07', 'GUD-001', 'Rp', 'OPN', 'admin', 49350000, 'tidak', 0, 0, 0, 0, 49350000, 'PLG-017', 30, '0', 'PO', '2020-08-06 04:56:12', '2020-08-06 04:56:12', '2020-02-07', '30', '-', NULL),
(34, 'SO-20080033', '2020-02-10', 'GUD-001', 'Rp', 'OPN', 'admin', 120225000, 'tidak', 0, 0, 0, 0, 120225000, 'PLG-020', 30, '0', 'PO', '2020-08-06 04:58:16', '2020-08-06 04:58:16', '2020-02-10', '30', '-', NULL),
(35, 'SO-20080034', '2020-02-10', 'GUD-001', 'Rp', 'OPN', 'admin', 24750000, 'tidak', 0, 0, 0, 0, 24750000, 'PLG-003', 30, '0', 'PO', '2020-08-06 04:58:56', '2020-08-06 04:58:56', '2020-02-10', '30', '-', NULL),
(36, 'SO-20080035', '2020-02-10', 'GUD-001', 'Rp', 'OPN', 'admin', 45450000, 'tidak', 0, 0, 0, 0, 45450000, 'PLG-011', 30, '0', 'PO', '2020-08-06 04:59:41', '2020-08-06 04:59:41', '2020-02-10', '30', '-', NULL),
(37, 'SO-20080036', '2020-02-12', 'GUD-001', 'Rp', 'OPN', 'admin', 163800000, 'tidak', 0, 0, 0, 0, 163800000, 'PLG-005', 30, '0', 'PO', '2020-08-06 06:03:44', '2020-08-06 06:03:44', '2020-02-12', '30', '-', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_penjualan_detail`
--

CREATE TABLE `pemesanan_penjualan_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `KodeSO` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Qty` double NOT NULL,
  `Harga` double NOT NULL,
  `NoUrut` int(11) NOT NULL,
  `Subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan_penjualan_detail`
--

INSERT INTO `pemesanan_penjualan_detail` (`id`, `KodeSO`, `KodeItem`, `KodeSatuan`, `Qty`, `Harga`, `NoUrut`, `Subtotal`, `created_at`, `updated_at`) VALUES
(1, 'SO-20070001', 'ABG-047', 'Dzn', 1500, 17500, 1, 26250000, '2020-07-24 09:10:42', '2020-07-24 09:10:42'),
(2, 'SO-20070001', 'ABG-323', 'Dzn', 2040, 17500, 2, 35700000, '2020-07-24 09:10:42', '2020-07-24 09:10:42'),
(3, 'SO-20070001', 'ABG-322', 'Dzn', 1500, 17500, 3, 26250000, '2020-07-24 09:10:42', '2020-07-24 09:10:42'),
(4, 'SO-20080001', 'ABG-044', 'Dzn', 3120, 17500, 1, 54600000, '2020-08-06 03:59:36', '2020-08-06 03:59:36'),
(5, 'SO-20080001', 'ABG-324', 'Dzn', 720, 17500, 2, 12600000, '2020-08-06 03:59:36', '2020-08-06 03:59:36'),
(6, 'SO-20080001', 'ABG-325', 'Dzn', 270, 17500, 3, 4725000, '2020-08-06 03:59:36', '2020-08-06 03:59:36'),
(7, 'SO-20080001', 'ART-011', 'Pcs', 3000, 11000, 4, 33000000, '2020-08-06 03:59:36', '2020-08-06 03:59:36'),
(8, 'SO-20080002', 'ABG-044', 'Dzn', 990, 17500, 1, 17325000, '2020-08-06 04:03:21', '2020-08-06 04:03:21'),
(9, 'SO-20080002', 'ABG-324', 'Dzn', 1530, 17500, 2, 26775000, '2020-08-06 04:03:21', '2020-08-06 04:03:21'),
(10, 'SO-20080002', 'ABG-325', 'Dzn', 1770, 17500, 3, 30975000, '2020-08-06 04:03:21', '2020-08-06 04:03:21'),
(11, 'SO-20080002', 'ART-013', 'Pcs', 4500, 11000, 4, 49500000, '2020-08-06 04:03:21', '2020-08-06 04:03:21'),
(12, 'SO-20080003', 'ABG-047', 'Dzn', 1440, 17500, 1, 25200000, '2020-08-06 04:04:42', '2020-08-06 04:04:42'),
(13, 'SO-20080003', 'ABG-322', 'Dzn', 1230, 17500, 2, 21525000, '2020-08-06 04:04:43', '2020-08-06 04:04:43'),
(14, 'SO-20080003', 'ABG-323', 'Dzn', 210, 17500, 3, 3675000, '2020-08-06 04:04:43', '2020-08-06 04:04:43'),
(15, 'SO-20080004', 'ABG-046', 'Dzn', 3030, 17500, 1, 53025000, '2020-08-06 04:06:17', '2020-08-06 04:06:17'),
(16, 'SO-20080004', 'ABG-326', 'Dzn', 1320, 17500, 2, 23100000, '2020-08-06 04:06:17', '2020-08-06 04:06:17'),
(17, 'SO-20080004', 'ABG-327', 'Dzn', 180, 17500, 3, 3150000, '2020-08-06 04:06:17', '2020-08-06 04:06:17'),
(18, 'SO-20080005', 'ABG-045', 'Dzn', 210, 17500, 1, 3675000, '2020-08-06 04:07:58', '2020-08-06 04:07:58'),
(19, 'SO-20080005', 'ABG-328', 'Dzn', 510, 17500, 2, 8925000, '2020-08-06 04:07:58', '2020-08-06 04:07:58'),
(20, 'SO-20080005', 'ABG-329', 'Dzn', 120, 17500, 3, 2100000, '2020-08-06 04:07:58', '2020-08-06 04:07:58'),
(21, 'SO-20080005', 'ART-011', 'Pcs', 1500, 11000, 4, 16500000, '2020-08-06 04:07:58', '2020-08-06 04:07:58'),
(22, 'SO-20080006', 'ABG-048', 'Dzn', 360, 17000, 1, 6120000, '2020-08-06 04:09:34', '2020-08-06 04:09:34'),
(23, 'SO-20080006', 'ABG-330', 'Dzn', 1152, 17000, 2, 19584000, '2020-08-06 04:09:34', '2020-08-06 04:09:34'),
(24, 'SO-20080006', 'ABG-331', 'Dzn', 864, 17000, 3, 14688000, '2020-08-06 04:09:34', '2020-08-06 04:09:34'),
(25, 'SO-20080006', 'ABG-056', 'Pcs', 34880, 145, 4, 5057600, '2020-08-06 04:09:34', '2020-08-06 04:09:34'),
(26, 'SO-20080007', 'ABG-044', 'Dzn', 2430, 17500, 1, 42525000, '2020-08-06 04:10:59', '2020-08-06 04:10:59'),
(27, 'SO-20080007', 'ABG-324', 'Dzn', 1890, 17500, 2, 33075000, '2020-08-06 04:10:59', '2020-08-06 04:10:59'),
(28, 'SO-20080007', 'ABG-325', 'Dzn', 1530, 17500, 3, 26775000, '2020-08-06 04:10:59', '2020-08-06 04:10:59'),
(29, 'SO-20080007', 'ART-013', 'Pcs', 1500, 11000, 4, 16500000, '2020-08-06 04:10:59', '2020-08-06 04:10:59'),
(30, 'SO-20080008', 'ABG-046', 'Dzn', 1170, 17500, 1, 20475000, '2020-08-06 04:12:30', '2020-08-06 04:12:30'),
(31, 'SO-20080008', 'ABG-326', 'Dzn', 540, 17500, 2, 9450000, '2020-08-06 04:12:30', '2020-08-06 04:12:30'),
(32, 'SO-20080008', 'ABG-327', 'Dzn', 870, 17500, 3, 15225000, '2020-08-06 04:12:30', '2020-08-06 04:12:30'),
(33, 'SO-20080009', 'ABG-045', 'Dzn', 1350, 17500, 1, 23625000, '2020-08-06 04:13:49', '2020-08-06 04:13:49'),
(34, 'SO-20080009', 'ABG-328', 'Dzn', 1830, 17500, 2, 32025000, '2020-08-06 04:13:49', '2020-08-06 04:13:49'),
(35, 'SO-20080009', 'ABG-329', 'Dzn', 900, 17500, 3, 15750000, '2020-08-06 04:13:49', '2020-08-06 04:13:49'),
(36, 'SO-20080010', 'ABG-045', 'Dzn', 1500, 17500, 1, 26250000, '2020-08-06 04:15:05', '2020-08-06 04:15:05'),
(37, 'SO-20080010', 'ABG-328', 'Dzn', 1500, 17500, 2, 26250000, '2020-08-06 04:15:05', '2020-08-06 04:15:05'),
(38, 'SO-20080010', 'ABG-329', 'Dzn', 390, 17500, 3, 6825000, '2020-08-06 04:15:05', '2020-08-06 04:15:05'),
(39, 'SO-20080011', 'ABG-018', 'Pcs', 8000, 3000, 1, 24000000, '2020-08-06 04:15:52', '2020-08-06 04:15:52'),
(40, 'SO-20080012', 'ABG-045', 'Dzn', 3330, 17500, 1, 58275000, '2020-08-06 04:17:04', '2020-08-06 04:17:04'),
(41, 'SO-20080012', 'ABG-328', 'Dzn', 1980, 17500, 2, 34650000, '2020-08-06 04:17:04', '2020-08-06 04:17:04'),
(42, 'SO-20080012', 'ABG-329', 'Dzn', 3060, 17500, 3, 53550000, '2020-08-06 04:17:04', '2020-08-06 04:17:04'),
(43, 'SO-20080013', 'ABG-055', 'Kg', 11613, 4500, 1, 52258500, '2020-08-06 04:18:09', '2020-08-06 04:18:09'),
(44, 'SO-20080014', 'ABG-055', 'Kg', 2685, 4500, 1, 12082500, '2020-08-06 04:18:47', '2020-08-06 04:18:47'),
(45, 'SO-20080015', 'ABG-328', 'Dzn', 1290, 17500, 1, 22575000, '2020-08-06 04:20:02', '2020-08-06 04:20:02'),
(46, 'SO-20080015', 'ABG-329', 'Dzn', 1470, 17500, 2, 25725000, '2020-08-06 04:20:02', '2020-08-06 04:20:02'),
(47, 'SO-20080015', 'ART-011', 'Pcs', 1500, 11000, 3, 16500000, '2020-08-06 04:20:02', '2020-08-06 04:20:02'),
(48, 'SO-20080016', 'SPR-001', 'Set', 5450, 7000, 1, 38150000, '2020-08-06 04:22:45', '2020-08-06 04:22:45'),
(49, 'SO-20080017', 'ABG-017', 'Set', 2000, 4100, 1, 8200000, '2020-08-06 04:23:48', '2020-08-06 04:23:48'),
(50, 'SO-20080017', 'ABG-018', 'Pcs', 5000, 3000, 2, 15000000, '2020-08-06 04:23:48', '2020-08-06 04:23:48'),
(51, 'SO-20080018', 'ART-020', 'Dzn', 2500, 6900, 1, 17250000, '2020-08-06 04:26:04', '2020-08-06 04:26:04'),
(52, 'SO-20080018', 'ART-021', 'Dzn', 1000, 6900, 2, 6900000, '2020-08-06 04:26:04', '2020-08-06 04:26:04'),
(53, 'SO-20080018', 'ART-023', 'Dzn', 1800, 6900, 3, 12420000, '2020-08-06 04:26:05', '2020-08-06 04:26:05'),
(54, 'SO-20080018', 'ART-005', 'Dzn', 2500, 6900, 4, 17250000, '2020-08-06 04:26:05', '2020-08-06 04:26:05'),
(55, 'SO-20080018', 'ART-024', 'Dzn', 3000, 6900, 5, 20700000, '2020-08-06 04:26:05', '2020-08-06 04:26:05'),
(56, 'SO-20080018', 'ART-019', 'Dzn', 3000, 6900, 6, 20700000, '2020-08-06 04:26:05', '2020-08-06 04:26:05'),
(57, 'SO-20080019', 'ART-020', 'Dzn', 1000, 6750, 1, 6750000, '2020-08-06 04:27:53', '2020-08-06 04:27:53'),
(58, 'SO-20080019', 'ART-021', 'Dzn', 500, 6750, 2, 3375000, '2020-08-06 04:27:53', '2020-08-06 04:27:53'),
(59, 'SO-20080019', 'ART-023', 'Dzn', 1000, 6750, 3, 6750000, '2020-08-06 04:27:53', '2020-08-06 04:27:53'),
(60, 'SO-20080019', 'ART-024', 'Dzn', 1000, 6750, 4, 6750000, '2020-08-06 04:27:53', '2020-08-06 04:27:53'),
(61, 'SO-20080019', 'ART-019', 'Dzn', 500, 6750, 5, 3375000, '2020-08-06 04:27:53', '2020-08-06 04:27:53'),
(62, 'SO-20080020', 'ART-020', 'Dzn', 100, 8250, 1, 825000, '2020-08-06 04:30:31', '2020-08-06 04:30:31'),
(63, 'SO-20080020', 'ART-021', 'Dzn', 100, 8250, 2, 825000, '2020-08-06 04:30:31', '2020-08-06 04:30:31'),
(64, 'SO-20080020', 'ART-023', 'Dzn', 100, 8250, 3, 825000, '2020-08-06 04:30:31', '2020-08-06 04:30:31'),
(65, 'SO-20080020', 'ART-018', 'Dzn', 100, 8250, 4, 825000, '2020-08-06 04:30:31', '2020-08-06 04:30:31'),
(66, 'SO-20080020', 'ART-022', 'Dzn', 100, 8250, 5, 825000, '2020-08-06 04:30:31', '2020-08-06 04:30:31'),
(67, 'SO-20080020', 'ART-005', 'Dzn', 100, 8250, 6, 825000, '2020-08-06 04:30:31', '2020-08-06 04:30:31'),
(68, 'SO-20080020', 'ART-024', 'Dzn', 100, 8250, 7, 825000, '2020-08-06 04:30:31', '2020-08-06 04:30:31'),
(69, 'SO-20080020', 'ART-019', 'Dzn', 100, 8250, 8, 825000, '2020-08-06 04:30:31', '2020-08-06 04:30:31'),
(70, 'SO-20080021', 'ABG-045', 'Dzn', 1380, 17500, 1, 24150000, '2020-08-06 04:32:03', '2020-08-06 04:32:03'),
(71, 'SO-20080021', 'ABG-328', 'Dzn', 870, 17500, 2, 15225000, '2020-08-06 04:32:03', '2020-08-06 04:32:03'),
(72, 'SO-20080021', 'ABG-329', 'Dzn', 210, 17500, 3, 3675000, '2020-08-06 04:32:03', '2020-08-06 04:32:03'),
(73, 'SO-20080021', 'ART-013', 'Pcs', 930, 11000, 4, 10230000, '2020-08-06 04:32:03', '2020-08-06 04:32:03'),
(74, 'SO-20080022', 'ABG-017', 'Set', 3500, 4100, 1, 14350000, '2020-08-06 04:33:03', '2020-08-06 04:33:03'),
(75, 'SO-20080023', 'ABG-044', 'Dzn', 2490, 17500, 1, 43575000, '2020-08-06 04:34:21', '2020-08-06 04:34:21'),
(76, 'SO-20080023', 'ABG-324', 'Dzn', 2550, 17500, 2, 44625000, '2020-08-06 04:34:21', '2020-08-06 04:34:21'),
(77, 'SO-20080023', 'ABG-325', 'Dzn', 4950, 17500, 3, 86625000, '2020-08-06 04:34:21', '2020-08-06 04:34:21'),
(78, 'SO-20080023', 'ART-013', 'Pcs', 3000, 11000, 4, 33000000, '2020-08-06 04:34:21', '2020-08-06 04:34:21'),
(79, 'SO-20080024', 'ABG-041', 'Dzn', 510, 16750, 1, 8542500, '2020-08-06 04:36:21', '2020-08-06 04:36:21'),
(80, 'SO-20080024', 'ABG-332', 'Dzn', 690, 16750, 2, 11557500, '2020-08-06 04:36:21', '2020-08-06 04:36:21'),
(81, 'SO-20080024', 'ABG-333', 'Dzn', 60, 16750, 3, 1005000, '2020-08-06 04:36:21', '2020-08-06 04:36:21'),
(82, 'SO-20080024', 'ABG-334', 'Dzn', 120, 16750, 4, 2010000, '2020-08-06 04:36:21', '2020-08-06 04:36:21'),
(83, 'SO-20080025', 'ABG-046', 'Dzn', 870, 17500, 1, 15225000, '2020-08-06 04:40:01', '2020-08-06 04:40:01'),
(84, 'SO-20080025', 'ABG-326', 'Dzn', 930, 17500, 2, 16275000, '2020-08-06 04:40:01', '2020-08-06 04:40:01'),
(85, 'SO-20080025', 'ABG-327', 'Dzn', 1770, 17500, 3, 30975000, '2020-08-06 04:40:02', '2020-08-06 04:40:02'),
(86, 'SO-20080026', 'ABG-017', 'Set', 2000, 4450, 1, 8900000, '2020-08-06 04:45:47', '2020-08-06 04:45:47'),
(87, 'SO-20080026', 'ABG-018', 'Pcs', 5000, 3000, 2, 15000000, '2020-08-06 04:45:47', '2020-08-06 04:45:47'),
(88, 'SO-20080026', 'ABG-020', 'Pcs', 1000, 4000, 3, 4000000, '2020-08-06 04:45:47', '2020-08-06 04:45:47'),
(89, 'SO-20080026', 'ABG-021', 'Pcs', 1000, 4000, 4, 4000000, '2020-08-06 04:45:47', '2020-08-06 04:45:47'),
(90, 'SO-20080027', 'ABG-046', 'Dzn', 1560, 17500, 1, 27300000, '2020-08-06 04:48:15', '2020-08-06 04:48:15'),
(91, 'SO-20080027', 'ABG-326', 'Dzn', 1800, 17500, 2, 31500000, '2020-08-06 04:48:15', '2020-08-06 04:48:15'),
(92, 'SO-20080027', 'ABG-327', 'Dzn', 2880, 17500, 3, 50400000, '2020-08-06 04:48:15', '2020-08-06 04:48:15'),
(93, 'SO-20080028', 'ART-011', 'Pcs', 1410, 11000, 1, 15510000, '2020-08-06 04:49:28', '2020-08-06 04:49:28'),
(94, 'SO-20080028', 'ART-013', 'Pcs', 1500, 11000, 2, 16500000, '2020-08-06 04:49:28', '2020-08-06 04:49:28'),
(95, 'SO-20080029', 'ABG-048', 'Dzn', 972, 17000, 1, 16524000, '2020-08-06 04:50:53', '2020-08-06 04:50:53'),
(96, 'SO-20080029', 'ABG-330', 'Dzn', 1044, 17000, 2, 17748000, '2020-08-06 04:50:53', '2020-08-06 04:50:53'),
(97, 'SO-20080029', 'ABG-331', 'Dzn', 1044, 17000, 3, 17748000, '2020-08-06 04:50:53', '2020-08-06 04:50:53'),
(98, 'SO-20080030', 'ABG-044', 'Dzn', 510, 17500, 1, 8925000, '2020-08-06 04:53:47', '2020-08-06 04:53:47'),
(99, 'SO-20080030', 'ABG-324', 'Dzn', 450, 17500, 2, 7875000, '2020-08-06 04:53:47', '2020-08-06 04:53:47'),
(100, 'SO-20080030', 'ABG-325', 'Dzn', 1500, 17500, 3, 26250000, '2020-08-06 04:53:47', '2020-08-06 04:53:47'),
(101, 'SO-20080030', 'ABG-050', 'Dzn', 90, 26000, 4, 2340000, '2020-08-06 04:53:47', '2020-08-06 04:53:47'),
(102, 'SO-20080031', 'ART-021', 'Dzn', 500, 6750, 1, 3375000, '2020-08-06 04:55:08', '2020-08-06 04:55:08'),
(103, 'SO-20080031', 'ART-005', 'Dzn', 2500, 6750, 2, 16875000, '2020-08-06 04:55:08', '2020-08-06 04:55:08'),
(104, 'SO-20080031', 'ART-019', 'Dzn', 1000, 6750, 3, 6750000, '2020-08-06 04:55:08', '2020-08-06 04:55:08'),
(105, 'SO-20080032', 'ABG-020', 'Pcs', 3250, 4000, 1, 13000000, '2020-08-06 04:56:12', '2020-08-06 04:56:12'),
(106, 'SO-20080032', 'ABG-021', 'Pcs', 3250, 4000, 2, 13000000, '2020-08-06 04:56:12', '2020-08-06 04:56:12'),
(107, 'SO-20080032', 'ABG-017', 'Set', 3500, 4100, 3, 14350000, '2020-08-06 04:56:12', '2020-08-06 04:56:12'),
(108, 'SO-20080032', 'ABG-018', 'Pcs', 3000, 3000, 4, 9000000, '2020-08-06 04:56:12', '2020-08-06 04:56:12'),
(109, 'SO-20080033', 'ABG-047', 'Dzn', 1710, 17500, 1, 29925000, '2020-08-06 04:58:16', '2020-08-06 04:58:16'),
(110, 'SO-20080033', 'ABG-322', 'Dzn', 2640, 17500, 2, 46200000, '2020-08-06 04:58:16', '2020-08-06 04:58:16'),
(111, 'SO-20080033', 'ABG-323', 'Dzn', 2520, 17500, 3, 44100000, '2020-08-06 04:58:16', '2020-08-06 04:58:16'),
(112, 'SO-20080034', 'ART-013', 'Pcs', 2250, 11000, 1, 24750000, '2020-08-06 04:58:56', '2020-08-06 04:58:56'),
(113, 'SO-20080035', 'ABG-057', 'Kg', 10100, 4500, 1, 45450000, '2020-08-06 04:59:41', '2020-08-06 04:59:41'),
(114, 'SO-20080036', 'ABG-324', 'Dzn', 3000, 17500, 1, 52500000, '2020-08-06 06:03:44', '2020-08-06 06:03:44'),
(115, 'SO-20080036', 'ABG-044', 'Dzn', 4530, 17500, 2, 79275000, '2020-08-06 06:03:44', '2020-08-06 06:03:44'),
(116, 'SO-20080036', 'ABG-325', 'Dzn', 1830, 17500, 3, 32025000, '2020-08-06 06:03:44', '2020-08-06 06:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaanbarangdetails`
--

CREATE TABLE `penerimaanbarangdetails` (
  `id` bigint(20) NOT NULL,
  `KodePenerimaanBarang` varchar(100) NOT NULL,
  `KodeItem` varchar(100) NOT NULL,
  `KodeSatuan` varchar(100) DEFAULT NULL,
  `Harga` double DEFAULT NULL,
  `Qty` double NOT NULL,
  `Keterangan` varchar(100) DEFAULT NULL,
  `NoUrut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerimaanbarangreturndetails`
--

CREATE TABLE `penerimaanbarangreturndetails` (
  `id` bigint(20) NOT NULL,
  `KodePenerimaanBarangReturn` varchar(100) NOT NULL,
  `KodeItem` varchar(100) NOT NULL,
  `KodeSatuan` varchar(100) DEFAULT NULL,
  `Harga` double DEFAULT NULL,
  `Qty` double NOT NULL,
  `Keterangan` varchar(100) DEFAULT NULL,
  `NoUrut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerimaanbarangreturns`
--

CREATE TABLE `penerimaanbarangreturns` (
  `id` bigint(20) NOT NULL,
  `KodePenerimaanBarangReturn` varchar(100) NOT NULL,
  `Tanggal` date NOT NULL,
  `Status` varchar(100) NOT NULL,
  `KodeUser` varchar(100) NOT NULL,
  `KodeLokasi` varchar(100) NOT NULL,
  `KodeSupplier` varchar(100) NOT NULL,
  `Total` double NOT NULL,
  `PPN` varchar(100) NOT NULL,
  `NilaiPPN` double NOT NULL,
  `Printed` double NOT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `Subtotal` double NOT NULL,
  `KodePenerimaanBarang` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerimaanbarangs`
--

CREATE TABLE `penerimaanbarangs` (
  `id` bigint(20) NOT NULL,
  `KodePenerimaanBarang` varchar(100) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeLokasi` varchar(100) NOT NULL,
  `KodeMataUang` varchar(100) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `KodeUser` varchar(100) DEFAULT NULL,
  `Total` double NOT NULL,
  `PPN` varchar(100) NOT NULL,
  `NilaiPPN` double NOT NULL,
  `Printed` double DEFAULT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `Subtotal` double NOT NULL,
  `KodeSupplier` varchar(100) NOT NULL,
  `KodePO` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluarantambahans`
--

CREATE TABLE `pengeluarantambahans` (
  `id` int(11) NOT NULL,
  `Nama` varchar(191) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeLokasi` varchar(191) NOT NULL,
  `KodeMataUang` varchar(191) NOT NULL,
  `Total` double NOT NULL,
  `KodeUser` varchar(191) NOT NULL,
  `Keterangan` varchar(191) DEFAULT NULL,
  `Status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penggunas`
--

CREATE TABLE `penggunas` (
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TanggalDaftar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Aktif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualanlangsungdetails`
--

CREATE TABLE `penjualanlangsungdetails` (
  `id` int(11) NOT NULL,
  `KodePenjualanLangsung` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qty` double NOT NULL,
  `Harga` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoUrut` int(11) NOT NULL,
  `Subtotal` double NOT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualanlangsungreturndetails`
--

CREATE TABLE `penjualanlangsungreturndetails` (
  `KodePenjualanLangsungReturn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qty` double NOT NULL,
  `Harga` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoUrut` int(11) NOT NULL,
  `Subtotal` double NOT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualanlangsungreturns`
--

CREATE TABLE `penjualanlangsungreturns` (
  `KodePenjualanLangsungReturn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` datetime NOT NULL,
  `KodePenjualanLangsung` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` double NOT NULL,
  `PPN` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NilaiPPN` double NOT NULL,
  `Printed` double NOT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `Subtotal` double NOT NULL,
  `KodePelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoIndeks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualanlangsungs`
--

CREATE TABLE `penjualanlangsungs` (
  `KodePenjualanLangsung` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` double NOT NULL,
  `PPN` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NilaiPPN` double NOT NULL,
  `Printed` double NOT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `Subtotal` double NOT NULL,
  `KodePelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoIndeks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pindahgudangdetails`
--

CREATE TABLE `pindahgudangdetails` (
  `KodePindah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qty` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoUrut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pindahgudangs`
--

CREATE TABLE `pindahgudangs` (
  `KodePindah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DariLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` datetime NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `piutangs`
--

CREATE TABLE `piutangs` (
  `KodePiutang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` datetime NOT NULL,
  `KodePelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSuratJalan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Jumlah` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Term` double NOT NULL,
  `Koreksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kembali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `KodeSales` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaSales` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kontak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Handphone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIK` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satuans`
--

CREATE TABLE `satuans` (
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuans`
--

INSERT INTO `satuans` (`KodeSatuan`, `NamaSatuan`, `Status`, `KodeUser`, `created_at`, `updated_at`) VALUES
('Batang', 'Btg', 'DEL', 'admin', '2020-07-16 01:18:02', '2020-07-16 01:32:55'),
('Btg', 'Batang', 'OPN', 'admin', '2020-07-16 01:33:07', '2020-07-16 01:33:07'),
('Ctn', 'Carton', 'OPN', 'admin', '2020-07-14 05:22:44', '2020-07-14 05:23:30'),
('Drum', 'Drum', 'OPN', 'admin', '2020-07-16 01:41:49', '2020-07-16 01:41:49'),
('Dzn', 'Dozen', 'OPN', 'admin', '2020-07-13 04:41:04', '2020-07-13 04:41:04'),
('Kg', 'Kilogram', 'OPN', 'admin', '2020-07-14 04:55:38', '2020-07-14 04:55:38'),
('Ltr', 'Liter', 'OPN', 'admin', '2020-07-16 02:41:30', '2020-07-16 02:41:30'),
('M3', 'Volume', 'OPN', 'admin', '2020-07-16 01:33:21', '2020-07-16 01:33:21'),
('pack', 'Package', 'OPN', 'admin', '2020-07-16 02:47:17', '2020-07-16 02:47:17'),
('Pcs', 'Pieces', 'OPN', 'admin', '2020-07-13 04:41:20', '2020-07-16 03:03:27'),
('Roll', 'Gulung', 'OPN', 'admin', '2020-07-16 03:03:18', '2020-07-16 03:03:18'),
('Set', 'Set', 'OPN', 'admin', '2020-07-14 02:57:50', '2020-07-14 02:57:50'),
('Tab', 'Tabung', 'OPN', 'admin', '2020-07-16 01:41:59', '2020-07-16 01:41:59'),
('Unit', 'Unit', 'OPN', 'admin', '2020-07-16 02:53:01', '2020-07-16 02:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `stokkeluardetails`
--

CREATE TABLE `stokkeluardetails` (
  `KodeStokKeluar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qty` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoUrut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stokkeluars`
--

CREATE TABLE `stokkeluars` (
  `KodeStokKeluar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` datetime NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TotalItem` double NOT NULL,
  `Printed` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stokmasukdetails`
--

CREATE TABLE `stokmasukdetails` (
  `KodeStokMasuk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qty` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoUrut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stokmasuks`
--

CREATE TABLE `stokmasuks` (
  `KodeStokMasuk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TotalItem` double NOT NULL,
  `Printed` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `KodeSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kontak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Handphone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIK` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kota` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Provinsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Negara` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`KodeSupplier`, `NamaSupplier`, `Kontak`, `Handphone`, `Email`, `NIK`, `Status`, `KodeLokasi`, `KodeUser`, `Alamat`, `Kota`, `Provinsi`, `Negara`, `created_at`, `updated_at`) VALUES
('SUP-001', 'Adam Poultry Equipment', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-13 04:45:53', '2020-07-14 03:48:15'),
('SUP-002', 'Ayoda Jaya', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:48:26', '2020-07-14 03:48:26'),
('SUP-003', 'Bengkel Harapan (Bapak Adong)', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', 'Malang', NULL, NULL, '2020-07-14 03:48:37', '2020-08-06 02:59:34'),
('SUP-004', 'Bengkel Harapan', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:48:48', '2020-07-14 03:48:48'),
('SUP-005', 'Benny', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:48:58', '2020-07-14 03:48:58'),
('SUP-006', 'Bright Chemical', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:49:12', '2020-07-14 03:49:12'),
('SUP-007', 'Cipta Pesona Indah', '(0341) 426186 - 426771', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Dr. Wahidin No. 33 - 35', 'Lawang', NULL, NULL, '2020-07-14 03:49:24', '2020-08-06 02:41:52'),
('SUP-008', 'CV Asia Tehnik', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Melati Blok Kav-C No. 32A', 'Malang', NULL, NULL, '2020-07-14 03:49:37', '2020-08-06 03:47:40'),
('SUP-009', 'CV Cahaya Mustika', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:49:57', '2020-07-14 03:49:57'),
('SUP-010', 'CV Karunia Teknik Persada', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Perum Chandra Kirana Blok F No. 18, Watugede', 'Malang', NULL, NULL, '2020-07-14 03:50:12', '2020-08-06 03:45:52'),
('SUP-011', 'CV Karya Indah Gemilang', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Rungkut Asri Utara XIX Kav-65 Kalirungkut, Rungkut', 'Surabaya', NULL, NULL, '2020-07-14 03:50:31', '2020-08-06 02:47:25'),
('SUP-012', 'CV Roda Mas', '(031) 99031815', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Taman Pondok Jati AL - 2A Taman, Sepanjang', 'Sidoarjo', NULL, NULL, '2020-07-14 03:50:41', '2020-08-06 03:13:19'),
('SUP-013', 'CV Sakti Putra Perdana', '(0341) 320219 - 325927', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Ade Irma Suryani No. 19D', 'Malang', NULL, NULL, '2020-07-14 03:51:49', '2020-08-06 02:51:44'),
('SUP-014', 'Sinar Mandiri Jakarta', '081382121790', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', 'Jakarta', NULL, NULL, '2020-07-14 03:52:30', '2020-08-06 03:01:19'),
('SUP-015', 'PT Dwijaya Sentosa Abadi', '(031) 7483912', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Tanjungsari 24, Sukomanunggal', 'Surabaya', NULL, NULL, '2020-07-14 03:52:38', '2020-08-06 02:37:30'),
('SUP-016', 'Erwin Parengkoan', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:52:51', '2020-07-14 03:52:51'),
('SUP-017', 'Fery', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:53:00', '2020-07-14 03:53:00'),
('SUP-018', 'Gunung Subur', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:53:08', '2020-07-14 03:53:08'),
('SUP-019', 'PT Halim Sarana Cahaya Semesta', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:53:29', '2020-07-14 03:58:07'),
('SUP-020', 'Jaya Mandiri Offset', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:53:43', '2020-07-14 03:53:43'),
('SUP-021', 'Mahkota', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:54:09', '2020-07-14 03:54:09'),
('SUP-022', 'PT Mapalus Prima Utama', '(0341) 493602', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Raden Panji Suroso No. 5', 'Malang', NULL, NULL, '2020-07-14 03:54:21', '2020-08-06 02:43:04'),
('SUP-023', 'PT Mega Suksesindo Sejati', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Tembaga No. 3-C', 'Malang', NULL, NULL, '2020-07-14 03:54:35', '2020-08-06 03:05:46'),
('SUP-024', 'Most', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', 'Surabaya', NULL, NULL, '2020-07-14 03:54:42', '2020-08-06 02:43:38'),
('SUP-025', 'PT Mitra Optima Valve (Move)', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Hangtuah 4-C, Ujung', 'Surabaya', NULL, NULL, '2020-07-14 03:54:49', '2020-08-06 03:07:16'),
('SUP-026', 'Online', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:55:01', '2020-07-14 03:55:01'),
('SUP-027', 'Pelangi', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:55:20', '2020-07-14 03:55:20'),
('SUP-028', 'Penghela', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', 'Surabaya', NULL, NULL, '2020-07-14 03:55:32', '2020-08-06 02:58:38'),
('SUP-029', 'Pertiwi', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:55:39', '2020-07-14 03:55:39'),
('SUP-030', 'PT Hsin Mao Indonesia', '(0321) 6818265', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Kawasan Industri Ngoro Industri Persada Kav. J 7A, Ngoro', 'Mojokerto', NULL, NULL, '2020-07-14 03:55:52', '2020-08-06 02:50:31'),
('SUP-031', 'PT Alimindus Chemicals', '(031) 5664031 - 5661325', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Simo Gunung Barat I No. 46', 'Surabaya', NULL, NULL, '2020-07-14 03:56:41', '2020-08-06 02:22:34'),
('SUP-032', 'PT Duta Bangsa Mandiri', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:57:19', '2020-07-14 03:57:19'),
('SUP-033', 'PT Farrasindo', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:57:30', '2020-07-14 03:57:30'),
('SUP-034', 'PT Jotun Indonesia', '(021) 89982657', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Kawasan Industri MM2100 Blok KK-1, Cikarang Barat', 'Bekasi', NULL, NULL, '2020-07-14 03:59:16', '2020-08-06 02:45:44'),
('SUP-035', 'PT Karunia Sejahtera Trans', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:59:30', '2020-07-14 03:59:30'),
('SUP-036', 'PT Karya Bintang Baru', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 03:59:47', '2020-07-14 03:59:47'),
('SUP-037', 'PT Mitra Optima Valve', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:00:03', '2020-07-14 04:00:03'),
('SUP-038', 'PT Multi Bangun Sejahtera', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:00:18', '2020-07-14 04:00:18'),
('SUP-039', 'PT Oxyplast Indonesia', '(0343) 656886', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Raya Beji - Bangil Km 4 ( Dari Gerbang Tol Gempol) Desa Cangkringmalang, Beji', 'Pasuruan', NULL, NULL, '2020-07-14 04:00:32', '2020-08-06 02:54:04'),
('SUP-040', 'PT Persada Wijaya Sentosa', '(031) 7318174', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Kupang Jaya A I/28 Simomulyo, Sukomanunggal', 'Surabaya', NULL, NULL, '2020-07-14 04:01:07', '2020-08-06 02:55:36'),
('SUP-041', 'PT Silvery Dragon', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Yos Sudarso Kav.48 Blok C No.2A Sungai Bambu, Tanjung Priok', 'Jakarta Utara', NULL, NULL, '2020-07-14 04:01:19', '2020-08-06 02:48:48'),
('SUP-042', 'PT Sumber Urip Cargo', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:01:31', '2020-07-14 04:01:31'),
('SUP-043', 'PT Surya Beton Indonesia', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:01:50', '2020-07-14 04:01:50'),
('SUP-044', 'PT Sutindo Surya Sejahtera', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:02:06', '2020-07-14 04:02:06'),
('SUP-045', 'Purnama', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:02:16', '2020-07-14 04:02:16'),
('SUP-046', 'PT Indo Kompresigma', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Outer Ring Road No. 65, Kembangan Utara', 'Jakarta Barat', NULL, NULL, '2020-07-14 04:02:24', '2020-08-06 03:50:09'),
('SUP-047', 'Roda Multi Kencana', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:02:35', '2020-07-14 04:02:35'),
('SUP-048', 'PT Sinar Mas Baja Perkasa', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Sutan Syahrir 109-A, Kasin', 'Malang', NULL, NULL, '2020-07-14 04:02:43', '2020-08-06 03:42:30'),
('SUP-049', 'Soekardi', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:02:59', '2020-07-14 04:02:59'),
('SUP-050', 'Sukses Makmur', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:03:11', '2020-07-14 04:03:11'),
('SUP-051', 'Sumber Jaya Olie', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:03:23', '2020-07-14 04:03:23'),
('SUP-052', 'Sumber Makmur', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:03:31', '2020-07-14 04:03:31'),
('SUP-053', 'Sumber Rejeki', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:03:40', '2020-07-14 04:03:40'),
('SUP-054', 'UCP Bedali', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', 'Malang', NULL, NULL, '2020-07-14 04:03:53', '2020-07-14 04:03:53'),
('SUP-055', 'UD Ria Abadi Spring', '085731212199 / (031) 7911782 - 7911937', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', 'Surabaya', NULL, NULL, '2020-07-14 04:04:15', '2020-08-06 02:57:48'),
('SUP-056', 'PT Unison Indonesia Industrial', '(031) 7498500', NULL, NULL, NULL, 'OPN', NULL, 'admin', 'Jalan Margomulyo 5C', 'Surabaya', NULL, NULL, '2020-07-14 04:04:26', '2020-08-06 02:39:49'),
('SUP-057', 'Wijaya Pratama', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:04:54', '2020-07-14 04:04:54'),
('SUP-058', 'Young Perdana Jaya', '0', NULL, NULL, NULL, 'OPN', NULL, 'admin', '-', '-', NULL, NULL, '2020-07-14 04:05:09', '2020-07-14 04:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `suratjalandetails`
--

CREATE TABLE `suratjalandetails` (
  `id` int(11) NOT NULL,
  `KodeSuratJalan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeItem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeSatuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Qty` double NOT NULL,
  `Harga` double NOT NULL,
  `Keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NoUrut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suratjalanreturndetails`
--

CREATE TABLE `suratjalanreturndetails` (
  `KodeSuratJalanReturnID` int(11) NOT NULL,
  `KodeSuratJalanReturn` varchar(191) NOT NULL,
  `KodeSuratJalan` varchar(191) DEFAULT NULL,
  `KodeItem` varchar(191) NOT NULL,
  `KodeSatuan` varchar(191) DEFAULT NULL,
  `Harga` double DEFAULT NULL,
  `Qty` int(11) NOT NULL,
  `Keterangan` varchar(191) DEFAULT NULL,
  `NoUrut` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suratjalanreturns`
--

CREATE TABLE `suratjalanreturns` (
  `KodeSuratJalanReturnID` int(11) NOT NULL,
  `KodeSuratJalanReturn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` double NOT NULL,
  `PPN` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NilaiPPN` double NOT NULL,
  `Printed` double NOT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `Subtotal` double NOT NULL,
  `KodeSuratJalanID` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KodeSuratJalan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suratjalans`
--

CREATE TABLE `suratjalans` (
  `KodeSuratJalanID` bigint(20) UNSIGNED NOT NULL,
  `KodeSuratJalan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeLokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeMataUang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KodeUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` double NOT NULL,
  `PPN` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NilaiPPN` double NOT NULL,
  `Printed` double NOT NULL,
  `Diskon` double NOT NULL,
  `NilaiDiskon` double NOT NULL,
  `Subtotal` double NOT NULL,
  `KodePelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoIndeks` int(11) NOT NULL,
  `Alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KodeSopir` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nopol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoFaktur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `KodeSO` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `lokasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `fullname`, `email`, `email_verified_at`, `lokasi`, `last_login`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'Admin', 'admin@gmail.com', NULL, 'DRAGON', '2020-08-06 06:20:21', 'OPN', '$2y$10$cNURO2RX4Xbnl2iUDlJLXO3ntAPVvphgJeEUj2BJeYdpr.CrXkkfK', NULL, '2020-07-13 04:19:32', '2020-08-06 06:20:21'),
(3, 'user', 'user', NULL, NULL, 'Dragon', '2020-07-13 04:34:08', 'DEL', '$2y$10$HrhhJsrFDth2MZB2Ffx75Ocl1D3tEFepfgWDYjddtL35Uc8MYvIRy', NULL, '2020-07-13 04:33:46', '2020-07-13 04:34:08'),
(4, 'lili', 'Lili', NULL, NULL, 'GUDANG GRENDEL', '2020-07-23 08:14:15', 'OPN', '$2y$10$NiPScp/jCrqTeeozwqA3sumisDce9jlw5qKd..7BbeLtSpvmex8e.', NULL, '2020-07-23 08:13:54', '2020-07-23 08:14:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamatpelanggans`
--
ALTER TABLE `alamatpelanggans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventlogs`
--
ALTER TABLE `eventlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoicehutangdetails`
--
ALTER TABLE `invoicehutangdetails`
  ADD PRIMARY KEY (`KodeHutang`);

--
-- Indexes for table `invoicehutangs`
--
ALTER TABLE `invoicehutangs`
  ADD PRIMARY KEY (`KodeInvoiceHutang`);

--
-- Indexes for table `invoicepiutangdetails`
--
ALTER TABLE `invoicepiutangdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoicepiutangs`
--
ALTER TABLE `invoicepiutangs`
  ADD PRIMARY KEY (`KodeInvoicePiutang`);

--
-- Indexes for table `itemkonversis`
--
ALTER TABLE `itemkonversis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`KodeItem`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kasbanks`
--
ALTER TABLE `kasbanks`
  ADD PRIMARY KEY (`KodeKasBankID`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`KodeKategori`);

--
-- Indexes for table `keluarmasukbarangs`
--
ALTER TABLE `keluarmasukbarangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasis`
--
ALTER TABLE `lokasis`
  ADD PRIMARY KEY (`KodeLokasi`);

--
-- Indexes for table `matauangs`
--
ALTER TABLE `matauangs`
  ADD PRIMARY KEY (`KodeMataUang`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`KodePelanggan`);

--
-- Indexes for table `pelunasanhutangs`
--
ALTER TABLE `pelunasanhutangs`
  ADD PRIMARY KEY (`KodePelunasanHutangID`);

--
-- Indexes for table `pelunasanpiutangs`
--
ALTER TABLE `pelunasanpiutangs`
  ADD PRIMARY KEY (`KodePelunasanPiutangID`);

--
-- Indexes for table `pemesananpembeliandetails`
--
ALTER TABLE `pemesananpembeliandetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesananpembelians`
--
ALTER TABLE `pemesananpembelians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesananpenjualans`
--
ALTER TABLE `pemesananpenjualans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `KodeSO` (`KodeSO`) USING BTREE;

--
-- Indexes for table `pemesanan_penjualan_detail`
--
ALTER TABLE `pemesanan_penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerimaanbarangdetails`
--
ALTER TABLE `penerimaanbarangdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerimaanbarangreturndetails`
--
ALTER TABLE `penerimaanbarangreturndetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerimaanbarangreturns`
--
ALTER TABLE `penerimaanbarangreturns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerimaanbarangs`
--
ALTER TABLE `penerimaanbarangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluarantambahans`
--
ALTER TABLE `pengeluarantambahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penggunas`
--
ALTER TABLE `penggunas`
  ADD PRIMARY KEY (`KodeUser`);

--
-- Indexes for table `penjualanlangsungdetails`
--
ALTER TABLE `penjualanlangsungdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualanlangsungs`
--
ALTER TABLE `penjualanlangsungs`
  ADD PRIMARY KEY (`KodePenjualanLangsung`);

--
-- Indexes for table `satuans`
--
ALTER TABLE `satuans`
  ADD PRIMARY KEY (`KodeSatuan`);

--
-- Indexes for table `stokkeluardetails`
--
ALTER TABLE `stokkeluardetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stokkeluars`
--
ALTER TABLE `stokkeluars`
  ADD PRIMARY KEY (`KodeStokKeluar`);

--
-- Indexes for table `stokmasukdetails`
--
ALTER TABLE `stokmasukdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stokmasuks`
--
ALTER TABLE `stokmasuks`
  ADD PRIMARY KEY (`KodeStokMasuk`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`KodeSupplier`);

--
-- Indexes for table `suratjalandetails`
--
ALTER TABLE `suratjalandetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suratjalanreturndetails`
--
ALTER TABLE `suratjalanreturndetails`
  ADD PRIMARY KEY (`KodeSuratJalanReturnID`);

--
-- Indexes for table `suratjalanreturns`
--
ALTER TABLE `suratjalanreturns`
  ADD PRIMARY KEY (`KodeSuratJalanReturnID`);

--
-- Indexes for table `suratjalans`
--
ALTER TABLE `suratjalans`
  ADD PRIMARY KEY (`KodeSuratJalanID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamatpelanggans`
--
ALTER TABLE `alamatpelanggans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `eventlogs`
--
ALTER TABLE `eventlogs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `invoicehutangdetails`
--
ALTER TABLE `invoicehutangdetails`
  MODIFY `KodeHutang` int(191) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicehutangs`
--
ALTER TABLE `invoicehutangs`
  MODIFY `KodeInvoiceHutang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicepiutangdetails`
--
ALTER TABLE `invoicepiutangdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicepiutangs`
--
ALTER TABLE `invoicepiutangs`
  MODIFY `KodeInvoicePiutang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itemkonversis`
--
ALTER TABLE `itemkonversis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kasbanks`
--
ALTER TABLE `kasbanks`
  MODIFY `KodeKasBankID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keluarmasukbarangs`
--
ALTER TABLE `keluarmasukbarangs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelunasanhutangs`
--
ALTER TABLE `pelunasanhutangs`
  MODIFY `KodePelunasanHutangID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelunasanpiutangs`
--
ALTER TABLE `pelunasanpiutangs`
  MODIFY `KodePelunasanPiutangID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesananpembeliandetails`
--
ALTER TABLE `pemesananpembeliandetails`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesananpembelians`
--
ALTER TABLE `pemesananpembelians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesananpenjualans`
--
ALTER TABLE `pemesananpenjualans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pemesanan_penjualan_detail`
--
ALTER TABLE `pemesanan_penjualan_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `penerimaanbarangdetails`
--
ALTER TABLE `penerimaanbarangdetails`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penerimaanbarangreturndetails`
--
ALTER TABLE `penerimaanbarangreturndetails`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penerimaanbarangreturns`
--
ALTER TABLE `penerimaanbarangreturns`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penerimaanbarangs`
--
ALTER TABLE `penerimaanbarangs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengeluarantambahans`
--
ALTER TABLE `pengeluarantambahans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualanlangsungdetails`
--
ALTER TABLE `penjualanlangsungdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stokkeluardetails`
--
ALTER TABLE `stokkeluardetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stokmasukdetails`
--
ALTER TABLE `stokmasukdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suratjalandetails`
--
ALTER TABLE `suratjalandetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suratjalanreturndetails`
--
ALTER TABLE `suratjalanreturndetails`
  MODIFY `KodeSuratJalanReturnID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suratjalanreturns`
--
ALTER TABLE `suratjalanreturns`
  MODIFY `KodeSuratJalanReturnID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suratjalans`
--
ALTER TABLE `suratjalans`
  MODIFY `KodeSuratJalanID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
