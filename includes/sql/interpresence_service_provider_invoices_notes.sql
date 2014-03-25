--
-- Table structure for table `interpresense_service_provider_invoices_notes`
--

DROP TABLE IF EXISTS `interpresense_service_provider_invoices_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_service_provider_invoices_notes` (
  `note_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`note_id`),
  KEY `link_to_users_idx` (`user_id`),
  KEY `link_to_invoices_from_notes_idx` (`invoice_id`),
  CONSTRAINT `link_to_users_from_notes` FOREIGN KEY (`user_id`) REFERENCES `interpresense_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `link_to_invoices_from_notes` FOREIGN KEY (`invoice_id`) REFERENCES `interpresense_service_provider_invoices` (`invoice_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;