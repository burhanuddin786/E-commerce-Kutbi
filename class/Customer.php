<?php

class Customer extends Main
{
    public function registerCustomer($fields = [])
    {
        if ($this->_DB->insert('customer', $fields)) {
            return true;
        }

        return false;
    }

    public function loginCustomer($email, $password)
    {
        $data = $this->_DB->getInfoLogin('customer', 'email', $email);

        if (is_array($data)) {
            if (password_verify($password, $data['password'])) {
                $data['status'] = 'success';
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getData($fields, $name)
    {
        return $data = $this->_DB->getInfoLogin('customer', $fields, $name);
    }

    public function updateData($fields = array(), $id)
    {
        if ($this->_DB->update('customer', $fields, $id)) {
            return true;
        } else {
            return false;
        }
    }
}
