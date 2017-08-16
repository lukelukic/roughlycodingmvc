<?php

/*
    Osnovna klasa modela. Obezbedjuje metod za ucitavanje biblioteka.
    Nasledjuje je svaki model kome su potrebne ove funkcionalnosti.
*/

namespace rc\system;

use rc\system\Exceptions as Ex;

abstract class MainModel
{
    /*
        Magic method, dynamically creates properties and sets their values
    */
    public function __set($propName, $value)
    {
        $this->$propName = $value;
    }

    /*
        Method for library loading. If file and class do exist,
        __set() method is called to dynamically create property
        whitch represents library that is being called upon.
        Example:
        $this->loadLibrary("Lib");
        Creates:
        public $Lib = new rc\system\Libraries\Lib();
    */
    public function loadLibrary($library)
    {
        try {
            $file = rootDir() . "rc/system/Libraries/" . $library . ".php";
            if (file_exists($file)) {
                $class = "rc\system\Libraries\\" . $library;
                if (class_exists($class)) {
                    $this->__set($library, new $class());
                } else {
                    throw new Ex\NotFoundException($library . ".php");
                }
            } else {
                throw new Ex\NotFoundException($library . ".php");
            }
        } catch (Ex\NotFoundException $ex) {
            $ex->error();
        }
    }
}
