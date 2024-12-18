-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 07:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('09070|127.0.0.1', 'i:1;', 1732067351),
('09070|127.0.0.1:timer', 'i:1732067351;', 1732067351);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `databarangs`
--

CREATE TABLE `databarangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `barang` varchar(255) NOT NULL,
  `no_asset` varchar(255) NOT NULL,
  `no_equipment` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `merk` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `sn` varchar(255) NOT NULL,
  `kelayakan` enum('layak','tidaklayak') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('dipinjam','kembali','dikantor') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `databarangs`
--

INSERT INTO `databarangs` (`id`, `lokasi`, `barang`, `no_asset`, `no_equipment`, `kategori_id`, `merk`, `tipe`, `sn`, `kelayakan`, `foto`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'IT', 'Laptop', 'ITC 1200-jjwiu218', '300002020/0', 8, 'Lenovo', 'T480', '12345', 'tidaklayak', '1734501284_user sem 3.jpg', NULL, '2024-12-17 22:54:44', '2024-12-17 22:54:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('on','off') NOT NULL DEFAULT 'on',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`, `status`, `is_deleted`) VALUES
(8, 'networkpart', '2024-10-22 19:15:33', '2024-10-22 19:15:33', 'on', 0),
(9, 'surveilance', '2024-10-22 19:52:07', '2024-10-22 19:52:07', 'on', 0),
(10, 'sparepart', '2024-10-22 21:34:53', '2024-12-09 17:23:19', 'on', 0),
(24, 'peripheral', '2024-12-09 17:53:38', '2024-12-10 17:24:53', 'on', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '0001_01_01_000000_create_users_table', 1),
(6, '0001_01_01_000001_create_cache_table', 1),
(7, '0001_01_01_000002_create_jobs_table', 1),
(8, '2024_10_14_011811_create_databarangs_table', 1),
(9, '2024_10_17_002846_add_fields_to_users_table', 2),
(10, '2024_10_17_005301_create_kategori_table', 3),
(11, '2024_10_17_012949_create_peminjaman_table', 4),
(12, '2024_10_17_013111_create_pengembalian_table', 4),
(13, '2024_10_17_014152_create_kategoris_table', 5),
(14, '2024_10_17_014242_create_pengembalians_table', 5),
(15, '2024_10_17_014258_create_peminjamans_table', 5),
(16, '2024_10_23_010014_create_kategoris_table', 6),
(17, '2024_10_23_010029_create_databarangs_table', 6),
(20, '2024_10_22_013841_add_status_to_peminjamans_table', 7),
(21, '2024_10_23_005733_add_username__to_peminjamans_table', 7),
(22, '2024_10_23_011053_add_username__to_pengembalians_table', 7),
(23, '2024_10_31_034004_add_status_to_kategoris_table', 8),
(24, '2024_10_31_045908_add_is_deleted_update_to_peminjamans_table', 8),
(25, '2024_11_09_125557_add_notes_to_peminjamans_table', 9),
(26, '2024_11_09_130859_add_notes_to_pengembalians_table', 10),
(27, '2024_11_09_141641_add_keperluan_to_peminjamans_table', 11),
(28, '2024_11_09_141936_add_keperluan_to_pengembalians_table', 12),
(29, '2024_11_08_135226_create_plants_table', 13),
(30, '2024_11_08_141557_add_plant_id_update_to_users_table', 13),
(31, '2024_11_30_040313_add_is_deleted_update_to_databarangs_table', 14),
(32, '2024_11_30_040417_add_is_deleted_update_to_kategoris_table', 14),
(33, '2024_11_30_040451_add_is_deleted_update_to_plants_table', 14),
(34, '2024_11_30_040536_add_is_deleted_update_to_users_table', 14),
(35, '2024_11_30_162213_add_keterangan_update_to_peminjamans_table', 15),
(36, '2024_12_03_011823_add_peminjaman_id_to_pengembalians_table', 16),
(37, '2024_12_05_041509_add_tanggal_pengembalian_to_peminjamans_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `plant` varchar(255) NOT NULL,
  `barang_dipinjam` varchar(255) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `keperluan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `nik`, `username`, `name`, `plant`, `barang_dipinjam`, `tanggal_pinjam`, `status`, `keterangan`, `tanggal_pengembalian`, `notes`, `keperluan`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, '08049', NULL, 'user', 'PMR 1', 'Hdd', '2024-12-01', 'diterima', 'Sudah Kembali', '2024-12-18', 'ok', 'untuk', '2024-12-10 18:22:01', '2024-12-17 22:16:35', 0),
(2, '08049', NULL, 'user', 'PMR 1', 'laptop', '2024-12-02', 'diterima', 'Sudah Kembali', '2024-12-18', 'sip', 'oke', '2024-12-10 18:22:18', '2024-12-17 22:30:24', 0),
(3, '08049', NULL, 'user', 'PMR 1', 'pc', '2024-12-03', 'diterima', 'Sudah Kembali', '2024-12-18', 'sip', 'polije', '2024-12-10 18:22:41', '2024-12-17 22:33:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalians`
--

CREATE TABLE `pengembalians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `plant` varchar(255) NOT NULL,
  `barang_dipinjam` varchar(255) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `keperluan` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalians`
--

INSERT INTO `pengembalians` (`id`, `peminjaman_id`, `nik`, `username`, `name`, `plant`, `barang_dipinjam`, `tanggal_pengembalian`, `status`, `keperluan`, `notes`, `created_at`, `updated_at`) VALUES
(1, NULL, '08049', NULL, 'user', 'PMR 1', 'Hdd', '2024-12-18', '', 'sudah kembali', NULL, '2024-12-17 22:16:35', '2024-12-17 22:16:35'),
(2, NULL, '08049', NULL, 'user', 'PMR 1', 'laptop', '2024-12-18', '', 'ok', NULL, '2024-12-17 22:30:24', '2024-12-17 22:30:24'),
(3, NULL, '08049', NULL, 'user', 'PMR 1', 'pc', '2024-12-18', '', 'sip', NULL, '2024-12-17 22:33:21', '2024-12-17 22:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plant` varchar(255) NOT NULL,
  `status` enum('on','off') NOT NULL DEFAULT 'on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `plant`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Quality Control & Quality Assurance', 'on', '2024-11-22 23:03:23', '2024-12-17 22:40:44', 0),
(2, 'General Affair', 'on', '2024-11-29 20:30:21', '2024-12-17 22:40:59', 0),
(3, 'Safety, Health & Environment', 'on', '2024-12-09 18:15:22', '2024-12-17 22:41:25', 0),
(4, 'Human Resource', 'on', '2024-12-09 18:15:31', '2024-12-17 22:41:38', 0),
(5, 'Liquid Fertilizer - Sales', 'on', '2024-12-09 18:15:41', '2024-12-17 22:42:01', 0),
(6, 'Fermentation', 'on', '2024-12-17 22:42:14', '2024-12-17 22:42:14', 0),
(7, 'Engineering', 'on', '2024-12-17 22:42:27', '2024-12-17 22:42:27', 0),
(8, 'Planning & Production Control - Supplay Chain Management', 'on', '2024-12-17 22:47:24', '2024-12-17 22:47:24', 0),
(9, 'Finance', 'on', '2024-12-17 22:48:01', '2024-12-17 22:48:01', 0),
(10, 'Technical Development', 'on', '2024-12-17 22:48:16', '2024-12-17 22:48:16', 0),
(11, 'Isolation & Purification', 'on', '2024-12-17 22:48:31', '2024-12-17 22:48:31', 0),
(12, 'Mechanical Maintenance Tech', 'on', '2024-12-17 22:49:44', '2024-12-17 22:49:44', 0),
(13, 'Utility', 'on', '2024-12-17 22:49:50', '2024-12-17 22:49:50', 0),
(14, 'Logistic', 'on', '2024-12-17 22:49:58', '2024-12-17 22:49:58', 0),
(15, 'Electrical Instruments', 'on', '2024-12-17 22:50:19', '2024-12-17 22:50:19', 0),
(16, 'Packing', 'on', '2024-12-17 22:50:26', '2024-12-17 22:50:26', 0),
(17, 'Maintenance Tech. & Pollycello', 'on', '2024-12-17 22:51:18', '2024-12-17 22:51:18', 0),
(18, 'Advicer', 'on', '2024-12-17 22:51:33', '2024-12-17 22:51:33', 0),
(19, 'Management', 'on', '2024-12-17 22:51:41', '2024-12-17 22:51:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6WeBzIojeRlCG8ZXB1QLwlxudH0PmipQp1XwzfzE', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVTBMOW9wcGptZFZENTlPb041Tmw5djJCSXRWa1k5N2hxcG90dnhiYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2hwZW1pbmphbWFuIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1734500026),
('Hq4BXo3sI4T7Df2MYgMIvp5fTQIcjhERgHv7G58u', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSWZib3ptV3NPazh4aTh5Z1dRTzNFaHU0TDFPR2J5WmxRcVJadGlXWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9iYXJhbmctc2FtcGFoIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1734501722),
('mvPyqUpqColLPGNzjP9Y4jMndX1lnwN3rVOT7rUX', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTEVVR1ppWXdvT2hOTFJJRXZCWlMwZEEzbTNPZmZoMnUzc3lHWkJwZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXRhYmFyYW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1734491716);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nik` varchar(5) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `plant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nik`, `usertype`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `nomor_hp`, `jenis_kelamin`, `plant_id`, `is_deleted`) VALUES
(1, 'admin', '08048', 'admin', NULL, '$2y$12$yL5w.Hhhl..YaRJbBW0ZTOVOfGribzYLOfhwLTLHgpdRix6TPqU22', NULL, '2024-10-14 18:11:27', '2024-12-17 22:52:15', NULL, '087234567098', 'Laki-laki', 10, 0),
(2, 'user', '08049', 'user', NULL, '$2y$12$IMgz74JDeIt3Ld8Njm1XTeUcjRn.BwCIFlC0AMH5XRPJIGVBYgnj.', NULL, '2024-10-14 18:12:08', '2024-12-17 22:53:09', NULL, '098627127890', 'Laki-laki', 10, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `databarangs`
--
ALTER TABLE `databarangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `databarangs_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalians`
--
ALTER TABLE `pengembalians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalians_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD KEY `users_plant_id_foreign` (`plant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `databarangs`
--
ALTER TABLE `databarangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengembalians`
--
ALTER TABLE `pengembalians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `databarangs`
--
ALTER TABLE `databarangs`
  ADD CONSTRAINT `databarangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalians`
--
ALTER TABLE `pengembalians`
  ADD CONSTRAINT `pengembalians_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_plant_id_foreign` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
