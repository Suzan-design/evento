-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: evento
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amenities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenities`
--

LOCK TABLES `amenities` WRITE;
/*!40000 ALTER TABLE `amenities` DISABLE KEYS */;
INSERT INTO `amenities` VALUES (1,'2024-06-05 15:32:27','Parking','موقف سيارات','AmenityImages/sxiwUJjJe2rFAsmZvNNZz6xNPEHlYMZzp8ZGZVrs.png','2024-06-05 15:29:39','2024-06-05 15:32:27'),(2,NULL,'Special Needs','ذوي الاحتياجات الخاصة','AmenityImages/GXWwzzEsWvlkDkdZDnkofAkVUcnG0c98uQFtzaec.png','2024-06-05 15:31:05','2024-08-09 13:55:13'),(3,NULL,'Wifi','انترنت','AmenityImages/D4XCJXlcwBIFxcBNum6V7KEFgMuo26EpyTs0XA8D.png','2024-06-05 15:31:30','2024-08-09 13:55:20'),(4,NULL,'Pets','حيوانات اليفة','AmenityImages/W20L2eqJZQr7LRsZk1SNagltgsOGI13BIVfbpqxD.png','2024-06-05 15:31:53','2024-08-09 13:55:30'),(5,NULL,'Parking','موقف سيارات','AmenityImages/FwGCVLzFhKIQCWX9XJxsobXcS8oTWHpsluFkKAcz.png','2024-06-05 15:32:20','2024-08-09 13:55:36'),(6,'2024-07-24 10:17:13','dfgvnms','xccxcxcxc','AmenityImages/qcYNG2lHSLI9HIehaoqoaU8LCJigsYdmSPQkblvh.png','2024-07-24 10:17:01','2024-07-24 10:17:13'),(7,NULL,'Unavailable','غير متوفر','AmenityImages/xsh8iCSMU2cGA2q6773ydLcLFNyLAp0KpoFgJoh0.png','2024-08-06 13:46:28','2024-08-09 13:56:36');
/*!40000 ALTER TABLE `amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amenity_event`
--

DROP TABLE IF EXISTS `amenity_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amenity_event` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `amenity_id` bigint unsigned NOT NULL,
  `price` double(8,2) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `amenity_event_event_id_index` (`event_id`),
  KEY `amenity_event_amenity_id_index` (`amenity_id`),
  CONSTRAINT `amenity_event_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `amenity_event_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenity_event`
--

