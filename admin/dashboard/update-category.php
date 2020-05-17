<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

$cat = new Category();

$datas = $cat->getData('id', Input::get('id'));

// 
if (Input::get('submit')) {

    $data = [
        'nama' => Input::get('nama'),
    ];

    $cat->updateData($data, Input::get('id'));
    echo "<script>alert('Data Sukses di Ubah.'); window.location.href='category.php'</script>";
}
$active = 'customer';
?>

<?php ob_start() ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>
    <div class="container">
        <div class="row">
        <div class="frameForm offset-md-4 col-md-4">
            <h2 class="text-center uppercase">Edit Category</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $datas['id'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input class="form-control" type="text" name="nama" value="<?= $datas['nama'] ?>">
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