--
-- Table structure for table `interpresense_service_provider_invoices`
--

DROP TABLE IF EXISTS `interpresense_service_provider_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_service_provider_invoices` (
  `invoice_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_uid` char(128) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id_for_sp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_id_for_org` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sp_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_postal_code` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `sp_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sp_province` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `sp_phone` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `sp_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sp_hst_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_final` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Value of 0 indicates draft invoice. Value of 1 indicates final invoice.',
  `grand_total` decimal(6,2) DEFAULT NULL,
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `approved_on` datetime DEFAULT NULL,
  `approved_by` int(11) unsigned DEFAULT NULL,
  `admin_viewed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `admin_last_viewed_on` datetime DEFAULT NULL,
  `admin_last_viewed_by` int(11) unsigned NULL,
  PRIMARY KEY (`invoice_id`),
  UNIQUE KEY `invoice_uid_UNIQUE` (`invoice_uid`),
  KEY `link_to_users_idx` (`approved_by`),
  CONSTRAINT `link_to_users` FOREIGN KEY (`approved_by`) REFERENCES `interpresense_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;