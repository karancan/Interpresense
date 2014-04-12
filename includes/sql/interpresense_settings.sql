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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interpresense_settings`
--

LOCK TABLES `interpresense_settings` WRITE;
/*!40000 ALTER TABLE `interpresense_settings` DISABLE KEYS */;
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('installation_complete','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('institution_name','{"en-CA": "University of Ottawa", "fr-CA": "same thing in Francais"}',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('institution_dept_name','{"en-CA": "Access Service", "fr-CA": "same thing in Francais"}',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('institution_address','{"en": "DMS 3172", "fr": "same thing in Francais"}',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('institution_email','adapt@uottawa.ca',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('institution_phone','6135625800',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('institution_default_lang','en-CA',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('institution_logo',NULL,NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('invoicing_earliest_possible_hour','7',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('invoicing_latest_possible_hour','22',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('invoicing_allow_drafts','1',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('invoicing_allow_file_attachments','1',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('service_provider_help_manual_uri','',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('primary_color_class_name','info',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `inserted_on`, `updated_on`) VALUES ('secondary_color_class_name','primary',NOW(),NOW());
/*!40000 ALTER TABLE `interpresense_settings` ENABLE KEYS */;
UNLOCK TABLES;