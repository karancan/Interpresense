--
-- Table structure for table `interpresense_email_templates`
--

DROP TABLE IF EXISTS `interpresense_email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_email_templates` (
  `email_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `cc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bcc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- @todo: add insert statements for emails that are available (invoice added, invoice approved, account creation, account update account password reset, ...?)
INSERT INTO `interpresense_email_templates` (`email_id`, `name`, `content`, `description`, `subject`) VALUES (1, 'Account creation', 'A fancy email :)', 'This email is sent out when an administrative user creates an account.', 'Interpresense - Account created');
INSERT INTO `interpresense_email_templates` (`email_id`, `name`, `content`, `description`, `subject`) VALUES (2, 'Account modification', 'A fancy email :)', 'This email is sent out when an administrative user changes user details for an account.', 'Interpresense - Account details changed');
INSERT INTO `interpresense_email_templates` (`email_id`, `name`, `content`, `description`, `subject`) VALUES (3, 'Password reset', '<p>A fancy email :)</p><p>#passwordResetLink</p>', 'This email is sent out when an user requests a password reset.', 'Interpresense - Password reset');