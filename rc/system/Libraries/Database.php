<?php

namespace rc\system\Libraries;

/*
    Klasa za pristup bazi.
    Javne metode :
    executeQuery($query), ocekuje upit, vraca rezultat izvrsenja upita
    getInsertedId() - vraca id poslednjeg unesenog zapisa
*/

class Database
{
    private $conn = null;
    private $result = null;
    private $insertedId = null;

    public function executeQuery($query)
    {
        $this->connect();
        if (!$result = mysqli_query($this->conn, $query)) {
            echo $this->error = mysqli_error($this->conn);
        } else {
            return $result;
        }
    }

    private function connect()
    {
        //Ucitavanje konfiguracionog fajla za bazu podataka
      require __DIR__ . "/" . "../config/database.php";
      //Postavljanje parametara klase iz konfiguracionog fajla
        if (!$this->conn = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database'])) {
            echo mysqli_connect_error();
        }
    }

    public function close()
    {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }

    public function getInsertedId()
    {
        return isset($this->conn) ? mysqli_insert_id($this->conn) : false;
    }
}
