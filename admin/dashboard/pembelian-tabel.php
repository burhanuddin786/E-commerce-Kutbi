<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}
$belanja = new Belanja();

$datas = $belanja->getBelanjaJoin();
$i = 1;
$active = 'pembelian';

// echo '<pre>';
// print_r($datas);
// die;
// echo '</pre>';

?>

<?php ob_start()  ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>

        <div class="container">
            <table class="table table-bordered table-striped data">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col" class="text-center">No Faktur</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Produk</th>
                        <th scope="col" class="text-center">Qty</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data) {
    ?>
                    <tr>
                        <th scope="col" class="text-center"><?= $i ?></th>
                        <td><?= $data['no_faktur'] ?></td>
                        <td><?= $data['tanggal'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['qty'] ?></td>
                        <td><?= number_format($data['harga']) ?></td>
                        <td><?= number_format($data['total']) ?></td>
                        <td class="text-center">
                        <a href="update-pembelian.php?id=<?= $data['id'] ?>"><i class="fas fa-edit text-info"></i></a> | <a href="delete-pembelian.php?id=<?= $data['id'] ?>" onclick="javascript: return confirm('Apakah anda yakin menghapus data ini?')" ><i class="fas fa-trash-alt text-danger"></i></a>
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