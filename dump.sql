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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attempts`
--

LOCK TABLES `attempts` WRITE;
/*!40000 ALTER TABLE `attempts` DISABLE KEYS */;
INSERT INTO `attempts` VALUES (1,2,NULL,0.01,NULL,NULL,'2017-05-25 08:31:24','2017-05-25 08:31:24'),(2,11,200,0.89,'OK',NULL,'2017-05-25 08:31:24','2017-05-25 08:31:24'),(3,26,301,12.52,'Moved Permanently',NULL,'2017-05-25 08:31:39','2017-05-25 08:31:39'),(4,2,NULL,0.01,NULL,NULL,'2017-05-25 08:33:31','2017-05-25 08:33:31'),(5,11,200,0.37,'OK',NULL,'2017-05-25 08:33:31','2017-05-25 08:33:31'),(6,26,301,1.44,'Moved Permanently',NULL,'2017-05-25 08:33:34','2017-05-25 08:33:34'),(7,2,NULL,0.01,NULL,NULL,'2017-05-25 08:35:28','2017-05-25 08:35:28'),(8,11,200,0.81,'OK',NULL,'2017-05-25 08:35:29','2017-05-25 08:35:29'),(9,26,301,5.69,'Moved Permanently',NULL,'2017-05-25 08:35:40','2017-05-25 08:35:40'),(10,2,NULL,0.18,NULL,NULL,'2017-05-25 08:59:19','2017-05-25 08:59:19'),(11,11,200,1.43,'OK',NULL,'2017-05-25 08:59:20','2017-05-25 08:59:20'),(12,26,301,0.83,'Moved Permanently',NULL,'2017-05-25 08:59:26','2017-05-25 08:59:26'),(13,2,NULL,0.01,NULL,NULL,'2017-05-25 08:59:28','2017-05-25 08:59:28'),(14,11,200,0.67,'OK',NULL,'2017-05-25 08:59:28','2017-05-25 08:59:28'),(15,26,301,0.25,'Moved Permanently',NULL,'2017-05-25 08:59:31','2017-05-25 08:59:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (26,3,'id','number','id',1,0,0,0,0,0,'',1),(27,3,'name','text','name',1,1,1,1,1,1,'',1),(28,3,'email','text','email',1,1,1,1,1,1,'',1),(29,3,'password','password','password',1,0,0,1,1,0,'',1),(30,3,'remember_token','text','remember_token',0,0,0,0,0,0,'',1),(31,3,'created_at','timestamp','created_at',0,1,1,0,0,0,'',1),(32,3,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',1),(33,3,'avatar','image','avatar',0,1,1,1,1,1,'',1),(34,5,'id','number','id',1,0,0,0,0,0,'',1),(35,5,'name','text','name',1,1,1,1,1,1,'',1),(36,5,'created_at','timestamp','created_at',0,0,0,0,0,0,'',1),(37,5,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',1),(45,6,'id','number','id',1,0,0,0,0,0,'',1),(46,6,'name','text','Name',1,1,1,1,1,1,'',1),(47,6,'created_at','timestamp','created_at',0,0,0,0,0,0,'',1),(48,6,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',1),(49,6,'display_name','text','Display Name',1,1,1,1,1,1,'',1),(52,3,'role_id','text','role_id',1,1,1,1,1,1,'',1),(70,11,'id','hidden','Id',1,0,0,0,0,0,NULL,1),(71,11,'address','text','Address',1,1,1,1,1,1,'{\"validation\":{\"rule\":\"required|email\"}}',2),(72,11,'deleted_at','timestamp','Deleted At',0,0,0,0,0,0,NULL,3),(73,11,'created_at','timestamp','Created At',0,1,1,1,0,1,NULL,4),(74,11,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,5),(102,15,'id','number','Id',1,1,1,0,0,0,NULL,1),(103,15,'url','text','Url',1,1,1,1,1,1,NULL,2),(104,15,'rate','number','Rate',1,1,1,1,1,1,NULL,3),(105,15,'tried','number','Tried',1,1,1,1,0,1,NULL,4),(106,15,'checked_at','timestamp','Checked At',1,1,1,1,0,1,NULL,5),(107,15,'down_from','timestamp','Down From',0,1,1,1,0,1,NULL,6),(108,15,'deleted_at','timestamp','Deleted At',0,0,1,1,0,1,NULL,7),(109,15,'created_at','timestamp','Created At',0,1,1,1,0,1,NULL,8),(110,15,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,9);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (3,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User',NULL,'',1,0,'2017-05-22 07:41:29','2017-05-22 07:41:29'),(5,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'',1,0,'2017-05-22 07:41:29','2017-05-22 07:41:29'),(6,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'',1,0,'2017-05-22 07:41:29','2017-05-22 07:41:29'),(11,'emails','emails','Email','Emails','voyager-mail','App\\Email',NULL,NULL,1,0,'2017-05-22 08:49:08','2017-05-23 11:02:57'),(15,'sites','sites','Site','Sites','voyager-browser','App\\Site','SiteController',NULL,1,0,'2017-05-24 11:08:47','2017-05-24 11:10:33');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_site`
--

