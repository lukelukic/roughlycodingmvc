<?php

namespace rc\app\Controllers;

class Welcome extends Controller
{
    public function index()
    {
        $this->loadView('welcome');
    }
}
