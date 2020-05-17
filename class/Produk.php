<?php

class Produk extends Main
{
    public function addProduk($fields = array())
    {
        return $this->_DB->insert('produk', $fields);
    }

    public function getProduk($fields, $name)
    {
        return $data = $this->_DB->getInfoLogin('produk', $fields, $name);
    }

    public function updateProduk($fields = array(), $id)
    {
        if ($this->_DB->update('produk', $fields, $id)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllProdukLimit($table, $limit, $sort)
    {
        return $data = $this->_DB->getLimitSort($table, $limit, $sort);
    }

    public function getProdukKategori($fields, $name)
    {
        return $data = $this->_DB->getDataKategori('produk', $fields, $name);
    }

    public function searchProduct($q)
    {
        return $data = $this->_DB->search('produk', 'nama', $q);
    }
}
