<?php 
require_once 'core/init.php';

$produkClass = new Produk();

$productStock = $produkClass->getProduk('id', Input::get('id'));


if (isset($_SESSION['cart'][Input::get('id')])) {
    if ($_SESSION['cart'][Input::get('id')] + Input::get('qty') > $productStock['qty']) {
        echo '<script>alert("Tidak bisa order melebihi stok barang!"); window.location.href="product.php"</script>';
    } else {
        $_SESSION['cart'][Input::get('id')] += Input::get('qty');
        header('Location: product.php');
    }
} else {
    if (Input::get('qty') > $productStock['qty']) {
        echo '<script>alert("Tidak bisa order melebihi stok barang!"); window.location.href="product.php"</script>';
    } else {
        $_SESSION['cart'][Input::get('id')] = Input::get('qty');
        header('Location: product.php');
    }
}
