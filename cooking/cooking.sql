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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Apple','vegetable'),(2,'Water','vegetable'),(3,'a','vegetable'),(4,'','vegetable'),(5,'1','vegetable'),(6,'123','vegetable'),(7,'12312','vegetable'),(8,'cheese','vegetable'),(9,'milk','vegetable'),(10,'gelatine','vegetable'),(11,'butter','vegetable'),(12,'egg','vegetable'),(13,'Sugar','vegetable'),(14,'cookie','vegetable'),(15,'ricotta','vegetable'),(16,'chocolate','vegetable'),(17,'vanilla ice cream','vegetable'),(18,'banana','vegetable'),(19,'blackberries','vegetable'),(20,'apple juice or mineral water','vegetable'),(21,'oat','vegetable'),(22,'yogurt','vegetable'),(23,'pear','vegetable'),(24,'blueberry','vegetable'),(25,'Orange','vegetable');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `occasion` enum('Breakfast','Meal','Teatime','Party') DEFAULT NULL,
  `method` text,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (1,'1',NULL,'2',NULL),(3,'Apple Juice','Breakfast','Tell you later...',1),(4,'cheese cake','Breakfast','Oil and line a 20cm round loose- bottomed cake tin with cling film, making it as smooth as possible. Melt the butter in a pan. Crush the biscuits by bashing them in a bag with a rolling pin, then stir them into the butter until very well coated. Press the mixture firmly into the base of the tin and chill.\r\nSoak the gelatine in water while you make the filling. Tip the ricotta into a bowl, then beat in the peanut butter and syrup. Ricotta has a slightly grainy texture so blitz until smooth with a stick blender for a smoother texture if you prefer.\r\nTake the soaked gelatine from the water and squeeze dry. Put it into a pan with the milk and heat very gently until the gelatine dissolves. Beat into the peanut mixture, then tip onto the biscuit base. Chill until set.\r\nTo freeze, leave in the tin and as soon as it is solid, cover the surface with cling film, then wrap the tin with cling film and foil.\r\nTo defrost, thaw in the fridge overnight.\r\nTo serve, carefully remove from the tin. Whisk the cream with the sugar until it holds its shape, then spread on top of the cheesecake and scatter with the peanut brittle.',1),(5,'Mocha milkshake','Teatime','Roughly chop 75g of the chocolate and put into a large jug with the coffee. Bring 300ml of the milk just to the boil, then pour over the chocolate and coffee mix, stirring to melt. Once melted, cool.\r\n\r\nTip the cooled mocha milk into the blender with the ice cream and remaining milk. Blitz until blended, then pour into 4 tall glasses. Add an extra scoop of ice cream to each, if you like, then grate a little of the remaining chocolate on top.',1),(6,'Breakfast smoothie','Breakfast','Slice the banana into your blender or food processor and add the berries of your choice. Whizz until smooth. With the blades whirring, pour in juice or water to make the consistency you like. Toss a few extra fruits on top, drizzle with honey and serve.             ',1),(7,'breakfast bowl','Breakfast','Grate the pear into a bowl and add the oats, half the yogurt, the milk and most of the seeds. Leave for 5-10 mins, then check the consistency and dilute with a little more milk or water if it is too thick. Spoon on the remaining yogurt, pile on the berries and remaining seeds, then serve.          ',1),(8,'Orange Juice','Breakfast','Cut the orange and put in the juicer along with the water. Juice following the instructions for your machine. Pour into a large glass and serve.            ',1);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipesingredients`
--

LOCK TABLES `recipesingredients` WRITE;
/*!40000 ALTER TABLE `recipesingredients` DISABLE KEYS */;
INSERT INTO `recipesingredients` VALUES (1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(2,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','2kg'),(3,2,3,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(4,2,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','2Kg'),(5,3,4,'0000-00-00 00:00:00','0000-00-00 00:00:00','2kg'),(6,3,5,'0000-00-00 00:00:00','0000-00-00 00:00:00','1piece'),(7,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(8,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(9,0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(10,0,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(11,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',' 1'),(12,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(13,0,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(14,15,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(15,16,5,'0000-00-00 00:00:00','0000-00-00 00:00:00','2'),(16,17,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(17,18,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(18,19,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(19,20,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(20,21,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(21,22,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(22,23,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(23,24,6,'0000-00-00 00:00:00','0000-00-00 00:00:00','123123123123'),(24,24,7,'0000-00-00 00:00:00','0000-00-00 00:00:00','2131'),(25,25,6,'0000-00-00 00:00:00','0000-00-00 00:00:00','123123123123'),(26,25,7,'0000-00-00 00:00:00','0000-00-00 00:00:00','2131'),(27,26,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(28,27,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(29,28,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(30,29,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(31,30,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(32,31,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(33,32,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(34,33,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(35,34,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',''),(36,35,8,'0000-00-00 00:00:00','0000-00-00 00:00:00','100g'),(37,35,9,'0000-00-00 00:00:00','0000-00-00 00:00:00','1L'),(38,35,10,'0000-00-00 00:00:00','0000-00-00 00:00:00','2pieces'),(39,35,11,'0000-00-00 00:00:00','0000-00-00 00:00:00','50g'),(40,35,12,'0000-00-00 00:00:00','0000-00-00 00:00:00','2'),(41,36,8,'0000-00-00 00:00:00','0000-00-00 00:00:00','100g'),(42,36,9,'0000-00-00 00:00:00','0000-00-00 00:00:00','1L'),(43,36,10,'0000-00-00 00:00:00','0000-00-00 00:00:00','2pieces'),(44,36,11,'0000-00-00 00:00:00','0000-00-00 00:00:00','50g'),(45,36,12,'0000-00-00 00:00:00','0000-00-00 00:00:00','2'),(46,37,8,'0000-00-00 00:00:00','0000-00-00 00:00:00','100g'),(47,37,9,'0000-00-00 00:00:00','0000-00-00 00:00:00','1L'),(48,37,10,'0000-00-00 00:00:00','0000-00-00 00:00:00','2pieces'),(49,37,11,'0000-00-00 00:00:00','0000-00-00 00:00:00','50g'),(50,37,12,'0000-00-00 00:00:00','0000-00-00 00:00:00','2'),(51,3,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','500g'),(52,3,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','1kg'),(53,3,13,'0000-00-00 00:00:00','0000-00-00 00:00:00','100g'),(54,4,11,'0000-00-00 00:00:00','0000-00-00 00:00:00','50g'),(55,4,14,'0000-00-00 00:00:00','0000-00-00 00:00:00','175g'),(56,4,10,'0000-00-00 00:00:00','0000-00-00 00:00:00','5pieces'),(57,4,15,'0000-00-00 00:00:00','0000-00-00 00:00:00','500g'),(58,4,9,'0000-00-00 00:00:00','0000-00-00 00:00:00','150g'),(59,5,16,'0000-00-00 00:00:00','0000-00-00 00:00:00','85g'),(60,5,9,'0000-00-00 00:00:00','0000-00-00 00:00:00','700g'),(61,5,17,'0000-00-00 00:00:00','0000-00-00 00:00:00','4 scoops'),(62,6,18,'0000-00-00 00:00:00','0000-00-00 00:00:00','1'),(63,6,19,'0000-00-00 00:00:00','0000-00-00 00:00:00','140g'),(64,6,20,'0000-00-00 00:00:00','0000-00-00 00:00:00','200g'),(65,7,21,'0000-00-00 00:00:00','0000-00-00 00:00:00','50g'),(66,7,22,'0000-00-00 00:00:00','0000-00-00 00:00:00','150g'),(67,7,23,'0000-00-00 00:00:00','0000-00-00 00:00:00','1'),(68,7,24,'0000-00-00 00:00:00','0000-00-00 00:00:00','50g'),(69,8,25,'0000-00-00 00:00:00','0000-00-00 00:00:00','1'),(70,8,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','100g');
/*!40000 ALTER TABLE `recipesingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'czx','czx','cf2590e3c93e2e3b9ff96a34dfbc2db8180bd1b0',1),(2,'yx','yx','e93b4e3c464ffd51732fbd6ded717e9efda28aad',1),(3,'olivier','olivier','663194f2b9123a38cd9e2e2811f8d2fd387b765e',1),(4,'dominique','dominique','9cc140dd813383e134e7e365b203780da9376438',0),(6,'nsfxc@hotmail.com','nsfxc','cf2590e3c93e2e3b9ff96a34dfbc2db8180bd1b0',NULL),(7,'nnssffxxcc@gmail.com','nnssffxxcc','cf2590e3c93e2e3b9ff96a34dfbc2db8180bd1b0',0),(8,'nsfxc@sina.com','nsfxc','cf2590e3c93e2e3b9ff96a34dfbc2db8180bd1b0',0);
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

-- Dump completed on 2015-01-19 20:06:09
