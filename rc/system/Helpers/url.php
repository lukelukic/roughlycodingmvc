<?php

/*-------URL MANIPULATION CONFIGURATION ------*/

/*----URL that represents link to your website's root folder
Example : http://somewebsite.com/
Or localy : http://localhost/somedirectory -----*/
$config['base_url'] = 'http://yourwebsite.com/';

//Index tranica, ako se koristi redirekcija .httaccess-om, obrisati je
$config['index'] = "index.php";

//Root folder domena, ostaviti prazno ako je PUBLIC_HTML, ako nije, uneti punu putanju do foldera projekta
//Primer za localhost : folder se nalazi u var/www/html/projekat; folder projekta je projekat, pa se upisuje $config['root'] = 'projekat'
$config['root'] = "";


/*-------------Funkcije za laksu manipulaciju url-om  NE MENJATI ----------*/
define('BASE_URL', $config['base_url']);
define('INDEX', $config['index']);
define('ROOT', $config['root']);
//Funkcija za dohvatanje base_url-a
function baseUrl()
{
  return BASE_URL;
}

//Funkcija za dohvatanje adrese trenutne strane
function currentUrl() {
   return $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
}

//Funkcija za pristup prethodnoj strani, ukoliko je nema daje false
function previousUrl()
{
  return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false;
}

//Redirekcija na zeljeni kontroler
function redirect($path)
{
    header("Location: " . $path);
}

//Funkcija koja vraca root direktorijum projekta
function rootDir()
{
    return $_SERVER['DOCUMENT_ROOT'] . "/" . ROOT . "/";
}
