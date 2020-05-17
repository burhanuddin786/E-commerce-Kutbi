<?php

class Transaksi extends Main
{
    private $lastID;

    public function getTransaksiJoin($table1, $table2)
    {
        return $this->_DB->getDataJoin($table1, $table2, 'id_customer');
    }

    public function getTransaksiJoinById($table1, $table2, $id, $field1, $field2)
    {
        return $this->_DB->getDataJoinById($table1, $table2, $id, $field1, $field2);
    }

    public function insertTransaction($fields = array())
    {
        $insert = $this->_DB->insertTransaction('pembelian', $fields);
        $this->lastID = $insert;

        if ($insert) {
            foreach (Session::get('cart') as $key => $value) {
                $productPrice = $this->_DB->getAllWhere('produk', 'id', $key)[0]['harga'];
                $productHpp = $this->_DB->getAllWhere('produk', 'id', $key)[0]['hpp'];
                $productQty = $this->_DB->getAllWhere('produk', 'id', $key)[0]['qty'] - $value;
                
                $data = [
                    'id_pembelian' => $this->lastID,
                    'id_produk' => $key,
                    'jumlah' => $value,
                    'harga' => $productPrice,
                    'hpp' => $productHpp
                ];
                $this->_DB->insert('pembelian_produk', $data);
                $this->_DB->update('produk', ['qty' => $productQty], $key);
            }
        }

        return $insert;
    }

    public function insertTransactionAdmin($fields = array())
    {
        $insert = $this->_DB->insertTransaction('pembelian', $fields);
        $this->lastID = $insert;

        if ($insert) {
            foreach (Session::get('cart_admin') as $key => $value) {
                $productPrice = $this->_DB->getAllWhere('produk', 'id', $key)[0]['harga'];
                $productHpp = $this->_DB->getAllWhere('produk', 'id', $key)[0]['hpp'];
                $productQty = $this->_DB->getAllWhere('produk', 'id', $key)[0]['qty'] - $value;

                $data = [
                    'id_pembelian' => $this->lastID,
                    'id_produk' => $key,
                    'jumlah' => $value,
                    'harga' => $productPrice,
                    'hpp' => $productHpp
                ];
                $this->_DB->insert('pembelian_produk', $data);
                $this->_DB->update('produk', ['qty' => $productQty], $key);
            }
            // $this->_DB->insert('pembelian_produk', )
            // return true;
        }

        return $insert;
    }

    public function updateStatus($fields = array(), $id)
    {
        $update = $this->_DB->update('pembelian', $fields, $id);

        if (isset($fields['resi'])) {
            $data = [
                'status' => 'dikirim'
            ];

            return $this->_DB->update('pembelian', $data, $id);
        }
    }

    public function updateProof($fields = array(), $id)
    {
        return $update = $this->_DB->updateProof('pembelian', $fields, $id);
    }

    public function getTransaction($id)
    {
        return $data = $this->_DB->getAllWhere('pembelian', 'id', $id);
    }

    public function getTransactionAdmin()
    {
        return $data = $this->_DB->getAllWhere('pembelian', 'level', '1');
    }

    public function getData($table, $id)
    {
        return $data = $this->_DB->getAllWhere($table, 'id', $id);
    }

    public function getTransactionCustomer($id)
    {
        return $data = $this->_DB->getAllWhere('pembelian', 'id_customer', $id);
    }
}
