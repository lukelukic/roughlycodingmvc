<?php
/*
    HTTP requests library.
    Designed for easier request handling.

    Functions:
    request($key) - if is set $_REQUEST[$key] returns it, else returns false;
    post($key) - if is set $_POST[$key] returns it, else returns false;
    get($key) - if is set $_GET[$key] returns it, else returns false;
*/

function post($key)
{
    return isset($_POST[$key]) ? $_POST[$key] : false;
}

function get($key)
{
    return isset($_GET[$key]) ? $_GET[$key] : false;
}

function request($key)
{
    return isset($_REQUEST[$key]) ? $_REQUEST[$key] : false;
}
