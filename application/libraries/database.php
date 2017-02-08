<?php
abstract class Database_Library {

    abstract protected function connect();
    abstract protected function disconnect();
    abstract protected function prepare($query);
    abstract protected function query();
    abstract protected function fetchOut($type = 'object');
    abstract protected function outresult();
}