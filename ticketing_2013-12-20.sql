# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.59)
# Database: ticketing
# Generation Time: 2013-12-20 09:57:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_user`;

CREATE TABLE `admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `authLevel` int(1) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;

INSERT INTO `admin_user` (`id`, `firstName`, `lastName`, `email`, `password`, `phone`, `authLevel`, `date`)
VALUES
	(1,'admin','eg','admin@admin.com','af4f8f343391bcae658df4f8ba3acf1a:80','',0,'1387246711'),
	(2,'jim','libb','test@test.com','1c6615184fb0cd2067a71cede891c047:fb','',1,'1387247013'),
	(4,'darren','Miao','weblsfamily@gmail.com','5095fc617894b1819b220e90da7c4e95:d1','',1,'1387422438'),
	(5,'dogwin','net','dogwin.net@gmail.com','fa13a219f4b6011b7247aa4c299aa2bb:72','',3,'1387422463');

/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table no-user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `no-user`;

CREATE TABLE `no-user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `phone` varchar(20) DEFAULT '',
  `sex` varchar(2) DEFAULT '',
  `email` varchar(225) DEFAULT '',
  `adress` text,
  `isDriver` int(1) NOT NULL DEFAULT '0',
  `date` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



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


# Dump of table ticketMeta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticketMeta`;

CREATE TABLE `ticketMeta` (
  `id` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `ticketID` int(11) DEFAULT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `key` varchar(100) NOT NULL DEFAULT '',
  `value` text,
  `show_Orders` int(11) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



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


# Dump of table userEmail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `userEmail`;

CREATE TABLE `userEmail` (
  `id` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(30) NOT NULL,
  `ticketID` int(30) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `userEmail` WRITE;
/*!40000 ALTER TABLE `userEmail` DISABLE KEYS */;

INSERT INTO `userEmail` (`id`, `userID`, `ticketID`, `email`, `date`)
VALUES
	(6,4,0,'weblsfamily@gmail.com','1387433663'),
	(5,4,0,'dogwin.net@gmail.com','1387433658'),
	(8,5,0,'dogwin.net@gmail.com','1387437182');

/*!40000 ALTER TABLE `userEmail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table website
# ------------------------------------------------------------

DROP TABLE IF EXISTS `website`;

CREATE TABLE `website` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `show_orders` int(11) NOT NULL DEFAULT '0',
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `website` WRITE;
/*!40000 ALTER TABLE `website` DISABLE KEYS */;

INSERT INTO `website` (`id`, `name`, `url`, `show_orders`, `date`)
VALUES
	(1,'English','',1,NULL),
	(2,'Germany','',2,NULL),
	(3,'Singapore Sessions','',3,NULL),
	(4,'Chinese','',4,NULL),
	(5,'Japan','',5,NULL),
	(6,'Made with Singapore','',6,NULL);

/*!40000 ALTER TABLE `website` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
