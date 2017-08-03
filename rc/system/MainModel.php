<?php

/*
    Osnovna klasa modela. Obezbedjuje metod za ucitavanje biblioteka.
    Nasledjuje je svaki model kome su potrebne ove funkcionalnosti.
*/

namespace rc\system;

abstract class MainModel
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
            }
        }
    }
}
