<?php
/*-------------Funkcije za laksu manipulaciju zahtevima prosledjenim serveru, NE MENJATI ----------*/
/*
    Spisak funkcija  :
    post($key) - proverava da li je poslata promenljiva post-om, ako jeste, vraca je, ako nije vraca false
    get($key) - proverava da li je poslata promenljiva get-om, ako jeste, vraca je, ako nije vraca false
    request($key) - proverava da li je poslata promenljiva postom ili getom, ako jeste, vraca je, ako nije vraca false
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
