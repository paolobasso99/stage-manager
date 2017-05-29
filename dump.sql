-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: stage-manager
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `attempts`
--

DROP TABLE IF EXISTS `attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attempts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `load_time` double(8,2) DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attempts`
--

LOCK TABLES `attempts` WRITE;
/*!40000 ALTER TABLE `attempts` DISABLE KEYS */;
INSERT INTO `attempts` VALUES (1,2,NULL,0.01,NULL,NULL,'2017-05-25 08:31:24','2017-05-25 08:31:24'),(2,11,200,0.89,'OK',NULL,'2017-05-25 08:31:24','2017-05-25 08:31:24'),(3,26,301,12.52,'Moved Permanently',NULL,'2017-05-25 08:31:39','2017-05-25 08:31:39'),(4,2,NULL,0.01,NULL,NULL,'2017-05-25 08:33:31','2017-05-25 08:33:31'),(5,11,200,0.37,'OK',NULL,'2017-05-25 08:33:31','2017-05-25 08:33:31'),(6,26,301,1.44,'Moved Permanently',NULL,'2017-05-25 08:33:34','2017-05-25 08:33:34'),(7,2,NULL,0.01,NULL,NULL,'2017-05-25 08:35:28','2017-05-25 08:35:28'),(8,11,200,0.81,'OK',NULL,'2017-05-25 08:35:29','2017-05-25 08:35:29'),(9,26,301,5.69,'Moved Permanently',NULL,'2017-05-25 08:35:40','2017-05-25 08:35:40'),(10,2,NULL,0.18,NULL,NULL,'2017-05-25 08:59:19','2017-05-25 08:59:19'),(11,11,200,1.43,'OK',NULL,'2017-05-25 08:59:20','2017-05-25 08:59:20'),(12,26,301,0.83,'Moved Permanently',NULL,'2017-05-25 08:59:26','2017-05-25 08:59:26'),(13,2,NULL,0.01,NULL,NULL,'2017-05-25 08:59:28','2017-05-25 08:59:28'),(14,11,200,0.67,'OK',NULL,'2017-05-25 08:59:28','2017-05-25 08:59:28'),(15,26,301,0.25,'Moved Permanently',NULL,'2017-05-25 08:59:31','2017-05-25 08:59:31'),(16,2,NULL,0.05,NULL,NULL,'2017-05-26 05:11:29','2017-05-26 05:11:29'),(17,11,200,0.41,'OK',NULL,'2017-05-26 05:11:30','2017-05-26 05:11:30'),(18,26,301,0.02,'Moved Permanently',NULL,'2017-05-26 05:11:32','2017-05-26 05:11:32'),(19,2,NULL,0.01,NULL,NULL,'2017-05-26 05:11:34','2017-05-26 05:11:34'),(20,11,200,0.38,'OK',NULL,'2017-05-26 05:11:35','2017-05-26 05:11:35'),(21,26,301,0.02,'Moved Permanently',NULL,'2017-05-26 05:11:36','2017-05-26 05:11:36'),(22,2,NULL,0.01,NULL,NULL,'2017-05-26 05:11:37','2017-05-26 05:11:37'),(23,11,200,0.31,'OK',NULL,'2017-05-26 05:11:38','2017-05-26 05:11:38'),(24,26,301,0.18,'Moved Permanently',NULL,'2017-05-26 05:11:40','2017-05-26 05:11:40'),(25,2,NULL,0.01,NULL,NULL,'2017-05-26 05:18:24','2017-05-26 05:18:24'),(26,11,200,3.12,'OK',NULL,'2017-05-26 05:18:27','2017-05-26 05:18:27'),(27,26,301,0.12,'Moved Permanently',NULL,'2017-05-26 05:18:30','2017-05-26 05:18:30');
/*!40000 ALTER TABLE `attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (26,3,'id','number','id',1,0,0,0,0,0,'',1),(27,3,'name','text','name',1,1,1,1,1,1,'',1),(28,3,'email','text','email',1,1,1,1,1,1,'',1),(29,3,'password','password','password',1,0,0,1,1,0,'',1),(30,3,'remember_token','text','remember_token',0,0,0,0,0,0,'',1),(31,3,'created_at','timestamp','created_at',0,1,1,0,0,0,'',1),(32,3,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',1),(33,3,'avatar','image','avatar',0,1,1,1,1,1,'',1),(34,5,'id','number','id',1,0,0,0,0,0,'',1),(35,5,'name','text','name',1,1,1,1,1,1,'',1),(36,5,'created_at','timestamp','created_at',0,0,0,0,0,0,'',1),(37,5,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',1),(45,6,'id','number','id',1,0,0,0,0,0,'',1),(46,6,'name','text','Name',1,1,1,1,1,1,'',1),(47,6,'created_at','timestamp','created_at',0,0,0,0,0,0,'',1),(48,6,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',1),(49,6,'display_name','text','Display Name',1,1,1,1,1,1,'',1),(52,3,'role_id','text','role_id',1,1,1,1,1,1,'',1),(70,11,'id','hidden','Id',1,1,1,0,0,1,NULL,1),(71,11,'address','text','Address',1,1,1,1,1,1,'{\"validation\":{\"rule\":\"required|email\"}}',2),(72,11,'deleted_at','timestamp','Deleted At',0,1,1,1,0,1,NULL,3),(73,11,'created_at','timestamp','Created At',0,1,1,1,0,1,NULL,4),(74,11,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,5),(111,16,'id','number','Id',1,1,1,0,0,1,NULL,1),(112,16,'url','text','Url',1,1,1,1,1,1,NULL,2),(113,16,'rate','number','Rate',1,0,1,1,1,1,NULL,3),(114,16,'ssh_username','text','Ssh Username',0,1,1,1,1,1,NULL,4),(115,16,'ssh_password','password','Ssh Password',0,0,0,1,1,0,NULL,5),(116,16,'ssh_root','text','Ssh Root',0,0,1,1,1,1,NULL,6),(117,16,'tried','number','Tried',1,0,1,1,0,1,NULL,7),(118,16,'checked_at','timestamp','Checked At',1,0,1,1,0,1,NULL,8),(119,16,'down_from','timestamp','Down From',0,1,1,1,0,1,NULL,9),(120,16,'deleted_at','timestamp','Deleted At',0,0,1,1,0,1,NULL,10),(121,16,'created_at','timestamp','Created At',0,0,1,1,0,1,NULL,11),(122,16,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,12),(123,17,'id','number','Id',1,1,1,0,0,1,NULL,1),(124,17,'name','text','Name',1,1,1,1,1,1,NULL,2),(125,17,'key','text_area','Key',1,0,0,1,1,1,NULL,3),(126,17,'keyphrase','password','Keyphrase',0,0,0,1,1,1,NULL,4),(127,17,'created_at','timestamp','Created At',0,1,1,1,0,1,NULL,5),(128,17,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,6);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (3,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User',NULL,'',1,0,'2017-05-22 07:41:29','2017-05-22 07:41:29'),(5,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'',1,0,'2017-05-22 07:41:29','2017-05-22 07:41:29'),(6,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'',1,0,'2017-05-22 07:41:29','2017-05-22 07:41:29'),(11,'emails','emails','Email','Emails','voyager-mail','App\\Email','EmailController',NULL,1,0,'2017-05-22 08:49:08','2017-05-26 05:20:01'),(16,'sites','sites','Site','Sites','voyager-browser','App\\Site','SiteController',NULL,1,0,'2017-05-26 11:17:42','2017-05-26 11:17:42'),(17,'keys','keys','Key','Keys',NULL,'App\\Key',NULL,NULL,1,0,'2017-05-29 07:04:02','2017-05-29 07:04:02');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downtimes`
--

DROP TABLE IF EXISTS `downtimes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `downtimes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downtimes`
--

LOCK TABLES `downtimes` WRITE;
/*!40000 ALTER TABLE `downtimes` DISABLE KEYS */;
INSERT INTO `downtimes` VALUES (1,11,'2017-05-24 06:31:00','2017-05-24 06:33:28','2017-05-24 06:33:28','2017-05-24 06:33:28');
/*!40000 ALTER TABLE `downtimes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_site`
--

DROP TABLE IF EXISTS `email_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_site` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_site`
--

LOCK TABLES `email_site` WRITE;
/*!40000 ALTER TABLE `email_site` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emails_address_unique` (`address`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (5,'HealthMailbox3128e67e3eb348f88525540515a841d3@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(6,'HealthMailbox84a02921d3214c179046e7829a36bf49@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(7,'HealthMailboxe35ba78581254147ae989b221b78a603@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(8,'HealthMailboxbab3fbdfc31a4d42ad2756fe924423b5@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(9,'Migration.8f3e7716-2011-43e4-96b1-aba62d229136@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(10,'SystemMailbox{bb558c35-97f1-4cb9-8ff7-d53741dc928c}@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(11,'tisi@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(12,'HealthMailbox539ec4fa1ed045458ae4fca4f7529370@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(13,'bonin@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(14,'roncaglia@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(15,'pietrobon@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(16,'lorenzetto@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(17,'dalessi@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(18,'noreply@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(19,'sponsor@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(20,'newsletter@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(21,'freshnews@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(22,'bounce-nl@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(23,'HealthMailboxcadda44837ce4d26a36d4689bf140e75@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(24,'HealthMailbox026e0d6d9c68481d810c17743aea11cd@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(25,'alarm2@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(26,'vangelista@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(27,'cappello@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(28,'cortese@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(29,'scolaro@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(30,'battaglin@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(31,'project.management@workup.it',NULL,'2017-05-25 12:35:44','2017-05-25 12:35:44'),(32,'gambaretto@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(33,'20years@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(34,'pontarollo@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(35,'mattia.simonato@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(36,'spadaro@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(37,'HealthMailboxc4dab4bf3c4249449ca74aade10db9e3@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(38,'babushka@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(39,'rocchesso@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(40,'Rosati@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(41,'fontana@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(42,'PF-MailboxHierarchy@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(43,'tmpmigr13@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(44,'HealthMailbox0f988c7d866d45809d7e13c2d0c3beb2@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(45,'HealthMailbox4726dd5bd1494350a212f9e701737662@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(46,'HealthMailbox3158f0aa008b42ec875b4ac5bee95db0@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(47,'alarm3@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(48,'alarm@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(49,'Administrator@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(50,'sandrin@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(51,'alessandro.bizzotto@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(52,'faldani@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(53,'bizzotto@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(54,'aggujaro@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(55,'supporto@netica.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(56,'mattevi@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(57,'faxout@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(58,'tmpmigr@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(59,'fatture@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(60,'spano@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(61,'homar@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(62,'bentini@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(63,'simonato@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(64,'campesan@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(65,'guerra@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(66,'genilotti@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(67,'SystemMailbox{e0dc1c29-89c3-4034-b678-e6c29d823ed9}@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(68,'Marianna@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(69,'SystemMailbox{1f05a927-cf6e-4487-8e4a-670da3e426e4}@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(70,'DiscoverySearchMailbox{D919BA05-46A6-415f-80AD-7E09334BB852}@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(71,'FederatedEmail.4c1f4d8b-8179-4148-93bf-00a95fa1e042@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(72,'fietta@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(73,'mocellin@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(74,'fax@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(75,'mistretta@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(76,'prosdocimo@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(77,'compagnin@workup.it',NULL,'2017-05-25 12:35:45','2017-05-25 12:35:45'),(83,'example@example.com',NULL,'2017-05-26 12:49:24','2017-05-26 12:49:24');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keys`
--

DROP TABLE IF EXISTS `keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyphrase` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keys`
--

LOCK TABLES `keys` WRITE;
/*!40000 ALTER TABLE `keys` DISABLE KEYS */;
INSERT INTO `keys` VALUES (1,'workup','-----BEGIN RSA PRIVATE KEY-----\n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\n-----END RSA PRIVATE KEY-----',NULL,'2017-05-29 08:17:38','2017-05-29 08:17:41');
/*!40000 ALTER TABLE `keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','/','_self','voyager-boat','#000000',NULL,1,'2017-05-22 07:41:30','2017-05-23 11:55:46',NULL,''),(7,1,'Roles','roles','_self','voyager-lock','#000000',14,3,'2017-05-22 07:41:30','2017-05-24 05:18:50',NULL,''),(9,1,'Menu Builder','menus','_self','voyager-list','#000000',14,2,'2017-05-22 07:41:30','2017-05-24 05:18:50',NULL,''),(10,1,'Database','database','_self','voyager-data','#000000',NULL,6,'2017-05-22 07:41:30','2017-05-29 07:04:45',NULL,''),(11,1,'Settings','settings','_self','voyager-settings','#000000',14,1,'2017-05-22 07:41:30','2017-05-24 05:18:50',NULL,''),(13,1,'Emails','emails','_self','voyager-mail','#000000',NULL,3,'2017-05-22 08:18:07','2017-05-26 13:23:45',NULL,''),(14,1,'Tools','','_self','voyager-tools','#000000',NULL,7,'2017-05-22 11:18:26','2017-05-29 07:04:45',NULL,''),(15,1,'Sites','sites','_self','voyager-browser','#000000',NULL,2,'2017-05-24 04:58:26','2017-05-26 13:23:45',NULL,''),(16,1,'Users','users','_self','voyager-person','#000000',NULL,4,'2017-05-26 13:19:25','2017-05-26 13:23:59',NULL,''),(17,1,'SSH keys','keys','_self','voyager-key','#000000',NULL,5,'2017-05-29 07:04:41','2017-05-29 07:04:45',NULL,'');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2017-05-22 07:41:30','2017-05-22 07:41:30');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (43,'2014_10_12_000000_create_users_table',1),(44,'2016_01_01_000000_add_voyager_user_fields',1),(45,'2016_01_01_000000_create_data_types_table',1),(46,'2016_01_01_000000_create_pages_table',1),(47,'2016_01_01_000000_create_posts_table',1),(48,'2016_02_15_204651_create_categories_table',1),(49,'2016_05_19_173453_create_menu_table',1),(50,'2016_10_21_190000_create_roles_table',1),(51,'2016_10_21_190000_create_settings_table',1),(52,'2016_11_30_135954_create_permission_table',1),(53,'2016_11_30_141208_create_permission_role_table',1),(54,'2016_12_26_201236_data_types__add__server_side',1),(55,'2017_01_13_000000_add_route_to_menu_items_table',1),(56,'2017_01_14_005015_create_translations_table',1),(57,'2017_01_15_000000_add_permission_group_id_to_permissions_table',1),(58,'2017_01_15_000000_create_permission_groups_table',1),(69,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',2),(70,'2017_03_06_000000_add_controller_to_data_types_table',2),(76,'2017_04_21_000000_add_order_to_data_rows_table',3),(77,'2017_05_22_095144_create_sites_table',3),(78,'2017_05_22_095158_create_emails_table',3),(79,'2017_05_22_095212_create_notifications_table',3),(81,'2017_05_22_095549_create_attempts_table',4),(82,'2017_05_22_134031_create_jobs_table',5),(83,'2017_05_22_134042_create_failed_jobs_table',5),(84,'2017_05_22_143142_add_tried_and_checked_at_columns',6),(85,'2017_05_23_071524_create_notifications_table',7),(86,'2017_05_23_071524_create_notificables_table',8),(92,'2017_05_23_144252_create_downtimes_table',9),(93,'2017_05_25_071218_create_email_site_table',10),(95,'2017_05_25_090027_add_load_time_column_to_attempts_table',11),(96,'2017_05_26_131208_add_ssh_collumns_to_site_table',12),(101,'2017_05_29_070304_cretae_ssh_keys_table',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_groups`
--

DROP TABLE IF EXISTS `permission_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_groups`
--

LOCK TABLES `permission_groups` WRITE;
/*!40000 ALTER TABLE `permission_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(1,2),(1,4),(2,1),(2,4),(3,1),(3,4),(4,1),(4,4),(5,1),(5,2),(5,4),(6,1),(6,2),(6,4),(7,1),(7,4),(8,1),(8,4),(9,1),(9,4),(15,1),(15,2),(15,4),(16,1),(16,2),(16,4),(17,1),(18,1),(19,1),(20,1),(20,2),(20,4),(21,1),(21,2),(21,4),(22,1),(22,4),(23,1),(23,4),(24,1),(24,4),(50,1),(50,2),(50,4),(51,1),(51,2),(51,4),(52,1),(52,4),(53,1),(53,4),(54,1),(54,4),(75,1),(75,2),(75,4),(76,1),(76,2),(76,4),(77,1),(77,4),(78,1),(78,4),(79,1),(79,4),(80,1),(80,4),(81,1),(81,4),(82,1),(82,4),(83,1),(83,4),(84,1),(84,4),(86,1),(86,4),(87,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(2,'browse_database',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(3,'browse_media',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(4,'browse_settings',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(5,'browse_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(6,'read_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(7,'edit_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(8,'add_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(9,'delete_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(15,'browse_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(16,'read_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(17,'edit_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(18,'add_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(19,'delete_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(20,'browse_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(21,'read_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(22,'edit_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(23,'add_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(24,'delete_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(50,'browse_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(51,'read_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(52,'edit_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(53,'add_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(54,'delete_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(75,'browse_sites','sites','2017-05-26 11:17:42','2017-05-26 11:17:42',NULL),(76,'read_sites','sites','2017-05-26 11:17:42','2017-05-26 11:17:42',NULL),(77,'edit_sites','sites','2017-05-26 11:17:42','2017-05-26 11:17:42',NULL),(78,'add_sites','sites','2017-05-26 11:17:42','2017-05-26 11:17:42',NULL),(79,'delete_sites','sites','2017-05-26 11:17:42','2017-05-26 11:17:42',NULL),(80,'browse_keys','keys','2017-05-29 07:04:02','2017-05-29 07:04:02',NULL),(81,'read_keys','keys','2017-05-29 07:04:02','2017-05-29 07:04:02',NULL),(82,'edit_keys','keys','2017-05-29 07:04:02','2017-05-29 07:04:02',NULL),(83,'add_keys','keys','2017-05-29 07:04:02','2017-05-29 07:04:02',NULL),(84,'delete_keys','keys','2017-05-29 07:04:02','2017-05-29 07:04:02',NULL),(86,'ssh_artisan','Commands','2017-05-29 09:33:30','2017-05-29 09:33:35',NULL),(87,'ssh_all','Commands','2017-05-29 09:33:30','2017-05-29 09:33:35',NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','2017-05-22 07:41:30','2017-05-22 07:41:30'),(2,'user','Normal User','2017-05-22 07:41:30','2017-05-22 07:41:30'),(4,'artisan','Artisan','2017-05-26 13:25:10','2017-05-26 13:25:10');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'title','Site Title','Uptime monitor','','text',3),(2,'description','Site Description','Monitor the status of given websites and advise if something is wrong.','','text',4),(3,'logo','Site Logo','','','image',6),(4,'admin_bg_image','Admin Background Image','','','image',11),(5,'admin_title','Admin Title','Uptime monitor','','text',5),(6,'admin_description','Admin Description','Welcome to Uptime monitor.','','text',7),(7,'admin_loader','Admin Loader','','','image',9),(8,'admin_icon_image','Admin Icon Image','','','image',10),(9,'google_analytics_client_id','Google Analytics Client ID','','','text',9);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `ssh_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ssh_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ssh_root` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_id` int(11) DEFAULT NULL,
  `tried` int(11) NOT NULL DEFAULT '0',
  `checked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `down_from` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (2,'https://www.notworkingwebsitefake.com',5,NULL,NULL,NULL,NULL,1,'2017-05-26 05:18:24','2017-05-26 05:18:24',NULL,'2017-05-22 11:02:11','2017-05-26 05:18:24'),(11,'https://www.google.it/',5,NULL,NULL,NULL,NULL,0,'2017-05-26 05:18:24',NULL,NULL,'2017-05-23 13:28:21','2017-05-26 05:18:27'),(26,'http://www.workup.it/ita/404status',5,NULL,NULL,NULL,NULL,1,'2017-05-26 05:18:30','2017-05-26 05:18:30',NULL,'2017-05-25 08:20:54','2017-05-26 05:18:30'),(38,'http://lab3.workup.it',5,'root','%1t4_l4b3',NULL,NULL,0,'2017-05-26 13:30:38',NULL,NULL,'2017-05-26 11:30:38','2017-05-26 11:30:38'),(104,'http://138.68.90.95',5,'workup',NULL,NULL,1,0,'2017-05-29 08:21:56',NULL,NULL,'2017-05-29 08:06:13','2017-05-29 08:06:22');
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'data_types','display_name_singular',1,'pt','Post','2017-05-22 07:41:31','2017-05-22 07:41:31'),(2,'data_types','display_name_singular',2,'pt','Página','2017-05-22 07:41:31','2017-05-22 07:41:31'),(3,'data_types','display_name_singular',3,'pt','Utilizador','2017-05-22 07:41:31','2017-05-22 07:41:31'),(4,'data_types','display_name_singular',4,'pt','Categoria','2017-05-22 07:41:31','2017-05-22 07:41:31'),(5,'data_types','display_name_singular',5,'pt','Menu','2017-05-22 07:41:31','2017-05-22 07:41:31'),(6,'data_types','display_name_singular',6,'pt','Função','2017-05-22 07:41:31','2017-05-22 07:41:31'),(7,'data_types','display_name_plural',1,'pt','Posts','2017-05-22 07:41:31','2017-05-22 07:41:31'),(8,'data_types','display_name_plural',2,'pt','Páginas','2017-05-22 07:41:31','2017-05-22 07:41:31'),(9,'data_types','display_name_plural',3,'pt','Utilizadores','2017-05-22 07:41:31','2017-05-22 07:41:31'),(10,'data_types','display_name_plural',4,'pt','Categorias','2017-05-22 07:41:31','2017-05-22 07:41:31'),(11,'data_types','display_name_plural',5,'pt','Menus','2017-05-22 07:41:31','2017-05-22 07:41:31'),(12,'data_types','display_name_plural',6,'pt','Funções','2017-05-22 07:41:31','2017-05-22 07:41:31'),(13,'pages','title',1,'pt','Olá Mundo','2017-05-22 07:41:31','2017-05-22 07:41:31'),(14,'pages','slug',1,'pt','ola-mundo','2017-05-22 07:41:31','2017-05-22 07:41:31'),(15,'pages','body',1,'pt','<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','2017-05-22 07:41:31','2017-05-22 07:41:31'),(16,'menu_items','title',1,'pt','Painel de Controle','2017-05-22 07:41:31','2017-05-22 07:41:31'),(17,'menu_items','title',2,'pt','Media','2017-05-22 07:41:31','2017-05-22 07:41:31'),(18,'menu_items','title',3,'pt','Publicações','2017-05-22 07:41:31','2017-05-22 07:41:31'),(19,'menu_items','title',4,'pt','Utilizadores','2017-05-22 07:41:31','2017-05-22 07:41:31'),(20,'menu_items','title',5,'pt','Categorias','2017-05-22 07:41:31','2017-05-22 07:41:31'),(21,'menu_items','title',6,'pt','Páginas','2017-05-22 07:41:31','2017-05-22 07:41:31'),(22,'menu_items','title',7,'pt','Funções','2017-05-22 07:41:31','2017-05-22 07:41:31'),(23,'menu_items','title',8,'pt','Ferramentas','2017-05-22 07:41:31','2017-05-22 07:41:31'),(24,'menu_items','title',9,'pt','Menus','2017-05-22 07:41:31','2017-05-22 07:41:31'),(25,'menu_items','title',10,'pt','Base de dados','2017-05-22 07:41:31','2017-05-22 07:41:31'),(26,'menu_items','title',11,'pt','Configurações','2017-05-22 07:41:31','2017-05-22 07:41:31');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Admin','admin@admin.com','users/default.png','$2y$10$pi5vcwQAO9XZLoAqGTZW8u.sOLAmNoA4nnIA38eZHOfQp4pXKWYAu','L0ychiZA6C98dMMCRRAy3FE4DnSnv3npLwpG4wwkgGbN8jyESmy8YkECIW6L','2017-05-22 07:41:31','2017-05-22 07:41:31'),(2,4,'artisan','artisan@artisan.com','users/default.png','$2y$10$zuFDf2zFggpf8CqqbtLqzevtWOMuL/w.zpZ9q/YXfvRpZzMwVCGhC','K2TaKNQzyOTRV5YWLCtUlsCp43kVvTJWvzkTHcjgPgMAnWqmObk3FUzZzoJY','2017-05-29 07:40:33','2017-05-29 07:40:33'),(3,2,'Normal','normal@normal.com','users/default.png','$2y$10$3lgUuTtcDvrbOMkrq/hIzuNxGbYtOXPltVhF3F8Uvf.mKnD1ztQDy',NULL,'2017-05-29 08:12:48','2017-05-29 08:12:48');
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

-- Dump completed on 2017-05-29 12:13:36
