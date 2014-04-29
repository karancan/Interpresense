--
-- Table structure for table `interpresense_template_placeholders`
--

DROP TABLE IF EXISTS `interpresense_template_placeholders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_template_placeholders` (
  `placeholder_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `placeholder` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8_unicode_ci NOT NULL,
  `description_fr` text COLLATE utf8_unicode_ci NOT NULL,
  `for_emails` tinyint(1) NOT NULL DEFAULT '0',
  `for_reports` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`placeholder_id`),
  UNIQUE KEY `placeholder_UNIQUE` (`placeholder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `interpresense_template_placeholders` WRITE;
/*!40000 ALTER TABLE `interpresense_template_placeholders` DISABLE KEYS */;
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#adminUserName','User name of administrative user','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#adminUserFirstName','First name of administrative user','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#adminUserLastName','Last name of administrative user','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#adminUserAccountExpiresOn','Expiry date of administrative user account','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#adminUserAccountCreatedOn','Creation date of administrative user account','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#adminUserLastLogOn','The last time an administrative user logged in','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#institutionName','The name of the institution using this application','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#institutionEmail','The email of the institution using this application','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#institutionPhone','The phone number of the institution using this application','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#institutionDeptName','The name of the department within the institution using this application','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#institutionDeptContactName','The name of the individual dealing with invoices at the department','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#institutionDeptContactEmail','The email of the individual dealing with invoices at the department','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#institutionDeptContactPhone','The phone number of the individual dealing with invoices at the department','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#institutionDeptContactTitle','The job title of the individual dealing with invoices at the department','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceIdForSp','The invoice identifier used by the service provider when completing the invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceIdForOrg','The invoice identifier used by the organization to track an invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceSpName','The name of the service provider who filled out the invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceSpAddress','The address of the service provider who filled out the invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceSpPostalCode','The postal code of the service provider who filled out the invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceSpPhone','The phone number of the service provider who filled out the invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceSpEmail','The email of the service provider who filled out the invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceSpHstNum','The HST number of the service provider who filled out the invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceIsFinal','This indidicates if the invoice is finalized or in the draft state','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceGrandTotal','The grand total for a particular invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceIsApproved','This indicates if the invoice has been approved by an administrative user','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceApprovedBy','The name of the administrative user who has approved the invoice','',1,1);
INSERT INTO `interpresense_template_placeholders` (`placeholder`, `description_en`, `description_fr`, `for_emails`, `for_reports`) VALUES ('#invoiceApprovedOn','The date an invoice was approved by an administrative user','',1,1);
/*!40000 ALTER TABLE `interpresense_template_placeholders` ENABLE KEYS */;
UNLOCK TABLES;

-- @todo: add Francais descriptions
-- @todo: update Wiki