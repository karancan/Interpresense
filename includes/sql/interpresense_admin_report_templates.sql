--
-- Table structure for table `interpresense_admin_report_templates`
--

DROP TABLE IF EXISTS `interpresense_admin_report_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_admin_report_templates` (
  `template_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `inserted_on` datetime NOT NULL,
  PRIMARY KEY (`template_id`),
  KEY `link_to_admin_users_idx` (`user_id`),
  CONSTRAINT `link_to_admin_users` FOREIGN KEY (`user_id`) REFERENCES `interpresense_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;