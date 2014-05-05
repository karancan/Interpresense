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
  `description_en` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_fr` text COLLATE utf8_unicode_ci DEFAULT NULL, 
  `internal_use` tinyint(1) NOT NULL DEFAULT '0',
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
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('installation_complete','0','A value of <code>0</code> indicates installation is incomplete. A value of <code>1</code> indicates installation is complete.','','1',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('installation_accepted_eula','0','A value of <code>0</code> indicates the client has not accepted the product license. A value of <code>1</code> indicates the client has accepted the product license.','','1',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_name','{"en-CA": "University of Ottawa", "fr-CA": "same thing in Francais"}','The name of the organization using this product.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_dept_name','{"en-CA": "Access Service", "fr-CA": "same thing in Francais"}','The name of the department within the organization using this product.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_address','{"en": "DMS 3172", "fr": "same thing in Francais"}','The address of the organization using this product','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_email','adapt@uottawa.ca','The email address shown to service providers submitting invoices.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_phone','6135625800','The phone number shown to service providers submitting invoices.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_default_lang','en-CA','The fallback language for users at the organization. Possible values are <code>en-CA</code> and <code>fr-CA</code>','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_dept_recipient_name','Joanne Heit','The name of the department contact shown to service providers submitting invoices.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_dept_recipient_email','jheit@uottawa.ca','The email of the department contact shown to service providers submitting invoices.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_dept_recipient_phone','613 562 5800 x4219','The phone number of the department contact shown to service providers submitting invoices.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_dept_recipient_title','Assistant Academic Support and Client Services','The title of the department contact shown to service providers submitting invoices.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('institution_fiscal_year_start_month','may','The month of the year when the organization begins its fiscal year. Use full month name in lowercase.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('invoicing_earliest_possible_hour','7','A value between <code>0</code> and <code>23</code> that denotes the earliest possible time option shown to service providers submitting invoices.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('invoicing_latest_possible_hour','22','A value between <code>0</code> and <code>23</code> that denotes the latest possible time option shown to service providers submitting invoices.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('invoicing_allow_drafts','1','A value of <code>0</code> indicates service providers cannot save invoice drafts. A value of <code>1</code> indicates service providers can save drafts.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('invoicing_allow_file_attachments','1','A value of <code>0</code> indicates service providers may not attach files to their invoices. A value of <code>1</code> indicates service may attach files to their invoices.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('service_provider_help_manual_uri','http://','The URL of the help manual that is available to service providers.','','0',NOW(),NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_value`, `description_en`, `description_fr`, `internal_use`,`inserted_on`, `updated_on`) VALUES ('admin_default_date_filter_range_days','2','The number of +- days that the date filter defaults to on all pages that use date filters. Use positive numberic values.','','0',NOW(),NOW());
/*!40000 ALTER TABLE `interpresense_settings` ENABLE KEYS */;
UNLOCK TABLES;

-- @todo: complete `description_fr`