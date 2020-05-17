<?php

class Laporan extends Main
{
    public function selectReport($value1, $value2)
    {
        return $data = $this->_DB->getWhereBetween('pembelian', 'tanggal', $value1, $value2);
    }

    public function getHpp($id)
    {
        return $this->_DB->getAllWhere('pembelian_produk', 'id_pembelian', $id);
    }
}
