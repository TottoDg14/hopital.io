-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: hospital
-- ------------------------------------------------------
-- Server version	10.3.31-MariaDB-0+deb10u1

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
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cita` (
  `cita_id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `responsable_id` int(11) NOT NULL,
  `correlativo` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `estatus` int(1) NOT NULL,
  PRIMARY KEY (`cita_id`),
  KEY `paciente_usuario_FK` (`paciente_id`),
  KEY `responsable_usuario_FK` (`responsable_id`),
  CONSTRAINT `paciente_usuario_FK` FOREIGN KEY (`paciente_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `responsable_usuario_FK` FOREIGN KEY (`responsable_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (1,11,11,'NC10000','2022-02-20 16:00:00',0),(2,11,11,'NC10001','2022-02-20 16:00:00',1),(3,11,11,'NC10002','2022-02-22 16:00:00',1),(4,11,11,'NC10003','2022-02-22 16:00:00',1),(5,10,11,'NC10004','2022-02-28 16:00:00',1),(6,10,2,'NC10005','2022-03-01 16:00:00',1),(7,10,2,'NC10006','2022-03-02 16:00:00',1),(8,10,2,'NC10007','2022-03-03 16:00:00',1),(9,10,2,'NC10008','2022-03-04 16:00:00',1);
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estatus` int(1) NOT NULL,
  PRIMARY KEY (`rol_id`),
  UNIQUE KEY `rol` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Doctor',1),(2,'Paciente',1);
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `estatus` int(1) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `correo` (`correo`),
  KEY `usuario_rol` (`rol_id`),
  CONSTRAINT `usuario_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'Roberto Manrique','rmanrique@hospital.com','2022-02-18 21:02:53',1),(2,1,'Yulimar Gutierrez','ygutierrez@hospital.com','2022-02-18 21:02:37',1),(3,1,'Alfredo Salamanca','asalamanca@hospital.com','2022-02-18 21:02:53',1),(4,1,'Pedro Gonzalez','pgonzalez@hospital.com','2022-02-18 21:02:16',1),(5,1,'Tulio Pinto','tpinto@hospital.com','2022-02-18 21:02:55',1),(7,2,'Margarita Alvarado','margalvarado@live.com','2022-02-18 21:02:45',1),(8,2,'Rafel Munoz','ingrafaelmunoz@yahoo.com','2022-02-18 21:02:57',1),(9,2,'Julio Perez','julperz@gmail.com','2022-02-18 21:02:09',1),(10,2,'Carlos Martinez','carlitos92@gmail.com','2022-02-18 21:02:35',1),(11,1,'Romulo Torres','rtorres@hospital.com','2022-02-18 21:02:05',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'hospital'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-19  1:10:56