LOCK TABLES `amenity_event` WRITE;
/*!40000 ALTER TABLE `amenity_event` DISABLE KEYS */;
INSERT INTO `amenity_event` VALUES (29,16,4,21.00,'Pet-friendly event, welcoming your furry friends in designated areas','حدث صديق للحيوانات الأليفة، نرحب بأصدقائكم الفرويين في مناطق مخصصة','2024-07-31 09:11:11','2024-07-31 09:11:11'),(30,17,3,5000.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-01 09:38:30','2024-08-01 09:38:30'),(31,17,4,5000.00,'Pet-friendly event, welcoming your furry friends in designated areas','حدث صديق للحيوانات الأليفة، نرحب بأصدقائكم الفرويين في مناطق مخصصة','2024-08-01 09:38:30','2024-08-01 09:38:30'),(32,17,5,5000.00,'Ample parking available for all attendees, ensuring a hassle-free arrival and departure','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-01 09:38:30','2024-08-01 09:38:30'),(33,18,2,5000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-03 12:00:28','2024-08-03 12:00:28'),(34,18,3,5000.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-03 12:00:28','2024-08-03 12:00:28'),(35,18,4,5000.00,'Pet-friendly event, welcoming your furry friends in designated areas','حدث صديق للحيوانات الأليفة، نرحب بأصدقائكم الفرويين في مناطق مخصصة','2024-08-03 12:00:28','2024-08-03 12:00:28'),(36,19,2,5000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-03 12:33:50','2024-08-03 12:33:50'),(37,19,4,5000.00,'Pet-friendly event, welcoming your furry friends in designated areas','حدث صديق للحيوانات الأليفة، نرحب بأصدقائكم الفرويين في مناطق مخصصة','2024-08-03 12:33:50','2024-08-03 12:33:50'),(38,20,2,7500.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-03 12:53:25','2024-08-03 12:53:25'),(39,20,3,7500.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-03 12:53:25','2024-08-03 12:53:25'),(40,20,4,7500.00,'Pet-friendly event, welcoming your furry friends in designated areas','حدث صديق للحيوانات الأليفة، نرحب بأصدقائكم الفرويين في مناطق مخصصة','2024-08-03 12:53:25','2024-08-03 12:53:25'),(41,20,5,7500.00,'Ample parking available for all attendees, ensuring a hassle-free arrival and departure','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-03 12:53:25','2024-08-03 12:53:25'),(42,21,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-04 11:44:44','2024-08-04 11:44:44'),(43,22,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-04 11:58:59','2024-08-04 11:58:59'),(44,23,3,200.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-04 12:15:12','2024-08-04 12:15:12'),(45,24,5,10000.00,'Ample parking available for all attendees, ensuring a hassle-free arrival and departure','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-04 12:17:35','2024-08-04 12:17:35'),(46,25,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-04 12:27:16','2024-08-04 12:27:16'),(47,26,5,25000.00,'Ample parking available for all attendees, ensuring a hassle-free arrival and departure','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-04 12:49:09','2024-08-04 12:49:09'),(48,27,3,25000.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-04 12:57:44','2024-08-04 12:57:44'),(49,27,5,25000.00,'Ample parking available for all attendees, ensuring a hassle-free arrival and departure','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-04 12:57:44','2024-08-04 12:57:44'),(50,30,3,21.00,'Professional child care services available, allowing parents to enjoy the event worry-free','خدمات التصوير الاحترافية لالتقاط لحظات الفعالية الذكرى','2024-08-04 13:05:07','2024-08-04 13:05:07'),(51,31,3,21.00,'Professional child care services available, allowing parents to enjoy the event worry-free','خدمات التصوير الاحترافية لالتقاط لحظات الفعالية الذكرى','2024-08-04 13:05:23','2024-08-04 13:05:23'),(52,32,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-04 13:06:06','2024-08-04 13:06:06'),(53,33,3,12.00,'xxasxd','axdxzx','2024-08-04 13:09:47','2024-08-04 13:09:47'),(54,34,3,555.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-04 13:19:13','2024-08-04 13:19:13'),(55,36,4,1000.00,'Professional child care services available, allowing parents to enjoy the event worry-free','حدث صديق للحيوانات الأليفة، نرحب بأصدقائكم الفرويين في مناطق مخصصة','2024-08-04 13:34:34','2024-08-04 13:34:34'),(56,37,3,1000.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-04 13:41:21','2024-08-04 13:41:21'),(57,38,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-04 13:45:51','2024-08-04 13:45:51'),(58,41,3,10000.00,'Professional child care services available, allowing parents to enjoy the event worry-free','خدمات التصوير الاحترافية لالتقاط لحظات الفعالية الذكرى','2024-08-04 13:50:06','2024-08-04 13:50:06'),(59,42,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-04 13:56:38','2024-08-04 13:56:38'),(60,43,5,2000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-04 13:59:51','2024-08-04 13:59:51'),(61,44,5,2000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-04 14:01:04','2024-08-04 14:01:04'),(62,45,5,2000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-04 14:01:46','2024-08-04 14:01:46'),(63,46,5,2000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-04 14:01:56','2024-08-04 14:01:56'),(64,47,3,5000.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-04 14:08:42','2024-08-04 14:08:42'),(65,47,5,5000.00,'Ample parking available for all attendees, ensuring a hassle-free arrival and departure','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-04 14:08:42','2024-08-04 14:08:42'),(66,48,5,1000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-04 14:20:32','2024-08-04 14:20:32'),(67,49,5,1000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-04 14:21:28','2024-08-04 14:21:28'),(68,51,5,10000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-04 15:00:02','2024-08-04 15:00:02'),(69,52,5,10000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-04 15:00:41','2024-08-04 15:00:41'),(70,53,5,50000.00,'Ample parking available for all attendees, ensuring a hassle-free arrival and departure','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-04 15:09:07','2024-08-04 15:09:07'),(71,54,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-05 07:52:35','2024-08-05 07:52:35'),(72,55,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-05 07:58:48','2024-08-05 07:58:48'),(73,56,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-05 08:38:38','2024-08-05 08:38:38'),(74,58,5,0.00,'Free Parking','مواقف سيارات مجانية','2024-08-05 10:39:22','2024-08-05 10:39:22'),(75,59,5,1000.00,'Free Parking','مواقف سيارات مجانية','2024-08-05 12:48:10','2024-08-07 08:08:56'),(76,60,3,1000.00,'Professional photography services to capture the memorable moments of the event','خدمات رعاية الأطفال المحترفة متاحة، مما يتيح للوالدين الاستمتاع بالحدث بدون قلق','2024-08-05 13:40:56','2024-08-05 13:40:56'),(77,57,5,1000.00,'Convenient transportation options, including shuttle services to and from the event','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-08 07:55:50','2024-08-08 07:55:50'),(78,61,3,1000.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','خدمات التصوير الاحترافية لالتقاط لحظات الفعالية الذكرى','2024-08-08 08:55:39','2024-08-08 08:55:39'),(79,62,2,1000.00,'Pet-friendly event, welcoming your furry friends in designated areas','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-08 11:55:28','2024-08-08 11:55:28'),(80,63,2,1000.00,'Professional child care services available, allowing parents to enjoy the event worry-free','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-08 12:25:03','2024-08-08 12:25:03'),(81,64,3,1000.00,'Free high-speed WiFi access throughout the event venue, keeping you connected at all times','وصول مجاني للإنترنت اللاسلكي عالي السرعة في جميع أنحاء مكان الحدث، لتبقى متصلاً في جميع الأوقات','2024-08-09 12:34:20','2024-08-09 12:34:20'),(82,65,3,1000.00,'Professional child care services available, allowing parents to enjoy the event worry-free','jgjghj','2024-08-09 12:42:46','2024-08-09 12:42:46'),(83,66,2,1000.00,'dsad','asdad','2024-08-09 13:10:01','2024-08-09 13:10:01'),(84,67,4,5000.00,'Pet-friendly event, welcoming your furry friends in designated areas','حدث صديق للحيوانات الأليفة ، يرحب بأصدقائك ذوي الفراء في مناطق محددة','2024-08-09 14:24:47','2024-08-09 14:24:47'),(85,67,5,5000.00,'Ample parking available for all attendees, ensuring a hassle-free arrival and departure','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-09 14:24:47','2024-08-09 14:24:47'),(86,68,5,12.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-09 14:44:04','2024-08-09 14:44:04'),(87,69,5,7500.00,'Ample parking available for all attendees, ensuring a hassle-free arrival and departure','مواقف سيارات واسعة متاحة لجميع الحضور، لضمان وصول ومغادرة بدون أي عناء','2024-08-09 14:49:22','2024-08-09 14:49:22'),(88,70,5,312.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-10 08:56:10','2024-08-10 08:56:10'),(89,71,5,1000.00,'Fully accessible to individuals with special needs, ensuring an inclusive experience for all','متاح بالكامل للأشخاص ذوي الاحتياجات الخاصة، لضمان تجربة شاملة للجميع','2024-08-10 11:32:46','2024-08-10 11:32:46'),(90,72,3,5000.00,'Professional photography services to capture the memorable moments of the event','خدمات رعاية الأطفال المحترفة متاحة، مما يتيح للوالدين الاستمتاع بالحدث بدون قلق','2024-08-10 12:51:33','2024-08-10 12:51:33'),(91,73,3,100.00,'Professional child care services available, allowing parents to enjoy the event worry-free','خدمات التصوير الاحترافية لالتقاط لحظات الفعالية الذكرى','2024-08-10 13:05:01','2024-08-10 13:05:01'),(92,74,3,123.00,'Professional photography services to capture the memorable moments of the event','خدمات رعاية الأطفال المحترفة متاحة، مما يتيح للوالدين الاستمتاع بالحدث بدون قلق','2024-08-10 13:48:59','2024-08-10 13:48:59');
/*!40000 ALTER TABLE `amenity_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `event_id` bigint unsigned DEFAULT NULL,
  `class_id` bigint unsigned DEFAULT NULL,
  `promo_code_id` bigint unsigned DEFAULT NULL,
  `invoice_id` bigint DEFAULT NULL,
  `offer_id` bigint unsigned DEFAULT NULL,
  `user_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amenities` json NOT NULL,
  `class_ticket_price` int NOT NULL,
  `status` enum('pending','paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_class_id_foreign` (`class_id`),
  KEY `bookings_promo_code_id_foreign` (`promo_code_id`),
  KEY `bookings_offer_id_foreign` (`offer_id`),
  KEY `bookings_user_id_index` (`user_id`),
  KEY `bookings_event_id_index` (`event_id`),
  CONSTRAINT `bookings_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `event_classes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_promo_code_id_foreign` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,18,NULL,NULL,1,7916451081629094122,NULL,'0988020707','E cash','VIP','Raneem','shaher',30,'0988020707','[]',125000,'paid','2024-06-09 13:23:00','2024-06-09 13:35:27'),(3,19,NULL,NULL,1,NULL,NULL,'0988134562','E cash','normal','mohammad','dago',12,'0955399547','[\"3\"]',80000,'pending','2024-06-09 13:24:00','2024-06-09 13:24:00'),(9,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-03 13:04:42','2024-08-03 13:04:42'),(12,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-03 13:09:25','2024-08-03 13:09:25'),(13,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-03 13:27:08','2024-08-03 13:27:08'),(14,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-03 13:47:18','2024-08-03 13:47:18'),(15,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-03 15:45:32','2024-08-03 15:45:32'),(16,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-03 15:48:07','2024-08-03 15:48:07'),(17,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-03 16:00:35','2024-08-03 16:00:35'),(18,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-03 17:08:01','2024-08-03 17:08:01'),(19,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 09:26:54','2024-08-04 09:26:54'),(20,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 09:29:06','2024-08-04 09:29:06'),(21,8,20,NULL,NULL,NULL,NULL,'0968397446','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 09:34:39','2024-08-04 09:34:39'),(22,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 09:38:46','2024-08-04 09:38:46'),(23,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 12:43:10','2024-08-04 12:43:10'),(24,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 12:43:15','2024-08-04 12:43:15'),(25,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 12:43:44','2024-08-04 12:43:44'),(27,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 12:46:12','2024-08-04 12:46:12'),(28,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 12:47:42','2024-08-04 12:47:42'),(29,23,46,107,NULL,NULL,NULL,'0937720429','sddcfsdc','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-04 14:13:58','2024-08-04 14:13:58'),(30,23,46,107,NULL,NULL,NULL,'0937720429','sddcfsdc','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-04 14:14:09','2024-08-04 14:14:09'),(31,23,46,107,NULL,NULL,NULL,'0937720429','sddcfsdc','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-04 14:14:46','2024-08-04 14:14:46'),(32,23,46,107,NULL,NULL,NULL,'0937720429','sddcfsdc','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-04 14:14:52','2024-08-04 14:14:52'),(33,23,46,107,NULL,NULL,NULL,'0937720429','sddcfsdc','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-04 14:15:09','2024-08-04 14:15:09'),(34,23,46,107,NULL,NULL,NULL,'0937720429','sddcfsdc','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-04 14:15:52','2024-08-04 14:15:52'),(35,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:16:33','2024-08-04 14:16:33'),(36,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:16:52','2024-08-04 14:16:52'),(37,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:16:56','2024-08-04 14:16:56'),(38,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:17:04','2024-08-04 14:17:04'),(39,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:17:05','2024-08-04 14:17:05'),(40,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:17:07','2024-08-04 14:17:07'),(41,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:17:12','2024-08-04 14:17:12'),(42,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:17:13','2024-08-04 14:17:13'),(43,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:17:16','2024-08-04 14:17:16'),(44,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:20:09','2024-08-04 14:20:09'),(45,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:20:33','2024-08-04 14:20:33'),(46,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:20:53','2024-08-04 14:20:53'),(47,23,47,110,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:20:56','2024-08-04 14:20:56'),(48,23,49,112,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:46:29','2024-08-04 14:46:29'),(49,23,49,112,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:54:16','2024-08-04 14:54:16'),(50,23,49,112,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:54:21','2024-08-04 14:54:21'),(51,23,49,112,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:54:23','2024-08-04 14:54:23'),(52,23,49,112,NULL,NULL,NULL,'0937720429','Siin Anniversary HDR','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 14:54:31','2024-08-04 14:54:31'),(53,23,52,117,NULL,NULL,NULL,'0937720429','Siin Anniversary test','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 15:01:43','2024-08-04 15:01:43'),(54,23,52,117,NULL,NULL,NULL,'0937720429','Siin Anniversary test','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-04 15:01:51','2024-08-04 15:01:51'),(55,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-04 15:04:56','2024-08-04 15:04:56'),(56,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-04 15:05:05','2024-08-04 15:05:05'),(57,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-04 15:05:09','2024-08-04 15:05:09'),(58,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-04 15:07:16','2024-08-04 15:07:16'),(59,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-04 15:09:59','2024-08-04 15:09:59'),(60,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-04 15:10:03','2024-08-04 15:10:03'),(61,23,53,120,NULL,NULL,NULL,'0937720429','sin experience Anniversary','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 07:32:31','2024-08-05 07:32:31'),(62,23,53,120,NULL,NULL,NULL,'0937720429','sin experience Anniversary','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 07:32:33','2024-08-05 07:32:33'),(63,23,53,120,NULL,NULL,NULL,'0937720429','sin experience Anniversary','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 07:41:57','2024-08-05 07:41:57'),(64,23,53,120,NULL,NULL,NULL,'0937720429','sin experience Anniversary','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 07:42:07','2024-08-05 07:42:07'),(65,23,53,120,NULL,NULL,NULL,'0937720429','sin experience Anniversary','Wave 1','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 07:42:12','2024-08-05 07:42:12'),(66,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 07:46:14','2024-08-05 07:46:14'),(67,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 07:46:16','2024-08-05 07:46:16'),(68,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 07:48:40','2024-08-05 07:48:40'),(69,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 07:48:43','2024-08-05 07:48:43'),(70,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 07:50:30','2024-08-05 07:50:30'),(71,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 07:50:32','2024-08-05 07:50:32'),(72,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 07:56:47','2024-08-05 07:56:47'),(73,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 07:56:49','2024-08-05 07:56:49'),(74,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 07:56:49','2024-08-05 07:56:49'),(75,23,55,125,NULL,NULL,NULL,'0937720429','Siin Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 08:29:44','2024-08-05 08:29:44'),(76,23,55,125,NULL,NULL,NULL,'0937720429','Siin Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 08:29:45','2024-08-05 08:29:45'),(77,23,55,125,NULL,NULL,NULL,'0937720429','Siin Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 08:29:46','2024-08-05 08:29:46'),(78,23,55,125,NULL,NULL,NULL,'0937720429','Siin Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 08:36:33','2024-08-05 08:36:33'),(79,23,55,125,NULL,NULL,NULL,'0937720429','Siin Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 08:36:34','2024-08-05 08:36:34'),(80,23,55,125,NULL,NULL,NULL,'0937720429','Siin Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 08:36:38','2024-08-05 08:36:38'),(81,23,55,125,NULL,NULL,NULL,'0937720429','Siin Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 08:36:43','2024-08-05 08:36:43'),(82,23,55,125,NULL,NULL,NULL,'0937720429','Siin Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 08:36:49','2024-08-05 08:36:49'),(83,23,23,59,NULL,NULL,NULL,'0937720429','test','A','zeen','bara',35,'0937720429','[]',152,'pending','2024-08-05 08:54:05','2024-08-05 08:54:05'),(84,23,57,NULL,NULL,NULL,NULL,'0937720429','asd','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-05 09:10:57','2024-08-05 09:10:57'),(85,23,57,NULL,NULL,NULL,NULL,'0937720429','asd','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-05 09:10:59','2024-08-05 09:10:59'),(86,23,57,NULL,NULL,NULL,NULL,'0937720429','asd','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-05 09:11:00','2024-08-05 09:11:00'),(87,23,57,NULL,NULL,NULL,NULL,'0937720429','asd','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-05 09:11:01','2024-08-05 09:11:01'),(88,24,57,NULL,NULL,NULL,NULL,'0999999999','asd','Wave 1','diana','diana',24,'0999999999','[]',1000,'pending','2024-08-05 09:13:08','2024-08-05 09:13:08'),(89,24,57,NULL,NULL,NULL,NULL,'0999999999','asd','Wave 1','diana','diana',24,'0999999999','[]',1000,'pending','2024-08-05 09:13:09','2024-08-05 09:13:09'),(90,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-05 10:13:15','2024-08-05 10:13:15'),(91,23,57,NULL,NULL,NULL,NULL,'0937720429','asd','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-05 10:13:41','2024-08-05 10:13:41'),(92,23,57,NULL,NULL,NULL,NULL,'0937720429','asd','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-05 10:13:43','2024-08-05 10:13:43'),(93,23,57,NULL,NULL,NULL,NULL,'0937720429','asd','Wave 1','zeen','bara',35,'0937720429','[]',1000,'pending','2024-08-05 10:15:10','2024-08-05 10:15:10'),(94,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 10:26:34','2024-08-05 10:26:34'),(95,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 10:28:08','2024-08-05 10:28:08'),(96,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 10:28:15','2024-08-05 10:28:15'),(97,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 10:28:54','2024-08-05 10:28:54'),(98,1,58,NULL,NULL,NULL,NULL,'0996368902','Siin Experience Anniversary','Regular','maysj','jrjr',24,'0996368902','[]',450000,'pending','2024-08-05 10:50:36','2024-08-05 10:50:36'),(99,1,58,NULL,NULL,NULL,NULL,'0996368902','Siin Experience Anniversary','Regular','maysj','jrjr',24,'0996368902','[]',450000,'pending','2024-08-05 10:56:51','2024-08-05 10:56:51'),(100,1,58,NULL,NULL,NULL,NULL,'0996368902','Siin Experience Anniversary','Regular','maysj','jrjr',24,'0996368902','[]',450000,'pending','2024-08-05 10:57:23','2024-08-05 10:57:23'),(102,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-05 11:08:36','2024-08-05 11:08:36'),(103,1,58,NULL,NULL,NULL,NULL,'0996368902','Siin Experience Anniversary','Regular','maysj','jrjr',24,'0996368902','[]',450000,'pending','2024-08-05 11:09:23','2024-08-05 11:09:23'),(104,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',0,'937720429','[]',100000,'pending','2024-08-05 11:14:51','2024-08-05 11:14:51'),(106,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 12:05:57','2024-08-05 12:05:57'),(107,23,58,NULL,NULL,NULL,NULL,'0937720429','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 12:48:21','2024-08-05 12:48:21'),(108,23,58,NULL,NULL,NULL,NULL,'0937720429','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 12:50:13','2024-08-05 12:50:13'),(109,23,58,NULL,NULL,NULL,NULL,'0937720429','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 12:50:23','2024-08-05 12:50:23'),(110,23,58,NULL,NULL,NULL,NULL,'0937720429','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 12:50:34','2024-08-05 12:50:34'),(111,23,58,NULL,NULL,NULL,NULL,'0937720429','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 12:50:36','2024-08-05 12:50:36'),(112,23,58,NULL,NULL,NULL,NULL,'0937720429','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 12:50:38','2024-08-05 12:50:38'),(113,23,58,NULL,NULL,NULL,NULL,'0937720429','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 12:50:42','2024-08-05 12:50:42'),(114,23,58,NULL,NULL,NULL,NULL,'0937720429','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 12:50:43','2024-08-05 12:50:43'),(115,23,58,NULL,NULL,NULL,NULL,'0937720429','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-05 12:50:54','2024-08-05 12:50:54'),(120,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 13:07:27','2024-08-05 13:07:27'),(121,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 13:16:57','2024-08-05 13:16:57'),(122,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 13:17:48','2024-08-05 13:17:48'),(123,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 13:56:11','2024-08-05 13:56:11'),(124,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 13:58:08','2024-08-05 13:58:08'),(125,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 15:08:09','2024-08-05 15:08:09'),(126,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 15:12:39','2024-08-05 15:12:39'),(127,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 15:14:42','2024-08-05 15:14:42'),(128,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 15:32:57','2024-08-05 15:32:57'),(129,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 15:50:13','2024-08-05 15:50:13'),(130,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 15:53:02','2024-08-05 15:53:02'),(131,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 15:53:59','2024-08-05 15:53:59'),(132,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 15:59:38','2024-08-05 15:59:38'),(133,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 16:09:48','2024-08-05 16:09:48'),(134,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 16:16:30','2024-08-05 16:16:30'),(135,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 16:41:42','2024-08-05 16:41:42'),(136,1,57,NULL,NULL,NULL,NULL,'0996368902','asd','Wave 1','maysj','jrjr',24,'0996368902','[]',1000,'pending','2024-08-05 16:50:40','2024-08-05 16:50:40'),(137,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 16:51:17','2024-08-05 16:51:17'),(138,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 17:03:04','2024-08-05 17:03:04'),(139,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 17:08:19','2024-08-05 17:08:19'),(140,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 18:10:24','2024-08-05 18:10:24'),(141,23,20,NULL,NULL,NULL,NULL,'0937720429','Karaoke Competition','A','alaa','ahmad',20,'937720429','[]',100000,'pending','2024-08-05 18:17:04','2024-08-05 18:17:04'),(142,8,58,NULL,NULL,NULL,NULL,'0968397446','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-06 07:54:48','2024-08-06 07:54:48'),(143,24,20,NULL,NULL,NULL,NULL,'0999999999','Karaoke Competition','A','diana','diana',24,'0999999999','[]',100000,'pending','2024-08-06 09:31:18','2024-08-06 09:31:18'),(144,8,58,NULL,NULL,NULL,NULL,'0968397446','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-06 09:55:16','2024-08-06 09:55:16'),(145,8,58,NULL,NULL,NULL,NULL,'0968397446','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-06 10:09:23','2024-08-06 10:09:23'),(146,8,58,NULL,NULL,NULL,NULL,'0968397446','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-06 10:13:49','2024-08-06 10:13:49'),(147,8,58,NULL,NULL,NULL,NULL,'0968397446','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-06 10:19:22','2024-08-06 10:19:22'),(148,8,58,NULL,NULL,123456789,NULL,'0968397446','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'paid','2024-08-06 10:31:09','2024-08-06 10:52:54'),(150,2,58,NULL,NULL,NULL,NULL,'0958957464','Siin Experience Anniversary','Regular','maysam','sweid',24,'0958957464','[]',450000,'pending','2024-08-06 12:29:46','2024-08-06 12:29:46'),(152,2,57,NULL,NULL,NULL,NULL,'0958957464','asd','Wave 1','maysam','sweid',24,'0958957464','[]',1000,'pending','2024-08-06 13:14:45','2024-08-06 13:14:45'),(153,2,57,NULL,NULL,1072427438,NULL,'0958957464','asd','Wave 1','maysam','sweid',24,'0958957464','[]',1000,'paid','2024-08-06 13:15:48','2024-08-06 13:19:01'),(154,2,57,NULL,NULL,NULL,NULL,'0958957464','asd','Wave 1','maysam','sweid',24,'0958957464','[]',1000,'pending','2024-08-06 13:22:12','2024-08-06 13:22:12'),(155,8,58,NULL,NULL,NULL,NULL,'0968397446','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'pending','2024-08-06 13:24:57','2024-08-06 13:24:57'),(156,24,58,NULL,NULL,NULL,NULL,'0999999999','Siin Experience Anniversary','VIP','diana','diana',24,'0999999999','[\"5\"]',1500000,'pending','2024-08-06 14:37:47','2024-08-06 14:37:47'),(157,24,57,NULL,NULL,NULL,NULL,'0999999999','asd','Wave 1','diana','diana',24,'0999999999','[\"5\"]',1000,'pending','2024-08-06 14:38:10','2024-08-06 14:38:10'),(158,24,58,NULL,NULL,NULL,NULL,'0999999999','Siin Experience Anniversary','Regular','diana','diana',24,'0999999999','[]',450000,'pending','2024-08-06 14:48:20','2024-08-06 14:48:20'),(159,17,58,NULL,NULL,NULL,NULL,'0988134561','Siin Experience Anniversary','Regular','Hasan','HDR',31,'0988134561','[\"5\"]',450000,'pending','2024-08-06 15:18:40','2024-08-06 15:18:40'),(160,24,58,NULL,NULL,NULL,NULL,'0999999999','Siin Experience Anniversary','VIP','diana','diana',24,'0999999999','[]',1500000,'pending','2024-08-06 16:04:17','2024-08-06 16:04:17'),(161,24,58,NULL,NULL,451223474,NULL,'0999999999','Siin Experience Anniversary','VIP','diana','diana',24,'0999999999','[]',1500000,'paid','2024-08-06 16:06:26','2024-08-06 16:08:43'),(162,5,58,NULL,NULL,NULL,NULL,'0937755273','Siin Experience Anniversary','Regular','Haidar','Tarboush',24,'0937755273','[\"5\"]',450000,'pending','2024-08-06 17:26:07','2024-08-06 17:26:07'),(163,2,63,178,NULL,NULL,NULL,'0958957464','dxad','A','maysam','sweid',24,'0958957464','[]',980,'pending','2024-08-08 17:53:26','2024-08-08 17:53:26'),(164,5,58,148,NULL,NULL,NULL,'0937755273','Siin Experience Anniversary','Regular','Haidar','Tarboush',24,'0937755273','[]',450000,'pending','2024-08-08 17:53:30','2024-08-08 17:53:30'),(165,25,58,148,NULL,NULL,NULL,'0937755544','Siin Experience Anniversary','Regular','Mohammad','Daghistani',34,'0937755544','[]',450000,'pending','2024-08-08 18:21:55','2024-08-08 18:21:55'),(166,25,58,148,NULL,NULL,NULL,'0937755544','Siin Experience Anniversary','Regular','Mohammad','Daghistani',34,'0937755544','[\"5\"]',450000,'pending','2024-08-08 18:26:06','2024-08-08 18:26:06'),(167,25,63,178,NULL,NULL,NULL,'0937755544','dxad','A','Mohammad','Daghistani',34,'0937755544','[]',980,'pending','2024-08-08 18:33:22','2024-08-08 18:33:22'),(168,25,63,178,NULL,NULL,NULL,'0937755544','dxad','A','Mohammad','Daghistani',34,'0937755544','[]',980,'pending','2024-08-08 18:36:58','2024-08-08 18:36:58'),(169,25,63,178,NULL,NULL,NULL,'0937755544','dxad','A','Mohammad','Daghistani',34,'0937755544','[]',980,'pending','2024-08-08 18:38:16','2024-08-08 18:38:16'),(170,25,63,178,NULL,NULL,NULL,'0937755544','dxad','A','Mohammad','Daghistani',34,'0937755544','[]',980,'pending','2024-08-08 18:41:32','2024-08-08 18:41:32'),(171,25,63,178,NULL,NULL,NULL,'0937755544','dxad','A','Mohammad','Daghistani',34,'0937755544','[]',980,'pending','2024-08-08 18:45:35','2024-08-08 18:45:35'),(172,25,63,178,NULL,NULL,NULL,'0937755544','dxad','A','Mohammad','Daghistani',34,'0937755544','[]',980,'pending','2024-08-08 18:46:13','2024-08-08 18:46:13'),(173,12,61,167,NULL,NULL,3,'0999999994','test test','A','Suzan','Alali',30,'0999999994','[\"5\"]',800,'pending','2024-08-09 11:21:52','2024-08-09 11:21:52'),(174,5,69,204,NULL,NULL,NULL,'0937755273','Palmyra Archaeological Symposium','A','Haidar','Tarboush',24,'0937755273','[]',275000,'paid','2024-08-09 14:54:07','2024-08-09 14:54:07'),(176,25,58,148,NULL,NULL,NULL,'0937755544','Siin Experience Anniversary','Regular','Mohammad','Daghistani',34,'0937755544','[]',450000,'pending','2024-08-09 16:54:51','2024-08-09 16:54:51'),(177,25,58,148,NULL,NULL,NULL,'0937755544','Siin Experience Anniversary','Regular','Mohammad','Daghistani',34,'0937755544','[]',450000,'pending','2024-08-09 17:39:22','2024-08-09 17:39:22'),(178,25,58,148,NULL,NULL,NULL,'0937755544','Siin Experience Anniversary','Regular','Mohammad','Daghistani',34,'0937755544','[]',450000,'pending','2024-08-09 18:46:01','2024-08-09 18:46:01'),(179,25,67,199,NULL,NULL,NULL,'0937755544','Syrian championship of speed racing and drift','A','Mohammad','Daghistani',34,'0937755544','[]',315250,'pending','2024-08-09 18:46:40','2024-08-09 18:46:40'),(180,25,67,199,NULL,NULL,NULL,'0937755544','Syrian championship of speed racing and drift','A','Mohammad','Daghistani',34,'0937755544','[]',315250,'pending','2024-08-09 18:47:29','2024-08-09 18:47:29'),(181,25,58,149,NULL,NULL,NULL,'0937755544','Siin Experience Anniversary','VIP','Mohammad','Daghistani',34,'0937755544','[]',1500000,'pending','2024-08-09 18:47:47','2024-08-09 18:47:47'),(182,25,18,NULL,NULL,NULL,NULL,'0937755544','Camping','A','Mohammad','Daghistani',34,'0937755544','[]',149965,'pending','2024-08-09 18:48:20','2024-08-09 18:48:20'),(183,25,18,NULL,NULL,NULL,NULL,'0937755544','Camping','C','Mohammad','Daghistani',34,'0937755544','[]',74965,'pending','2024-08-09 18:48:37','2024-08-09 18:48:37'),(184,25,19,194,NULL,NULL,NULL,'0937755544','Carnaval Marmarita','A','Mohammad','Daghistani',34,'0937755544','[]',99985,'pending','2024-08-09 18:50:51','2024-08-09 18:50:51'),(185,25,67,199,NULL,NULL,8,'0937755544','Syrian championship of speed racing and drift','A','Mohammad','Daghistani',34,'0937755544','[]',315250,'pending','2024-08-10 07:40:09','2024-08-10 07:40:09'),(186,24,67,201,NULL,1710769823,8,'0999999999','Syrian championship of speed racing and drift','C','diana','diana',24,'0999999999','[\"5\"]',296000,'paid','2024-08-10 08:06:41','2024-08-10 08:08:52'),(187,25,70,NULL,NULL,NULL,NULL,'0937755544','Test Anniversary','Regular','Mohammad','Daghistani',34,'0937755544','[]',450,'pending','2024-08-10 08:15:17','2024-08-10 08:15:17'),(188,25,70,NULL,NULL,NULL,NULL,'0937755544','Test Anniversary','VIP','Mohammad','Daghistani',34,'0937755544','[]',1350000,'pending','2024-08-10 08:15:44','2024-08-10 08:15:44'),(189,25,67,199,NULL,NULL,8,'0937755544','Syrian championship of speed racing and drift','A','Mohammad','Daghistani',34,'0937755544','[]',315250,'pending','2024-08-10 08:17:52','2024-08-10 08:17:52'),(190,25,70,NULL,NULL,NULL,NULL,'0937755544','Test Anniversary','Regular','Mohammad','Daghistani',34,'0937755544','[]',450,'pending','2024-08-10 08:32:41','2024-08-10 08:32:41'),(191,42,70,224,NULL,NULL,10,'0992555775','Test Anniversary','Regular','omar','al khaldi',29,'0992555775','[\"7\"]',490,'pending','2024-08-10 11:18:56','2024-08-10 11:18:56'),(192,42,70,224,NULL,NULL,10,'0992555775','Test Anniversary','Regular','omar','al khaldi',29,'0992555775','[]',490,'pending','2024-08-10 11:19:43','2024-08-10 11:19:43');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cancel_invoices`
--

DROP TABLE IF EXISTS `cancel_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cancel_invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cancel_invoices_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `cancel_invoices_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancel_invoices`
--

LOCK TABLES `cancel_invoices` WRITE;
/*!40000 ALTER TABLE `cancel_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `cancel_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cancelled_bookings`
--

DROP TABLE IF EXISTS `cancelled_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cancelled_bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `event_id` bigint unsigned DEFAULT NULL,
  `promo_code_id` bigint unsigned DEFAULT NULL,
  `user_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amenities` json NOT NULL,
  `class_ticket_price` int NOT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cancelled_bookings_promo_code_id_foreign` (`promo_code_id`),
  KEY `cancelled_bookings_user_id_index` (`user_id`),
  KEY `cancelled_bookings_event_id_index` (`event_id`),
  CONSTRAINT `cancelled_bookings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL,
  CONSTRAINT `cancelled_bookings_promo_code_id_foreign` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `cancelled_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancelled_bookings`
--

LOCK TABLES `cancelled_bookings` WRITE;
/*!40000 ALTER TABLE `cancelled_bookings` DISABLE KEYS */;
INSERT INTO `cancelled_bookings` VALUES (4,8,58,NULL,'0968397446','Siin Experience Anniversary','Regular','zeen','bara',35,'0937720429','[]',450000,'hello','pending','2024-08-06 13:03:37','2024-08-06 13:03:37',NULL),(5,2,57,NULL,'0958957464','asd','Wave 1','maysam','sweid',24,'0958957464','[]',1000,'I have an urgent need','pending','2024-08-06 13:44:43','2024-08-06 13:44:43',NULL),(6,5,67,NULL,'0937755273','Syrian championship of speed racing and drift','A','Haidar','Tarboush',24,'0937755273','[]',315250,'hello','pending','2024-08-09 15:26:02','2024-08-09 15:26:02',1550);
/*!40000 ALTER TABLE `cancelled_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_amenity`
--

DROP TABLE IF EXISTS `class_amenity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_amenity` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amenity_id` bigint unsigned NOT NULL,
  `event_class_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_amenity_amenity_id_index` (`amenity_id`),
  KEY `class_amenity_event_class_id_index` (`event_class_id`),
  CONSTRAINT `class_amenity_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `class_amenity_event_class_id_foreign` FOREIGN KEY (`event_class_id`) REFERENCES `event_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_amenity`
--

LOCK TABLES `class_amenity` WRITE;
/*!40000 ALTER TABLE `class_amenity` DISABLE KEYS */;
INSERT INTO `class_amenity` VALUES (46,2,28,NULL,NULL),(112,5,55,NULL,NULL),(113,5,56,NULL,NULL),(114,5,57,NULL,NULL),(115,5,58,NULL,NULL),(116,3,59,NULL,NULL),(117,3,60,NULL,NULL),(118,3,61,NULL,NULL),(119,5,62,NULL,NULL),(120,5,63,NULL,NULL),(123,5,66,NULL,NULL),(124,5,67,NULL,NULL),(125,5,68,NULL,NULL),(126,5,69,NULL,NULL),(127,3,70,NULL,NULL),(128,5,70,NULL,NULL),(129,3,71,NULL,NULL),(130,3,72,NULL,NULL),(131,3,73,NULL,NULL),(132,3,74,NULL,NULL),(133,3,75,NULL,NULL),(134,3,76,NULL,NULL),(135,3,77,NULL,NULL),(138,3,80,NULL,NULL),(139,4,81,NULL,NULL),(140,3,82,NULL,NULL),(141,3,83,NULL,NULL),(142,3,84,NULL,NULL),(143,3,85,NULL,NULL),(144,3,86,NULL,NULL),(148,5,90,NULL,NULL),(151,5,93,NULL,NULL),(152,5,94,NULL,NULL),(153,5,95,NULL,NULL),(154,5,96,NULL,NULL),(155,5,97,NULL,NULL),(156,5,98,NULL,NULL),(157,3,99,NULL,NULL),(158,5,100,NULL,NULL),(159,5,101,NULL,NULL),(160,5,102,NULL,NULL),(161,5,103,NULL,NULL),(162,5,104,NULL,NULL),(163,5,105,NULL,NULL),(164,5,106,NULL,NULL),(165,5,107,NULL,NULL),(166,5,108,NULL,NULL),(167,5,109,NULL,NULL),(168,3,110,NULL,NULL),(169,5,110,NULL,NULL),(170,3,111,NULL,NULL),(171,5,112,NULL,NULL),(172,5,113,NULL,NULL),(173,5,114,NULL,NULL),(174,5,115,NULL,NULL),(175,3,116,NULL,NULL),(176,5,117,NULL,NULL),(177,5,118,NULL,NULL),(178,3,119,NULL,NULL),(179,5,120,NULL,NULL),(180,5,121,NULL,NULL),(181,5,122,NULL,NULL),(182,5,123,NULL,NULL),(183,5,124,NULL,NULL),(184,5,125,NULL,NULL),(185,5,126,NULL,NULL),(186,5,127,NULL,NULL),(187,5,128,NULL,NULL),(193,3,134,NULL,NULL),(194,3,135,NULL,NULL),(205,5,146,NULL,NULL),(206,5,147,NULL,NULL),(207,5,148,NULL,NULL),(208,5,149,NULL,NULL),(209,5,150,NULL,NULL),(226,5,167,NULL,NULL),(227,3,168,NULL,NULL),(228,4,169,NULL,NULL),(237,4,178,NULL,NULL),(238,3,179,NULL,NULL),(239,7,180,NULL,NULL),(240,3,181,NULL,NULL),(241,4,181,NULL,NULL),(242,5,181,NULL,NULL),(243,3,182,NULL,NULL),(244,4,182,NULL,NULL),(245,3,183,NULL,NULL),(246,5,183,NULL,NULL),(261,4,190,NULL,NULL),(272,2,194,NULL,NULL),(273,4,194,NULL,NULL),(274,2,195,NULL,NULL),(282,4,199,NULL,NULL),(283,5,199,NULL,NULL),(284,4,200,NULL,NULL),(285,5,201,NULL,NULL),(286,5,202,NULL,NULL),(287,3,203,NULL,NULL),(288,5,204,NULL,NULL),(322,2,219,NULL,NULL),(323,3,219,NULL,NULL),(324,4,219,NULL,NULL),(325,5,219,NULL,NULL),(326,2,220,NULL,NULL),(327,3,220,NULL,NULL),(328,4,220,NULL,NULL),(329,3,221,NULL,NULL),(330,4,221,NULL,NULL),(331,5,221,NULL,NULL),(334,7,224,NULL,NULL),(335,7,225,NULL,NULL),(343,2,229,NULL,NULL),(344,3,229,NULL,NULL),(345,4,229,NULL,NULL),(346,2,230,NULL,NULL),(347,3,230,NULL,NULL),(348,3,231,NULL,NULL),(349,4,231,NULL,NULL),(351,7,233,NULL,NULL),(352,7,234,NULL,NULL),(353,3,235,NULL,NULL),(355,5,237,NULL,NULL),(356,5,238,NULL,NULL);
/*!40000 ALTER TABLE `class_amenity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_tokens`
--

DROP TABLE IF EXISTS `device_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `device_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mobile_user_id` bigint unsigned NOT NULL,
  `device_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `device_tokens_mobile_user_id_foreign` (`mobile_user_id`),
  CONSTRAINT `device_tokens_mobile_user_id_foreign` FOREIGN KEY (`mobile_user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_tokens`
--

LOCK TABLES `device_tokens` WRITE;
/*!40000 ALTER TABLE `device_tokens` DISABLE KEYS */;
INSERT INTO `device_tokens` VALUES (2,3,'b5927d8b43b45032f8687e','2024-06-05 15:14:48','2024-06-05 15:14:48'),(10,8,'sdfghjk','2024-06-07 11:19:47','2024-06-07 11:19:47'),(12,5,'52b1f942c0ec52ca4e1e42','2024-06-07 14:23:44','2024-06-07 14:23:44'),(13,8,'e038e9a3e7645c3abc9328','2024-06-07 14:27:50','2024-06-07 14:27:50'),(50,18,'8702f6341199fbc2a67cd7','2024-06-09 11:44:23','2024-06-09 11:44:23'),(55,12,'30f12f8983fc4e370498af','2024-06-09 13:42:42','2024-06-09 13:42:42'),(61,23,'97dafe5e2feb0ccaa8406b','2024-08-01 08:59:48','2024-08-01 08:59:48'),(62,23,'d308ccc920268ca00c7eef','2024-08-01 09:24:16','2024-08-01 09:24:16'),(74,26,'01013f7cee20d25d3533fa','2024-08-03 16:17:47','2024-08-03 16:17:47'),(102,1,'765b2f55c511c836c768a7','2024-08-04 14:22:50','2024-08-04 14:22:50'),(111,29,'23d0fc5f047cf87e427f26','2024-08-05 11:19:30','2024-08-05 11:19:30'),(115,23,'c8fe9da914a4a714ab19b4','2024-08-05 11:59:52','2024-08-05 11:59:52'),(119,5,'2d1f296d1cc4264d9b923a','2024-08-05 13:02:29','2024-08-05 13:02:29'),(130,23,'14ec73d466e0f27314bfa6','2024-08-06 09:35:13','2024-08-06 09:35:13'),(148,23,'1d65441add2a0725ce041c','2024-08-06 14:23:06','2024-08-06 14:23:06'),(152,17,'7de6cfa1b825a6a9992863','2024-08-06 15:14:50','2024-08-06 15:14:50'),(154,2,'91cf130d7c0c54cbbc10c4','2024-08-06 16:15:21','2024-08-06 16:15:21'),(157,39,'a7f3c7486e1c2cefaf05ff','2024-08-06 16:36:39','2024-08-06 16:36:39'),(160,5,'568792cce9dc2f3e9e4293','2024-08-06 17:25:09','2024-08-06 17:25:09'),(161,17,'6c04846a2b765cc716a2eb','2024-08-06 18:06:20','2024-08-06 18:06:20'),(162,25,'46ae3071686638049e7e01','2024-08-07 08:55:42','2024-08-07 08:55:42'),(182,25,'9281b449330b28948b26d3','2024-08-08 18:20:39','2024-08-08 18:20:39'),(187,30,'bcae3dfeca0a731c816f6d','2024-08-09 13:38:42','2024-08-09 13:38:42'),(189,5,'c342dfa857047b87c14369','2024-08-09 14:53:51','2024-08-09 14:53:51'),(190,5,'0ac88cc8cbe43b3e7b3fba','2024-08-09 15:05:28','2024-08-09 15:05:28'),(191,5,'asdfghjk','2024-08-09 15:21:04','2024-08-09 15:21:04'),(192,5,'767529509970634492e86e','2024-08-10 02:33:54','2024-08-10 02:33:54'),(195,2,'cde1f75ed7553bbdf7cfe5','2024-08-10 08:20:36','2024-08-10 08:20:36'),(197,42,'3d687e755c1dcb78df357e','2024-08-10 11:14:15','2024-08-10 11:14:15'),(198,5,'2512cfd6e647c06965079d','2024-08-10 12:22:03','2024-08-10 12:22:03'),(199,2,'955f899a1281cab2af7853','2024-08-10 12:47:10','2024-08-10 12:47:10'),(200,24,'e1088e9abb57d04c94d761','2024-08-10 13:13:29','2024-08-10 13:13:29');
/*!40000 ALTER TABLE `device_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_categories`
--

DROP TABLE IF EXISTS `event_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_categories`
--

LOCK TABLES `event_categories` WRITE;
/*!40000 ALTER TABLE `event_categories` DISABLE KEYS */;
INSERT INTO `event_categories` VALUES (1,'ثقافة','Culture','EventCategoryImages/dbTP6jYfVxqKAfrb0FpmqSJh5czzDKoUArbwkHVN.png','2024-06-05 15:23:56','2024-08-09 13:54:35'),(2,'سباق','Race','EventCategoryImages/myvfJjzMU2fVTVjFQeuB3OcMq0TT9rjIWe0UUuCK.png','2024-06-05 15:24:13','2024-08-09 13:54:55'),(3,'سفر','Travel','EventCategoryImages/We8vJjDjJdYa51P1NvLcOx6NraAhEA2IGJUB0h8P.png','2024-06-05 15:24:29','2024-08-09 13:55:39'),(4,'حفلة','Party','EventCategoryImages/SXxLr5Wcn9AFKNGDnM6dINGDtJNK1abBDNgKrZu0.png','2024-06-05 15:24:54','2024-08-09 13:55:51'),(5,'مغامرة','Adventure','EventCategoryImages/61PjJRwLSspDifwRcGnTIUhpfRKqTr4jFX9yAdBn.png','2024-06-05 15:25:08','2024-08-09 13:56:01'),(6,'مسرح','Theatre','EventCategoryImages/esrBa0R1zIg4vd4o9acmkPWTvzjdWGaB7wbP7vMf.png','2024-06-05 15:26:38','2024-08-09 13:56:09');
/*!40000 ALTER TABLE `event_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_category_event`
--

DROP TABLE IF EXISTS `event_category_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_category_event` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_category_id` bigint unsigned NOT NULL,
  `event_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_category_event_event_category_id_index` (`event_category_id`),
  KEY `event_category_event_event_id_index` (`event_id`),
  CONSTRAINT `event_category_event_event_category_id_foreign` FOREIGN KEY (`event_category_id`) REFERENCES `event_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_category_event_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_category_event`
--

LOCK TABLES `event_category_event` WRITE;
/*!40000 ALTER TABLE `event_category_event` DISABLE KEYS */;
INSERT INTO `event_category_event` VALUES (15,2,16,NULL,NULL),(16,2,17,NULL,NULL),(17,5,18,NULL,NULL),(18,1,19,NULL,NULL),(19,4,20,NULL,NULL),(20,4,21,NULL,NULL),(21,4,22,NULL,NULL),(22,2,23,NULL,NULL),(23,4,24,NULL,NULL),(24,4,25,NULL,NULL),(25,4,26,NULL,NULL),(26,4,27,NULL,NULL),(27,3,30,NULL,NULL),(28,3,31,NULL,NULL),(29,4,32,NULL,NULL),(30,3,33,NULL,NULL),(31,1,34,NULL,NULL),(32,4,35,NULL,NULL),(33,2,36,NULL,NULL),(34,3,37,NULL,NULL),(35,4,38,NULL,NULL),(36,2,41,NULL,NULL),(37,4,42,NULL,NULL),(38,2,43,NULL,NULL),(39,2,44,NULL,NULL),(40,2,45,NULL,NULL),(41,2,46,NULL,NULL),(42,4,47,NULL,NULL),(43,2,48,NULL,NULL),(44,2,49,NULL,NULL),(45,2,50,NULL,NULL),(46,4,51,NULL,NULL),(47,4,52,NULL,NULL),(48,4,53,NULL,NULL),(49,4,54,NULL,NULL),(50,4,55,NULL,NULL),(51,4,56,NULL,NULL),(52,2,57,NULL,NULL),(53,4,58,NULL,NULL),(54,1,59,NULL,NULL),(55,2,60,NULL,NULL),(56,2,61,NULL,NULL),(57,4,62,NULL,NULL),(58,4,63,NULL,NULL),(59,2,64,NULL,NULL),(60,2,65,NULL,NULL),(61,5,66,NULL,NULL),(62,2,67,NULL,NULL),(63,2,68,NULL,NULL),(64,1,69,NULL,NULL),(65,4,70,NULL,NULL),(66,2,71,NULL,NULL),(67,2,72,NULL,NULL),(68,5,73,NULL,NULL),(69,2,74,NULL,NULL);
/*!40000 ALTER TABLE `event_category_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_category_mobile_user`
--

DROP TABLE IF EXISTS `event_category_mobile_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_category_mobile_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `events_category_id` bigint unsigned NOT NULL,
  `mobile_user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_category_mobile_user_events_category_id_foreign` (`events_category_id`),
  KEY `event_category_mobile_user_mobile_user_id_foreign` (`mobile_user_id`),
  CONSTRAINT `event_category_mobile_user_events_category_id_foreign` FOREIGN KEY (`events_category_id`) REFERENCES `event_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_category_mobile_user_mobile_user_id_foreign` FOREIGN KEY (`mobile_user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_category_mobile_user`
--

LOCK TABLES `event_category_mobile_user` WRITE;
/*!40000 ALTER TABLE `event_category_mobile_user` DISABLE KEYS */;
INSERT INTO `event_category_mobile_user` VALUES (1,5,6,NULL,NULL),(2,1,7,NULL,NULL),(3,3,7,NULL,NULL),(4,4,7,NULL,NULL),(5,5,7,NULL,NULL),(6,6,7,NULL,NULL),(7,1,10,NULL,NULL),(8,2,10,NULL,NULL),(9,4,10,NULL,NULL),(10,2,11,NULL,NULL),(11,3,11,NULL,NULL),(12,5,11,NULL,NULL),(13,6,11,NULL,NULL),(14,2,12,NULL,NULL),(15,5,12,NULL,NULL),(16,1,13,NULL,NULL),(17,4,13,NULL,NULL),(18,4,14,NULL,NULL),(19,5,14,NULL,NULL),(20,5,15,NULL,NULL),(21,6,15,NULL,NULL),(22,5,16,NULL,NULL),(23,1,17,NULL,NULL),(24,2,17,NULL,NULL),(25,3,17,NULL,NULL),(26,4,17,NULL,NULL),(27,5,17,NULL,NULL),(28,6,17,NULL,NULL),(29,1,18,NULL,NULL),(30,2,18,NULL,NULL),(31,3,18,NULL,NULL),(32,4,18,NULL,NULL),(33,5,18,NULL,NULL),(34,6,18,NULL,NULL),(35,1,19,NULL,NULL),(36,2,19,NULL,NULL),(37,3,19,NULL,NULL),(38,4,19,NULL,NULL),(39,5,19,NULL,NULL),(40,6,19,NULL,NULL),(41,1,20,NULL,NULL),(42,2,20,NULL,NULL),(43,6,20,NULL,NULL),(44,4,21,NULL,NULL),(45,1,21,NULL,NULL),(46,2,21,NULL,NULL),(47,3,21,NULL,NULL),(48,5,21,NULL,NULL),(49,6,21,NULL,NULL),(50,4,22,NULL,NULL),(51,5,22,NULL,NULL),(52,5,23,NULL,NULL),(53,6,23,NULL,NULL),(54,5,24,NULL,NULL),(55,2,25,NULL,NULL),(56,4,25,NULL,NULL),(57,5,25,NULL,NULL),(58,3,26,NULL,NULL),(59,4,26,NULL,NULL),(60,1,27,NULL,NULL),(61,2,27,NULL,NULL),(62,3,27,NULL,NULL),(63,4,27,NULL,NULL),(64,5,27,NULL,NULL),(65,6,27,NULL,NULL),(66,1,30,NULL,NULL),(67,2,30,NULL,NULL),(68,3,30,NULL,NULL),(69,4,30,NULL,NULL),(70,5,30,NULL,NULL),(71,6,30,NULL,NULL),(72,1,31,NULL,NULL),(73,2,31,NULL,NULL),(74,3,31,NULL,NULL),(75,4,31,NULL,NULL),(76,5,31,NULL,NULL),(77,6,31,NULL,NULL),(78,6,39,NULL,NULL),(79,2,40,NULL,NULL),(80,4,40,NULL,NULL),(81,5,40,NULL,NULL),(82,6,33,NULL,NULL),(83,6,41,NULL,NULL),(84,2,42,NULL,NULL),(85,4,42,NULL,NULL);
/*!40000 ALTER TABLE `event_category_mobile_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_classes`
--

DROP TABLE IF EXISTS `event_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_price` double DEFAULT NULL,
  `ticket_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_classes_event_id_foreign` (`event_id`),
  KEY `event_classes_code_index` (`code`),
  CONSTRAINT `event_classes_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_classes`
--

LOCK TABLES `event_classes` WRITE;
/*!40000 ALTER TABLE `event_classes` DISABLE KEYS */;
INSERT INTO `event_classes` VALUES (28,16,'A','Class A represents the pinnacle of excellence, featuring elite participants who exemplify the highest standards of performance and professionalism','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',12,1,'2024-07-31 09:11:11','2024-07-31 09:11:11'),(55,21,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,1000,'2024-08-04 11:44:44','2024-08-04 11:44:44'),(56,21,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',550000,500,'2024-08-04 11:44:44','2024-08-04 11:44:44'),(57,22,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,1000,'2024-08-04 11:58:59','2024-08-04 11:58:59'),(58,22,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',550000,1000,'2024-08-04 11:58:59','2024-08-04 11:58:59'),(59,23,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience.','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',152,5,'2024-08-04 12:15:12','2024-08-05 08:54:05'),(60,23,'B','Class B Tickets provide enhanced access, balancing cost and experience','تقدم تذاكر الفئة B وصولاً معززًا، موازنة بين التكلفة والتجربة',25,32,'2024-08-04 12:15:12','2024-08-04 12:15:12'),(61,23,'C','Class C Tickets offer general admission, making the event accessible to all.','\"توفر تذاكر الفئة C دخولًا عامًا، مما يجعل الحدث متاحًا للجميع',21,25,'2024-08-04 12:15:12','2024-08-04 12:15:12'),(62,24,'Wave1','Class A Tickets offer exclusive access to the event, ensuring a premium experience.','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة.',450000,50,'2024-08-04 12:17:35','2024-08-04 12:17:35'),(63,24,'Wave2','Class B Tickets provide enhanced access, balancing cost and experience.','تقدم تذاكر الفئة B وصولاً معززًا، موازنة بين التكلفة والتجربة',550000,75,'2024-08-04 12:17:35','2024-08-04 12:17:35'),(66,25,'Wave 1','Entry before 12am','الدخول قبل الساعة 12 صباحاً',450000,1000,'2024-08-04 12:38:22','2024-08-04 12:38:22'),(67,25,'Wave 2','Entry after 12am','الدخول بعد الساعة 12 صباحاً',550000,1000,'2024-08-04 12:38:22','2024-08-04 12:38:22'),(68,26,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,1000,'2024-08-04 12:49:09','2024-08-04 12:49:09'),(69,26,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',550000,500,'2024-08-04 12:49:09','2024-08-04 12:49:09'),(70,27,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,900,'2024-08-04 12:57:44','2024-08-04 12:57:44'),(71,27,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',550000,500,'2024-08-04 12:57:44','2024-08-04 12:57:44'),(72,30,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience','الفئة أ تمثل قمة التميز، تضم المشاركين النخبة الذين يجسدون أعلى معايير الأداء والاحترافية.',3321,1,'2024-08-04 13:05:07','2024-08-04 13:05:07'),(73,30,'Wave 2','Class B Tickets provide enhanced access, balancing cost and experience','بليبليبليبليليبليبلب',313,1,'2024-08-04 13:05:07','2024-08-04 13:05:07'),(74,30,'Wave 2','Class C Tickets offer general admission, making the event accessible to all.','اليقفالبلاىرىبىبلىب',1212,1,'2024-08-04 13:05:07','2024-08-04 13:05:07'),(75,31,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience','الفئة أ تمثل قمة التميز، تضم المشاركين النخبة الذين يجسدون أعلى معايير الأداء والاحترافية.',3321,1,'2024-08-04 13:05:23','2024-08-04 13:05:23'),(76,31,'Wave 2','Class B Tickets provide enhanced access, balancing cost and experience','بليبليبليبليليبليبلب',313,1,'2024-08-04 13:05:23','2024-08-04 13:05:23'),(77,31,'Wave 2','Class C Tickets offer general admission, making the event accessible to all.','اليقفالبلاىرىبىبلىب',1212,1,'2024-08-04 13:05:23','2024-08-04 13:05:23'),(80,33,'Wave 1','gfsdfsdfdfsdfsd','لايبليبليبليب',111,1,'2024-08-04 13:09:47','2024-08-04 13:09:47'),(81,33,'Wave 2','1dfcdscds','من الساعة 12 صباحًا حتى 6 صباحًا',122,1,'2024-08-04 13:09:47','2024-08-04 13:09:47'),(82,33,'Wave 3','Class C Tickets offer general admission, making the event accessible to all.','من الساعة 6 صباحًا حتى مساءا',122,1,'2024-08-04 13:09:47','2024-08-04 13:09:47'),(83,34,'gdfgdfgdfgdfgdfgdfgdfgdf','dfgdfgdfgdfgdfgdfgdfgdfgdf','dfgdfgdfgdfgdfgdfgd',555,5,'2024-08-04 13:19:13','2024-08-04 13:19:13'),(84,34,'dfgdfgdfgdfgdfgdfgdfgdfdfg','dfgdfgdfgdfgdfgd','dfgdfgdfgdfgdf',5,2,'2024-08-04 13:19:13','2024-08-04 13:19:13'),(85,34,'dfgdfgdfgdfgdfgdfgdfgdfgdf','55','dfgdfgdf',55,6,'2024-08-04 13:19:13','2024-08-04 13:19:13'),(86,34,'dfgdfgdfgdfgdfgdfgdf','dfgdfgdfgdfgdf','dfgdfgdfgdf',66,66,'2024-08-04 13:19:13','2024-08-04 13:19:13'),(90,32,'Regular walk-in','Front stage access','xxx',450000,1000,'2024-08-04 13:22:19','2024-08-04 13:22:19'),(93,36,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,1000,'2024-08-04 13:34:34','2024-08-04 13:34:34'),(94,36,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',550000,500,'2024-08-04 13:34:34','2024-08-04 13:34:34'),(95,35,'Regular walk-in','Regular walk-in','Regular walk-in',450000,1000,'2024-08-04 13:35:25','2024-08-04 13:35:25'),(96,37,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,1000,'2024-08-04 13:41:21','2024-08-04 13:41:21'),(97,37,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',500000,500,'2024-08-04 13:41:21','2024-08-04 13:41:21'),(98,38,'Wave 1','Regular walk-in','Regular walk-in',450000,1000,'2024-08-04 13:45:51','2024-08-04 13:45:51'),(99,41,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,500,'2024-08-04 13:50:06','2024-08-04 13:50:06'),(100,41,'Wave 2','ftgfgfgfgdfgdfgdfgdfgdfgf','من الساعة 12 صباحًا حتى 6 صباحًا',500000,500,'2024-08-04 13:50:06','2024-08-04 13:50:06'),(101,44,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',1000,1000,'2024-08-04 14:01:04','2024-08-04 14:01:04'),(102,44,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',500,500,'2024-08-04 14:01:04','2024-08-04 14:01:04'),(103,44,'wave 3','From 6am to 9am','من الساعة 6 صباحًا حتى مساءا',2000,200,'2024-08-04 14:01:04','2024-08-04 14:01:04'),(104,45,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',1000,1000,'2024-08-04 14:01:46','2024-08-04 14:01:46'),(105,45,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',500,500,'2024-08-04 14:01:46','2024-08-04 14:01:46'),(106,45,'wave 3','From 6am to 9am','من الساعة 6 صباحًا حتى مساءا',2000,200,'2024-08-04 14:01:46','2024-08-04 14:01:46'),(107,46,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',1000,994,'2024-08-04 14:01:56','2024-08-04 14:15:52'),(108,46,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',500,500,'2024-08-04 14:01:56','2024-08-04 14:01:56'),(109,46,'wave 3','From 6am to 9am','من الساعة 6 صباحًا حتى مساءا',2000,200,'2024-08-04 14:01:56','2024-08-04 14:01:56'),(110,47,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,487,'2024-08-04 14:08:42','2024-08-04 14:20:56'),(111,47,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',55000,500,'2024-08-04 14:08:42','2024-08-04 14:08:42'),(112,49,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,995,'2024-08-04 14:21:28','2024-08-04 14:54:31'),(113,49,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',500000,500,'2024-08-04 14:21:28','2024-08-04 14:21:28'),(114,51,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,1000,'2024-08-04 15:00:02','2024-08-04 15:00:02'),(115,51,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',500000,500,'2024-08-04 15:00:02','2024-08-04 15:00:02'),(116,51,'wave 3','From 6am to 9am','من الساعة 6 صباحًا حتى مساءا',1000000,500,'2024-08-04 15:00:02','2024-08-04 15:00:02'),(117,52,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,998,'2024-08-04 15:00:41','2024-08-04 15:01:51'),(118,52,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',500000,500,'2024-08-04 15:00:41','2024-08-04 15:00:41'),(119,52,'wave 3','From 6am to 9am','من الساعة 6 صباحًا حتى مساءا',1000000,500,'2024-08-04 15:00:41','2024-08-04 15:00:41'),(120,53,'Wave 1','From 9pm to 12am','من الساعة 9 مساءً إلى الساعة 12 صباحًا',450000,995,'2024-08-04 15:09:07','2024-08-05 07:42:12'),(121,53,'Wave 2','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',550000,500,'2024-08-04 15:09:07','2024-08-04 15:09:07'),(122,53,'Wave 3','From 6am to 9am','من الساعة 6 صباحًا حتى 9صباحًا',1000000,500,'2024-08-04 15:09:07','2024-08-04 15:09:07'),(123,54,'Regular','Regular walk-in','Regular walk-in',0,1500,'2024-08-05 07:52:35','2024-08-05 07:52:35'),(124,54,'VIP','Backstage access','Backstage access',1050000,500,'2024-08-05 07:52:35','2024-08-05 07:52:35'),(125,55,'Regular','Front stage access','Front stage access',450000,1492,'2024-08-05 07:58:48','2024-08-05 08:36:49'),(126,55,'VIP','Backstage entrance','Backstage entrance',1500000,500,'2024-08-05 07:58:48','2024-08-05 07:58:48'),(127,56,'Regular','Front stage access','Front stage access',450000,1500,'2024-08-05 08:38:38','2024-08-05 08:38:38'),(128,56,'VIP','Backstage entrance','Backstage entrance',1500000,500,'2024-08-05 08:38:38','2024-08-05 08:38:38'),(134,60,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience.','من الساعة 9 مساءً إلى الساعة 12 صباحًا',1000,1000,'2024-08-05 13:40:56','2024-08-05 13:40:56'),(135,60,'B','Class B includes accomplished competitors, showcasing strong skills and significant achievements, setting them apart as highly proficient.','تقدم تذاكر الفئة B وصولاً معززًا، موازنة بين التكلفة والتجربة',2000,500,'2024-08-05 13:40:56','2024-08-05 13:40:56'),(146,59,'Regular','Regular walk-in','Regular walk-in',100000,700,'2024-08-08 07:54:22','2024-08-08 07:54:22'),(147,59,'VIP','Text','Text',200000,10000,'2024-08-08 07:54:22','2024-08-08 07:54:22'),(148,58,'Regular','Front Stage Access','Front stage access',450000,1470,'2024-08-08 07:55:13','2024-08-09 18:46:01'),(149,58,'VIP','Backstage Entrance','Backstage Entrance',1500000,496,'2024-08-08 07:55:13','2024-08-09 18:47:47'),(150,57,'Wave 1','Front stage access','من الساعة 9 مساءً إلى الساعة 12 صباحًا',1000,971,'2024-08-08 07:55:50','2024-08-08 07:55:50'),(167,61,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',1000,999,'2024-08-08 11:32:42','2024-08-09 11:21:52'),(168,61,'B','From 12am to 6am','من الساعة 12 صباحًا حتى 6 صباحًا',1000,1000,'2024-08-08 11:32:42','2024-08-08 11:32:42'),(169,62,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience','من الساعة 9 مساءً إلى الساعة 12 صباحًا',1000,2000,'2024-08-08 11:55:28','2024-08-08 11:55:28'),(178,63,'A','Class A represents the pinnacle of excellence, featuring elite participants who exemplify the highest standards of performance and professionalism','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',1000,193,'2024-08-08 14:54:16','2024-08-08 18:46:13'),(179,64,'A','Class A represents the pinnacle of excellence, featuring elite participants who exemplify the highest standards of performance and professionalism','من الساعة 9 مساءً إلى الساعة 12 صباحًا',1000,1000,'2024-08-09 12:34:20','2024-08-09 12:34:20'),(180,65,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience.','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',1000,1000,'2024-08-09 12:42:47','2024-08-09 12:42:47'),(181,17,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience.','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',125000,750,'2024-08-09 12:52:33','2024-08-09 12:52:33'),(182,17,'B','Class B Tickets provide enhanced access, balancing cost and experience','تقدم تذاكر الفئة B وصولاً معززًا، موازنة بين التكلفة والتجربة',100000,2125,'2024-08-09 12:52:33','2024-08-09 12:52:33'),(183,17,'C','Class C Tickets offer general admission, making the event accessible to all.','\"توفر تذاكر الفئة C دخولًا عامًا، مما يجعل الحدث متاحًا للجميع',75000,2125,'2024-08-09 12:52:33','2024-08-09 12:52:33'),(190,66,'A','Class A represents the pinnacle of excellence, featuring elite participants who exemplify the highest standards of performance and professionalism','الفئة أ تمثل قمة التميز، تضم المشاركين النخبة الذين يجسدون أعلى معايير الأداء والاحترافية.',121,1000,'2024-08-09 13:10:01','2024-08-09 13:10:01'),(194,19,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience.','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',100000,499,'2024-08-09 13:57:52','2024-08-09 18:50:51'),(195,19,'B','Class B Tickets provide enhanced access, balancing cost and experience','تقدم تذاكر الفئة B وصولاً معززًا، موازنة بين التكلفة والتجربة',50000,500,'2024-08-09 13:57:52','2024-08-09 13:57:52'),(199,67,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',325000,996,'2024-08-09 14:24:47','2024-08-10 08:17:52'),(200,67,'B','Class B Tickets provide enhanced access, balancing cost and experience','تقدم تذاكر الفئة B وصولاً معززًا، موازنة بين التكلفة والتجربة',325000,1000,'2024-08-09 14:24:47','2024-08-09 14:24:47'),(201,67,'C','Class C Tickets offer general admission, making the event accessible to all.','\"توفر تذاكر الفئة C دخولًا عامًا، مما يجعل الحدث متاحًا للجميع',300000,2999,'2024-08-09 14:24:47','2024-08-10 08:06:41'),(202,68,'Wave 1','Class A represents the pinnacle of excellence, featuring elite participants who exemplify the highest standards of performance and professionalism','من الساعة 9 مساءً إلى الساعة 12 صباحًا',21,500,'2024-08-09 14:44:04','2024-08-09 14:44:04'),(203,68,'Wave 2','Class B Tickets provide enhanced access, balancing cost and experience','من الساعة 12 صباحًا حتى 6 صباحًا',32,500,'2024-08-09 14:44:04','2024-08-09 14:44:04'),(204,69,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',300000,0,'2024-08-09 14:49:22','2024-08-09 14:54:07'),(219,20,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience.','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',220000,67,'2024-08-10 08:40:56','2024-08-10 08:40:56'),(220,20,'B','Class B Tickets provide enhanced access, balancing cost and experience','تقدم تذاكر الفئة B وصولاً معززًا، موازنة بين التكلفة والتجربة',210000,75,'2024-08-10 08:40:56','2024-08-10 08:40:56'),(221,20,'C','Class C Tickets offer general admission, making the event accessible to all.','\"توفر تذاكر الفئة C دخولًا عامًا، مما يجعل الحدث متاحًا للجميع',200000,75,'2024-08-10 08:40:56','2024-08-10 08:40:56'),(224,70,'Regular','Regular walk-in tickets','Regular walk-in tickets',500,1496,'2024-08-10 09:04:02','2024-08-10 11:19:43'),(225,70,'VIP','backstage entrance','backstage entrance',1500000,499,'2024-08-10 09:04:02','2024-08-10 09:04:02'),(229,18,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience.','توفر تذاكر الفئة A وصولاً حصريًا للحدث، مما يضمن تجربة مميزة',150000,749,'2024-08-10 09:19:03','2024-08-10 09:19:03'),(230,18,'B','Class B Tickets provide enhanced access, balancing cost and experience','تقدم تذاكر الفئة B وصولاً معززًا، موازنة بين التكلفة والتجربة',100000,750,'2024-08-10 09:19:03','2024-08-10 09:19:03'),(231,18,'C','Class C Tickets offer general admission, making the event accessible to all.','\"توفر تذاكر الفئة C دخولًا عامًا، مما يجعل الحدث متاحًا للجميع',75000,1500,'2024-08-10 09:19:03','2024-08-10 09:19:03'),(233,71,'Wave 1','Class A represents the pinnacle of excellence, featuring elite participants who exemplify the highest standards of performance and professionalism','الفئة أ تمثل قمة التميز، تضم المشاركين النخبة الذين يجسدون أعلى معايير الأداء والاحترافية.',132,500,'2024-08-10 11:34:09','2024-08-10 11:34:09'),(234,71,'B','Class B Tickets provide enhanced access, balancing cost and experience','بليبليبليبليليبليبلب',25,500,'2024-08-10 11:34:09','2024-08-10 11:34:09'),(235,72,'A','Class A Tickets offer exclusive access to the event, ensuring a premium experience','لايبليبليبليب',300000,5555,'2024-08-10 12:51:33','2024-08-10 12:51:33'),(237,73,'A','xzsxz','xzsxz',21,100,'2024-08-10 13:05:01','2024-08-10 13:05:01'),(238,74,'Wave 1','scsdc','dcs',321,1000,'2024-08-10 13:48:59','2024-08-10 13:48:59');
/*!40000 ALTER TABLE `event_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_comments`
--

DROP TABLE IF EXISTS `event_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `event_id` bigint unsigned NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_comments_event_id_index` (`event_id`),
  KEY `event_comments_user_id_index` (`user_id`),
  CONSTRAINT `event_comments_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_comments`
--

LOCK TABLES `event_comments` WRITE;
/*!40000 ALTER TABLE `event_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_follows`
--

DROP TABLE IF EXISTS `event_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_follows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `mobile_user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_follows_event_id_foreign` (`event_id`),
  KEY `event_follows_mobile_user_id_foreign` (`mobile_user_id`),
  CONSTRAINT `event_follows_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_follows_mobile_user_id_foreign` FOREIGN KEY (`mobile_user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_follows`
--

LOCK TABLES `event_follows` WRITE;
/*!40000 ALTER TABLE `event_follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_likes`
--

DROP TABLE IF EXISTS `event_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_likes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_likes_user_id_index` (`user_id`),
  KEY `event_likes_event_id_index` (`event_id`),
  CONSTRAINT `event_likes_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_likes`
--

LOCK TABLES `event_likes` WRITE;
/*!40000 ALTER TABLE `event_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_promo_code`
--

DROP TABLE IF EXISTS `event_promo_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_promo_code` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `promo_code_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_promo_code_event_id_index` (`event_id`),
  KEY `event_promo_code_promo_code_id_index` (`promo_code_id`),
  CONSTRAINT `event_promo_code_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_promo_code_promo_code_id_foreign` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_promo_code`
--

LOCK TABLES `event_promo_code` WRITE;
/*!40000 ALTER TABLE `event_promo_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_promo_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_request_categories`
--

DROP TABLE IF EXISTS `event_request_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_request_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_request_categories`
--

LOCK TABLES `event_request_categories` WRITE;
/*!40000 ALTER TABLE `event_request_categories` DISABLE KEYS */;
INSERT INTO `event_request_categories` VALUES (1,'العاب','Games','EventRequestCategoryImages/5ZGj1WWbZhGa2KiRZ877PbulFtX4dRdAdTm7Xh5Q.png','2024-06-05 15:33:42','2024-08-09 13:59:48'),(2,'حفل','Party','EventRequestCategoryImages/yC7tL2QvOgnmbp9Pt11LDpUXh76CFmI5hWAOdMlx.png','2024-06-05 15:34:02','2024-08-09 13:59:56'),(3,'ثقافة','Culture','EventRequestCategoryImages/4cReoFmbuydkThcsxt6EVd9ABjnk3KvLzYelL9Ag.png','2024-06-05 15:34:31','2024-08-09 14:00:02'),(4,'اطفال','Kids','EventRequestCategoryImages/WMASUI8iHym3p3BRpxiSOQe2H9VeuvgqFG7fCY3h.png','2024-06-05 15:34:51','2024-08-09 14:00:07'),(5,'جولة','Tour','EventRequestCategoryImages/wnOKIWcS9tEavC4ab6vx0mZr67CGP9bJYMmEcKtN.png','2024-06-05 15:35:22','2024-08-09 14:00:12'),(6,'مسرح','Theater','EventRequestCategoryImages/d9ciU1xu8PUNybDJOy0Fir3KTL6go8ToNvEvqgvt.png','2024-06-05 15:35:46','2024-08-09 14:00:17'),(7,'سفر','Travel','EventRequestCategoryImages/m5ASDJmivlZiHvRoKmQhp04T23Thv0tJhvyMYkZ1.png','2024-06-05 15:36:05','2024-08-09 14:00:23'),(8,'سباق','Race','EventRequestCategoryImages/JJyLH54llzrp5fKhaJsq970giDcoe2O1rAoBqGzW.png','2024-06-05 15:36:23','2024-08-09 14:00:30'),(9,'مغامرة','Adventure','EventRequestCategoryImages/LiT9dbgL7EdAAIzhn1PEvzoxjsypMH3zQLNBmPob.png','2024-06-05 15:36:44','2024-08-09 14:00:38'),(10,'فن','Art','EventRequestCategoryImages/9UafLyt8FLm46JJ9hHy2BPTef4377HqWkWEmS20c.png','2024-06-05 15:37:07','2024-08-09 14:00:45');
/*!40000 ALTER TABLE `event_request_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_requests`
--

DROP TABLE IF EXISTS `event_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `adults` int NOT NULL,
  `child` int NOT NULL,
  `images` json NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `venue_id` bigint unsigned DEFAULT NULL,
  `service_provider_id` json NOT NULL,
  `additional_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('Approved','In Progress','Pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `event_category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_requests_venue_id_index` (`venue_id`),
  KEY `event_requests_user_id_index` (`user_id`),
  KEY `event_requests_event_category_id_foreign` (`event_category_id`),
  CONSTRAINT `event_requests_event_category_id_foreign` FOREIGN KEY (`event_category_id`) REFERENCES `event_request_categories` (`id`),
  CONSTRAINT `event_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_requests_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_requests`
--

LOCK TABLES `event_requests` WRITE;
/*!40000 ALTER TABLE `event_requests` DISABLE KEYS */;
INSERT INTO `event_requests` VALUES (1,2,'hdhdjdh','maysam','sweid','0958957464','2024-07-23','05:22:00','17:22:00',4,0,'\"[\\\"RequestedEventFolder\\\\/hSqDiz9tS3GjRxo0UGT1oqMQGRUKW0Hc1yJf0OIm.jpg\\\"]\"','hfgh',1,'\"[\\\"1\\\"]\"',NULL,'Approved',1,'2024-07-01 13:22:39','2024-07-24 10:11:09'),(2,5,'sssss عنه','Haidar','Tarboush','0937755273','2024-08-21','00:00:00','20:04:00',4,1,'\"[\\\"RequestedEventFolder\\\\/GpHV6ctf5Kg3XbTHVsRVMzPOEDu4s4pMQWbSUrkd.jpg\\\"]\"',NULL,1,'\"[\\\"1\\\"]\"',NULL,'Pending',2,'2024-08-10 03:02:10','2024-08-10 03:02:10'),(3,24,'evento','diana','diana','0999999999','2024-08-12','00:00:00','16:16:00',1,1,'\"[\\\"RequestedEventFolder\\\\/aePF62doW5rJmMzyDgwik2f1IaEzN9RcFxt6L1uP.jpg\\\"]\"',NULL,1,'\"[\\\"1\\\"]\"',NULL,'Pending',10,'2024-08-10 12:17:07','2024-08-10 12:17:07');
/*!40000 ALTER TABLE `event_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_service_provider`
--

DROP TABLE IF EXISTS `event_service_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_service_provider` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `service_provider_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_service_provider_event_id_index` (`event_id`),
  KEY `event_service_provider_service_provider_id_index` (`service_provider_id`),
  CONSTRAINT `event_service_provider_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_service_provider_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_service_provider`
--

LOCK TABLES `event_service_provider` WRITE;
/*!40000 ALTER TABLE `event_service_provider` DISABLE KEYS */;
INSERT INTO `event_service_provider` VALUES (17,16,1,NULL,NULL),(18,17,1,NULL,NULL),(19,18,1,NULL,NULL),(20,19,1,NULL,NULL),(21,20,1,NULL,NULL),(22,21,8,NULL,NULL),(23,22,8,NULL,NULL),(24,23,1,NULL,NULL),(25,24,1,NULL,NULL),(26,25,8,NULL,NULL),(27,26,8,NULL,NULL),(28,27,8,NULL,NULL),(29,30,2,NULL,NULL),(30,31,2,NULL,NULL),(31,32,8,NULL,NULL),(32,33,3,NULL,NULL),(33,34,1,NULL,NULL),(34,35,8,NULL,NULL),(35,36,2,NULL,NULL),(36,37,2,NULL,NULL),(37,38,8,NULL,NULL),(38,41,2,NULL,NULL),(39,42,8,NULL,NULL),(40,43,3,NULL,NULL),(41,44,3,NULL,NULL),(42,45,3,NULL,NULL),(43,46,3,NULL,NULL),(44,47,8,NULL,NULL),(45,48,2,NULL,NULL),(46,49,2,NULL,NULL),(47,50,2,NULL,NULL),(48,51,3,NULL,NULL),(49,52,3,NULL,NULL),(50,53,8,NULL,NULL),(51,54,8,NULL,NULL),(52,55,8,NULL,NULL),(53,56,8,NULL,NULL),(54,58,8,NULL,NULL),(55,59,8,NULL,NULL),(56,60,2,NULL,NULL),(57,57,3,NULL,NULL),(60,61,2,NULL,NULL),(61,62,3,NULL,NULL),(62,63,3,NULL,NULL),(65,63,4,NULL,NULL),(66,63,2,NULL,NULL),(67,63,1,NULL,NULL),(68,63,5,NULL,NULL),(69,64,1,NULL,NULL),(70,65,3,NULL,NULL),(71,66,2,NULL,NULL),(72,67,1,NULL,NULL),(73,67,8,NULL,NULL),(74,68,3,NULL,NULL),(75,69,8,NULL,NULL),(76,18,3,NULL,NULL),(77,18,4,NULL,NULL),(78,70,4,NULL,NULL),(79,70,3,NULL,NULL),(80,71,1,NULL,NULL),(81,72,1,NULL,NULL),(82,73,3,NULL,NULL),(83,73,1,NULL,NULL),(84,74,3,NULL,NULL);
/*!40000 ALTER TABLE `event_service_provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_trips`
--

DROP TABLE IF EXISTS `event_trips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_trips` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_trips_event_id_index` (`event_id`),
  CONSTRAINT `event_trips_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_trips`
--

LOCK TABLES `event_trips` WRITE;
/*!40000 ALTER TABLE `event_trips` DISABLE KEYS */;
INSERT INTO `event_trips` VALUES (10,16,'2024-08-04 11:49:00','2024-08-07 11:49:00','fgvdf','dffvg','2024-07-31 09:11:11','2024-07-31 09:11:11'),(11,23,'2024-08-05 15:15:00','2024-08-06 15:15:00','test','test','2024-08-04 12:15:12','2024-08-04 12:15:12'),(12,31,'2024-08-07 16:02:00','2024-08-29 16:02:00','dswdss','fcsdfcd','2024-08-04 13:05:23','2024-08-04 13:05:23'),(13,33,'2024-08-06 16:10:00','2024-08-30 16:10:00','dwsadswd','dwsdd','2024-08-04 13:09:47','2024-08-04 13:09:47'),(15,73,'2024-08-13 16:05:00','2024-08-20 16:05:00','sas','dsads','2024-08-10 13:05:01','2024-08-10 13:05:01');
/*!40000 ALTER TABLE `event_trips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `organizer_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue_id` bigint unsigned DEFAULT NULL,
  `capacity` int NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `ticket_price` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('normal','featured') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `videos` json DEFAULT NULL,
  `images` json NOT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_taxes` int NOT NULL,
  `cancellation_time` int NOT NULL,
  `refund_policy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancellation_policy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `refund_policy_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancellation_policy_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecash_taxes` double DEFAULT '200',
  PRIMARY KEY (`id`),
  KEY `events_venue_id_index` (`venue_id`),
  KEY `events_organizer_id_index` (`organizer_id`),
  CONSTRAINT `events_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `organizers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `events_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (15,'2024-08-04 15:03:42',3,'vfsfcs','vsvsv',4,21,'2024-08-03 11:49:00','2024-09-06 11:49:00',123,'dffff','fsefdf','featured',NULL,'[\"EventImages/mLxyGUbo1oBcWMdWc6hjUymbfwkWjFSvji0rAYZ4.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/emsherifsyria/?hl=ar','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',123,1,'dfgvdfv','fgvdvdrfv','vbfbfb','bvdrfbdrfb','2024-07-31 09:08:40','2024-08-04 15:03:42',NULL,NULL),(16,'2024-08-04 15:03:38',3,'vfsfcs','vsvsv',4,21,'2024-08-03 11:49:00','2024-09-06 11:49:00',123,'dffff','fsefdf','featured',NULL,'[\"EventImages/MC0JcouabRFZLubHLEOZWsTlHf7O4uEfXdldXgzg.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/emsherifsyria/?hl=ar','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',123,1,'dfgvdfv','fgvdvdrfv','vbfbfb','bvdrfbdrfb','2024-07-31 09:11:11','2024-08-04 15:03:38',NULL,NULL),(17,'2024-08-09 12:53:11',4,'racing and drift championship','بطولة السباق والدريفت',9,50,'2024-08-09 08:00:00','2024-08-15 17:00:00',125000,'Join us for an exhilarating event showcasing the best in speed racing and drift. Witness top drivers compete in high-octane challenges, displaying incredible skill and precision. Don\'t miss out on the action!','انضموا إلينا في حدث مثير يعرض الأفضل في سباقات السرعة والانجراف. شاهدوا أفضل السائقين يتنافسون في تحديات مليئة بالإثارة، ويظهرون مهارات ودقة مذهلة. لا تفوتوا هذا الحدث!','featured','[\"EventVideo/FmdxyFlXQOhD0F1GnEJbXmhhEYTogKnuGl3X5LKR.mp4\"]','[[\"EventImages/Sc1hdbLG9ltRIWCW1o6Zr5jiQacZVzTWybtd9s6n.jpg\", \"EventImages/TCEE9CIo1Jt5rL5x8exFfxCX6epmQQgUIA82Exh3.jpg\"]]','https://www.syraut.com/?fbclid=IwZXh0bgNhZW0CMTAAAR1oT27e-QmQgySED7_7RLfG60JeI-6OAPQE8CA5n5KYMblqAbXmbwzpSsU_aem_bZHyKfW5VJIXUxCLb7xrCg','https://www.instagram.com/syrautclub/','https://www.facebook.com/syraut',25,48,'Refunds are available for tickets returned within 7 days of purchase. Please ensure tickets are in their original condition.','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','تتوفر استردادات للتذاكر التي تُعاد في غضون 7 أيام من الشراء. يرجى التأكد من أن التذاكر في حالتها الأصلية.','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة للاسترداد. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء.','2024-08-01 09:38:30','2024-08-09 12:53:11','amount',NULL),(18,NULL,4,'Camping','تخييم',5,3000,'2024-09-01 08:00:00','2024-09-03 22:00:00',250000,'Join us for an unforgettable camping adventure! Experience the great outdoors, enjoy fun activities, and create lasting memories with friends. Don\'t miss out on this exciting event filled with nature, relaxation, and adventure!','انضموا إلينا في مغامرة تخييم لا تُنسى! استمتعوا بالطبيعة والأنشطة الممتعة وصنع الذكريات الجميلة مع الأصدقاء. لا تفوتوا هذا الحدث المليء بالطبيعة والاسترخاء والمغامرة!','featured','[]','[\"events/TQHj6PFEsM0tZSvpxyThaCLTA3eEeh0Ve69a2hwv.jpg\", \"events/heKTERiZ9E3XMShu6hHuNLy0UiIw5NHjEAMl2dw6.jpg\", \"events/vpmoYX92B4AFujtU8nqE5IO9Jclkzdf5S2DnPqLg.jpg\", \"events/QlHriDDV9fFYoMhCGlHilXDeDt6LB1ayqitUMB7Q.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.facebook.com/Gemini.Group.sy/',35,7,'If you are not completely satisfied with your experience, you may request a refund within 14 days of your purchase. Refunds will be processed to the original payment method. Please note that certain conditions may apply.','Cancellations made at least 7 days before the event will receive a full refund. Cancellations made within 7 days of the event will incur a 50% fee. No refunds will be given for cancellations made within 24 hours of the event.','إذا لم تكن راضيًا تمامًا عن تجربتك، يمكنك طلب استرجاع الأموال خلال 14 يومًا من الشراء. سيتم إعادة المبلغ إلى وسيلة الدفع الأصلية. يرجى ملاحظة أن هناك شروط معينة قد تنطبق.','الإلغاءات التي تتم قبل 7 أيام على الأقل من الحدث ستحصل على استرداد كامل. الإلغاءات التي تتم خلال 7 أيام من الحدث ستتحمل رسومًا بنسبة 50%. لن يتم استرداد الأموال للإلغاءات التي تتم خلال 24 ساعة من الحدث.','2024-08-03 12:00:28','2024-08-10 09:19:03','amount',10),(19,NULL,4,'Carnaval Marmarita','كرنفال مرمريتا',7,2000,'2024-08-14 08:00:00','2024-08-14 22:00:00',100000,'Experience the lively atmosphere of the Marietta Carnival.This festive event includes a cheerful show and joy-filled celebrations, join us for a day full of cultural events .','عيشوا أجواء كرنفال مماريتا المفعمة بالحيوية، .يتضمن هذا الحدث الاحتفالي عرضاً مبهجاً واحتفالات مليئة بالفرح،  انضموا إلينا ليوم مليء بالفعاليات الثقافية .','featured','[]','[\"events/TStk3iZPU6iFF7lmagiO3aXkqDvY804KKhXxwAGc.jpg\", \"events/jbAB1p3KMs1XhSoxeLM8OVPW4VfngQ0ttHLz7o1C.jpg\", \"events/ePn4RZvOHrCn3PyNm90XmRoNS3hKe0N1GXp0nrHq.jpg\", \"events/kjSH6sLDTx3Gslg6o1Sglko2QBGGFlAe7K2CgANq.jpg\", \"events/ZMFB3wyqhUeA3vst7jr5XsgOKEV58QKUOoiF1txa.jpg\", \"events/ro4eMEzDVgKCCkhRHAtraqC2fILSf9AVC5QIiyyC.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.hdragency.com/',15,7,'If you are not completely satisfied with your experience, you may request a refund within 14 days of your purchase. Refunds will be processed to the original payment method. Please note that certain conditions may apply.','Cancellations made at least 7 days before the event will receive a full refund. Cancellations made within 7 days of the event will incur a 50% fee. No refunds will be given for cancellations made within 24 hours of the event.','إذا لم تكن راضيًا تمامًا عن تجربتك، يمكنك طلب استرجاع الأموال خلال 14 يومًا من الشراء. سيتم إعادة المبلغ إلى وسيلة الدفع الأصلية. يرجى ملاحظة أن هناك شروط معينة قد تنطبق.','الإلغاءات التي تتم قبل 7 أيام على الأقل من الحدث ستحصل على استرداد كامل. الإلغاءات التي تتم خلال 7 أيام من الحدث ستتحمل رسومًا بنسبة 50%. لن يتم استرداد الأموال للإلغاءات التي تتم خلال 24 ساعة من الحدث.','2024-08-03 12:33:50','2024-08-09 13:57:52','amount',NULL),(20,NULL,4,'Karaoke Competition','مسابقة الكاريوكي',2,600,'2024-09-06 20:00:00','2024-09-06 23:00:00',200000,'Join us for an exciting Karaoke Competition! Showcase your singing talents, compete for amazing prizes, and enjoy a fun-filled evening with music and entertainment. Whether you\'re a seasoned performer or a first-timer, this event is for everyone. Don\'t miss out on the fun!','انضموا إلينا في مسابقة الكاريوكي المثيرة! أظهروا مواهبكم الغنائية، وتنافسوا على جوائز رائعة، واستمتعوا بأمسية مليئة بالمرح والموسيقى والترفيه. سواء كنتم مؤدين متمرسين أو تخوضون التجربة لأول مرة، هذا الحدث للجميع. لا تفوتوا فرصة المرح!','featured','[]','[\"events/p5hKoEdkM2wK3jrMv5PK9YKAM0hCg2zudjwS0bMy.jpg\", \"events/VaYJUon9j0dKb72vN5aqFxWRtlKd6zQjW8xJtMdX.jpg\", \"events/Y93l0poUjHhIKVw5HNx92y0nSJtTXZtTUeZmz000.jpg\", \"events/CVcFWgNWAoNU0HBAzjI9OvCtoa6lldEYiszoFUS5.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/emsherifsyria/','https://www.facebook.com/EmSherifSyria/',25,3,'If you are not completely satisfied with your Karaoke Competition experience, you may request a refund within 7 days of the event date. Refunds will be processed to the original payment method. Certain conditions and fees may apply.','ancellations made at least 3 days before the event will receive a full refund. Cancellations made within 3 days of the event will incur a 50% fee. No refunds will be given for cancellations made within 24 hours of the event.','إذا لم تكن راضيًا تمامًا عن تجربتك في مسابقة الكاريوكي، يمكنك طلب استرجاع الأموال خلال 7 أيام من تاريخ الحدث. سيتم إعادة المبلغ إلى وسيلة الدفع الأصلية. قد تنطبق شروط ورسوم معينة.','الإلغاءات التي تتم قبل 3 أيام على الأقل من الحدث ستحصل على استرداد كامل. الإلغاءات التي تتم خلال 3 أيام من الحدث ستتحمل رسومًا بنسبة 50%. لن يتم استرداد الأموال للإلغاءات التي تتم خلال 24 ساعة من الحدث.','2024-08-03 12:53:25','2024-08-10 08:40:56','amount',NULL),(21,'2024-08-04 11:54:31',6,'Siin Anniversary','Siin Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',0,'techno party','حفل تكنو','normal',NULL,'[\"EventImages/yxCJEDXN4JQXgYODtLwOVVGT3Yl7Vw5IIBPVqn4E.jpg\", \"EventImages/hAsbensJqI2Bkfin2bfaaLvW6jlzYQfKVpViIqOq.jpg\", \"EventImages/nFzsgFB9ukuQbR3wxLEYRBIDpngSQXkhWhtnYBwV.jpg\", \"EventImages/UIHmKudwKiBhYxOBxXcCgjPSwb1Y4B3y1sHpm5TY.jpg\", \"EventImages/yppfzvU4TkcX7R1TBwGGn603gsRyfry8Nvgxo0SJ.jpg\", \"EventImages/hM5ymvssHLXuTZq8r3MWRA5X846Ul7Js08OiIgQk.jpg\"]',NULL,'https://www.instagram.com/siin_experience/',NULL,0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 11:44:44','2024-08-04 11:54:31',NULL,NULL),(22,'2024-08-04 12:21:11',6,'Siin Anniversary','Siin Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',0,'techno party','حفل تكنو','featured',NULL,'[\"EventImages/gAPpuuhgw8aTROuqDmxuumIqPodzwhcng4L0VCVi.jpg\", \"EventImages/ST24nkV0ZfoC3ca2ZUtViXTsSY5kykzxHAAuV4kj.jpg\", \"EventImages/uXWo3KrEI3UAKI7XiNq4LSZfY38c5gQEKkimUA5H.jpg\", \"EventImages/HlE8wMX9zMCloJmbGb7mWIcGDZRDqTPTedS4Q5xs.jpg\", \"EventImages/6WLHTHF9Soy6jmeRrC0wahkAyVdTCX9EDSdk9z41.jpg\"]',NULL,'https://www.instagram.com/siin_experience/',NULL,0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 11:58:59','2024-08-04 12:21:11',NULL,NULL),(23,'2024-08-09 14:07:01',2,'test','test',2,101000,'2024-08-05 15:15:00','2024-08-06 15:15:00',250,'test','test','featured',NULL,'[\"EventImages/ZtjQyK4bkhjZPHyOz3p3NsKnBmuc5zflUz7AvAgx.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.hdragency.com/',13,2,'test','test','test','test','2024-08-04 12:15:12','2024-08-09 14:07:01',NULL,NULL),(24,'2024-08-04 12:21:28',2,'Siin Experience Anniversary','Siin Experience Anniversary',13,2000,'2024-08-10 23:00:00','2024-08-11 07:00:00',400000,'Join us for an unforgettable night of music and entertainment at the iconic Krak des Chevaliers. The event will feature live performances, DJs, and a vibrant atmosphere.','Description (AR): انضم إلينا لقضاء ليلة لا تُنسى من الموسيقى والترفيه في قلعة الحصن الشهيرة. سيشمل الحدث عروضاً حية من الفرق الموسيقية ودي جي وأجواء مفعمة بالحيوية.','featured',NULL,'[\"EventImages/XlWTISDZXcDPwiHB8TZy0tDrNSmKEHjQBbfrTfZ4.jpg\"]','https://evento.com','https://www.instagram.com','https://www.Evento.com',20000,3,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','لا يوجد','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء.','2024-08-04 12:17:35','2024-08-04 12:21:28',NULL,NULL),(25,'2024-08-04 12:41:05',6,'Siin Anniversary','Siin Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',0,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/UNMIKAPMJE0vrdbacEHNjqWIzONgW6JMtvXKJCEx.jpg\", \"EventImages/ZLv96kM5ZPN0hYkgqk2gX0q41d4r3MLMpSxlFcBD.jpg\", \"EventImages/eNHqUsteREKYq4TsSvDqZCzlyaGjsHwK7XOoB8ak.jpg\", \"EventImages/EQqkLfuz36idE9lDaSvHfDDFMWc0aJCQ17j3xvAS.jpg\", \"EventImages/mEb1vJnCWRYXQ7J4kJURSDPuMyo5xukGU0UJOW6Z.jpg\"]',NULL,'https://www.instagram.com/siin_experience/',NULL,0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 12:27:16','2024-08-04 12:41:05',NULL,NULL),(26,'2024-08-04 12:51:41',6,'Siin Anniversary','Siin Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',1000000,'Techno Party','حفل تكنو','normal',NULL,'[\"EventImages/SfX4NBLNkFBPYMMbj5wGxcQfvoDAMzPYkrhE4rz4.jpg\", \"EventImages/fapEnJJlTHFbipaVcrg7dwdTwDRPwM8OWd6fHMfm.jpg\", \"EventImages/25TAk1zAcs0cN5yrN4CaL1aeZPnzjRSzklqJixmx.jpg\", \"EventImages/T0J2aXkBeVuk9ldJmG2AOXqAwDjvSAV419Q62Ve4.jpg\", \"EventImages/oPsz2riJOXhNSZAnVwHFTGvjEo99wV97MuNlS9l4.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.hdragency.com/',15,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 12:49:09','2024-08-04 12:51:41',NULL,NULL),(27,'2024-08-04 13:08:01',6,'Siin Anniversary','Siin Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',750000,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/p3o4I2MWCn9d4vxbKntMELjFZnS6MGF0D5HfEvE4.jpg\", \"EventImages/aSsfx8pFtgZ851p5wd5MLrrhevG5cyIR5g4ETdPQ.jpg\", \"EventImages/ZXAH8SpAYvjEZknVVQUyQT7T0sGVAownImP7BgXz.jpg\", \"EventImages/ZnFk7iDdyS2DnDW3YqxnaGBdG5N2Ml1yftzorvjO.jpg\", \"EventImages/Uc7JxgJCqgv2KlZHq2mrGyAWJwNRJdVbIX0TXueK.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.hdragency.com/',15,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 12:57:44','2024-08-04 13:08:01',NULL,NULL),(28,'2024-08-04 15:03:31',3,'cczxcz','czxdczxdc',3,21,'2024-08-06 16:02:00','2024-08-28 16:02:00',21,'adxsa','sdcasd','featured',NULL,'[\"EventImages/964OFRsc4PCf6EJOLspx1zWVOiqMl3Jpgw5C84y9.png\"]','https://www.syraut.com/?fbclid=IwZXh0bgNhZW0CMTAAAR1oT27e-QmQgySED7_7RLfG60JeI-6OAPQE8CA5n5KYMblqAbXmbwzpSsU_aem_bZHyKfW5VJIXUxCLb7xrCg','https://www.instagram.com/emsherifsyria/?hl=ar','https://www.facebook.com/EmSherifSyria/',12,3,'dfcdss','vv dcvd v','dxv dxv x','v dxcvdv','2024-08-04 13:03:59','2024-08-04 15:03:31',NULL,NULL),(29,'2024-08-04 15:03:27',3,'cczxcz','czxdczxdc',3,21,'2024-08-06 16:02:00','2024-08-28 16:02:00',21,'adxsa','sdcasd','featured',NULL,'[\"EventImages/jO1bqpSvmE3Bzpk9oIBpiyp9FRjKODCXdKtaW4TQ.png\"]','https://www.syraut.com/?fbclid=IwZXh0bgNhZW0CMTAAAR1oT27e-QmQgySED7_7RLfG60JeI-6OAPQE8CA5n5KYMblqAbXmbwzpSsU_aem_bZHyKfW5VJIXUxCLb7xrCg','https://www.instagram.com/emsherifsyria/?hl=ar','https://www.facebook.com/EmSherifSyria/',12,3,'dfcdss','vv dcvd v','dxv dxv x','v dxcvdv','2024-08-04 13:04:41','2024-08-04 15:03:27',NULL,NULL),(30,'2024-08-04 15:03:24',3,'cczxcz','czxdczxdc',3,21,'2024-08-06 16:02:00','2024-08-28 16:02:00',21,'adxsa','sdcasd','featured',NULL,'[\"EventImages/fX4nsa5n7qVnZjyWytqAMul1RLHYZXtd34STCp4U.png\"]','https://www.syraut.com/?fbclid=IwZXh0bgNhZW0CMTAAAR1oT27e-QmQgySED7_7RLfG60JeI-6OAPQE8CA5n5KYMblqAbXmbwzpSsU_aem_bZHyKfW5VJIXUxCLb7xrCg','https://www.instagram.com/emsherifsyria/?hl=ar','https://www.facebook.com/EmSherifSyria/',12,3,'dfcdss','vv dcvd v','dxv dxv x','v dxcvdv','2024-08-04 13:05:07','2024-08-04 15:03:24',NULL,NULL),(31,'2024-08-04 15:03:22',3,'cczxcz','czxdczxdc',3,21,'2024-08-06 16:02:00','2024-08-28 16:02:00',21,'adxsa','sdcasd','featured',NULL,'[\"EventImages/FdmXQ8te8qxLpIM1xafGx2MGL1tpto5Rr4HBjYo9.png\"]','https://www.syraut.com/?fbclid=IwZXh0bgNhZW0CMTAAAR1oT27e-QmQgySED7_7RLfG60JeI-6OAPQE8CA5n5KYMblqAbXmbwzpSsU_aem_bZHyKfW5VJIXUxCLb7xrCg','https://www.instagram.com/emsherifsyria/?hl=ar','https://www.facebook.com/EmSherifSyria/',12,3,'dfcdss','vv dcvd v','dxv dxv x','v dxcvdv','2024-08-04 13:05:23','2024-08-04 15:03:22',NULL,NULL),(32,'2024-08-04 13:25:26',6,'Siin Anniversary','Siin Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',0,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/EFWpMKfp6N1F8kHd6Fnc6fQ4QEKu4UZM4VQZoTO8.jpg\", \"EventImages/G3188PNHTRfa4TSrzmAyUd37fzYKfPwOvQGcVLmR.jpg\", \"EventImages/VwesRLbxo0Axz4be2t9x0M1j9rKkWj8gHfkoURod.jpg\", \"EventImages/YxH2y53euwzi4oPZFWudA8PoTKFDfzjH96VSJHp3.jpg\", \"EventImages/4LrQI04ZTZBtiiS3PrQHV9umdoF47rC5NXeYQrTj.jpg\"]',NULL,'https://www.instagram.com/siin_experience/',NULL,0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 13:06:06','2024-08-04 13:25:26',NULL,NULL),(33,'2024-08-04 15:03:19',2,'ascac','csdasccac',4,1000,'2024-08-06 16:10:00','2024-08-22 16:10:00',21,'dwdwd','ddwdwd','featured',NULL,'[\"EventImages/2TdCFfM9B6YNmMqcS1XPApQTYyrXtj9pnipV6PT9.png\"]','http://www.gemini-sy.com/','https://www.instagram.com/almenshyieh/p/Cjh6lI_oZye/','https://www.facebook.com/Gemini.Group.sy/',212,3,'dcfsd','vdv','vfvdvf','vdfcvdvd','2024-08-04 13:09:47','2024-08-04 15:03:19',NULL,NULL),(34,'2024-08-04 15:03:16',2,'gfdgdfgdfgdf','dfgdf',1,5000,'2024-08-20 16:20:00','2024-08-21 16:20:00',45454,'dfgdgdfgdfgdfgdfg','dfgdfgdfgdfgdfg','featured',NULL,'[\"EventImages/TWScTeE1O7PR2R7bP5x2hnb1qjn2TR4D7Opx7spY.jpg\", \"EventImages/dThsAbujLfELz8x3tUp9YnOUQ3Tl2KYOKAF5zQzm.jpg\", \"EventImages/R5SwmhKhq0awg5BaxaCuBAMVhEVS9evTQTPkA4B6.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.hdragency.com/',8,9,'dfgdfgdfg','gdfgdfgdfgdfgdf','dfgdfgdfg','dfgdfgdfgdfg','2024-08-04 13:19:13','2024-08-04 15:03:16',NULL,NULL),(35,'2024-08-04 15:03:14',6,'Siin  Anniversary','Siin  Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',25000,'Techno Party','حفل تكنو','normal',NULL,'[\"EventImages/cTzY8wtFsxdkUKkIeiJL9yyYcvNapMdfmaKonwMQ.jpg\", \"EventImages/zvY2uO09cPgyHkbCUxB3iOpU1Q5bxPTCh51sYqbv.jpg\", \"EventImages/PE33PzLryrc0QllcIbfqMFwyvZuyPJw9vjXTTd6N.jpg\"]',NULL,'https://www.instagram.com/siin_experience/',NULL,0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 13:30:14','2024-08-04 15:03:14',NULL,NULL),(36,'2024-08-04 15:03:11',2,'Siin Anniversary HDR','Siin Anniversary HDR',2,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',1000,'Techno Party','Techno Party','featured',NULL,'[\"EventImages/J9IYqQxGHVtU2f6taZZhQe5AWHZafoG1jQI8AfLk.jpg\", \"EventImages/nHa3NGTBOVkMIDotpwFXF20QifODSoRMr3UGavwc.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.facebook.com/EmSherifSyria/',1000,48,'no refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 13:34:34','2024-08-04 15:03:11',NULL,NULL),(37,'2024-08-04 15:03:08',2,'accdc','dcc',2,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',1000000,'dadasd','ddsadasd','featured',NULL,'[\"EventImages/PXrWv224tJ9KYF66xr77qzpPQiCaZo9uxQBNZRKC.jpg\", \"EventImages/mPDTZ7bTjzjLl8QuahjHCWy35RCfGXaKIOUH7OpG.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.facebook.com/EmSherifSyria/',10000,48,'no','dcfsdsdcf','cfsdcfcf','cfsddcfds','2024-08-04 13:41:21','2024-08-04 15:03:08',NULL,NULL),(38,'2024-08-04 15:03:05',6,'kazem','حفلة كاظم الساهر',13,498,'2024-08-06 16:40:00','2024-08-15 18:40:00',200,'techno','تكنو','featured',NULL,'[\"EventImages/LMkuQWkIDSemqHh8OZRsFnaEYePRwwjTkBkgMue9.jpg\"]',NULL,NULL,NULL,0,0,'هنغةع','ةهعةعة','ةهغةهعةهع','ةهغةهعةع','2024-08-04 13:45:51','2024-08-04 15:03:05',NULL,NULL),(39,'2024-08-04 15:03:02',3,'dsccs','cscs',4,2000,'2024-08-16 10:00:00','2024-08-17 16:48:00',100000,'adcacfa','ccszacaca','featured',NULL,'[\"EventImages/AT6WbK0cSYbey2zjHnjxMB49R377t0SQfMwMAboT.jpg\", \"EventImages/LKyU69haAaMH1VTnaHu3t0vZI7ehr1LRftfBdp2S.jpg\"]','http://www.gemini-sy.com/','https://www.instagram.com/naranj.sy/?hl=ar','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',100000,48,'dwadadd','cdcsds','dsfcds','dscfds','2024-08-04 13:49:21','2024-08-04 15:03:02',NULL,NULL),(40,'2024-08-04 15:02:59',3,'dsccs','cscs',4,2000,'2024-08-16 10:00:00','2024-08-17 16:48:00',100000,'adcacfa','ccszacaca','featured',NULL,'[\"EventImages/Z7jkoIFAdPdHvOYVEMmtzt0gZjiyzKAV1o6u53Lu.jpg\", \"EventImages/q1dbe1YOqnvweKmSAqVaZO1FyunnSVK04Zv7Ywpr.jpg\"]','http://www.gemini-sy.com/','https://www.instagram.com/naranj.sy/?hl=ar','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',100000,48,'dwadadd','cdcsds','dsfcds','dscfds','2024-08-04 13:49:41','2024-08-04 15:02:59',NULL,NULL),(41,'2024-08-04 15:02:57',3,'dsccs','cscs',4,2000,'2024-08-16 10:00:00','2024-08-17 16:48:00',100000,'adcacfa','ccszacaca','featured',NULL,'[\"EventImages/Wrr65LTHGEAIVNKbNBUEvUw0YIne5GwTbAbzfC3N.jpg\", \"EventImages/jCFro9qGgLE35m6rOYQUu43LS96vz5rCOYIhsz3j.jpg\"]','http://www.gemini-sy.com/','https://www.instagram.com/naranj.sy/?hl=ar','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',100000,48,'dwadadd','cdcsds','dsfcds','dscfds','2024-08-04 13:50:06','2024-08-04 15:02:57',NULL,NULL),(42,'2024-08-04 15:02:54',6,'Siin Experience Anniversary','Siin Experience Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',450000,'Tecno Party','حفل تكنو','featured',NULL,'[\"EventImages/WL160I0Jm8sK9PkGLiqQBfk4jEunEXDMcMCsV67Q.jpg\", \"EventImages/r5UmZGUYWxen9ydtbPmM5DlJcwC2a4PM49I0FBb7.jpg\", \"EventImages/62CAlFvsaXuw80XOnN1QmI30nVxXg0m5hOBzoomu.jpg\"]',NULL,'https://www.instagram.com/siin_experience/',NULL,0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 13:56:38','2024-08-04 15:02:54',NULL,NULL),(43,'2024-08-04 15:02:51',4,'sddcfsdc','cscs',4,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',1000,'dcasdsc','scsdcdsc','featured',NULL,'[\"EventImages/MifdzLTNLrwDt3QYcezMZaGknIwQSxOsGxmtuFGs.jpg\", \"EventImages/RRnO0optcVsQgXVr2jaq8DtNkfA4IMMDVXJ8fuhV.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/explore/locations/981871263/?next=%2Fup6%2Ffeed%2F','https://www.facebook.com/Gemini.Group.sy/',1000,48,'dfvgdfdgv','ffedff','ffefdrf','fedfrfdrf','2024-08-04 13:59:51','2024-08-04 15:02:51',NULL,NULL),(44,'2024-08-04 15:02:49',4,'sddcfsdc','cscs',4,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',1000,'dcasdsc','scsdcdsc','featured',NULL,'[\"EventImages/8So6H9zPQqcoOCnEnf57RfbzzE85JnHKz3Fcdsfa.jpg\", \"EventImages/5cCTgL20vyZuBA4JAr50cIHryEhytzeJDRqCe4Vi.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/explore/locations/981871263/?next=%2Fup6%2Ffeed%2F','https://www.facebook.com/Gemini.Group.sy/',1000,48,'dfvgdfdgv','ffedff','ffefdrf','fedfrfdrf','2024-08-04 14:01:04','2024-08-04 15:02:49',NULL,NULL),(45,'2024-08-04 15:02:47',4,'sddcfsdc','cscs',4,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',1000,'dcasdsc','scsdcdsc','featured',NULL,'[\"EventImages/Zahnnn4637uNcEWl3rGKsBgM9tjDVDmTCVCm4wre.jpg\", \"EventImages/CQYD3Nkw17sdEB7xVoFzoKv3v4ItR93Oi4Vy2Vjj.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/explore/locations/981871263/?next=%2Fup6%2Ffeed%2F','https://www.facebook.com/Gemini.Group.sy/',1000,48,'dfvgdfdgv','ffedff','ffefdrf','fedfrfdrf','2024-08-04 14:01:46','2024-08-04 15:02:47',NULL,NULL),(46,'2024-08-04 15:02:45',4,'sddcfsdc','cscs',4,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',1000,'dcasdsc','scsdcdsc','featured',NULL,'[\"EventImages/WvI58OezCUebxxTGCbqOwsLHc8UrIKxwgww2TacV.jpg\", \"EventImages/x9jEYkRl20hSXnKPnLQRc8sL7iM2ohLK52EdmcX7.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/explore/locations/981871263/?next=%2Fup6%2Ffeed%2F','https://www.facebook.com/Gemini.Group.sy/',1000,48,'dfvgdfdgv','ffedff','ffefdrf','fedfrfdrf','2024-08-04 14:01:56','2024-08-04 15:02:45',NULL,NULL),(47,'2024-08-04 15:02:42',6,'Siin Anniversary HDR','Siin Anniversary HDR',13,2000,'2024-08-16 22:08:00','2024-08-17 06:00:00',500000,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/c3XVBuYIrODfFF0dfQFs5HJKVXy3p0ljgTbZhsHM.jpg\", \"EventImages/khsbACpR7BO1On6bTMrqE8YZ067I9OrAjUEjsmfl.jpg\", \"EventImages/XhVTsxjIN0bUXA2N7iGh983c04nQjhYluFWfS9Ic.jpg\", \"EventImages/gRZlfY4xJrd6NG7jEPWb4HyxIKCzqzbCv5eXAtuX.jpg\", \"EventImages/rBcPoJxqWZ9LewGEPCS3WjFDoUZJS5liu59z7tHo.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.hdragency.com/',15,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 14:08:42','2024-08-04 15:02:42',NULL,NULL),(48,'2024-08-04 15:02:39',4,'Siin Anniversary HDR','Siin Anniversary HDR',3,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',1000000,'axsa','ascscsc','featured',NULL,'[\"EventImages/Qsr0rdn7kvjrAK9i9eZA5A2A7aWqxn05fySaXRIv.jpg\", \"EventImages/XIUjsTn2GxIlnX0boKjSec3E4m9y6K3MD7lpWKPl.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.facebook.com/profile.php?id=100057196400802&sk=about',1000000,48,'no refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','no refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 14:20:32','2024-08-04 15:02:39',NULL,NULL),(49,'2024-08-04 15:02:37',4,'Siin Anniversary HDR','Siin Anniversary HDR',3,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',1000000,'axsa','ascscsc','featured',NULL,'[\"EventImages/ot7FbKGEJQ1lz9RW4we79MKQKE2op34jCV0kU1Sx.jpg\", \"EventImages/U9b8zJXqRAc6aHvlVySa1gN161gWBruzDp16h24A.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.facebook.com/profile.php?id=100057196400802&sk=about',1000000,48,'no refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','no refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 14:21:28','2024-08-04 15:02:37',NULL,NULL),(50,'2024-08-04 14:42:11',4,'Siin Anniversary test','Siin Anniversary test',3,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',1000000,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/cbUjWcrGsNYp7IZ2yWszJrQoNmclgA52jlQeEHd6.jpg\", \"EventImages/urZuSQYY1bOBhpkU81afhjxyLwrOzgPmD2HSFnfC.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',100000,48,'no refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','no refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 14:28:28','2024-08-04 14:42:11',NULL,NULL),(51,'2024-08-04 15:02:34',3,'Siin Anniversary test','Siin Anniversary test',4,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',100000,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/3dvfzRTLYD1V7Il0pFPAn670fOGkqDaz6Sl26whI.jpg\", \"EventImages/JJ5gamdbg4vGsSPbtECTwSJIW6L0htneALIIyKqV.jpg\", \"EventImages/VHaewNUkHUlvhZPmGW0N6EzvcCTNNAnwkZiTEgUl.jpg\", \"EventImages/xPc6HiWOsMoRefPllhMWM88Zgg99eZTtENRrhWRv.jpg\", \"EventImages/CS6epivkmigwqX0SlPN86rPygiu2LlkxKHJN3TvW.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.facebook.com/people/Damascus-Opera-House-%D8%AF%D8%A7%D8%B1-%D8%A3%D9%88%D8%A8%D8%B1%D8%A7-%D8%AF%D9%85%D8%B4%D9%82/100057196400802/',10000,48,'no refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','no refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 15:00:02','2024-08-04 15:02:34',NULL,NULL),(52,'2024-08-04 15:02:32',3,'Siin Anniversary test','Siin Anniversary test',4,2000,'2024-08-16 10:00:00','2024-08-17 06:00:00',100000,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/VnCwNgUZcPFe8CEfDvrKl3iDZz9N3MjFeeEvIded.jpg\", \"EventImages/C4OpX4ybHpaEM4LA4xMaAAIqJt5JqvqcqQtun7EU.jpg\", \"EventImages/4nonbw7zOByh3v4fJJiZ5QvGj3DarRddYmalp3q6.jpg\", \"EventImages/PtTJpbDcG29XEifJmdBJfJIQcELvcUEwbFJu9Hww.jpg\", \"EventImages/g46Gr2FQXlGlhBVxurmjL0rkyiyGVdrCiUGgOaS3.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.facebook.com/people/Damascus-Opera-House-%D8%AF%D8%A7%D8%B1-%D8%A3%D9%88%D8%A8%D8%B1%D8%A7-%D8%AF%D9%85%D8%B4%D9%82/100057196400802/',10000,48,'no refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','no refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 15:00:41','2024-08-04 15:02:32',NULL,NULL),(53,'2024-08-05 07:45:38',6,'sin experience Anniversary','sin experience Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',750000,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/gpzpPpUxGcyvx1rCbikB5E8ebicrm0RvS2ck7un1.jpg\", \"EventImages/CDZYuiD6dOzxSFY7OgBK9IIEBpy0OxcHxjSnKl2U.jpg\", \"EventImages/C3p3ZCmC69aJ1BsA5RiixsQZjJ01GydVThRTuTt6.jpg\", \"EventImages/SCyoH99Lx2iagEFpJozV8GofUYnmPlrQuFIQF0xG.jpg\", \"EventImages/o3im4jg6qRJOuW5OQDMvj9BE8jWzhmBZDD8cidla.jpg\"]','https://www.hdragency.com/','https://www.hdragency.com/','https://www.hdragency.com/',25,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','لا استرداد','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-04 15:09:07','2024-08-05 07:45:38',NULL,NULL),(54,'2024-08-05 07:54:19',6,'Siin Anniversary','Siin Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',450000,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/9TPs4jWZlKPP8KPyOUvGUxmWO4Rzhp7zEqpzbgJR.jpg\", \"EventImages/t6Ex0KrRJemieyeLxvn96lacqgcyh4EJjtUF7ftj.jpg\", \"EventImages/kthd02aFNsgi9NwJl4jKeblGPnAPtWFpvhRHhrG1.jpg\", \"EventImages/OFwok62136lXxuFCBudZ9OOSb2gJiztb6gmk5Pz9.jpg\"]',NULL,'https://www.instagram.com/siin_experience/',NULL,0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-05 07:52:35','2024-08-05 07:54:19',NULL,NULL),(55,'2024-08-05 08:40:40',6,'Siin Anniversary','Siin Anniversary',13,2000,'2024-08-16 22:00:00','2024-08-17 06:00:00',0,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/BaADX6uRIqZ1aZGTwhobGSzNim6fynPTPqZWoX5Q.jpg\", \"EventImages/kcUiS2nQtg8uVDckTiK8kkE12zhyl8JM2nZLWaIY.jpg\", \"EventImages/bKw5KuwBC2B8PM4UYDyqjuMFxx9PlOtd1ofDTS1T.jpg\", \"EventImages/6tVW7U6i7tEXBMw0w1Xw2rk7rZeDhxFoh1hfNmxM.jpg\"]',NULL,'https://www.instagram.com/siin_experience/',NULL,0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-05 07:58:48','2024-08-05 08:40:40',NULL,NULL),(56,'2024-08-05 08:40:38',6,'Siin Experience Anniversary','Siin Experience Anniversary',13,2000,'2024-08-20 11:35:00','2024-08-21 11:36:00',450000,'Techno Party','حفل تكنو','featured',NULL,'[\"EventImages/CqNaJAEDtvChPz2xfiWyH62zs3o4ZNg6PdbnfrRf.jpg\"]',NULL,'https://www.instagram.com/siin_experience/',NULL,0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء.','2024-08-05 08:38:38','2024-08-05 08:40:38',NULL,NULL),(57,'2024-08-09 14:06:58',2,'asd','asd',13,1000,'2024-08-08 11:48:00','2024-08-10 11:48:00',1000,'asd','لاقفلاقف','featured','[\"EventVideo/rduuuGM1IpPkxFM6TIOr5nAd91FzEylhkdPRofmG.mp4\"]','[\"EventImages/8RXiwgHPAmCg6cwvGAJmNflggryHwyJ8j72x6IQj.jpg\"]','http://www.gemini-sy.com/','https://www.instagram.com/siin_experience/','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',0,10,'asd','dsa','dsa','لاقفلاقفلاقف','2024-08-05 09:00:46','2024-08-09 14:06:58',NULL,NULL),(58,NULL,6,'Siin Experience Anniversary','Siin Experience Anniversary',13,2000,'2024-08-09 20:37:00','2024-08-17 06:00:00',450000,'techno Party','حفل تكنو','featured','[\"EventVideo/2fid7kNbCXoNfE9tWdf31Vu0SH5qnPYRCm62Mu9d.mp4\"]','[\"EventImages/Ov9uqmEpqdJWrYUbkzEPaRZmXcMT8tuwOt1Z2oIb.jpg\", \"EventImages/spbA29EsfuP8VO0auQSItahB6rngmLrkMzupEmxL.jpg\", \"EventImages/MZrhdofqvt8bePBW9pLM0wp4nkkATTB5mo7d14c1.jpg\", \"EventImages/FzkseILmKdDrft6p3pDj3G8Lw03fyEDwFUUoAynM.jpg\", \"EventImages/TH83NJxmHJhI5Dn5Q44BdYpsfdOVIyZ4ucuTWKev.jpg\"]','http://www.gemini-sy.com/','https://www.instagram.com/siin_experience/','https://www.facebook.com/Gemini.Group.sy/',0,36,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-05 10:39:22','2024-08-08 07:55:13',NULL,NULL),(59,'2024-08-09 14:06:55',7,'JCI','الغرفة الفتية الدولية دمشق',3,1000,'2024-08-14 15:36:00','2024-08-15 15:36:00',100000,'Test','Test','normal','[\"events/aFr0lJkdx7HxVCJtKrbRmSzoKPUfxIepWXAgoOp2.mp4\"]','[\"EventImages/XDpHYCpBOdDL2XreokP5gJFuZ65lh9PsE7LMbJrx.jpg\", \"events/ldrHFE0bCf46VIE6sfdWCBE4uUtlwxkdhvCa9m99.jpg\", \"events/2cwHl0wAlpUGKvumU1l8oXxhGTCKyE2hT657YlaO.jpg\", \"events/HhSBRAwqxKaiK3H9Z9X8vw4RNkHGObr8gGAjwX4I.jpg\", \"events/81iASpBRqCiD8TPlIZvz9PKzHACRdWvEExfCigkS.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/siin_experience/','https://www.facebook.com/naranj.res/',0,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','No Refund','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء','2024-08-05 12:48:09','2024-08-09 14:06:55',NULL,NULL),(60,'2024-08-05 13:41:57',2,'cccszcf','cfszcsc',3,2000,'2024-08-06 16:40:00','2024-08-19 16:40:00',1000,'csdcfcfsd','cscsccs','featured',NULL,'[\"EventImages/7wltz8Fl0N94sAklx352PY4cxgN1ik0odPIaORJr.jpg\", \"EventImages/lnOy7QI48Oc9sBDHmPYAn3xoaO4zIGnb0wJ1z1UD.jpg\"]','http://www.gemini-sy.com/','https://www.hdragency.com/','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',1000,48,'dsacdscd','szcscc','csdcdscf','cfsdccs','2024-08-05 13:40:56','2024-08-05 13:41:57',NULL,NULL),(61,'2024-08-09 14:06:52',2,'test test','fsfsf',2,2000,'2024-08-16 11:06:00','2024-08-20 11:06:00',2000,'asda','aaaadxasda','featured','[]','[\"EventImages/reg8DO8iitEyl5UpDLlX0AmHoYyFic3ZLJZpLPFS.jpg\", \"EventImages/1ennzxfxFuyjFYsY6LyN7w9gYlKW9hD8mMkW5P02.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/gemini.group.sy/?hl=ar','https://www.facebook.com/naranj.res/',20,48,'adasd','cscd','cscsc','cdscsc','2024-08-08 08:09:00','2024-08-09 14:06:52','percent',NULL),(62,'2024-08-09 14:06:50',3,'fcdsf','sfsdfsdf',2,2000,'2024-08-09 14:55:00','2024-08-30 14:55:00',100,'ddsdd','dsdsd','featured',NULL,'[\"EventImages/5FyTXE4ivhNa0Yof6hobk5e3XjOo25SrEjH97gi2.jpg\"]','https://www.syraut.com/?fbclid=IwZXh0bgNhZW0CMTAAAR1oT27e-QmQgySED7_7RLfG60JeI-6OAPQE8CA5n5KYMblqAbXmbwzpSsU_aem_bZHyKfW5VJIXUxCLb7xrCg','https://www.instagram.com/emsherifsyria/?hl=ar','https://www.facebook.com/EmSherifSyria/',20,48,'ddswdsd','dscf','csdd','vdsvv','2024-08-08 11:55:28','2024-08-09 14:06:50','percent',NULL),(63,'2024-08-09 14:06:45',3,'dxad','asdasd',4,200,'2024-08-09 15:25:00','2024-08-23 15:25:00',1212,'dedde','ddwsed','featured','[]','[\"EventImages/z5bKI38LNphlzG0GMSv61Qla8tkURL2Scm8siNLI.jpg\"]','http://www.gemini-sy.com/','https://www.hdragency.com/','https://www.facebook.com/people/Damascus-Opera-House-%D8%AF%D8%A7%D8%B1-%D8%A3%D9%88%D8%A8%D8%B1%D8%A7-%D8%AF%D9%85%D8%B4%D9%82/100057196400802/',20,48,'dde','fsdfsdff','sdfsdf','fsfsf','2024-08-08 12:25:03','2024-08-09 14:06:45','amount',10),(64,'2024-08-09 14:06:43',1,'dss','dasd',5,1000,'2024-08-15 15:16:00','2024-08-22 15:17:00',1000,'sxax','xaxax','featured',NULL,'[\"EventImages/Yb012qmEXzmCyyxmAy8rqLwZsCUglcovAIcW45Yu.jpg\", \"EventImages/9Z2G65X4YfeOc3JCENte7wazvC4wmTbDEGLILM84.jpg\", \"EventImages/gMWnvoyC33lMF3PrdA8wYvaIDtf49rP0S0ox58O1.jpg\", \"EventImages/yaGnigjuKFRVQTdnnexSWw9NtPGV7gyE3U46Z9yZ.jpg\"]','http://www.gemini-sy.com/','https://www.instagram.com/almenshyieh/p/Cjh6lI_oZye/','https://www.facebook.com/profile.php?id=100057196400802&sk=about',20,35,'axax','xdax','xaxas','xdaxax','2024-08-09 12:34:20','2024-08-09 14:06:43','percent',1000),(65,'2024-08-09 14:06:40',4,'xszxszx','xxszxxzs',2,1000,'2024-08-14 15:43:00','2024-08-30 15:43:00',1,'xxzxzx','zxzxxzx','featured',NULL,'[\"EventImages/f7CCSp8CwwV6FlmIcyMz27HJLqnfMPb20Spou7x2.jpg\", \"EventImages/l6Sm026lhtEZwa8FKENbmkHUB6rm9NQFJbqkBZV3.jpg\", \"EventImages/HPEuUzyPbYctdxtjJFhbziDtaFPcpVdQOi3mwAH5.jpg\", \"EventImages/Y5K3Ahw4vxMmQ4HmBudJygJWYF2Q8mq96V7M5yu0.jpg\"]','https://www.syraut.com/?fbclid=IwZXh0bgNhZW0CMTAAAR1oT27e-QmQgySED7_7RLfG60JeI-6OAPQE8CA5n5KYMblqAbXmbwzpSsU_aem_bZHyKfW5VJIXUxCLb7xrCg','https://www.instagram.com/gemini.group.sy/?hl=ar','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',20,48,'xzxzxz','dcfdcs','sdvvsd','vsdvv','2024-08-09 12:42:46','2024-08-09 14:06:40','percent',23),(66,'2024-08-09 14:06:38',3,'dxasdasdd','asdsdasd',3,1000,'2024-08-13 16:10:00','2024-08-29 16:10:00',1201,'xszaxx','xszax','featured','[\"EventVideo/FIVQxdSoXGsCVlaSbsnW2VB7NY0mq0i4l9gWJO11.mp4\"]','[\"EventImages/11RFwjW88oIZnOCGgEhiAOtwCdmstf0I7ysiVPar.jpg\", \"EventImages/w0EJUU0k4VstNo0ZsqnIl0VO0nbaOcECsUwdJx9e.jpg\", \"EventImages/zIVwyi8i7Izfz4M9hE9CyJGge39Bd4ENeqgF6bDk.jpg\"]',NULL,'https://www.instagram.com/explore/locations/981871263/?next=%2Fup6%2Ffeed%2F','https://www.facebook.com/Gemini.Group.sy/',1000,25,'xaxaxax','dscfdsc','dsfcd','dfsf','2024-08-09 13:10:01','2024-08-09 14:06:38','amount',100),(67,NULL,4,'Syrian championship of speed racing and drift','بطولة سورية لسباقات السرعة والدريفت',9,5000,'2024-08-19 08:00:00','2024-08-21 20:59:00',200000,'Syrian Championship of Speed Racing and Drift: Join us for an adrenaline-packed event showcasing the best in speed racing and drift competitions','بطولة سوريا لسباقات السرعة والدريفت: انضم إلينا في حدث مليء بالإثارة يستعرض أفضل سباقات السرعة ومنافسات الدريفت','featured','[\"EventVideo/dbyZFxMtS2AAqAm2dJkFV1TclmPQrvm0ZehmkVlX.mp4\"]','[\"EventImages/M7jT1jCggUcRFmDzhwv6VmZRematnTkYcomp93PJ.jpg\", \"EventImages/0bNAgAs6A9SLEGN4yAtYafmiuzfI5iZIdM8TioMj.jpg\", \"EventImages/VZg02YQNBhhq0IrpKNWvoyEjxssPVcrCMcgVXPtf.jpg\", \"EventImages/A06HbsOi3llS7aoMFVapFgy568nJ0ToC6Mq5xATm.jpg\", \"EventImages/vgb2xrVGtrcnTz4JdVmzvexu4e0RyBS3OTLud7dY.jpg\", \"EventImages/SrxKuUmVYknCmYu6vrk6XqjAsx23rdj6oZPVvqSa.jpg\"]','https://www.hdragency.com/','https://www.facebook.com/syraut','https://www.facebook.com/syraut',3,56,'Refunds are processed within 7-10 business days. Please contact our support team for assistance','Cancellations must be made at least 48 hours in advance to receive a full refund. Late cancellations will incur a fee','يجب إجراء الإلغاءات قبل 48 ساعة على الأقل للحصول على استرداد كامل. سيتم فرض رسوم على الإلغاءات المتأخرة','يجب إجراء الإلغاءات قبل 48 ساعة على الأقل للحصول على استرداد كامل. سيتم فرض رسوم على الإلغاءات المتأخرة','2024-08-09 14:24:47','2024-08-09 14:24:47','percent',15),(68,'2024-08-09 14:49:35',3,'wsedsed','dsed',4,1000,'2024-08-10 17:43:00','2024-08-29 17:43:00',500,'sxdc','cdcc','featured',NULL,'[\"EventImages/2KqtA73eb4vLctZox2y3VCUs2I9QXBJYrZ3RdQF2.jpg\", \"EventImages/dZqavsInhzW0xazjGMDUc5aBNTBEjFiqV5ciILjI.jpg\"]','http://www.gemini-sy.com/','https://www.instagram.com/gemini.group.sy/?hl=ar','https://www.facebook.com/EmSherifSyria/',20,35,'cdxcd','dxdc','cscd','dcd','2024-08-09 14:44:04','2024-08-09 14:49:35','percent',12),(69,NULL,4,'Palmyra Archaeological Symposium','ندوة تدمر الأثرية',15,1,'2024-09-01 16:00:00','2024-09-01 21:00:00',200000,'Discover the ancient ruins of Palmyra, a UNESCO World Heritage site, known for its stunning architecture and historical significance.','اكتشف أطلال تدمر القديمة، موقع تراث عالمي لليونسكو، والمعروف بجمال هندسته وأهميته التاريخية.','featured',NULL,'[\"EventImages/pRpqkQB6nuGU2wCSQpE40nRSbTK9Ma9zw4oVq9vr.jpg\", \"EventImages/dp8pKCQh8yFeXkZW97MODXYXcgdcjgzYxXIALmZL.jpg\", \"EventImages/4WEaxfSakKD0gs1Fs5HchIgGMZlPJSN0nVFLYTYr.jpg\", \"EventImages/m2o8ahEWrEatROT8i2qyA4ADe80NpKpdUQ3BtVZi.jpg\", \"EventImages/23mXL4fZZCF1YTHYjXIaGusJwJ6t5VFxBhMXthaV.jpg\", \"EventImages/H6xUVAvlshDt2ZRXAsZFXt14lon89ppCpdyZclXG.jpg\", \"EventImages/YVyFdHkOJy6kgdGPVGK86JV8ySEfH6XaPaFJXtwJ.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/naranj.sy/?hl=ar','https://www.hdragency.com/',25000,48,'Refunds will be processed within 7-10 business days after the cancellation request is approved. For assistance, please contact our support team.','Cancellations must be made at least 48 hours before the event to receive a full refund. Cancellations made less than 48 hours before the event will not be eligible for a refund.','يتم معالجة الاستردادات خلال 7-10 أيام عمل بعد الموافقة على طلب الإلغاء. للحصول على المساعدة، يرجى الاتصال بفريق الدعم.','يجب إجراء الإلغاءات قبل 48 ساعة على الأقل من الحدث للحصول على استرداد كامل. الإلغاءات التي تتم قبل أقل من 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال.','2024-08-09 14:49:22','2024-08-09 14:49:22','amount',15),(70,NULL,6,'Test Anniversary','test Anniversary',13,2000,'2024-08-20 11:02:00','2024-08-21 11:02:00',500,'Techno Party','Techno Party','featured','[\"EventVideo/O3odQRtY32xdfuc2Hd2OC9ZwfpzXXbTl01KhaO3H.mp4\"]','[\"EventImages/D9ob1ruYztdwgpILmYXIByYZDXBQx8YR7v8jWGEb.jpg\", \"EventImages/F74xxLsd7bVUNq5Ksty3dh2YXig4mkO9vGyo0A3P.jpg\", \"EventImages/SbBBRERehQcqjuSnDORLzn6ng5bXnBqdvazIEcJD.jpg\"]','https://www.instagram.com/siin_experience/','https://www.instagram.com/siin_experience/','https://www.instagram.com/siin_experience/',10,48,'No Refund','Cancellations made within 48 hours of the event will not be eligible for a refund. Please contact customer service for any cancellation requests.','لثق لاثق لاثق شلا','الإلغاءات التي تتم في غضون 48 ساعة من الحدث لن تكون مؤهلة لاسترداد الأموال. يرجى الاتصال بخدمة العملاء لأي طلبات إلغاء.','2024-08-10 08:13:22','2024-08-10 09:04:02','amount',10),(71,NULL,3,'GDGD','GDDS',2,1000,'2024-08-11 14:33:00','2024-09-05 14:33:00',112,'DASDD','DSDSD','featured','[]','[\"EventImages/2YJHyq9rM4AdPAEucFE6c3zPfC0pRCPyJsUQq8Vm.jpg\", \"EventImages/03H0R2gvC6vc2HMi043opokiE5naCqKPx1kUnwII.jpg\", \"EventImages/wQJU3Ad0tA0S5OLRkVmT9ZBk9Tun6GTDf2U3jeZs.jpg\"]','http://www.gemini-sy.com/','https://www.instagram.com/emsherifsyria/?hl=ar','https://www.facebook.com/Gemini.Group.sy/',20,36,'DASDSD','SDSS','DDSDD','DSDSD','2024-08-10 11:32:46','2024-08-10 11:34:09','amount',21),(72,NULL,1,'sdfsd','sdfsdfsd',1,5555,'2024-09-06 15:52:00','2024-09-06 23:52:00',200000,'hfghfghfgghfghfghfghfgh','gfhfghfghfghfghfg','featured',NULL,'[\"EventImages/j5cmycr56y8t1I7oXFZHiKoetBSYWbNs5mTf0KMq.jpg\", \"EventImages/XM5X3w0Oo2BUreoEmYPTAs52jI3rhStfQY3b9mtl.jpg\"]','https://www.hdragency.com/','https://www.instagram.com/naranj.sy/?hl=ar','https://www.hdragency.com/',10000,48,'fgfghfg','fghfghfghfghfghf','fghfghfghfg','fghfghfhfgh','2024-08-10 12:51:33','2024-08-10 12:51:33','amount',15),(73,NULL,4,'dscs','dscsc',2,100,'2024-08-11 16:04:00','2024-08-29 16:05:00',21,'dxsza','xdsaz','normal','[]','[\"EventImages/w2qnwWDlvHklsu9QtTp7JXnDZqjtwNwkooWBOzOw.jpg\", \"EventImages/BPlLtcbp0XWDasqfBghWHDcKLsdvJRcpA8n2nfAm.jpg\", \"EventImages/mtFzc7MNlmK6Ss3LDkGl3lQuHlbOlCjk4CobukCN.jpg\"]','http://www.gemini-sy.com/','https://www.hdragency.com/','https://m.facebook.com/p/%D9%85%D8%B7%D8%B9%D9%85-%D8%A7%D9%84%D9%85%D9%86%D8%B4%D9%8A%D8%A9-ALManshia-Restaurant-100083324625600/',2,21,'dsz','saa','szadxs','dxsaa','2024-08-10 13:04:07','2024-08-10 13:05:01','amount',21),(74,NULL,3,'ccxc','cxscxc',3,1000,'2024-08-11 16:49:00','2024-08-29 16:49:00',12,'xdsz','xzsxzc','featured',NULL,'[\"EventImages/VlCJnJW5gpXCKaXu77kzYnfKl5aVVLUMjBbkcJGv.jpg\", \"EventImages/qNJpEmSFpz71Z1Qq6GloVk1dnNYrZTzKQFJ7ZYPb.jpg\", \"EventImages/IhuHnkdQ7CnLJDKVXGpNaWaUjZhoCPk08FG47luE.jpg\"]','http://www.gemini-sy.com/','https://www.instagram.com/almenshyieh/p/Cjh6lI_oZye/','https://www.facebook.com/profile.php?id=100057196400802&sk=about',22,21,'ccszxcxzs','czcxz','czcxzcz','xczxc','2024-08-10 13:48:59','2024-08-10 13:48:59','percent',13);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `friend_requests`
--

DROP TABLE IF EXISTS `friend_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `friend_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `status` enum('pending','approve') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `friend_requests_sender_id_index` (`sender_id`),
  KEY `friend_requests_receiver_id_index` (`receiver_id`),
  KEY `friend_requests_status_index` (`status`),
  CONSTRAINT `friend_requests_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `friend_requests_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend_requests`
--

LOCK TABLES `friend_requests` WRITE;
/*!40000 ALTER TABLE `friend_requests` DISABLE KEYS */;
INSERT INTO `friend_requests` VALUES (1,20,4,'pending','2024-06-09 13:37:17','2024-06-09 13:37:17'),(2,20,6,'pending','2024-06-09 13:37:18','2024-06-09 13:37:18'),(3,20,5,'approve','2024-06-09 13:37:18','2024-06-09 13:38:14'),(4,20,3,'pending','2024-06-09 13:37:19','2024-06-09 13:37:19'),(5,20,1,'pending','2024-06-09 13:37:20','2024-06-09 13:37:20'),(6,20,2,'pending','2024-06-09 13:37:20','2024-06-09 13:37:20'),(7,20,18,'pending','2024-06-09 13:37:23','2024-06-09 13:37:23'),(8,20,19,'pending','2024-06-09 13:37:23','2024-06-09 13:37:23'),(9,2,5,'approve','2024-08-10 03:38:42','2024-08-10 03:39:18');
/*!40000 ALTER TABLE `friend_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mobile_user_id` bigint unsigned DEFAULT NULL,
  `amount` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `external_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_external_id_unique` (`external_id`),
  KEY `invoices_mobile_user_id_foreign` (`mobile_user_id`),
  CONSTRAINT `invoices_mobile_user_id_foreign` FOREIGN KEY (`mobile_user_id`) REFERENCES `mobile_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=100108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (100070,20,132200,'Booking Process',7916451081629094122,'2024-06-09 13:23:00','2024-06-09 13:23:00'),(100072,19,87200,'Booking Process',5917231457186354923,'2024-06-09 13:24:00','2024-06-09 13:24:00'),(100101,NULL,1000,'Booking Process',123456789,'2024-08-06 10:52:54','2024-08-06 10:52:54'),(100102,NULL,1550,'Booking Process',2676318907,'2024-08-06 10:56:27','2024-08-06 10:56:27'),(100103,NULL,1550,'Booking Process',2973691783,'2024-08-06 13:11:03','2024-08-06 13:11:03'),(100104,NULL,1550,'Booking Process',1072427438,'2024-08-06 13:19:01','2024-08-06 13:19:01'),(100105,NULL,1550,'Booking Process',451223474,'2024-08-06 16:08:43','2024-08-06 16:08:43'),(100106,NULL,1550,'Booking Process',26420104,'2024-08-09 15:03:28','2024-08-09 15:03:28'),(100107,NULL,1550,'Booking Process',1710769823,'2024-08-10 08:08:52','2024-08-10 08:08:52');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0000_00_00_000000_create_websockets_statistics_entries_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_reset_tokens_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2022_09_28_125434_create_mobile_users_table',1),(7,'2022_09_28_125435_create_organizers_table',1),(8,'2023_09_14_072052_create_otp_verification_codes_table',1),(9,'2023_09_15_160846_create_reset_code_passwords_table',1),(10,'2023_09_24_104309_create_amenities_table',1),(11,'2023_09_24_104310_create_service_categories_table',1),(12,'2023_09_24_104311_create_event_categories_table',1),(13,'2023_09_24_104312_create_event_request_categories_table',1),(14,'2023_09_24_104312_create_venues_table',1),(15,'2023_09_24_104319_create_service_providers_table',1),(16,'2023_09_24_104320_create_service_provider_albums',1),(17,'2023_09_24_104321_create_events_table',1),(18,'2023_09_24_104322_create_amenity_event_table',1),(19,'2023_09_24_104323_create_event_category_event_table',1),(20,'2023_09_24_104324_create_event_likes_table',1),(21,'2023_09_24_104325_create_event_comments_table',1),(22,'2023_09_24_104326_create_event_classes_table',1),(23,'2023_09_24_104327_create_class_amenity_table',1),(24,'2023_09_24_104330_create_event_trips_table',1),(25,'2023_09_24_104331_create_event_service_provider_table',1),(26,'2023_09_24_104332_create_event_requests_table',1),(27,'2023_09_24_111252_create_reels_table',1),(28,'2023_11_12_122401_create_permission_tables',1),(29,'2023_11_18_062126_create_invoices_table',1),(30,'2023_11_29_071604_create_promo_codes_table',1),(31,'2023_11_29_071717_create_event_promo_code_table',1),(32,'2023_11_29_071718_create_user_promo_code_table',1),(33,'2023_12_07_102235_create_organizer_follows_table',1),(34,'2023_12_07_102250_create_friend_requests_table',1),(35,'2023_12_07_130524_create_reviews_table',1),(36,'2023_12_09_070259_create_offers_table',1),(37,'2023_12_09_145627_create_bookings_table',1),(38,'2023_12_10_145554_create_event_category_mobile_user_table',1),(39,'2023_12_18_102125_create_event_follows_table',1),(40,'2023_12_21_135450_create_reel_likes_table',1),(41,'2023_12_21_135501_create_reel_comments_table',1),(42,'2023_12_27_112854_create_venue_albums_table',1),(43,'2024_01_06_102110_create_cancelled_bookings_table',1),(44,'2024_01_06_142325_create_organizer_albums_table',1),(45,'2024_01_08_112219_create_organizer_categories_table',1),(46,'2024_01_13_070746_create_venue_reviews_table',1),(47,'2024_01_13_070755_create_service_provider_reviews_table',1),(48,'2024_01_15_112037_create_notifications_table',1),(49,'2024_02_18_111053_create_payments_table',1),(50,'2024_03_09_151928_create_cancel_invoices_table',1),(51,'2024_03_11_112632_create_device_tokens_table',1),(52,'2024_03_20_045405_create_public_notifications_table',1),(53,'2024_08_10_092206_create_temped_bookings_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobile_users`
--

DROP TABLE IF EXISTS `mobile_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mobile_users` (
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `state` enum('Aleppo','Al-Ḥasakah','Tartus','Al-Qunayṭirah','Al-Raqqah','Al-Suwayda','Damascus','Daraa','Dayr al-Zawr','Ḥamah','Homs','Idlib','latakia','Rif Dimashq') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('normal','private','organizer','service_provider','verified') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `active_type` enum('normal','blocked') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile_users_phone_number_unique` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobile_users`
--

LOCK TABLES `mobile_users` WRITE;
/*!40000 ALTER TABLE `mobile_users` DISABLE KEYS */;
INSERT INTO `mobile_users` VALUES (NULL,1,'maysj','jrjr','0996368902',NULL,'$2y$10$opP1NVtGiFRGuETyCqr5J.AOnrE8nQJT8LM5PVilhONCqH4TFjo3i','male','2000-01-01','Daraa','User_images/y5nzi9hZvW4JXmrBzv3HwV1S2eSGIka2DG1CzQ7K.jpg',1,1,'normal','normal',NULL,'2024-06-05 14:55:28','2024-07-24 10:14:32'),(NULL,2,'maysam','sweid','0958957464',NULL,'$2y$10$K1vwhHrC5YpouvynTRxZeO9Lno7BQoQ7yPVMMYLLzwlbtGhWc2JsO','male','2000-01-01','Homs','1',1,1,'service_provider','normal',NULL,'2024-06-05 14:57:12','2024-08-09 13:24:55'),(NULL,3,'modar','salem','0968397449',NULL,'$2y$10$lO5PsCPwdgAFqLyxfKysp.xQJwk9eh4ZWCRbhFeskINr2M7bk3FAK','male','2001-01-01','Al-Suwayda','1',1,1,'service_provider','normal',NULL,'2024-06-05 15:13:53','2024-08-09 13:29:53'),(NULL,4,'ahmad','assi','0988020706',NULL,'$2y$10$hUsatYIa4ZnMLb8lAb0aeOgEgORKl/Gg3YQE9oepAYorTvE4.XAsG','male','1990-06-05','Homs','1',1,1,'service_provider','normal',NULL,'2024-06-05 15:20:37','2024-06-05 16:06:25'),(NULL,5,'Haidar','Tarboush','0937755273',NULL,'$2y$10$WnOYJ2eBKi.U4g4o0qxfOe1W4VZhVRY4lZMUS/s0mAl5JXhZTEoaS','male','1999-09-04','Damascus','2',1,1,'organizer','normal',NULL,'2024-06-05 15:53:22','2024-08-10 02:33:31'),(NULL,6,'Diana','Diana','0999999990',NULL,'$2y$10$d9DExrlohzRvBqRq.MjA0e00NR2nXzasm9aalQhyM/3gDe.UI2zSy','female','1997-01-01','Aleppo','1',1,1,'organizer','normal',NULL,'2024-06-05 16:09:19','2024-06-08 11:17:43'),(NULL,7,'diana','diana','0999999996',NULL,'$2y$10$m/4VQKPDVGcKAX2vr.xH7OcPn5YO3079IR4u2z8kOkcnE26JugbzG','female','1997-01-01','Aleppo','User_images/RrauIYBCNcCcKfjkkJRrNXCAt3iS8GWikjADYO2J.jpg',1,1,'service_provider','normal',NULL,'2024-06-06 14:49:34','2024-06-08 10:53:31'),(NULL,8,'maysam','alsweed','0968397446',NULL,'$2y$10$QfefnOb1PZdY6g44J8CSCuS2kPCkwTKjTij3H4.DHU2wgV8DA/WfC','male','2003-01-21','Al-Suwayda','1',1,1,'normal','normal',NULL,'2024-06-07 11:16:30','2024-06-07 11:19:47'),(NULL,9,'dgsg','gsbsb','0963569853',NULL,NULL,NULL,NULL,NULL,NULL,0,1,'normal','normal',NULL,'2024-06-07 13:51:16','2024-06-07 13:51:19'),(NULL,10,'Ali','Ali Ahmad','0999999993',NULL,'$2y$10$koBPHCD4GHKndLzt7ztbL.0Rz3B1DhWIJ9SDmblMAOWpgvuEcJWcS','male','1993-11-26','Daraa','User_images/F033j6qmCW4tJXhcOz77PEw6P0rFq3BsBkjVkSK3.jpg',1,1,'organizer','normal',NULL,'2024-06-07 17:25:10','2024-06-08 10:38:18'),(NULL,11,'Mohammad','Ahmad','0999999995',NULL,'$2y$10$wCRS9RRGtoW/GiF6So2p7Oak/9S46PccBCCfFtZ/LyGrtpBa7LtSq','male','1985-09-02','Rif Dimashq','User_images/1000019775.webp',1,1,'service_provider','normal',NULL,'2024-06-07 17:28:00','2024-06-07 17:34:34'),(NULL,12,'Suzan','Alali','0999999994',NULL,'$2y$10$io5LbzGkSGTfr7Qp0L03Zen6oOBS6w0koF2xLGYKRY0i6FT6L/zRG','female','1994-01-23','Ḥamah','User_images/HoFhbUZZEZ1MOtLw9IuIrjHmzFvsR7KA3yqrtJ9S.jpg',1,1,'organizer','normal',NULL,'2024-06-07 17:37:42','2024-06-08 10:48:20'),(NULL,13,'Alaa','Alamry','0999999991',NULL,'$2y$10$a1j/ynVxLfxvPBbPEjujiehuyscUecXz.fyWu7Q0H3Zw1yGYF86Xe','female','1993-01-01','latakia','User_images/L2NNTBx1Awa2nZut6wpw8U6ardZdJVVX85LkUdxJ.jpg',1,1,'service_provider','normal',NULL,'2024-06-07 17:46:47','2024-06-08 08:45:01'),(NULL,14,'Ranim','Almyasy','0999999997',NULL,'$2y$10$r7G6j3d34sZuKAFy4WvKuOUYPl68bPtUCsZJeMnnGyw3BFRGofPLS','female','1994-01-01','Al-Qunayṭirah','1',1,1,'normal','normal',NULL,'2024-06-08 08:35:49','2024-06-08 08:36:59'),(NULL,15,'test','test','0958957465',NULL,'$2y$10$.rj7.vJmfIIk.vIEGGlEyu0bHwk2eqlOcC21jFzRReUGPHBo5pFoe','male','2000-01-01','Al-Ḥasakah','1',1,1,'normal','normal',NULL,'2024-06-08 09:47:38','2024-06-08 09:48:27'),(NULL,16,'cfh','yfug','0996368906',NULL,'$2y$10$2037c5D0tGpQs80PCJH8COgwerHV8DaII5IlG9DSJuK40FP9LeQee','male','2000-01-01','Tartus','1',1,1,'normal','normal',NULL,'2024-06-08 09:49:23','2024-06-08 09:51:03'),(NULL,17,'Hasan','HDR','0988134561',NULL,'$2y$10$bGwPPfzc.H5eYs9Z5PCItOnD59YYoDL.wD2E9cC.i.z29qw62HCP6','male','1993-03-08','Damascus','User_images/Czu5LRwk4AdxenXId10ObOF9E9WjRlXMnW73C8O8.jpg',1,1,'normal','normal',NULL,'2024-06-08 13:24:48','2024-06-08 13:34:30'),(NULL,18,'Raneem','shaher','0981132033',NULL,'$2y$10$ArAdlmE.hAOMJRwLZDGH1OpKuR.71vecngSgdKtDKHVFZ5rbPm51C','female','2000-01-01','Damascus','0',1,1,'normal','normal',NULL,'2024-06-09 11:42:30','2024-06-09 11:44:23'),(NULL,19,'Hasan','Hhdr','0988134562',NULL,'$2y$10$HMzhzA4xcxp9FQ3qddkF7uJ4VgbqPENpSRNE07iPV1wG2dK5z6kR6','male','1992-01-01','Tartus','2',1,1,'organizer','normal',NULL,'2024-06-09 11:56:36','2024-06-09 13:05:05'),(NULL,20,'ahmad','assi','0988020707',NULL,'$2y$10$zgID07RcGAz8CNl/RkdSPeH2IC2qTz2.39QQ.bFWH29JefXPeb7Cy','male','1994-01-01','Damascus','2',1,1,'service_provider','normal',NULL,'2024-06-09 12:29:16','2024-06-09 13:00:36'),(NULL,21,'walaa','alnouri','0935177226',NULL,'$2y$10$.NlZYT.FVC0nRNLwZ8ZyS.i1KeDZaSCVJS3V95po32VWAQADATz1C','female','1989-05-30','Damascus','0',1,1,'normal','normal',NULL,'2024-06-30 14:16:38','2024-06-30 14:18:16'),(NULL,22,'alaa','ahmad','0997608562',NULL,'$2y$10$XBzm4vlJCCF9.k8Av.n.jOpw2JfDjm.tGbAbSm.En1jOM3I9unLqy','female','1998-10-28','Damascus','0',1,1,'normal','normal',NULL,'2024-08-01 08:52:18','2024-08-01 08:54:21'),(NULL,23,'zeen','bara','0937720429',NULL,'$2y$10$yUK8sMWv5.TMktDMx8nE8.0nOktl0mBSDszl/YXaPAw8ls6gJhEOi','male','1989-08-01','Damascus','2',1,1,'normal','normal',NULL,'2024-08-01 08:58:53','2024-08-01 08:59:48'),(NULL,24,'diana','diana','0999999999',NULL,'$2y$10$/npU8jpOndrjXnQD6j7xYOwgiiSUzYPuvUZFnDU.a4kavebVVBm5C','female','2000-01-01','Damascus','1',1,1,'service_provider','normal',NULL,'2024-08-03 09:33:44','2024-08-06 14:17:41'),(NULL,25,'Mohammad','Daghistani','0937755544',NULL,'$2y$10$EexvhBzy9l44CnlW8s32Z./P67LhFJjN5Wo6wEV4ZI52BiIAQ/PIK','male','1989-09-03','Damascus','User_images/ecEnx4Pm2AV3biXeRWaXOieg9mzZxzxXINKyciwW.jpg',1,1,'organizer','normal',NULL,'2024-08-03 14:49:47','2024-08-04 08:56:58'),(NULL,26,'Roaa','Hokan','0996222228',NULL,'$2y$10$PQSX40w/8AvYmxXLqMJq9.dr.3fIFoEeipnWCJf.MiAfMuXQB7oIm','female','1983-10-09','Damascus','User_images/PrmFYFDM5z04wrPpjT0PnnCRzCTDW7l5ydabsq87.jpg',1,1,'service_provider','normal',NULL,'2024-08-03 16:13:57','2024-08-04 11:10:39'),(NULL,27,'Hasan','HDR','0988134566',NULL,'$2y$10$E7b6MOwheu81TbXEdyZRaejR8.WWdCu.dlSWncYLEbQsBEWQUsw6.','male','1997-03-08','Damascus','User_images/ZykhqfhI0N5q04KsG5JUYPo1Kb4VJUpMGKCpTKMW.jpg',1,1,'normal','normal',NULL,'2024-08-03 20:46:35','2024-08-03 20:47:48'),(NULL,28,'adam','adam','0965896589',NULL,'$2y$10$a9Fyf57dw66JqGjHzlP/Ge6lcA8y8IldVCbmnCm9HnRmNk/9AFecC','male','2000-08-01','Al-Raqqah','1',1,1,'normal','normal',NULL,'2024-08-04 16:01:33','2024-08-04 16:02:19'),('2024-08-05 11:25:02',29,'رزان','إسماعيل','0998833123',NULL,'$2y$10$HqAL1/GnjY1i6XIjO8rJnO8EeH2ectiX7kNxup7TruxYYj0oSRxQW','female','1993-08-26','Damascus','1',1,1,'organizer','normal',NULL,'2024-08-05 11:17:53','2024-08-05 11:25:02'),(NULL,30,'HDR','HDR','0988134569',NULL,'$2y$10$jYjRQ65QGnl3vsZNP416u.fQmyF7TftC0pq3Ia1FtHyHrAMwTRVFa','male','1997-03-08','Damascus','User_images/UjGKhazPJsgq4LerJAYmXlJG7zwzKAoh8qaj3XGA.jpg',1,1,'organizer','normal',NULL,'2024-08-05 17:07:40','2024-08-09 22:18:57'),(NULL,31,'Mogammad','Daghistani','0955399547',NULL,'$2y$10$VocVLUjW4GOOxnE4z55Cq.JWVWAMKiTbyaYKPXTCNyqyXjG2scCu.','male','1989-09-03','Damascus','2',1,1,'organizer','normal',NULL,'2024-08-06 08:59:57','2024-08-06 09:04:22'),(NULL,32,'alaa','alaa','0900000000',NULL,'$2y$10$BcLXPHv0XoDlBIxL9IB4reyFUx9pLQmXsDlGvBCZML2.IxpFWVOe6','female','2000-01-01','Aleppo','1',1,1,'normal','normal',NULL,'2024-08-06 10:48:28','2024-08-06 10:55:03'),(NULL,33,'haidar','haidar','0999999998',NULL,'$2y$10$HzahqhDTUjBjBKi9RTDysenwDRP2PfJLC1D9uiCrnr1CbfO7oP8oS','female','1997-01-01','Al-Raqqah','2',1,1,'service_provider','normal',NULL,'2024-08-06 11:27:23','2024-08-07 14:32:44'),(NULL,34,'alaa','ahmad','0934344689',NULL,NULL,NULL,NULL,NULL,NULL,0,1,'normal','normal',NULL,'2024-08-06 15:29:54','2024-08-06 15:53:52'),(NULL,35,'alaa','alaa','0999999933',NULL,NULL,NULL,NULL,NULL,NULL,0,1,'normal','normal',NULL,'2024-08-06 16:34:05','2024-08-06 16:34:06'),(NULL,36,'ibrahim','alaa','0999999333',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'normal','normal',NULL,'2024-08-06 16:35:01','2024-08-06 16:35:09'),(NULL,37,'ibrahim','ibrahim','0933333333',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'normal','normal',NULL,'2024-08-06 16:35:24','2024-08-06 16:35:32'),(NULL,38,'ibrahim','ibrahim','0933333336',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'normal','normal',NULL,'2024-08-06 16:35:38','2024-08-06 16:35:38'),(NULL,39,'ali','ali','0999999977',NULL,'$2y$10$wb/2JMjE0CbbatCWHYBxRO8dWEmmA4Es/gJR98Atkw6ruykqRMLs2','male','1996-01-01','Aleppo','3',1,1,'normal','normal',NULL,'2024-08-06 16:36:10','2024-08-06 16:36:39'),(NULL,40,'aafsd','sssdfsd','0988888888',NULL,'$2y$10$cIkVd69coN0E3l538DD0EOZpbp.okg4Iuq9C2tUfH6ZJ/ZsagAdN6','male','2000-01-01','Dayr al-Zawr','4',1,1,'normal','normal',NULL,'2024-08-07 12:19:19','2024-08-07 12:20:11'),(NULL,41,'gxjhcc','hgvcc','0999999992',NULL,'$2y$10$BKz8/8Pvu/gTEbgVqLOOmuiUnjP9CaHcTEBb2Af3Q5jvkGQIDPGFq','female','2000-01-01','Tartus','8',1,1,'normal','normal',NULL,'2024-08-07 15:15:42','2024-08-07 15:16:07'),(NULL,42,'omar','al khaldi','0992555775',NULL,'$2y$10$JzHGlPeAJWGKnPeq1Sa5qeb18FxrNlBaPx9Jwm5/gZ4JWA9k8rnqK','male','1994-12-20','Damascus','2',1,1,'normal','normal',NULL,'2024-08-10 11:13:15','2024-08-10 11:14:15');
/*!40000 ALTER TABLE `mobile_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User\\User',1),(1,'App\\Models\\User\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `seen_type` tinyint(1) NOT NULL DEFAULT '0',
  `live_type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_index` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',1,1,1,'2024-06-09 13:11:04','2024-08-07 16:16:39'),(2,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',2,0,0,'2024-06-09 13:11:04','2024-06-09 13:11:04'),(3,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',3,0,0,'2024-06-09 13:11:04','2024-06-09 13:11:04'),(4,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',4,0,0,'2024-06-09 13:11:04','2024-06-09 13:11:04'),(5,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',5,1,1,'2024-06-09 13:11:04','2024-08-10 12:22:20'),(6,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',6,0,0,'2024-06-09 13:11:05','2024-06-09 13:11:05'),(7,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',7,0,0,'2024-06-09 13:11:05','2024-06-09 13:11:05'),(8,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',8,0,0,'2024-06-09 13:11:05','2024-06-09 13:11:05'),(9,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',10,0,0,'2024-06-09 13:11:06','2024-06-09 13:11:06'),(10,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',11,0,0,'2024-06-09 13:11:06','2024-06-09 13:11:06'),(11,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',12,0,0,'2024-06-09 13:11:06','2024-06-09 13:11:06'),(12,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',13,0,0,'2024-06-09 13:11:06','2024-06-09 13:11:06'),(13,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',14,0,0,'2024-06-09 13:11:06','2024-06-09 13:11:06'),(14,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',15,0,0,'2024-06-09 13:11:06','2024-06-09 13:11:06'),(15,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',16,0,0,'2024-06-09 13:11:06','2024-06-09 13:11:06'),(16,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',17,0,0,'2024-06-09 13:11:07','2024-06-09 13:11:07'),(17,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',18,0,0,'2024-06-09 13:11:07','2024-06-09 13:11:07'),(18,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',19,0,0,'2024-06-09 13:11:07','2024-06-09 13:11:07'),(19,'E cash Event booking started now navigate event 11','بدأت الحجوزات navigate event 11','E cash Event booking started now','بدأت الحجوزات',20,1,1,'2024-06-09 13:11:07','2024-06-09 13:15:38'),(20,'Booked Successfully','تم الحجز بنجاح','You have booked Successfully in event','تم الحجز بنجاح',20,0,0,'2024-06-09 13:24:02','2024-06-09 13:24:02'),(21,'Ticket Resell ','إعادة بيع التذكرة','You have received a resale ticket from ahmad assi for the event [ E cash ] on [ 2024-06-17 18:00:00 ] 11','لقد تلقيت تذكرة إعادة بيع من ahmad assi للحدث [ E cash ] في [ 2024-06-17 18:00:00 ] 11',18,0,0,'2024-06-09 13:35:27','2024-06-09 13:35:27'),(22,'New Friend Request','طلب صداقة جديد','ahmad assi sent you a friend request','ahmad assi أرسل لك طلب صداقة',4,0,0,'2024-06-09 13:37:17','2024-06-09 13:37:17'),(23,'New Friend Request','طلب صداقة جديد','ahmad assi sent you a friend request','ahmad assi أرسل لك طلب صداقة',6,0,0,'2024-06-09 13:37:18','2024-06-09 13:37:18'),(24,'New Friend Request','طلب صداقة جديد','ahmad assi sent you a friend request','ahmad assi أرسل لك طلب صداقة',5,1,1,'2024-06-09 13:37:19','2024-08-10 12:22:20'),(25,'New Friend Request','طلب صداقة جديد','ahmad assi sent you a friend request','ahmad assi أرسل لك طلب صداقة',3,0,0,'2024-06-09 13:37:19','2024-06-09 13:37:19'),(26,'New Friend Request','طلب صداقة جديد','ahmad assi sent you a friend request','ahmad assi أرسل لك طلب صداقة',1,1,1,'2024-06-09 13:37:20','2024-08-07 16:16:39'),(27,'New Friend Request','طلب صداقة جديد','ahmad assi sent you a friend request','ahmad assi أرسل لك طلب صداقة',2,0,0,'2024-06-09 13:37:20','2024-06-09 13:37:20'),(28,'New Friend Request','طلب صداقة جديد','ahmad assi sent you a friend request','ahmad assi أرسل لك طلب صداقة',18,0,0,'2024-06-09 13:37:23','2024-06-09 13:37:23'),(29,'New Friend Request','طلب صداقة جديد','ahmad assi sent you a friend request','ahmad assi أرسل لك طلب صداقة',19,0,0,'2024-06-09 13:37:23','2024-06-09 13:37:23'),(30,'New Friend','صديق جديد','Haidar Tarboush has accepted your friend request','Haidar Tarboush قبل طلب صداقتك',20,0,0,'2024-06-09 13:38:14','2024-06-09 13:38:14'),(31,'New Friend Request','طلب صداقة جديد','maysam sweid sent you a friend request','maysam sweid أرسل لك طلب صداقة',5,1,1,'2024-08-10 03:38:42','2024-08-10 12:22:20'),(32,'New Friend','صديق جديد','Haidar Tarboush has accepted your friend request','Haidar Tarboush قبل طلب صداقتك',2,0,0,'2024-08-10 03:39:18','2024-08-10 03:39:18');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `event_id` bigint unsigned NOT NULL,
  `percent` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offers_event_id_foreign` (`event_id`),
  CONSTRAINT `offers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES (3,'2024-08-09 23:19:05',61,10,'2024-08-08 09:44:00','2024-08-09 23:19:05','percent'),(4,'2024-08-10 09:08:40',69,20,'2024-08-09 22:31:58','2024-08-10 09:08:40','percent'),(5,NULL,69,10000,'2024-08-09 22:33:30','2024-08-09 22:33:30','amount'),(6,'2024-08-09 23:19:08',67,2222,'2024-08-09 22:53:24','2024-08-09 23:19:08','amount'),(7,'2024-08-09 23:19:11',18,20,'2024-08-09 23:14:14','2024-08-09 23:19:11','percent'),(8,NULL,67,22,'2024-08-09 23:32:15','2024-08-09 23:32:15','percent'),(9,NULL,20,15,'2024-08-10 08:35:02','2024-08-10 08:35:02','percent'),(10,NULL,70,10,'2024-08-10 08:55:46','2024-08-10 08:55:46','percent'),(11,NULL,72,10000,'2024-08-10 12:51:53','2024-08-10 12:51:53','amount');
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizer_albums`
--

DROP TABLE IF EXISTS `organizer_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizer_albums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `organizer_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organizer_albums_organizer_id_foreign` (`organizer_id`),
  CONSTRAINT `organizer_albums_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `organizers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizer_albums`
--

LOCK TABLES `organizer_albums` WRITE;
/*!40000 ALTER TABLE `organizer_albums` DISABLE KEYS */;
INSERT INTO `organizer_albums` VALUES (1,1,'Eventa','[\"OrganizerImages/UFMGmujNAsCg1NVXc92t6javBHED5nPapW9sPWL2.jpg\", \"OrganizerImages/GxEJHIxb0MPYuQEwY7Aql5vCt7vsB70bpNiUtDNP.jpg\"]',NULL,'2024-06-05 16:11:50','2024-06-05 16:11:50'),(2,2,'Events','[\"OrganizerImages/1000019776.jpg\", \"OrganizerImages/1000019775.webp\"]',NULL,'2024-06-07 17:26:57','2024-06-07 17:26:57'),(3,3,'Events','[\"OrganizerImages/1000019773.jpg\", \"OrganizerImages/1000019774.jpg\"]',NULL,'2024-06-07 17:40:46','2024-06-07 17:40:46'),(4,4,'Archive','[\"OrganizerImages/oMFe3wU99CyZphrWLXaNR3kkVtaWySHcD5qCaEdc.png\", \"OrganizerImages/m33JE38Eyjo80GxDJK4L6j2wDVQTAm1BFhQInknx.jpg\", \"OrganizerImages/oc8v906S6jAFNsfYd3BKPQh6FTLdaSFZsEYIcrli.jpg\", \"OrganizerImages/az8r7sDJYPMrgBU63xfOn0ZM4bMIcrGf2FcBaRP1.jpg\"]',NULL,'2024-06-08 11:08:03','2024-06-08 11:08:03'),(5,5,'Starter','[\"OrganizerImages/aUwhkVDhvfQNyZzA1cXnXbB7VveY9glVykRJTWIw.jpg\"]',NULL,'2024-06-09 13:05:05','2024-06-09 13:05:05'),(6,9,'A','[\"OrganizerImages/CJRQlC7iDUFGolNkUinyNEs7QusXLkKodC0XkKMg.jpg\", \"OrganizerImages/1msC3rUbZ0Z37myTwZ9BduMB3afbzWXganEC9Llx.jpg\", \"OrganizerImages/vb5OQuUSJsYvz9VCicp2ZGrGycL2OqAQ8liI3wu0.jpg\"]',NULL,'2024-08-09 22:18:57','2024-08-09 22:18:57');
/*!40000 ALTER TABLE `organizer_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizer_categories`
--

DROP TABLE IF EXISTS `organizer_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizer_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_category_id` bigint unsigned NOT NULL,
  `organizer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organizer_categories_event_category_id_foreign` (`event_category_id`),
  KEY `organizer_categories_organizer_id_foreign` (`organizer_id`),
  CONSTRAINT `organizer_categories_event_category_id_foreign` FOREIGN KEY (`event_category_id`) REFERENCES `event_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `organizer_categories_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `organizers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizer_categories`
--

LOCK TABLES `organizer_categories` WRITE;
/*!40000 ALTER TABLE `organizer_categories` DISABLE KEYS */;
INSERT INTO `organizer_categories` VALUES (1,4,1,NULL,NULL),(2,2,2,NULL,NULL),(3,3,2,NULL,NULL),(4,1,2,NULL,NULL),(5,4,2,NULL,NULL),(6,5,2,NULL,NULL),(7,6,2,NULL,NULL),(8,6,3,NULL,NULL),(9,5,3,NULL,NULL),(10,4,3,NULL,NULL),(11,4,4,NULL,NULL),(12,5,4,NULL,NULL),(13,1,5,NULL,NULL),(14,2,5,NULL,NULL),(15,3,5,NULL,NULL),(16,4,5,NULL,NULL),(17,4,6,NULL,NULL),(19,4,7,NULL,NULL),(20,1,8,NULL,NULL),(21,2,8,NULL,NULL),(22,3,8,NULL,NULL),(23,4,8,NULL,NULL),(24,5,8,NULL,NULL),(25,6,8,NULL,NULL),(26,1,9,NULL,NULL),(27,2,9,NULL,NULL),(28,3,9,NULL,NULL),(29,5,9,NULL,NULL),(30,6,9,NULL,NULL),(31,4,9,NULL,NULL);
/*!40000 ALTER TABLE `organizer_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizer_follows`
--

DROP TABLE IF EXISTS `organizer_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizer_follows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mobile_user_id` bigint unsigned NOT NULL,
  `organizer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organizer_follows_mobile_user_id_index` (`mobile_user_id`),
  KEY `organizer_follows_organizer_id_index` (`organizer_id`),
  CONSTRAINT `organizer_follows_mobile_user_id_foreign` FOREIGN KEY (`mobile_user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `organizer_follows_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `organizers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizer_follows`
--

LOCK TABLES `organizer_follows` WRITE;
/*!40000 ALTER TABLE `organizer_follows` DISABLE KEYS */;
INSERT INTO `organizer_follows` VALUES (2,19,4,NULL,NULL),(3,19,3,NULL,NULL),(4,19,2,NULL,NULL),(5,19,1,NULL,NULL),(6,17,1,NULL,NULL),(7,40,6,NULL,NULL),(8,40,4,NULL,NULL),(9,1,4,NULL,NULL),(10,2,4,NULL,NULL);
/*!40000 ALTER TABLE `organizer_follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizers`
--

DROP TABLE IF EXISTS `organizers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `mobile_user_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `covering_area` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('pending','Approved') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organizers_mobile_user_id_unique` (`mobile_user_id`),
  KEY `organizers_mobile_user_id_index` (`mobile_user_id`),
  CONSTRAINT `organizers_mobile_user_id_foreign` FOREIGN KEY (`mobile_user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizers`
--

LOCK TABLES `organizers` WRITE;
/*!40000 ALTER TABLE `organizers` DISABLE KEYS */;
INSERT INTO `organizers` VALUES (1,NULL,6,'Spark','Service provider','Dayr al-Zawr, Ḥamah, Homs, Damascus',NULL,'OrganizerProfile/zh1IsDBvKSBSLV654tRnDZF30snn4GTAKO6Cybsi.jpg','OrganizerCover/VuoztY89EIN3W5iknGA3zXpYbSQsbLeze8roHRRw.jpg','Approved','2024-06-05 16:11:50','2024-06-08 11:34:12'),(2,NULL,10,'NB organization','Event organizer','Ḥamah, Homs, Dayr al-Zawr',NULL,'OrganizerProfile/GUELvJythD3cyzML0basWn54vTsYBf9U2zpKak0k.jpg','OrganizerCover/1000019772.jpg','Approved','2024-06-07 17:26:57','2024-06-08 10:38:02'),(3,NULL,12,'SA organization','Professional event organizer','Daraa, Rif Dimashq, latakia',NULL,'OrganizerProfile/qAEmP3udvdiPo2GSFZjIxaqdZK3fQhFVviW9UQEj.jpg','OrganizerCover/1000019785.png','Approved','2024-06-07 17:40:46','2024-06-08 10:47:53'),(4,NULL,5,'HDR','Event organizer','Damascus, Tartus, latakia',NULL,'OrganizerProfile/RC3QozQeW8fHTx3qjix0hWOWHm3pMBKJOhAKW4WZ.jpg','OrganizerCover/iFg02CAISZLoajmxksWYJi1HUJHN3MHxUpjlmfm6.jpg','Approved','2024-06-08 11:08:03','2024-06-08 11:08:18'),(5,NULL,19,'E cash','bio','حلب, الحسكة, القنيطرة, الرقة, السويداء, دمشق, درعا, دير الزور',NULL,'OrganizerProfile/mXRDGzTgMHqKDIJKqv1GqsGIeSmOqLvNB5uHo3X3.jpg','OrganizerCover/HvNGgwletABPnJ6CusXzNXrMzNdA86xzL5LXHdlq.jpg','Approved','2024-06-09 13:05:05','2024-06-09 13:05:16'),(6,NULL,25,'Siin Experience & UTU Nightlife','Event Planner','حلب, الحسكة, القنيطرة, الرقة, السويداء, درعا, دير الزور, دمشق, حماة, حمص, طرطوس, إدلب, اللاذقية, ريف دمشق','Event','OrganizerProfile/F4dGFMHKCRlEMZtDVkMnjLQZldgVMDIbrolvL5oA.jpg','OrganizerCover/0vlnzVjWUw8nq0K0judSzU373LS9nlU74hJcBu4p.jpg','Approved','2024-08-04 08:56:58','2024-08-04 10:28:01'),(7,NULL,29,'jci','منظم حفلات','دمشق',NULL,'OrganizerProfile/z6L1dyvJI9jWCe38DIY9jtS5dOTfT8IQMXCq7Yef.jpg','OrganizerCover/0ugH2lwgVNEjD4LCrzTXw01s8mX2eLpscpNdIGKk.jpg','Approved','2024-08-05 11:22:41','2024-08-05 11:23:32'),(8,NULL,31,'JCI Damascus','JCI (Junior Chamber International) is a worldwide community of young active citizens who are changing the world, one community at a time.','Aleppo, Al-Ḥasakah, Al-Qunayṭirah, Al-Raqqah, Al-Suwayda, Damascus, Daraa, Dayr al-Zawr, Ḥamah, Homs, Tartus, Idlib, latakia, Rif Dimashq',NULL,'OrganizerProfile/dBFfOlIXKihmWH6CetNa8bGwMW3hRz9lYFFCDnRy.jpg','OrganizerCover/uOJma8lJKmMKForLWO1wTdLNQR5nBzPL1RVjWzjQ.jpg','Approved','2024-08-06 09:04:22','2024-08-06 09:09:43'),(9,NULL,30,'Organizador','Event Planner','Aleppo, Al-Ḥasakah, Al-Qunayṭirah, Damascus, Daraa, Ḥamah, Homs',NULL,'OrganizerProfile/9On5vd7jzLkM8cLIwWxP9ftTOrrubqBckfVTp0Mu.jpg','OrganizerCover/YiRQYGUz5upP10nN1Nz9xlrssuNqorMc4zSLBKab.jpg','pending','2024-08-09 22:18:57','2024-08-09 22:18:57');
/*!40000 ALTER TABLE `organizers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otp_verification_codes`
--

DROP TABLE IF EXISTS `otp_verification_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otp_verification_codes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otp_verification_codes`
--

LOCK TABLES `otp_verification_codes` WRITE;
/*!40000 ALTER TABLE `otp_verification_codes` DISABLE KEYS */;
INSERT INTO `otp_verification_codes` VALUES (1,'0958957464','2110','2024-06-05 15:07:12','2024-06-05 14:57:12','2024-06-05 14:57:12'),(3,'0968397449','9447','2024-06-05 15:23:53','2024-06-05 15:13:53','2024-06-05 15:13:53'),(5,'0988020706','2818','2024-06-05 15:30:37','2024-06-05 15:20:37','2024-06-05 15:20:37'),(7,'0996368902','7057','2024-06-05 15:30:44','2024-06-05 15:20:44','2024-06-05 15:20:44'),(9,'0937755273','4215','2024-06-05 16:03:22','2024-06-05 15:53:22','2024-06-05 15:53:22'),(11,'0999999990','9096','2024-06-05 16:19:19','2024-06-05 16:09:19','2024-06-05 16:09:19'),(13,'0999999996','8667','2024-06-06 14:59:34','2024-06-06 14:49:34','2024-06-06 14:49:34'),(15,'0968397446','5662','2024-06-07 11:26:30','2024-06-07 11:16:30','2024-06-07 11:16:30'),(17,'0963569853','8668','2024-06-07 14:01:16','2024-06-07 13:51:16','2024-06-07 13:51:16'),(19,'0999999993','5459','2024-06-07 17:35:10','2024-06-07 17:25:10','2024-06-07 17:25:10'),(21,'0999999995','3954','2024-06-07 17:38:00','2024-06-07 17:28:00','2024-06-07 17:28:00'),(23,'0999999994','9225','2024-06-07 17:47:42','2024-06-07 17:37:42','2024-06-07 17:37:42'),(25,'0999999991','7384','2024-06-07 17:56:47','2024-06-07 17:46:47','2024-06-07 17:46:47'),(27,'0999999997','2173','2024-06-08 08:45:49','2024-06-08 08:35:49','2024-06-08 08:35:49'),(29,'0958957465','9352','2024-06-08 09:57:38','2024-06-08 09:47:38','2024-06-08 09:47:38'),(31,'0996368906','5894','2024-06-08 09:59:23','2024-06-08 09:49:23','2024-06-08 09:49:23'),(33,'0999999990','2274','2024-06-08 11:27:32','2024-06-08 11:17:32','2024-06-08 11:17:32'),(34,'0988134561','1986','2024-06-08 13:34:48','2024-06-08 13:24:48','2024-06-08 13:24:48'),(36,'0981132033','6083','2024-06-09 11:52:30','2024-06-09 11:42:30','2024-06-09 11:42:30'),(38,'0988134562','4465','2024-06-09 12:06:36','2024-06-09 11:56:36','2024-06-09 11:56:36'),(40,'0988020707','4088','2024-06-09 12:39:16','2024-06-09 12:29:16','2024-06-09 12:29:16'),(42,'0935177226','6310','2024-06-30 14:26:38','2024-06-30 14:16:38','2024-06-30 14:16:38'),(45,'0997608562','3467','2024-08-01 09:02:18','2024-08-01 08:52:18','2024-08-01 08:52:18'),(47,'0937720429','2575','2024-08-01 09:08:53','2024-08-01 08:58:53','2024-08-01 08:58:53'),(49,'0999999999','1557','2024-08-03 09:43:44','2024-08-03 09:33:44','2024-08-03 09:33:44'),(51,'0937755544','2670','2024-08-03 14:59:47','2024-08-03 14:49:47','2024-08-03 14:49:47'),(53,'0996222228','4060','2024-08-03 16:23:57','2024-08-03 16:13:57','2024-08-03 16:13:57'),(55,'0988134566','2485','2024-08-03 20:56:35','2024-08-03 20:46:35','2024-08-03 20:46:35'),(57,'0965896589','9380','2024-08-04 16:11:33','2024-08-04 16:01:33','2024-08-04 16:01:33'),(59,'0998833123','9561','2024-08-05 11:27:53','2024-08-05 11:17:53','2024-08-05 11:17:53'),(61,'0988134569','5092','2024-08-05 17:17:40','2024-08-05 17:07:40','2024-08-05 17:07:40'),(63,'0955399547','3612','2024-08-06 09:09:57','2024-08-06 08:59:57','2024-08-06 08:59:57'),(65,'0900000000','5392','2024-08-06 10:58:28','2024-08-06 10:48:28','2024-08-06 10:48:28'),(67,'0999999998','1376','2024-08-06 11:37:23','2024-08-06 11:27:23','2024-08-06 11:27:23'),(69,'0934344689','1746','2024-08-06 15:39:54','2024-08-06 15:29:54','2024-08-06 15:29:54'),(72,'0999999933','4786','2024-08-06 16:44:05','2024-08-06 16:34:05','2024-08-06 16:34:05'),(74,'0999999333','2682','2024-08-06 16:45:01','2024-08-06 16:35:01','2024-08-06 16:35:01'),(75,'0999999333','8829','2024-08-06 16:45:09','2024-08-06 16:35:09','2024-08-06 16:35:09'),(76,'0999999333','7781','2024-08-06 16:45:15','2024-08-06 16:35:15','2024-08-06 16:35:15'),(77,'0933333333','4787','2024-08-06 16:45:24','2024-08-06 16:35:24','2024-08-06 16:35:24'),(78,'0933333333','3199','2024-08-06 16:45:32','2024-08-06 16:35:32','2024-08-06 16:35:32'),(79,'0933333336','9980','2024-08-06 16:45:38','2024-08-06 16:35:38','2024-08-06 16:35:38'),(80,'0999999977','3503','2024-08-06 16:46:10','2024-08-06 16:36:10','2024-08-06 16:36:10'),(82,'0988888888','7017','2024-08-07 12:29:19','2024-08-07 12:19:19','2024-08-07 12:19:19'),(85,'0999999992','7350','2024-08-07 15:25:42','2024-08-07 15:15:42','2024-08-07 15:15:42'),(87,'0937755273','6840','2024-08-10 02:43:15','2024-08-10 02:33:15','2024-08-10 02:33:15'),(88,'0992555775','9337','2024-08-10 11:23:15','2024-08-10 11:13:15','2024-08-10 11:13:15');
/*!40000 ALTER TABLE `otp_verification_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint NOT NULL,
  `operation_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_id` bigint NOT NULL,
  `status` enum('pending','paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_invoice_id_unique` (`invoice_id`),
  UNIQUE KEY `payments_external_id_unique` (`external_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100073 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (100070,7916451081629094122,'7237031616124006',8777737211106278055,'pending','2024-06-09 13:23:00','2024-06-09 13:23:02'),(100072,5917231457186354923,'7247031616124937',1108559736609671825,'pending','2024-06-09 13:24:02','2024-06-09 13:24:03');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (10,'App\\Models\\User\\MobileUser',8,'Api Token','f42827fcd6bbfa138868087ce3824d529ac086fc25aeb18bae233a002c855ad9','[\"*\"]','2024-06-07 11:19:47',NULL,'2024-06-07 11:17:50','2024-06-07 11:19:47'),(11,'App\\Models\\User\\MobileUser',8,'API TOKEN','0aea2284c1152af3e593f20bc5bc30d1a76a4680a86849c36caeb6ce3e9f1617','[\"*\"]','2024-06-07 15:21:17',NULL,'2024-06-07 11:20:27','2024-06-07 15:21:17'),(12,'App\\Models\\User\\MobileUser',9,'Api Token','abfa81f9797414e726acb6b5c7ab2f1b82c54d64b3d7aba24c337b9671db88d7','[\"*\"]',NULL,NULL,'2024-06-07 13:51:19','2024-06-07 13:51:19'),(14,'App\\Models\\User\\MobileUser',8,'API TOKEN','85d703d14d644e1e6233da80f2f1bd80ad69fb4382288736db1d18a64d2f0c90','[\"*\"]','2024-06-08 08:23:08',NULL,'2024-06-07 14:27:50','2024-06-08 08:23:08'),(20,'App\\Models\\User\\MobileUser',8,'API TOKEN','219bc8e7a2fb006ab6bd3f71ce9b6724ad9f55740bab451d405998bd54bc2077','[\"*\"]','2024-06-08 08:58:29',NULL,'2024-06-08 08:30:59','2024-06-08 08:58:29'),(51,'App\\Models\\User\\MobileUser',18,'Api Token','0ef7ad7c1f106c2eebf7f1c28a7af1592c493ef6daa8b6e89efa12e1e519a7a5','[\"*\"]','2024-07-28 12:27:03',NULL,'2024-06-09 11:42:42','2024-07-28 12:27:03'),(56,'App\\Models\\User\\MobileUser',12,'API TOKEN','8179d26b7abea1523cff1b9e7c7cd3980d5a86f2bdb8e4f00a9f93bbab5fcce7','[\"*\"]','2024-08-09 11:21:52',NULL,'2024-06-09 13:42:42','2024-08-09 11:21:52'),(57,'App\\Models\\User\\MobileUser',21,'Api Token','4056a8ccc15bfa178b67090f38cb6116a36f8f0055862eff6061721af7fcb903','[\"*\"]',NULL,NULL,'2024-06-30 14:16:46','2024-06-30 14:16:46'),(58,'App\\Models\\User\\MobileUser',21,'Api Token','8485aa5ffdaffaa5e60b21b6d806e2b79f88692e1e90a9501ab9ab4fbf6f309e','[\"*\"]','2024-08-03 09:23:25',NULL,'2024-06-30 14:17:17','2024-08-03 09:23:25'),(60,'App\\Models\\User\\MobileUser',17,'API TOKEN','5792469551abf6749e986d9ec5b238f5b5b781a3992c322ea3c68cf7fc5823b2','[\"*\"]','2024-08-01 14:04:56',NULL,'2024-07-10 12:47:40','2024-08-01 14:04:56'),(62,'App\\Models\\User\\MobileUser',22,'Api Token','a6c8c47fed4236e18fb49e2d74e309bb6b54caba7b1be39da4674203febe99b1','[\"*\"]','2024-08-01 08:54:21',NULL,'2024-08-01 08:52:28','2024-08-01 08:54:21'),(63,'App\\Models\\User\\MobileUser',8,'API TOKEN','2b4825b2ccfe9d17808578993c879da8540b17d82d1264c48bdf682d5d8c0f75','[\"*\"]','2024-08-09 15:20:13',NULL,'2024-08-01 08:57:40','2024-08-09 15:20:13'),(77,'App\\Models\\User\\MobileUser',26,'Api Token','9466d27606879da5ebc0763bfb8d700b4732e4b852cda9a6932f23327229c138','[\"*\"]','2024-08-08 07:42:10',NULL,'2024-08-03 16:14:02','2024-08-08 07:42:10'),(84,'App\\Models\\User\\MobileUser',27,'Api Token','818ab76c2eef364bdf94ef4bd90a4c805ad5807e13d3bc436d694f0958a46a0f','[\"*\"]','2024-08-03 20:48:48',NULL,'2024-08-03 20:46:37','2024-08-03 20:48:48'),(105,'App\\Models\\User\\MobileUser',1,'API TOKEN','af11f50d8aace1e0ba5368090358a945421b87baddf7f58ed0a899ee10249aee','[\"*\"]','2024-08-05 10:20:45',NULL,'2024-08-04 14:22:50','2024-08-05 10:20:45'),(108,'App\\Models\\User\\MobileUser',1,'API TOKEN','f8de27f543bc4ca3e487447326094b4c16cc8b1cd206bfe8ec2abdeae0240bb7','[\"*\"]','2024-08-06 13:28:04',NULL,'2024-08-04 17:04:09','2024-08-06 13:28:04'),(112,'App\\Models\\User\\MobileUser',1,'API TOKEN','2e841fc9775d0192ddbf51b6b0936592da89336d37069afc48c3a8c5341e8190','[\"*\"]','2024-08-05 11:22:58',NULL,'2024-08-05 10:22:42','2024-08-05 11:22:58'),(125,'App\\Models\\User\\MobileUser',30,'Api Token','646dd545a81fab71d7d45b93477c6eb2a83491862a604fd50fcfe35d8a311bc4','[\"*\"]','2024-08-05 21:36:29',NULL,'2024-08-05 17:07:42','2024-08-05 21:36:29'),(137,'App\\Models\\User\\MobileUser',30,'API TOKEN','c823fdd4773aa0dfd4dde32b8487e8b787f527cf8a8d442312522a4f001099b9','[\"*\"]','2024-08-06 10:55:23',NULL,'2024-08-06 10:20:32','2024-08-06 10:55:23'),(140,'App\\Models\\User\\MobileUser',32,'Api Token','970b59665a14417f20d5341124b89896bae1befb007c7500ba61832cc6e28030','[\"*\"]','2024-08-06 10:55:07',NULL,'2024-08-06 10:48:29','2024-08-06 10:55:07'),(144,'App\\Models\\User\\MobileUser',33,'Api Token','7dc9a0e2064a6408034bf2b9366e1460a4ccc68fc0c93d2ff75f4d09f3e7e0d1','[\"*\"]',NULL,NULL,'2024-08-06 11:27:29','2024-08-06 11:27:29'),(148,'App\\Models\\User\\MobileUser',30,'API TOKEN','0f7ecb877f2a327e5ae6827c720ceda1ccfc277e2260cc92043101579417b1eb','[\"*\"]','2024-08-06 11:54:14',NULL,'2024-08-06 11:53:25','2024-08-06 11:54:14'),(156,'App\\Models\\User\\MobileUser',17,'API TOKEN','31a4cb9f243854cb4fa56ca22b2fba56ed7323d2a0fbfff58a8846ecc60ff2f2','[\"*\"]','2024-08-06 18:05:10',NULL,'2024-08-06 15:14:50','2024-08-06 18:05:10'),(157,'App\\Models\\User\\MobileUser',34,'Api Token','910bf85d8381765d4956e9645ea66396a14bc221e86ea7b093bd6ecaa7cd9362','[\"*\"]',NULL,NULL,'2024-08-06 15:30:01','2024-08-06 15:30:01'),(158,'App\\Models\\User\\MobileUser',34,'Api Token','dce578d2a7f014ad0926a9f127f1c9af86bde991b73934f51ff04a1e36cce376','[\"*\"]','2024-08-06 17:07:55',NULL,'2024-08-06 15:53:52','2024-08-06 17:07:55'),(163,'App\\Models\\User\\MobileUser',35,'Api Token','85eb0b7937bda6f659f7187bcaaabc629a37ff15b20f69860fe2818ecfe9e51a','[\"*\"]','2024-08-06 16:34:54',NULL,'2024-08-06 16:34:06','2024-08-06 16:34:54'),(164,'App\\Models\\User\\MobileUser',39,'Api Token','525ac87d280fe352d2c948088f8ab7fac313d2bc6dc81ef6f228dc20fb52e9fc','[\"*\"]','2024-08-06 16:39:26',NULL,'2024-08-06 16:36:12','2024-08-06 16:39:26'),(168,'App\\Models\\User\\MobileUser',17,'API TOKEN','8aeb13b01483cf53d501073fdbb2d22b6e343d8c0c01d5acfdf678ba0122be9c','[\"*\"]','2024-08-06 18:06:51',NULL,'2024-08-06 18:06:20','2024-08-06 18:06:51'),(169,'App\\Models\\User\\MobileUser',25,'API TOKEN','4198ab7c7f68b4a2994f42c3cb2649687b62b75b5856c0e90b5036a9368ffcd6','[\"*\"]','2024-08-08 08:43:48',NULL,'2024-08-07 08:55:42','2024-08-08 08:43:48'),(172,'App\\Models\\User\\MobileUser',33,'Api Token','ef0e51d2f52f668041953752144c21a616b23841235b821708e80ca66479385e','[\"*\"]','2024-08-07 14:32:44',NULL,'2024-08-07 14:31:25','2024-08-07 14:32:44'),(173,'App\\Models\\User\\MobileUser',41,'Api Token','3c51eb5d58f64d9bd412f94a46e52d94cb176d317343e5075e0f8546d1784447','[\"*\"]','2024-08-07 15:43:19',NULL,'2024-08-07 15:15:44','2024-08-07 15:43:19'),(174,'App\\Models\\User\\MobileUser',24,'API TOKEN','d6cabae3ba946b7b32dcd9d65242f41ce4449b149b1bdce455c0b44c32d358df','[\"*\"]','2024-08-07 16:00:07',NULL,'2024-08-07 15:59:50','2024-08-07 16:00:07'),(175,'App\\Models\\User\\MobileUser',1,'API TOKEN','21f3e1a91656f43e79f0a4ba78d268a9ba04c4d3f8beab3509e95730703c80cc','[\"*\"]','2024-08-07 16:16:39',NULL,'2024-08-07 16:15:12','2024-08-07 16:16:39'),(176,'App\\Models\\User\\MobileUser',24,'API TOKEN','9e7592b8297a2229949afe2a7e73aa42d6cc4518361bbb37d9d003c4f106ddce','[\"*\"]','2024-08-08 11:54:27',NULL,'2024-08-07 16:24:01','2024-08-08 11:54:27'),(178,'App\\Models\\User\\MobileUser',30,'API TOKEN','12e2e528b807c2e79f29c70ec22475705aee739fa67a221fbff2dfad2c49054a','[\"*\"]','2024-08-08 12:48:47',NULL,'2024-08-07 16:50:21','2024-08-08 12:48:47'),(179,'App\\Models\\User\\MobileUser',5,'API TOKEN','734b1091c017522e52788c7c9bdeedca1f25351a9d9a457452e5d7ade4c69b76','[\"*\"]','2024-08-08 12:30:47',NULL,'2024-08-08 11:11:05','2024-08-08 12:30:47'),(180,'App\\Models\\User\\MobileUser',8,'API TOKEN','951660ef2b08cc004cfa4f2595aa0ecc0aa07cae0fa4c347ab938eddc6989de1','[\"*\"]',NULL,NULL,'2024-08-08 11:49:20','2024-08-08 11:49:20'),(182,'App\\Models\\User\\MobileUser',24,'API TOKEN','576f00b1d4580698cca123882a30125442a024d421476c6a76c78d703400982e','[\"*\"]','2024-08-08 13:13:33',NULL,'2024-08-08 13:12:42','2024-08-08 13:13:33'),(183,'App\\Models\\User\\MobileUser',30,'API TOKEN','660c415e3661d67ff50870ef4d4240b89c060eaaddfb74de55a06121b77f81e4','[\"*\"]','2024-08-09 00:15:47',NULL,'2024-08-08 13:19:30','2024-08-09 00:15:47'),(184,'App\\Models\\User\\MobileUser',24,'API TOKEN','c1821b7ea97c8a150e72a3f7d43e7ba7e257213a7313a5b3925b41a4ca51267e','[\"*\"]','2024-08-08 13:46:19',NULL,'2024-08-08 13:45:04','2024-08-08 13:46:19'),(185,'App\\Models\\User\\MobileUser',24,'API TOKEN','749c113975b37c112b11e553705f72256b692b4fccc64b14b021cba536eb2629','[\"*\"]','2024-08-09 09:32:21',NULL,'2024-08-08 14:17:50','2024-08-09 09:32:21'),(187,'App\\Models\\User\\MobileUser',5,'API TOKEN','54d0cd645651610a4cfb84b3f9bb5c75efdb5a4706acf74dcfd283fb7c820995','[\"*\"]','2024-08-08 17:32:24',NULL,'2024-08-08 17:04:28','2024-08-08 17:32:24'),(188,'App\\Models\\User\\MobileUser',5,'API TOKEN','811ec5c9e79a383be5088b3fa0f8144b07e54e0483ba219bddb08949f0b294b5','[\"*\"]','2024-08-08 18:02:35',NULL,'2024-08-08 17:45:18','2024-08-08 18:02:35'),(189,'App\\Models\\User\\MobileUser',25,'API TOKEN','8c617e4804ca9c1df478a55a4adc65127e7d30c5cc0815723fd0e6f5888321c4','[\"*\"]','2024-08-10 14:10:40',NULL,'2024-08-08 18:20:39','2024-08-10 14:10:40'),(190,'App\\Models\\User\\MobileUser',5,'API TOKEN','384a4a39c557052e2c5163b8d2fa51844ad58eddd9b1c2f7a534e394f60ec1a6','[\"*\"]','2024-08-09 14:51:34',NULL,'2024-08-09 09:55:03','2024-08-09 14:51:34'),(191,'App\\Models\\User\\MobileUser',24,'API TOKEN','96e6521bf5c681fde27ec0785f7cf915c8c50e3c18952716c64d4205fc5b58fd','[\"*\"]','2024-08-09 10:57:56',NULL,'2024-08-09 10:56:35','2024-08-09 10:57:56'),(194,'App\\Models\\User\\MobileUser',30,'API TOKEN','ea973ac2e3a34c5fae3d0033c8c66951f048ec344e8f0312f5a0b2db18b460bd','[\"*\"]','2024-08-10 01:09:29',NULL,'2024-08-09 13:38:42','2024-08-10 01:09:29'),(195,'App\\Models\\User\\MobileUser',24,'API TOKEN','872fa13580c170ee7f6efcbe7075a5a31f7ab4aab79d5e6e0a6b9bd85e8f27c4','[\"*\"]','2024-08-09 15:00:53',NULL,'2024-08-09 14:34:03','2024-08-09 15:00:53'),(196,'App\\Models\\User\\MobileUser',5,'API TOKEN','6cd030933835eacad3677d1c987a136b67c6c13486322707f55b8b1c0a1a7d45','[\"*\"]','2024-08-09 16:52:29',NULL,'2024-08-09 14:53:51','2024-08-09 16:52:29'),(197,'App\\Models\\User\\MobileUser',5,'API TOKEN','d4d8611fe7f6086db510d7a85fdeaeb10d129267e46a2ee6a6bf6b1e77e9dac2','[\"*\"]','2024-08-10 07:51:06',NULL,'2024-08-09 15:05:28','2024-08-10 07:51:06'),(198,'App\\Models\\User\\MobileUser',5,'API TOKEN','a925965301fa79636238f258a88d3db7f8962df3452994e01b5fd1bdc375d775','[\"*\"]','2024-08-09 15:26:02',NULL,'2024-08-09 15:21:04','2024-08-09 15:26:02'),(199,'App\\Models\\User\\MobileUser',5,'API TOKEN','ba76f064c8cf8057a5963e034782b1bda03cea97c5a18f901eda5846f9fba937','[\"*\"]','2024-08-10 12:58:08',NULL,'2024-08-10 02:33:54','2024-08-10 12:58:08'),(200,'App\\Models\\User\\MobileUser',2,'API TOKEN','e3215be749fea8dcdabc9471fd74497bbf12f8ca4536f188690e53c542fc1e63','[\"*\"]','2024-08-10 11:17:29',NULL,'2024-08-10 03:38:19','2024-08-10 11:17:29'),(201,'App\\Models\\User\\MobileUser',24,'API TOKEN','04d9cfe40f108a72d0a3015503bf6f850dcf0feb78a499dd4ec7035bb7028156','[\"*\"]','2024-08-10 08:41:34',NULL,'2024-08-10 07:57:43','2024-08-10 08:41:34'),(202,'App\\Models\\User\\MobileUser',2,'API TOKEN','be29a2c5f4c831fc02957ef66a7dda75042c111e81facfe7769be98c92908978','[\"*\"]','2024-08-10 08:52:38',NULL,'2024-08-10 08:20:36','2024-08-10 08:52:38'),(203,'App\\Models\\User\\MobileUser',24,'API TOKEN','2ccb6e1f03ef4fe859110ad20f146b85d01a0411df60a176db90e318ec2eb579','[\"*\"]','2024-08-10 12:46:11',NULL,'2024-08-10 09:02:09','2024-08-10 12:46:11'),(204,'App\\Models\\User\\MobileUser',42,'Api Token','a5a4eb7705aaff115d4d1fa8bdd15d5142b9e12856f0b331b3ca89861fad9dfc','[\"*\"]','2024-08-10 11:19:43',NULL,'2024-08-10 11:13:22','2024-08-10 11:19:43'),(205,'App\\Models\\User\\MobileUser',5,'API TOKEN','12e673a12cde071e016408818e4c90c9d6ba45d70f85757ffa2edad2c8c60180','[\"*\"]','2024-08-10 12:26:13',NULL,'2024-08-10 12:22:03','2024-08-10 12:26:13'),(206,'App\\Models\\User\\MobileUser',2,'API TOKEN','ddb550fe357ceae5b9bf6f94bb80afea5e929e406795ba8ee14f42e8dd2ee699','[\"*\"]','2024-08-10 12:47:21',NULL,'2024-08-10 12:47:10','2024-08-10 12:47:21'),(207,'App\\Models\\User\\MobileUser',24,'API TOKEN','38e973356ebebff58e2a28a7a297210b0f12701bb17a625cc1e75f97d55b53b8','[\"*\"]','2024-08-10 13:13:43',NULL,'2024-08-10 13:13:29','2024-08-10 13:13:43');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_codes`
--

DROP TABLE IF EXISTS `promo_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promo_codes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int NOT NULL,
  `limit` int NOT NULL,
  `start-date` datetime NOT NULL,
  `end-date` datetime NOT NULL,
  `target_categories` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_ages` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_states` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_bookings` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promo_codes_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_codes`
--

LOCK TABLES `promo_codes` WRITE;
/*!40000 ALTER TABLE `promo_codes` DISABLE KEYS */;
INSERT INTO `promo_codes` VALUES (1,NULL,'e cash','E cash Event booking started now','PromoCodeImages/egoz9fl2XmVB8shTjGO9C4mY8AHFeyFYjIqLNaIZ.jpg','112233',20,10000,'2024-06-09 18:00:00','2024-06-16 18:00:00',NULL,'18-60',NULL,'0-60','2024-06-09 13:18:28','2024-06-09 13:18:28'),(2,NULL,'promo','Never Marry in winter ( Rob Stark ) Said','PromoCodeImages/fptMTrbMDWQPNfwwxUfSPWPlslHMwnSIgvd8Xuah.png','12345',10,1000,'2024-07-25 13:21:00','2024-08-09 13:21:00','1,2,3,4','0-100','Aleppo,Al-Ḥasakah,Al-Qamishli,Al-Qunayṭirah,Al-Raqqah,Al-Suwayda,Damascus,Daraa,Dayr al-Zawr,Ḥamah,Homs,Idlib,Latakia,Rif Dimashq','0-328','2024-07-24 10:21:53','2024-07-24 10:21:53');
/*!40000 ALTER TABLE `promo_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `public_notifications`
--

DROP TABLE IF EXISTS `public_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `public_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_categories` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_ages` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_states` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_bookings` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `public_notifications`
--

LOCK TABLES `public_notifications` WRITE;
/*!40000 ALTER TABLE `public_notifications` DISABLE KEYS */;
INSERT INTO `public_notifications` VALUES (1,'E cash Event booking started now','بدأت الحجوزات','E cash Event booking started now','بدأت الحجوزات',NULL,'18-60',NULL,'0-60','2024-06-09 13:11:04','2024-06-09 13:11:04');
/*!40000 ALTER TABLE `public_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reel_comments`
--

DROP TABLE IF EXISTS `reel_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reel_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `reel_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reel_comments_user_id_foreign` (`user_id`),
  KEY `reel_comments_reel_id_foreign` (`reel_id`),
  CONSTRAINT `reel_comments_reel_id_foreign` FOREIGN KEY (`reel_id`) REFERENCES `reels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reel_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reel_comments`
--

LOCK TABLES `reel_comments` WRITE;
/*!40000 ALTER TABLE `reel_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `reel_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reel_likes`
--

DROP TABLE IF EXISTS `reel_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reel_likes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `reel_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reel_likes_user_id_foreign` (`user_id`),
  KEY `reel_likes_reel_id_foreign` (`reel_id`),
  CONSTRAINT `reel_likes_reel_id_foreign` FOREIGN KEY (`reel_id`) REFERENCES `reels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reel_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reel_likes`
--

LOCK TABLES `reel_likes` WRITE;
/*!40000 ALTER TABLE `reel_likes` DISABLE KEYS */;
INSERT INTO `reel_likes` VALUES (4,18,16,'2024-06-09 11:53:35','2024-06-09 11:53:35');
/*!40000 ALTER TABLE `reel_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reels`
--

DROP TABLE IF EXISTS `reels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned DEFAULT NULL,
  `organizer_id` bigint unsigned DEFAULT NULL,
  `venue_id` bigint unsigned DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `images` json DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reels_event_id_index` (`event_id`),
  KEY `reels_organizer_id_index` (`organizer_id`),
  KEY `reels_venue_id_index` (`venue_id`),
  CONSTRAINT `reels_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reels_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `organizers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reels_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reels`
--

LOCK TABLES `reels` WRITE;
/*!40000 ALTER TABLE `reels` DISABLE KEYS */;
INSERT INTO `reels` VALUES (16,NULL,4,NULL,'[\"http://srv532094.hstgr.cloud/storage/ReelVideo/eCfBYKAwXVO6LW3r45NXM97lMU4BFs1mC8e2kGEB_hls/360p.m3u8\"]','[\"ReelImages/RSQ6UlZb9b8yzQZTuoq55e2xaXQlOhrMyFEXZ3sv.jpg\"]','Description','الوصف','2024-06-09 11:49:09','2024-06-09 11:49:09'),(20,NULL,NULL,3,'[\"http://srv532094.hstgr.cloud/storage/ReelVideo/fg6kqU5nuNp32sLDmsFNsDjNRDg66d8oek4L4pj5_hls/360p.m3u8\"]','[\"ReelImages/hlsRZ7qNuIrVuT6GGfuenqHx1PkaiRHOQ36f1zQY.jpg\"]','Description','Description AR','2024-08-03 10:46:46','2024-08-03 10:46:46'),(21,NULL,NULL,2,'[\"ReelVideo/THrKvSgZ6moOsoXWg6t6HmUh6cakb6RqSx3Kphgt.mp4\"]','[\"ReelImages/0YonMZYhPCUfEHrxZskoAN7hCgrC52r8x3NF8603.png\", \"ReelImages/UEkDl2NrrXKIHC9c0lpSAoLKTlzovYmu6Opvjbo4.png\"]','ggfr','gffgf','2024-08-09 13:15:55','2024-08-09 13:15:55'),(22,NULL,NULL,1,'[\"ReelVideo/iMvw6VESxaNWrx47A07v7QvSTFRdvOzYdv6GyjC5.mp4\"]','[\"ReelImages/Ck3uQdi7Q7nO1fZGhoSpIFWbBEuBZlQy0OtFwCnY.jpg\"]','Restaurant','مطعم','2024-08-09 14:07:28','2024-08-09 14:07:28');
/*!40000 ALTER TABLE `reels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_code_passwords`
--

DROP TABLE IF EXISTS `reset_code_passwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reset_code_passwords` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reset_code_passwords_phone_number_index` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_code_passwords`
--

LOCK TABLES `reset_code_passwords` WRITE;
/*!40000 ALTER TABLE `reset_code_passwords` DISABLE KEYS */;
/*!40000 ALTER TABLE `reset_code_passwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `event_id` bigint unsigned NOT NULL,
  `rate` int NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_event_id_foreign` (`event_id`),
  CONSTRAINT `reviews_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2024-06-05 14:48:35','2024-06-05 14:48:35');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_categories`
--

DROP TABLE IF EXISTS `service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_categories`
--

LOCK TABLES `service_categories` WRITE;
/*!40000 ALTER TABLE `service_categories` DISABLE KEYS */;
INSERT INTO `service_categories` VALUES (1,'DJ','دي جي','ServiceCategoryImages/1w85suT2sfWgkQTa4MaTSUI0PPKmZNxtLi7q57mg.jpg','Select energetic party DJ.','اختر دي جي حيوي للحفلة.','2024-06-05 15:52:19','2024-08-09 13:57:31'),(2,'Musician','الموسيقي','ServiceCategoryImages/b6lFMd0fUxbhEGFybPCMmHDvtPpQ6GKbwTJ6um4R.jpg','Choose a talented solo performer.','.    اختر فنان منفرد موهوب.','2024-06-05 15:53:09','2024-08-09 13:57:48'),(3,'Decoration','ديكور','ServiceCategoryImages/2YdSQ6a22GFz0imenub7FeH9SZ1Lc8FRNp1BblYw.jpg','Arrange exquisite details to enhance your venue.','.     رتب التفاصيل الرائعة لتجميل فعاليتك','2024-06-05 15:56:01','2024-08-09 13:57:54'),(4,'Flower','ورد','ServiceCategoryImages/353kMXpsfH6hP87GebyXOG4quYqn5koEv2GHrgI0.jpg','Pick stunning floral decorations.','اختر تنسيقات الزهور الرائعة.','2024-06-05 15:59:59','2024-08-09 13:58:46'),(5,'Photographer','مصور','ServiceCategoryImages/iRyTsRUlEyOZCayBTF9gVyOVvL3yhey9QX4FOCyP.jpg','Choose a skilled photographer to capture moments','اختر مصورًا ماهرًا لالتقاط اللحظات.','2024-06-05 16:00:43','2024-08-09 13:58:54'),(7,'Payment Provider','مزود خدمة الدفع','ServiceCategoryImages/lv1xkofvuLnxd9K19D90mcnnZvgrNHeGN0CuREdG.jpg','ecash - haram transfer’s new affiliate – is an online payment gateway that eliminates the need for cash by offering direct, innovative, and multi-e-payment solutions to businesses and individuals for seamless, reliable, and more secure financial services and profits.','شركة إي كاش\r\nهي شركة دفع إلكتروني تابعة لمجموعة هرم بيراميد تقدم حلول دفع إلكتروني مباشرة، مبتكرة، ومتعددة للشركات والأفراد، كما تمثل تجربة فريدة من نوعها في توفير خدمات مالية آمنة وموثوقة تساهم في مواكبة التطور وتحقيق الأرباح.','2024-08-04 10:47:32','2024-08-04 10:49:27');
/*!40000 ALTER TABLE `service_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_provider_albums`
--

DROP TABLE IF EXISTS `service_provider_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_provider_albums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_provider_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_provider_albums_service_provider_id_index` (`service_provider_id`),
  CONSTRAINT `service_provider_albums_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_provider_albums`
--

LOCK TABLES `service_provider_albums` WRITE;
/*!40000 ALTER TABLE `service_provider_albums` DISABLE KEYS */;
INSERT INTO `service_provider_albums` VALUES (1,1,'Events','[\"OrganizerImages/IsFOPR3WWQyZkqQMF2qCOtpkANIUN2L37ao3aihK.jpg\", \"OrganizerImages/khp4wO20I11FYTBH8jYWdPsK5Y3bYIPk0wewJlMy.jpg\", \"OrganizerImages/G6ovywb0I70yTkSwuArsPu2h2EMDbp908hpDKPeH.jpg\"]',NULL,'2024-06-05 16:06:25','2024-06-05 16:06:25'),(2,2,'Events','[\"OrganizerImages/1000019776.jpg\", \"OrganizerImages/1000019775.webp\"]',NULL,'2024-06-07 17:23:06','2024-06-07 17:23:06'),(3,3,'Events','[\"OrganizerImages/1000019776.jpg\", \"OrganizerImages/1000019777.jpg\"]',NULL,'2024-06-07 17:34:34','2024-06-07 17:34:34'),(4,4,'Events','[\"OrganizerImages/1000019775.webp\"]',NULL,'2024-06-07 17:51:41','2024-06-07 17:51:41'),(5,7,'test','[\"ServiceProviderImages/N4OCmjlri5heGzYuGWrHrbOW9fObV7iquQXwEqcx.jpg\", \"ServiceProviderImages/ySvCWe2S27Gsn6RZp5eEicbiswRToyBrtHnFNiW2.jpg\"]',NULL,'2024-08-04 11:03:58','2024-08-04 11:03:58'),(6,9,'fyf','[\"OrganizerImages/YCOwBAQ3uqL8QWMLZSd66kgkLONoyIWJMh3YpxrM.jpg\"]',NULL,'2024-08-07 14:32:44','2024-08-07 14:32:44'),(7,14,'Mashqita','[\"ServiceProviderImages/R7Hytho2l1cdke7NqdwO6QnYu0p5Q9AfUsMD8x16.jpg\", \"ServiceProviderImages/4Q1rQiywJEz9p04U0ohyNIfP1QNSIIcBaY8Euc5w.jpg\", \"ServiceProviderImages/x2Hqlj4h5ORtdKkyoJrUJqxxaSw3LZzkBNCXHvzN.jpg\"]','[\"ServiceProviderVideos/U73IwAnSZQX1vlokFIkBlAuhEZa2d5OQ6HB9otcV.mp4\"]','2024-08-09 13:24:55','2024-08-09 13:24:55'),(8,18,'ddad','[\"ServiceProviderImages/RxvH009CvD3QYn3Hr8FvgmDYgOJaXfz7sMO7AUOK.jpg\", \"ServiceProviderImages/rkoTVQH4O1dL92Y7kQ2iUzoa5pWiyok56YvykN16.jpg\", \"ServiceProviderImages/xWHH9H7PvDwy2GUItuK2HU08py1nrEkar9JovpyY.jpg\", \"ServiceProviderImages/laZ9q1kHpm6lKVuPYVYWSinpktqGOJ8lgK8NVPQn.jpg\"]','[\"ServiceProviderVideos/SFKHOOBt0dmy6p038Z2EcPFXQ6ONbLay4ACmhbtm.mp4\"]','2024-08-09 13:29:59','2024-08-09 13:29:59');
/*!40000 ALTER TABLE `service_provider_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_provider_reviews`
--

DROP TABLE IF EXISTS `service_provider_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_provider_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `service_provider_id` bigint unsigned NOT NULL,
  `rate` int NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_provider_reviews_user_id_foreign` (`user_id`),
  KEY `service_provider_reviews_service_provider_id_foreign` (`service_provider_id`),
  CONSTRAINT `service_provider_reviews_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_provider_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_provider_reviews`
--

LOCK TABLES `service_provider_reviews` WRITE;
/*!40000 ALTER TABLE `service_provider_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_provider_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_providers`
--

DROP TABLE IF EXISTS `service_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_providers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_work_governorate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double(10,6) DEFAULT NULL,
  `longitude` double(10,6) DEFAULT NULL,
  `type` enum('pending','Approved') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_providers_user_id_unique` (`user_id`),
  KEY `service_providers_category_id_index` (`category_id`),
  KEY `service_providers_user_id_index` (`user_id`),
  CONSTRAINT `service_providers_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `service_providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_providers`
--

LOCK TABLES `service_providers` WRITE;
/*!40000 ALTER TABLE `service_providers` DISABLE KEYS */;
INSERT INTO `service_providers` VALUES (1,4,'DJ SoundWave','DJ SoundWave','Professional DJ with extensive experience in delivering top-notch music and entertainment at events. Known for mixing various genres and keeping the audience engaged and dancing all night.','دي جي محترف ذو خبرة واسعة في تقديم أفضل الموسيقى والترفيه في الفعاليات. معروف بمزج أنواع مختلفة من الموسيقى وإبقاء الجمهور متفاعلاً ويرقص طوال الليل.','Al-Qunayṭirah',1,'A highly skilled DJ specializing in creating unforgettable experiences through music. Adept at reading the crowd and tailoring sets to ensure maximum enjoyment. Available for weddings, parties, corporate events, and more.','دي جي ذو مهارات عالية متخصص في خلق تجارب لا تُنسى من خلال الموسيقى. بارع في قراءة الجمهور وتخصيص العروض لضمان أقصى قدر من المتعة. متاح لحفلات الزفاف والحفلات والفعاليات الشركات والمزيد.','ServiceProviderImages/8bqTGtcCPjNTINHktFFHMPSaFYx4wggPsPko45l2.jpg','ServiceProviderCover/TQ0xGQlSXTqTQ8rpJ6hY8G10qXW5DbxDszL16mJt.jpg',33.506097,36.251926,'Approved','2024-06-05 16:06:25','2024-06-08 11:07:40'),(2,7,'CMD','CMD','Professional musician','Professional musician','Damascus',2,'Professional musician','Professional musician','ServiceProviderImages/9zUrecCf3z0577Givc6ab9zRhPmnwuIviY9v2917.webp','ServiceProviderCover/1000019774.jpg',33.508443,36.251501,'Approved','2024-06-07 17:23:06','2024-06-08 11:12:14'),(3,11,'Service provider','Service provider','Professional service provider','Professional service provider','Daraa',3,'Service provider','Service provider','ServiceProviderImages/tUpjgDeAylyhLS3m2yflNBn0LBoCvkbTsetLTbm6.webp','ServiceProviderCover/1000019776.jpg',33.496229,36.255330,'Approved','2024-06-07 17:34:34','2024-06-08 11:12:45'),(4,13,'Blooms','Blooms','Where floral elegance meets exceptional service. Experience the magic of flowers with us today.','حيث يلتقي الأناقة بالخدمة الاستثنائية. اكتشف سحر الزهور معنا اليوم.','Damascus',4,'It is your premier destination for an unparalleled experience in floral arrangements and exceptional service. We believe in the power of flowers to evoke emotions, celebrate special moments, and beautify spaces.','هو وجهتك الأولى لتجربة لا تُضاهى في تنسيقات الزهور والخدمة المتميزة. نحن نؤمن بقوة الزهور في إثارة المشاعر والاحتفال باللحظات الخاصة وتجميل الأماكن.','ServiceProviderImages/un0YamKI0kLReLqlHuB58zMGuAxc9AwAdSS1IYTV.jpg','ServiceProviderCover/1000019787.jpg',33.497933,36.249118,'Approved','2024-06-07 17:51:41','2024-06-08 11:01:27'),(5,20,'1111','2222','dfdggc ggfdd','dfdggc ggfdd','Ḥamah',5,'ffhshd jdjsjsjw djnsnde djsbdn','ffhshd jdjsjsjw djnsnde djsbdn','ServiceProviderProfile/pU3r2RMWAsEEdg3HXkda1sOerlyOiCckH2vCAQeW.jpg','ServiceProviderCover/ARDBOxTJlbMiYbP9kZ8UPw4r6yDiB0gJps08hoyb.jpg',19.024617,9.565260,'Approved','2024-06-09 13:00:36','2024-08-06 12:42:34'),(7,24,'test','test','test','test','Latakia',1,'test','test','ServiceProviderProfileImages/nnGSrU1sSf6hejJFe0srk02h83gH1Yr5aUPbjahZ.jpg','ServiceProviderProfileImages/CdTOj7OdKKh72UiaTvNMvUMIuKVWZyFz0xom8Ioc.jpg',33.543851,36.279247,'Approved','2024-08-04 11:03:58','2024-08-04 11:03:58'),(8,26,'ecash Payment Provider','إي-كاش للدفع الالكتروني','ecash - haram transfer’s new affiliate – is an online payment gateway that eliminates the need for cash by offering direct, innovative, and multi-e-payment solutions to businesses and individuals for seamless, reliable, and more secure financial services and profits','هي شركة دفع إلكتروني تابعة لمجموعة هرم بيراميد تقدم حلول دفع إلكتروني مباشرة، مبتكرة، ومتعددة للشركات والأفراد، كما تمثل تجربة فريدة من نوعها في توفير خدمات مالية آمنة وموثوقة تساهم في مواكبة التطور وتحقيق الأرباح.','Damascus',7,'ecash - haram transfer’s new affiliate – is an online payment gateway that eliminates the need for cash by offering direct, innovative, and multi-e-payment solutions to businesses and individuals for seamless, reliable, and more secure financial services and profits','هي شركة دفع إلكتروني تابعة لمجموعة هرم بيراميد تقدم حلول دفع إلكتروني مباشرة، مبتكرة، ومتعددة للشركات والأفراد، كما تمثل تجربة فريدة من نوعها في توفير خدمات مالية آمنة وموثوقة تساهم في مواكبة التطور وتحقيق الأرباح.','ServiceProviderProfileImages/BsDC49DIFavwYiFDEMqL06HzomiRYK7lh3ZjBWSM.jpg','ServiceProviderProfileImages/ERzCQDOy8qwvYWt3yHIzyJkFn3UjLQKZpcMageMz.jpg',33.491729,36.242661,'Approved','2024-08-04 11:10:39','2024-08-04 11:10:39'),(9,33,'hfif8yf','hfif8yf','ic8yc8','ic8yc8','Dayr al-Zawr',2,'ihhcihc','ihhcihc','ServiceProviderProfile/PkKcFMEQDMMPPqxE65Kc9BaQPxJnbfBbUO94x3rA.jpg','ServiceProviderCover/TEpb17ko7c8DIl4mSNUAHlxjXviVXKvqnjy610cJ.jpg',33.502041,36.253436,'pending','2024-08-07 14:32:44','2024-08-07 14:32:44'),(14,2,'suzan','مدينة المعارض','xdaszxsxz','xxsszxszz','Idlib',5,'xsxxszsxzc','sdczc','ServiceProviderProfileImages/yMOilsQH6RkWuU09svk7tReOEmKZ2PshIjSeYrIr.png','ServiceProviderProfileImages/xK09AbjiFigMXF8ejD5DZdlrBsEcftQthIf30VsF.png',33.485958,36.273753,'Approved','2024-08-09 13:24:55','2024-08-09 13:24:55'),(18,3,'gfcgf','مطعم فيو','dasdasd','dadsad','Homs',5,'dasdsdd','dasdda','ServiceProviderProfileImages/ugKu6bSZnk3zPstla88Xij3Xd4WdFGtPq31jE4TO.jpg','ServiceProviderProfileImages/oolokYHGL9FeDxdu2srCuHueo8bAXzrRhRM1RuwG.jpg',33.618717,36.130931,'Approved','2024-08-09 13:29:54','2024-08-09 13:29:54');
/*!40000 ALTER TABLE `service_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temped_bookings`
--

DROP TABLE IF EXISTS `temped_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temped_bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `event_id` bigint unsigned DEFAULT NULL,
  `class_id` bigint unsigned DEFAULT NULL,
  `promo_code_id` bigint unsigned DEFAULT NULL,
  `invoice_id` bigint DEFAULT NULL,
  `offer_id` bigint unsigned DEFAULT NULL,
  `user_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amenities` json NOT NULL,
  `class_ticket_price` int NOT NULL,
  `status` enum('pending','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `temped_bookings_class_id_foreign` (`class_id`),
  KEY `temped_bookings_promo_code_id_foreign` (`promo_code_id`),
  KEY `temped_bookings_offer_id_foreign` (`offer_id`),
  KEY `temped_bookings_user_id_index` (`user_id`),
  KEY `temped_bookings_event_id_index` (`event_id`),
  CONSTRAINT `temped_bookings_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `event_classes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `temped_bookings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL,
  CONSTRAINT `temped_bookings_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `temped_bookings_promo_code_id_foreign` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `temped_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temped_bookings`
--

LOCK TABLES `temped_bookings` WRITE;
/*!40000 ALTER TABLE `temped_bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `temped_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_promo_code`
--

DROP TABLE IF EXISTS `user_promo_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_promo_code` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mobile_user_id` bigint unsigned NOT NULL,
  `promo_code_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_promo_code_mobile_user_id_index` (`mobile_user_id`),
  KEY `user_promo_code_promo_code_id_index` (`promo_code_id`),
  CONSTRAINT `user_promo_code_mobile_user_id_foreign` FOREIGN KEY (`mobile_user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_promo_code_promo_code_id_foreign` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_promo_code`
--

LOCK TABLES `user_promo_code` WRITE;
/*!40000 ALTER TABLE `user_promo_code` DISABLE KEYS */;
INSERT INTO `user_promo_code` VALUES (1,1,1,NULL,NULL),(2,2,1,NULL,NULL),(3,3,1,NULL,NULL),(4,4,1,NULL,NULL),(5,5,1,NULL,NULL),(6,6,1,NULL,NULL),(7,7,1,NULL,NULL),(8,8,1,NULL,NULL),(9,10,1,NULL,NULL),(10,11,1,NULL,NULL),(11,12,1,NULL,NULL),(12,13,1,NULL,NULL),(13,14,1,NULL,NULL),(14,15,1,NULL,NULL),(15,16,1,NULL,NULL),(16,17,1,NULL,NULL),(17,18,1,NULL,NULL),(18,19,1,NULL,NULL),(20,7,2,NULL,NULL),(21,10,2,NULL,NULL),(22,11,2,NULL,NULL),(23,12,2,NULL,NULL),(24,13,2,NULL,NULL),(25,14,2,NULL,NULL),(26,17,2,NULL,NULL),(27,18,2,NULL,NULL),(28,20,2,NULL,NULL),(29,21,2,NULL,NULL);
/*!40000 ALTER TABLE `user_promo_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'HDR@gmail.com','$2y$10$TXy8SthNZra3WLO/dZKOtOJTA510dApxVDSM7pcq16be2kcpedRx6','nPHJCPCm5K6aN8EGYa1DXu191zRQI9kB1BWT78FQtxggh57xvyGJYvseGyFq','2024-06-05 14:48:35','2024-06-05 14:48:35'),(2,'sytpra@gmail.com','$2y$10$V4Dc/QwHh1VenIk0gk2mju8HKW6YGuvakrrxSNbG/.uMQNJqFNc1.',NULL,'2024-06-05 14:48:35','2024-06-05 14:48:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venue_albums`
--

DROP TABLE IF EXISTS `venue_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venue_albums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `venue_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venue_albums_venue_id_index` (`venue_id`),
  CONSTRAINT `venue_albums_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venue_albums`
--

LOCK TABLES `venue_albums` WRITE;
/*!40000 ALTER TABLE `venue_albums` DISABLE KEYS */;
INSERT INTO `venue_albums` VALUES (1,1,'Al Manshia','[\"VenueImages/crYbteoEw8tL0yW67dH647SS2iE3f7gyn2efINbU.jpg\", \"VenueImages/rZe0bXwskYzzmmf1Zw5CVt7rpXyIeMN0oDeRZ6so.jpg\"]',NULL,'2024-06-05 15:39:17','2024-06-05 15:39:17'),(2,2,'Em Sherif','[\"VenueImages/cRv5hF4rLTz7825H9MuFhOaq2BmsofrP2dfpuPU4.jpg\", \"VenueImages/xj7CTadP7rdJPevF6Cpteo9rJwFxrNJofXck5wpV.jpg\", \"VenueImages/eGTgQRel7AfsMNmdIHXB0xjMcDesUGmZqH8QSwmk.jpg\", \"VenueImages/0NG7JgLKkcUFSVrcbkiwkgvV5JxQDGyZRwCpyGGh.jpg\", \"VenueImages/6wh1FYXqrSUX9rfhtoGCZgya9Ora8JclDBDixMNW.jpg\", \"VenueImages/JW82M8yotGc0JOcgGifIXzMwfJW9GY6Ymnf0rjSB.jpg\", \"VenueImages/rnIgRSOwe69pptp4SmZV3rDX0hgbi5DLFAGMSy3k.jpg\"]',NULL,'2024-06-05 15:41:36','2024-06-05 15:41:36'),(3,3,'Dar al-Assad for Culture and Arts','[\"VenueImages/Fbp2UUG1VSxfQga5vpJQtcwIkOPelMovjWhaYj25.jpg\", \"VenueImages/X2JpJj3biTSqESNnMk6PracrhUsq6kgcUa62rLSu.jpg\", \"VenueImages/mmlB45PWWxb1ow1pT4PS1wwIqnuNTg3cg1nTmD9o.jpg\", \"VenueImages/1Hm2eLnABMRl5B8JseX89IjUG0LufjQ2xMnzIBwN.jpg\", \"VenueImages/a9VEl366kXLDTQ7TSF9xlxYTYeZYZ5tBPR7JBrly.jpg\", \"VenueImages/XE8hOcS8V3FbISygkIgmCWYH1HiNpSAHA8gou3KK.jpg\"]',NULL,'2024-06-05 15:43:20','2024-06-05 15:43:20'),(4,4,'Restaurant','[\"VenueImages/oaFmdVs56rYJCfSKOOw7uPTVxhHf6qnsvTN88SsR.jpg\", \"VenueImages/uRBZbx2QFwkmCDIuqfwdRcyaTdPYDRnvRSmsgUZh.jpg\", \"VenueImages/VHBbJvJmnwbR33mgeW6DbDGrBUMyePOB2jxOZCQB.jpg\"]',NULL,'2024-06-05 15:43:44','2024-06-05 15:43:44'),(5,5,'Mashqita','[\"VenueImages/82KKZcwbxVCWXWUwqskrkrLdrleba9bDwkVtVioN.jpg\", \"VenueImages/dpCcSUatn5l2gxb2QucauJovaB9Jyn7f5CD2uPji.jpg\", \"VenueImages/OsXzZ4uivUI5wCxqYMgjfPlVcWkoJMs9YhzZZko1.jpg\", \"VenueImages/WbMglOJbRighphBQc5KhvQbMC0Qv7AsFWICvFY6B.jpg\"]',NULL,'2024-06-05 15:53:07','2024-06-05 15:53:07'),(7,9,'Automobile Club','[\"VenueImages/pFu8PV58EVl0UZugT2M56E7G2PkEsxzMjS17lMI0.jpg\", \"VenueImages/uN91CXmkPHQXJa0X4DtPfAuwYFAHrAAGnO9MphkS.jpg\", \"VenueImages/XYaQJHgH0cmNPdBLzeQwzQmWP5MfKzsY2yHrzBLl.jpg\", \"VenueImages/NF0iXWPD49xqExigtxjKX62lrCTMZ7tB1PlmCEQf.jpg\", \"VenueImages/gVmTvk5sFfuZWTlupHo9jeu2MjWsjolj0HXK0EKT.jpg\", \"VenueImages/IOAxK1AjhG9Hw2gTlUgPOiT4x4yCSKdDBa6R0Nme.jpg\", \"VenueImages/GgKuqVJTYWBdiSWDVsbIlxiYTYs39adusXu8H0Yy.jpg\", \"VenueImages/hfPdfr7ftgpY3HksqW2uNnzMtDED0y1mi4lypbNz.jpg\", \"VenueImages/Ps6HnwL0f0KWg30q8a11hkTWnLvkfYGiDhDrkFfP.jpg\", \"VenueImages/hAmjfIcdMXy9l6OxLo2FkvwGDyyOPPOB4e8JrxAZ.jpg\", \"VenueImages/qiwM0JVovsINrhKqIoL31m4JCDhmD1iuWfTk1MKx.jpg\"]',NULL,'2024-06-08 09:38:32','2024-06-08 09:38:32'),(8,10,'Venue','[\"VenueImages/lrKqOhoynsKpcxzH0n01aANcjHI1R7Fp52rx4MPG.jpg\", \"VenueImages/xh54GgWb67UAyTJf3IJOStFfwx9jndso3IL5gktT.jpg\", \"VenueImages/frECdd15Wi1exWpnzZz0ho4Lj5ybmZZUCjAJa0vW.jpg\", \"VenueImages/xB3FBGtiV8CZ4ePq7dEXJOv8H9doLoPHtXMF6Iyc.jpg\", \"VenueImages/EzS0ZPiBLOKEM87K8ueaPEgUG2JwQ2OZdFZfQD62.jpg\", \"VenueImages/uTGYLtQd4sdkk5nw1FnFEIF75TqmkCWNqpbmk68X.jpg\", \"VenueImages/7tCmxCyOrGzuzjh9tLa7YtlbzUjsj46adzpKpq9L.jpg\", \"VenueImages/0mivTWmJ14fiPGdip57Xsr8FtpRClWwCvKfUnX9R.jpg\", \"VenueImages/DuVglqzbgdOSlZrIZH3OjQqV2XDkfQbH78TlXXqR.jpg\", \"VenueImages/RHhBp3wJsNO5wQGUyqUxvahluP3rMMX6ezcpJ5oB.jpg\"]',NULL,'2024-06-08 10:33:37','2024-06-08 10:33:37'),(9,13,'Venue','[\"VenueImages/PEzGCpsMqJIpXEdaFJvOjkb4SimC30MJjDvyfZw6.jpg\", \"VenueImages/8C5y13vmA3oUlSnWf3aemj7Fenmn3G2m6WMVJYI9.jpg\", \"VenueImages/nsuHYyrE8ZMaoAf83lm8QYcEEM3qTIcE9Xp0COG4.jpg\", \"VenueImages/xYNwJHrIdC5voyLns61WtE2AC7Hc4ALJvEnRoR0S.jpg\", \"VenueImages/3bOab8Wa6gX78yaCwhkh2ebx0SbciBbd9wUnkyEV.jpg\", \"VenueImages/fEbARHLM29hF1BQZfuU2el7aQ2WTw3WrYbqYLqsG.jpg\", \"VenueImages/1thYGF8HX0tZmME2yDvyufIdG0WJNjrXm54YsvFk.jpg\", \"VenueImages/J54KqJU3TXBCMC8qNU82JEDkxG8XLM4vZqUDQMJp.jpg\", \"VenueImages/IgOU4mrt1bMXn0JMnzSmwrRcfzFwvv69qUYJkRbw.jpg\", \"VenueImages/hFQexpFQiHG4lGfzvQoAHw5pxTmxfFZgMjr1y2OR.jpg\", \"VenueImages/bS8GAvJA8NnzKJKOXdgsZCBkxD7UZKxrXgg9PZIM.jpg\", \"VenueImages/H94rMUSkgigUqBVFgHdXKZQq7IiYSXNZ9QDgsxPE.jpg\", \"VenueImages/WoAjYS0Uy3ftc5L9PVuayx91vX0qrxV1XA2Y7pl9.jpg\", \"VenueImages/ABqn3QnHGZzqp64TvVoXsdsr5bwEjK132EAkGsJy.jpg\", \"VenueImages/toK9rk01zeuRO6b4gYjohQ2GjvfBcTKvZbylX5rB.jpg\", \"VenueImages/YyAugqp7Atx2WeSBL68qneQd8YN41tEwoGSAHX8y.jpg\", \"VenueImages/2ExQcfzQCz6ZINb560foucmwbJuS7DtZ21wnlKdM.jpg\", \"VenueImages/vTjxpDVK3qqRZNf4rMYW1zhxSfPBlJ5s1Ar9dzgN.jpg\", \"VenueImages/sDY2xByHYAUzdFU9s4ufr9RXogF0zJFKQQSEaiba.jpg\"]',NULL,'2024-08-03 08:48:49','2024-08-03 08:48:49'),(10,15,'palmyra','[\"VenueImages/jox5ImsSaR5bGkalJmosmq3uvYKsi1ttLuy2tnuO.jpg\", \"VenueImages/LNhr1iDJEAe5n8KxOUuhyawLmxq1nDy7zm3Kaup8.jpg\", \"VenueImages/cYYTS2XyVrFjjo00z7beYtoAcNEKkWWyEh9WeTI3.jpg\", \"VenueImages/t8422plbAH7kep88uuE51JD0Wfl5xLNvibH7RKOH.jpg\", \"VenueImages/vPCrdkphRZ1T4ONty0cWstPDe65PqGvEHQqcs6Pi.jpg\"]',NULL,'2024-08-09 14:37:08','2024-08-09 14:37:08');
/*!40000 ALTER TABLE `venue_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venue_reviews`
--

DROP TABLE IF EXISTS `venue_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venue_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `venue_id` bigint unsigned NOT NULL,
  `rate` int NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venue_reviews_user_id_foreign` (`user_id`),
  KEY `venue_reviews_venue_id_foreign` (`venue_id`),
  CONSTRAINT `venue_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `mobile_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `venue_reviews_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venue_reviews`
--

LOCK TABLES `venue_reviews` WRITE;
/*!40000 ALTER TABLE `venue_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `venue_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venues`
--

DROP TABLE IF EXISTS `venues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venues` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `governorate` enum('Aleppo','Al-Ḥasakah','Al-Qamishli','Al-Qunayṭirah','Al-Raqqah','Al-Suwayda','Damascus','Daraa','Dayr al-Zawr','Ḥamah','Homs','Idlib','latakia','Rif Dimashq') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_description_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double(10,6) NOT NULL,
  `longitude` double(10,6) NOT NULL,
  `profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venues`
--

LOCK TABLES `venues` WRITE;
/*!40000 ALTER TABLE `venues` DISABLE KEYS */;
INSERT INTO `venues` VALUES (1,'Al Manshia','المنشية',1499,'Damascus','Damascus, Dama Rose Hotel','دمشق,فندق الداما روز.','Al Manshia Restaurant is a culinary haven that transports diners on a gastronomic journey through the rich and diverse flavors of Arabic cuisine.','مطعم المنشية هو وجهة مميزة لعشاق الطهي العربي، حيث يأخذ زواره في رحلة ذواقة عبر نكهات غنية ومتنوعة.',33.514217,36.285203,'VenueImages/QzGTsR36YfgGzMen6PrGhEuEBZjGs0hArj2vg9Gp.jpg','011 3311922','2024-06-05 15:39:17','2024-08-09 14:14:23'),(2,'Em Sherif','ام شريف',2000,'Damascus','Shoukry Al-qouwatly street, Four Seasons Hotel, Damascus Syria','شارع شكري القوتلي، فندق فور سزونز، دمشق، سوريا\r\n\r\n\r\n\r\nشارع شكري القوتلي، فندق فور سزونز، دمشق، سوريا','Em Sherif, a culinary haven, invites you to indulge in the exquisite flavors of Lebanese cuisine.','إم شريف، واحة للمأكولات، تدعوكم للتمتع بنكهات الطهي اللبناني الراقي. يتألق مطعمنا في بيئة متألقة، حيث يحيي تراث الطهي اللبناني الغني.',33.513820,36.290932,'VenueImages/SKuYEkiGhccddvrhXHM5quCKftg4bhXxAnCuhEgO.jpg','+963 933 809 100','2024-06-05 15:41:36','2024-08-09 14:14:46'),(3,'Dar al-Assad for Culture and Arts','دار الأسد للفنون والثقافة',5000,'Damascus','Al Opera House for Art Events is a cultural haven that transcends ordinary experiences, providing a platform for the celebration of diverse artistic expressions.','دار الأوبرا للفعاليات الفنية هي مأوى ثقافي يتجاوز التجارب العادية، وتوفر منبرًا للاحتفال بتعدد التعبيرات الفنية.','Al Opera House for Art Events is a cultural haven that transcends ordinary experiences, providing a platform for the celebration of diverse artistic expressions.','دار الأوبرا للفعاليات الفنية هي مأوى ثقافي يتجاوز التجارب العادية، وتوفر منبرًا للاحتفال بتعدد التعبيرات الفنية.',33.512502,36.278504,'VenueImages/l8Se7PS9Ymtqz2yxWKqM1Qc2fFESg1QRpZWRq8Vr.jpg','+963 11 225 6542 DET','2024-06-05 15:43:20','2024-08-09 14:15:52'),(4,'La Fayette','La Fayette',200,'Damascus','Abdel Mounaem Riad, Damascus, Syria','عبد المنعم رياض، دمشق، سوريا','Where Flavor Meets Elegance\" - Indulge in a culinary experience of refined tastes and sophisticated ambiance at Fayette Restaurant. With a menu inspired by both local and international cuisines, prepared with the finest ingredients and presented with artistic flair, every visit promises a journey of culinary delight.','حيث تلتقي النكهات بالأناقة\" - استمتع بتجربة طعام تجمع بين النكهات الرفيعة والأجواء الأنيقة في مطعم فييت. مع قائمة مستوحاة من المأكولات المحلية والعالمية، والمحضرة باستخدام أجود المكونات وتقديمها بروح فنية، تعد كل زيارة رحلة من اللذة الطهوية.',33.524450,36.277944,'VenueImages/6BQqxAhDxIIwli4ABRwvLKzZZFBEdBecnshozXcY.jpg','+963 11 373 9994','2024-06-05 15:43:44','2024-08-09 14:16:32'),(5,'Mashqita','مشقيتا',10000,'latakia','Mashqita is located north of the city of Latakia','تقع مشقيتا شمال مدينة اللاذقية','Mashqita enjoys a nature in which the blueness of the water in the Seven Lakes blends with the mountains and green forests covered with pines, oaks, Oaks and others','تتمتع مشقيتا بطبيعة تمتزج فيها زرقة المياه في البحيرات السبع مع الجبال والغابات الخضراء التي تكسوها أشجار الصنوبر والسنديان والبلوط وغيرها',35.670576,35.937067,'VenueImages/8mCeyjNGU14dHm29p6axC93D8Kojf8eR1WqmWFI3.jpg','0965236523','2024-06-05 15:53:07','2024-08-09 14:17:45'),(7,'Scout of St. Peter\'s Monastery.','كشاف دير القديس بطرس',20000,'Homs','Homs, Wadi Al-Nasara, Marmarita, Municipality Street.','حمص، وادي النصارة، مرمريتا، شارع البلدية','St. Peter\'s Monastery Scout is a historical venue nestled in the serene landscapes of Wadi Al-Nasara, Syria. Renowned for its rich cultural heritage and spiritual significance, it offers visitors a glimpse into the region\'s ancient traditions and architectural marvels.','\"كشاف دير القديس بطرس يقع في مناظر طبيعية هادئة في وادي النصارى بسوريا. يشتهر بتراثه الثقافي الغني وأهميته الروحية، حيث يوفر للزوار نافذة على تقاليد المنطقة القديمة وعجائبها المعمارية.',34.781027,36.255580,'VenueImages/69SfgJhjBuaoHsypUQt4ud5KQxXnSzIodGz8SX6K.jpg','0937 100 002','2024-06-08 08:06:43','2024-08-09 14:25:34'),(8,'‪Deir Mar Musa El-Habashi‬','دير مار موسى الحبشي',200,'Damascus','Al Nabk, Syria','النبك, سوريا','Deir Mar Musa El-Habashi is a stunning monastery nestled in the mountains of Syria, known for its unique blend of Eastern and Western Christian traditions. With its rich history dating back to the 6th century, it serves as a spiritual retreat and a center for interfaith dialogue and cultural exchange.','دير مار موسى الحبشي هو دير رائع يقع في جبال سوريا، ويُعرف بمزيجه الفريد من التقاليد المسيحية الشرقية والغربية. مع تاريخه العريق الذي يعود إلى القرن السادس، يعتبر مركزًا للتأمل الروحي ومركزًا للحوار البين الأدياني والتبادل الثقافي.',34.021976,36.842428,'VenueImages/dRrtggAKq2My7kljmMFekhh3TQKfEz22zLcVrUiz.jpg','+963 11 663 5591','2024-06-08 09:21:24','2024-08-09 14:24:43'),(9,'Syrian Automobile Club','نادي السيارات السوري',2000,'Damascus','Yousef Athma Square, Damascus, Syria','ساحة يوسف العظمة، دمشق، سوريا','The Syrian Automobile Club is a premier destination for motorsport enthusiasts in Syria. Located in the heart of Damascus, it offers a range of facilities including racing tracks, workshops, and events, catering to both professionals and amateurs alike.','نادي السيارات السوري هو وجهة رئيسية لعشاق رياضة السيارات في سوريا. يقع في قلب دمشق، ويوفر مجموعة من المرافق بما في ذلك المضمارات السباق، ورش العمل، والفعاليات، مما يلبي احتياجات المحترفين والهواة على حد سواء.',33.518499,36.294378,'VenueImages/Xi1tHh1S8LMDxjYLRmXoDkjRTzBSVG4AH5rEpKrQ.jpg','+963 11 232 3706','2024-06-08 09:38:32','2024-08-09 14:24:58'),(10,'Roman Theatre of Palmyra','المسرح الروماني في تدمر',5000,'Rif Dimashq','Palmyra, Syria','بالميرا, سوريا','A remarkable architectural marvel dating back to the 2nd century AD. With its well-preserved stage, seating area, and ornate decorations, it offers visitors a glimpse into the grandeur of Roman entertainment and culture.','عجائب هندسية رائعة تعود إلى القرن الثاني الميلادي. بمسرحه المحافظ عليه بشكل جيد، ومنطقة الجلوس، والزخارف الزخرفية، يقدم للزوار نافذة على عظمة الترفيه والثقافة الرومانية.',34.551516,38.269021,'VenueImages/VugIT9lVUiKHYg7si5yWHnqo8qc42y9Jno12pK0Z.jpg','+963 11 541 6444','2024-06-08 10:33:37','2024-08-09 14:25:20'),(13,'Krak des Chevaliers','Krak des Chevaliers',3000,'Homs','Syria, Homs','سوريا, حمص','Krak des Chevaliers, located in Syria, is one of the best-preserved medieval castles in the world. The castle features massive stone walls, towers, and a complex defensive system designed to withstand sieges. Its strategic position atop a hill offers breathtaking views of the surrounding countryside. Krak des Chevaliers is a UNESCO World Heritage site, celebrated for its historical significance and architectural grandeur.','قلعة الحصن، الواقعة في سوريا، هي واحدة من أفضل القلاع المحفوظة من العصور الوسطى في العالم. تتميز القلعة بجدران حجرية ضخمة وأبراج ونظام دفاعي معقد صُمم لتحمل الحصار. موقعها الاستراتيجي على قمة تل يوفر إطلالات خلابة على الريف المحيط. تُعد قلعة الحصن موقعًا للتراث العالمي لليونسكو، وتُحتفى بها لأهميتها التاريخية وعظمتها المعمارية.',34.760034,36.295192,'VenueProfileImages/IJKFyC5Eq6t4cGitLvM5PAgVqbXUPDqDiNbeCYJS.jpg','0950554411','2024-08-03 08:48:49','2024-08-03 08:48:49'),(14,'Zuhar BAR','زوهار بار',50,'Damascus','bab sharqi','باب شرقي','bar bar bar','بار بار بار',33.510150,36.317699,'VenueProfileImages/XM6EaVJHSwfYyWZRzIAmanmJCALLwMUX1zDjVVBd.jpg','093665522','2024-08-06 12:38:52','2024-08-06 12:39:43'),(15,'palmyra','تدمر الأثرية',500000,'Homs','An oasis in the Syrian desert, north-east of Damascus','واحة في الصحراء السورية شمال شرق دمشق','an oasis in the Syrian desert, northeast of Damascus, that contains the monumental ruins of a great city that was one of the most important cultural centres of the ancient world','واحة في الصحراء السورية ، شمال شرق دمشق ، تحتوي على الآثار الأثرية لمدينة عظيمة كانت واحدة من أهم المراكز الثقافية في العالم القديم',34.555521,38.287404,'VenueProfileImages/BvjxOddwBqPUfKVYKRE2QagRzaR9PtDH4EVgWiPd.jpg','0965236985','2024-08-09 14:37:08','2024-08-09 14:37:08');
/*!40000 ALTER TABLE `venues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `websockets_statistics_entries`
--

DROP TABLE IF EXISTS `websockets_statistics_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `websockets_statistics_entries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int NOT NULL,
  `websocket_message_count` int NOT NULL,
  `api_message_count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `websockets_statistics_entries`
--

LOCK TABLES `websockets_statistics_entries` WRITE;
/*!40000 ALTER TABLE `websockets_statistics_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `websockets_statistics_entries` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-10 14:13:33
