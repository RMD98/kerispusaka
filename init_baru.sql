-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.28 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for dkppp
CREATE DATABASE IF NOT EXISTS `dkppp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dkppp`;

-- Dumping structure for table dkppp.action_logs
CREATE TABLE IF NOT EXISTS `action_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.action_logs: ~0 rows (approximately)
DELETE FROM `action_logs`;
/*!40000 ALTER TABLE `action_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `action_logs` ENABLE KEYS */;

-- Dumping structure for table dkppp.betina
CREATE TABLE IF NOT EXISTS `betina` (
  `ear_tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_peternak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_sapi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_ib` int DEFAULT NULL,
  `riwayat_penyakit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ear_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.betina: ~0 rows (approximately)
DELETE FROM `betina`;
/*!40000 ALTER TABLE `betina` DISABLE KEYS */;
INSERT INTO `betina` (`ear_tag`, `id_peternak`, `nama`, `jenis_sapi`, `usia`, `foto`, `jumlah_ib`, `riwayat_penyakit`, `status`, `tanggal_lahir`, `created_at`, `updated_at`) VALUES
	('Autem velit nihil il', 'PETERNAK-2025-0001', 'Necessitatibus et il', 'Inventore hic evenie', '44', 'G:\\RAW\\tableau\\public\\/gambar_sapi/betina\\1758044689_460706376_499759942910044_7246121336483009296_n.jpg', 65, 'Unde exercitationem', 'TIDAK BOLEH IB', '1980-12-20', NULL, NULL),
	('Deserunt tenetur aut', 'PETERNAK-2025-0001', 'Ut reiciendis ut ven', 'Explicabo Velit ut', '16', '/storage/betina/1758044060_460706376_499759942910044_7246121336483009296_n.jpg', 64, 'Modi excepturi et qu', 'TIDAK BOLEH IB', '2009-05-24', NULL, NULL),
	('Est irure consequatu', 'PETERNAK-2025-0001', 'A sunt omnis quidem', 'Facere sit doloremq', '37', 'gambar_sapi/betina1758044902_460706376_499759942910044_7246121336483009296_n.jpg', 20, 'In aute saepe cum fa', 'BOLEH IB', '1988-03-13', NULL, NULL),
	('Nobis et deserunt si', 'PETERNAK-2025-0002', 'Iure non sed ratione', 'Aut et et saepe aut', '20', '/storage/G:\\RAW\\tableau\\public\\betina\\1758044528_460706376_499759942910044_7246121336483009296_n.jpg', 64, 'Officiis consequatur', 'TIDAK BOLEH IB', '2005-03-14', NULL, NULL),
	('Nobis possimus offi', 'PETERNAK-2025-0002', 'Quidem et incidunt', 'A ipsum dolore aut', '19', '/storage/G:\\RAW\\tableau\\public\\/gambar_sapi/betina\\1758044617_460706376_499759942910044_7246121336483009296_n.jpg', 10, 'Alias et quia quis q', 'TIDAK BOLEH IB', '2005-12-04', NULL, NULL),
	('Qui in est amet lau', 'PETERNAK-2025-0002', 'Facere voluptate per', 'Perspiciatis recusa', '32', '/storage/betina/1758042999_460706376_499759942910044_7246121336483009296_n.jpg', 55, 'Est sunt sit impedi', 'TIDAK BOLEH IB', '1993-08-22', NULL, NULL),
	('Qui sit saepe amet', 'PETERNAK-2025-0002', 'Pariatur Minus exce', 'Eiusmod voluptas et', '23', '/storage/betina/1758043481_460706376_499759942910044_7246121336483009296_n.jpg', 76, 'Qui dolor et ullam s', 'TIDAK BOLEH IB', '2001-12-11', NULL, NULL),
	('Velit voluptates ali', 'PETERNAK-2025-0001', 'Inventore laudantium', 'Velit illo Nam dolor', '10', 'gambar_sapi/betina/1758045015_460706376_499759942910044_7246121336483009296_n.jpg', 36, 'Dolor qui facilis ni', 'BOLEH IB', '2014-11-03', NULL, NULL);
/*!40000 ALTER TABLE `betina` ENABLE KEYS */;

-- Dumping structure for table dkppp.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table dkppp.ib
CREATE TABLE IF NOT EXISTS `ib` (
  `id_ib` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_peternak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `betina` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pejantan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ib`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.ib: ~0 rows (approximately)
DELETE FROM `ib`;
/*!40000 ALTER TABLE `ib` DISABLE KEYS */;
/*!40000 ALTER TABLE `ib` ENABLE KEYS */;

-- Dumping structure for table dkppp.kejadian
CREATE TABLE IF NOT EXISTS `kejadian` (
  `id_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_betina` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_peternak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Belum Ada Tindakan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kejadian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.kejadian: ~0 rows (approximately)
DELETE FROM `kejadian`;
/*!40000 ALTER TABLE `kejadian` DISABLE KEYS */;
INSERT INTO `kejadian` (`id_kejadian`, `id_betina`, `id_peternak`, `status`, `created_at`, `updated_at`) VALUES
	('KEJADIAN-2025-0001', 'Nobis et deserunt si', 'PETERNAK-2025-0002', 'Belum Ada Tindakan', '2025-09-17 00:00:00', NULL);
/*!40000 ALTER TABLE `kejadian` ENABLE KEYS */;

-- Dumping structure for table dkppp.kelahiran
CREATE TABLE IF NOT EXISTS `kelahiran` (
  `id_kelahiran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pkb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keunggulan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelahiran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.kelahiran: ~0 rows (approximately)
DELETE FROM `kelahiran`;
/*!40000 ALTER TABLE `kelahiran` DISABLE KEYS */;
/*!40000 ALTER TABLE `kelahiran` ENABLE KEYS */;

-- Dumping structure for table dkppp.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_log` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.log: ~0 rows (approximately)
DELETE FROM `log`;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Dumping structure for table dkppp.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_05_22_033033_create_staff', 1),
	(6, '2025_05_22_033749_create_peternak', 1),
	(7, '2025_05_22_033833_create_pejantan', 1),
	(8, '2025_05_22_033841_create_betina', 1),
	(9, '2025_05_22_033851_create_kejadian', 1),
	(10, '2025_05_22_033858_create_ib', 1),
	(11, '2025_05_22_033905_create_pkb', 1),
	(12, '2025_05_22_033920_create_kelahiran', 1),
	(13, '2025_06_05_163802_create_log', 1),
	(14, '2025_06_07_091143_create_action_logs_table', 1),
	(15, '2025_08_11_042355_create_ticket', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table dkppp.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Dumping structure for table dkppp.pejantan
CREATE TABLE IF NOT EXISTS `pejantan` (
  `id_pejantan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pembuatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_straw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persentase` int DEFAULT NULL,
  `asal_straw` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pejantan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.pejantan: ~0 rows (approximately)
DELETE FROM `pejantan`;
/*!40000 ALTER TABLE `pejantan` DISABLE KEYS */;
INSERT INTO `pejantan` (`id_pejantan`, `id_pembuatan`, `jenis_straw`, `persentase`, `asal_straw`, `created_at`, `updated_at`) VALUES
	('Voluptate tenetur oc', 'Nobis eaque est quod', 'Omnis aut est cupid', 32, 'Perferendis at esse', '2025-09-17 00:19:12', NULL);
/*!40000 ALTER TABLE `pejantan` ENABLE KEYS */;

-- Dumping structure for table dkppp.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table dkppp.peternak
CREATE TABLE IF NOT EXISTS `peternak` (
  `id_peternak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_peternak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.peternak: ~0 rows (approximately)
DELETE FROM `peternak`;
/*!40000 ALTER TABLE `peternak` DISABLE KEYS */;
INSERT INTO `peternak` (`id_peternak`, `nama`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
	('PETERNAK-2025-0001', 'Gail Whitehead', 'Vel sed harum sequi', '084230789138', NULL, NULL),
	('PETERNAK-2025-0002', 'Hasad Faulkner', 'Sapiente irure nemo', '080498434260', NULL, NULL);
/*!40000 ALTER TABLE `peternak` ENABLE KEYS */;

-- Dumping structure for table dkppp.pkb
CREATE TABLE IF NOT EXISTS `pkb` (
  `id_pkb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ib` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pkb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.pkb: ~0 rows (approximately)
DELETE FROM `pkb`;
/*!40000 ALTER TABLE `pkb` DISABLE KEYS */;
/*!40000 ALTER TABLE `pkb` ENABLE KEYS */;

-- Dumping structure for table dkppp.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_izin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_staff`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.staff: ~0 rows (approximately)
DELETE FROM `staff`;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`id_staff`, `nama`, `no_hp`, `surat_izin`, `asal`, `created_at`, `updated_at`) VALUES
	('STAFF-2025-0001', 'Elizabeth Mccullough', '080986964853', 'Facilis ea consectet', 'In tenetur duis fugi', NULL, NULL);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table dkppp.ticket
CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.ticket: ~0 rows (approximately)
DELETE FROM `ticket`;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;

-- Dumping structure for table dkppp.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_user_unique` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dkppp.users: ~1 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user_name`, `password`, `role`, `remember_token`, `id_user`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$12$Dqalc95wkVk58d53azJLxOW0uOaQYRB78OZ4bxCbnUwDlY7Drnm/6', 'super admin', NULL, 'admin', NULL, NULL),
	(3, 'qaxywivevu', '$2y$12$n4JQmapRBeHdfPUG2gq05eCDjNVQjRAhUrUIFwmWMAWz5.lg.uk6y', 'petugas', NULL, 'STAFF-2025-0001', NULL, NULL),
	(4, 'dydar', '$2y$12$AaFdNWdeit/hCnGDRJ4cQONTuZGEysNwBstrOPuXE0LzpWXT7AHo.', 'peternak', NULL, 'PETERNAK-2025-0001', NULL, NULL),
	(5, 'vuwir', '$2y$12$yEX2jIxDEEfvlrlPnp0ypOs0imgyj5sM0lMCtfrW5INPI29BiP6Zm', 'peternak', NULL, 'PETERNAK-2025-0002', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
