<?php

require 'config.php';
session_start();

//@todo: switch the language

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;