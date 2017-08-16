<?php

/*
    Loading config file on which this setup builds upon
*/
require_once __DIR__ . "/../config/error.php";

/*
    All errors are always reported and logged.
    Based on enviroment, errors are being displayed or not.
    Based on enviroment, different files are used for logging.
*/
error_reporting(E_ALL);
ini_set('log_errors', '1');


/*
    Defining constants based on user's error.php config file
*/
define("ADMIN_EMAIL", $error['admin_email']);
define("ERR_PAGE", $error['generic_error_page']);

/*
    Checking enviroment, and based on it setting up error handling.
    DEV - errors are both shown and logged. Log file - rc/system/Logs/error_dev.log
    PROD - errors are just logged. Log file - rc/system/Logs/error_prod.log
*/
if (ENV == DEV) {
    $error['log_file'] = $error['dev_log_file'];
    ini_set('display_errors', '1');
} else {
    $error['log_file'] = $error['prod_log_file'];
    ini_set('display_errors', '0');
}

if (file_exists($error['log_file'])) {
    ini_set("error_log", $error['log_file']);
} else {
    $file = fopen($error['log_file'], 'w');
    ini_set("error_log", $error['log_file']);
    fclose($file);
}
