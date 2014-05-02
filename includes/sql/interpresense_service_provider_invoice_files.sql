--
-- Table structure for table `interpresense_service_provider_invoice_files`
--

DROP TABLE IF EXISTS `interpresense_service_provider_invoice_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_service_provider_invoice_files` (
  `file_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) unsigned NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_content` longblob NOT NULL,
  `file_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_size` int(11) unsigned NOT NULL,
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `link_to_invoices_idx` (`invoice_id`),
  CONSTRAINT `link_to_invoices` FOREIGN KEY (`invoice_id`) REFERENCES `interpresense_service_provider_invoices` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;