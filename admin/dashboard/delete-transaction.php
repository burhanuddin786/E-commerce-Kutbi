<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

$transaksi = new Transaksi();

$data = $transaksi->deleteById('pembelian', Input::get('id'));
if ($data) {
    echo "<script>alert('Data Sukses di Hapus.'); window.location.href='pos-tabel.php'</script>";
} else {
    echo "<script>alert('Error.'); window.location.href='pos-tabel.php'</script>";
}
