-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: gestion_institutions_religieuses
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deces`
--

DROP TABLE IF EXISTS `deces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deces` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `defunt_nom` varchar(255) NOT NULL,
  `defunt_prenom` varchar(255) NOT NULL,
  `date_deces` date NOT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `cause` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deces`
--

LOCK TABLES `deces` WRITE;
/*!40000 ALTER TABLE `deces` DISABLE KEYS */;
/*!40000 ALTER TABLE `deces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `institutions`
--

DROP TABLE IF EXISTS `institutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `institutions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `responsable_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `institutions_responsable_id_foreign` (`responsable_id`),
  CONSTRAINT `institutions_responsable_id_foreign` FOREIGN KEY (`responsable_id`) REFERENCES `utilisateurs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institutions`
--

LOCK TABLES `institutions` WRITE;
/*!40000 ALTER TABLE `institutions` DISABLE KEYS */;
INSERT INTO `institutions` VALUES (1,'Grande Mosquée de Dakar','Mosquée','Allée Pape Gueye Fall, Dakar-Médina','338215151',NULL,NULL,'Principale mosquée de Dakar, construite en 1964 avec un minaret de 67m. Style architectural maroco-andalou.',14.6777800,-17.4422200,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(2,'Mosquée Massalikoul Djinane','Mosquée','Grand Dakar, Dakar','338259090',NULL,NULL,'Plus grande mosquée d\'Afrique de l\'Ouest, inaugurée en 2019. Capacité de 30 000 fidèles, 5 minarets de 80m.',14.7011100,-17.4486100,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(3,'Mosquée de l\'Indépendance','Mosquée','Place de l\'Indépendance, Dakar-Plateau','338231212',NULL,NULL,'Mosquée historique située sur la place de l\'Indépendance, en plein cœur du plateau administratif.',14.6700000,-17.4320000,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(4,'Mosquée Omarienne','Mosquée','Point E, Dakar','338653535',NULL,NULL,'Mosquée du quartier Point E, proche de l\'Université Cheikh Anta Diop. Centre spirituel important.',14.6860000,-17.4590000,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(5,'Mosquée de Sicap Liberté','Mosquée','Sicap Liberté, Dakar','338254545',NULL,NULL,'Mosquée du grand quartier résidentiel de Sicap Liberté, desservant une communauté nombreuse.',14.6970000,-17.4560000,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(6,'Grande Mosquée de Pikine','Mosquée','Pikine, Dakar','338348484',NULL,NULL,'Mosquée principale de la banlieue de Pikine, l\'une des plus fréquentées de la région dakaroise.',14.7490000,-17.3970000,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(7,'Cathédrale Notre-Dame des Victoires','Église','Boulevard de la République, Dakar-Plateau','338214364','cathedrale.dakar@archidiocesedakar.sn',NULL,'Cathédrale catholique la plus grande de Dakar, siège de l\'Archidiocèse. Construite entre 1923-1929, style néo-soudanais.',14.6653000,-17.4378000,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(8,'Église Saint-Charles de la Médina','Église','SICAP, Dakar','338212828',NULL,NULL,'Paroisse catholique dynamique du quartier SICAP, centre spirituel et communautaire important.',14.6750000,-17.4450000,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(9,'Église Saint-Pierre','Église','Rue de Thiong, Dakar-Plateau','338232323',NULL,NULL,'Église historique du Plateau, connue pour son architecture et sa communauté active.',14.6710000,-17.4470000,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(10,'Église Notre-Dame de la Paix','Église','Almadies, Dakar','338207070',NULL,NULL,'Paroisse catholique située dans le quartier des Almadies, la pointe ouest de Dakar.',14.7420000,-17.5030000,'2026-08-09 20:12:32','2026-08-09 20:12:32',NULL),(11,'Mosquée de Yoff','Mosquée','Yoff, Dakar','774567656','ibadiane814@gmail.com',NULL,NULL,14.7456000,-17.4977000,'2026-08-17 02:13:52','2026-08-17 02:13:52',NULL);
/*!40000 ALTER TABLE `institutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
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
-- Table structure for table `mariages`
--

DROP TABLE IF EXISTS `mariages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mariages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `conjoint1_nom` varchar(255) NOT NULL,
  `conjoint1_prenom` varchar(255) NOT NULL,
  `conjoint2_nom` varchar(255) NOT NULL,
  `conjoint2_prenom` varchar(255) NOT NULL,
  `date_mariage` date NOT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `officiant` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mariages`
--

LOCK TABLES `mariages` WRITE;
/*!40000 ALTER TABLE `mariages` DISABLE KEYS */;
INSERT INTO `mariages` VALUES (1,'Diop','Fallou','Ndeye','BB','2026-06-19','Dakar','Ismaila','2026-08-19 23:48:29','2026-08-19 23:48:29'),(2,'Diop','Fallou','Ndeye','BB','2026-06-19','Dakar','Ismaila','2026-08-20 03:51:13','2026-08-20 03:51:13'),(3,'Diop','Fallou','Ndeye','BB','2026-06-19','Dakar','Ismaila','2026-08-20 03:53:26','2026-08-20 03:53:26'),(4,'Diop','Fallou','Sow','Amina','2026-06-19','Dakar','Ismaila','2026-08-20 04:06:19','2026-08-20 04:06:19'),(5,'Badiane','Ismaila','Gaye','Fatou','2026-06-19','Dakar','Ismaila','2026-08-20 04:06:52','2026-08-20 04:06:52'),(6,'Diallo','Mounir','Sy','Ameeh','2026-11-11','New York','Youssoupha','2026-11-11 00:07:31','2026-11-11 00:07:31');
/*!40000 ALTER TABLE `mariages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_31_200118_create_institutions_table',1),(5,'2026_05_31_200118_create_mariages_table',1),(6,'2026_05_31_200119_create_deces_table',1),(7,'2026_05_31_200119_create_naissances_table',1),(8,'2026_05_31_200119_create_notifications_table',1),(9,'2026_05_31_232827_add_lat_lng_to_institutions_table',1),(10,'2026_06_02_053000_add_responsable_id_to_institutions_table',1),(11,'2026_06_24_042407_add_coordinates_to_institutions_table',1),(12,'2026_08_16_182850_add_institution_id_to_utilisateurs_table',2),(13,'2026_08_20_035204_make_destinataire_id_nullable_in_notifications',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `naissances`
--

DROP TABLE IF EXISTS `naissances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `naissances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `enfant_nom` varchar(255) NOT NULL,
  `enfant_prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `pere_nom` varchar(255) DEFAULT NULL,
  `mere_nom` varchar(255) DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `naissances`
--

LOCK TABLES `naissances` WRITE;
/*!40000 ALTER TABLE `naissances` DISABLE KEYS */;
INSERT INTO `naissances` VALUES (1,'Sarr','Mouhamed','2006-03-09',NULL,NULL,'Dakar','2026-11-16 01:29:12','2026-11-16 01:29:12');
/*!40000 ALTER TABLE `naissances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'info',
  `lu` tinyint(1) NOT NULL DEFAULT 0,
  `destinataire_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_destinataire_id_foreign` (`destinataire_id`),
  CONSTRAINT `notifications_destinataire_id_foreign` FOREIGN KEY (`destinataire_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'Nouveau mariage enregistré','Fallou Diop & BB Ndeye — 19/06/2026','mariage',0,NULL,'2026-08-20 03:53:26','2026-08-20 03:53:26'),(2,'Nouveau mariage enregistré','Fallou Diop & Amina Sow — 19/06/2026','mariage',0,NULL,'2026-08-20 04:06:19','2026-08-20 04:06:19'),(3,'Nouveau mariage enregistré','Ismaila Badiane & Fatou Gaye — 19/06/2026','mariage',0,NULL,'2026-08-20 04:06:52','2026-08-20 04:06:52'),(4,'Nouveau mariage enregistré','Mounir Diallo & Ameeh Sy — 11/11/2026','mariage',0,NULL,'2026-11-11 00:07:31','2026-11-11 00:07:31'),(5,'Nouvelle naissance enregistrée','Mouhamed Sarr — 09/03/2006','naissance',0,NULL,'2026-11-16 01:29:12','2026-11-16 01:29:12');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('5Yy8QtAVrlCFmDlKTZ26isEQYW646EC74DLJxfYm',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQjlYVEZpZER5YW83TFlrWnNzN3czQ3Ztck1iQlR2d1RESVJyZTk4RCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794790559),('GQRTgHWlzXz6AE5yHx0wQKn9yALbEBJ02cKVkYO5',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVnBRM3ZsanhuTEN5enVhVmtxYnhLeHNrcFA1SGswYllEUHhQQ1pISyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==',1794790569),('OEmViCfRR0S0VAEJwSuDXTHMSD3Uwvzmn00KoBaV',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoicW9KaGY4RUY0Y3ZRNDVkSmdIRGJJdU95djFPY1gyVExabHpVc2gzMSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9',1794355690);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'citoyen',
  `institution_id` bigint(20) unsigned DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `utilisateurs_email_unique` (`email`),
  KEY `utilisateurs_institution_id_foreign` (`institution_id`),
  CONSTRAINT `utilisateurs_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'Admin','admin@example.com',NULL,'$2y$12$Ve4GU1fZADv7Ae/K4cEhLuxt8mmatiCjd85yfnc2gCwfoMZ2qyZj2','admin',NULL,'701234567',NULL,NULL,'2026-08-09 20:12:31','2026-08-09 20:12:31'),(2,'Moussa Diallo','moussa@example.com',NULL,'$2y$12$iEyM.U.G12FkG8FKP2qJ6O69c.7FRb0/suFbiXG6V/xu42kuQyXC2','responsable',NULL,'701234568',NULL,NULL,'2026-08-09 20:12:31','2026-08-09 20:12:31'),(3,'Admin','admin@gestion.sn',NULL,'$2y$12$EjPgjyCZuTZ9KAGSa.DBM.SF5aTLiibMppCmqzbjPfAAriYW80Q2O','admin',NULL,NULL,NULL,NULL,'2026-08-09 20:29:53','2026-08-09 20:29:53'),(4,'Responsable','responsable@gestion.sn',NULL,'$2y$12$iqNgjIXpnLujNojBHaiaSuVgYyy2YEXZjFcXj1OxkU6kWdnHIn2F2','responsable',7,NULL,NULL,NULL,'2026-08-16 18:19:37','2026-08-17 02:17:01'),(5,'Citoyen','citoyen@test.sn',NULL,'$2y$12$vzzghSLJLzGAOzqvDzTATusmqlAyN2jB2ozsDtBAthgkntWO.mJgC','citoyen',NULL,NULL,NULL,NULL,'2026-08-16 18:24:56','2026-08-16 18:24:56'),(6,'Aminata Gaye','gayeaminata12@gestion.sn',NULL,'$2y$12$wr/PraJOO9HtL4212/R1POAqenMDunoBDz3fujq7z40qzbAzU/rX2','citoyen',NULL,'+221773833400','DAKAR',NULL,'2026-11-16 01:19:10','2026-11-16 01:19:10');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-16 23:32:56
