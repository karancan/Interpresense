--
-- Table structure for table `interpresense_settings`
--

DROP TABLE IF EXISTS `interpresense_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_settings` (
  `setting_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `setting_key_UNIQUE` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interpresense_settings`
--

LOCK TABLES `interpresense_settings` WRITE;
/*!40000 ALTER TABLE `interpresense_settings` DISABLE KEYS */;
INSERT INTO `interpresense_settings` VALUES (1,'invoice_file_attachments_allowed','1','2014-03-24 00:00:00','2014-03-24 00:00:00'),(2,'institution_name','University of Ottawa','2014-03-24 00:00:00','2014-03-24 00:00:00'),(3,'institution_address','550 Cumberland','2014-03-24 00:00:00','2014-03-24 00:00:00'),(4,'institution_email','adapt@uottawa.ca','2014-03-24 00:00:00','2014-03-24 00:00:00'),(5,'institution_phone','6135625800','2014-03-24 00:00:00','2014-03-24 00:00:00'),(6,'institution_default_lang','en-CA','2014-03-24 00:00:00','2014-03-24 00:00:00'),(7,'institution_logo',NULL,'2014-03-24 00:00:00','2014-03-24 00:00:00'),(8,'invoicing_earliest_possible_hour','7','2014-03-24 00:00:00','2014-03-24 00:00:00'),(9,'invoicing_latest_possible_hour','22','2014-03-24 00:00:00','2014-03-24 00:00:00');
/*!40000 ALTER TABLE `interpresense_settings` ENABLE KEYS */;
UNLOCK TABLES;