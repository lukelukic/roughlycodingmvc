<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;

if(!file_exists(rootDir() . "/logger.log")) {
  fopen(rootDir() . "/logger.log","w");
  fclose(rootDir() . "/logger.log");
}

$log = new Logger('name');
$log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));
