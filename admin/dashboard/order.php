<?php

require_once '../../core/init.php';
if (!Session::exists('email') && !Session::exists('cart_admin')) {
    header('Location: ../index.php');
}

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// die;

$transaction = new Transaksi();

$data = [
    'total' => Input::get('total'),
    'sub_total' => Input::get('total'),
    'admin' => Input::get('nama'),
    'customer_pos' => Input::get('nama_customer'),
    'status' => Input::get('status'),
    'level' => 1,
    'order_id' => date('dmYmis'),
];

$insert = $transaction->insertTransactionAdmin($data);

if ($insert) {
    unset($_SESSION['cart_admin']);
    echo '<script>alert("Sukses!"); window.location.href="pos-tabel.php"</script>';
} else {
    echo '<script>alert("Error!"); window.history.go(-1)</script>';
}
