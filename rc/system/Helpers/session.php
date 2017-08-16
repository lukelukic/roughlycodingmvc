<?php
/*
    Session manipulation helper.
    Designed for easier session handlign.
    Starts session.
*/
session_start();


function sessAdd($key, $value)
{
    $_SESSION[$key] = $value;
}

function sessAddBatch($arr)
{
    foreach ($arr as $a) {
        $_SESSION[$a['key']] = $a['value'];
    }
}

function sessGet($key = null)
{
    if ($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    } else {
        return $_SESSION;
    }
}

function sessKill($key = null)
{
    if ($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    } else {
        session_destroy();
    }
}


if (isset($_SESSION['removeFlash'])) {
    session_unset($_SESSION['flash']);
} else {
    if (isset($_SESSION['flash'])) {
        $_SESSION['removeFlash'] = true;
    }
}

function flash($key, $value = null)
{
    if ($value) {
        $_SESSION['flash'][$key]  = $value;
    } else {
        return isset($_SESSION['flash'][$key]) ? $_SESSION['flash'][$key] : false;
    }
}
