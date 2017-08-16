<?php
/*
    Handling URL and based on it, loading controller, method and method's arguments
*/



use rc\Controllers;
use rc\system\Exceptions as Ex;

/*
    Loading controller, method, and if exist, method's parameters
*/
function callController($controller, $method, $params)
{
    try {
        $controller = "rc\app\Controllers\\" . ucfirst(strtolower($controller));
        if (class_exists($controller)) {
            $test = new \ReflectionClass($controller);
            if (!$test->isAbstract()) {
                if (method_exists($controller, $method)) {
                    //Dynamically sending arguments to method based on URL args
                    $reflectionMethod = new ReflectionMethod($controller, $method);
                    $reflectionMethod->invokeArgs(new $controller(), $params);
                } else {
                    throw new Ex\NotFoundException('method ' . $method);
                }
            } else {
                throw new Ex\NotFoundException('controller ' . $controller);
            }
        } else {
            throw new Ex\NotFoundException('controller ' . $controller);
        }
    } catch (Ex\NotFoundException $ex) {
        $ex->error();
    }
}

/*
    Getting controller, method and arguments from URL
*/
/*
    To override index.php, add following in root's .htaccess file:
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
*/

function handleRequest($config)
{
    $url = $_SERVER['REQUEST_URI'];
    //If website is placed inside subdirectory
    if ($config['root']) {
        $root = '/' . $config['root'] . '/';
        //Excluding subdirectory from URl
        $url = str_replace($root, "", $url);
    }
    //If index.php is used, excluding it from url
    if (strpos($url, "index.php")!== false) {
        $url = explode("index.php", $url)[1];
    }
    $url = trim($url, '/');
    //Now $url looks something like this: controller/method/arg1/arg2
    $controller_array = explode("/", $url);
    //If no controller is suplied, default controller is called
    $controller = $controller_array[0] ? $controller_array[0] : $config['default_controller'];
    //If no method is suplied, default method (index) is called
    $method = isset($controller_array[1]) ? $controller_array[1] : "index";
    $params = array();

    //Filtering controller and method's name from possible GET params (controller?param=value)
    $controller = explode("?", $controller)[0];
    $method = explode("?", $method)[0];

    //Getting method arguments
    if (count($controller_array)>2) {
        $params = array();
        for ($i=2,$j=0; $i<count($controller_array); $i++) {
            $params['param' . $j++] = $controller_array[$i];
        }
    }

    //Loading controller, method and it's arguments
    callController($controller, $method, $params);
}
