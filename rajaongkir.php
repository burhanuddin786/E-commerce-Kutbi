<?php
require_once 'core/init.php';

if (isset($_POST['idprov'])) {
    $id = $_POST['idprov'];

    $rajaOngkir = new RajaOngkir();

    $res = $rajaOngkir->getCityDependent('province_id', $id);

    $data = [];

    foreach ($res as $key => $value) {
        $data[] = ['id' => $value['city_id'], 'text' => $value['city_name']];
    }

    echo json_encode($data, JSON_FORCE_OBJECT);
}
