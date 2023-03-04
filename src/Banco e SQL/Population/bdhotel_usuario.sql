-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bdhotel
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `cpf` bigint NOT NULL,
  `login_login` varchar(45) COLLATE utf8mb3_bin NOT NULL,
  `primeiro_nome` varchar(45) COLLATE utf8mb3_bin DEFAULT NULL,
  `sobrenome` varchar(45) COLLATE utf8mb3_bin DEFAULT NULL,
  `telefone` bigint DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb3_bin DEFAULT NULL,
  `endereco` varchar(45) COLLATE utf8mb3_bin DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `diarias` int DEFAULT NULL,
  `tipo_administrador` tinyint DEFAULT NULL,
  `tipo_cliente` tinyint DEFAULT NULL,
  PRIMARY KEY (`cpf`,`login_login`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `telefone_UNIQUE` (`telefone`),
  KEY `fk_usuario_login1_idx` (`login_login`),
  CONSTRAINT `fk_usuario_login1` FOREIGN KEY (`login_login`) REFERENCES `login` (`login`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin KEY_BLOCK_SIZE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (7104322671,'','Patrick','Leandro Magalhaes',33999057030,'ticaomg@gmail.com','Av. Augusto de lima, 249 -BH','1984-08-21',0,1,1),(44444444444,'hergos','hergos','leandro',33999057034,'hergos@gmail.com','Avenida Augusto de Lima, 249','1993-11-25',0,0,1),(68974852316,'elias','elias','elias',32997775566,'elias@gmail.com','Av. Leite de Castro','2000-06-09',0,0,1),(99999999999,'julio','julio','julio',31985224466,'julio@gmail.com','Rua x sao joao','2022-08-06',0,1,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-06 22:59:57
