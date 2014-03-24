--
-- Table structure for table `interpresence_settings`
--

DROP TABLE IF EXISTS `interpresence_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresence_settings` (
  `setting_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inserted_on` datetime NOT NULL,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `setting_key_UNIQUE` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interpresence_settings`
--

LOCK TABLES `interpresence_settings` WRITE;
/*!40000 ALTER TABLE `interpresence_settings` DISABLE KEYS */;
INSERT INTO `interpresence_settings` VALUES (1,'invoice_file_attachments_allowed','1','2014-03-24 00:00:00');
/*!40000 ALTER TABLE `interpresence_settings` ENABLE KEYS */;
UNLOCK TABLES;