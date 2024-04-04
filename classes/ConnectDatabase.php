<?php

class ConnectDatabase{
    protected $host = 'localhost';
    protected $username = 'root';
    protected $password = "";
    protected $dbname = "university_rating";

    protected function connect(){
        try{
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo "ERROR! ".$e->getMessage();
        }
    }
}