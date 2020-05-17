<?php

class Belanja extends Main
{
    public function getproduct()
    {
        return $this->_DB->getAll('produk');
    }

    public function getProductById($id)
    {
        return $this->_DB->getAllWhere('produk', 'id', $id);
    }

    public function updateQtyProduct($fields = array(), $id)
    {
        return $this->_DB->update('produk', $fields, $id);
    }

    public function insertPembelian($fields = array())
    {
        if($this->_DB->insert('belanja', $fields))
        {
            $hpp = $fields['harga'];
            $idProduk = $fields['id_produk'];

            $data = [
                'hpp' => $hpp
            ];

            $this->_DB->update('produk', $data, $idProduk);
            return true;
        }
    }

    public function getAllPembelian()
    {
        return $this->_DB->getAll('belanja');
    }

    public function getAllPembelianById($id)
    {
        return $this->_DB->getAllWhere('belanja', 'id', $id);
    }

    public function updatePembelian($fields = array(), $id)
    {
        if ($this->_DB->update('belanja', $fields, $id)) {
            $hpp = $fields['harga'];
            $idProduk = $fields['id_produk'];

            $data = [
                'hpp' => $hpp
            ];

            $this->_DB->update('produk', $data, $idProduk);
            return true;
        }
        return false;
    }
    
    public function getBelanjaJoin()
    {
        return $this->_DB->getJoinBelanja();
    }
}
