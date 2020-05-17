<?php
require_once 'core/init.php';
$idCart = Input::get('id');
unset($_SESSION["cart"]["$idCart"]);
header('Location: cart.php');
