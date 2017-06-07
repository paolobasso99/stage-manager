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
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `load_time` double(8,2) DEFAULT NULL,
  `certificate_validity` tinyint(1) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attempts`
--

LOCK TABLES `attempts` WRITE;
/*!40000 ALTER TABLE `attempts` DISABLE KEYS */;
INSERT INTO `attempts` VALUES (26,1,403,'Forbidden',0.02,NULL,NULL,'2017-06-06 11:01:39','2017-06-06 11:01:39'),(27,5,200,'OK',0.37,1,NULL,'2017-06-06 11:01:40','2017-06-06 11:01:40'),(28,4,200,'OK',0.72,NULL,NULL,'2017-06-06 11:01:41','2017-06-06 11:01:41'),(29,1,403,'Forbidden',0.02,NULL,NULL,'2017-06-06 11:01:51','2017-06-06 11:01:51'),(30,5,200,'OK',0.36,1,NULL,'2017-06-06 11:28:33','2017-06-06 11:28:33');
/*!40000 ALTER TABLE `attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_site`
--

DROP TABLE IF EXISTS `contact_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_site` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_site`
--

LOCK TABLES `contact_site` WRITE;
/*!40000 ALTER TABLE `contact_site` DISABLE KEYS */;
INSERT INTO `contact_site` VALUES (3,85,11,NULL,NULL,NULL),(4,87,11,NULL,NULL,NULL);
/*!40000 ALTER TABLE `contact_site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emails_address_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (84,'HealthMailbox37eaa1154f514d2880c61e2c7bdaca2d','HealthMailbox3128e67e3eb348f88525540515a841d3@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(85,'HealthMailboxc89a9d0c31714116ac3ab4a8590312b8','HealthMailbox84a02921d3214c179046e7829a36bf49@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(86,'HealthMailbox5cddc71fa46e4ee19d99ac8a7dfe0c55','HealthMailboxe35ba78581254147ae989b221b78a603@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(87,'HealthMailboxcc57244d6cdf4c329d1bc499c8e6d7f0','HealthMailboxbab3fbdfc31a4d42ad2756fe924423b5@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(88,'Microsoft Exchange Migration','Migration.8f3e7716-2011-43e4-96b1-aba62d229136@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(89,'Microsoft Exchange','SystemMailbox{bb558c35-97f1-4cb9-8ff7-d53741dc928c}@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(90,'Marco Tisi','tisi@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(91,'HealthMailboxeb42dbafad214075a304eadcf50e81b1','HealthMailbox539ec4fa1ed045458ae4fca4f7529370@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(92,'Nicola Bonin','bonin@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(93,'Luca Roncaglia','roncaglia@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(94,'Filippo Pietrobon','pietrobon@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(95,'Anna Lorenzetto','lorenzetto@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(96,'Stefano DAlessi','dalessi@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(97,'Newsletter noreply','noreply@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(98,'Newsletter sponsor','sponsor@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(99,'Newsletter','newsletter@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(100,'Newsletter freshnews','freshnews@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(101,'Newsletter bounce','bounce-nl@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(102,'HealthMailbox8543807762f24d9787a3ad4f52cc03da','HealthMailboxcadda44837ce4d26a36d4689bf140e75@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(103,'HealthMailboxe8ff406a1dc44a78a3bb334688fefc92','HealthMailbox026e0d6d9c68481d810c17743aea11cd@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(104,'Alarm 02','alarm2@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(105,'Michele Vangelista','vangelista@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(106,'Alberto Cappello','cappello@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(107,'Luca Cortese','cortese@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(108,'Lara Scolaro','scolaro@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(109,'Maikol Battaglin','battaglin@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(110,'project.management','project.management@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(111,'Andrea Gambaretto','gambaretto@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(112,'20 years Workup','20years@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(113,'Paolo Pontarollo','pontarollo@workup.it',NULL,'2017-06-06 08:29:34','2017-06-06 08:29:34'),(114,'Mattia Simonato','mattia.simonato@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(115,'Agata Spadaro','spadaro@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(116,'HealthMailbox4e7f566c109f458d85282ab0dc68ccd6','HealthMailboxc4dab4bf3c4249449ca74aade10db9e3@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(117,'Anatoliy Babushka','babushka@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(118,'Riccardo Rocchesso','rocchesso@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(119,'Paolo Rosati','Rosati@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(120,'Matteo Fontana','fontana@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(121,'PF-MailboxHierarchy','PF-MailboxHierarchy@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(122,'tmpmigr13','tmpmigr13@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(123,'HealthMailboxb5d50f028e1d4047b17d3b5ca38b337e','HealthMailbox0f988c7d866d45809d7e13c2d0c3beb2@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(124,'HealthMailbox6650cdeb38044dc0b800ab6fdaa0eb2d','HealthMailbox4726dd5bd1494350a212f9e701737662@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(125,'HealthMailbox45432fb2a5284ff8bf540bc8b2e3dfe8','HealthMailbox3158f0aa008b42ec875b4ac5bee95db0@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(126,'Alarm 03','alarm3@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(127,'Alarm 01','alarm@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(128,'Administrator','Administrator@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(129,'Francesco Sandrin','sandrin@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(130,'Alessandro Bizzotto','alessandro.bizzotto@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(131,'Matteo Faldani','faldani@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(132,'Patrizia Bizzotto','bizzotto@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(133,'Gianluca Aggujaro','aggujaro@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(134,'netica','supporto@netica.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(135,'Alessandro Mattevi','mattevi@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(136,'faxout','faxout@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(137,'tmpmigr','tmpmigr@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(138,'fatture','fatture@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(139,'Luca Spano','spano@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(140,'Dorotea Homar','homar@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(141,'Ennio Bentini','bentini@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(142,'Andrea Simonato','simonato@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(143,'Emy Campesan','campesan@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(144,'Pierpaolo Guerra','guerra@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(145,'Mauro Genilotti','genilotti@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(146,'Microsoft Exchange','SystemMailbox{e0dc1c29-89c3-4034-b678-e6c29d823ed9}@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(147,'Marianna Battaglia','Marianna@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(148,'Approvazione guidata di Microsoft Exchange','SystemMailbox{1f05a927-cf6e-4487-8e4a-670da3e426e4}@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(149,'Cassetta postale di individuazione','DiscoverySearchMailbox{D919BA05-46A6-415f-80AD-7E09334BB852}@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(150,'Microsoft Exchange Federation Mailbox','FederatedEmail.4c1f4d8b-8179-4148-93bf-00a95fa1e042@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(151,'Matteo Fietta','fietta@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(152,'Solidea Mocellin','mocellin@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(153,'fax','fax@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(154,'Giuliana Mistretta','mistretta@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(155,'Maurizio Prosdocimo','prosdocimo@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(156,'Davide Compagnin','compagnin@workup.it',NULL,'2017-06-06 08:29:35','2017-06-06 08:29:35'),(157,'example1','example@example.com','2017-06-06 11:53:18','2017-06-06 11:52:00','2017-06-06 11:53:18');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (26,3,'id','number','id',1,0,0,0,0,0,'',1),(27,3,'name','text','name',1,1,1,1,1,1,'',1),(28,3,'email','text','email',1,1,1,1,1,1,'',1),(29,3,'password','password','password',1,0,0,1,1,0,'',1),(30,3,'remember_token','text','remember_token',0,0,0,0,0,0,'',1),(31,3,'created_at','timestamp','created_at',0,1,1,0,0,0,'',1),(32,3,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',1),(33,3,'avatar','image','avatar',0,1,1,1,1,1,'',1),(34,5,'id','number','id',1,0,0,0,0,0,'',1),(35,5,'name','text','name',1,1,1,1,1,1,'',1),(36,5,'created_at','timestamp','created_at',0,0,0,0,0,0,'',1),(37,5,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',1),(45,6,'id','number','id',1,0,0,0,0,0,'',1),(46,6,'name','text','Name',1,1,1,1,1,1,'',1),(47,6,'created_at','timestamp','created_at',0,0,0,0,0,0,'',1),(48,6,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',1),(49,6,'display_name','text','Display Name',1,1,1,1,1,1,'',1),(52,3,'role_id','text','role_id',1,1,1,1,1,1,'',1),(70,11,'id','hidden','Id',1,1,1,0,0,1,NULL,1),(71,11,'address','text','Address',1,1,1,1,1,1,'{\"validation\":{\"rule\":\"required|email\"}}',2),(72,11,'deleted_at','timestamp','Deleted At',0,1,1,1,0,1,NULL,3),(73,11,'created_at','timestamp','Created At',0,1,1,1,0,1,NULL,4),(74,11,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,5),(173,20,'id','number','Id',1,1,1,1,1,1,NULL,1),(174,20,'url','text','Url',1,1,1,1,1,1,NULL,2),(175,20,'server_id','number','Server',0,0,0,1,1,0,'\"\"',3),(176,20,'check_rate','number','Check Rate',1,0,1,1,1,0,NULL,4),(177,20,'check_response','checkbox','Check Response',1,1,1,1,1,1,NULL,5),(178,20,'response_attempts','number','Response Attempts',1,0,1,1,1,0,NULL,6),(179,20,'check_certificate','checkbox','Check Certificate',1,1,1,1,1,1,NULL,7),(180,20,'certificate_attempts','number','Certificate Attempts',1,0,1,1,1,0,NULL,8),(181,20,'enable_nginx_configuration','checkbox','Enable Nginx Configuration',1,1,1,1,1,1,NULL,9),(182,20,'ssh_root','text','Ssh Root',0,0,1,1,1,1,NULL,10),(183,20,'enable_db','checkbox','Enable Db',1,1,1,1,1,1,NULL,11),(184,20,'db_host','text','Db Host',0,0,1,1,1,1,NULL,12),(185,20,'db_database','text','Db Database',0,0,1,1,1,1,NULL,13),(186,20,'db_username','text','Db Username',0,0,1,1,1,1,NULL,14),(187,20,'db_password','text','Db Password',0,0,1,1,1,1,NULL,15),(188,20,'checked_at','timestamp','Checked At',1,0,0,0,0,0,NULL,16),(189,20,'response_down_from','timestamp','Response Down From',0,1,1,0,0,1,NULL,17),(190,20,'certificate_down_from','timestamp','Certificate Down From',0,1,1,0,0,1,NULL,18),(191,20,'deleted_at','timestamp','Deleted At',0,0,0,0,0,0,NULL,19),(192,20,'created_at','timestamp','Created At',0,1,0,0,0,0,NULL,20),(193,20,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,21),(194,21,'id','number','Id',1,1,1,0,0,1,NULL,1),(195,21,'name','text','Name',1,1,1,1,1,1,NULL,2),(196,21,'email','text','Email',1,1,1,1,1,1,NULL,3),(197,21,'deleted_at','timestamp','Deleted At',0,0,1,1,0,1,NULL,4),(198,21,'created_at','timestamp','Created At',0,1,1,1,0,1,NULL,5),(199,21,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,6),(224,24,'id','number','Id',1,1,1,1,1,1,NULL,1),(225,24,'name','text','Name',1,1,1,1,1,1,NULL,2),(226,24,'ip','text','Ip',1,1,1,1,1,1,NULL,3),(227,24,'enable_console','checkbox','Enable Console',1,1,1,1,1,1,NULL,4),(228,24,'enable_crontab','checkbox','Enable Crontab',1,1,1,1,1,1,NULL,5),(229,24,'ssh_username','text','Ssh Username',0,0,1,1,1,1,NULL,6),(230,24,'ssh_password','text','Ssh Password',0,0,0,1,1,1,NULL,7),(231,24,'key_id','number','Key Id',0,1,1,1,1,1,NULL,8),(232,24,'deleted_at','timestamp','Deleted At',0,0,0,0,0,1,NULL,9),(233,24,'created_at','timestamp','Created At',0,1,1,0,0,1,NULL,10),(234,24,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,11),(235,25,'id','number','Id',1,1,1,1,1,1,NULL,1),(236,25,'name','text','Name',1,1,1,1,1,1,NULL,2),(237,25,'key','text_area','Key',1,0,0,1,1,1,NULL,3),(238,25,'keyphrase','text','Keyphrase',0,0,0,1,1,1,NULL,4),(239,25,'deleted_at','timestamp','Deleted At',0,0,1,1,0,1,NULL,5),(240,25,'created_at','timestamp','Created At',0,1,1,0,0,1,NULL,6),(241,25,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,7);
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (3,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User',NULL,'',1,0,'2017-05-22 07:41:29','2017-05-22 07:41:29'),(5,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'',1,0,'2017-05-22 07:41:29','2017-05-22 07:41:29'),(6,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'',1,0,'2017-05-22 07:41:29','2017-05-22 07:41:29'),(11,'emails','emails','Email','Emails','voyager-mail','App\\Email','EmailController',NULL,1,0,'2017-05-22 08:49:08','2017-05-26 05:20:01'),(20,'sites','sites','Site','Sites','voyager-browser','App\\Site','SiteController',NULL,1,0,'2017-06-06 08:24:43','2017-06-06 10:31:37'),(21,'contacts','contacts','Contact','Contacts',NULL,'App\\Contact',NULL,NULL,1,0,'2017-06-06 08:26:10','2017-06-06 08:26:10'),(24,'servers','servers','Server','Servers','voyager-bag','App\\Server','ServerController',NULL,1,0,'2017-06-07 05:16:22','2017-06-07 05:16:22'),(25,'keys','keys','Key','Keys','voyager-key','App\\Key','KeyController',NULL,1,0,'2017-06-07 07:35:10','2017-06-07 07:35:10');
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downtimes`
--

LOCK TABLES `downtimes` WRITE;
/*!40000 ALTER TABLE `downtimes` DISABLE KEYS */;
/*!40000 ALTER TABLE `downtimes` ENABLE KEYS */;
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
  `key` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyphrase` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keys`
