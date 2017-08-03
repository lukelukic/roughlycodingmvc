<?php
/*----------------Ucitavanje konfiguracije ----------*/
require 'config/config.php';

/*---------------Poziv kontrolera iz foldera gde se kontroleri nalaze------------------*/
use rc\Controllers;

function callController($controller, $method)
{
    $controller = "rc\app\Controllers\\" . ucfirst(strtolower($controller));
    if (class_exists($controller)) {
        $controller = new $controller();
        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            header("HTTP/1.1 404 Not Found");
            include("Errors/404_Method.php");
        }
    }
}

/*---------------------Cepanje URL-a da bi se dobili kontroler i njegova funkcija----------------*/
/*
    Za zaobilzenje index strane dodati sledeci kod u .htaccess koji se nalazi u root folderu :
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
*/
$URL = $_SERVER['REQUEST_URI'];
$urlVars = explode("/", $URL);

if ($urlVars[2] === INDEX) {
    $controller = isset($urlVars[3]) && $urlVars[3] ? explode('?', $urlVars[3])[0] : $config['default_controller'];
    $method = isset($urlVars[4]) && $urlVars[4] ? explode('?', $urlVars[4])[0] : "index";
} else {
    $controller = isset($urlVars[2]) && $urlVars[2] ? explode('?', $urlVars[2])[0] : $config['default_controller'];
    $method = isset($urlVars[3]) && $urlVars[3] ? explode('?', $urlVars[3])[0] : "index";
}

callController($controller, $method);
