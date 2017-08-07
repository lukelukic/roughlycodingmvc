<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use \Monolog\Formatter\LineFormatter;
use Monolog\ErrorHandler;



//Globalni logger koji ce da prati sve vidove obavestenja
$log = new Logger('rcframework');
//Formatiranje linije da nema uglaste zagrade na kraju
$formatter = new LineFormatter(null, null, false, true);
// Handler koji belezi sve
$debugHandler = new StreamHandler(rootDir() . "rc/system/Logs/all.log", Logger::DEBUG);
$debugHandler->setFormatter($formatter);
// Handler koji belezi samo error-e
$errorHandler = new StreamHandler(rootDir() . 'rc/system/Logs/error.log', Logger::ERROR);
$errorHandler->setFormatter($formatter);
// Dodavanje handlera
$log->pushHandler($debugHandler);
$log->pushHandler($errorHandler);

$handler = new ErrorHandler($log);
$handler->registerErrorHandler([], true);
$handler->registerExceptionHandler();
$handler->registerFatalHandler();

function logInfo($message)
{
    $log = new Logger('usage');
    $formatter = new LineFormatter(null, null, false, true);
    $usageHandler = new StreamHandler(rootDir() . "rc/system/Logs/usage.log", Logger::DEBUG);
    $usageHandler->setFormatter($formatter);
    $log->pushHandler($usageHandler);
    $log->addInfo($message);
}
