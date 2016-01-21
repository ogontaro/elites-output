/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for elites-homework007
CREATE DATABASE IF NOT EXISTS `elites-homework007` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `elites-homework007`;


-- Dumping structure for テーブル elites-homework007.age
CREATE TABLE IF NOT EXISTS `age` (
  `menber_id` bigint(20) NOT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`menber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table elites-homework007.age: ~0 rows (approximately)
/*!40000 ALTER TABLE `age` DISABLE KEYS */;
INSERT INTO `age` (`menber_id`, `age`) VALUES
	(1, 24),
	(2, 25),
	(3, 47),
	(4, 55),
	(5, 39),
	(6, 26),
	(7, 43),
	(8, 33),
	(9, 24),
	(10, 20);
/*!40000 ALTER TABLE `age` ENABLE KEYS */;


-- Dumping structure for テーブル elites-homework007.members
CREATE TABLE IF NOT EXISTS `members` (
  `menber_id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table elites-homework007.members: ~0 rows (approximately)
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`menber_id`, `name`) VALUES
	(1, ' Tanaka'),
	(2, ' Sato'),
	(3, ' Suzuki'),
	(4, ' Tsuchiya'),
	(5, ' Yamada'),
	(6, ' Sasaki'),
	(7, ' Harada'),
	(8, ' Takahashi'),
	(9, ' Nishida'),
	(10, ' Nakada');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;


-- Dumping structure for テーブル elites-homework007.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `menber_id` bigint(20) NOT NULL,
  `sale` bigint(20) NOT NULL,
  `month` int(10) unsigned NOT NULL,
  PRIMARY KEY (`menber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table elites-homework007.sales: ~10 rows (approximately)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` (`menber_id`, `sale`, `month`) VALUES
	(1, 75, 4),
	(2, 200, 5),
	(3, 15, 6),
	(4, 700, 5),
	(5, 672, 4),
	(6, 56, 8),
	(7, 231, 9),
	(8, 459, 8),
	(9, 8, 7),
	(10, 120, 4);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
