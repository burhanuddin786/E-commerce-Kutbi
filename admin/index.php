<?php
require_once '../core/init.php';

if (Session::exists('email')) {
    header('Location: dashboard/');
} else {
    header('Location: /admin/login.php');
}
