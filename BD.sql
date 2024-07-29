-- MySQL dump 10.13  Distrib 8.3.0, for macos14.2 (arm64)
--
-- Host: localhost    Database: reservation_vols
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
-- Table structure for table `airports`
--

DROP TABLE IF EXISTS `airports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `airports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ident` varchar(10) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `latitude_deg` double DEFAULT NULL,
  `longitude_deg` double DEFAULT NULL,
  `elevation_ft` int DEFAULT NULL,
  `continent` varchar(2) DEFAULT NULL,
  `iso_country` varchar(2) DEFAULT NULL,
  `iso_region` varchar(7) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `scheduled_service` varchar(3) DEFAULT NULL,
  `gps_code` varchar(10) DEFAULT NULL,
  `iata_code` varchar(10) DEFAULT NULL,
  `local_code` varchar(10) DEFAULT NULL,
  `home_link` varchar(255) DEFAULT NULL,
  `wikipedia_link` varchar(255) DEFAULT NULL,
  `keywords` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airports`
--

LOCK TABLES `airports` WRITE;
/*!40000 ALTER TABLE `airports` DISABLE KEYS */;
/*!40000 ALTER TABLE `airports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vol_id` int DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `nombre_passagers` int DEFAULT NULL,
  `date_reservation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vol_id` (`vol_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`vol_id`) REFERENCES `vols` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'bouali','$2y$10$Gd6oAtgdnPzMgjqpmRBfJOlMhBkwcitzhE1MbuXdTjqXjLGfDhory','moezlevioloniste@gmail.com','2024-07-23 10:20:14'),(2,'chervine','$2y$10$LD/A4KMn6JJg5r/kLXyWRu7RpcAhr3Ubef6YOG91xZDdPaZmrwA2C','chervine1999@gmail.com','2024-07-23 12:18:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vols`
--

DROP TABLE IF EXISTS `vols`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vols` (
  `id` int NOT NULL AUTO_INCREMENT,
  `compagnie` varchar(100) DEFAULT NULL,
  `depart` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `date_depart` date DEFAULT NULL,
  `heure_depart` time DEFAULT NULL,
  `date_arrivee` date DEFAULT NULL,
  `heure_arrivee` time DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vols`
--

LOCK TABLES `vols` WRITE;
/*!40000 ALTER TABLE `vols` DISABLE KEYS */;
INSERT INTO `vols` VALUES (1,'Air France','Paris','New York','2024-08-01','10:00:00','2024-08-01','14:00:00',500.00),(2,'Delta Airlines','New York','Los Angeles','2024-08-02','12:00:00','2024-08-02','15:00:00',300.00),(3,'Air France','Paris','New York','2024-08-01','10:00:00','2024-08-01','14:00:00',500.00),(4,'Delta Airlines','New York','Los Angeles','2024-08-02','12:00:00','2024-08-02','15:00:00',300.00),(5,'British Airways','London','Tokyo','2024-08-03','16:00:00','2024-08-04','09:00:00',700.00),(6,'Emirates','Dubai','Sydney','2024-08-04','22:00:00','2024-08-05','06:00:00',800.00),(7,'Air France','Paris','New York','2024-08-01','10:00:00','2024-08-01','13:00:00',450.00),(8,'Delta Airlines','New York','Los Angeles','2024-08-02','12:00:00','2024-08-02','15:00:00',350.00),(9,'British Airways','London','Tokyo','2024-08-03','16:00:00','2024-08-04','11:00:00',750.00),(10,'Emirates','Dubai','Sydney','2024-08-04','22:00:00','2024-08-05','06:00:00',900.00),(11,'Lufthansa','Berlin','Chicago','2024-08-05','08:00:00','2024-08-05','11:00:00',550.00),(12,'Qantas','Sydney','San Francisco','2024-08-06','14:00:00','2024-08-06','10:00:00',800.00),(13,'Singapore Airlines','Singapore','Frankfurt','2024-08-07','18:00:00','2024-08-08','05:00:00',700.00),(14,'Turkish Airlines','Istanbul','Moscow','2024-08-08','09:00:00','2024-08-08','12:00:00',300.00),(15,'Qatar Airways','Doha','Bangkok','2024-08-09','23:00:00','2024-08-10','07:00:00',600.00),(16,'ANA','Tokyo','Honolulu','2024-08-10','19:00:00','2024-08-10','07:00:00',650.00),(17,'Air France','Paris','New York','2024-08-01','10:00:00','2024-08-01','13:00:00',450.00),(18,'Delta Airlines','New York','Los Angeles','2024-08-02','12:00:00','2024-08-02','15:00:00',350.00),(19,'British Airways','London','Tokyo','2024-08-03','16:00:00','2024-08-04','11:00:00',750.00),(20,'Emirates','Dubai','Sydney','2024-08-04','22:00:00','2024-08-05','06:00:00',900.00),(21,'Lufthansa','Berlin','Chicago','2024-08-05','08:00:00','2024-08-05','11:00:00',550.00),(22,'Qantas','Sydney','San Francisco','2024-08-06','14:00:00','2024-08-06','10:00:00',800.00),(23,'Singapore Airlines','Singapore','Frankfurt','2024-08-07','18:00:00','2024-08-08','05:00:00',700.00),(24,'Turkish Airlines','Istanbul','Moscow','2024-08-08','09:00:00','2024-08-08','12:00:00',300.00),(25,'Qatar Airways','Doha','Bangkok','2024-08-09','23:00:00','2024-08-10','07:00:00',600.00),(26,'ANA','Tokyo','Honolulu','2024-08-10','19:00:00','2024-08-10','07:00:00',650.00);
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

-- Dump completed on 2024-07-29 16:19:29
