CREATE DATABASE  IF NOT EXISTS `onlinenews` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `onlinenews`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: onlinenews
-- ------------------------------------------------------
-- Server version	5.7.13-log

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
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `newsId` int(10) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
INSERT INTO `bookmarks` VALUES (183,2,2,0,'2016-07-11 11:01:22','2016-07-11 11:01:22'),(184,2,3,0,'2016-07-11 11:01:25','2016-07-11 11:01:25'),(185,2,4,0,'2016-07-11 11:01:28','2016-07-11 11:01:28'),(191,1,1,0,'2016-07-12 08:17:22','2016-07-12 08:17:22'),(192,1,2,1,'2016-07-12 08:17:26','2016-07-12 08:17:26'),(194,5,22,1,'2016-07-14 07:20:51','2016-07-14 07:20:51'),(198,5,21,0,'2016-07-18 09:58:24','2016-07-18 09:58:24'),(199,5,20,0,'2016-07-18 09:58:27','2016-07-18 09:58:27'),(200,5,1,0,'2016-07-18 09:58:30','2016-07-18 09:58:30'),(201,5,2,0,'2016-07-18 09:58:32','2016-07-18 09:58:32'),(202,5,3,0,'2016-07-18 09:58:35','2016-07-18 09:58:35'),(203,5,4,1,'2016-07-18 09:58:38','2016-07-18 09:58:38'),(204,33,4,0,'2016-07-19 15:03:52','2016-07-19 15:03:52'),(205,33,5,1,'2016-07-19 15:03:55','2016-07-19 15:03:55'),(206,33,6,0,'2016-07-19 15:03:59','2016-07-19 15:03:59'),(208,2,22,1,'2016-07-19 15:32:21','2016-07-19 15:32:21');
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Thể thao','2016-06-29 19:40:44','2016-06-29 19:40:44'),(2,'Y tế','2016-06-29 19:40:44','2016-06-29 19:40:44'),(3,'Giáo dục','2016-06-29 19:40:44','2016-06-29 19:40:44'),(4,'Xe và đời sống','2016-06-29 19:40:44','2016-06-29 19:40:44'),(5,'Ẩm thực','2016-06-29 19:40:44','2016-06-29 19:40:44'),(6,'Thời trang','2016-06-29 19:40:44','2016-06-29 19:40:44'),(7,'An ninh xã hội','2016-06-29 19:40:44','2016-06-29 19:40:44'),(8,'Tin thế giới','2016-06-29 19:40:44','2016-06-29 19:40:44'),(9,'Tài chính - chứng khoán','2016-06-29 19:40:44','2016-06-29 19:40:44'),(10,'Pháp luật và đời sống','2016-06-29 19:40:44','2016-06-29 19:40:44'),(11,'Việc tử tế','2016-06-29 19:40:44','2016-06-29 19:40:44'),(12,'Tin giới trẻ','2016-06-29 19:40:44','2016-06-29 19:40:44');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fileentries`
--

DROP TABLE IF EXISTS `fileentries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fileentries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fileentries`
--

