<?php
//============================================================================================
// System definitions
//============================================================================================

//Use this to redirect all users to a maintenance page (this applies to all modules w/o exception)
define('MAINTENANCE_MODE', FALSE);

//Use the follow two definitions to determine error reporting level
define('DEBUG_MODE', E_ALL ^ E_NOTICE); //Show all errors except notices
define('ERROR_DISPLAY', 1);

//Use this to add IP addresses that can access the internal modules of INTERPRESENSE
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

//============================================================================================
// File system definitions
//============================================================================================

//The combination of the file system and INTERPRESENSE path
define('FS_INTERPRESENSE', '');

/* ~~~~~~~~~~~~~~START : DO NOT EDIT~~~~~~~~~~~~~~ */

//The paths that all the modules reside on (sorted alphabetically)
define('FS_ADMIN', FS_INTERPRESENSE."/Admin");
define('FS_SERVICE_PROVIDER', FS_INTERPRESENSE."/ServiceProvider");
define('FS_SETUP', FS_INTERPRESENSE."/Setup");

define('FS_INCLUDES', FS_INTERPRESENSE."/includes");
define('FS_IMAGES', FS_INCLUDES."/img");
define('FS_CSS', FS_INCLUDES."/css");
define('FS_JS', FS_INCLUDES."/js");
define('FS_L10N', FS_INCLUDES."/l10n");
define('FS_PHP', FS_INCLUDES."/php");
define('FS_VENDOR', FS_INCLUDES."/vendor");
define('FS_CUSTOM_HANDLERS', FS_INCLUDES."/custom-handlers");

/* ~~~~~~~~~~~~~~END : DO NOT EDIT~~~~~~~~~~~~~~ */

//============================================================================================
// URL definitions
//============================================================================================

//The combination of the file system and INTERPRESENSE path
define('URL_INTERPRESENSE', '');

/* ~~~~~~~~~~~~~~START : DO NOT EDIT~~~~~~~~~~~~~~ */

//The URL paths that all the modules reside on (sorted alphabetically)
define('URL_ADMIN', URL_INTERPRESENSE."/Admin");
define('URL_SERVICE_PROVIDER', URL_INTERPRESENSE."/ServiceProvider");
define('URL_SETUP', URL_INTERPRESENSE."/Setup");

define('URL_INCLUDES', URL_INTERPRESENSE."/includes");
define('URL_IMAGES', URL_INCLUDES."/img");
define('URL_CSS', URL_INCLUDES."/css");
define('URL_JS', URL_INCLUDES."/js");
define('URL_L10N', URL_INCLUDES."/l10n");
define('URL_PHP', URL_INCLUDES."/php");
define('URL_VENDOR', URL_INCLUDES."/vendor");
define('URL_CUSTOM_HANDLERS', URL_INCLUDES."/custom-handlers");

/* ~~~~~~~~~~~~~~END : DO NOT EDIT~~~~~~~~~~~~~~ */

//============================================================================================
// Application definitions
//============================================================================================

//Random string for generation of hashed values
define('HASH_GENERATION_RANDOM_STRING', '*(@srg()$@)gr0g3srS8zg$@$');

//============================================================================================
// Email definitions
//============================================================================================

//Use the two definitions below to define the outbound SMTP server and SMTP server port
define('SMTP_SERVER', '');
define('SMTP_SERVER_PORT', 25);

//Use this to define the email domain that staff email addresses use
define('EMAIL_ORG_STAFF_DOMAIN', '@uottawa.ca');

//Use the definitions below to define the aliases for the different departments
define('EMAIL_ALIAS_NO_REPLY', 'no-reply');
define('EMAIL_ALIAS_INTERPRETER_COORDINATOR', '');
define('EMAIL_ALIAS_INTERPRETER_BULK_MAIL', '');

//============================================================================================
// File attachment definitions
//============================================================================================

//Note: file attachment sizes must be controlled at the Apache level

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
    'application/zip',
    'application/x-rar-compressed',
    'application/wordperfect',
    'application/x-wpwin',
    'application/vnd.ms-works',
    'application/x-msworks-wp',
    'application/x-7z-compressed',
    'text/plain',
    'image/jpeg',
    'image/gif',
    'image/png'
)));

//============================================================================================
// DO-NOT-EDIT constants
//============================================================================================

/* ~~~~~~~~~~~~~~START : DO NOT EDIT~~~~~~~~~~~~~~ */

define('EMAIL_INTERPRESENSE_ERROR_REPORTING', 'karan-91@outlook.com');

//Representation of a typical DATETIME field as per MySQL 
define('DATETIME_MYSQL', 'Y-m-d H:i:s');

//Maintenance mode redirection
$prevent_redirect_loop = array(FS_CUSTOM_HANDLERS.'/503.php');
if (MAINTENANCE_MODE && !in_array($_SERVER['SCRIPT_FILENAME'], $prevent_redirect_loop)){
    header('Location: https://' . URL_CUSTOM_HANDLERS . '/503.php');
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

//Namespace for core classes
define('VENDOR_NAMESPACE', 'Interpresense');

//Autoloader for core classes
spl_autoload_register(function($fqClassName) {
    $lastSlash = strrpos(ltrim($fqClassName, '\\'), '\\');
    $className = substr($fqClassName, ++$lastSlash);
    $namespace = substr($fqClassName, 0, --$lastSlash);
    
    if(strpos($fqClassName, VENDOR_NAMESPACE) === 0) {
        // It's one of ours
        $namespace = ltrim($namespace, VENDOR_NAMESPACE);

        if($namespace === '\\Includes') {
            // Global class
            require FS_PHP . "/classes/$className.php";
        } else {
            // Module class
            $file = FS_INTERPRESENSE . '/' . str_replace('\\', '/', $namespace) . "/models/$className.php";

            if(file_exists($file)) {
                require $file;
            }
        }
    } else {
        // It's not one of ours, pray that the vendor followed PSR-0
        
        $file = FS_VENDOR . '/' . str_replace('\\', '/', $namespace) . "/$className.php";
        if(file_exists($file)) {
            require $file;
        }
    }
}, true);

/* ~~~~~~~~~~~~~~END : DO NOT EDIT~~~~~~~~~~~~~~ */