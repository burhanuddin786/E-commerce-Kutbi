<?php

require_once 'core/init.php';
if (empty($_SESSION['cart'])) {
    header('Location: product.php');
}

$transaction = new Transaksi();

$data = [
    'total' => Input::get('total'),
    'sub_total' => Input::get('sub_total'),
    'courier' => Input::get('courier')[0],
    'alamat' => Session::get('checkout_data')['alamat'],
    'id_customer' => Session::get('customer')['id'],
    'id_province' => Session::get('checkout_data')['provinsi'],
    'id_city' => Session::get('checkout_data')['kota'],
    'order_id' => date('dmYmis'),
];

$insert = $transaction->insertTransaction($data);

$orderId = $transaction->getTransaction($insert)[0]['order_id'];

header("location: konfirmasi.php?orderid=$orderId");
