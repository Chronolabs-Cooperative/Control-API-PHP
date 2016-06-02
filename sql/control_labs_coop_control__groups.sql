CREATE DATABASE  IF NOT EXISTS `control_labs_coop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `control_labs_coop`;
-- MySQL dump 10.13  Distrib 5.6.25, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: control_labs_coop
-- ------------------------------------------------------
-- Server version	5.6.25-0ubuntu0.15.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `control__groups`
--

DROP TABLE IF EXISTS `control__groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `control__groups` (
  `group` varchar(45) NOT NULL,
  `waiting` enum('Yes','No') NOT NULL DEFAULT 'No',
  `email` int(32) DEFAULT '0',
  `name` int(32) DEFAULT '0',
  `uses` int(32) DEFAULT '0',
  `added` int(12) DEFAULT '0',
  `muted` int(44) DEFAULT '0',
  `notice` int(12) DEFAULT '0',
  `sent` int(12) DEFAULT '0',
  `emails` int(8) DEFAULT '0',
  `names` int(8) DEFAULT '0',
  `resolved` int(23) DEFAULT '0',
  `callback` tinytext,
  PRIMARY KEY (`group`(23)),
  KEY `SEARCH` (`waiting`,`email`,`name`,`notice`,`resolved`,`sent`,`emails`,`names`,`uses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control__groups`
--

LOCK TABLES `control__groups` WRITE;
/*!40000 ALTER TABLE `control__groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `control__groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-29  8:23:33
