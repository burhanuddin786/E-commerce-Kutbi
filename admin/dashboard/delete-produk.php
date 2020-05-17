<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

$datas = $produk->getProduk('id', Input::get('id'));
$foto = $datas['foto'];

if (file_exists("../../produk_image/$foto")) {
    unlink("../../produk_image/$foto");
}

$data = $produk->deleteById('produk', Input::get('id'));
if ($data) {
    echo "<script>alert('Data Sukses di Hapus.'); window.location.href='produk-table.php'</script>";
} else {
    echo "<script>alert('Error.'); window.location.href='produk-table.php'</script>";
}
