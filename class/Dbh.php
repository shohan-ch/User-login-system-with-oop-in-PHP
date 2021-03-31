<?php

class Dbh {

    public $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=login", "root", "");
        if ($this->conn == false) {
            echo "Error!";
        } else {
            return $this->conn;
        }
    }

}