LOCK TABLES `fileentries` WRITE;
/*!40000 ALTER TABLE `fileentries` DISABLE KEYS */;
INSERT INTO `fileentries` VALUES (1,'php344B.tmp.jpg','image/jpeg','htc_one_m9_stock-1366x768.jpg','2016-06-28 19:57:09','2016-06-28 19:57:09'),(2,'php609C.tmp.jpg','image/jpeg','love_flower_3-wallpaper-1366x768.jpg','2016-06-28 19:57:21','2016-06-28 19:57:21'),(3,'php96FF.tmp.jpg','image/jpeg','daylight_green_fields-1366x768.jpg','2016-06-28 19:57:35','2016-06-28 19:57:35'),(4,'php5A05.tmp.jpg','image/jpeg','dragon_18-wallpaper-1366x768.jpg','2016-06-29 00:12:55','2016-06-29 00:12:55'),(5,'php29C0.tmp.jpg','image/jpeg','Game_AiLaTrieuPhu.jpg','2016-07-19 08:00:56','2016-07-19 08:00:56'),(6,'phpBC2D.tmp.jpg','image/jpeg','Game_AiLaTrieuPhu.jpg','2016-07-19 08:01:33','2016-07-19 08:01:33'),(7,'php73A7.tmp.jpg','image/jpeg','Game_AiLaTrieuPhu.jpg','2016-07-19 08:02:20','2016-07-19 08:02:20'),(8,'php2852.tmp.jpg','image/jpeg','Game_AiLaTrieuPhu.jpg','2016-07-19 08:03:06','2016-07-19 08:03:06'),(9,'php85AC.tmp.jpg','image/jpeg','logo.jpg','2016-07-19 08:05:41','2016-07-19 08:05:41');
/*!40000 ALTER TABLE `fileentries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL DEFAULT '""',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,NULL,NULL,'news10.jpg'),(2,NULL,NULL,'news1.jpg'),(3,NULL,NULL,'news2.jpg'),(4,NULL,NULL,'news3.jpg'),(5,NULL,NULL,'news4.jpg'),(6,NULL,NULL,'news5.jpg'),(7,NULL,NULL,'news6.jpg'),(8,NULL,NULL,'news7.jpg'),(9,NULL,NULL,'news8.jpg'),(10,NULL,NULL,'news9.jpg'),(11,'2016-07-14 04:35:36','2016-07-14 04:35:36','1361841589_Game_BanhXopDauTay(1).jpg'),(12,'2016-07-14 06:25:13','2016-07-14 06:25:13','botruong.jpg'),(13,'2016-07-14 06:32:25','2016-07-14 06:32:25','ngoaigiaothamlang.png'),(14,'2016-07-14 07:19:39','2016-07-14 07:19:39','ngoaigiaothamlang.PNG'),(15,'2016-07-19 10:13:15','2016-07-19 10:13:15','sample.jpg'),(16,'2016-07-19 10:25:20','2016-07-19 10:25:20','sample.jpg'),(17,'2016-07-19 10:26:11','2016-07-19 10:26:11','sample.jpg'),(18,'2016-07-19 14:12:26','2016-07-19 14:12:26','news3.jpg'),(19,'2016-07-19 15:29:52','2016-07-19 15:29:52','rightNav2.jpg'),(20,'2016-07-19 15:31:03','2016-07-19 15:31:03','rightNav2.jpg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_06_28_080609_create_fileentries_table',1),('2016_07_06_095019_create_news_table',2),('2016_07_13_041932_create_sessions_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsimages`
--

DROP TABLE IF EXISTS `newsimages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsimages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `newsId` int(10) NOT NULL,
  `imageId` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsimages`
--

LOCK TABLES `newsimages` WRITE;
/*!40000 ALTER TABLE `newsimages` DISABLE KEYS */;
INSERT INTO `newsimages` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,1,3,NULL,NULL),(4,2,1,NULL,NULL),(5,2,9,NULL,NULL),(6,3,8,NULL,NULL),(7,4,7,NULL,NULL),(8,5,4,NULL,NULL),(9,6,4,NULL,NULL),(10,7,5,NULL,NULL),(11,8,5,NULL,NULL),(12,9,6,NULL,NULL),(15,12,1,NULL,NULL),(16,19,11,'2016-07-14 04:35:37','2016-07-14 04:35:37'),(17,20,12,'2016-07-14 06:25:14','2016-07-14 06:25:14'),(18,21,13,'2016-07-14 06:32:25','2016-07-14 06:32:25'),(21,10,17,'2016-07-19 10:26:11','2016-07-19 10:26:11'),(22,11,18,'2016-07-19 14:12:26','2016-07-19 14:12:26'),(24,22,20,'2016-07-19 15:31:03','2016-07-19 15:31:03');
/*!40000 ALTER TABLE `newsimages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newss`
--

DROP TABLE IF EXISTS `newss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newss` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cateId` int(10) NOT NULL,
  `authId` int(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `shortDescription` varchar(1000) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `ratingPoint` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newss`
--

LOCK TABLES `newss` WRITE;
/*!40000 ALTER TABLE `newss` DISABLE KEYS */;
INSERT INTO `newss` VALUES (4,4,1,'Cận cảnh dự án nghìn tỷ khiến nhiều lãnh đạo TP. Vũng Tàu bị khởi1 tố','Dự án Metropolitan được quy hoạch trên diện tích 210.000 m2 bên quốc lộ 51B với tổng vốn đầu tư 8.000 tỷ đồng và dự kiến lên mức 13.000 tỷ đồng. Nhưng hiện nay, dự án “khủng” nà1y như một bãi đất hoang...','<h1><img alt=\"Saturn V carrying Apollo 11\" class=\"right\" src=\"http://c.cksource.com/a/1/img/sample.jpg\" /> Apollo 11</h1>',1,10,'2016-06-29 19:40:44','2016-06-29 19:40:44'),(5,1,1,'Cận cảnh dự án nghìn tỷ khiến nhiều lãnh đạo TP. Vũng Tàu bị k1hởi tố','Dự án Metropolitan được quy hoạch trên diện tích 210.000 m2 bên quốc lộ 51B với tổng vốn đầu tư 8.000 tỷ đồng và dự kiến lên mức 13.000 tỷ đồng. Nhưng hiện nay, dự án “khủng” này như1 một bãi đất hoang...','<h1><img alt=\"Saturn V carrying Apollo 11\" class=\"right\" src=\"http://c.cksource.com/a/1/img/sample.jpg\" /> Apollo 11</h1>',1,10,'2016-06-29 19:40:44','2016-06-29 19:40:44'),(6,1,1,'Cận cảnh dự án nghìn tỷ khiến nhiều lãnh đạo TP. 1Vũng Tàu1 bị khởi tố','Dự án Metropolitan được quy hoạch trên diện tích 210.000 m2 bên quốc lộ 51B với tổng vốn đầu tư 8.000 tỷ đồng và dự kiến lên mức 13.000 tỷ đồng. Nhưng hiện nay, dự án “khủng” này như một bãi đất ho1ang...','<h1><img alt=\"Saturn V carrying Apollo 11\" class=\"right\" src=\"http://c.cksource.com/a/1/img/sample.jpg\" /> Apollo 11</h1>',1,10,'2016-06-29 19:40:44','2016-06-29 19:40:44'),(7,1,2,'Cận cảnh dự án nghìn tỷ khiến nhiều lãnh1 đạ1111o TP. 1Tàu bị khởi tố','Dự án Metropolitan được quy hoạch trên diện tích 210.000 m2 bên quốc lộ 51B với tổng vốn đầu tư 8.000 tỷ đồng và dự kiến lên mức 13.000 tỷ đồng. Nhưng hiện nay, dự án “khủng” này như1 một bãi 1hoang...','<h1><img alt=\"Saturn V carrying Apollo 11\" class=\"right\" src=\"http://c.cksource.com/a/1/img/sample.jpg\" /> Apollo 11</h1>',1,10,'2016-06-29 19:40:44','2016-06-29 19:40:44'),(8,8,2,'Cận cảnh dự án nghìn tỷ khiến nhiều lãnh đạo T1P. 1111111111111111111111111Tàu bị khởi tố','Dự án Metropolitan được quy hoạch trên diện tích 210.000 m2 bên quốc lộ 51B với tổng vốn đầu tư 8.000 tỷ đồng và dự kiến lên mức 13.000 tỷ đồng. Nhưng hiện nay, dự án “khủng” 1như 1b1ãi đất hoang...','<h1><img alt=\"Saturn V carrying Apollo 11\" class=\"right\" src=\"http://c.cksource.com/a/1/img/sample.jpg\" /> Apollo 11</h1>',1,10,'2016-06-29 19:40:44','2016-06-29 19:40:44'),(9,1,2,'Cận cảnh dự án nghìn tỷ khiến nhiều lãnh đạo T1P. V111111111111111ũ1ng Tàu bị khởi tố','Dự án Metropolitan được quy hoạch trên diện tích 210.000 m2 bên quốc lộ 51B với tổng vốn đầu tư 8.000 tỷ đồng và dự kiến lên mức 13.000 tỷ đồng. Nhưng hiện nay, dự án “khủng” này như m1ột bãi 1','<h1><img alt=\"Saturn V carrying Apollo 11\" class=\"right\" src=\"http://c.cksource.com/a/1/img/sample.jpg\" /> Apollo 11</h1>',1,10,'2016-06-29 19:40:44','2016-06-29 19:40:44'),(10,12,3,'------Cận cảnh dự án nghìn tỷ khiến nhiều lãnh đạo T1P. V1111111111ũng Tàu bị khởi tố','-----Dự án Metropolitan được quy hoạch trên diện tích 210.000 m2 bên quốc lộ 51B với tổng vốn đầu tư 8.000 tỷ đồng và dự kiến lên mức 13.000 tỷ đồng. Nhưng hiện nay, dự án “khủng” này như một bãi 111111hoang...','<h1><img alt=\"Saturn V carrying Apollo 11\" class=\"right\" src=\"http://c.cksource.com/a/1/img/sample.jpg\" style=\"float:left\" />-----------<img alt=\"\" src=\"/templateEditor/kcfinder/upload/images/news2.jpg\" style=\"float:left; height:275px; width:183px\" />Apollo 11</h1>\n',1,10,'2016-06-29 19:40:44','2016-06-29 19:40:44'),(11,11,3,'Cận cảnh dự án nghìn tỷ khiến nhiều lãnh đạo T1P. Vũ11ng Tàu bị khởi tố','Dự án Metropolitan được quy hoạch trên diện tích 210.000 m2 bên quốc lộ 51B với tổng vốn đầu tư 8.000 tỷ đồng và dự kiến lên mức 13.000 tỷ đồng. Nhưng hiện nay, dự án “khủng” này như m1ột b111111111ãi đất hoang...','<h1><img alt=\"\" src=\"/templateEditor/kcfinder/upload/images/news3.jpg\" style=\"height:156px; width:246px\" />Apollo 11</h1>\n',1,10,'2016-06-29 19:40:44','2016-06-29 19:40:44'),(12,12,3,'Cận cảnh dự án nghìn tỷ khiến nhiều lãnh đạo TP. Vũ1ng Tà111u bị khởi tố','Dự án Metropolitan được quy hoạch trên diện tích 210.000 m2 bên quốc lộ 51B với tổng vốn đầu tư 8.000 tỷ đồng và dự kiến lên mức 13.000 tỷ đồng. Nhưng hiện nay, dự án “khủng” này như một bã11111111111111111111i đất hoang...','<h1><img alt=\"Saturn V carrying Apollo 11\" class=\"right\" src=\"http://c.cksource.com/a/1/img/sample.jpg\" /> Apollo 11</h1>',0,10,'2016-06-29 19:40:44','2016-06-29 19:40:44'),(22,3,5,'Upload files or images in laravel 5','It’s easy to working with files or images in laravel 5. we can easily validate and upload files in laravel 5. laravel 5 have it’s own functions to make files upload easy and fast. i am sharing some code to upload image in laravel 5 or any of files type. it’s also easy to validate file types.','<p><img alt=\"\" src=\"/templateEditor/kcfinder/upload/images/rightNav2.jpg\" style=\"height:500px; width:300px\" /></p>\n\n<p><strong><u><em>2. create a controller and add below function (in my case i have&nbsp;ApplyController):-</em></u></strong></p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>\n	<p><cite>Don Marco</cite></p>\n\n	<p>hi how are you able to link each image to each new item?</p>\n\n	<ul>\n		<li>\n		<p><cite>http://www.tutsnare.com/&nbsp;tut snare</cite></p>\n\n		<p>what you mean by link image, get all images from db and add your link?</p>\n\n		<ul>\n			<li>\n			<p><cite>Don Marco</cite></p>\n\n			<p>like, when you&rsquo;re a admin and you&rsquo;re adding a new item. How are you able to put the image inside the item data so that the image will be displayed when displaying the item details on a website</p>\n\n			<ul>\n				<li>\n				<p><cite>http://www.tutsnare.com/&nbsp;tut snare</cite></p>\n\n				<p>it&rsquo;s depend on you how you adding item. use db for this insert a row with item and image and get data from db and show</p>\n				</li>\n			</ul>\n			</li>\n		</ul>\n		</li>\n	</ul>\n	</li>\n	<li>\n	<p><cite>Charles Sutanto</cite></p>\n\n	<p>where is the destination path for uploaded image should I make? and where should i make the destination folder? thanks&nbsp;<img alt=\":)\" src=\"http://tutsnare.com/wp-includes/images/smilies/icon_smile.gif\" /></p>\n\n	<ul>\n		<li>\n		<p><cite>http://www.tutsnare.com/&nbsp;tut snare</cite></p>\n\n		<p>it will be your application root for ex &ldquo;public/uploads&rdquo;<br />\n		or if you have removed public then will be on &ldquo;server root/uploads&rdquo;</p>\n\n		<ul>\n			<li>\n			<p><cite>Charles Sutanto</cite></p>\n\n			<p>thanks!!</p>\n			</li>\n		</ul>\n		</li>\n	</ul>\n	</li>\n	<li>\n	<p><cite>Eric Mathiesen</cite></p>\n\n	<p>Wont this possibly create issues with duplicate filenames? Since its a rand wont there be a chance that 2 files get the same name?</p>\n\n	<ul>\n		<li>\n		<p><cite>Ritual</cite></p>\n\n		<p>Possible, I would go with a timestamp + random.</p>\n		</li>\n	</ul>\n	</li>\n	<li>\n	<p><cite>http://gravatar.com/tldmic&nbsp;mike</cite></p>\n\n	<p>Hi Guys, I tried to code, but I get error,</p>\n\n	<p>Symfony Component<br />\n	HttpKernel Exception<br />\n	NotFoundHttpException, is there something wrong I am doing</p>\n\n	<ul>\n		<li>\n		<p><cite>rakesh sharma</cite></p>\n\n		<p>The &lsquo;NotFoundHttpException&rsquo; means Laravel wasn&rsquo;t able to find a route to for the request.check your routes is set properly</p>\n\n		<ul>\n			<li>\n			<p><cite>http://gravatar.com/tldmic&nbsp;mike</cite></p>\n\n			<p>Hi Rakesh, I got it right thank you&nbsp;<img alt=\":)\" src=\"http://tutsnare.com/wp-includes/images/smilies/icon_smile.gif\" /></p>\n			</li>\n		</ul>\n		</li>\n	</ul>\n	</li>\n	<li>\n	<p><cite>James Curry</cite></p>\n\n	<p>Hi, I&rsquo;m new to laravel and I have followed the code and am outputting the code rather than the form, does anyone know why this is happening? I am sure its a small mistake or something.</p>\n\n	<ul>\n		<li>\n		<p><cite>rakesh sharma</cite></p>\n\n		<p>In laravel 5 {{ }} has been deprecated use {!! !!} for form elements. I am updating all articles with laravel 5. it will take some more time.<br />\n		ex:-</p>\n\n		<p>{{ Form::file(&lsquo;image&rsquo;) }} will be {!! Form::file(&lsquo;image&rsquo;) !!}</p>\n		</li>\n		<li>\n		<p><cite>rakesh sharma</cite></p>\n\n		<p>please try now updated with laravel 5</p>\n		</li>\n		<li>\n		<p><cite>http://daniakbar.com&nbsp;Dani Akbar</cite></p>\n\n		<p>{{ }} hash been remove at laravel 5, just smal step you can use {!! !!},</p>\n\n		<p>Begin by installing this package through Composer. Edit your project&rsquo;s composer.json file to require laravelcollective/html.</p>\n\n		<p>&ldquo;require&rdquo;: {<br />\n		&ldquo;laravelcollective/html&rdquo;: &ldquo;~5.0&Prime;<br />\n		}</p>\n\n		<p>Next, update Composer from the Terminal:</p>\n\n		<p>composer update</p>\n\n		<p>Next, add your new provider to the providers array of config/app.php:</p>\n\n		<p>&lsquo;providers&rsquo; =&gt; [<br />\n		// &hellip;<br />\n		&lsquo;CollectiveHtmlHtmlServiceProvider&rsquo;,<br />\n		// &hellip;<br />\n		],</p>\n\n		<p>Finally, add two class aliases to the aliases array of config/app.php:</p>\n\n		<p>&lsquo;aliases&rsquo; =&gt; [<br />\n		// &hellip;<br />\n		&lsquo;Form&rsquo; =&gt; &lsquo;CollectiveHtmlFormFacade&rsquo;,</p>\n		</li>\n		<li>\n		<p><img alt=\"\" src=\"/templateEditor/kcfinder/upload/images/news5.jpg\" style=\"height:183px; width:276px\" /></p>\n		</li>\n	</ul>\n	</li>\n</ul>\n\n<p>&nbsp;</p>\n',1,0,'2016-07-19 08:29:52','2016-07-19 08:29:52');
/*!40000 ALTER TABLE `newss` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `gender` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'nữ',
  `dateOfBirth` varchar(50) COLLATE utf8_unicode_ci DEFAULT '1995-01-01',
  `homeTown` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Ba Vì - Hà Nội',
  `hobbies` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'street workout',
  `sortDescription` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.',
  `phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0909999999',
  `imageId` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Viewer Abc','admin1@gmail.com','$2y$10$HFe0DHjoxEpUrLEvzKFXfOs9JMkK45ltQL1ttCqBaRgHdF.AWV5Yu','hQkpOOWg7NEnGsp75D7PhPJb9yfu9Pj21rn93UriCjnnfJWLEw4CBW1akZVd','2016-06-29 19:40:44','2016-07-19 00:03:31',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','3'),(2,'Đặng Minh Thế','minhthe@gmail.com','$2y$10$RZOjS02nHyIFpP3eVSsK2.wKHaomUAC9t1sfIp6N4CZ1c3xi0aAWW','uzNXfGC0dIc4E0THUOABmEPEmbERvsLGbkmYSpSwSYc0ItadJL4hJXxC9HVm','2016-06-29 01:17:08','2016-07-19 08:27:03',2,'nữ','2016-07-05','Ba Vì - Hà Nội','street workout','ok backed','0909999999','1'),(3,'viewer','admin2@gmail.com','$2y$10$JD3L4l8F9KY4M51D.0wKdux4BIMx6nuDJLKVxYj4oVBolLQ4UjKhi','Tz1aYY5R4KLCDXt9bpC4dZyNSplxjA2jc8XtScyCrw4rWpJOltBf1qMm6NdM','2016-06-29 19:40:44','2016-07-19 07:14:25',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(4,'viewer','admin3@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','4'),(5,'partner','admin4@gmail.com','$2y$10$ooqlBbEBTRBjw1Eu/tdosekyjIGI5TisEGF1bb40NFT6EBuXWcn7a','GMhrYgiY5MWUtNpMhrnNsftpJuV4rc0rH22YsdJ2M3dD0rhjuvcN9vZolu3d','2016-06-29 19:40:44','2016-07-19 08:31:17',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer.','0909999999','1'),(6,'viewer','admin5@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','6'),(7,'partner','admin6@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','7'),(8,'viewer','admin27@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','8'),(9,'viewer','minhthe8@gmail.com','$2y$10$nNFPxLe9C6QBZ.pnfbmtYevfAPUkYuORKZmO3/CpLQGWLBgHFYuwK','ke8EwNKrpSXLESNeasja3Ox5GokBq8V3uoTbZWGcq19qbuSxvWY8Vtl4lbea','2016-06-29 01:17:08','2016-06-29 20:54:45',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','9'),(10,'viewer','admin19@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O','M4VT0RBrlA0TB0jEdesNp3XKL4nZJ966uKm2sGPFtmz0MGg1hUrhGawYoaro','2016-06-29 19:40:44','2016-06-29 20:54:22',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','10'),(11,'partner','admin31@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','11'),(12,'partner','admin41@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','12'),(13,'viewer','admin51@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','13'),(14,'partner','admin64@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','14'),(15,'viewer','admin22@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(16,'partner','minhthe22@gmail.com','$2y$10$nNFPxLe9C6QBZ.pnfbmtYevfAPUkYuORKZmO3/CpLQGWLBgHFYuwK','ke8EwNKrpSXLESNeasja3Ox5GokBq8V3uoTbZWGcq19qbuSxvWY8Vtl4lbea','2016-06-29 01:17:08','2016-06-29 20:54:45',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(17,'viewer','admin21@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O','M4VT0RBrlA0TB0jEdesNp3XKL4nZJ966uKm2sGPFtmz0MGg1hUrhGawYoaro','2016-06-29 19:40:44','2016-06-29 20:54:22',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(18,'viewer','admin23@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(19,'viewer','admin334@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(20,'viewer','admin3335@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(21,'partner','admin556@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(22,'partner','admin227@gmail.com','$2y$10$SpBqIp8gOASRE11UEr/PV.XkVBD3bBzdLrggb5n9mRuw0gJyMnk6O',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(23,'partner','minhthe833@gmail.com','$2y$10$nNFPxLe9C6QBZ.pnfbmtYevfAPUkYuORKZmO3/CpLQGWLBgHFYuwK','ke8EwNKrpSXLESNeasja3Ox5GokBq8V3uoTbZWGcq19qbuSxvWY8Vtl4lbea','2016-06-29 01:17:08','2016-06-29 20:54:45',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(24,'partner','admin139@gmail.com','$2y$10$JD3L4l8F9KY4M51D.0wKdux4BIMx6nuDJLKVxYj4oVBolLQ4UjKhi','M4VT0RBrlA0TB0jEdesNp3XKL4nZJ966uKm2sGPFtmz0MGg1hUrhGawYoaro','2016-06-29 19:40:44','2016-06-29 20:54:22',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(25,'partner','admin313@gmail.com','$2y$10$JD3L4l8F9KY4M51D.0wKdux4BIMx6nuDJLKVxYj4oVBolLQ4UjKhi',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(26,'partner','admin431@gmail.com','$2y$10$JD3L4l8F9KY4M51D.0wKdux4BIMx6nuDJLKVxYj4oVBolLQ4UjKhi',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(27,'new Admin check','admin513@gmail.com','$2y$10$8m.zIYjIRbTiI1ABmxAqGuK5Y3pv96IXP9BxkCFrfZzzd2skRq.vy','33PzhftvunxO5XflsMJRvsR5JJh9Q1r4GiZrsFzbnLenkbYrbAggdPFX0Mju','2016-06-29 19:40:44','2016-07-03 22:21:52',0,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(28,'partner','admin643@gmail.com','$2y$10$JD3L4l8F9KY4M51D.0wKdux4BIMx6nuDJLKVxYj4oVBolLQ4UjKhi',NULL,'2016-06-29 19:40:44','2016-06-29 19:40:44',1,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(29,'Admin new','thekoy.95@gmail.com','$2y$10$JD3L4l8F9KY4M51D.0wKdux4BIMx6nuDJLKVxYj4oVBolLQ4UjKhi','gzzhDhfWFyuPCRBQqj3FiCJfJY0tiGryy2GdkViSoBwEXHO7CBbKOPD2KrIB','2016-06-29 19:40:44','2016-07-01 01:58:21',2,'nam','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','2'),(30,'check','check@gmail.com','$2y$10$JD3L4l8F9KY4M51D.0wKdux4BIMx6nuDJLKVxYj4oVBolLQ4UjKhi','Jswo8VOObHzgYZYMobuDn1C0FVBkTt1ttjOio9ns5TEwN3MHFGQiJnIa4Xxa','2016-07-03 18:42:28','2016-07-03 21:19:18',2,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(31,'check 1','check1@gmail.com','$2y$10$JD3L4l8F9KY4M51D.0wKdux4BIMx6nuDJLKVxYj4oVBolLQ4UjKhi','xNMbxr43CLKpY1Aj3MHwUy3fctzjYkkB9WI7N8lq810AhIg15XC5KvjRDSuI','2016-07-03 18:55:11','2016-07-03 18:59:28',2,'nữ','1995-01-01','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(32,'ok test','admin0@gmail.com','$2y$10$esuIWFXhN3kYYZ5.monUt.cGx/u1XegnvekRhT6HvrV8UAWH5Kte6','P79903nXH2HcCJenKChy9P50kyPMJHDiGv8NUQ1FZEzUUDjsgm8vAluNL22c','2016-07-19 07:27:28','2016-07-19 07:28:17',0,'nữ','2016-07-21','Ba Vì - Hà Nội','street workout','Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium.','0909999999','1'),(33,'1111111111','admin@gmail.com','$2y$10$BDO2O6hzrkXLx9VzuMDX..sHwswb3I98IrGU6p8uS2HRVQF9clB1C','bm8nz4MkHxCwIWfpreSLzBF9EoEaLkBFcUepTYHqFXtiCDmcjMw0MoG8Y5Qn','2016-07-19 08:03:07','2016-07-19 08:04:49',0,'nam','2016-07-20','111111111111111111','1111111111111111111111111','11111111111111111','11111111111','8'),(34,'ok lastest','adminadmin@gmail.com','$2y$10$uNSf6HXyOe2.g7P9KDTVCuv.59vMc.Y4iZaIiCxd/B/Jb0WTGuKLC','rQ8zfPuQtjQMZvrgZkCiTJvZW7CflF7nVKRdtsU71vQMPsPCpKPQj0ZhCfhW','2016-07-19 08:05:42','2016-07-19 08:06:26',0,'nam','2016-07-20','1111111','111111111111111111111111','11111111','11111111111','9');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'onlinenews'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-19 22:41:00
