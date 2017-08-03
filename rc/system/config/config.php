<?php
/*---------BASIC CONFIGURATIONS---------*/

//Error reporting type
$config['error_reporting'] = E_ALL;

//Default controller
$config['default_controller'] = "wellcome";

/*
    Ucitavanje helpera
    U 'helpers' niz uneti nazive zeljenih helpera
    Uputstvo upotrebe svakog nalazi se u njegovom fajlu
    url se koristi u konfiguraciji, ne brisati ga
*/
$helpers = array('url','session');

ini_set('display_errors', 1);

/*---------------------Pozivanje sistemskih funkcija --------------------------------------*/
loadHelpers($helpers);
/*---------------------Funkcija za automatsko ucitavanje helpera-----------------------------*/
function loadHelpers($arr)
{
    foreach ($arr as $ar) {
        $file = __DIR__ . "/" . "../Helpers/" . $ar . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
/*-------------------- Funkcija za automatsko ucitavanje zahtevane klase -------------------*/
spl_autoload_register(function ($class) {
    $file = str_replace('\\', '/', $class) . '.php';
    $file = rootDir() . $file;
    if (file_exists($file)) {
        if (is_readable($file)) {
            require_once $file;
        } else {
            require_once __DIR__ . '/../Errors/403.php';
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        require_once __DIR__ . '/../Errors/404_Controller.php';
    }
});
