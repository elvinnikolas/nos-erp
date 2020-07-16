-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 16, 2020 at 03:51 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp`
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
(1, 'admin', '2020-07-16', '20:46:06', 'Tambah gudang GUD-001', 'OPN', '2020-07-16 13:46:06', '2020-07-16 13:46:06');

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
  `saldo` int(11) DEFAULT '0',
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
('GUD-001', 'Dragon', 'INV', 'OPN', 'admin', '2020-07-16 13:46:06', '2020-07-16 13:46:06');

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
  `Diskon` double DEFAULT NULL,
  `NilaiDiskon` double DEFAULT NULL,
  `Subtotal` double DEFAULT NULL,
  `KodePelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Expired` double DEFAULT NULL,
  `KodeSales` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `POPelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `term` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 'admin', NULL, 'admin@gmail.com', NULL, NULL, NULL, '', '$2y$10$rbDMkhhMtqfU/h5y5eQFIehRj25DsFjwrqNubuy9kyDETPo6DdlO2', NULL, '2020-07-16 13:45:41', '2020-07-16 13:45:41');

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
  ADD PRIMARY KEY (`KodeSO`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventlogs`
--
ALTER TABLE `eventlogs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `pemesanan_penjualan_detail`
--
ALTER TABLE `pemesanan_penjualan_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
