--
-- Table structure for table `interpresense_settings`
--

DROP TABLE IF EXISTS `interpresense_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interpresense_settings` (
  `setting_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) NOT NULL,
  `setting_key_canonical` varchar(255) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `setting_lang` char(5) DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `description_fr` text DEFAULT NULL, 
  `internal_use` tinyint(1) NOT NULL DEFAULT '0',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `setting_key_UNIQUE` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interpresense_settings`
--

LOCK TABLES `interpresense_settings` WRITE;
/*!40000 ALTER TABLE `interpresense_settings` DISABLE KEYS */;
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('installation_complete', 'installation_complete', '0', NULL, 'A value of <code>0</code> indicates installation is incomplete. A value of <code>1</code> indicates installation is complete.', '', 1, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('installation_accepted_eula', 'installation_accepted_eula', '0', NULL, 'A value of <code>0</code> indicates the client has not accepted the product license. A value of <code>1</code> indicates the client has accepted the product license.', '', 1, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_name_en', 'institution_name', 'University of Westeros', 'en-CA', 'The name of the organization using this product (in English)', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_name_fr', 'institution_name', 'Université de Westeros', 'fr-CA', 'The name of the organization using this product (in French)', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_dept_name_en', 'institution_dept_name', 'Disability Services Office', 'en-CA', 'The name of the department within the organization using this product (in English)', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_dept_name_fr', 'institution_dept_name', 'Bureau de la Service du handicap', 'fr-CA', 'The name of the department within the organization using this product (in French)', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_address_en', 'institution_address', '789 Main Street', 'en-CA', 'The address of the organization using this product (in English)', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_address_fr', 'institution_address', '789 Rue Main', 'fr-CA', 'The address of the organization using this product (in French)', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_email', 'institution_email', 'dso@institution.ca', NULL, 'The email address shown to service providers submitting invoices.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_phone', 'institution_phone', '613-123-1234', NULL, 'The phone number shown to service providers submitting invoices.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_default_lang', 'institution_default_lang', 'en-CA', NULL, 'The fallback language for users at the organization. Possible values are <code>en-CA</code> and <code>fr-CA</code>', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_dept_recipient_name', 'institution_dept_recipient_name', 'Joanne Doe', NULL, 'The name of the department contact shown to service providers submitting invoices.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_dept_recipient_email', 'institution_dept_recipient_email', 'jdoe@uottawa.ca', NULL, 'The email of the department contact shown to service providers submitting invoices.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_dept_recipient_phone', 'institution_dept_recipient_phone', '613-123-1234 x6789', NULL, 'The phone number of the department contact shown to service providers submitting invoices.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_dept_recipient_title', 'institution_dept_recipient_title', 'Assistant Academic Support and Client Services', NULL, 'The title of the department contact shown to service providers submitting invoices.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('institution_fiscal_year_start_month', 'institution_fiscal_year_start_month', 'may', NULL, 'The month of the year when the organization begins its fiscal year. Use full month name in lowercase.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('invoicing_earliest_possible_hour', 'invoicing_earliest_possible_hour', '7', NULL, 'A value between <code>0</code> and <code>23</code> that denotes the earliest possible time option shown to service providers submitting invoices.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('invoicing_latest_possible_hour', 'invoicing_latest_possible_hour', '22', NULL, 'A value between <code>0</code> and <code>23</code> that denotes the latest possible time option shown to service providers submitting invoices.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('invoicing_allow_drafts', 'invoicing_allow_drafts', '1', NULL, 'A value of <code>0</code> indicates service providers cannot save invoice drafts. A value of <code>1</code> indicates service providers can save drafts.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('invoicing_allow_file_attachments', 'invoicing_allow_file_attachments', '1', NULL, 'A value of <code>0</code> indicates service providers may not attach files to their invoices. A value of <code>1</code> indicates service may attach files to their invoices.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('invoicing_post_submission_message_en', 'invoicing_post_submission_message', 'Your invoice has been submitted successfully. Please check your email to confirm.', 'en-CA', 'The message displayed after a new invoice is submitted.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('invoicing_post_submission_message_fr', 'invoicing_post_submission_message', 'Votre facture a été soumis. Veuillez vérifier votre courriel pour confirmation.', 'fr-CA', 'The message displayed after a new invoice is submitted.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('invoicing_post_update_message_en', 'invoicing_post_update_message', 'The invoice has been updated.', 'en-CA', 'The message displayed after an invoice is updated.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('invoicing_post_update_message_fr', 'invoicing_post_update_message', 'La facture a été mis à jour.', 'fr-CA', 'The message displayed after an invoice is updated.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('service_provider_help_manual_uri', 'service_provider_help_manual_uri', 'http://', NULL, 'The URL of the help manual that is available to service providers.', '', 0, NOW(), NOW());
INSERT INTO `interpresense_settings` (`setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`, `internal_use`, `inserted_on`, `updated_on`) VALUES ('admin_default_date_filter_range_days', 'admin_default_date_filter_range_days', '2', NULL, 'The number of +- days that the date filter defaults to on all pages that use date filters. Use positive numberic values.', '', 0, NOW(), NOW());

/*!40000 ALTER TABLE `interpresense_settings` ENABLE KEYS */;
UNLOCK TABLES;

-- @todo: put settings to use in code base
-- @todo: complete `description_fr`