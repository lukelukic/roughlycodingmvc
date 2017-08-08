<?php

/*
    Klasa modela dizajnirana za rad sa bazom. Implementira interfejs IDbItem
    Koji definise metode za:
    Unos instance modela u bazu - insertIntoDb()
    Izmenu instance modela u bazi - updateInDb()
    Brisanje instance modela u bazi - deleteFromDb()
    Dohvatanje jedne instance modela iz baze - selectOne()
    Dohvatanje vise zapisa instance modela iz baze - selectQuery()

    Nasledjuju je modeli koji zahtevaju rad sa bazom podataka

*/

namespace rc\system;

use rc\system\Interfaces\IDbItem;

abstract class DatabaseModel extends MainModel implements IDbItem
{

}
