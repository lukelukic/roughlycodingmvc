<?php

namespace rc\app\Models;

use rc\system\DatabaseModel;

abstract class DbModel extends DatabaseModel
{
    public function __construct()
    {
        $this->loadLibrary('Medoo');
    }
}
