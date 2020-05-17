<?php
require_once '../../core/init.php';

$datas1 = $transaksi->getTransaksiJoinById('pembelian', 'customer', Input::get('id'), 'id_customer', 'id');
foreach ($datas1 as $data1);
$datas2 = $transaksi->getTransaksiJoinById('pembelian_produk', 'produk', Input::get('id'), 'id_produk', 'id_pembelian');
$i = 1;
$active = 'transaksi';
?>

<?php ob_start()  ?>
    <div id="content">
    <?php include '../template/admin/nav-admin.php'; ?>
        <div class="container"> 
            <p><strong>Nama : <?= $data1['nama'] ?></strong></p>
            <p><strong>Pembelian: <?= $data1['tanggal'] ?><strong></p>
            <p><strong>Email : <?= $data1['email'] ?><strong></p>
            <p><strong>No Telpon : <?= $data1['no_telp'] ?><strong></p>
            <p><strong>Alamat : <?= $data1['alamat'] ?><strong></p>

            <table class="table table-bordered table-striped data">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col" class="text-center">Nama Produk</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Jumlah</th>
                        <th scope="col" class="text-center">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas2 as $data2) {
    ?>
                    <tr>
                        <th scope="col" class="text-center"><?= $i ?></th>
                        <td><?= $data2['nama'] ?></td>
                        <td><?= $data2['harga'] ?></td>
                        <td><?= $data2['jumlah'] ?></td>
                        <td><?= $data2['harga'] * $data2['jumlah'] ?></td>
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
    
 <?php include '../template/admin/main.php' ?> 