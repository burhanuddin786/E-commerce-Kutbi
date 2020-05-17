<?php

session_start();

// spl_autoload_register(function ($class) {
//     require_once '../class/' . $class . '.php';
// });
function autoloadBar($class)
{
    $file = "../class/{$class}.php";
    if (is_readable($file)) {
        require $file;
    }
}

function autoloadFoo($class)
{
    $file = "../../class/{$class}.php";
    if (is_readable($file)) {
        require $file;
    }
}

function autoloadFin($class)
{
    $file = "class/{$class}.php";
    if (is_readable($file)) {
        require $file;
    }
}

spl_autoload_register("autoloadBar");
spl_autoload_register("autoloadFoo");
spl_autoload_register("autoloadFin");

$user = new User();
$produk = new Produk();
$transaksi = new Transaksi();
