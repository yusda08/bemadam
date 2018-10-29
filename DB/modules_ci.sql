-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table ci_master.aktifitas
DROP TABLE IF EXISTS `aktifitas`;
CREATE TABLE IF NOT EXISTS `aktifitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(225) DEFAULT NULL,
  `ket_level` varchar(225) DEFAULT NULL,
  `kd_user` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `keterangan` text,
  `data` text,
  `ip` varchar(225) DEFAULT NULL,
  `komputer` varchar(225) DEFAULT NULL,
  `browser` varchar(225) DEFAULT NULL,
  `username` varchar(225) DEFAULT NULL,
  `nama_admin` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

-- Dumping data for table ci_master.aktifitas: ~25 rows (approximately)
/*!40000 ALTER TABLE `aktifitas` DISABLE KEYS */;
INSERT INTO `aktifitas` (`id`, `nama_user`, `ket_level`, `kd_user`, `tanggal`, `jam`, `keterangan`, `data`, `ip`, `komputer`, `browser`, `username`, `nama_admin`) VALUES
	(93, NULL, NULL, NULL, '2018-08-19', '22:27:13', 'Login', NULL, '::1', 'LAPTOP-7JJR91TJ', 'Chrome 68.0.3440.106 (Windows 10)', NULL, NULL),
	(94, 'Badan Perencanaan Pembangunan Daerah (Admin)', 'Administrator', 1, '2018-08-19', '22:28:08', 'Logout', NULL, '::1', 'LAPTOP-7JJR91TJ', 'Chrome 68.0.3440.106 (Windows 10)', NULL, NULL),
	(95, NULL, NULL, NULL, '2018-08-19', '22:28:44', 'Login', NULL, '::1', 'LAPTOP-7JJR91TJ', 'Chrome 68.0.3440.106 (Windows 10)', NULL, NULL),
	(96, 'Badan Perencanaan Pembangunan Daerah (Admin)', 'Administrator', 1, '2018-08-19', '22:28:51', 'Lock Screen', NULL, '::1', 'LAPTOP-7JJR91TJ', 'Chrome 68.0.3440.106 (Windows 10)', NULL, NULL),
	(97, NULL, NULL, NULL, '2018-08-19', '22:28:57', 'Login', NULL, '::1', 'LAPTOP-7JJR91TJ', 'Chrome 68.0.3440.106 (Windows 10)', NULL, NULL),
	(98, 'Badan Perencanaan Pembangunan Daerah (Admin)', 'Administrator', 1, '2018-08-19', '22:33:37', 'Logout', NULL, '::1', 'LAPTOP-7JJR91TJ', 'Chrome 68.0.3440.106 (Windows 10)', NULL, NULL);
/*!40000 ALTER TABLE `aktifitas` ENABLE KEYS */;

-- Dumping structure for table ci_master.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_level` int(11) DEFAULT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `link` varchar(225) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table ci_master.menu: ~1 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `kd_level`, `nama`, `parent`, `link`, `urutan`, `icon`) VALUES
	(1, 1, 'dashboard', 0, 'backend/Home', 2, 'fa-dashboard');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table ci_master.menu_role
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE IF NOT EXISTS `menu_role` (
  `id_menu` int(11) NOT NULL,
  `kd_user` int(11) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0',
  `edit` bit(1) NOT NULL DEFAULT b'0',
  `hapus` bit(1) NOT NULL DEFAULT b'0',
  `lihat` bit(1) NOT NULL DEFAULT b'0',
  `print` bit(1) NOT NULL DEFAULT b'0',
  `tambah` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id_menu`,`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ci_master.menu_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `menu_role` DISABLE KEYS */;
INSERT INTO `menu_role` (`id_menu`, `kd_user`, `status`, `edit`, `hapus`, `lihat`, `print`, `tambah`) VALUES
	(1, 1, b'0', b'1', b'1', b'1', b'1', b'1'),
	(1, 2, b'0', b'0', b'0', b'0', b'0', b'0');
/*!40000 ALTER TABLE `menu_role` ENABLE KEYS */;

-- Dumping structure for table ci_master.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `kd_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_user` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_telpon` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `ket_level` varchar(50) NOT NULL,
  `is_active` bit(1) DEFAULT b'0',
  `is_login` bit(1) DEFAULT b'0',
  `last_login_dt` date DEFAULT NULL,
  `last_login_tm` time DEFAULT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table ci_master.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`kd_user`, `username`, `password`, `nama_user`, `email`, `no_telpon`, `foto`, `ket_level`, `is_active`, `is_login`, `last_login_dt`, `last_login_tm`) VALUES
	(1, 'admin', 'admin', 'Badan Perencanaan Pembangunan Daerah (Admin)', 'asd@asd', '123', '10062018134159.png', '', b'1', b'0', '2018-08-19', '22:33:37');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table ci_master.user_group
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL,
  `kd_level` int(11) DEFAULT NULL,
  `kd_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_group_user_level` (`kd_level`),
  KEY `FK_user_group_user` (`kd_user`),
  CONSTRAINT `FK_user_group_user` FOREIGN KEY (`kd_user`) REFERENCES `user` (`kd_user`),
  CONSTRAINT `FK_user_group_user_level` FOREIGN KEY (`kd_level`) REFERENCES `user_level` (`kd_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ci_master.user_group: ~1 rows (approximately)
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` (`id`, `kd_level`, `kd_user`) VALUES
	(1, 1, 1);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;

-- Dumping structure for table ci_master.user_level
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `kd_level` int(11) NOT NULL AUTO_INCREMENT,
  `ket_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ci_master.user_level: ~5 rows (approximately)
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` (`kd_level`, `ket_level`) VALUES
	(1, 'Administrator'),
	(2, 'SKPD'),
	(3, 'PA'),
	(4, 'KPA'),
	(5, 'PPTK');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;

-- Dumping structure for trigger ci_master.menu_after_delete
DROP TRIGGER IF EXISTS `menu_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `menu_after_delete` AFTER DELETE ON `menu` FOR EACH ROW BEGIN
delete from menu_role where id_menu=old.id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger ci_master.menu_after_insert
DROP TRIGGER IF EXISTS `menu_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `menu_after_insert` AFTER INSERT ON `menu` FOR EACH ROW BEGIN
insert menu_role (id_menu, kd_user, tambah, edit, hapus, print, lihat) values (new.id, 1, 1, 1, 1, 1, 1);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
