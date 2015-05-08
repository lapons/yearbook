<?php

class DAO {

    private $con;
    private $host = 'localhost';
    private $dbname = 'daw_yearbook';
    private $username = 'root';
    private $passwd = '1234';
    
    public function __construct() {
        $this->con = new PDO("mysql:host=$this->host;"
                . "dbname=$this->dbname", $this->username, $this->passwd);
    }

    public function getCon(){
        return $this->con;
    }
}

?>