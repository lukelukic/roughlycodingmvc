<?php

namespace rc\app\Models;

class Person extends DbModel {

private $ime = "Luka";
private $prezime = "Lukic";

public function __construct(){
    $this->loadLibrary("Database");
}

public function insertIntoDb() {
    echo "Inserting...</br>";
    var_dump($this->Database);
}
public function deleteFromDb() {

}
public function updateInDb() {

}
public function selectOne() {

}
public function selectQuery($selectQuery) {

}


public function getPerson(){
  return $this->ime . " " . $this->prezime;
}

public function pusiga()
{
  echo "PUSIGA";
}
}
