<?php

class Mysql_Driver {

    private $connection;
    private $query;
    private $result;
    private $bind;

    public function connect() {
        $host = '202.171.33.109';
        $user = 'root';
        $password = 'R00t@!23';
        $database = 'his_kkm';
        try {
            $this->connection = new PDO("mysql:host=$host;port=3306;dbname=$database", $user, $password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            return TRUE;
        } catch (PDOException $e) {
            $this->connection = null;
            echo $e->getMessage();
            return FALSE;
        }
    }
    
    public function dc() {
        
    }

    public function disconnect() {
        $this->connection = null;
        return TRUE;
    }

    public function prepare($query) {
        $this->query = $query;
        return TRUE;
    }

    public function insertPrepare($query) {
        $this->bind = $this->connection->prepare($query);
    }

    public function insertBind($column, $value) {
        $this->bind->bindValue($column, $value);
    }

    public function insertExecute() {
        $this->bind->execute();
    }

    public function queryexecute() {
        $result = false;
        if (isset($this->query)) {
//            print_r($this->query);
            $this->result = $this->connection->query($this->query);
            $result = true;
        }
        return $result;
    }

    public function getLastId() {
        return $this->connection->lastInsertId();
    }

    public function fetchOut($type = 'object') {
        $result = false;
        if (isset($this->result)) {
            switch ($type) {
                case 'array':
                    $row = $this->result->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'object':
                    $row = $this->result->fetchAll(PDO::FETCH_OBJ);
                    break;
                case 'json';
                    $row = json_encode($this->result->fetchAll(PDO::FETCH_ASSOC));
                    break;
                default:
                    //$row = $this->result->fetch_object();
                    $row = $this->result->fetchAll(PDO::FETCH_ASSOC);
                    break;
            }
            $result = $row;
        }
        return $result;
    }

}
