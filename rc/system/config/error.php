<?php
/*
     Setup your error handling variables.
*/

/*
    Email from and to whom marked error is sent
*/
$error['admin_email'] = "";

/*
    Page to which is user redirected when error occurs in production enviroment.
    Provide a full path to page.
*/
$error['generic_error_page'] = __DIR__ . "/../Errors/Default.php";

/*
    Log file for development enviroment
*/
$error['dev_log_file'] = __DIR__ . "/../Logs/error_dev.log";

/*
   Log file for production enviroment
*/
$error['prod_log_file'] = __DIR__ . "/../Logs/error_prod.log";
