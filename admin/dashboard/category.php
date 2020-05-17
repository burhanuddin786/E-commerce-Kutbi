<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$datas = $user->getAllData('kategori');
$i = 1;
$active = 'produk';

if (isset($_POST['submit'])) {
    
    $cat = new Category();

    $store = $cat->addNewCategory([
        'nama' => Input::get('nama'),
    ]);

    if ($store) {
        echo "<script>alert('Kategori berhasil ditambahkan.'); window.location.href='category.php'</script>";
    }

    echo "<script>alert('Error!'); window.location.href='category.php'</script>";

}

?>

<?php ob_start()  ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>

        <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Nama Kategory</label>
                        <input type="text" class="form-control" required name="nama" id="">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="col-md-8">
            <table class="table table-bordered table-striped data">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data) {
    ?>
                    <tr>
                        <th scope="col" class="text-center"><?= $i ?></th>
                        <td><?= $data['nama'] ?></td>
                        <td class="text-center">
                        <a href="update-category.php?id=<?= $data['id'] ?>"><i class="fas fa-edit text-info"></i></a> | <a href="delete-category.php?id=<?= $data['id']?>" onclick="javascript: return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash-alt text-danger"></i></a>
                        </td>
                    </tr>
                    <?php $i++ ?>    
                    <?php
} ?>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    <?php $content = ob_get_clean() ?>
    <!-- end #content -->
    
 <?php include '../../template/admin/main.php' ?>