<?php

namespace rc\system\Interfaces;

use rc\system\Libraries\Database;

/*
  Interfejs koji obavezuje definisanje logike za insert/update/delete/select jednog zapisa iz baze klase koja ga implementira.
  Pored toga, treba obezbediti i logiku za dohvatanje vise zapisa.
*/

interface IDbItem
{
    public function insertIntoDb();
    public function deleteFromDb();
    public function updateInDb();
    public function selectOne();
    public function selectQuery($selectQuery);
}
