<?php

//Returns $config['base_url'];
function baseUrl()
{
    return BASE_URL;
}

//Returns current URL
function currentUrl()
{
    return $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
}

//If exists, returns previous URL
function previousUrl()
{
    return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false;
}

//Redirects to provided page
function redirect($path)
{
    header("Location: " . $path);
}

//Returns app's root directory
function rootDir()
{
    return $_SERVER['DOCUMENT_ROOT'] . "/" . ROOT . "/";
}
