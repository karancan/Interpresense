<?php

require 'config.php';
session_start();

$acceptableLanguages = unserialize(AVAILABLE_LANGUAGES);

//Do we have a specified language requested and is it a valid language?
if (isset($_GET['lang']) && in_array($_GET['lang'], $acceptableLanguages)){
    $_SESSION['lang'] = $_GET['lang'];
} else {
    //@todo: fetch default language from database and use that
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;