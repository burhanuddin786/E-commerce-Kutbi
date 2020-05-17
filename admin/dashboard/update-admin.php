<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$errors     = array();
$datas = $user->getData('id', Input::get('id'));

if (Input::get('submit')) {
    $validation = new Validation;
    $validation = $validation->check(array(
        'nama'  => array(
                    'required' == true,
                    'min'      == 3,
                    'max'      == 50
                    ),
        'email' => array(
                    'required' == true,
                    'max'      == 50
                    )
    ));

    if ($validation->passed()) {
        $data = array(
            'nama'  => Input::get('nama'),
            'email' => Input::get('email')
        );
        $user->updateData($data, Input::get('id'));
        echo "<script>alert('Data berhasil diubah'); window.location.href='admin-table.php'</script>";
    } else {
        $errors = $validation->errors();
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
            <h2 class="text-center uppercase">Edit Admin</h2>
            <form action="update-admin.php" method="POST">
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
                <input class="btn btn-primary float-right" type="submit" name="submit" value="Ubah">
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