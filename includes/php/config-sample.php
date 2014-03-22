<?php
//============================================================================================
// System definitions
//============================================================================================

//Use this to redirect all users to a maintenance page (this applies to all modules w/o exception)
define('MAINTENANCE_MODE', FALSE);

//Use the follow two definitions to determine error reporting level
define('DEBUG_MODE', E_ALL ^ E_NOTICE); //Show all errors except notices
define('ERROR_DISPLAY', 1);

//Use this to add IP addresses that can access the internal modules of Interpreter
//To allow connections from ANY IP, use `serialize(array('0.0.0.0/0'))`
//To block connections from EVERY IP, use `serialize(array('0.0.0.0/32'))`
define('ALLOWED_IPS', serialize(array('0.0.0.0/0')));

//============================================================================================
// Database definitions
//============================================================================================

define('DB_HOSTNAME', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_NAME', '');
define('DB_PORT', 3306);

//============================================================================================
// File system definitions
//============================================================================================

//The server file system path that the "intranet" resides on (empty string if Interpreter is the only app)
define('FS_INTRANET', $_SERVER['DOCUMENT_ROOT']);

//The path that Interpreter resides on within the "intranet" folder
define('FS_INTRANET_INTERPRETER', '');

/* ~~~~~~~~~~~~~~START : DO NOT EDIT~~~~~~~~~~~~~~ */

//The combination of the file system and Interpreter path
define('FS_INTERPRETER', FS_INTRANET.FS_INTRANET_INTERPRETER);

//The paths that all the modules reside on (sorted alphabetically)
define('FS_ADMIN', FS_INTERPRETER."/admin");
define('FS_SERVICE_PROVIDER', FS_INTERPRETER."/service-provider");

define('FS_INCLUDES', FS_INTERPRETER."/includes");
define('FS_CSS', FS_INCLUDES."/css");
define('FS_JS', FS_INCLUDES."/js");
define('FS_L10N', FS_INCLUDES."/l10n");
define('FS_PHP', FS_INCLUDES."/php");

/* ~~~~~~~~~~~~~~END : DO NOT EDIT~~~~~~~~~~~~~~ */

//============================================================================================
// URL definitions
//============================================================================================

//The URL path that the "intranet" resides on (use empty string if Interpreter is the only app)
define('URL_INTRANET', 'localhost');

//The URL path that Interpreter resides on within the "intranet"
define('URL_INTRANET_INTERPRETER', '');

/* ~~~~~~~~~~~~~~START : DO NOT EDIT~~~~~~~~~~~~~~ */

//The combination of the file system and Interpreter path
define('URL_INTERPRETER', URL_INTRANET.URL_INTRANET_INTERPRETER);

//The URL paths that all the modules reside on (sorted alphabetically)
define('URL_ADMIN', URL_INTERPRETER."/admin");
define('URL_SERVICE_PROVIDER', URL_INTERPRETER."/service-provider");

define('URL_INCLUDES', URL_INTERPRETER."/includes");
define('URL_IMAGES', URL_INCLUDES."/img");
define('URL_CSS', URL_INCLUDES."/css");
define('URL_JS', URL_INCLUDES."/js");
define('URL_L10N', URL_INCLUDES."/l10n");
define('URL_PHP', URL_INCLUDES."/php");

/* ~~~~~~~~~~~~~~END : DO NOT EDIT~~~~~~~~~~~~~~ */
 
//============================================================================================
// Organization-wide definitions
//============================================================================================



//============================================================================================
// Application definitions
//============================================================================================

//Valid options are 'en-CA' and 'fr-CA'
define('DEFAULT_LANGUAGE', 'en-CA');

//Day of week labels used in org_courses column day_of_week
define('DAY_OF_WEEK_LABELS', serialize(array(
    'monday' => 'LU',
    'tuesday' => 'MA',
    'wednesday' => 'ME',
    'thursday' => 'JE',
    'friday' => 'VE',
    'saturday' => 'SA',
    'sunday' => 'DI'
)));

//Random string for generation of hashed values
define('HASH_GENERATION_RANDOM_STRING', '*(@srg()$@)gr0g3srS8zg$@$');

//============================================================================================
// Internal service definitions
//============================================================================================

//Use value of `service_id` in the table `org_services`
define('SERVICE_ID_ACCESS', '3');
define('SERVICE_ID_COUNSELLING', '4');

//============================================================================================
// Internal sub-service definitions
//============================================================================================

//============================================================================================
// Email definitions
//============================================================================================

//Use the two definitions below to define the outbound SMTP server and SMTP server port
define('SMTP_SERVER', 'smtp-out.uottawa.ca');
define('SMTP_SERVER_PORT', 25);

//Use this to define the email domain that students email addresses use
define('EMAIL_ORG_STUDENT_DOMAIN', '@uottawa.ca');

//Use this to define the email domain that faculty/staff email addresses use
define('EMAIL_ORG_STAFF_DOMAIN', '@uottawa.ca');

//Use the definitions below to define the aliases for the different departments
define('EMAIL_ALIAS_NO_REPLY', 'no-reply');
define('EMAIL_ALIAS_INTERPRETER_ADMIN', '');
define('EMAIL_ALIAS_ACCESS_SERVICE_EXAMS', '');
define('EMAIL_ALIAS_ACCESS_SERVICE_COUNSELORS', '');
define('EMAIL_ALIAS_ACCESS_SERVICE_INTERPRETER_COMMUNICATION', '');
define('EMAIL_ALIAS_COUNSELLING_SERVICE', '');

//============================================================================================
// File attachment definitions
//============================================================================================

//Note: file attachment sizes must be controlled at the Apache level

//For all places where exam files can be uploaded, the following English message is shown as to
//what types of exam files are permitted
define('FILE_TYPES_ALLOWED_LABEL_EN', 'Allowed types are documents (Word, WordPerfect, Works, PowerPoint, Excel, PDF, RTF, plain text), images (JPEG, GIF, PNG), audio (AIFF, WAV, M3U, MP3, WMA), video (AVI, MOV, MP4, WMV) and compressed files (7Z, RAR, ZIP).');

//For all places where exam files can be uploaded, the following French message is shown as to
//what types of exam files are permitted
define('FILE_TYPES_ALLOWED_LABEL_FR', 'Types de fichiers permis sont des documents (Word, WordPerfect, Works, PowerPoint, Excel, PDF, RTF, texte brut), des images (JPEG, GIF, PNG), des fichiers audio (AIFF, WAV, M3U, MP3, WMA), des vidéos (AVI, MOV, MP4, WMV) et des fichiers compressés (7Z, RAR, ZIP).');

//Specify the MIME type of the file types that users can upload for Exam
define('FILE_TYPES_ALLOWED', serialize(array(
    'application/vnd.ms-excel',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.ms-powerpoint',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    'application/rtf',
    'application/pdf',
    'text/plain',
    'image/jpeg',
    'image/gif',
    'image/png',
    'audio/x-wav',
    'audio/wav',
    'audio/x-ms-wma',
    'audio/mpeg',
    'video/mp4',
    'application/zip',
    'application/x-rar-compressed',
    'application/wordperfect',
    'application/x-wpwin',
    'application/vnd.ms-works',
    'application/x-msworks-wp',
    'audio/x-mpequrl',
    'audio/x-m4a',
    'video/mpeg',
    'video/quicktime',
    'video/avi',
    'video/msvideo',
    'video/x-msvideo',
    'video/x-ms-wmv',
    'application/x-7z-compressed',
    'audio/mp3',
    'audio/x-aiff',
    'audio/aiff'
)));

//============================================================================================
// Plugin definitions
//============================================================================================

//============================================================================================
// DO-NOT-EDIT constants
//============================================================================================

/* ~~~~~~~~~~~~~~START : DO NOT EDIT~~~~~~~~~~~~~~ */

//Representation of a typical DATETIME field as per MySQL 
define('DATETIME_MYSQL', 'Y-m-d H:i:s');

//Maintenance mode redirection
$prevent_redirect_loop = array(FS_CUSTOM_HANDLERS.'/503.php');
if (MAINTENANCE_MODE && !in_array($_SERVER['SCRIPT_FILENAME'], $prevent_redirect_loop)){
    header('location: https://' . URL_CUSTOM_HANDLERS . '/503.php');
    die();
}

//Set error reporting to the setting as specified in this file
error_reporting(DEBUG_MODE);
ini_set('display_errors', ERROR_DISPLAY);

//Set the locale to the setting as specified in this file
if(!class_exists('Locale')) {
    die('The php_intl extension must be installed.');
}
Locale::setDefault(DEFAULT_LANGUAGE);

//Increase the probability of the session garbage collection being run
//Example: After 30 minues (1800 seconds) of a user having a sesssion, there is
//a 1/15 chance the the garbage collection will clear out old sessions
ini_set('session.gc_maxlifetime', 1800);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 15);

/* ~~~~~~~~~~~~~~END : DO NOT EDIT~~~~~~~~~~~~~~ */