<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

$cat = new Category();

$data = $cat->deleteById('kategori', Input::get('id'));
if ($data) {
    echo "<script>alert('Data Sukses di Hapus.'); window.location.href='category.php'</script>";
} else {
    echo "<script>alert('Error.'); window.location.href='category.php'</script>";
}
