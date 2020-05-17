<?php
require_once '../../core/init.php';
if (!Session::exists('email')) {
    header('Location: ../index.php');
}

$datas = $transaksi->getTransactionAdmin();
$i = 1;
$active = 'pos';
// echo '<pre>';
// print_r($datas);
// echo '</pre>';
// die;
?>

<?php ob_start()  ?>
    <div id="content">
    <?php include '../../template/admin/nav-admin.php'; ?>

        <div class="container">
            <table class="table table-bordered table-striped data">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col" class="text-center">Nama Kasir</th>
                        <th scope="col" class="text-center">Nama Customer</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data) {
    ?>
                    <tr>
                        <th scope="col" class="text-center"><?= $i ?></th>
                        <td><?= $data['admin'] ?></td>
                        <td><?= $data['customer_pos'] ?></td>
                        <td><?= $data['tanggal'] ?></td>
                        <td><?= number_format($data['total']) ?></td>
                        <td><?= $data['status'] ?></td>
                        <td class="text-center">
                        <a href="detail-transaksi-admin.php?id=<?= $data['id'] ?>"><i class="far fa-eye text-info"></i></a> | <a href="delete-transaction.php?id=<?= $data['id'] ?>"><i class="fas fa-trash-alt text-danger"></i></a>
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