LOCK TABLES `email_site` WRITE;
/*!40000 ALTER TABLE `email_site` DISABLE KEYS */;
INSERT INTO `email_site` VALUES (1,3,2,NULL,NULL),(2,4,2,NULL,NULL),(3,3,24,NULL,NULL),(4,4,24,NULL,NULL),(5,3,11,NULL,NULL),(6,4,11,NULL,NULL),(7,3,9,NULL,NULL),(8,4,9,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (3,'example1@example.com',NULL,'2017-05-24 10:49:03','2017-05-24 10:49:03'),(4,'example2@example.com',NULL,'2017-05-24 12:55:32','2017-05-24 12:55:32');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','/','_self','voyager-boat','#000000',NULL,1,'2017-05-22 07:41:30','2017-05-23 11:55:46',NULL,''),(4,1,'Users','users','_self','voyager-person','#000000',NULL,2,'2017-05-22 07:41:30','2017-05-23 11:55:53',NULL,''),(7,1,'Roles','roles','_self','voyager-lock','#000000',14,3,'2017-05-22 07:41:30','2017-05-24 05:18:50',NULL,''),(9,1,'Menu Builder','menus','_self','voyager-list','#000000',14,2,'2017-05-22 07:41:30','2017-05-24 05:18:50',NULL,''),(10,1,'Database','database','_self','voyager-data','#000000',NULL,5,'2017-05-22 07:41:30','2017-05-24 05:18:48',NULL,''),(11,1,'Settings','settings','_self','voyager-settings','#000000',14,1,'2017-05-22 07:41:30','2017-05-24 05:18:50',NULL,''),(13,1,'Emails','emails','_self','voyager-mail','#000000',NULL,4,'2017-05-22 08:18:07','2017-05-23 11:56:06',NULL,''),(14,1,'Tools','','_self','voyager-tools','#000000',NULL,6,'2017-05-22 11:18:26','2017-05-24 05:18:50',NULL,''),(15,1,'Sites','sites','_self','voyager-browser','#000000',NULL,3,'2017-05-24 04:58:26','2017-05-24 05:06:07',NULL,'');
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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (43,'2014_10_12_000000_create_users_table',1),(44,'2016_01_01_000000_add_voyager_user_fields',1),(45,'2016_01_01_000000_create_data_types_table',1),(46,'2016_01_01_000000_create_pages_table',1),(47,'2016_01_01_000000_create_posts_table',1),(48,'2016_02_15_204651_create_categories_table',1),(49,'2016_05_19_173453_create_menu_table',1),(50,'2016_10_21_190000_create_roles_table',1),(51,'2016_10_21_190000_create_settings_table',1),(52,'2016_11_30_135954_create_permission_table',1),(53,'2016_11_30_141208_create_permission_role_table',1),(54,'2016_12_26_201236_data_types__add__server_side',1),(55,'2017_01_13_000000_add_route_to_menu_items_table',1),(56,'2017_01_14_005015_create_translations_table',1),(57,'2017_01_15_000000_add_permission_group_id_to_permissions_table',1),(58,'2017_01_15_000000_create_permission_groups_table',1),(69,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',2),(70,'2017_03_06_000000_add_controller_to_data_types_table',2),(76,'2017_04_21_000000_add_order_to_data_rows_table',3),(77,'2017_05_22_095144_create_sites_table',3),(78,'2017_05_22_095158_create_emails_table',3),(79,'2017_05_22_095212_create_notifications_table',3),(81,'2017_05_22_095549_create_attempts_table',4),(82,'2017_05_22_134031_create_jobs_table',5),(83,'2017_05_22_134042_create_failed_jobs_table',5),(84,'2017_05_22_143142_add_tried_and_checked_at_columns',6),(85,'2017_05_23_071524_create_notifications_table',7),(86,'2017_05_23_071524_create_notificables_table',8),(92,'2017_05_23_144252_create_downtimes_table',9),(93,'2017_05_25_071218_create_email_site_table',10),(95,'2017_05_25_090027_add_load_time_column_to_attempts_table',11);
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
INSERT INTO `permission_role` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,1),(5,1),(5,2),(6,1),(6,2),(7,1),(8,1),(9,1),(15,1),(15,2),(16,1),(16,2),(17,1),(18,1),(19,1),(20,1),(20,2),(21,1),(21,2),(22,1),(23,1),(24,1),(50,1),(50,2),(51,1),(51,2),(52,1),(52,2),(53,1),(53,2),(54,1),(54,2),(70,1),(70,2),(71,1),(71,2),(72,1),(72,2),(73,1),(73,2),(74,1),(74,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(2,'browse_database',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(3,'browse_media',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(4,'browse_settings',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(5,'browse_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(6,'read_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(7,'edit_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(8,'add_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(9,'delete_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(15,'browse_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(16,'read_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(17,'edit_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(18,'add_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(19,'delete_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(20,'browse_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(21,'read_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(22,'edit_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(23,'add_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(24,'delete_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(50,'browse_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(51,'read_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(52,'edit_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(53,'add_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(54,'delete_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(70,'browse_sites','sites','2017-05-24 11:08:47','2017-05-24 11:08:47',NULL),(71,'read_sites','sites','2017-05-24 11:08:47','2017-05-24 11:08:47',NULL),(72,'edit_sites','sites','2017-05-24 11:08:47','2017-05-24 11:08:47',NULL),(73,'add_sites','sites','2017-05-24 11:08:47','2017-05-24 11:08:47',NULL),(74,'delete_sites','sites','2017-05-24 11:08:47','2017-05-24 11:08:47',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','2017-05-22 07:41:30','2017-05-22 07:41:30'),(2,'user','Normal User','2017-05-22 07:41:30','2017-05-22 07:41:30');
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
  `tried` int(11) NOT NULL DEFAULT '0',
  `checked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `down_from` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (2,'https://www.notworkingwebsitefake.com',5,26,'2017-05-25 08:59:28','2017-05-25 07:08:23',NULL,'2017-05-22 11:02:11','2017-05-25 08:59:28'),(11,'https://www.google.it/',5,0,'2017-05-25 08:59:28',NULL,NULL,'2017-05-23 13:28:21','2017-05-25 08:59:28'),(26,'http://www.workup.it/ita/404status',5,19,'2017-05-25 08:59:31','2017-05-25 08:26:19',NULL,'2017-05-25 08:20:54','2017-05-25 08:59:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Admin','admin@admin.com','users/default.png','$2y$10$pi5vcwQAO9XZLoAqGTZW8u.sOLAmNoA4nnIA38eZHOfQp4pXKWYAu','MJBAnNXxjLaJ9acu6zB7Fcu2luLb56D7w2zw3WU3O0pMdheZ00sHnFRM5MPK','2017-05-22 07:41:31','2017-05-22 07:41:31');
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

-- Dump completed on 2017-05-25 16:30:34
