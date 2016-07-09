-- MySQL dump 10.13  Distrib 5.5.15, for Win32 (x86)
--
-- Host: localhost    Database: icahmt
-- ------------------------------------------------------
-- Server version	5.5.15

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
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Project1','Cold storage','./images/projects/1.jpg'),(2,'Project2','Shipping','./images/projects/2.jpg'),(3,'Project3','Service','./images/projects/3.jpg'),(4,'Project4','Shipping','./images/projects/4.jpg');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(45) NOT NULL,
  `company` varchar(45) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  `testimonial` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Customer1','Company1','CEO','Exceptional services. Want to continue.'),(2,'Customer2','Company2','CTO','Amazing support. Nice experience and exceptional services'),(3,'Customer3','Company3','CEO','Great work, Support, Nicfaeafs kjdfkaj  dflkajgrklj fsfkldjgtkjerrkj dfdsfewreijrgkfdjgdslfsf f.'),(4,'Customer4','Company4','CTO','Great work, Support, Nicfaeafs kjdfkaj  dflkajgrklj fsfkldjgtkjerrkj dfdsfewreijrgkfdjgdslfsf f.Great work, Support, Nicfaeafs kjdfkaj  dflkajgrklj fsfkldjgtkjerrkj dfdsfewreijrgkfdjgdslfsf f.'),(5,'Customer5','Comapny5','CTO','Great work, Support, Nicfaeafs kjdfkaj  dflkajgrklj fsfkldjgtkjerrkj dfdsfewreijrgkfdjgdslfsf f.Great work, Support, Nicfaeafs kjdfkaj  dflkajgrklj fsfkldjgtkjerrkj dfdsfewreijrgkfdjgdslfsf f.'),(6,'Cust6','Cmp6','CETO','Great work, Support, Nicfaeafs kjdfkaj  dflkajgrklj fsfkldjgtkjerrkj dfdsfewreijrgkfdjgdslfsf f.');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `resetPasswordToken` varchar(45) DEFAULT NULL,
  `company_name` varchar(45) DEFAULT NULL,
  `address1` varchar(1000) DEFAULT NULL,
  `address2` varchar(1000) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `zip_code` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type` (`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@admin.com','admin@123',0,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,'bhavin','pojarabhavin22@gmail.com','bhavin@22',1,'192.168.0.75',NULL,'fwrwerwr','rywueiry','yttytu','asdsad','rsfdsfsdfsdfsdfsdf','fasfsfsdf','8767314191');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-09 14:10:38
