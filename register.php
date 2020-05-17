<?php

require_once 'core/init.php';

$submit = Input::get('submit');
if (isset($submit)) {
    $validation = new Validation();
    $validation = $validation->check(array(
    'nama' => array(
                'required' => true,
                'min'      => 3,
                'max'      => 50,
                ),
    'email' => array(
                'required' => true,
                'max'      => 50,
                ),
    'password' => array(
                'required' => true,
                'max'      => 50,
                'min'       => 3,
    ),
    'no_telp' => array(
                'required' => true,
                'min'      => 11,
                ),
    'alamat' => array(
                'required' => true,
    )
    ));

    if ($validation->passed()) {
        $data = [
            'nama' => Input::get('nama'),
            'email' => Input::get('email'),
            'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
            'no_telp' => Input::get('no_telp'),
            'alamat' => Input::get('alamat'),
        ];

        $customer = new Customer();

        $customer->registerCustomer($data);

        echo "<script>alert('Sukses, silahkan login.'); window.location.href='login-page.php'</script>";
    } else {
        print_r($validation->errors());
        die('error');
    }
}
