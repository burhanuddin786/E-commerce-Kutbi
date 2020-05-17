<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

$customer = new Customer();

$data = $customer->deleteById('customer', Input::get('id'));
if ($data) {
    echo "<script>alert('Data Sukses di Hapus.'); window.location.href='customer-tabel.php'</script>";
} else {
    echo "<script>alert('Error.'); window.location.href='customer-tabel.php'</script>";
}
