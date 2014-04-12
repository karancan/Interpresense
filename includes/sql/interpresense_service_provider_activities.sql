--
-- Table structure for table `interpresense_service_provider_activities`
--

DROP TABLE IF EXISTS `interpresense_service_provider_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_service_provider_activities` (
  `activity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `activity_name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activity_name_fr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interpresense_service_provider_activities`
--

LOCK TABLES `interpresense_service_provider_activities` WRITE;
/*!40000 ALTER TABLE `interpresense_service_provider_activities` DISABLE KEYS */;
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Interpretation','Interprétation',NOW(),NOW());
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Preparation','Préparation',NOW(),NOW());
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Coordination','Coordination',NOW(),NOW());
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Video processing','Traitement vidéo',NOW(),NOW());
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Transcription','Transcription',NOW(),NOW());
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Travel','Voyage',NOW(),NOW());
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Tutoring','Tutorat',NOW(),NOW());
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Note taking','Prise de notes',NOW(),NOW());
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Captioning','Sous-titrage',NOW(),NOW());
INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`) VALUES ('Other','Autre',NOW(),NOW());
/*!40000 ALTER TABLE `interpresense_service_provider_activities` ENABLE KEYS */;
UNLOCK TABLES;