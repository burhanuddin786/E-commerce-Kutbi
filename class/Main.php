<?php

class Main
{
    protected $_DB;

    public function __construct()
    {
        $this->_DB = Database::getInstance();
    }

    public function getAllData($table)
    {
        return $data = $this->_DB->getAll($table);
    }

    public function deleteById($table, $id)
    {
        return $data = $this->_DB->delete($table, $id);
    }
}
