<?php
/*-------------Funkcije za laksu manipulaciju SESIJAMA, NE MENJATI ----------*/
session_start();

//funkcija za dodavanje jedne vrednosti u sesiju.
//Od parametara ocekuje key koji predstavlja ime indeksa sesije i vrednost na zadatom indeksu.
function sessAdd($key, $value)
{
    $_SESSION[$key] = $value;
}


/*
Funkcija za batch obradu sesije.
Od parametara prima niz asocijativnih nizova od kojih svaki predstavlja pojedinacnu sesiju
    Primer : sessions = array(
        array(
          key => 'username',
          value => 'pera'
        ),
        array(
          key => 'id',
          value => 15
        )
    );
*/
function sessAddBatch($arr)
{
    foreach ($arr as $a) {
        $_SESSION[$a['key']] = $a['value'];
    }
}

//Funkcija za dohvatanje sesije. Od parametara moze da se prosledi kljuc, tada se dobija specificna sesija, ako postoji
//Ako ne postoji vraca se false. Ako se kljuc ne prosledi, vracaju se sve sesije
function sessGet($key = null)
{
    if ($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    } else {
        return $_SESSION;
    }
}

//Funkcija za unistavanje sesije. Kao parametar ocekuje kljuc.
//Ako je kljuc prosledjen, obrisace specificnu sesiju, u slucaju da ona postoji, ako nije, brisu se sve.
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

//Obezbedjivanje da flash promenljiva postoji samo na jednoj stranici
if (isset($_SESSION['removeFlash'])) {
    session_unset($_SESSION['flash']);
    session_unset($_SESSION['removeFlash']);
} else {
    if (isset($_SESSION['flash'])) {
        $_SESSION['removeFlash'] = true;
    }
}

//Funkcija za cuvanje podataka koji traju samo jednu stranicu, nakon redirekcije ili ponovnog ucitavanja stranice, podaci nestaju
//Ukoliko se samo dohvataju podaci, prosledjuje se kljuc
//Ukoliko se podaci i postavljaju i dohvataju prosledjuju se i kljuc i vrednost
function tmpData($key, $value = null)
{
    if ($value) {
        $_SESSION['flash'][$key]  = $value;
    } else {
        return isset($_SESSION['flash'][$key]) ? $_SESSION['flash'][$key] : false;
    }
}
