<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

$customer = new Customer();

$datas = $customer->getData('id', Input::get('id'));


if (Input::get('submit')) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // die;

    if (Input::get('password') == '') {
        $data = [
            'nama' => Input::get('nama'),
            'email' => Input::get('email'),
            'no_telp' => Input::get('no_telp'),
            'alamat' => Input::get('alamat'),
        ];
    } else {
        $data = [
            'nama' => Input::get('nama'),
            'email' => Input::get('email'),
            'no_telp' => Input::get('no_telp'),
            'alamat' => Input::get('alamat'),
            'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
        ];
    }

    $customer->updateData($data, Input::get('id'));
    echo "<script>alert('Data Sukses di Ubah.'); window.location.href='customer-tabel.php'</script>";
}
$active = 'customer';
?>

<?php ob_start() ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>
    <div class="container">
        <div class="row">
        <div class="frameForm offset-md-4 col-md-4">
            <h2 class="text-center uppercase">Edit Customer</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $datas['id'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input class="form-control" type="text" name="nama" value="<?= $datas['nama'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="email" name="email" value="<?= $datas['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="">No Telpon</label>
                    <input class="form-control" type="text" name="no_telp" value="<?= $datas['no_telp'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input class="form-control" type="text" name="alamat" value="<?= $datas['alamat'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" type="password" name="password">
                    <small>Kosongkan jika tidak ingin mengubah password.</small>
                </div>
                <input class="btn btn-primary float-right" type="submit" name="submit" value="Ubah">
            </form>
            <ul class="list-group">
</ul>
        </div>
        </div>
    </div>
    </div>
<?php $content = ob_get_clean() ?>

<?php include '../../template/admin/main.php' ?>