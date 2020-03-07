<?php

class Mysql_Driver {

    private $connection;
    private $query;
    private $result;
    private $bind;

    public function __construct() {
        
    }

    public function connect_switch() {
        
        $config = array();
        switch ($_SESSION['project_path']):
            case 'cd':
                $config['host'] = 'localhost';
                $config['user'] = 'root';
                $config['password'] = 'root';
                $config['database'] = 'his_kkm_local';
                $config['port'] = '3307';
//                $config['host'] = '202.171.33.109';
//                $config['user'] = 'root';
//                $config['password'] = 'R00t@!23';
//                $config['database'] = 'his_kkm';
//                $config['port'] = '3306';
                break;
            case 'rispac':
                $config['host'] = '202.171.33.125';
                $config['user'] = 'root';
                $config['password'] = 'R00t@!23';
                $config['database'] = 'sppris';
                $config['port'] = '13306';
                break;
            case 'uat':
                $config['host'] = 'localhost';
                $config['user'] = 'root';
                $config['password'] = 'root';
                $config['database'] = 'his_kkm_local';
                $config['port'] = '3307';
                break;
        endswitch;
        return $config;
    }

    public function connect() {

        $config = $this->connect_switch();
        $host = $config['host'];
        $user = $config['user'];
        $password = $config['password'];
        $database = $config['database'];
        $port = $config['port'];

        if ($this->connection !== null) {
            return $this->connection;
        }

        try {
            $this->connection = new PDO("mysql:host=$host;port=$port;dbname=$database", $user, $password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
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
                    $row = $this->result->fetchAll(PDO::FETCH_ASSOC);
                    break;
            }
            $result = $row;
        }
        return $result;
    }

}