--

LOCK TABLES `keys` WRITE;
/*!40000 ALTER TABLE `keys` DISABLE KEYS */;
INSERT INTO `keys` VALUES (1,'workup','-----BEGIN RSA PRIVATE KEY-----\r\n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\r\n-----END RSA PRIVATE KEY-----',NULL,NULL,'2017-06-06 08:33:14','2017-06-06 08:33:14');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','/','_self','voyager-boat','#000000',NULL,1,'2017-05-22 07:41:30','2017-05-23 11:55:46',NULL,''),(7,1,'Roles','roles','_self','voyager-lock','#000000',14,4,'2017-05-22 07:41:30','2017-06-07 07:33:24',NULL,''),(9,1,'Menu Builder','menus','_self','voyager-list','#000000',14,3,'2017-05-22 07:41:30','2017-06-07 07:33:24',NULL,''),(10,1,'Database','database','_self','voyager-data','#000000',14,1,'2017-05-22 07:41:30','2017-06-07 07:33:24',NULL,''),(11,1,'Settings','settings','_self','voyager-settings','#000000',14,2,'2017-05-22 07:41:30','2017-06-07 07:33:24',NULL,''),(13,1,'Contacts','contacts','_self','voyager-mail','#000000',NULL,4,'2017-05-22 08:18:07','2017-06-06 08:39:57',NULL,''),(14,1,'Tools','','_self','voyager-tools','#000000',NULL,7,'2017-05-22 11:18:26','2017-06-07 07:33:24',NULL,''),(15,1,'Sites','sites','_self','voyager-browser','#000000',NULL,3,'2017-05-24 04:58:26','2017-06-06 08:39:57',NULL,''),(16,1,'Users','users','_self','voyager-person','#000000',NULL,5,'2017-05-26 13:19:25','2017-06-06 08:39:57',NULL,''),(17,1,'SSH keys','keys','_self','voyager-key','#000000',NULL,6,'2017-05-29 07:04:41','2017-06-06 08:39:57',NULL,''),(18,1,'Servers','servers','_self','voyager-bag','#000000',NULL,2,'2017-06-06 08:39:53','2017-06-06 08:39:57',NULL,'');
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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (43,'2014_10_12_000000_create_users_table',1),(44,'2016_01_01_000000_add_voyager_user_fields',1),(45,'2016_01_01_000000_create_data_types_table',1),(46,'2016_01_01_000000_create_pages_table',1),(47,'2016_01_01_000000_create_posts_table',1),(48,'2016_02_15_204651_create_categories_table',1),(49,'2016_05_19_173453_create_menu_table',1),(50,'2016_10_21_190000_create_roles_table',1),(51,'2016_10_21_190000_create_settings_table',1),(52,'2016_11_30_135954_create_permission_table',1),(53,'2016_11_30_141208_create_permission_role_table',1),(54,'2016_12_26_201236_data_types__add__server_side',1),(55,'2017_01_13_000000_add_route_to_menu_items_table',1),(56,'2017_01_14_005015_create_translations_table',1),(57,'2017_01_15_000000_add_permission_group_id_to_permissions_table',1),(58,'2017_01_15_000000_create_permission_groups_table',1),(69,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',2),(70,'2017_03_06_000000_add_controller_to_data_types_table',2),(76,'2017_04_21_000000_add_order_to_data_rows_table',3),(77,'2017_05_22_095144_create_sites_table',3),(78,'2017_05_22_095158_create_emails_table',3),(79,'2017_05_22_095212_create_notifications_table',3),(81,'2017_05_22_095549_create_attempts_table',4),(82,'2017_05_22_134031_create_jobs_table',5),(83,'2017_05_22_134042_create_failed_jobs_table',5),(84,'2017_05_22_143142_add_tried_and_checked_at_columns',6),(85,'2017_05_23_071524_create_notifications_table',7),(86,'2017_05_23_071524_create_notificables_table',8),(92,'2017_05_23_144252_create_downtimes_table',9),(93,'2017_05_25_071218_create_email_site_table',10),(95,'2017_05_25_090027_add_load_time_column_to_attempts_table',11),(96,'2017_05_26_131208_add_ssh_collumns_to_site_table',12),(101,'2017_05_29_070304_cretae_ssh_keys_table',13),(103,'2017_05_29_133509_add_database_columns_to_sites_table',14),(108,'2017_05_30_131909_add_certificate_columns_to_sites_table',15),(109,'2017_05_30_132530_add_certificate_columns_to_attempts_table',15),(110,'2017_05_31_141321_add_domain_colum_to_sites_table',16),(112,'2017_06_01_102814_add_features_booleans_to_sites_table',17),(113,'2017_06_01_144629_all_soft_delete_to_all_cruds',18),(114,'2017_06_05_093251_change_site_password_to_text',19),(115,'2017_06_06_070828_add_certificate_down_from_to_sites_table',20),(116,'2017_06_06_090602_create_servers_table',21),(118,'2017_06_06_091753_reorder_database',22),(119,'2017_06_06_100750_rebuild_emails_table',22),(120,'2017_06_06_103158_make_keyphrase_nullable',23),(121,'2017_06_06_105328_rename_server_id_column_in_attempts_table',24),(122,'2017_06_06_120408_add_name_column_to_servers_table',25),(123,'2017_06_06_130556_rename_enable_ssh',26),(125,'2017_06_07_071032_remove_ssh_root_from_servers_table',27);
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
INSERT INTO `permission_role` VALUES (1,1),(1,2),(1,4),(2,1),(2,4),(3,1),(3,4),(4,1),(4,4),(5,1),(5,2),(5,4),(6,1),(6,2),(6,4),(7,1),(7,4),(8,1),(8,4),(9,1),(9,4),(15,1),(15,2),(15,4),(16,1),(16,2),(16,4),(17,1),(18,1),(19,1),(20,1),(20,2),(20,4),(21,1),(21,2),(21,4),(22,1),(22,4),(23,1),(23,4),(24,1),(24,4),(50,1),(50,2),(50,4),(51,1),(51,2),(51,4),(52,1),(52,4),(53,1),(53,4),(54,1),(54,4),(86,1),(86,4),(87,1),(98,1),(99,1),(100,1),(101,1),(102,1),(103,1),(104,1),(105,1),(106,1),(107,1),(118,1),(119,1),(120,1),(121,1),(122,1),(123,1),(124,1),(125,1),(126,1),(127,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(2,'browse_database',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(3,'browse_media',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(4,'browse_settings',NULL,'2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(5,'browse_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(6,'read_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(7,'edit_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(8,'add_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(9,'delete_menus','menus','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(15,'browse_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(16,'read_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(17,'edit_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(18,'add_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(19,'delete_roles','roles','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(20,'browse_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(21,'read_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(22,'edit_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(23,'add_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(24,'delete_users','users','2017-05-22 07:41:30','2017-05-22 07:41:30',NULL),(50,'browse_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(51,'read_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(52,'edit_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(53,'add_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(54,'delete_emails','emails','2017-05-22 08:49:08','2017-05-22 08:49:08',NULL),(86,'ssh_artisan','Commands','2017-05-29 09:33:30','2017-05-29 09:33:35',NULL),(87,'ssh_all','Commands','2017-05-29 09:33:30','2017-05-29 09:33:35',NULL),(98,'browse_sites','sites','2017-06-06 08:24:43','2017-06-06 08:24:43',NULL),(99,'read_sites','sites','2017-06-06 08:24:43','2017-06-06 08:24:43',NULL),(100,'edit_sites','sites','2017-06-06 08:24:43','2017-06-06 08:24:43',NULL),(101,'add_sites','sites','2017-06-06 08:24:43','2017-06-06 08:24:43',NULL),(102,'delete_sites','sites','2017-06-06 08:24:43','2017-06-06 08:24:43',NULL),(103,'browse_contacts','contacts','2017-06-06 08:26:10','2017-06-06 08:26:10',NULL),(104,'read_contacts','contacts','2017-06-06 08:26:10','2017-06-06 08:26:10',NULL),(105,'edit_contacts','contacts','2017-06-06 08:26:10','2017-06-06 08:26:10',NULL),(106,'add_contacts','contacts','2017-06-06 08:26:10','2017-06-06 08:26:10',NULL),(107,'delete_contacts','contacts','2017-06-06 08:26:10','2017-06-06 08:26:10',NULL),(118,'browse_servers','servers','2017-06-07 05:16:22','2017-06-07 05:16:22',NULL),(119,'read_servers','servers','2017-06-07 05:16:22','2017-06-07 05:16:22',NULL),(120,'edit_servers','servers','2017-06-07 05:16:22','2017-06-07 05:16:22',NULL),(121,'add_servers','servers','2017-06-07 05:16:22','2017-06-07 05:16:22',NULL),(122,'delete_servers','servers','2017-06-07 05:16:22','2017-06-07 05:16:22',NULL),(123,'browse_keys','keys','2017-06-07 07:35:10','2017-06-07 07:35:10',NULL),(124,'read_keys','keys','2017-06-07 07:35:10','2017-06-07 07:35:10',NULL),(125,'edit_keys','keys','2017-06-07 07:35:10','2017-06-07 07:35:10',NULL),(126,'add_keys','keys','2017-06-07 07:35:10','2017-06-07 07:35:10',NULL),(127,'delete_keys','keys','2017-06-07 07:35:10','2017-06-07 07:35:10',NULL);
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
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable_console` tinyint(1) NOT NULL DEFAULT '0',
  `enable_crontab` tinyint(1) NOT NULL DEFAULT '0',
  `ssh_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ssh_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` VALUES (1,'Rubinred','138.68.90.95',1,1,'workup',NULL,1,NULL,'2017-06-06 08:41:00','2017-06-06 08:45:25'),(2,'Lab3','195.246.192.26',1,1,'root','eyJpdiI6IlNBcWtRdFljbGRtb3UwdlwvMEs3cXd3PT0iLCJ2YWx1ZSI6IjRTUVhxTFR0aE5uenp4emdHUEhFVGpmTENRNXhQaHNcL0phTE45K3NHZGhnPSIsIm1hYyI6ImQzNWZlYmIzMDNlYzJkNWU3NWEyMmExNDI5OThlNWQ1ZGFlNzA2YzQ3ZDk5ODExNGY0ZDc4ODU5Y2RhODUxMWIifQ==',NULL,NULL,'2017-06-06 08:46:00','2017-06-07 07:20:06');
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
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
  `server_id` int(11) DEFAULT NULL,
  `check_rate` int(11) NOT NULL,
  `check_response` tinyint(1) NOT NULL DEFAULT '0',
  `response_attempts` int(11) NOT NULL DEFAULT '0',
  `check_certificate` tinyint(1) NOT NULL DEFAULT '0',
  `certificate_attempts` int(11) NOT NULL DEFAULT '0',
  `enable_nginx_configuration` tinyint(1) NOT NULL DEFAULT '0',
  `ssh_root` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_db` tinyint(1) NOT NULL DEFAULT '0',
  `db_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `db_database` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `db_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `db_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `response_down_from` timestamp NULL DEFAULT NULL,
  `certificate_down_from` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (1,'http://lab3.workup.it/',2,5,1,2,0,0,0,NULL,0,NULL,NULL,NULL,NULL,'2017-06-07 09:20:44','2017-06-06 11:01:00',NULL,NULL,'2017-06-06 08:48:00','2017-06-06 11:20:42'),(4,'http://demo.rubinred.it',1,5,1,0,0,0,1,'/home/workup/www/demo.rubinred.it',1,'localhost','demo_rubinred_it','demo_rubinred_it','eyJpdiI6InlPSm5UK25neVBsOG02bmxsVFFRWUE9PSIsInZhbHVlIjoiR204MGFheU5KUjkyWTdZZk1lMHpuUT09IiwibWFjIjoiMTU4NDBjZjY1Y2VhZTQxNGU0ODk3NzgzMzU1YmFjNzBiYzBjZjdmZWYwNjc4MTY1NjlkMTVlYzQzZmEyOTkxOCJ9','2017-06-07 09:20:54',NULL,NULL,NULL,'2017-06-06 09:59:27','2017-06-07 07:20:54'),(5,'https://www.google.it/',NULL,5,1,0,1,0,0,NULL,0,NULL,NULL,NULL,NULL,'2017-06-06 11:28:32',NULL,NULL,NULL,'2017-06-06 10:31:17','2017-06-06 11:28:33');
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Admin','admin@admin.com','users/default.png','$2y$10$pi5vcwQAO9XZLoAqGTZW8u.sOLAmNoA4nnIA38eZHOfQp4pXKWYAu','omwgUjCU7xbGFqclX2UtOcJMHauDdln3B06vQVzyyelimpMMfu9a32moIL6c','2017-05-22 07:41:31','2017-05-22 07:41:31',NULL),(2,4,'artisan','artisan@artisan.com','users/default.png','$2y$10$zuFDf2zFggpf8CqqbtLqzevtWOMuL/w.zpZ9q/YXfvRpZzMwVCGhC','K2TaKNQzyOTRV5YWLCtUlsCp43kVvTJWvzkTHcjgPgMAnWqmObk3FUzZzoJY','2017-05-29 07:40:33','2017-05-29 07:40:33',NULL),(3,2,'Normal','normal@normal.com','users/default.png','$2y$10$3lgUuTtcDvrbOMkrq/hIzuNxGbYtOXPltVhF3F8Uvf.mKnD1ztQDy',NULL,'2017-05-29 08:12:48','2017-05-29 08:12:48',NULL);
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

-- Dump completed on 2017-06-07 11:50:24
