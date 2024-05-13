-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 08:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rme`
--

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stok` bigint(20) NOT NULL,
  `dosis` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `name`, `stok`, `dosis`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol', 100, '2xmakan', '2024-05-13 03:14:36', '2024-05-13 03:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `no_rm` varchar(255) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `no_kk` varchar(255) DEFAULT NULL,
  `jenis_pasien` enum('bpjs','umum') NOT NULL,
  `no_jkn` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('l','p') DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `status_pernikahan` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `nomor_antrian` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `name`, `no_rm`, `nik`, `no_kk`, `jenis_pasien`, `no_jkn`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `no_hp`, `no_telp`, `alamat`, `pendidikan`, `pekerjaan`, `status_pernikahan`, `user_id`, `nomor_antrian`, `created_at`, `updated_at`) VALUES
(2, 'Rifjan', '000001', '3574042905000001', '3574041505080026', 'bpjs', '12412', '1970-01-01', 'l', 'hindu', '083846997665', '0912513', 'qwrqr', 'sltp', 'Mahasiswa', '1', 0, 1, '2024-05-13 12:30:50', NULL),
(4, 'qwtq', '000002', '3574042905000003', '3574041505080026', 'bpjs', '124124', '1970-01-01', 'l', 'islam', '089516325685', '124124', 'qwrqwr', 'sltp', 'Mahasiswa', '1', 0, NULL, '2024-05-13 13:04:28', NULL),
(5, 'qwtq', '000003', '3574042905000003', '3574041505080026', 'bpjs', '124124', '1970-01-01', 'l', 'islam', '089516325685', '124124', 'qwrqwr', 'sltp', 'Mahasiswa', '1', 0, NULL, '2024-05-13 13:06:51', NULL),
(6, 'Rifjan', '000004', '3574042905000003', '3574041505080026', 'umum', '', '1970-01-01', 'l', 'kristen', '083846997665', '089516235685', 'afasf', 'slta', 'Petani', '1', 0, 2, '2024-05-13 13:12:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('rm','dokter','admin','perawat','kepala') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(0, 'Rifjan', 'admin', '$2y$10$sJB2A.KkZaaeN5INZ42ZC.4cJrRLgZMlijhI/N6C7CPYAs0PBafci', 'admin', NULL, '2024-05-10 08:02:44'),
(1, 'rifjan', 'admin', '$2y$10$77mXYZZUVIS5ZIN7RB/oN.rl63oNKPutUnbooOss/OSWytRtjDsDe', 'admin', '2024-05-09 05:01:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=666;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
