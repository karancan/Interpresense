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

-- @todo: add sensible content for all emails
INSERT INTO `interpresense_email_templates` (`email_id`, `name`, `content`, `description`, `subject`) VALUES (1, 'Account creation', '<div><span style="font-style: italic;">This is an automated message. Please do not reply to this email.</span></div><div><br></div>Dear #adminUserFirstName,<div><br></div><div>An administrative account has been created for you. If you did not make this request, please ignore this email.</div><div><br></div><div>Confirm your account by clicking here: </div>#accountConfirmationLink<div><br></div><div>Thank you,</div><div><br></div>#institutionDeptNameEn<br>#institutionPhone<br>#institutionEmail', 'This email is sent out when an administrative user creates an account', 'Interpresense - Account created');
INSERT INTO `interpresense_email_templates` (`email_id`, `name`, `content`, `description`, `subject`) VALUES (2, 'Account modification', '<div><span style="font-style: italic;">This is an automated message. Please do not reply to this email.</span></div><div><br></div>Dear #adminUserFirstName,<div><br></div><div>Your account details have been modified.</div><div><br></div><div></div><div>First name: <span style="line-height: 1.42857143; font-weight: bold;">#adminUserFirstName</span></div><div>Last name: <span style="line-height: 1.42857143; font-weight: bold;">#adminUserLastName</span></div><div>Account expiry: <span style="line-height: 1.42857143; font-weight: bold;">#adminUserAccountExpiresOn</span></div><div><br></div><div>Thank you,</div><div><br></div>#institutionDeptNameEn<br>#institutionPhone<br>#institutionEmail', 'This email is sent out when an administrative user changes user details for an account', 'Interpresense - Account details changed');
INSERT INTO `interpresense_email_templates` (`email_id`, `name`, `content`, `description`, `subject`) VALUES (3, 'Account password reset', '<p>A fancy email :)</p><p>#passwordResetLink</p>', 'This email is sent out when an user requests a password reset', 'Interpresense - Password reset');
INSERT INTO `interpresense_email_templates` (`email_id`, `name`, `content`, `description`, `subject`) VALUES (4, 'Invoice added', '<p>Content</p>', 'This email is sent out when a service provider adds an invoice', 'Interpresense - Invoice added');
INSERT INTO `interpresense_email_templates` (`email_id`, `name`, `content`, `description`, `subject`) VALUES (5, 'Invoice approved', '<p>Content</p>', 'This email is sent out when an admin user approves an invoice', 'Interpresense - Invoice approved');
INSERT INTO `interpresense_email_templates` (`email_id`, `name`, `content`, `description`, `subject`) VALUES (6, 'Invoice marked as draft', '<p>Content</p>', 'This email is sent out when an admin user marks an invoice as a draft', 'Interpresense - Invoice marked as draft');