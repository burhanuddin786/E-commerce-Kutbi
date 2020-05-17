<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

$belanja = new Belanja();

$data = $belanja->deleteById('belanja', Input::get('id'));
if ($data) {
    echo "<script>alert('Data Sukses di Hapus.'); window.location.href='pembelian-tabel.php'</script>";
} else {
    echo "<script>alert('Error.'); window.location.href='pembelian-tabel.php'</script>";
}
