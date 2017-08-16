<?php
/*
    Base class for all controllers.
    Provides view, model and library loading.
*/
namespace rc\system;

use rc\system\Libraries as libs;
use rc\app\Models as mods;
use rc\system\Exceptions as Ex;

abstract class MainController
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
                    throw new Ex\NotFoundException("library " . $library . ".php");
                }
            } else {
                throw new Ex\NotFoundException("library " . $library . ".php");
            }
        } catch (Ex\NotFoundException $ex) {
            $ex->error();
        }
    }

    //Same as loading library
    public function loadModel($model)
    {
        try {
            $file = rootDir() . "rc/app/Models/" . $model . ".php";
            if (file_exists($file)) {
                //Provera da li postiji trazena klasa
                $class = "rc\app\Models\\" . $model;
                if (class_exists($class)) {
                    $this->__set($model, new $class());
                } else {
                    throw new Ex\NotFoundException("model " . $model . ".php");
                }
            } else {
                throw new Ex\NotFoundException("model " . $model . ".php");
            }
        } catch (Ex\NotFoundException $ex) {
            $ex->error();
        }
    }

    /*
        View loading. Expects view to load and data which will be sent to it.
        Data must be associative array.
        Data is extracted.
    */
    public function loadView($view, $data=null)
    {
        try {
            $file = rootDir() . 'rc/app/Views/' . $view . '.php';
            if (file_exists($file)) {
                if ($data) {
                    extract($data);
                }
                require_once $file;
            } else {
                throw new Ex\NotFoundException("view " . $view . ".php", 1);
            }
        } catch (Ex\NotFoundException $ex) {
            $ex->error();
        }
    }
}
