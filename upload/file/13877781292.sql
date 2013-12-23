# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.59)
# Database: ticketing
# Generation Time: 2013-12-23 02:21:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ticket
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `id` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `website` varchar(255) NOT NULL DEFAULT '',
  `jobTastType` int(1) NOT NULL DEFAULT '1',
  `Urgent` int(1) NOT NULL DEFAULT '1',
  `taskTitle` varchar(100) NOT NULL DEFAULT '',
  `status` int(2) NOT NULL DEFAULT '1',
  `changeRequestDescription` text,
  `link` varchar(255) DEFAULT NULL,
  `stagingLink` varchar(255) DEFAULT NULL,
  `finishDay` varchar(50) NOT NULL DEFAULT '',
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;

INSERT INTO `ticket` (`id`, `userID`, `website`, `jobTastType`, `Urgent`, `taskTitle`, `status`, `changeRequestDescription`, `link`, `stagingLink`, `finishDay`, `date`)
VALUES
	(1,4,'1:2:3:5',2,0,'ttt',6,'ccc','link','http://www.rlsy.net','2014-01-15','1387506813'),
	(2,4,'2',2,0,'task 2',2,'facebook ','http://www.rlsy.net',NULL,'2013-12-25','1387531828');

/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ticketComment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticketComment`;

CREATE TABLE `ticketComment` (
  `id` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `ticketID` int(30) NOT NULL,
  `userID` int(30) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ticketComment` WRITE;
/*!40000 ALTER TABLE `ticketComment` DISABLE KEYS */;

INSERT INTO `ticketComment` (`id`, `ticketID`, `userID`, `comment`, `date`)
VALUES
	(1,1,4,'comments','1387523732'),
	(2,1,4,'comment2','1387524291'),
	(3,1,4,'aaaa','1387531853'),
	(4,1,4,'bbbb','1387531862'),
	(5,1,4,'cccc','1387531869'),
	(6,1,4,'dddd','1387531880'),
	(7,1,4,'adfasdfasdf','1387531885');

/*!40000 ALTER TABLE `ticketComment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ticketEmail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticketEmail`;

CREATE TABLE `ticketEmail` (
  `id` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `ticketID` int(30) NOT NULL,
  `ueID` int(30) NOT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ticketEmail` WRITE;
/*!40000 ALTER TABLE `ticketEmail` DISABLE KEYS */;

INSERT INTO `ticketEmail` (`id`, `ticketID`, `ueID`, `date`)
VALUES
	(1,1,6,1387506813),
	(2,1,5,1387506813),
	(3,2,6,1387531828),
	(4,2,5,1387531828);

/*!40000 ALTER TABLE `ticketEmail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table uploads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `uploads`;

CREATE TABLE `uploads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticketID` int(30) NOT NULL DEFAULT '0',
  `commentID` int(30) NOT NULL DEFAULT '0',
  `fileName` varchar(255) NOT NULL DEFAULT '',
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;

INSERT INTO `uploads` (`id`, `ticketID`, `commentID`, `fileName`, `date`)
VALUES
	(1,1,0,'upload/file/13875068131.jpg','1387506813'),
	(2,0,2,'upload/file/13875242911.jpg','1387524291'),
	(3,0,2,'upload/file/13875242912.sql','1387524291'),
	(4,2,0,'upload/file/13875318281.sql','1387531828'),
	(5,2,0,'upload/file/13875318282.jpg','1387531828'),
	(6,2,0,'upload/file/13875318283.doc','1387531828'),
	(7,2,0,'upload/file/13875318284.sql','1387531828'),
	(8,2,0,'upload/file/13875318285.jpg','1387531828');

/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
