<?php

require_once 'core/init.php';

$submit = Input::get('submit');
if (isset($submit)) {
    $validation = new Validation();
    $validation = $validation->check(array(
    'email' => array(
                'required' => true,
                'max'      => 50,
                ),
    'password' => array(
                'required' => true,
                'max'      => 50,
                'min'       => 3,
    )
    ));

    if ($validation->passed()) {
        $customer = new Customer();

        $res = $customer->loginCustomer(Input::get('email'), Input::get('password'));

        if ($res && $res['status'] == 'success') {
            unset($res['status']);
            Session::set('customer', $res);
            echo "<script>alert('Sukses.'); window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('Login Gagal! Silahkan check email atau password anda.'); window.history.go(-1);</script>";
        }

    } else {
        print_r($validation->errors());
        die('error');
    }
}
