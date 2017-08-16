<?php

namespace rc\system\Interfaces;

use rc\system\Libraries\Database;

/*
    Interface intended to provide basic database funcitonalities.
*/

interface IDbItem
{
    public function insertIntoDb();
    public function deleteFromDb();
    public function updateInDb();
    public function selectOne();
}
