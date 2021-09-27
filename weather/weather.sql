-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: localhost    Database: highchart
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.20-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `weather_reports`
--

DROP TABLE IF EXISTS `weather_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weather_reports` (
  `city` varchar(20) NOT NULL,
  `min` double NOT NULL,
  `max` double NOT NULL,
  `report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weather_reports`
--

LOCK TABLES `weather_reports` WRITE;
/*!40000 ALTER TABLE `weather_reports` DISABLE KEYS */;
INSERT INTO `weather_reports` VALUES 
('Sydney',14,21,'2021-09-01'),
('Melbourne',11,19,'2021-09-01'),
('Sydney',17,24,'2021-09-02'),
('Melbourne',12,16,'2021-09-02'),
('Sydney',11,15,'2021-09-03'),
('Melbourne',17,22,'2021-09-03'),
('Sydney',11,18,'2021-09-04'),
('Melbourne',12,25,'2021-09-04'),
('Sydney',12,19,'2021-09-09'),
('Melbourne',11,24,'2021-09-09'),
('Sydney',16,17,'2021-09-08'),
('Melbourne',11,17,'2021-09-08'),
('Sydney',15,26,'2021-09-07'),
('Melbourne',13,22,'2021-09-07'),
('Sydney',11,15,'2021-09-06'),
('Melbourne',16,20,'2021-09-06'),
('Sydney',18,25,'2021-09-05'),
('Melbourne',15,21,'2021-09-05'),
('Brisbane',17,21,'2021-09-05'),
('Brisbane',19,23,'2021-09-06'),
('Brisbane',20,26,'2021-09-07'),
('Brisbane',22,29,'2021-09-08'),
('Brisbane',14,16,'2021-09-09'),
('Brisbane',16,19,'2021-09-04'),
('Brisbane',19,23,'2021-09-03'),
('Brisbane',19,26,'2021-09-02'),
('Brisbane',22,23,'2021-09-01');
/*!40000 ALTER TABLE `weather_reports` ENABLE KEYS */;
UNLOCK TABLES;
