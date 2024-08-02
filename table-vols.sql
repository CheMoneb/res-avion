-- MySQL dump 10.13  Distrib 8.3.0, for macos12.6 (x86_64)
--
-- Host: localhost    Database: aeroport
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `aeroports`
--

DROP TABLE IF EXISTS `aeroports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aeroports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aeroports`
--

LOCK TABLES `aeroports` WRITE;
/*!40000 ALTER TABLE `aeroports` DISABLE KEYS */;
INSERT INTO `aeroports` VALUES (1,'Paris','CDG'),(2,'Oujda','OUD'),(3,'New-york','JFK'),(4,'Barcelone','BCN'),(5,'Téhéran','THR'),(6,'Milan','MIL'),(7,'Tokyo','HND'),(8,'Tunis','TUN'),(9,'Marseille','MRS'),(10,'Dubaï','DXB');
/*!40000 ALTER TABLE `aeroports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vols`
--

DROP TABLE IF EXISTS `vols`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vols` (
  `id` int NOT NULL AUTO_INCREMENT,
  `depart_id` int NOT NULL,
  `arrivee_id` int NOT NULL,
  `heure_depart` varchar(20) NOT NULL,
  `heure_arrivee` varchar(20) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `depart_id` (`depart_id`),
  KEY `arrivee_id` (`arrivee_id`),
  CONSTRAINT `vols_ibfk_1` FOREIGN KEY (`depart_id`) REFERENCES `aeroports` (`id`),
  CONSTRAINT `vols_ibfk_2` FOREIGN KEY (`arrivee_id`) REFERENCES `aeroports` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=736 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vols`
--

LOCK TABLES `vols` WRITE;
/*!40000 ALTER TABLE `vols` DISABLE KEYS */;
INSERT INTO `vols` VALUES (1,1,2,'09h00','11h30',90.00,'2024-09-15'),(2,3,4,'20h30','11h00',150.00,'2024-10-03'),(3,5,6,'14h30','16h00',120.00,'2024-12-12'),(4,7,9,'16h50','21h00',115.00,'2024-11-12'),(5,10,5,'01h00','5h00',200.00,'2024-12-20');
/*!40000 ALTER TABLE `vols` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-02 14:21:20
