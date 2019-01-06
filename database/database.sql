-- --------------------------------------------------------
-- Värd:                         192.243.100.173
-- Serverversion:                5.5.61-MariaDB-1ubuntu0.14.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for fragrance
CREATE DATABASE IF NOT EXISTS `fragrance` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fragrance`;

-- Dumping structure for tabell fragrance.catalogue
CREATE TABLE IF NOT EXISTS `catalogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `views` int(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Amount of Catalogue views';

-- Data exporting was unselected.
-- Dumping structure for tabell fragrance.cleanlog
CREATE TABLE IF NOT EXISTS `cleanlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(50) NOT NULL,
  `relid` varchar(50) NOT NULL,
  `releaseName` varchar(120) NOT NULL,
  `releaseStart` varchar(120) DEFAULT NULL,
  `ulTime` varchar(50) NOT NULL,
  `tracker` varchar(50) NOT NULL,
  `sysload` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Logs the cleanup';

-- Data exporting was unselected.
-- Dumping structure for tabell fragrance.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `submittime` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `releaseID` int(11) NOT NULL,
  `subject` varchar(1500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci COMMENT='Comments for details';

-- Data exporting was unselected.
-- Dumping structure for tabell fragrance.easteregg
CREATE TABLE IF NOT EXISTS `easteregg` (
  `found` int(1) DEFAULT NULL COMMENT 'defines if or not found',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for tabell fragrance.feedings
CREATE TABLE IF NOT EXISTS `feedings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trackerurl` varchar(200) DEFAULT '??',
  `favico` varchar(300) DEFAULT '??',
  `section` varchar(300) NOT NULL DEFAULT '??',
  `nfo` varchar(50000) NOT NULL DEFAULT '??',
  `url` varchar(500) DEFAULT NULL,
  `releases` varchar(3000) DEFAULT NULL,
  `releaseStart` varchar(100) DEFAULT NULL,
  `time` varchar(500) DEFAULT NULL,
  `tracker` varchar(500) DEFAULT NULL,
  `updates` int(11) DEFAULT NULL,
  `visningar` int(11) DEFAULT '0',
  `curled` int(1) DEFAULT '0',
  `useradd` int(1) DEFAULT '0',
  `size` varchar(15) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for tabell fragrance.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `added` varchar(50) NOT NULL,
  `addedby` varchar(150) DEFAULT 'Staff',
  `newsviews` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for tabell fragrance.nonnordic
CREATE TABLE IF NOT EXISTS `nonnordic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trackerurl` varchar(200) NOT NULL DEFAULT '??',
  `favico` varchar(300) NOT NULL DEFAULT '??',
  `section` varchar(300) NOT NULL DEFAULT '??',
  `imdb` varchar(300) NOT NULL DEFAULT '??',
  `imdburl` varchar(300) NOT NULL DEFAULT '??',
  `runtime` varchar(500) NOT NULL,
  `poster` varchar(500) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `plot` varchar(250) NOT NULL,
  `cast` varchar(250) NOT NULL,
  `year` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `trailer` varchar(150) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `meta` varchar(20) NOT NULL,
  `nfo` varchar(50000) NOT NULL DEFAULT '??',
  `url` varchar(500) DEFAULT NULL,
  `releases` varchar(3000) DEFAULT NULL,
  `releaseStart` varchar(100) DEFAULT NULL,
  `time` varchar(500) DEFAULT NULL,
  `tracker` varchar(500) DEFAULT NULL,
  `updates` int(11) DEFAULT NULL,
  `visningar` int(11) DEFAULT '0',
  `maze` varchar(300) DEFAULT '??',
  `curled` int(1) DEFAULT '0',
  `useradd` int(1) DEFAULT '0',
  `pre` varchar(100) DEFAULT NULL,
  `upimdb` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for tabell fragrance.visits
CREATE TABLE IF NOT EXISTS `visits` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `antal` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
