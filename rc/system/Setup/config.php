<?php
use rc\system\Exceptions;

/*
    Enviroment constants. Do not change!
*/
define("PROD", 1);
define("DEV", 0);

/*
    Loading config file on which this setup builds upon
*/
require_once __DIR__ . '/../config/config.php';

/*
    Loading URL helper. Whole application depends on it.
*/
require_once __DIR__ . '/../Helpers/url.php';

/*
    Getting application's root folder based on URL
*/
$tmp= explode("/", $config['base_url']);
$root = "";
for ($i=3; $i<count($tmp); $i++) {
    $root .= $tmp[$i] . "/";
}
$root = trim($root, "/");
$config['root'] = $root;

/*
    Defining constats based on user's config file
*/
define('BASE_URL', $config['base_url']);
define('INDEX', $config['index']);
define('ROOT', $config['root']);
define('APP_NAME', $config['app_name']);
define("ENV", $config['enviroment']);


/*
    Loading helpers from config's $helper array
*/
function loadHelpers($arr)
{
    foreach ($arr as $ar) {
        $file = __DIR__ . "/" . "../Helpers/" . $ar . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    }
}

/*
    Autoloading framework's native classes, PSR4
*/
function rc_autoloader($class)
{
    $file = str_replace('\\', '/', $class) . '.php';
    $file = rootDir() . $file;
    if (file_exists($file)) {
        if (is_readable($file)) {
            require_once $file;
        }
    }
}
/*
    Registering native autoloader
*/
spl_autoload_register('rc_autoloader');


/*
    Calling vendor's autoloader
*/
try {
    if (file_exists(rootDir() . "vendor/autoload.php")) {
        require_once rootDir() . "vendor/autoload.php";
    } else {
        throw new Exceptions\SetupException("Requirements from composer.json failed to load. Please use composer update command within root folder.");
    }
} catch (Exceptions\SetupException $e) {
    echo $e->error();
}

/*
    Where loading helpers happens
*/
loadHelpers($helpers);
