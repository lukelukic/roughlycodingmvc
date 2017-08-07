<?php
/*----------------Ucitavanje konfiguracije ----------*/
require 'config/config.php';

/*---------------Poziv kontrolera iz foldera gde se kontroleri nalaze------------------*/
use rc\Controllers;

function callController($controller, $method, $params)
{
    $controller = "rc\app\Controllers\\" . ucfirst(strtolower($controller));
    if (class_exists($controller)) {
        if (method_exists($controller, $method)) {
            //Reflection method - objekat pomocu kog moze da se pozove metod sa nizom argumenata, gde ce svaki element niza biti posebna promenljiva
            $reflectionMethod = new ReflectionMethod($controller, $method);
            $reflectionMethod->invokeArgs(new $controller(), $params);
        } else {
            header("HTTP/1.1 404 Not Found");
            include("Errors/404_Method.php");
        }
    } else {
      header("HTTP/1.1 404 Not Found");
      include("Errors/404_Controller.php");
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

$url = $_SERVER['REQUEST_URI'];
//Ako root sajta nije PUBLIC_HTML, cupanje kontrolera, modela i argumenata
if ($config['root']) {
    $root = '/' . $config['root'] . '/';
    //Izdvajanje root foldera iz REQUEST_URI-a
    $url = str_replace($root, "", $url);
}
//Ako se ide preko indexa, odvajanje indexa
if (strpos($url, "index.php")!== false) {
    $url = explode("index.php", $url)[1];
}
$url = trim($url, '/');
$controller_array = explode("/", $url);

$controller = $controller_array[0] ? $controller_array[0] : $config['default_controller'];
$method = isset($controller_array[1]) ? $controller_array[1] : "index";
$params = array();

//Za slucaj da su get-om poslati parametri, odvajanje kontrolera i metoda
$controller = explode("?",$controller)[0];
$method = explode("?",$method)[0];

//Dohvatanje parametara
if(count($controller_array)>2) {
    $params = array();
    for($i=2,$j=0; $i<count($controller_array); $i++) {
      $params['param' . $j++] = $controller_array[$i];
    }
}

callController($controller, $method, $params);
