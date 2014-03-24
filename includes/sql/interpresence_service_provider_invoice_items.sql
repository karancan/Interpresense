--
-- Table structure for table `interpresence_service_provider_invoice_items`
--

DROP TABLE IF EXISTS `interpresence_service_provider_invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresence_service_provider_invoice_items` (
  `item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `rate` decimal(6,2) NOT NULL,
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `link_to_invoice_idx` (`invoice_id`),
  CONSTRAINT `link_to_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `interpresence_service_provider_invoices` (`invoice_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;