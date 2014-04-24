--
-- Table structure for table `interpresense_admin_reports`
--

DROP TABLE IF EXISTS `interpresense_admin_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_admin_reports` (
  `report_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template_id` int(11) unsigned NOT NULL,
  `generated_by` int(11) unsigned NOT NULL,
  `report_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `report_content` longblob NOT NULL,
  `report_file_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `report_file_size` int(11) unsigned NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`report_id`),
  KEY `link_to_users_idx` (`generated_by`),
  KEY `link_to_templates_idx` (`template_id`),
  CONSTRAINT `link_to_report_generator` FOREIGN KEY (`generated_by`) REFERENCES `interpresense_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `link_to_templates` FOREIGN KEY (`template_id`) REFERENCES `interpresense_admin_report_templates` (`template_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;