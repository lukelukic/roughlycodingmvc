<?php
/*
    Osnovna klasa kontrolera. Obezbedjuje ucitavanje view-a, librari-a i modela.
    Nasledjuje je svaki kontroler kome su potrebne ove funkcionalnosti;
*/
namespace rc\system;

use rc\system\Libraries as libs;
use rc\app\Models as mods;

abstract class MainController
{

  //Magicni metod koji dinamicki pravi polja pri pozivanju. Od parametara prima ime polje i vrednost za polje
  public function __set($propName, $value)
  {
      $this->$propName = $value;
  }

    //Funkcija za ucitavanje instance specificne biblioteke
    public function loadLibrary($library)
    {
        //Provera da li trazena biblioteka fizicki postoji
        $file = rootDir() . "rc/system/Libraries/" . $library . ".php";
        if (file_exists($file)) {
            //Provera da li postiji trazena klasa
            $class = "rc\system\Libraries\\" . $library;
            if (class_exists($class)) {
                $this->__set($library, new $class());
            } else {
                require_once 'Errors/404_Library.php';
            }
        } else {
            require_once 'Errors/404_Library.php';
        }
    }

    //Funkcija za ucitavanje instance specificnog modela
    public function loadModel($model)
    {
        //Provera da li trazena biblioteka fizicki postoji
      $file = rootDir() . "rc/app/Models/" . $model . ".php";
        if (file_exists($file)) {
            //Provera da li postiji trazena klasa
          $class = "rc\app\Models\\" . $model;
            if (class_exists($class)) {
                $this->__set($model, new $class());
            } else {
              require_once 'Errors/404_Model.php';
            }
        } else {
          require_once 'Errors/404_Model.php';
        }
    }

    //Metod u kom se ucitava trazeni fajl, na osnovu imena iz foldera Views
    //Takodje, podaci mu se prosledjuju u vidu asocijativnog niza, koji se
    //Razbija i od svakog elementa se dobija nova promenjiva
    public function loadView($view, $data=null)
    {
        $file = rootDir() . 'rc/app/Views/' . $view . '.php';
        if (file_exists($file)) {
            if ($data) {
                extract($data);
            }
            require_once $file;
        } else {
            echo "Requested view doesent exist.";
        }
    }
}
