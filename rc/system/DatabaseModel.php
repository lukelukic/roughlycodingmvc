<?php

/*
    Model designed to work with database.
    Implements IDBItem interface, which defines:
    public function insertIntoDb();
    public function deleteFromDb();
    public function updateInDb();
    public function selectOne();
*/

namespace rc\system;

use rc\system\Interfaces\IDbItem;

abstract class DatabaseModel extends MainModel implements IDbItem
{

}
