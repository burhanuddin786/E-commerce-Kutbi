<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

$data = $user->deleteById('users', Input::get('id'));
if ($data) {
    echo "<script>alert('Data Sukses di Hapus.'); window.location.href='admin-table.php'</script>";
} else {
    echo "<script>alert('Error.'); window.location.href='admin-table.php'</script>";
}
