<?php

/*
 whoops is an error handler framework for PHP. Out-of-the-box,
 it provides a pretty error interface that helps you debug your
 web projects, but at heart it's a simple yet powerful stacked error handling system.

 CAUTION : USE IT ONLY IF YOU HAVE PULLED COMPOSER DEPENDENCIES, OTHERWISE IT WILL CAUSE AN ERROR

*/



$whoops = new Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
