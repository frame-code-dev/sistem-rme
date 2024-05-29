-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 09:33 AM
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
  `satuan` varchar(20) DEFAULT NULL,
  `stok` bigint(20) NOT NULL,
  `penerimaan_stok` bigint(20) DEFAULT 0,
  `dosis` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `no_rm` varchar(20) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `no_kk` varchar(16) DEFAULT NULL,
  `jenis_pasien` enum('bpjs','umum') NOT NULL,
  `no_jkn` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('l','p') DEFAULT NULL,
  `agama` varchar(100) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `status_pernikahan` varchar(100) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `nomor_antrian` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan_pasien`
--

CREATE TABLE `pemeriksaan_pasien` (
  `id` bigint(20) NOT NULL,
  `pasien_id` bigint(20) NOT NULL,
  `keluhan_utama` text DEFAULT NULL,
  `riwayat_penyakit_sekarang` text DEFAULT NULL,
  `riwayat_penyakit_dahulu` text DEFAULT NULL,
  `riwayat_pengobatan` text DEFAULT NULL,
  `tekanan_darah` bigint(20) DEFAULT NULL,
  `nadi` bigint(20) DEFAULT NULL,
  `suhu` bigint(20) DEFAULT NULL,
  `rr` bigint(20) DEFAULT NULL,
  `tinggi_badan` bigint(20) DEFAULT NULL,
  `berat_badan` bigint(20) DEFAULT NULL,
  `status_pemeriksaan` enum('pending','sukses','batal') NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` bigint(20) NOT NULL,
  `pemeriksaan_id` bigint(20) NOT NULL,
  `diganosa_utama_code` varchar(255) NOT NULL,
  `diganosa_utama_name` text NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis_diagnosa`
--

CREATE TABLE `rekam_medis_diagnosa` (
  `id` bigint(20) NOT NULL,
  `rekam_medis_id` bigint(20) NOT NULL,
  `diagnosa_sekunder_code` varchar(255) NOT NULL,
  `diagnosa_sekunder_name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis_obat`
--

CREATE TABLE `rekam_medis_obat` (
  `id` bigint(20) NOT NULL,
  `rekam_medis_id` bigint(20) NOT NULL,
  `obat_id` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `frekuensi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$sJB2A.KkZaaeN5INZ42ZC.4cJrRLgZMlijhI/N6C7CPYAs0PBafci', 'admin', 'http://localhost/sistem-rme/upload/profile/admin_logoku.png', '2024-05-29 02:14:11', '2024-05-29 02:14:11'),
(666, 'Kepala Puskesmas', 'kepala', '$2y$10$1iVj6X2haew.tezlEOvS2OLU0.EH0an7rYtoqi.vK7TrwMWhsHNRa', 'kepala', NULL, '2024-05-28 00:53:31', NULL),
(667, 'petugas', 'petugas', '$2y$10$gGF6Hzd8ED1oJtkimVtCbOfVlT6rVCxLdvfXor5X22M9goNB.03ti', 'rm', NULL, '2024-05-28 01:01:12', NULL),
(668, 'apoteker', 'apoteker', '$2y$10$XejfJ/1xn4kYkfyTrc/9YuvZvxmIzHQIcICMLNnya5nLKpSuZTyKS', 'perawat', NULL, '2024-05-28 01:01:31', NULL);

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
-- Indexes for table `pemeriksaan_pasien`
--
ALTER TABLE `pemeriksaan_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_medis_diagnosa`
--
ALTER TABLE `rekam_medis_diagnosa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_medis_obat`
--
ALTER TABLE `rekam_medis_obat`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeriksaan_pasien`
--
ALTER TABLE `pemeriksaan_pasien`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekam_medis_diagnosa`
--
ALTER TABLE `rekam_medis_diagnosa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekam_medis_obat`
--
ALTER TABLE `rekam_medis_obat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
