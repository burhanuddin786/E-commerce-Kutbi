<?php

require_once 'core/init.php';

if ($_REQUEST['password'] != '') {
    $data = [
        'nama' => Input::get('nama'),
        'email' => Input::get('email'),
        'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
        'no_telp' => Input::get('no_telp'),
        'alamat' => Input::get('alamat'),
    ];

    $customer = new Customer();

    $customer->updateData($data, Input::get('id'));

    unset($_SESSION['customer']);
    Session::set('customer', $data);

    echo "<script>alert('Profil sukses di update.'); window.location.href='akun-saya.php'</script>";
} else {
    $data = [
        'nama' => Input::get('nama'),
        'email' => Input::get('email'),
        'no_telp' => Input::get('no_telp'),
        'alamat' => Input::get('alamat'),
    ];

    $customer = new Customer();

    $customer->updateData($data, Input::get('id'));

    unset($_SESSION['customer']);
    Session::set('customer', $data);
    
    echo "<script>alert('Profil sukses di update.'); window.location.href='akun-saya.php'</script>";
}
