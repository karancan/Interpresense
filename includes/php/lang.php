<?php

require 'config.php';
session_start();

$dbo = new \Interpresense\Includes\DatabaseObject();
$settings = \Interpresense\Includes\ApplicationSettings::load($dbo);

$acceptableLanguages = unserialize(AVAILABLE_LANGUAGES);

//Do we have a specified language requested and is it a valid language?
if (isset($_GET['lang']) && in_array($_GET['lang'], $acceptableLanguages)){
    $_SESSION['lang'] = $_GET['lang'];
} else {
    $_SESSION['lang'] = $settings['institution_default_lang'];
}

header("Location: " . $_SERVER['HTTP_REFERER']); //@todo: what if HTTP referer is empty?
exit;