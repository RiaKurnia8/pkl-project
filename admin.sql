-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 08:45 AM
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
(8, 'server 90', 'laptop', '1260j9910', '0091728', 8, 'panasonic', '1234', '1029378493', 'layak', '1729663997_1.jpg', 'kembali', '2024-10-22 23:13:17', '2024-11-25 19:03:01', 0),
(12, 'c', 'c', 'c', 'c', 8, 'c', 'c', 'c', 'layak', '1729735761_68eddcea02ceb29abde1b1c752fa29eb.jpg', 'kembali', '2024-10-02 02:07:43', '2024-11-25 19:03:30', 1),
(18, 'user', 'user', '123', '123', 10, '123', '123', '123', 'tidaklayak', '1730027907_IMG-20240903-WA0008.jpg', 'dipinjam', '2024-10-24 20:15:48', '2024-10-27 04:18:27', 0),
(19, 'user', 'Mouse', '123', '123', NULL, '123', '123', '123000', 'layak', '1730027917_IMG-20240903-WA0007.jpg', 'kembali', '2024-10-24 20:16:32', '2024-11-27 17:31:08', 0),
(24, 'TLI', 'ahgs', 'skhku', 'akakaka', 9, 'saaa', 'sasds', 'dfzxc', 'tidaklayak', '1733028112_Screenshot 2024-11-30 151816.jpg', NULL, '2024-11-30 21:41:52', '2024-11-30 21:41:52', 0),
(25, 'Gudang', 'Router', '1200ITC-0098', '300000084/24', 8, 'D-Link', '1200', '8qu18819891', 'layak', '1733790127_GZ0o-E7aoAAQwiO.jpeg', NULL, '2024-12-09 17:22:07', '2024-12-09 17:22:07', 0);

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
(24, 'peripheral1', '2024-12-09 17:53:38', '2024-12-09 17:56:07', 'on', 0);

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
(1, 'IT', 'on', '2024-11-22 23:03:23', '2024-11-22 23:03:23', 0),
(2, 'TLI', 'on', '2024-11-29 20:30:21', '2024-11-29 20:30:21', 0),
(3, 'Packing', 'on', '2024-12-09 18:15:22', '2024-12-09 18:15:22', 0),
(4, 'PMR 1', 'on', '2024-12-09 18:15:31', '2024-12-09 18:15:31', 0),
(5, 'PMR 2', 'on', '2024-12-09 18:15:41', '2024-12-09 18:15:41', 0);

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
('GXJvGnOJEG8CoUwaiuyUp1o1c0FNxxe5bqmwapEq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUVnTW1WS3pwMW9LV0thTGRQN25ucXVTOTd4MHpzWVExREpMc2luYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1733807296),
('Y3uVNh948uB1OEDQHw0P7Wd8Xeu3sJ9Sd4bVxoaf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienE0bzZjWGNEbTBQYVByWXkycTJnWVZobTJ2b3ZKSGxIYk43UW9kSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1733807279);

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
(1, 'admin', '08048', 'admin', NULL, '$2y$12$yL5w.Hhhl..YaRJbBW0ZTOVOfGribzYLOfhwLTLHgpdRix6TPqU22', NULL, '2024-10-14 18:11:27', '2024-12-09 18:32:07', NULL, '087234567098', 'Laki-laki', 2, 0),
(2, 'user', '08049', 'user', NULL, '$2y$12$rBJXYIuRtDAyAffuZPKxpeAHX.Q5FZy.IySMZlyrShoFFV385do2S', NULL, '2024-10-14 18:12:08', '2024-12-09 18:32:18', NULL, '098627127890', 'Laki-laki', 4, 0),
(18, 'Mey Nur Afni', '11111', 'user', NULL, '$2y$12$gZOzrRtIAY7r1cVRSxtHXunU4SXJG9cSSNcy.iljF6ft02ckhwqxG', NULL, '2024-12-02 17:14:03', '2024-12-02 17:14:03', NULL, '098388929102', 'Perempuan', 1, 0),
(19, 'Syeba Wardahani', '1234', 'user', NULL, '$2y$12$jAAbiFTR/4knSLHt7CnpXesSO8U2VBk5Yjd7Ca8bT7leKg7K0bzCu', NULL, '2024-12-04 21:46:53', '2024-12-04 21:46:53', NULL, '087234567098', 'Perempuan', 1, 0),
(20, 'Syeba Wardahani', '12345', 'user', NULL, '$2y$12$1MFcDS/NBTkjoseHToYwCu5E2pisqToX5f1q6bfaA4F.pdg2PP6GO', NULL, '2024-12-04 21:48:08', '2024-12-04 21:48:08', NULL, '087234567098', 'Perempuan', 1, 0),
(21, 'Alya', '1221', 'user', NULL, '$2y$12$vDv1EaOw2boO0Xwi.qLF1.SXVX2HvVYXGZrjijBSlyIZtwoeNAI5W', NULL, '2024-12-09 17:41:44', '2024-12-09 18:37:53', NULL, '098627127890', 'Perempuan', 1, 0);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengembalians`
--
ALTER TABLE `pengembalians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
