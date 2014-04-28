--
-- Table structure for table `interpresense_template_placeholders`
--

DROP TABLE IF EXISTS `interpresense_template_placeholders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_template_placeholders` (
  `placeholder_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `placeholder` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `for_emails` tinyint(1) NOT NULL DEFAULT '0',
  `for_reports` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`placeholder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- @todo: add insert statements for placeholders that are available
-- @todo: update Wiki