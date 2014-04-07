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
INSERT INTO `interpresense_settings` VALUES (1,'invoice_file_attachments_allowed','1',NOW(),NOW());
INSERT INTO `interpresense_settings` VALUES (2,'institution_name','University of Ottawa',NOW(),NOW());
INSERT INTO `interpresense_settings` VALUES (3,'institution_address','550 Cumberland',NOW(),NOW());
INSERT INTO `interpresense_settings` VALUES (4,'institution_email','adapt@uottawa.ca',NOW(),NOW());
INSERT INTO `interpresense_settings` VALUES (5,'institution_phone','6135625800',NOW(),NOW());
INSERT INTO `interpresense_settings` VALUES (6,'institution_default_lang','en-CA',NOW(),NOW());
INSERT INTO `interpresense_settings` VALUES (7,'institution_logo',NULL,NOW(),NOW());
INSERT INTO `interpresense_settings` VALUES (8,'invoicing_earliest_possible_hour','7',NOW(),NOW());
INSERT INTO `interpresense_settings` VALUES (9,'invoicing_latest_possible_hour','22',NOW(),NOW());
/*!40000 ALTER TABLE `interpresense_settings` ENABLE KEYS */;
UNLOCK TABLES;