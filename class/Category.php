<?php

class Category extends Main
{
    public function addNewCategory($fields = [])
    {
        if ($this->_DB->insert('kategori', $fields)) {
            return true;
        }

        return false;
    }

    public function getData($fields, $name)
    {
        return $data = $this->_DB->getInfoLogin('kategori', $fields, $name);
    }

    public function updateData($fields = array(), $id)
    {
        if ($this->_DB->update('kategori', $fields, $id)) {
            return true;
        } else {
            return false;
        }
    }
}
