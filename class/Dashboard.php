<?php

class Dashboard extends Main
{
    public function getStatusPending()
    {
        return $this->_DB->getWhereOr('pembelian', 'status', 'pending', 'status', 'bon');
    }

    public function pembelianStatictic()
    {
        $datas = $this->_DB->getStatistic();

        $dataTotal = [];
        // date('Y-m-d', strtotime($q['tanggal']))
        $total = 0;
        $date = '';
        foreach ($datas as $key => $value) {
            if ($date != date('Y-m-d', strtotime($value['tanggal']))) {
                $total = 0;
            }
            $date = date('Y-m-d', strtotime($value['tanggal']));
            $total += $value['total'];
            $dataTotal[$date] = $total;
        }

        return $dataTotal;
    }
}
