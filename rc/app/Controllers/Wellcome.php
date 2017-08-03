<?php

namespace rc\app\Controllers;

class Wellcome extends Controller
{
    public function index()
    {
        $this->loadView('wellcome');

    }

}
