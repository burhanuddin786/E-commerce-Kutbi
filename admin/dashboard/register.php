<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$errors     = array();
if (Input::get('submit')) {
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
                'min'      => 5,
                'equal'    => 're-password',
                )
    ));

    if ($user->cekEmailExists(Input::get('email'))) {
        $errors[] = 'Email sudah terdaftar';
    } else {
        if ($validation->passed()) {
            $data = array(
            'nama' => Input::get('nama'),
            'email' => Input::get('email'),
            'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
        );
            $user->registerAdmin($data);
            echo "<script>alert('Register Sukses.'); window.location.href='admin-table.php'</script>";
        } else {
            $errors = $validation->errors();
        }
    }
}
$active = 'masterdata';
?>

<?php ob_start() ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>
    <div class="container">
        <div class="row">
        <div class="frameForm offset-md-4 col-md-4">
            <h2 class="text-center uppercase">Tambah Admin</h2>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input class="form-control" type="text" name="nama">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="email" name="email">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                    <label for="">Ulangi Password</label>
                    <input class="form-control" type="password" name="re-password">
                </div>
                <input class="btn btn-primary float-right" type="submit" name="submit" value="Tambah">
            </form>
            <ul class="list-group">
            <?php foreach ($errors as $value) {
    ?>
                <li class="list-group-item list-group-item-danger"><?= $value ?></li>
            <?php
} ?>
</ul>
        </div>
        </div>
    </div>
    </div>
<?php $content = ob_get_clean() ?>

<?php include '../../template/admin/main.php' ?>