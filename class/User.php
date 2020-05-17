<?php

class User extends Main
{
    // private $_DB;

    // public function __construct()
    // {
    //     $this->_DB = Database::getInstance();
    // }

    public function registerAdmin($fields = array())
    {
        if ($this->_DB->insert('users', $fields)) {
            return true;
        } else {
            return false;
        }
    }

    public function loginAdmin($email, $password)
    {
        $data = $this->_DB->getInfoLogin('users', 'email', $email);

        if (password_verify($password, $data['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function cekEmailExists($email)
    {
        $data = $this->_DB->getInfoLogin('users', 'email', $email);
        if (empty($data)) {
            return false;
        } else {
            return true;
        }
    }

    public function getData($fields, $name)
    {
        return $data = $this->_DB->getInfoLogin('users', $fields, $name);
    }

    public function updateData($fields = array(), $id)
    {
        if ($this->_DB->update('users', $fields, $id)) {
            return true;
        } else {
            return false;
        }
    }
}
