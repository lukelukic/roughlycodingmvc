<?php
use rc\system\Exceptions\SetupException;

/*
 whoops is an error handler framework for PHP. Out-of-the-box,
 it provides a pretty error interface that helps you debug your
 web projects, but at heart it's a simple yet powerful stacked error handling system.

 CAUTION : USE IT ONLY IF YOU HAVE PULLED COMPOSER DEPENDENCIES, OTHERWISE IT WILL CAUSE AN ERROR

*/

$class = "Whoops\Run";
try {
    if (class_exists($class)) {
        $whoops = new $class;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    } else {
        throw new SetupException("Whoops not found in Vendor folder! Run composer update within root folder.");
    }
} catch (SetupException $e) {
    $message =  $e->getMessage();
    $e->error();
}
