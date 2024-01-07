-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for perkuliahan
CREATE DATABASE IF NOT EXISTS `perkuliahan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `perkuliahan`;

-- Dumping structure for table perkuliahan.dosens
CREATE TABLE IF NOT EXISTS `dosens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nik` char(9) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jurusan_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dosens_nik_unique` (`nik`),
  KEY `dosens_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `dosens_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.dosens: ~6 rows (approximately)
INSERT INTO `dosens` (`id`, `nik`, `nama`, `jurusan_id`, `created_at`, `updated_at`) VALUES
	(13, '000999000', 'Rangga Arjuna M.Kom', 3, '2024-01-06 04:02:57', '2024-01-06 05:14:56'),
	(14, '111666777', 'Sumarni', 3, '2024-01-06 04:03:39', '2024-01-06 04:10:33'),
	(16, '111222888', 'Raharjo', 5, '2024-01-06 04:10:53', '2024-01-06 04:10:53'),
	(17, '111122224', 'Sulaiman S.Kom', 7, '2024-01-06 05:11:42', '2024-01-06 05:11:42'),
	(18, '111222555', 'Musa David M.Kom', 7, '2024-01-06 05:12:28', '2024-01-06 05:12:28');

-- Dumping structure for table perkuliahan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table perkuliahan.jurusans
CREATE TABLE IF NOT EXISTS `jurusans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `kepala_jurusan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.jurusans: ~2 rows (approximately)
INSERT INTO `jurusans` (`id`, `nama`, `kepala_jurusan`, `created_at`, `updated_at`) VALUES
	(3, 'Ilmu Komputer', 'Agus Handoyo', '2024-01-06 03:55:23', '2024-01-06 03:55:23'),
	(5, 'Rekayasa Perangkat Lunak', 'Prof. Zefri Santoso', '2024-01-06 03:59:22', '2024-01-06 04:00:23'),
	(7, 'Data Science', 'Smith Jhonshon B.c', '2024-01-06 05:08:09', '2024-01-06 05:08:26');

-- Dumping structure for table perkuliahan.mahasiswas
CREATE TABLE IF NOT EXISTS `mahasiswas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nim` char(9) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jurusan_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mahasiswas_nim_unique` (`nim`),
  KEY `mahasiswas_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `mahasiswas_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.mahasiswas: ~1 rows (approximately)
INSERT INTO `mahasiswas` (`id`, `nim`, `nama`, `jurusan_id`, `created_at`, `updated_at`) VALUES
	(5, '111222343', 'Muhammad Rifki', 3, '2024-01-06 04:32:43', '2024-01-06 04:32:43'),
	(6, '111222999', 'Zehan Rohma Satria', 3, '2024-01-06 04:47:40', '2024-01-06 04:48:54'),
	(7, '111000222', 'Raharjo Budiama', 3, '2024-01-06 04:49:14', '2024-01-06 04:49:14'),
	(8, '222233666', 'Muhammad Fauzan', 3, '2024-01-06 04:51:04', '2024-01-06 04:51:11'),
	(10, '121333111', 'Muhamad Fatih', 5, '2024-01-06 06:08:11', '2024-01-06 06:08:11');

-- Dumping structure for table perkuliahan.mahasiswa_matakuliah
CREATE TABLE IF NOT EXISTS `mahasiswa_matakuliah` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` bigint(20) unsigned NOT NULL,
  `matakuliah_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_matakuliah_mahasiswa_id_foreign` (`mahasiswa_id`),
  KEY `mahasiswa_matakuliah_matakuliah_id_foreign` (`matakuliah_id`),
  CONSTRAINT `mahasiswa_matakuliah_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mahasiswa_matakuliah_matakuliah_id_foreign` FOREIGN KEY (`matakuliah_id`) REFERENCES `matakuliahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.mahasiswa_matakuliah: ~4 rows (approximately)
INSERT INTO `mahasiswa_matakuliah` (`id`, `mahasiswa_id`, `matakuliah_id`, `created_at`, `updated_at`) VALUES
	(1, 8, 5, NULL, NULL),
	(3, 5, 5, NULL, NULL),
	(5, 6, 5, NULL, NULL),
	(6, 7, 5, NULL, NULL);

-- Dumping structure for table perkuliahan.matakuliahs
CREATE TABLE IF NOT EXISTS `matakuliahs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` char(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah_sks` int(11) NOT NULL,
  `dosen_id` bigint(20) unsigned NOT NULL,
  `jurusan_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matakuliahs_kode_unique` (`kode`),
  KEY `matakuliahs_dosen_id_foreign` (`dosen_id`),
  KEY `matakuliahs_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `matakuliahs_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosens` (`id`) ON DELETE CASCADE,
  CONSTRAINT `matakuliahs_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.matakuliahs: ~1 rows (approximately)
INSERT INTO `matakuliahs` (`id`, `kode`, `nama`, `jumlah_sks`, `dosen_id`, `jurusan_id`, `created_at`, `updated_at`) VALUES
	(4, 'IF555', 'Pemrograman Basis Data', 3, 13, 3, '2024-01-06 04:53:53', '2024-01-06 04:59:57'),
	(5, 'IF212', 'Basis Data', 3, 13, 3, '2024-01-06 04:56:20', '2024-01-06 04:56:20'),
	(8, 'DS777', 'Pengenalan Ucapan', 3, 18, 7, '2024-01-06 06:02:12', '2024-01-06 06:02:12');

-- Dumping structure for table perkuliahan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.migrations: ~9 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_01_06_034224_create_jurusans_table', 1),
	(6, '2024_01_06_034248_create_mahasiswas_table', 1),
	(7, '2024_01_06_034305_create_dosens_table', 1),
	(8, '2024_01_06_034330_create_matakuliahs_table', 1),
	(9, '2024_01_06_034415_create_mahasiswa_matakuliah_table', 1);

-- Dumping structure for table perkuliahan.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table perkuliahan.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table perkuliahan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perkuliahan.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
