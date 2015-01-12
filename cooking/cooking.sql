-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cooking
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'czx','cf2590e3c93e2e3b9ff96a34dfbc2db8180bd1b0');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('vegetable','fruit','meat','diary','snack','condiment') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Apple','vegetable'),(2,'Water','vegetable'),(3,'a','vegetable'),(4,'','vegetable'),(5,'1','vegetable'),(6,'123','vegetable'),(7,'12312','vegetable');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_12_23_102138_ingredients',1),('2014_12_23_102152_recipes',1),('2014_12_23_141245_recipe_add_method',2),('2014_12_23_203755_complete_two_databases',3),('2014_12_25_161427_create_users',4),('2014_12_25_220338_userdatabasemodify',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipes` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `occasion` enum('Breakfast','Meal','Party','Teatime') DEFAULT NULL,
  `method` mediumtext,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_userrecipe` (`user`),
  CONSTRAINT `fk_userrecipe` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (13,'test','Breakfast','1ae',NULL),(14,'asd','Breakfast','                        Write your method here                    asdsad',NULL),(15,'asd','Breakfast','                        Write your method here                    asdsad',NULL),(16,'123','Breakfast','                        Write your method here                    ',NULL),(17,'11','Breakfast','                        Write your method here                    ',NULL),(18,'aa','Breakfast','                        Write your method here                    ',NULL),(19,'er','Breakfast','                        Write your method here                    ',NULL),(20,'er','Breakfast','                        Write your method here                    ',NULL),(21,'qw','Breakfast','                        Write your method here                    ',NULL),(22,'w','Breakfast','                        Write your method here                    ',NULL),(23,'123','Breakfast','                        Write your method here                    ',NULL),(24,'123','Breakfast','                        Write your method here                    ',NULL),(25,'12','Breakfast','                        Write your method here                    ',NULL),(26,'12','Breakfast','                        Write your method here                    ',NULL),(27,'234','Breakfast','                        Write your method here                    ',NULL),(28,'234','Breakfast','                        Write your method here                    ',NULL),(29,'234','Breakfast','                        Write your method here                    ',NULL),(30,'234','Breakfast','                        Write your method here                    ',NULL),(31,'234','Breakfast','                        Write your method here                    ',NULL),(32,'234','Breakfast','                        Write your method here                    ',NULL),(33,'234','Breakfast','                        Write your method here                    ',NULL),(34,'234','Breakfast','                        Write your method here                    ',NULL),(35,'234','Breakfast','                        Write your method here                    ',NULL);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes-ingredients`
--

DROP TABLE IF EXISTS `recipes-ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipes-ingredients` (
  `recipe` int(11) NOT NULL,
  `ingredient` int(11) NOT NULL,
  KEY `recipes_ingredients_recipe_index` (`recipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes-ingredients`
--

LOCK TABLES `recipes-ingredients` WRITE;
/*!40000 ALTER TABLE `recipes-ingredients` DISABLE KEYS */;
INSERT INTO `recipes-ingredients` VALUES (1,1);
/*!40000 ALTER TABLE `recipes-ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipesingredients`
--

DROP TABLE IF EXISTS `recipesingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipesingredients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recipe` int(11) NOT NULL,
  `ingredient` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `amount` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipesingredients_recipe_index` (`recipe`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipesingredients`
--

LOCK TABLES `recipesingredients` WRITE;
/*!40000 ALTER TABLE `recipesingredients` DISABLE KEYS */;
INSERT INTO `recipesingredients` VALUES (1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(2,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','2kg'),(3,2,3,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(4,2,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','2Kg'),(5,3,4,'0000-00-00 00:00:00','0000-00-00 00:00:00','2kg'),(6,3,5,'0000-00-00 00:00:00','0000-00-00 00:00:00','1piece'),(7,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(8,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(9,0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(10,0,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(11,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',' 1'),(12,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(13,0,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(14,15,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(15,16,5,'0000-00-00 00:00:00','0000-00-00 00:00:00','2'),(16,17,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(17,18,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(18,19,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(19,20,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(20,21,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(21,22,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(22,23,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(23,24,6,'0000-00-00 00:00:00','0000-00-00 00:00:00','123123123123'),(24,24,7,'0000-00-00 00:00:00','0000-00-00 00:00:00','2131'),(25,25,6,'0000-00-00 00:00:00','0000-00-00 00:00:00','123123123123'),(26,25,7,'0000-00-00 00:00:00','0000-00-00 00:00:00','2131'),(27,26,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(28,27,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(29,28,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(30,29,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(31,30,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(32,31,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(33,32,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(34,33,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(35,34,4,'0000-00-00 00:00:00','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `recipesingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `try`
--

DROP TABLE IF EXISTS `try`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `try` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id` (`user`),
  CONSTRAINT `fk_id` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `try`
--

LOCK TABLES `try` WRITE;
/*!40000 ALTER TABLE `try` DISABLE KEYS */;
/*!40000 ALTER TABLE `try` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `grade_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'nsfxc','0e7d1af3be0f6df621a081e030e7139d58950399',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','nnssffxxcc@gmail.com',0),(13,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(18,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(19,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(21,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(23,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(24,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(25,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(27,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(28,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(29,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(31,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(32,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(33,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(34,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0),(35,'nsfxc','414807',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','nsfxc@hotmail.com',0),(36,'','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','abcd@emi',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersfavorrecipes`
--

DROP TABLE IF EXISTS `usersfavorrecipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usersfavorrecipes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `favorrecipe` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `usersfavorrecipes_user_index` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersfavorrecipes`
--

LOCK TABLES `usersfavorrecipes` WRITE;
/*!40000 ALTER TABLE `usersfavorrecipes` DISABLE KEYS */;
/*!40000 ALTER TABLE `usersfavorrecipes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-12 22:39:16
