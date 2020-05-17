<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

require_once("../../dompdf/autoload.inc.php");
use Dompdf\Dompdf;

$report = new Laporan();
$datas = $report->selectReport(Input::get('start'), Input::get('to'));

if (count($datas) == 0) {
    echo "<script>alert('Tidak ada data pada tanggal tersebut.'); window.location.href='laporan.php'</script>";
} else {
    $dompdf = new Dompdf();

    $html = "<html><center><h3>Report KUTBI Textile</h3></center>";
    $html .= "<center>Pada Tanggal ".Input::get('start')." - ".Input::get('to')."</center><hr/><br/>";
    $html .= "
<table border='1' width='100%'>
<tr>
    <th>No</th>
    <th>Invoice</th>
    <th>Tipe Penjualan</th>
    <th>HPP Total</th>
    <th>Sub Total</th>
    <th>Ongkos Kirim</th>
    <th>Grand Total</th>
    <th>Keuntungan</th>
    <th>Tanggal</th>
</tr>
";

    $no = 1;
    $sub = 0;
    $total = 0;
    $hppTotal = 0;
    foreach ($datas as $value) {
        $hpp = $report->getHpp($value['id']); 
        $hppPembelian = 0;
        foreach ($hpp as $pokok) {
            $hppTotal += ($pokok['hpp'] * $pokok['jumlah']); 
            $hppPembelian += ($pokok['hpp'] * $pokok['jumlah']);  
        }
        $level = $value['level'] == '0' ? 'Online' : 'POS';
        $html .= "<tr>
        <th style='text-align:center;'>$no</th>
        <td>".$value['order_id']."</td>
        <td>".$level."</td>
        <td>".number_format($hppPembelian)."</td>
        <td>".number_format($value['sub_total'])."</td>
        <td>".number_format($value['total'] - $value['sub_total'])."</td>
        <td>".number_format($value['total'])."</td>
        <td>".number_format($value['sub_total'] - $hppPembelian)."</td>
        <td>".$value['tanggal']."</td>
        </tr>";
        $no++;
        $sub += $value['sub_total'];
        $total += $value['total'];
    }

    $html .= "
<tr>
    <th colspan='8'>Sub Total/Pendapatan</th>
    <th>".number_format($sub)."</th>
</tr>
<tr>
    <th colspan='8'>Total</th>
    <th>".number_format($total)."</th>
</tr>
<tr>
    <th colspan='8'>HPP</th>
    <th>".number_format($hppTotal)."</th>
</tr>
<tr>
    <th colspan='8'>Laba Kotor (Pendapatan - HPP)</th>
    <th>".number_format($sub - $hppTotal)."</th>
</tr>
";

    $html .= "</html>";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'potrait');
    $dompdf->render();
    $dompdf->stream('laporan-pdf.pdf');
}

// print_r($html);
// die;
