<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$datas = $produk->getAllData('produk');
$i = 1;
$active = 'produk';
?>

<?php ob_start()  ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>

        <div class="container">
            <table class="table table-bordered table-striped data">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col" class="text-center">Nama Produk</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">HPP</th>
                        <th scope="col" class="text-center">Deskripsi</th>
                        <th scope="col" class="text-center">Stock</th>
                        <th scope="col" class="text-center">Foto</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data) {
    ?>
                    <tr>
                        <th scope="col" class="text-center"><?= $i ?></th>
                        <td><?= $data['nama'] ?></td>
                        <td><?= number_format($data['harga']) ?></td>
                        <td><?= number_format($data['hpp']) ?></td>
                        <td><?= substr($data['deskripsi'], 0, 50) ?> ...</td>
                        <td><?= $data['qty'] ?></td>
                        <td>
                            <img src="../../produk_image/<?= $data['foto'] ?>" width="100">
                        </td>
                        <td class="text-center">
                        <a href="update-produk.php?id=<?= $data['id'] ?>"><i class="fas fa-edit text-info"></i></a> | <a href="delete-produk.php?id=<?= $data['id'] ?>" onclick="javascript: return confirm('Apakah anda yakin menghapus data ini?')" ><i class="fas fa-trash-alt text-danger"></i></a>
                        </td>
                    </tr>
                    <?php $i++ ?>    
                    <?php
} ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php $content = ob_get_clean() ?>
    <!-- end #content -->
    
 <?php include '../../template/admin/main.php' ?>