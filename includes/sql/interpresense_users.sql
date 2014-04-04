--
-- Table structure for table `interpresense_users`
--

DROP TABLE IF EXISTS `interpresense_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` binary(60) NOT NULL,
  `user_password_reset_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password_reset_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `expires_on` datetime NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `last_log_in` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_uid_UNIQUE` (`user_uid`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  UNIQUE KEY `user_password_reset_key_UNIQUE` (`user_password_reset_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;