-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bangkit_jaya
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang` (
  `kode` varchar(15) NOT NULL,
  `nama_barang` varchar(45) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `kategori` varchar(10) DEFAULT NULL,
  `model` varchar(10) DEFAULT NULL,
  `ukuran` varchar(5) DEFAULT NULL,
  `warna` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `createdAt` datetime(3) DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) DEFAULT current_timestamp(3),
  `id_pengguna` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES ('675E728A30E70','Kaos',100000,'katun','Polos','XL','Hitam',77,'2024-12-15 13:09:13.000','2024-12-18 15:34:08.000',2),('676244B2D2BB3','kemeja',35000,'sutra','kotak kota','XXL','hitam',-6,'2024-12-18 10:42:42.388','2024-12-18 10:45:56.000',2),('67624C62B5B3D','kalender',100000,'kertas','Polos','XXL','putih',97,'2024-12-18 11:15:30.572','2024-12-18 15:14:03.000',2),('6762807F9933C','kerudung',10000,'katun','Polos','XL','merah',7,'2024-12-18 14:57:50.862','2024-12-18 15:14:03.000',2);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER before_update_barang
BEFORE UPDATE ON barang
FOR EACH ROW
BEGIN
    SET NEW.updatedAt = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `detail_laporan_penjualan`
--

DROP TABLE IF EXISTS `detail_laporan_penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_laporan_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `harga_penjualan` int(11) DEFAULT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `kode_barang` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_penjualan` (`id_penjualan`),
  KEY `kode_barang` (`kode_barang`),
  CONSTRAINT `detail_laporan_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `laporan_penjualan` (`id_penjualan`),
  CONSTRAINT `detail_laporan_penjualan_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_laporan_penjualan`
--

LOCK TABLES `detail_laporan_penjualan` WRITE;
/*!40000 ALTER TABLE `detail_laporan_penjualan` DISABLE KEYS */;
INSERT INTO `detail_laporan_penjualan` VALUES (26,100000,10,'675E728A30E70'),(27,100000,10,'675E728A30E70'),(28,100000,10,'675E728A30E70'),(29,100000,10,'675E728A30E70'),(30,100000,10,'675E728A30E70'),(31,100000,11,'675E728A30E70'),(32,100000,11,'675E728A30E70'),(33,100000,11,'675E728A30E70'),(34,100000,11,'675E728A30E70'),(35,100000,11,'675E728A30E70'),(36,100000,12,'675E728A30E70'),(37,35000,13,'676244B2D2BB3'),(38,35000,13,'676244B2D2BB3'),(39,100000,13,'675E728A30E70'),(40,35000,14,'676244B2D2BB3'),(41,35000,14,'676244B2D2BB3'),(42,100000,14,'675E728A30E70'),(43,35000,15,'676244B2D2BB3'),(44,35000,15,'676244B2D2BB3'),(45,100000,15,'675E728A30E70'),(46,35000,16,'676244B2D2BB3'),(47,35000,16,'676244B2D2BB3'),(48,100000,16,'675E728A30E70'),(51,100000,18,'67624C62B5B3D'),(52,100000,18,'67624C62B5B3D'),(57,100000,20,'675E728A30E70');
/*!40000 ALTER TABLE `detail_laporan_penjualan` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_insert_detail_laporan_penjualan
AFTER INSERT ON detail_laporan_penjualan
FOR EACH ROW
BEGIN
    UPDATE barang 
    SET jumlah = jumlah - 1
    WHERE kode = NEW.kode_barang;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `laporan_penjualan`
--

DROP TABLE IF EXISTS `laporan_penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laporan_penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `total_harga` int(11) DEFAULT NULL,
  `createdAt` datetime(3) DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) DEFAULT current_timestamp(3),
  `id_pengguna` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `laporan_penjualan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan_penjualan`
--

LOCK TABLES `laporan_penjualan` WRITE;
/*!40000 ALTER TABLE `laporan_penjualan` DISABLE KEYS */;
INSERT INTO `laporan_penjualan` VALUES (9,500000,'2024-12-15 13:11:24.000','2024-12-15 13:11:24.000',2),(10,500000,'2024-12-15 13:14:47.000','2024-12-15 13:14:47.000',2),(11,500000,'2024-12-15 13:14:53.000','2024-12-15 13:14:53.000',2),(12,100000,'2024-12-15 13:17:01.000','2024-12-15 13:17:01.000',2),(13,170000,'2024-12-18 10:45:00.211','2024-12-18 10:45:00.211',2),(14,170000,'2024-12-18 10:45:15.980','2024-12-18 10:45:15.980',2),(15,170000,'2024-12-18 10:45:37.194','2024-12-18 10:45:37.194',2),(16,170000,'2024-12-18 10:45:53.872','2024-12-18 10:45:53.872',2),(18,200000,'2024-12-18 11:17:06.403','2024-12-18 11:17:06.403',2),(20,100000,'2024-12-18 15:34:07.756','2024-12-18 15:34:07.756',1);
/*!40000 ALTER TABLE `laporan_penjualan` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER before_update_laporan_penjualan
BEFORE UPDATE ON laporan_penjualan
FOR EACH ROW
BEGIN
    SET NEW.updatedAt = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(15) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `jenis_pengguna` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','$2y$13$sBI9vaxsfb734DxqECENKOjzkuNMsEts6opaWcO5Hgny4aJqvAdLC','admin'),(2,'owner','$2y$13$sBI9vaxsfb734DxqECENKOjzkuNMsEts6opaWcO5Hgny4aJqvAdLC','owner');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-20  8:41:08
